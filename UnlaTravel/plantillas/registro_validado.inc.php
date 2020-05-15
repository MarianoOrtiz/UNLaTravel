<h2>Registro</h2>
<p class="hint-text">Ingrese un alojamiento nuevo</p>
<div class="form-group" >
    <div class="row">
        <div class="col-xs-6"><input type="text" class="form-control" name="nombre" placeholder="Nombre" required="required" <?php $validador -> mostrarNombreAlojamiento();?>></div>
    </div>        	
</div>
<div class="form-group">
    <input type="email" class="form-control" name="email" placeholder="Email" required="required" <?php $validador -> mostrarEmailAlojamiento();?>>
    <?php
    $validador -> mostrarErrorEmail();
    ?>
</div>
<div class="form-group">
    <input type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
</div>       
<div class="form-group">
    <button type="submit" class="btn btn-success btn-lg btn-block" name="enviar">Registrar</button>
</div>