 <?php

 session_start();

 if (isset($_SESSION['user_id'])) {
    header('Location: /s&r/index.php');
  }

 require 'assets/base_datos.php';


 if (!empty($_POST['correo_sesion']) && !empty($_POST['contrasena_sesion'])) {
 
    $records = $conn->prepare('SELECT codigo_usu, nombre_usu, correo_usu, contrasena_usu, codigo_carg FROM usuario WHERE correo_usu = :correo');
    $records->bindParam(':correo', $_POST['correo_sesion']);
    $records->execute();
    $rs = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

   if (count($rs) > 0 && password_verify($_POST['contrasena_sesion'], $rs['contrasena_usu'])) {
     $_SESSION['codigo_usuario'] = $rs['codigo_usu'];
     header('Location: /s&r/index.php');
   } else {
     $message ='Los Datos no Corresponden. Vuelva a intentar';
   }
 }


?>

<!DOCTYPE html>
<html lang="es">

 <head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Iniciar Sesíon</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

 </head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/logos/s&rlogo1 100x36.png" alt="S&R Sistema de Reportes">
                            </a>
                                <p>
                                    Sistema de Reportes
                                </p>
                        </div>

                        <?php if(!empty($message)): ?>
                               <p class="centrado"> <?= $message ?></p>
                         <?php endif; ?>

                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Direccion de Correo</label>
                                    <input class="au-input au-input--full" type="email" name="correo_sesion" placeholder="Correo">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="au-input au-input--full" type="password" name="contrasena_sesion" placeholder="Contraseña">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="recuerdame">Recuerdame
                                    </label>
                                    <label>
                                        <a href="olvidar_contrasena.php">Olvidé mi Contraseña</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">iniciar sesion</button>
                               
                            </form>
                            <div class="register-link">
                                <p>
                                    No Tienes Usuario?
                                    <a href="usuario.php">Registrate Aqui</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

 </body>

 </html>