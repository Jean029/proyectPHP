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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="../css/admin.css" rel="stylesheet" />
    <script src="../js/main.js"></script>

</head>

<body>
    <header>
        <button><a href="index.php">Home</a></button>
        <h2>Estudiantes</h2>
        <button><a href="actions.php?logout">Logout</a></button>
    </header>

    <div class="container">
        <div class="card">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_GET['edit'])) {
                    $student = $_SESSION['user']->get_user($_POST['id']);

                    if ($student != null) {
                        print "
                            <form action='estudiantes.php?update' method='post'>
                                <input type='hidden' value='" . $student['student_id'] . "' name='id'>
                                <input type='text' disabled value='" . $student['student_id'] . "'>
                                <input type='text' value='" . $student['user_name'] . "' name='username'>
                                <input type='number' value='" . $student['year_of_study'] . "' name='year'>
                                <button type='submit'>Actualizar</button>
                                <button type='button'><a href='estudiantes.php?edit'>Cancelar</a></button>
                            </form>
                        ";
                    }
                } else if (isset($_GET['update'])) {
                    $user = array(
                        "id" => $_POST['id'],
                        "username" => $_POST['username'],
                        "year" => $_POST['year']
                    );

                    $_SESSION['user']->update_user($user);
                    header_remove();
                    header("Location: estudiantes.php?edit");
                } else if (isset($_GET['add'])) {
                    $user = array(
                        "id" => $_POST['id'],
                        "username" => $_POST['username'],
                        "year" => $_POST['year']
                    );

                    $_SESSION['user']->add_user($user);
                    header_remove();
                    header("Location: estudiantes.php");
                } else if (isset($_GET['delete'])) {
                    $student = $_SESSION['user']->get_user($_POST['id']);

                    if ($student != null) {
                        print "
                            <h2>Quieres eliminar al usuario " . $student['user_name'] . "</h2>

                            <form action='estudiantes.php?final' method='post'>
                                <input type='hidden' value='" . $student['student_id'] . "' name='id'>
                                <button type='submit'>ELiminar</button>
                                <button><a href='estudiantes.php?edit'>Cancelar</a></button>
                            </form>
                        ";
                    }
                } else if (isset($_GET['final'])) {
                    $_SESSION['user']->delete_user($_POST['id']);
                    header_remove();
                    header("Location: estudiantes.php?edit");
                } else if (isset($_GET['courses'])) {
                    $courses = $_SESSION['user']->get_userCourses($_POST['id']);

                    if ($courses != null) {
                        print "
                            <table>
                                <thead>
                                    <tr>
                                        <td>Course</td>
                                        <td>Section</td>
                                        <td>Credits</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>";

                        foreach ($courses as $course) {
                            $status = "solicitado";

                            if ($course['status'] == 2) {
                                $status = "matriculado";
                            } else if ($course['status'] == 3) {
                                $status = "Denegado";
                            }
                            print "
                                <tr>
                                    <td>" . $course['course_id'] . "</td>
                                    <td>" . $course['section_id'] . "</td>
                                    <td>" . $course['credits'] . "</td>
                                    <td>" . $status . "</td>
                                </tr>
                            ";
                        }

                        print "</tbody></table>";
                    } else {
                        print "<h3>No hay cursos matriculados</h3>";
                    }

                    print "<button><a href='estudiantes.php?edit'>Volver</a></button>";
                }
            } else {
                $usuarios = $_SESSION['user']->get_users();

                if (isset($_GET['create'])) {
                    print "
                        <form action='estudiantes.php?add' method='post'>
                            <label>Numero de estudiante</label>
                            <input type='text' maxlenght='8' name='id'><br>

                            <label>Nombre Completo</label>
                            <input type'text' name='username'><br>

                            <label>Tiempo de estudio</label>
                            <input type='number' min=1 name='year'><br>

                            <button type='submit'>Crear</button>
                            <button><a href='estudiantes.php'>Cancelar</a></button>
                        </form>
                    ";
                } else if (isset($_GET['matricular'])) {
                    print "
                        <h3>Desea matricular los cursos solicitados?</h3>
                        <button><a href='estudiantes.php?aceptar'>Si</a></button>
                        <button><a href='../admin/'>No</a></button>
                        ";
                } else if (isset($_GET['aceptar'])) {
                    $_SESSION['user']->enroll();
                    $_SESSION['user']->close_enroll();
                    header("Location: ../admin/");
                } else {
                    if ($usuarios != null) {
                        if (isset($_GET['edit'])) {
                            print "
                                <table>
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Nombre</td>
                                            <td>Tiempo de estudio</td>
                                            <td>Cursos</td>
                                            <td>Editar</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";

                            foreach ($usuarios as $usuario) {
                                print "
                                    <tr>
                                        <td>" . $usuario['user']['student_id'] . "</td>
                                        <td>" . $usuario['user']['user_name'] . "</td>
                                        <td>" . $usuario['user']['year_of_study'] . "</td>
                                        <td>
                                            <form action='estudiantes.php?courses' method='post'>
                                                <input type='hidden' value='" . $usuario['user']['student_id'] . "' name='id'>
                                                <button><i class='fa-solid fa-eye'></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action='estudiantes.php?edit' method='post'>
                                                <input type='hidden' value='" . $usuario['user']['student_id'] . "' name='id'>
                                                <button><i class='fa-solid fa-pen-to-square'></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action='estudiantes.php?delete' method='post'>
                                                <input type='hidden' value='" . $usuario['user']['student_id'] . "' name='id'>
                                                <button><i class='fa-solid fa-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                ";
                            }

                            print "</tbody></table>";
                        } else {
                            print "
                                <table>
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Nombre</td>
                                            <td>Tiempo de estudio</td>
                                            <td>Cursos</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    ";

                            foreach ($usuarios as $usuario) {
                                print "
                                    <tr>
                                        <td>" . $usuario['user']['student_id'] . "</td>
                                        <td>" . $usuario['user']['user_name'] . "</td>
                                        <td>" . $usuario['user']['year_of_study'] . "</td>
                                        <td>
                                            <form action='estudiantes.php?courses' method='post'>
                                                <input type='hidden' value='" . $usuario['user']['student_id'] . "' name='id'>
                                                <button><i class='fa-solid fa-eye'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                ";
                            }

                            print "</tbody></table>";
                        }
                    } else {
                        print "<h3>No hay usuarios registrados</h3><button><a href='index.php'>Home</a></button>";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>

</html>