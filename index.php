<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title>Pre-Matricula Ingreso</title>

  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
  <link href="css/template.css" rel="stylesheet" />
</head>

<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <?php

  /*
  Errors list:
  Error 0: Wrong access
  Error 1: User not found
  Error 2: Wrong password

  Error register 1: User already exists
  */

  $error = "";

  if (isset($_GET['register'])) {
    /*
    Register form
    Redirect to register.php
    Method: Post
    Data: Username, Password, Year of study, Number of student
    */

    if (isset($_GET['error'])) {
      if ($_GET['error'] == 1) {
        $error = "User exists";
      }
    }

    print '
    <form method="post" action="register.php" id="registro">
      <h3>Registro</h3>

      <h3>' . $error . '</h3>

      <label for="numEst">Numero de Estudiante</label>
      <input type="text" placeholder="123-45-6789" name="numest" id="numEst" maxlength="11" required />

      <label for="nombre">Nombre</label>
      <input type="text" placeholder="nombre completo" name="name" id="nombre" required />

      <label for="Aestudio">Año de Estudio</label>
      <input type="number" placeholder="año actual de estudio" name="aestudio" id="Aestudio" required />

      <label for="password" id="passLabel">Contraseña</label>
      <input type="password" placeholder="contraseña" name="password" id="password" minlength="8" required />

      <button>Entrar</button>
      <button type="button"><a href="index.php">Ingresar</a></button>
    </form>
    ';
  } else {
    /*
    Login form
    Redirects to login.php
    Method: Post
    Data: Username, Password
    */

    if (isset($_GET['error'])) {
      if ($_GET['error'] == 1) {
        $error = "User not found";
      } else if ($_GET['error'] == 2) {
        $error = "Wrong password";
      }
    }

    print '
    <form method="post" action="login.php">
      <h3>Ingresar</h3>

      <h3>' . $error . '</h3>

      <label for="numEst">Numero de Estudiante</label>
      <input type="text" placeholder="123-45-6789" id="numEst" name="numest" maxlength="11" required />

      <label for="password">Contraseña</label>
      <input type="password" placeholder="contraseña" id="password" name="password" required />

      <button>Entrar</button>
      <button><a href="index.php?register">Registrarse</a></button>
    </form>
    ';
  }
  ?>
  <script src="js/main.js"></script>
</body>

</html>