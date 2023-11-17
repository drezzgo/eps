<?php
    session_start();
    include('assets/inc/config.php'); // obtén el archivo de configuración
    if(isset($_POST['admin_login']))
    {
        $ad_email=$_POST['ad_email'];
        $ad_pwd=sha1(md5($_POST['ad_pwd'])); // cifrado doble para aumentar la seguridad
        $stmt=$mysqli->prepare("SELECT ad_email ,ad_pwd , ad_id FROM his_admin WHERE ad_email=? AND ad_pwd=? "); // SQL para iniciar sesión
        $stmt->bind_param('ss',$ad_email,$ad_pwd); // vincular parámetros obtenidos
        $stmt->execute(); // ejecutar vinculación
        $stmt -> bind_result($ad_email,$ad_pwd,$ad_id); // vincular resultado
        $rs=$stmt->fetch();
        $_SESSION['ad_id']=$ad_id; // Asignar sesión al id del administrador
        //$uip=$_SERVER['REMOTE_ADDR'];
        //$ldate=date('d/m/Y h:i:s', time());
        if($rs)
            {// si es exitoso
                header("location:his_admin_dashboard.php");
            }
        else
            {
                $err = "Acceso denegado. Por favor, verifica tus credenciales.";
            }
    }
?>
<!-- Fin de Inicio de Sesión -->

<!DOCTYPE html>
<html lang="es">
    
<head>
        <meta charset="utf-8" />
        <title>Sistema de Gestión Hospitalaria - Un sistema de información super receptivo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Favicon de la aplicación -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- CSS de la aplicación -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- Cargar Sweet Alert JavaScript -->
        
        <script src="assets/js/swal.js"></script>
        <!-- Inyectar SWAL -->
        <?php if(isset($success)) {?>
        <!-- Este código es para inyectar una alerta -->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Éxito","<?php echo $success;?>","success");
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!-- Este código es para inyectar una alerta -->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Falló","<?php echo $err;?>","Falló");
                            },
                                100);
                </script>

        <?php } ?>
    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index.php">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Ingresa tu dirección de correo electrónico y contraseña para acceder al panel de administración.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Dirección de correo electrónico</label>
                                        <input class="form-control" name="ad_email" type="email" id="emailaddress" required="" placeholder="Ingresa tu correo electrónico">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Contraseña</label>
                                        <input class="form-control" name="ad_pwd" type="password" required="" id="password" placeholder="Ingresa tu contraseña">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" name="admin_login" type="submit"> Iniciar Sesión de Administrador </button>
                                    </div>

                                </form>

                            </div> <!-- fin card-body -->
                        </div>
                        <!-- fin card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="his_admin_pwd_reset.php" class="text-white-50 ml-1">¿Olvidaste tu contraseña?</a></p>
                               <!-- <p class="text-white-50">¿No tienes una cuenta? <a href="his_admin_register.php" class="text-white ml-1"><b>Registrarse</b></a></p>-->
                            </div> <!-- fin col -->
                        </div>
                        <!-- fin row -->

                    </div> <!-- fin col -->
                </div>
                <!-- fin row -->
            </div>
            <!-- fin container -->
        </div>
        <!-- fin de la página -->


        <?php include ("assets/inc/footer1.php");?>

        <!-- Archivos js de proveedores -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- Archivo js de la aplicación -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>
