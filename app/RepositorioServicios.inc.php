<?php

class RepositorioServicios {

    public static function traerServicios($conexion) {
        $servicios = array();

        if (isset($conexion)) {

            try {
                include_once 'Servicio.inc.php';

                $sql = "SELECT * from servicio";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $servicios[] = new Servicio($fila['idServicio'], $fila['nombreServicio']);
                    }
                } else {
                    print "La tabla Servicio Esta Vacia";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $servicios;
    }

    public static function traerServiciosPorAlojamiento($conexion, $idAlojamiento) {
        $servicios = array();

        if (isset($conexion)) {

            try {
                include_once 'Servicio.inc.php';

                $sql = "SELECT a.servicio_idServicio, b.nombreServicio from alojamiento_has_servicio a  JOIN servicio b ON a.servicio_idServicio=b.idServicio WHERE a.alojamiento_idALojamiento = :idAlojamiento ";
                
                
                $sentencia = $conexion->prepare($sql);
                 $sentencia->bindParam(':idAlojamiento', $idAlojamiento, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $servicios[] = new Servicio($fila['servicio_idServicio'], $fila['nombreServicio']);
                    }
                } else {
                    print "La tabla Servicio Esta Vacia";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $servicios;
    }

    public static function escribirServicios($conexion,$idAlojamiento) {

        $servicios = self::traerServiciosPorAlojamiento($conexion,$idAlojamiento);

        if (count($servicios)) {
            foreach ($servicios as $servicio) {

                self::escribirCiudad($servicio);
            }
        }
    }

    public static function escribirCiudad($servicio) {
        if (!isset($servicio)) {
            return;
        }
        ?>

        <h5 style="color:black"><?php echo $servicio->getNombreServicio(); ?></h5>        <?php
    }

}
