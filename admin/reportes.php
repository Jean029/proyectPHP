<?php
include("../user.php");
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Inicio</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="../css/admin.css" rel="stylesheet" />
    <script src="../js/main.js"></script>

</head>

<body>
    <header>
        <button><a href="index.php">Home</a></button>
        <h2>Reportes</h2>
        <button><a href="actions.php?logout">Logout</a></button>
    </header>

    <div class="container">
        <div class="card">
            <?php
            if (isset($_GET['cursos'])) {
                $courses = $_SESSION['user']->get_courses_and_sections();
                print "
                        <table>
                            <thead>
                                <tr>
                                    <td>Curso</td>
                                    <td>Seccion</td>
                                    <td>Creditos</td>
                                    <td>Capacity</td>
                                </tr>
                            </thead>
                            <tbody>";

                foreach ($courses as $course) {
                    print "
                        <tr>
                            <td>" . $course['course_id'] . "</td>
                            <td>" . $course['section_id'] . "</td>
                            <td>" . $course['credits'] . "</td>
                            <td>" . $course['total_capacity'] . "</td>
                        </tr>
                    ";
                }

                print "</tbody></table>";
            } else if (isset($_GET['matricula'])) {
                $matricula = $_SESSION['user']->get_enroll(2);

                if ($matricula != null) {
                    print "
                        <table>
                            <thead>
                                <tr>
                                    <td>Numero de estudiante</td>
                                    <td>Curso</td>
                                    <td>Seccion</td>
                                    <td>Creditos</td>
                                    <td>Time</td>
                                </tr>
                            </thead>
                            <tbody>";

                    foreach ($matricula as $course) {
                        print "
                        <tr>
                            <td>" . $course['student_id'] . "</td>
                            <td>" . $course['course_id'] . "</td>
                            <td>" . $course['section_id'] . "</td>
                            <td>" . $course['credits'] . "</td>
                            <td>" . $course['time'] . "</td>
                        </tr>
                    ";
                    }

                    print "</tbody></table>";

                    print "<h3>Total de cursos matriculados exitosamente: " . count($matricula) . "</h3>";
                } else {
                    print "<h3>No hay cursos matriculados</h3>";
                }
            } else if (isset($_GET['prematricula'])) {
                $matricula = $_SESSION['user']->get_enroll(1);

                if ($matricula != null) {
                    print "
                        <table>
                            <thead>
                                <tr>
                                    <td>Numero de estudiante</td>
                                    <td>Curso</td>
                                    <td>Seccion</td>
                                    <td>Creditos</td>
                                    <td>Time</td>
                                </tr>
                            </thead>
                            <tbody>";

                    foreach ($matricula as $course) {
                        print "
                        <tr>
                            <td>" . $course['student_id'] . "</td>
                            <td>" . $course['course_id'] . "</td>
                            <td>" . $course['section_id'] . "</td>
                            <td>" . $course['credits'] . "</td>
                            <td>" . $course['time'] . "</td>
                        </tr>
                    ";
                    }

                    print "</tbody></table>";

                    print "<h3>Total de cursos solicitados: " . count($matricula) . "</h3>";
                } else {
                    print "<h3>No hay cursos solicitados</h3>";
                }
            } else if (isset($_GET['denegados'])) {
                $matricula = $_SESSION['user']->get_enroll(3);

                if ($matricula != null) {
                    print "
                        <table>
                            <thead>
                                <tr>
                                    <td>Numero de estudiante</td>
                                    <td>Curso</td>
                                    <td>Seccion</td>
                                    <td>Creditos</td>
                                    <td>Time</td>
                                </tr>
                            </thead>
                            <tbody>";

                    foreach ($matricula as $course) {
                        print "
                        <tr>
                            <td>" . $course['student_id'] . "</td>
                            <td>" . $course['course_id'] . "</td>
                            <td>" . $course['section_id'] . "</td>
                            <td>" . $course['credits'] . "</td>
                            <td>" . $course['time'] . "</td>
                        </tr>
                    ";
                    }

                    print "</tbody></table>";

                    print "<h3>Total de cursos Denegados: " . count($matricula) . "</h3>";
                } else {
                    print "<h3>No hay cursos Denegados</h3>";
                }
            }

            ?>
        </div>
    </div>
</body>

</html>