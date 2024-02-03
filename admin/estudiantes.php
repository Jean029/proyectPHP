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
        <h2>Administracion de cursos de UPRA</h2>
        <button><a href="actions.php?logout">Logout</a></button>
    </header>

    <div class="container">
        <div class="main card">
            <div class="search-bar">
                <form>
                    <input type="text" placeholder="Buscar..." name="search" />
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $users = $_SESSION['user']->users;

                    if ($users != null) {
                        foreach ($users as $user) {
                            print "
                                <tr>
                                    <td>" . $user['user']['student_id'] . "</td>
                                    <td>" . $user['user']['user_name'] . "</td>
                                    <td>X</td>
                                    <td>X</td>
                                    <td>
                                        <form action='estudiantes.php' method='post'>
                                            <button>Ver</button>
                                            <input type='hidden' value='" . $user['user']['student_id'] . "' name='id'>
                                        </form>
                                    </td>
                                </tr>
                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>

            <br>

            <table>
                <thead>
                    <tr>
                        <td>Student</td>
                        <td>Course</td>
                        <td>Section</td>
                        <td>Credits</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['id'])) {
                        foreach ($users as $user) {
                            if ($user['user']['student_id'] == $_POST['id']) {
                                $courses = $user['course'];

                                if ($courses != null) {
                                    foreach ($courses as $course) {
                                        print "
                                                <tr>
                                                    <td>" . $user['user']['user_name'] . "</td>
                                                    <td>" . $course['course_id'] . "</td>
                                                    <td>" . $course['section_id'] . "</td>
                                                    <td>" . $course['credits'] . "</td>
                                                    <td>" . $course['status'] . "</td>
                                                </tr>
                                            ";
                                    }
                                } else {
                                    print "<tr><td colspan='5'>No courses</td></tr>";
                                }
                            }
                        }
                    } else {
                        print "<tr><td colspan='5'>No user selected</td></tr>";
                    }
                    ?>
                </tbody>
            </table>


        </div>

    </div>
</body>

</html>