<?php
require_once('config.php');

$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table = DB_PREFIX . 'user_group';
$result = $conn->query("SELECT user_group_id, permission FROM `$table`");

while ($row = $result->fetch_assoc()) {
    $id = $row['user_group_id'];
    $perm = json_decode($row['permission'], true);

    // json_decode ফেইল করলে unserialize চেক
    if (!$perm) {
        $perm = unserialize($row['permission']);
    }

    if (is_array($perm)) {
        if (isset($perm['access']) && !in_array('student/quick_student', $perm['access'])) {
            $perm['access'][] = 'student/quick_student';
        }
        if (isset($perm['modify']) && !in_array('student/quick_student', $perm['modify'])) {
            $perm['modify'][] = 'student/quick_student';
        }

        $new_perm = json_encode($perm);
        $update_sql = "UPDATE `$table` SET permission = '" . $conn->real_escape_string($new_perm) . "' WHERE user_group_id = '$id'";
        $conn->query($update_sql);
    }
}

echo "Permission added successfully!";
$conn->close();
