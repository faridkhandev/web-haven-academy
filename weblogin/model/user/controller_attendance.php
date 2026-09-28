<?php
class ModelUserControllerAttendance extends Model {
    public function __construct($registry) {
        parent::__construct($registry);
        $this->install();
    }
    private function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "controller_attendance_time (id INT(11) NOT NULL AUTO_INCREMENT, meeting_time TIME NOT NULL, sort_order INT(11) NOT NULL DEFAULT 0, status TINYINT(1) NOT NULL DEFAULT 1, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id), UNIQUE KEY uq_meeting_time (meeting_time)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "controller_attendance (id INT(11) NOT NULL AUTO_INCREMENT, attendance_date DATE NOT NULL, meeting_time_id INT(11) NOT NULL, counsellor_id INT(11) NOT NULL, marked_at DATETIME NOT NULL, marked_by INT(11) NOT NULL, PRIMARY KEY (id), UNIQUE KEY uq_counsellor_meeting (attendance_date, meeting_time_id, counsellor_id), KEY idx_attendance_date (attendance_date), KEY idx_meeting_time (meeting_time_id), KEY idx_counsellor (counsellor_id)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $q = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "controller_attendance_time");
        if ((int)$q->row['total'] === 0) {
            $now = date('Y-m-d H:i:s');
            foreach (array('10:00:00','15:00:00','18:00:00') as $i => $time) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "controller_attendance_time SET meeting_time='" . $this->db->escape($time) . "', sort_order='" . (int)($i+1) . "', status=1, created_at='" . $now . "', updated_at='" . $now . "'");
            }
        }
    }
    public function getTimes($active_only=true) {
        $sql="SELECT * FROM ".DB_PREFIX."controller_attendance_time";
        if($active_only) $sql.=" WHERE status=1";
        $sql.=" ORDER BY sort_order ASC, meeting_time ASC";
        return $this->db->query($sql)->rows;
    }
    public function addTime($time) {
        $time=trim($time);
        if(!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/',$time)) return false;
        $time.=':00';
        $q=$this->db->query("SELECT id FROM ".DB_PREFIX."controller_attendance_time WHERE meeting_time='".$this->db->escape($time)."'");
        if($q->num_rows) return false;
        $max=$this->db->query("SELECT COALESCE(MAX(sort_order),0) AS max_order FROM ".DB_PREFIX."controller_attendance_time");
        $now=date('Y-m-d H:i:s');
        $this->db->query("INSERT INTO ".DB_PREFIX."controller_attendance_time SET meeting_time='".$this->db->escape($time)."', sort_order='".((int)$max->row['max_order']+1)."', status=1, created_at='".$now."', updated_at='".$now."'");
        return true;
    }
    public function deleteTime($id) {
        $q=$this->db->query("SELECT COUNT(*) AS total FROM ".DB_PREFIX."controller_attendance WHERE meeting_time_id='".(int)$id."'");
        if((int)$q->row['total']>0) return false;
        $this->db->query("DELETE FROM ".DB_PREFIX."controller_attendance_time WHERE id='".(int)$id."'");
        return true;
    }
    public function getCounsellors() {
        return $this->db->query("SELECT u.user_id,u.firstname,u.lastname,ue.user_no,u.status FROM ".DB_PREFIX."user u LEFT JOIN ".DB_PREFIX."user_extra ue ON ue.user_id=u.user_id WHERE u.user_group_id=15 ORDER BY u.firstname ASC,u.lastname ASC")->rows;
    }
    public function getAttendanceMap($date,$meeting_time_id) {
        $rows=$this->db->query("SELECT counsellor_id,marked_at,marked_by FROM ".DB_PREFIX."controller_attendance WHERE attendance_date='".$this->db->escape($date)."' AND meeting_time_id='".(int)$meeting_time_id."'")->rows;
        $map=array(); foreach($rows as $row) $map[(int)$row['counsellor_id']]=$row; return $map;
    }
    public function addAttendance($date,$meeting_time_id,$counsellor_id,$marked_by) {
        $q=$this->db->query("SELECT id FROM ".DB_PREFIX."controller_attendance WHERE attendance_date='".$this->db->escape($date)."' AND meeting_time_id='".(int)$meeting_time_id."' AND counsellor_id='".(int)$counsellor_id."'");
        if($q->num_rows) return false;
        $this->db->query("INSERT INTO ".DB_PREFIX."controller_attendance SET attendance_date='".$this->db->escape($date)."', meeting_time_id='".(int)$meeting_time_id."', counsellor_id='".(int)$counsellor_id."', marked_at='".date('Y-m-d H:i:s')."', marked_by='".(int)$marked_by."'");
        return true;
    }
    public function getHistory($date_from,$date_to,$counsellor_id=0) {
        $sql="SELECT a.id,a.attendance_date,a.marked_at,a.marked_by,a.counsellor_id,t.meeting_time,u.firstname,u.lastname,ue.user_no,mu.firstname AS marker_firstname,mu.lastname AS marker_lastname FROM ".DB_PREFIX."controller_attendance a INNER JOIN ".DB_PREFIX."controller_attendance_time t ON t.id=a.meeting_time_id INNER JOIN ".DB_PREFIX."user u ON u.user_id=a.counsellor_id LEFT JOIN ".DB_PREFIX."user_extra ue ON ue.user_id=u.user_id LEFT JOIN ".DB_PREFIX."user mu ON mu.user_id=a.marked_by WHERE a.attendance_date BETWEEN '".$this->db->escape($date_from)."' AND '".$this->db->escape($date_to)."'";
        if((int)$counsellor_id>0) $sql.=" AND a.counsellor_id='".(int)$counsellor_id."'";
        $sql.=" ORDER BY a.attendance_date DESC,t.meeting_time DESC,u.firstname ASC,u.lastname ASC";
        return $this->db->query($sql)->rows;
    }
}
