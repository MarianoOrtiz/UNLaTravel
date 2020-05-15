<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorLogin{
    
    private $usuario;
    private $error;
    
    public function __construct($email, $clave, $conexion){
        
        $this -> error = "";
        
        if(!$this -> variable_iniciada($email) || !$this -> variable_iniciada($clave) ){
            $this -> usuario = null;
            $this -> error = "Debes ingresar tu email y tu contraseña";
        }else{
            $this -> usuario = RepositorioUsuario :: getUsuarioPorEmail($conexion, $email);
            
            if(is_null($this -> usuario) || ($clave !== $this -> usuario -> getPassword())){
                $this -> error = "Datos incorrectos";
            }
        }
        
    }
    
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getUsuario() {
        return $this -> usuario;
    }
    
    public function getError() {
        return $this -> error;
        
    }
    
    public function mostrarError(){
        if($this-> error !==''){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this -> error;
            echo "</div><br>";
        }
    }
}
