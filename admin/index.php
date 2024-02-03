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
                        <th scope="col">Curso</th>
                        <th scope="col">Seccion</th>
                        <th scope="col">Credito</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>CCOM3001</td>
                        <td>M25</td>
                        <td>3</td>
                        <td>20/20</td>
                        <td><button class="fa fa-trash"></button></td>
                        <td>
                            <button class="fa fa-edit" onclick="
                showCourse()"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>CCOM3001</td>
                        <td>M25</td>
                        <td>3</td>
                        <td>20/20</td>
                        <td><button class="fa fa-trash"></button></td>
                        <td>
                            <button class="fa fa-edit" onclick="
                showCourse()"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>CCOM3001</td>
                        <td>M25</td>
                        <td>3</td>
                        <td>20/20</td>
                        <td><button class="fa fa-trash"></button></td>
                        <td>
                            <button class="fa fa-edit" onclick="
                showCourse()"></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="crbtn" onclick="showForm()">Anadir nuevo curso</button>

            <div class="courseForm" id="courseForm" style="display: none">
                <br />
                <h4>Añadir nuevo curso</h4>
                <hr />
                <form>
                    <label for="curso">ID de Curso:</label>
                    <input type="text" placeholder="8 caracteres, ej: CCOM3001" id="curso" maxlength="8" /><br />
                    <label for="secciones">Secciones:</label>
                    <input type="text" placeholder="M25, V40, L10" id="seccion" />
                    <br />
                    <label for="capacidad">Capacidad maxima:</label>

                    <input type="number" placeholder="0" id="capacidad" /><br />
                </form>
                <button class="pmbtn" onclick="cancelForm()">Cancelar</button>
                <button class="pmbtn">Guardar</button>
            </div>

            <div class="editCourse" id="editCourse" style="display: none">
                <br />
                <h4>Editar Curso</h4>
                <hr />
                <form>
                    <label for="curso">curso seleccionado:</label>
                    <span>ccom3001</span><br />
                    <label for="secciones">seccion seleccionada:</label>
                    <span> M25 </span>
                    <br />
                    <label for="capacidad">cambiar seccion:</label>
                    <input type="text" placeholder="l10" id="section" maxlength="3" /><br />
                    <label for="capacidad">cambiar capacidad:</label>
                    <input type="number" placeholder="0" id="capacity" /><br />
                </form>
                <button class="pmbtn" onclick="cancelCourse()">Cancelar</button>
                <button class="pmbtn">Guardar</button>
            </div>
        </div>
        <div class="container2">
            <div class="info">
                <div class="pm">
                    <h5>Ver estudiantes activos</h5>
                    <button><a href="estudiantes.php">Ver</a></button>
                </div>
            </div>
            <div class="report card">
                <h3>Reportes</h3>
                <hr />
                <div class="options">
                    <h5>Ver reportes por:</h5>
                    <button class="pmbtn" onclick="showTable('curso-seccion')">
                        Reporte por Curso - Seccion
                    </button>
                    <button class="pmbtn" onclick="showTable('matriculados')">
                        Reporte por Matriculados
                    </button>
                    <button class="pmbtn" onclick="showTable('prematriculados')">
                        Reporte por Prematriculados
                    </button>
                    <button class="pmbtn" onclick="showTable('denegados')">
                        Reporte por Denegados
                    </button>
                </div>
                <div class="results">
                    <div class="search-bar">
                        <form>
                            <input type="text" placeholder="Buscar..." name="search" />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- tabla curso seccion-->
                    <table id="curso-seccion" style="display: none">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Curso - Seccion</th>
                                <th scope="col">Matriculados</th>
                                <th scope="col">Prematriculados</th>
                                <th scope="col">Capacidad total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>CCOM3001 - M25</td>
                                <td>10</td>
                                <td>15</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>CCOM3001 - M25</td>
                                <td>10</td>
                                <td>15</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>CCOM3001 - M25</td>
                                <td>10</td>
                                <td>15</td>
                                <td>25</td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <!-- tabla matriculados-->

                    <table id="matriculados" style="display: none">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre, Apellido</th>
                                <th scope="col"># clases</th>
                                <th scope="col"># creditos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>pepito, felin</td>
                                <td>4</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>pepito, felin</td>
                                <td>4</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>pepito, felin</td>
                                <td>4</td>
                                <td>12</td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                    <!-- tabla prematriculados-->
                    <table id="prematriculados" style="display: none">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre, Apellido</th>
                                <th scope="col"># clases</th>
                                <th scope="col"># creditos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>pepito, felin</td>
                                <td>4</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>pepito, felin</td>
                                <td>4</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>pepito, felin</td>
                                <td>4</td>
                                <td>12</td>
                            </tr>
                        </tbody>
                        <button class="pmbtn">Matricular a todos</button>
                    </table>
                    <br />

                    <!-- tabla denegados-->

                    <table id="denegados" style="display: none">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre, Apellido</th>
                                <th scope="col">curso - seccion</th>
                                <th scope="col">razon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>pepito, felin</td>
                                <td>ccom3001 - l10</td>
                                <td>no confirmo matricula</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>pepito, felin</td>
                                <td>ccom3001 - l10</td>
                                <td>cancelacion de cupo</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>pepito, felin</td>
                                <td>ccom3001 - l10</td>
                                <td>cancelacion de curso/seccion</td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                </div>
            </div>
        </div>
    </div>
</body>

</html>