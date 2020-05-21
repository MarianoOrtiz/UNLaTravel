<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorPassword {

    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $apellido;
    private $email;
    private $clave;
    
    private $error_nombre;
    private $error_apellido;
    private $error_email;
    private $error_password;
    private $error_confirm_password;

    public function __construct($nombre, $apellido, $email, $password, $confirm_password, $conexion) {
        $this->aviso_inicio="<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre="</div>";
        $this->nombre = "";
        $this->apellido = "";
        $this->email = "";
        $this->clave = "";

        $this->error_nombre = $this->validarNombre($nombre);
        $this->error_apellido = $this->validarApellido($apellido);
        $this->error_email = $this->validarEmail($conexion, $email);
        $this->error_password = $this->validarPassword($password);
        $this->error_confirm_password = $this->validarPassword2($password, $confirm_password);
        
        if($this -> error_password === "" && $this -> error_confirm_password === "" ){
            $this -> clave = $password;
        }
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validarNombre($nombre) {
        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir un nombre de usuario";
        } else {
            $this->nombre = $nombre;
        }

        if (strlen($nombre) < 6) {
            return "El nombre debe ser mayor a 6 caracteres";
        }

        if (strlen($nombre) > 25) {
            return "El nombre no puede contener mas de 24 caracteres";
        }

        return "";
    }

    private function validarApellido($apellido) {
        if (!$this->variable_iniciada($apellido)) {
            return "Debes escribir un apellido de usuario";
        } else {
            $this->apellido = $apellido;
        }

        if (strlen($apellido) < 6) {
            return "El apellido debe ser mayor a 6 caracteres";
        }

        if (strlen($apellido) > 25) {
            return "El apellido no puede contener mas de 24 caracteres";
        }

        return "";
    }

    private function validarEmail($conexion, $email) {
        if (!$this->variable_iniciada($email)){
            return "Debes proporcionar un email";
        } else {
            $this->email = $email;
        }
                               
        if(RepositorioUsuario :: existeEmail($conexion, $email)){
            return "Este correo ya se encuentra registrado, debe proporcionar otro correo";
            
        }
        
        return "";
    }

    private function validarPassword($password) {
        if (!$this->variable_iniciada($password)) {
            return "Debes proporcionar una contraseña";
        }
        return "";
    }

    private function validarPassword2($password, $confirm_password) {
        if (!$this->variable_iniciada($password)) {
            return "Primero debes ingresar tu contraseña";
        }

        if (!$this->variable_iniciada($confirm_password)) {
            return "Debes repetir tu contraseña";
        }

        if ($password !== $confirm_password) {
            return "Las contraseñas deben coincidir";
        }
        return "";
    }

    public function getNombre() {
        return $this -> nombre;
    }

    public function getApellido() {
        return $this -> apellido;
    }
    
    public function getEmail(){
        return $this -> email;
    }
    
    public function getClave(){
        return $this -> clave;
    }
    
    public function getErrorNombre(){
        return $this -> error_nombre;
    }
    
    public function getErrorApellido(){
        return $this -> error_apellido;
    }
    
    public function getErrorEmail(){
        return $this -> error_email;
    }
    
    public function getErrorPassword(){
        return $this -> error_password;
    }
    
    public function getErrorPassword2(){
        return $this -> error_confirm_password;
    }
    
    public function mostrarErrorPassword() {
        if($this -> error_confirm_password !== "") {
            echo $this -> aviso_inicio . $this -> error_confirm_password . $this -> aviso_cierre;
        }
    }
    
    public function mostrarErrorEmail() {
        if($this -> error_email !== "") {
            echo $this -> aviso_inicio . $this -> error_email . $this -> aviso_cierre;
        }
    }
    public function mostrarNombre() {
        if($this -> nombre !==""){
              echo 'value="' . $this -> nombre . '"'; 
        }
    }
    
    public function mostrarApellido() {
        if($this -> apellido !==""){
              echo 'value="' . $this -> apellido . '"'; 
        }
    }
    
    public function mostrarEmail() {
        if($this -> email !==""){
              echo 'value="' . $this -> email . '"'; 
        }
    }
    
    public function registroValidado(){
        $resultado = true;
        if($this -> error_confirm_password===""){
            $resultado = true;
        }else{
            $resultado = false;
        }
        
        if($this -> error_email===""){
            $resultado = true;
        }else{
            $resultado = false;
        }
        return $resultado;
    }
}
