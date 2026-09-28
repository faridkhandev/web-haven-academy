<?php
class ModelCommonDashboard extends Model {
    private function count($sql) {
        $query = $this->db->query($sql);
        return isset($query->row['total']) ? (int)$query->row['total'] : 0;
    }

    private function idsForRole($group_id, $user_id) {
        $user_id = (int)$user_id;
        if ($group_id == 11) {
            return array($user_id);
        }

        if ($group_id == 12) {
            $query = $this->db->query("SELECT u.user_id FROM " . DB_PREFIX . "user u INNER JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE u.user_group_id = 11 AND ue.link_user_id = '" . $user_id . "'");
            return array_map('intval', array_column($query->rows, 'user_id'));
        }

        if ($group_id == 13) {
            $query = $this->db->query("SELECT u.user_id FROM " . DB_PREFIX . "user u INNER JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE u.user_group_id = 12 AND ue.link_user_id = '" . $user_id . "'");
            $leader_ids = array_map('intval', array_column($query->rows, 'user_id'));
            if (!$leader_ids) {
                return array();
            }
            $query = $this->db->query("SELECT u.user_id FROM " . DB_PREFIX . "user u INNER JOIN " . DB_PREFIX . "user_extra ue ON u.user_id = ue.user_id WHERE u.user_group_id = 11 AND ue.link_user_id IN (" . implode(',', $leader_ids) . ")");
            return array_map('intval', array_column($query->rows, 'user_id'));
        }

        return array();
    }

    private function studentCount($where) {
        return $this->count("SELECT COUNT(DISTINCT s.id) AS total FROM " . DB_PREFIX . "student s " . $where);
    }

    public function getStats($group_id, $user_id) {
        $group_id = (int)$group_id;
        $user_id = (int)$user_id;
        $today = date('Y-m-d');

        $stats = array(
            'title' => 'Dashboard',
            'cards' => array()
        );

        if ($group_id == 1 || $group_id == 0) {
            $stats['title'] = 'Admin Dashboard';
            $stats['cards'] = array(
                array('label'=>'Today\'s New Leads','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.student_status=0 AND DATE(s.created_at)='" . $today . "'"),'icon'=>'fa-user-plus','class'=>'primary','link'=>'student/student','footer'=>'View Leads'),
                array('label'=>'Active IDs','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.student_status=1"),'icon'=>'fa-check-circle','class'=>'success','link'=>'student/student','footer'=>'View Active List'),
                array('label'=>'Total Students','value'=>$this->studentCount("WHERE s.student_delete_status=0"),'icon'=>'fa-users','class'=>'info','link'=>'student/student','footer'=>'All Students'),
                array('label'=>'Today\'s Classes','value'=>$this->count("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "course_to_session cs WHERE DATE(cs.session_date)='" . $today . "'"),'icon'=>'fa-clock-o','class'=>'warning','link'=>'module/allattendance','footer'=>'Attendance Summary')
            );
            return $stats;
        }

        if ($group_id == 15) {
            $base = "INNER JOIN " . DB_PREFIX . "student_to_counsellor sc ON s.id=sc.student_id WHERE s.student_delete_status=0 AND sc.user_id='" . $user_id . "'";
            $attendance_table = DB_PREFIX . "controller_attendance";
            $stats['title'] = 'Counsellor Dashboard';
            $stats['cards'] = array(
                array('label'=>'Today\'s New Leads','value'=>$this->studentCount($base . " AND DATE(sc.added_date)='" . $today . "' AND s.student_status=0"),'icon'=>'fa-user-plus','class'=>'primary','link'=>'module/counsellorstudent','footer'=>'My Leads'),
                array('label'=>'My Active IDs','value'=>$this->studentCount($base . " AND s.student_status=1"),'icon'=>'fa-check-circle','class'=>'success','link'=>'module/counsellorreport','footer'=>'My Report'),
                array('label'=>'My Students','value'=>$this->studentCount($base),'icon'=>'fa-users','class'=>'info','link'=>'module/counsellorstudent','footer'=>'View My Students'),
                array('label'=>'Attendance Days','value'=>$this->count("SELECT COUNT(DISTINCT attendance_date) AS total FROM " . $attendance_table . " WHERE counsellor_id='" . $user_id . "'"),'icon'=>'fa-calendar-check-o','class'=>'warning','link'=>'user/controller_attendance','footer'=>'My Attendance'),
                array('label'=>'This Month Attendance','value'=>$this->count("SELECT COUNT(DISTINCT attendance_date) AS total FROM " . $attendance_table . " WHERE counsellor_id='" . $user_id . "' AND DATE_FORMAT(attendance_date,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')"),'icon'=>'fa-clock-o','class'=>'info','link'=>'user/controller_attendance','footer'=>'Attendance Details')
            );
            return $stats;
        }

        if ($group_id == 16) {
            $lang = "s.student_language IN (SELECT permission_language FROM " . DB_PREFIX . "user_to_language WHERE user_id='" . $user_id . "')";
            $stats['title'] = 'Controller Dashboard';
            $stats['cards'] = array(
                array('label'=>'Today\'s New Leads','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.student_status=0 AND " . $lang . " AND DATE(s.created_at)='" . $today . "'"),'icon'=>'fa-user-plus','class'=>'primary','link'=>'module/controllerstudent','footer'=>'My Students'),
                array('label'=>'Pending IDs','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.student_status=0 AND " . $lang),'icon'=>'fa-clock-o','class'=>'warning','link'=>'module/controllerstudent','footer'=>'View Pending List'),
                array('label'=>'Today\'s Classes','value'=>$this->count("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "course_to_session cs WHERE DATE(cs.session_date)='" . $today . "'"),'icon'=>'fa-video-camera','class'=>'info','link'=>'user/controller_attendance','footer'=>'Controller Attendance')
            );
            return $stats;
        }

        if ($group_id == 14) {
            $stats['title'] = 'Teacher Dashboard';
            $stats['cards'] = array(
                array('label'=>'Today\'s Classes','value'=>$this->count("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "course_to_session cs WHERE DATE(cs.session_date)='" . $today . "' AND cs.session_teacher_id='" . $user_id . "'"),'icon'=>'fa-calendar','class'=>'primary','link'=>'module/session','footer'=>'My Classes'),
                array('label'=>'Upcoming Classes','value'=>$this->count("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "course_to_session cs WHERE DATE(cs.session_date)>'" . $today . "' AND cs.session_teacher_id='" . $user_id . "'"),'icon'=>'fa-clock-o','class'=>'warning','link'=>'module/session','footer'=>'Class Schedule'),
                array('label'=>'My Total Classes','value'=>$this->count("SELECT COUNT(DISTINCT cs.meeting_link) AS total FROM " . DB_PREFIX . "course_to_session cs WHERE cs.session_teacher_id='" . $user_id . "'"),'icon'=>'fa-users','class'=>'success','link'=>'module/session','footer'=>'My Class List')
            );
            return $stats;
        }

        if ($group_id == 11 || $group_id == 12 || $group_id == 13) {
            $ids = $this->idsForRole($group_id, $user_id);
            $id_sql = $ids ? implode(',', $ids) : '0';
            $role = ($group_id == 11) ? 'Trainer' : (($group_id == 12) ? 'Team Leader' : 'Senior Team Leader');
            $stats['title'] = $role . ' Dashboard';
            $stats['cards'] = array(
                array('label'=>'My Active Students','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.student_status=1 AND s.link_user_id IN (" . $id_sql . ")"),'icon'=>'fa-check-circle','class'=>'success','link'=>'module/mystudent','footer'=>'My Students'),
                array('label'=>'My Total Students','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.link_user_id IN (" . $id_sql . ")"),'icon'=>'fa-users','class'=>'info','link'=>'module/mystudent','footer'=>'View My Students'),
                array('label'=>'Today\'s Assigned','value'=>$this->studentCount("WHERE s.student_delete_status=0 AND s.link_user_id IN (" . $id_sql . ") AND DATE(s.link_user_at)='" . $today . "'"),'icon'=>'fa-user-plus','class'=>'primary','link'=>'module/mystudent','footer'=>'Today\'s List')
            );
            return $stats;
        }

        $stats['title'] = 'Dashboard';
        $stats['cards'] = array();
        return $stats;
    }
}
