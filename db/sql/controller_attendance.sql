CREATE TABLE IF NOT EXISTS bh_controller_attendance_time (
id INT(11) NOT NULL AUTO_INCREMENT, meeting_time TIME NOT NULL, sort_order INT(11) NOT NULL DEFAULT 0, status TINYINT(1) NOT NULL DEFAULT 1,
created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id), UNIQUE KEY uq_meeting_time(meeting_time)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS bh_controller_attendance (
id INT(11) NOT NULL AUTO_INCREMENT, attendance_date DATE NOT NULL, meeting_time_id INT(11) NOT NULL, counsellor_id INT(11) NOT NULL,
marked_at DATETIME NOT NULL, marked_by INT(11) NOT NULL, PRIMARY KEY(id), UNIQUE KEY uq_counsellor_meeting(attendance_date,meeting_time_id,counsellor_id),
KEY idx_attendance_date(attendance_date), KEY idx_meeting_time(meeting_time_id), KEY idx_counsellor(counsellor_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT IGNORE INTO bh_controller_attendance_time(meeting_time,sort_order,status,created_at,updated_at)
VALUES('10:00:00',1,1,NOW(),NOW()),('15:00:00',2,1,NOW(),NOW()),('18:00:00',3,1,NOW(),NOW());