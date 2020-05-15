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

    /* Constructor */

    public function __construct($id, $nombre, $categoria, $cantidadHabInd, $cantidadHabDob, $servicio, $tipoPension, $ciudad, $email, $regimen) {


        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->cantidadHabInd = $cantidadHabInd;
        $this->cantidadHabDob = $cantidadHabDob;
        $this->servicio[] = $servicio;
        $this->tipoPension = $tipoPension;
        $this->ciudad = $ciudad;
        $this->email = $email;
        $this->regimen=$regimen;
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

    public function getSercicio() {
        return $this->servicio;
    }

    public function getTipoPension() {
        return $this->tipoPension;
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

    public function setTipoPension($tipoPension) {
        $this->tipoPension = $tipoPension;
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

}
