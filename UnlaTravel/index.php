<?php include ("conexion.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <?php include_once ("includes/header.php")?>
    <title>Registro de Alojamiento</title>
</head>
<body>
    <div>
        <form action="registro-usuario.php" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h1>Registro de Alojamiento</h1>
                        <label for="nombre"><b>Nombre de Alojamiento</b></label>
                        <input class="form-control" id="nombreAlojamiento" type="text" name="nombre" required>

                     
                        <label for="email"><b>E-mail</b></label>
                        <input class="form-control" id="emailAlojamiento" type="email" name="email" required>

                       
                        <hr class="mb-3">
                        <input class="btn btn-primary" type="submit" id="registrar" name="registrar" value="Registrar"> 
     
                    </div>
                </div>
            </div>
         
        </form>    
    </div>
    <?php include ("includes/footer.php")?>
</body>
</html>
