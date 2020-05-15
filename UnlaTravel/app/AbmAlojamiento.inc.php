<?php

class AbmAlojamiento {

    public static function getAlojamientos($conexion) {
        $alojamientos = array();

        if (isset($conexion)) {

            try {
                include_once 'Alojamiento.inc.php';

                $sql = "SELECT * from alojamiento";

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

    public static function insertarAlojamiento($conexion, $alojamiento) {
        $alojamiento_insertado = false;

        if (isset($conexion)) {
            try {

                $sql = "INSERT INTO alojamiento(nombre,  categoria, cantidadHabInd, cantidadHabDob, servicio, tipoPension, ciudad, email, regimen) VALUES(:nombre, :categoria, :cantidadHabInd, :cantidadHabDob, :servicio, :tipoPension, :ciudad, :email, :regimen)";

                $nombretmp = $alojamiento->getNombre();
                $categoriatmp = $alojamiento->getCategoria();
                $cantidadHabIndtmp = $alojamiento->getCantidadHabInd();
                $cantidadHabDobtmp = $alojamiento->getCantidadHabDob();
                $serviciotmp = $alojamiento->getServicio();
                $tipoPensiontmp = $alojamiento->getTipoPension();
                $ciudadtmp = $alojamiento->getCiudad();
                $emailtmp = $alojamiento->getEmail(); 
                $regimentmp = $alojamiento->getRegimen();

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':nombre', $nombretmp, PDO::PARAM_STR);
                $sentencia->bindParam(':categoria', $categoriatmp, PDO::PARAM_STR);
                $sentencia->bindParam(':cantidadHabInd', $cantidadHabIndtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':cantidadHabDob', $cantidadHabDobtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':servicio', $serviciotmp, PDO::PARAM_STR);
                $sentencia->bindParam(':tipoPension', $tipoPensiontmp, PDO::PARAM_STR);
                $sentencia->bindParam(':ciudad', $ciudadtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $emailtmp, PDO::PARAM_STR);
                $sentencia->bindParam(':regimen', $regimentmp, PDO::PARAM_STR);
                

                $alojamiento_insertado = $sentencia->execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $alojamiento_insertado;
    }

    public static function eliminarAlojamiento($conexion, $idAlojamiento) {

        $alojamiento_eliminado = false;
        if (isset($conexion)) {
            try {

                $sql = "DELETE FROM alojamiento WHERE idAlojamiento = :idAlojamiento";

                $sentencia = $conexion->prepare($sql);

                $sentencia->bindParam(':idAlojamiento', $idAlojamiento, PDO::PARAM_STR);

                $sentencia->execute();

                $alojamiento_eliminado = $sentencia->fetch();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $$alojamiento_eliminado;
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

}
