<?php

class AbmAlojamiento {

    public static function getAlojamientos($conexion) {
        $alojamientos = array();

        if (isset($conexion)) {

            try {
                include_once 'Alojamiento.inc.php';

                $sql = "SELEC * FROM alojamiento";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $alojamientos[] = new Alojamiento(
                                $fila['idAlojamiento'], $fila['nombre'], $fila['categoria'], $fila['cantidadHabInd'], $fila['cantidadHabDob'], $fila['servicio'], $fila['tipoPendion'], $fila['ciudad'], $fila['email'], $fila['regimen']);
                    }
                } else {
                    print "La tabla Alojamientos esta vacía";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $alojamientos;
    }

    public static function getAlojamientos2($conexion) {
        $alojamientos = array();

        if (isset($conexion)) {

            try {
                include_once 'Alojamiento.inc.php';

                $sql = "SELECT a.idAlojamiento, a.nombre, a.categoria, a.cantidadHabInd, a.cantidadHabDob, a.regimen, a.email, c.nombreCiudad, a.precio
FROM alojamiento a
JOIN ciudad c
ON a.Ciudad_idCiudad = c.idCiudad;";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {

                        $alojamientos[] = new Alojamiento(
                                $fila['idAlojamiento'], $fila['nombre'], $fila['categoria'], $fila['cantidadHabInd'], $fila['cantidadHabDob'], "", $fila['nombreCiudad'], $fila['email'], $fila['regimen'], $fila['precio']);
                    }
                } else {
                    print "La tabla Alojamientos esta vacía";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $alojamientos;
    }

    public static function insertarAlojamiento($conexion, $alojamiento, $checkbox) {
        $alojamiento_insertado = false;

        if (isset($conexion)) {
            try {

                $sql = "INSERT INTO alojamiento(nombre,  categoria, cantidadHabInd, cantidadHabDob,  Ciudad_idCiudad, email, regimen, precio) VALUES(:nombre, :categoria, :cantidadHabInd, :cantidadHabDob, :ciudad, :email, :regimen, :precio)";

                $nombretmp = $alojamiento->getNombre();
                $categoriatmp = $alojamiento->getCategoria();
                $cantidadHabIndtmp = $alojamiento->getCantidadHabInd();
                $cantidadHabDobtmp = $alojamiento->getCantidadHabDob();
                $serviciotmp = $alojamiento->getServicio();
                $preciotmp = $alojamiento->getprecio();



                $ciudadtmp = $alojamiento->getCiudad();
                $emailtmp = $alojamiento->getEmail();
                $regimentmp = $alojamiento->getRegimen();

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':nombre', $nombretmp, PDO::PARAM_STR);
                $sentencia->bindParam(':categoria', $categoriatmp, PDO::PARAM_STR);
                $sentencia->bindParam(':cantidadHabInd', $cantidadHabIndtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':cantidadHabDob', $cantidadHabDobtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':ciudad', $ciudadtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $emailtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':regimen', $regimentmp, PDO::PARAM_STR);
                $sentencia->bindParam(':precio', $preciotmp, PDO::PARAM_STR);

                //insertar servicios y alojamientos en tabla intermedia
                $alojamiento_insertado = $sentencia->execute();
                $lastInsertId = $conexion->lastInsertId();
                foreach ($checkbox as $check) {

                    self::insertarServicios($conexion, $lastInsertId, $check);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $alojamiento_insertado;
    }

    public static function insertarServicios($conexion, $idAlojamiento, $checkbox) {


        if (isset($conexion)) {
            try {


                $sql = "INSERT INTO alojamiento_has_servicio(alojamiento_idAlojamiento, servicio_idServicio) VALUES(:idAlojamiento, :servicio)";


                $checkboxtmp = $checkbox;
                $idAlojamientotmp = $idAlojamiento;
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idAlojamiento', $idAlojamientotmp, PDO::PARAM_STR);
                $sentencia->bindParam(':servicio', $checkboxtmp, PDO::PARAM_STR);




                $servicio_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $servicio_insertado;
    }

    public static function getAlojamientoPorId($conexion, $idAlojamiento) {
        $alojamiento = null;

        if (isset($conexion)) {
            try {

                include_once 'Alojamiento.inc.php';

                $sql = "SELECT * FROM alojamiento WHERE idAlojamiento = :idAlojamiento";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idAlojamiento', $idAlojamiento, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {

                    $alojamiento = new Alojamiento(
                            $resultado['idAlojamiento'], $resultado['nombre'], $resultado['categoria'], $resultado['cantidadHabInd'], $resultado['cantidadHabDob'], $resultado['servicio'], $resultado['tipoPendion'], $resultado['ciudad'], $resultado['email'], $resultado['regimen']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $alojamiento;
    }

    public static function getAlojamientoPorId2($conexion, $idAlojamiento) {
        $alojamiento = null;


        if (isset($conexion)) {
            try {

                include_once 'Alojamiento.inc.php';

                $sql = "SELECT a.idAlojamiento, a.nombre, a.categoria, a.cantidadHabInd, a.cantidadHabDob, a.regimen, a.email, c.nombreCiudad, a.precio
                        FROM alojamiento a
                        JOIN ciudad c
                        ON a.Ciudad_idCiudad = c.idCiudad
                        WHERE a.idAlojamiento = :idAlojamiento;";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idAlojamiento', $idAlojamiento, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {

                    $alojamiento = new Alojamiento(
                            $resultado['idAlojamiento'], $resultado['nombre'], $resultado['categoria'], $resultado['cantidadHabInd'], $resultado['cantidadHabDob'], "", $resultado['nombreCiudad'], $resultado['email'], $resultado['regimen'], $resultado['precio']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $alojamiento;
    }

    //lo utilizamos para validar que no exista dos alojamientos con el mismo email
    public static function existeEmailAlojamiento($conexion, $email) {
        $existeEmail = true;

        if (isset($conexion)) {
            try {
                $sql = "SELECT email FROM alojamiento WHERE email = :email";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':email', $email, PDO::PARAM_STR);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();


                if (count($resultado)) {

                    $existeEmail = true;
                } else {
                    $existeEmail = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }

        return $existeEmail;
    }

    public static function listarAlojamientos($conexion) {
        $alojamientos = self::getAlojamientos2($conexion);

        if (count($alojamientos)) {
            foreach ($alojamientos as $alojamiento) {

                self::listarAlojamiento($alojamiento);
            }
        }
    }

    public static function listarAlojamiento($alojamiento) {
        if (!isset($alojamiento)) {
            return;
        }
        ?>

        <tr>
            <td><?php echo $alojamiento->getId(); ?></td>
            <td><?php echo $alojamiento->getNombre(); ?></td>
            <td><?php echo $alojamiento->getCategoria(); ?></td>
            <td><?php echo $alojamiento->getCantidadHabInd(); ?></td>
            <td><?php echo $alojamiento->getCantidadHabDob(); ?></td>
            <td><?php echo $alojamiento->getCiudad(); ?></td>
            <td><?php echo $alojamiento->getRegimen(); ?></td>
            <td><?php echo $alojamiento->getEmail(); ?></td>
            <td>
                <a class="link-edit" href ="modificarAlojamientos.php?id=<?php echo $alojamiento->getId(); ?> ">Editar</a>     
                <a class="link-delete" href ="eliminarAlojamiento.php?id=<?php echo $alojamiento->getId(); ?>">Eliminar</a>  
            </td>
        </tr>
        <?php
    }

    public static function modificarAlojamiento($conexion, $alojamiento, $checkbox) {
        $alojamiento_insertado = false;

        if (isset($conexion)) {
            try {
                $sql = "UPDATE alojamiento SET nombre = :nombre, categoria = :categoria, cantidadHabInd = :cantidadHabInd, cantidadHabDob = :cantidadHabDob,  Ciudad_idCiudad = :ciudad , email = :email, regimen = :regimen, precio = :precio WHERE (idAlojamiento = :idAlojamiento)";

                $nombretmp = $alojamiento->getNombre();

                $categoriatmp = $alojamiento->getCategoria();
                $cantidadHabIndtmp = $alojamiento->getCantidadHabInd();
                $cantidadHabDobtmp = $alojamiento->getCantidadHabDob();
                $idAlojamientotmp = $alojamiento->getId();

                $ciudadtmp = $alojamiento->getCiudad();
                $emailtmp = $alojamiento->getEmail();
                $regimentmp = $alojamiento->getRegimen();   
                $preciotmp = $alojamiento->getPrecio();
                
                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idAlojamiento', $idAlojamientotmp, PDO::PARAM_STR);
                $sentencia->bindParam(':nombre', $nombretmp, PDO::PARAM_STR);
                $sentencia->bindParam(':categoria', $categoriatmp, PDO::PARAM_STR);
                $sentencia->bindParam(':cantidadHabInd', $cantidadHabIndtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':cantidadHabDob', $cantidadHabDobtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':ciudad', $ciudadtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $emailtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':regimen', $regimentmp, PDO::PARAM_STR);
                $sentencia->bindParam(':precio', $preciotmp, PDO::PARAM_STR);
                //insertar servicios y alojamientos en tabla intermedia
                $alojamiento_insertado = $sentencia->execute();

                $sqlServicios = "DELETE FROM alojamiento_has_servicio WHERE alojamiento_idAlojamiento = :idAlojamientoServicios";
                $sentencia2 = $conexion->prepare($sqlServicios);
                $sentencia2->bindParam(':idAlojamientoServicios', $idAlojamientotmp, PDO::PARAM_STR);
                $serviciosBorrados = $sentencia2->execute();

                foreach ($checkbox as $check) {

                    self::insertarServicios($conexion, $idAlojamientotmp, $check);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $alojamiento_insertado;
    }

    public static function eliminarAlojamiento($conexion, $idAlojamiento) {
        $alojamientoEliminado = true;

        if (isset($conexion)) {

            try {
                include_once 'Alojamiento.inc.php';
                //Borramos los servicios asociados
                $sqlServicios = "DELETE FROM alojamiento_has_servicio WHERE alojamiento_idAlojamiento = :idAlojamientoServicios";
                $sentencia2 = $conexion->prepare($sqlServicios);
                $sentencia2->bindParam(':idAlojamientoServicios', $idAlojamiento, PDO::PARAM_STR);
                $serviciosBorrados = $sentencia2->execute();

                if ($serviciosBorrados) {//borramos primero el alojamiento
                    $sql = "DELETE FROM alojamiento WHERE idAlojamiento = :idAlojamiento";

                    $sentencia = $conexion->prepare($sql);
                    echo 'id de Alojamiento';
                    echo $idAlojamiento;
                    $sentencia->bindParam(':idAlojamiento', $idAlojamiento, PDO::PARAM_STR);

                    $alojamientoEliminado = $sentencia->execute();
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $alojamientoEliminado;
    }

    public static function escribirAlojamientos($conexion) {

        $alojamientos = self::getAlojamientos2($conexion);

        if (count($alojamientos)) {
            foreach ($alojamientos as $alojamiento) {

                self::escribirAlojamiento($alojamiento);
            }
        }
    }

    public static function escribirAlojamiento($alojamiento) {
        if (!isset($alojamiento)) {
            return;
        }
        ?>

        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="images/hoteles/hotel1.jpg" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">Hotel: <?php echo $alojamiento->getNombre(); ?></p>
                    <p class="card-text">Categoria: <?php echo $alojamiento->getCategoria(); ?></p>
                    <p class="card-text">Ciudad: <?php echo $alojamiento->getCiudad(); ?></p>
                    <p class="card-text">Precio: $ <?php echo $alojamiento->getPrecio(); ?></p>
                    <p class="card-text">Paga en cuotas</p>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="vistaALojamiento.php?idAlojamiento=<?php echo $alojamiento ->getId();?>" class="btn btn-success">Ver</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
