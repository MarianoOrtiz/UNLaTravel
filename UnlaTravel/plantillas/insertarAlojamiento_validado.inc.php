<h2>Ingresar Alojamiento</h2><br>

<div class="form-group">
    <label>Nombre de Alojamiento</label>
    <input type="text" class="form-control"  name="nombre"  placeholder="Ingrese Nombre de alojamiento" required="required" <?php $validador -> mostrarNombre(); ?>> 
    <?php
    $validador->mostrarErrorNombre();
    ?>
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Categoria</label>
    <select name="categoria">
        <option value="1">1 estrella</option> 
        <option value="2">2 estrellas</option> 
        <option value="3">3 estrellas</option>
        <option value="4">4 estrellas</option> 
        <option value="5">5 estrellas</option> 
    </select> 
</div>

<div class="form-group">
    <label for="cantidadhabind">Cantidad de habitaciones individuales</label>
    <input type="text" class="form-control" id="nombreALojamiento" name="cantidadHabitacionesInd" aria-describedby="emailHelp" placeholder="0" <?php $validador->mostrarCantHabInd(); ?>>
    <?php
    $validador->mostrarErrorCantHabInd();
    ?>
</div>

<div class="form-group">
    <label for="cantidadhabind">Cantidad de habitaciones Dobles</label>
    <input type="text" class="form-control" id="nombreALojamiento" name="cantidadHabitacionesDob" aria-describedby="emailHelp" placeholder="0" <?php $validador->mostrarCantHabDob(); ?>> 
    <?php
    $validador->mostrarErrorCantHabDob();
    ?>
</div>

<div class="form-group">
    <label for="tipoPension">Regimen</label>
    <select name="regimen">
        <option value="1">Media Pension</option> 
        <option value="2">Pension completa</option> 
        <option value="3">Solo hospedaje</option>
    </select> 
</div>

<div class="form-group">
    <label for="otro">Ciudad</label>
    <select name="ciudad">
        <?php RepositorioCiudad::escribirCiudades(Conexion :: getConexion()); ?>
    </select> 
</div>

<div class="form-group">
    <label for="cantidadhabind">E-mail</label>
    <input type="text" class="form-control" id="nombreALojamiento" name="email" aria-describedby="emailHelp" placeholder="Ingrese un e-mail" <?php $validador->mostrarEmail(); ?>> 
    <?php
    $validador -> mostrarErrorEmail();
    ?>
</div>

<div class="form-group">
    <label for="cantidadhabind">Servicios</label>
    <div>
        <input type="checkbox" name="checkbox[]" value="1">Aire Acondicionado<br>
        <input type="checkbox" name="checkbox[]" value="2">Wi-fi gratis<br>
        <input type="checkbox" name="checkbox[]" value="3">Calefaccion<br>
        <input type="checkbox" name="checkbox[]" value="4">Ascensor<br>
        <input type="checkbox" name="checkbox[]" value="5">Recepcion 24 hs<br>
    
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success btn-lg btn-block" name="enviar">Cargar Alojamiento</button>
</div>
