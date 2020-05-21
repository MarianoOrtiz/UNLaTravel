<h2>Ingresar Alojamiento</h2><br>

<div class="form-group">
    <label>Nombre de Alojamiento</label>
    <input type="text" class="form-control"  name="nombre"  placeholder="Ingrese Nombre de alojamiento" required="required"> 
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Categoria</label>
    <select name="categoria">
        <option value="1 estrella">1 estrella</option> 
        <option value="2 estrellas">2 estrellas</option> 
        <option value="3 estrellas">3 estrellas</option>
        <option value="4 estrellas">4 estrellas</option> 
        <option value="5 estrellas">5 estrellas</option> 
    </select> 
</div>

<div class="form-group">
    <label for="cantidadhabind">Cantidad de habitaciones individuales</label>
    <input type="text" class="form-control" id="nombreALojamiento" name="cantidadHabitacionesInd" aria-describedby="emailHelp" placeholder="0" required="required"> 
</div>

<div class="form-group">
    <label for="cantidadhabind">Cantidad de habitaciones Dobles</label>
    <input type="text" class="form-control" id="nombreALojamiento" name="cantidadHabitacionesDob" aria-describedby="emailHelp" placeholder="0" required="required"> 
</div>

<div class="form-group">
    <label for="tipoPension">Regimen</label>
    <select name="regimen">
        <option value="Media Pension">Media Pension</option> 
        <option value="Pension Completa">Pension completa</option> 
        <option value="Solo hospedaje">Solo hospedaje</option>
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
    <input type="text" class="form-control" id="nombreALojamiento" name="email" aria-describedby="emailHelp" placeholder="Ingrese un e-mail" required="required"> 
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
