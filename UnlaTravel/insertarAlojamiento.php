
<?php
//FRONT PARA INSERTAR UN ALOJAMIENTO A LA BD
include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    Conexion :: abrir_conexion();
    $validador = new ValidadorAlojamiento($_POST['nombre'], $_POST['emailAlojamiento'], $_POST['cantidad'], Conexion :: getConexion());
    
    if ($validador->registroValidado()) {
        
        
        $alojamiento = new Alojamiento('', $validador->getNombre(), $validador->getEmail(), $validador->getCantidadHabitaciones());
        
        $alojamiento_insertado = AbmAlojamiento :: insertarAlojamiento(Conexion :: getConexion(), $alojamiento);
       
        if ($alojamiento_insertado) {
           // Redireccion :: redirigir(RUTA_REGISTRO_CORRECTO . '?nombre=' . $alojamiento -> getNombreAlojamiento());
        }
    }
    Conexion :: cerrar_conexion();
}


include_once 'plantillas/navbar.inc.php';
?>
<!Html de Registro>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registro</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/estilos.css" rel="stylesheet">

        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <style type="text/css">
            body{
                color: #fff;
                background: #63738a;
                font-family: 'Roboto', sans-serif;
            }
            .form-control{
                height: 40px;
                box-shadow: none;
                color: #969fa4;
            }
            .form-control:focus{
                border-color: #5cb85c;
            }
            .form-control, .btn{        
                border-radius: 3px;
            }
            .signup-form{
                width: 400px;
                margin: 0 auto;
                padding: 30px 0;
            }
            .signup-form h2{
                color: #636363;
                margin: 0 0 15px;
                position: relative;
                text-align: center;
            }
            .signup-form h2:before, .signup-form h2:after{
                content: "";
                height: 2px;
                width: 30%;
                background: #d4d4d4;
                position: absolute;
                top: 50%;
                z-index: 2;
            }	
            .signup-form h2:before{
                left: 0;
            }
            .signup-form h2:after{
                right: 0;
            }
            .signup-form .hint-text{
                color: #999;
                margin-bottom: 30px;
                text-align: center;
            }
            .signup-form form{
                color: #999;
                border-radius: 3px;
                margin-bottom: 15px;
                background: #f2f3f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .signup-form .form-group{
                margin-bottom: 20px;
            }
            .signup-form input[type="checkbox"]{
                margin-top: 3px;
            }
            .signup-form .btn{        
                font-size: 16px;
                font-weight: bold;		
                min-width: 140px;
                outline: none !important;
            }
            .signup-form .row div:first-child{
                padding-right: 10px;
            }
            .signup-form .row div:last-child{
                padding-left: 10px;
            }    	
            .signup-form a{
                color: #fff;
                text-decoration: underline;
            }
            .signup-form a:hover{
                text-decoration: none;
            }
            .signup-form form a{
                color: #5cb85c;
                text-decoration: none;
            }	
            .signup-form form a:hover{
                text-decoration: underline;
            }  
        </style>
    </head>
    <body>    
        <div class="signup-form">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <?php
                if (isset($_POST['enviar'])) {
                    include_once 'plantillas/registro_validado.inc.php';
                } else {
                    include_once 'plantillas/registro_vacio.inc.php';
                }
                ?>
            </form>
            <div class="text-center">¿Ya tiene una cuenta? <a href="login.php">Iniciar Sesión</a></div>
        </div>

        <?php
        include_once 'plantillas/documento-cierre.inc.php';
        ?>