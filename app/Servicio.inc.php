
<?php
include_once 'app/Conexion.inc.php';

class Servicio {

    private $idServicio;
    private $nombreServicio;

    /* Constructor */

    public function __construct($idServicio, $nombreServicio) {
            
        $this->idServicio = $idServicio;
        $this->nombreServicio = $nombreServicio;

    }

    public function getIdServicio() {
        return $this->idServicio;
    }
    
    public function getNombreServicio(){
        return $this->nombreCiudad;
    }
    
    public function setIdServicio($id){
        $this->idServicio = $id;
    }
    
    public function setNombreServicio($nombreServicio){
        $this->nombreServicio = $nombreServicio;
    }
    
  
}
