<?php

class Usuario{
    private $idUsuario;
    private $dni;
    private $nombre;
    private $apellido;
    private $direccion;
    private $email;
    private $telefono;
    private $perfil;
    private $contrasena;

    public function __construct($idUsuario, $dni, $nombre, $apellido, $direccion, $email, $telefono, $perfil, $contrasena){
        
        $this -> idUsuario = $idUsuario;
        $this -> dni = $dni;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> direccion = $direccion;
        $this -> email = $email;
        $this -> telefono = $telefono;
        $this -> perfil = $perfil;
        $this -> contrasena = $contrasena;

    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

}