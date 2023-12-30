<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Inicio</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="admin.css" rel="stylesheet" />

</head>

<body>
    <header>
        <h2>Administracion de cursos de UPRA</h2>
    </header>

    <div class="container">
        <div class="main card">
            <div class="search-bar">
                <form>
                    <input type="text" placeholder="Buscar..." name="search" />
                    <button type="submit"><i class="fa fa-search lupabtn"></i></button>
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
                        <td colspan="7">No data</td>
                    </tr>
                </tbody>
            </table>

            <button class="pmbtn" id="addCourse"> Anadir nuevo curso</button>
            <div class="popup-container" id="popupCursos">
                <div class="popup-content">
                    <h4>Añadir nuevo curso</h4>
                    <hr />
                    <form>
                        <label for="curso">ID de Curso:</label>
                        <input type="text" placeholder="8 caracteres, ej: CCOM3001" id="curso" maxlength="8" />

                        <label for="secciones">Secciones:</label>
                        <input type="text" placeholder="M25, V40, L10" id="seccion" />

                        <label for="capacidad">Capacidad maxima:</label>
                        <input type="number" placeholder="0" id="capacidad" />


                    </form>
                    <button class="pmbtn" id="cancelar">Cancelar</button>
                    <button class="pmbtn">Guardar</button>
                </div>
            </div>

        </div>

        <div class="info">
            <div class="pm">
                <h5>Buscar estudiantes</h5>
                <div class="search-bar">
                    <form>
                        <input type="text" placeholder="Buscar..." name="search" />
                        <button type="submit"><i class="fa fa-search lupabtn"></i></button>
                    </form>


                    <table>
                        <thead>
                            <th>Apellido, Nombre</th>
                            <th># de estudiante</th>
                            <th>Ver</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">No data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="popup-container" id="popupEstudiante">
                <div class="popup-content">
                    <h4>pre-matricula de <br /> nombre apellido apellido</h4>
                    <hr />
                    <ol>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                        <li>CCOM3001 - M25</li>
                    </ol>
                    <p>Total de creditos: 15</p>
                    <button class="pmbtn" id="atras">Atras</button>
                    <button class="pmbtn" id="editar">Editar</button>
                    <button class="pmbtn" id="confirmar">Confirmar</button>
                </div>
            </div>
        </div>
        <script src="../js/admin.js">

        </script>
</body>

</html>