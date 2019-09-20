<?php

  require 'assets/base_datos.php';

  $message = '';


  if (!empty($_POST['nombre_usuario']) && !empty($_POST['correo_usuario']) && !empty($_POST['contrasena_usuario']) && !empty($_POST['cargo_usuario']) && isset($_REQUEST['acepto_usuario'])) {
    $sql = "INSERT INTO usuario (nombre_usu, correo_usu, contrasena_usu, codigo_carg) VALUES (:nombre, :correo, :contrasena, :cargo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre_usuario']);
    $stmt->bindParam(':correo', $_POST['correo_usuario']);
    $contrasena = password_hash($_POST['contrasena_usuario'], PASSWORD_BCRYPT);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':cargo', $_POST['cargo_usuario']);

    if ($stmt->execute()) {
      $message = 'Usuario Creado Satisfactoriamente';
    } else {
      $message = 'Disculpa, Hubo un Error al crear su Usuario. Vuelva a intentarlo';
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
    <title>Registrar Usuario</title>

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
                               
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
                            
                        </div>
                        <div class="login-form">
                            <form action="" method="post">

                                <div class="form-group">
                                    <label>Nombre de Usuario</label>
                                    <input class="au-input au-input--full" type="text" name="nombre_usuario" placeholder="Nombre de Usuario">
                                </div>

                                <div class="form-group">
                                    <label>Dirección de Correo</label>
                                    <input class="au-input au-input--full" type="email" name="correo_usuario" placeholder="Dirección de Correo">
                                </div>

                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="au-input au-input--full" type="password" name="contrasena_usuario" placeholder="Contrasena">
                                </div>
                                
                                <div class="form-group">
                                    <label>Cargo del Usuario</label>
                                    <select name='cargo_usuario'id=''>
                                        <?php
                                        $sql= "SELECT codigo_carg, nombre_carg FROM cargo";
                                        $stmt = $conn->prepare($sql);
                                        $rs = $stmt->execute();

                                        $rows=$stmt-> fetchAll(\PDO::FETCH_OBJ);
                                        foreach($rows as $row){
                                            ?>  
                                            <option value="<?php print($row->codigo_carg);?>"><?php print($row->nombre_carg);?></option>
                                            <?php
                                         }

                                        ?>
                                  
                                    </select>
                                </div>
                                
                                
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="acepto_usuario">Acepto los términos y las políticas
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">registrar</button>
                                
                            </form>
                            <div class="register-link">
                                <p>
                                    Ya cuenta con Usuario?
                                    <a href="iniciar_sesion.php">Inicie Sesión</a>
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
<!-- end document-->