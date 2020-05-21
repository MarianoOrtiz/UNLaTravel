<?php

class RepositorioCiudad{
      public static function traerCiudades($conexion){
        $ciudades = array();

        if (isset($conexion)) {

            try {
                include_once 'Ciudad.inc.php';

                $sql = "SELECT * from ciudad";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $ciudades[] = new Ciudad($fila['idCiudad'],$fila['nombreCiudad']);
                       
                    }
                } else {
                    print "La tabla Ciudad Esta Vacia";
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $ciudades;
    }
    
    public static function escribirCiudades($conexion) {
        $ciudades = self::traerCiudades($conexion);
        
        if(count($ciudades)){
            foreach($ciudades as $ciudad){
                
                self::escribirCiudad($ciudad);
            }
        }
    }
    
    public static function escribirCiudad($ciudad){
        if(!isset($ciudad)){
            return;
        }
        ?>

<option value="<?php echo $ciudad ->getIdCiudad(); ?>"><?php echo $ciudad ->getNombreCiudad();?></option> 
        <?php
        
        
    }
    
    public static function escribirCiudades2($conexion, $ciudadAlojamiento){
        $ciudades = self::traerCiudades($conexion);
        echo 'hola';
        if(count($ciudades)){
            foreach($ciudades as $ciudad){
              
                self::escribirCiudad2($ciudad, $ciudadAlojamiento);
            }
        }
    }
    
    public static function escribirCiudad2($ciudad, $ciudadAlojamiento){
        if(!isset($ciudad)){
            return;
        }
        
        if($ciudad->getNombreCiudad() == $ciudadAlojamiento){
            
            ?>
                
<option value="<?php echo $ciudad ->getIdCiudad(); ?>" selected=""><?php echo $ciudad ->getNombreCiudad();?></option> 
        <?php
        }else{?>
        <option value="<?php echo $ciudad ->getIdCiudad(); ?>"><?php echo $ciudad ->getNombreCiudad();?></option> 
        <?php
    }
    
}

}