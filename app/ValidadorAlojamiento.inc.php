
<?php

include_once 'AbmAlojamiento.inc.php';
include_once 'Ciudad.inc.php';

class ValidadorAlojamiento {

    private $aviso_inicio;
    private $aviso_cierre;
    private $nombre;
    private $categoria;
    private $cantidadHabitacionesInd;
    private $cantidadHabitacionesDob;
    private $tipoPension;
    private $ciudad;
    private $email;
    private $regimen;
    private $precio;
    private $servicios = array();
    private $error_nombre;
    private $error_categoria;
    private $error_cantidadHabitacionesInd;
    private $error_cantidadHabitacionesDob;
    private $error_ciudad;
    private $error_email;
    private $error_regimen;
    private $error_precio;
   // private $error_servicios;

    //  private $error_cantidad;

    public function __construct($nombre, $categoria, $cantidadHabitacionesInd, $cantidadHabitacionesDob, $ciudad, $email, $regimen, $conexion, $servicios, $precio) {
        $this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this->aviso_cierre = "</div>";

        $this->nombre = "";
        $this->categoria = "";
        $this->cantidadHabitacionesInd = "";
        $this->cantidadHabitacionesDob = "";

        $this->ciudad = "";
        $this->email = "";
        $this->regimen = "";
        $this->servicios[] = $servicios;
        $this->precio = "";
        
        //Validan que se hayan ingresado valores en el Front, para que no llegue vacio a la BD y no genere error
        $this->error_nombre = $this->validarNombre($nombre);
        $this->error_categoria = $this->validarCategoria($categoria);
        $this->error_cantidadHabitacionesInd = $this->validarCantidadHabInd($cantidadHabitacionesInd);
        $this->error_cantidadHabitacionesDob = $this->validarCantidadHabDob($cantidadHabitacionesDob);
       // $this->error_servicios = $this->validarServicios($servicios);
        $this->error_ciudad = $this->validarCiudad($ciudad);
        $this->error_email = $this->validarEmail($conexion, $email);
        $this->error_regimen = $this->validarRegimen($regimen);
        $this->error_precio = $this->validarPrecio($precio);
    }

    //Valida si la variable ingresada esta vacia o no
    private function variable_iniciada($variable) {

        if (isset($variable) && !empty($variable)) {

            return true;
        } else {

            return false;
        }
    }

    private function validarNombre($nombre) {


        if (!$this->variable_iniciada($nombre)) {
            return "Debes escribir un nombre de Alojamiento";
        } else {
            $this->nombre = $nombre;
        }

        if (strlen($nombre) < 3) {
            return "El nombre debe ser mayor a 3 caracteres";
        }

        if (strlen($nombre) > 50) {
            return "El nombre no puede contener mas de 50 caracteres";
        }

        return "";
    }

    private function validarCategoria($categoria) {
        if (!$this->variable_iniciada($categoria)) {
            return "Debes ingresar una categoria";
        } else {
            $this->categoria = $categoria;
        }

        return "";
    }

    private function validarCantidadHabInd($cantidad) {
        if (!$this->variable_iniciada($cantidad)) {
            return "Debes ingresar una cantidad";
        } else {
            $this->cantidadHabitacionesInd = $cantidad;
        }

        return "";
    }

    private function validarCantidadHabDob($cantidad) {
        if (!$this->variable_iniciada($cantidad)) {
            return "Debes ingresar una cantidad";
        } else {
            $this->cantidadHabitacionesDob = $cantidad;
        }

        return "";
    }

    private function validarCiudad($ciudad) {
        if (!$this->variable_iniciada($ciudad)) {
            return "Debes ingresar una Ciudad";
        } else {
            $this->ciudad = $ciudad;
        }

        return "";
    }

    private function validarEmail($conexion, $email) {
        if (!$this->variable_iniciada($email)) {
            return "Debes proporcionar un email";
        } else {
            $this->email = $email;
        }

        if (AbmAlojamiento :: existeEmailAlojamiento($conexion, $email)) {
            return "Este correo ya se encuentra registrado, debe proporcionar otro correo";
        }

        return "";
    }
    
   /* private function validarServicios($servicios){
        if(!$this->variable_iniciada($servicios) ){
            return "Debes seleccionar al menos un servicio";
        }else{
            $this->servicios[] = $servicios;
        }
    }*/

    private function validarRegimen($regimen) {
        if (!$this->variable_iniciada($regimen)) {
            return "Debes ingresar una Regimen";
        } else {
            $this->regimen = $regimen;
        }

        return "";
    }
    
    private function validarPrecio($precio) {
        if (!$this->variable_iniciada($precio)) {
            return "Debes ingresar un precio";
        } else {
            $this->precio = $precio;
        }

        return "";
    }

    //Getters variables
    public function getNombre() {
        return $this->nombre;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getCantidadHabitacionesInd() {
        return $this->cantidadHabitacionesInd;
    }

    public function getCantidadHabitacionesDob() {
        return $this->cantidadHabitacionesDob;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRegimen() {
        return $this->regimen;
    }

    public function getServicios() {
        return $this->servicios;
    }
    
    public function getPrecio(){
        return $this->precio;
    }

    //Getter errores

    public function getErrorNombre() {
        return $this->error_nombre;
    }

    public function getErrorCategoria() {
        return $this->error_categoria;
    }

    public function getErrorCantidadHabInd() {
        return $this->error_cantidadHabitacionesInd;
    }

    public function getErrorCantidadHabDob() {
        return $this->error_cantidadHabitacionesDob;
    }

    public function getErrorCiudad() {
        return $this->error_ciudad;
    }

    public function getErrorEmail() {
        return $this->error_email;
    }

    public function getErrorRegimen() {
        return $this->error_regimen;
    }
    
   public function getErrorPrecio(){
        return $this->error_precio;
    }

    //Muestra de errores
    public function mostrarErrorNombre() {
        if ($this->error_nombre !== "") {
            echo $this->aviso_inicio . $this->error_nombre . $this->aviso_cierre;
        }
    }

    public function mostrarErrorCategoria() {
        if ($this->error_categoria !== "") {
            echo $this->aviso_inicio . $this->error_categoria . $this->aviso_cierre;
        }
    }

    public function mostrarErrorCantHabInd() {
        if ($this->error_cantidadHabitacionesInd !== "") {
            echo $this->aviso_inicio . $this->error_cantidadHabitacionesInd . $this->aviso_cierre;
        }
    }

    public function mostrarErrorCantHabDob() {
        if ($this->error_cantidadHabitacionesDob !== "") {
            echo $this->aviso_inicio . $this->error_cantidadHabitacionesDob . $this->aviso_cierre;
        }
    }

    public function mostrarErrorCiudad() {
        if ($this->error_ciudad !== "") {
            echo $this->aviso_inicio . $this->error_ciudad . $this->aviso_cierre;
        }
    }

    public function mostrarErrorEmail() {
        if ($this->error_email !== "") {
            echo $this->aviso_inicio . $this->error_email . $this->aviso_cierre;
        }
    }

    public function mostrarErrorRegimen() {
        if ($this->error_regimen !== "") {
            echo $this->aviso_inicio . $this->error_regimen . $this->aviso_cierre;
        }
    }
    
    public function mostrarErrorPrecio() {
        if ($this->error_precio !== "") {
            echo $this->aviso_inicio . $this->error_precio . $this->aviso_cierre;
        }
    }

    //Muestra las variables en los Front 
    public function mostrarNombre() {
        if ($this->nombre !== "") {
            echo 'value="' . $this->nombre . '"';
        }
    }

    public function mostrarCategoria() {
        if ($this->categoria !== "") {
            echo 'value="' . $this->categoria . '"';
        }
    }

    public function mostrarCantHabInd() {
        if ($this->cantidadHabitacionesInd !== "") {
            echo 'value="' . $this->cantidadHabitacionesInd . '"';
        }
    }

    public function mostrarCantHabDob() {
        if ($this->cantidadHabitacionesDob !== "") {
            echo 'value="' . $this->cantidadHabitacionesDob . '"';
        }
    }

    public function mostrarTipoPension() {
        if ($this->tipoPension !== "") {
            echo 'value="' . $this->tipoPension . '"';
        }
    }

    public function mostrarCiudad() {
        if ($this->ciudad !== "") {
            echo 'value="' . $this->ciudad . '"';
        }
    }

    public function mostrarEmail() {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }

    public function mostrarRegimen() {
        if ($this->regimen !== "") {
            echo 'value="' . $this->regimen . '"';
        }
    }
    
    public function mostrarPrecio() {
        if ($this->precio !== "") {
            echo 'value="' . $this->precio . '"';
        }
    }

    //Valida que todo estee correctamente ingresado

    public function alojamientoValidado() {
        $resultado = true;
        
        if ($this->error_nombre === "" &&
            $this->error_categoria === "" &&
            $this->error_cantidadHabitacionesInd === "" &&
            $this->error_cantidadHabitacionesDob === "" &&
            $this->error_ciudad === "" &&
            $this->error_regimen === ""&&
            $this->error_email === "" &&
            $this->error_precio === ""/*&&
            //$this->error_servicios === ""    */
                
            ) {
            
            $resultado = true;
        } else {
            $resultado = false;
        }
        
        return $resultado;
    }
    
     public function validarActualizacion() {
        $resultado = true;
        
        if ($this->error_nombre === "" &&
            $this->error_categoria === "" &&
            $this->error_cantidadHabitacionesInd === "" &&
            $this->error_cantidadHabitacionesDob === "" &&
            $this->error_ciudad === "" &&
            $this->error_regimen === ""
            ) {
            
            $resultado = true;
        } else {
            $resultado = false;
        }
        
        return $resultado;
    }

}
