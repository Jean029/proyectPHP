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
        <div class="card">
            <h2>Cursos Activos</h2>
            <button><a href="cursos.php">Ver Cursos</a></button>
            <button><a href="cursos.php?edit">Editar Cursos</a></button>
            <button><a href="cursos.php?create">Crear Curso</a></button>
        </div>
        <div class="card">
            <h2>Estudiantes activos</h2>
            <button><a>Ver Estudiantes</a></button>
            <button><a>Editar Estudiantes</a></button>
            <button><a>Crear Estudiante</a></button>
        </div>
        <div class="card">
            <h2>Reportes</h2>
            <button><a>Cursos</a></button>
            <button><a>Matricula</a></button>
            <button><a>Prematricula</a></button>
            <button><a>Denegados</a></button>
        </div>
    </div>
</body>

</html>