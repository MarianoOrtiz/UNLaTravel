<?php


class Alojamiento {

    private $id;
    private $nombre;
    private $categoria;
    private $cantidadHabInd;
    private $cantidadHabDob;
    private $servicio = array();
    private $tipoPension;
    private $ciudad;
    private $email;
    private $regimen;
    private $precio;

    /* Constructor */

    public function __construct($id, $nombre, $categoria, $cantidadHabInd, $cantidadHabDob, $servicio, $ciudad, $email, $regimen, $precio) {


        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->cantidadHabInd = $cantidadHabInd;
        $this->cantidadHabDob = $cantidadHabDob;
        $this->servicio[] = $servicio;
        
        $this->ciudad = $ciudad;
        $this->email = $email;
        $this->regimen=$regimen;
        $this-> precio = $precio;
    }

    public function getId() {
        return $this->id;
    }
    public function getNombre() {
        return $this->nombre;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getCantidadHabInd() {
        return $this->cantidadHabInd;
    }

    public function getCantidadHabDob() {
        return $this->cantidadHabDob;
    }

    public function getServicio() {
        return $this->servicio;
    }

   

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function getRegimen(){
        return $this->regimen;
    }
    
    public function getPrecio(){
        return $this->precio;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setCantidadHabInd($cantidad) {
        $this->cantidadHabInd = $cantidad;
    }

    public function setCantidadHabDob($cantidad) {
        $this->cantidadHabDob = $cantidad;
    }

    public function setServicio($servicio) {
        $this->servicio[] = $servicio;
    }

   

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setRegimen($regimen){
        $this->regimen = $regimen;
    }
    
    public function setPrecio($precio){
        $this->precio = $precio;
    }

}
