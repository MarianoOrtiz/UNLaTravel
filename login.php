<?php
//FRONT PARA INSERTAR UN ALOJAMIENTO A LA BD

include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioCiudad.inc.php';
include_once 'app/Ciudad.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/ValidadorLogin.inc.php';

/*if (ControlSesion::sesionIniciada()) {
    header("Location: index.html");
}*/

if (isset($_POST['login'])) {

    Conexion :: abrir_conexion();


    $validador = new ValidadorLogin($_POST['email'], $_POST['pass'], Conexion :: getConexion());

    if ($validador->getError() === '' && !is_null($validador->getUsuario())) {

        ControlSesion :: iniciarSesion($validador->getUsuario()->getIdUsuario(), $validador->getUsuario()->getNombre());
        if($validador->getUsuario()->getPerfil()=='1'){
            header("Location: vistaAdministrador.php");
        }else{if($validador->getUsuario()->getPerfil()=='2'){
            header("Location: reservaAlojamientos.php");
        }}
        
        
    }

    Conexion :: cerrar_conexion();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UNLaTravel - Ingresar</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!--===============================================================================================-->
    </head>
    <body>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form class="login100-form validate-form" ction=""<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <span class="login100-form-title p-b-34">
                            Ingresar a mi cuenta
                        </span>


                        <div class="wrap-input100 rs1-wrap-input120 validate-input m-b-20" data-validate="Ingrese un e-mail válido">
                            <input id="usuario" class="input100" type="email" name="email" minlength="13" maxlength="25" placeholder="Ingrese su e-mail" >
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 rs2-wrap-input120 validate-input m-b-20" data-validate="Ingrese una contraseña válida">
                            <input class="input100" type="password" name="pass" placeholder="Ingrese su contraseña" minlength="8" maxlength="15">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Ingresar
						</button>
					</div>
                      
                        <div class="w-full text-center p-t-27 p-b-239">
                            <span class="txt1">
                                Olvidé mi 
                            </span>

                            <a href="#" class="txt2">
                                contraseña
                            </a>
                        </div>

                        <div class="w-full text-center">
                            <a href="register.html" class="txt3">
                                Registrarse
                            </a>
                        </div>

                        <div class="w-full text-center">
                            <a href="index.html" class="txt3">
                                <- Atrás - Seguir mirando ofertas!
                            </a>
                        </div>
                    </form>

                    <div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
                </div>
            </div>
        </div>



        <div id="dropDownSelect1"></div>

        <!--===============================================================================================-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <script>
            $(".selection-2").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });
        </script>
        <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>

    </body>
</html>