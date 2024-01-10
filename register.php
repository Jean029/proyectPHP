<?php
session_start();
include_once("db.php");
include_once("user.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $estnum = str_replace("-", "", $_POST['numest']);
    $pass = $_POST['password'];
    $studyYears = $_POST['study'];

    $db = new DB();
    $db->start_connection();
    $query = "SELECT * FROM student WHERE student_id = " . $estnum . "";
    $result = $db->run_query($query);

    if ($result instanceof Exception) {
        header("Location: index.php?error=" . $result . "");
    }

    if ($result->num_rows == 0) {
        $query = "INSERT INTO student (student_id, password, user_name, year_of_study) VALUES (?,?,?,?)";
        $stm = $db->prepare_query($query);

        $stm->bind_param("sssi", $student_id, $password, $user_name, $year_of_study);

        $student_id = $estnum;
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $user_name = $username;
        $year_of_study = $studyYears;

        $stm->execute();

        $user = new user($username, $estnum);
        $_SESSION['user'] = $user;

        header("Location: user/index.php");
    } else {
        header("Location: index.php?register&error=1");
    }
} else {
    header("Location: index.php?error=0");
}
