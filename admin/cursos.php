<?php
include("../user.php");
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
}

header_remove();
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
        <h2>Cursos</h2>
        <button><a href="actions.php?logout">Logout</a></button>
    </header>

    <div class="container">
        <div class="card">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_GET['edit'])) {
                    $curso = $_SESSION['user']->get_course($_POST['id']);

                    if ($curso != null) {
                        print "
                            <form action='cursos.php?update' method='post'>
                                <input disabled type='text' maxlenght=8 value='" . $curso['course_id'] . "'>
                                <input type='hidden' value='" . $curso['course_id'] . "' name='id'>
                                <input type='text' value='" . $curso['title'] . "' name='title'>
                                <input type='number' value='" . $curso['credits'] . "' name='credits'>
                                <button type='submit'>Actualizar</button>
                                <button type='button'><a href='cursos.php?edit'>Cancelar</a></button>
                            </form>
                        ";
                    }
                } else if (isset($_GET['add'])) {
                    $course = array(
                        "id" => $_POST['id'],
                        "title" => $_POST['title'],
                        "credits" => $_POST['credits']
                    );

                    $_SESSION['user']->add_course($course);
                    header_remove();
                    header('Location: cursos.php');
                } else if (isset($_GET['update'])) {
                    $course = array(
                        "id" => $_POST['id'],
                        "title" => $_POST['title'],
                        "credits" => $_POST['credits']
                    );

                    $_SESSION['user']->update_course($course);
                    header_remove();
                    header('Location: cursos.php?edit');
                } else if (isset($_GET['delete'])) {
                    $curso = $_SESSION['user']->get_course($_POST['id']);

                    if ($curso != null) {
                        print "
                            <form action='cursos.php?final' method='post'>
                                <h2>Quieres eliminar el curso " . $curso['course_id'] . " y todos los elementos relacionados?</h2>
                                <input type='hidden' value='" . $curso['course_id'] . "' name='id'>
                                <button type='submit'>Eliminar</button>
                                <button><a href='cursos.php?edit'>Cancelar</a></button>
                            </form>
                        ";
                    }
                } else if (isset($_GET['final'])) {
                    $_SESSION['user']->delete_course($_POST['id']);
                    header_remove();
                    header('Location: cursos.php?edit');
                } else {
                    header('Location: cursos.php');
                }
            } else {
                $cursos = $_SESSION['user']->get_courses();

                if (isset($_GET['create'])) {
                    print "
                        <form action='cursos.php?add' method='post'>
                            <label>Id del Curso</label>
                            <input type='text' maxlenght=8 name='id'><br>

                            <label>Nombre del Curso</label>
                            <input type='text' name='title'><br>

                            <label>Creditos del Curso</label>
                            <input type='number' name='credits'><br>

                            <button type='submit'>Crear</button>
                            <button><a href='cursos.php'>Cancelar</a></button>
                        </form>
                    ";
                } else {
                    if ($cursos != null) {
                        if (isset($_GET['edit'])) {
                            print "
                            <table>
                                <thead>
                                    <tr>
                                        <td>Curso</td>
                                        <td>Nombre</td>
                                        <td>Creditos</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>
                                </thead>
                                <tbody>";

                            foreach ($cursos as $curso) {
                                print "
                                    <tr>
                                        <td>" . $curso['course_id'] . "</td>
                                        <td>" . $curso['title'] . "</td>
                                        <td>" . $curso['credits'] . "</td>
                                        <td>
                                            <form action='cursos.php?edit' method='post'>
                                                <input type='hidden' value='" . $curso['course_id'] . "' name='id'>
                                                <button><i class='fa-solid fa-pen-to-square'></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action='cursos.php?delete' method='post'>
                                                <input type='hidden' value='" . $curso['course_id'] . "' name='id'>
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
                                        <td>Curso</td>
                                        <td>Nombre</td>
                                        <td>Creditos</td>
                                    </tr>
                                </thead>
                                <tbody>";

                            foreach ($cursos as $curso) {
                                print "
                                    <tr>
                                        <td>" . $curso['course_id'] . "</td>
                                        <td>" . $curso['title'] . "</td>
                                        <td>" . $curso['credits'] . "</td>
                                    </tr>
                                ";
                            }

                            print "</tbody></table>";
                        }
                    } else {
                        print "<h3>No courses avaible</h3><button>Create Course</button>";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>

</html>