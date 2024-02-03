<?php
session_start();
include_once("db.php");
include_once("user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estnum = str_replace("-", "", $_POST['numest']);
    $password = $_POST['password'];

    $db = new DB();
    $db->start_connection();

    $query = "SELECT * FROM student WHERE student_id = " . $estnum . "";
    $result = $db->run_query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            if ($row['year_of_study'] == 0) {
                $user = new admin($row['user_name'], $estnum);
                $_SESSION['user'] = $user;
                header("Location: admin/index.php");
            } else {
                $user = new student($row['user_name'], $estnum);
                $_SESSION['user'] = $user;
                header("Location: user/index.php");
            }
        } else {
            header("Location: index.php?error=2");
        }
    } else {
        header("Location: index.php?error=1");
    }
} else {
    header("Location: index.php?error=0");
}
