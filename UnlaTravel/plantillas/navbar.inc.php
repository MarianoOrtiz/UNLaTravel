<?php
  include_once 'app/Conexion.inc.php';
  include_once 'app/AbmAlojamiento.inc.php';
 ?>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Este botón despliega la barra de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">UNLa Travel</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Alojamientos</a></li>
                <li><a href="#">Vuelos</a></li>
                <li><a href="#">Paquetes</a></li>
                <li><a href="#">Actividades</a></li> 
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li> 
            </ul>
        </div>
    </div> 
</nav>
