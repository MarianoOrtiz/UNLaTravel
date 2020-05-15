<?php

class Ciudad {

    private $id;
    private $nombreCiudad;

    /* Constructor */

    public function __construct($id, $nombreCiudad) {

        $this->id = $id;
        $this->nombrCiudad = $nombreCiudad;

    }

    public function getId() {
        return $this->id;
    }
    
    public function getNombreCiudada(){
        return $this->nombreCiudad;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setNombreCiudad($nombreCiudad){
        $this->nombreCiudad = $nombreCiudad;
    }
    
}
