<?php

class RepositorioUsuario {
    
    public static function obtenerTodos($conexion){
        $usuarios = array();
        
        if(isset($conexion)){
            
            try {
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * from usuario";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $usuarios[] = new Usuario(
                                $fila['id'], $fila['nombre'], $fila['apellido'], $fila['fechaNacimiento'], $fila['password'], $fila['email']
                                );
                      }
                }else{
                          print "La tabla Usuarios esta vacía";
                      }
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            }
          
        }
        return $usuarios;
    }
    
    public static function insertarUsuario($conexion, $usuario){
        $usuario_insertado = false;
        
        if(isset($conexion)){
            try {
                
                $sql = "INSERT INTO usuario(nombre, apellido, fechaNacimiento, password, email) VALUES(:nombre, :apellido, NOW(), :password, :email)";
                 
                $nombretmp = $usuario -> getNombre();
                $apellidotmp = $usuario -> getApellido();
                $emailtmp = $usuario -> getEmail();
                $clavetmp = $usuario -> getPassword();
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre',$nombretmp , PDO::PARAM_STR);
                $sentencia -> bindParam(':apellido',$apellidotmp , PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $emailtmp, PDO::PARAM_STR);
                $sentencia -> bindParam(':password',$clavetmp , PDO::PARAM_STR);
                
                $usuario_insertado = $sentencia -> execute();
               
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        return $usuario_insertado;
    }
    
    public static function existeEmail($conexion, $email) {
        $existeEmail = true;
        
        if(isset($conexion)){
            try {
                $sql = "SELECT email FROM usuario WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                
                if(count($resultado)){
                    
                   $existeEmail = true;
                }else{
                    $existeEmail = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
    
       return $existeEmail;
    }
    
    public static function getUsuarioPorEmail($conexion, $email) {
        $usuario = null;
        
        if(isset($conexion)){
            try {
                
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM usuario WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){ 
                   $usuario = new Usuario($resultado['idCliente'],$resultado['dni'], $resultado['nombre'], $resultado['apellido'], $resultado['direccion'], $resultado['email'], $resultado['telefono'], $resultado['perfil'],$resultado['contrasena']); 
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        return $usuario;
    }
}
