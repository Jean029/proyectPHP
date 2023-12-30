<?php
session_start();
require("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estnum = $_POST['estnum'];
    $password = $_POST['password'];

    $db = new DB();
    $db->start_connection();

    $query = "SELECT * FROM student WHERE student_id = " . $estnum . "";
    $result = $db->run_query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['username'];
        $_SESSION['estid'] = $row['student_id'];
        if (password_verify($password, $row['password'])) {
            if ($row['year_of_study'] == 0) {
                header("Location: admin/index.php");
            } else {
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
