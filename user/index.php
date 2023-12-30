<?php
session_start();

if (!isset($_SESSION['username'])) {
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
    <link href="../css/user.css" rel="stylesheet" />
    <script src="../js/user.js"></script>
</head>

<body>
    <header>
        <h2>Bienvenido a la pagina de cursos de UPRA</h2>
    </header>

    <div class="container">
        <div class="main card">
            <div class="search-bar">
                <form>
                    <input type="text" placeholder="Buscar un curso y seccion..." name="search" />
                    <button type="submit"><i class="fa fa-search lupabtn"></i></button>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Seccion</th>
                        <th scope="col">Creditos</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Añadir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">No data</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="info">
            <div class="pm">
                <h5><?php $_SESSION['username'] ?></h5>
                <hr />

                <h5>Pre-matricula</h5>

                <table>
                    <thead>
                        <th>Eliminar</th>
                        <th>Curso - Seccion</th>
                        <th>Creditos</th>
                        <th>Estado</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">No data</td>
                        </tr>
                    </tbody>
                </table>
                <button class="pmbtn" onclick="showPopup()">Matricular Cursos</button>
            </div>

            <div class="popup-container" id="popup">
                <div class="popup-content">
                    <h4>Verfique su <br />pre-matricula</h4>
                    <hr />
                    <ol>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                    </ol>
                    <p>Total de creditos: 15</p>
                    <button class="pmbtn" onclick="goBack()">Atras</button>
                    <button class="pmbtn" onclick="goBack()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>