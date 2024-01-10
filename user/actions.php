<?php
include("../db.php");
include("../user.php");
session_start();

function get_course($course, $section)
{
    $db = new DB();
    $db->start_connection();

    $query = "SELECT * FROM (SELECT * FROM courses WHERE course_id = " . $course . ") c, (SELECT * FROM section WHERE section_id = " . $section . ") s WHERE c.course_id = s.course_id";
    $result = $db->run_query($query);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return NULL;
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET['type'])) {
        if ($_GET['type'] == 'add') {
            $course = get_course($_POST['course'], $_POST['section']);

            $_SESSION['user']->enroll_course($course);

            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
