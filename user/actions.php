<?php
include("../db.php");
include("../user.php");
session_start();

function get_course($course, $section)
{
    $db = new DB();
    $db->start_connection();

    $query = "SELECT * FROM (SELECT * FROM courses WHERE course_id = '" . $course . "') c, (SELECT * FROM section WHERE section_id = '" . $section . "') s WHERE c.course_id = s.course_id";
    $result = $db->run_query($query);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return NULL;
    }
}

function updateCapacity($course, $newCapacity)
{
    $db = new DB();
    $db->start_connection();

    $query = "UPDATE section SET capacity = " . $newCapacity . " WHERE course_id = '" . $course['course_id'] . "' and section_id = '" . $course['section_id'] . "'";
    $db->run_query($query);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET['add'])) {
        $course = get_course($_POST['course'], $_POST['section']);

        if (!$_SESSION['user']->get_enrollCourse($course)) {
            $_SESSION['user']->enroll_course($course);
            updateCapacity($course, $course['capacity'] - 1);
        }
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
