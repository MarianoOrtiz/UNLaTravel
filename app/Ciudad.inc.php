<?php
include_once 'app/Conexion.inc.php';

class Ciudad {

    private $idCiudad;
    private $nombreCiudad;

    /* Constructor */

    public function __construct($idCiudad, $nombreCiudad) {
            
        $this->idCiudad = $idCiudad;
        $this->nombreCiudad = $nombreCiudad;

    }

    public function getIdCiudad() {
        return $this->idCiudad;
    }
    
    public function getNombreCiudad(){
        return $this->nombreCiudad;
    }
    
    public function setIdCiudad($id){
        $this->idCiudad = $id;
    }
    
    public function setNombreCiudad($nombreCiudad){
        $this->nombreCiudad = $nombreCiudad;
    }
    
  
}
