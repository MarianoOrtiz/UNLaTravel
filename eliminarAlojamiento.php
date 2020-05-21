<?php
//FRONT PARA INSERTAR UN ALOJAMIENTO A LA BD

include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioCiudad.inc.php';
include_once 'app/Ciudad.inc.php';

if(!empty($_POST)){
    Conexion :: abrir_conexion();
    $idAlojamiento = $_POST['iDAlojamiento'];
    
    $alojamientoEliminado = AbmAlojamiento :: eliminarAlojamiento(Conexion::getConexion(), $idAlojamiento);
    
    if($alojamientoEliminado){
       header("Location: listaAlojamientos.php");
    }
}


if(empty($_REQUEST['id'])){
    header("location: listaAlojamientos.php");
}else{
    Conexion :: abrir_conexion();
    $idAlojamiento =$_REQUEST['id'];
    $alojamiento = AbmAlojamiento :: getAlojamientoPorId2(Conexion::getConexion(), $idAlojamiento);
    
}

Conexion :: abrir_conexion();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UNLaTravel - Eliminar Alojamiento</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="images/png" href="images/icons/favicon.ico"/>
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
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <!--===============================================================================================-->
       <style type="text/css">
           table{
               border-collapse: collapse;
               font-size: 12pt;
               font-family: 'arial';
               width: 100%;
           }
           table th{
               text-align: left;
               padding: 10px;
               background: #3d7ba8;
               color: #FFF;
           }
           table tr:nth-child(odd){
               background: #FFF;
           }
           table td{
               padding: 10px;
           }
           .link-edit{
               color: #0ca4ce;
           }
           
           .link-delete{
               color: #f26b6b;
           }
           
           .data_delete{
               text-align: center;
           } 
           
           .data_delete h2{
               font-size: 12pt;
           }
           
           .data_delete span{
               font-weight: bold;
               color: #4f72d4;
               font-size: 12pt;
           }
           
           .btn_cancel, .btn_ok{
               width: 124px;
               background: #478ba2;
               color : #FFF;
               display: inline-block;
               padding: 5px;
               border-radius: 5px;
               cursor: pointer;
               margin:  15px;
           }
           
           .data_delete form{
               background: initial;
               margin: auto;
               padding: 20px 50px;
               border: 0;
           }
           
          
        </style>
    </head>

    <body>
         <?php include_once 'plantillas/navbar-Administrador.inc.php'; ?>
        <div class = "container">
            
            <div class="data_delete">
                <h2>¿Esta seguro de eliminar el alojamiento? </h2>
                <p>Nombre: <span><?php echo $alojamiento -> getNombre(); ?></span></p>
                <p>Email: <span><?php echo $alojamiento -> getEmail(); ?></span></p>   
                <form method="post" action="">
                    <input type="hidden" name="iDAlojamiento" value="<?php echo $alojamiento -> getId(); ?>">
                    <a href="listaAlojamientos.php" class="btn_cancel">Cancelar</a>
                    <input type="submit" value="Aceptar" class="btn_ok">
                </form>
                
            </div>
              
              
        </div>




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