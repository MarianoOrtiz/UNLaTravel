
<h2>Registro</h2>
<p class="hint-text">Ingrese un alojamiento nuevo</p>
<div class="form-group" >
    <div class="row">
        <div class="col-xs-12"><input type="text" class="form-control" name="nombre" placeholder="Nombre de Alojamiento" required="required"></div>
        
    </div>        	
</div>
<div class="form-group">
    <input type="email" class="form-control" name="emailAlojamiento" placeholder="Email de Alojamiento" required="required">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="cantidadInd" placeholder="Cantidad de Habitaciones individuales" required="required">
</div>     
<div class="form-group">
    <input type="text" class="form-control" name="cantidadDob" placeholder="Cantidad de Habitaciones Dobles" required="required">
</div> 
<div class="form-group">
    <input type="text" class="form-control" name="categoria" placeholder="Categoria" required="required">
</div> 
<div class="form-group">
    <input type="text" class="form-control" name="pension" placeholder="Tipo Pension" required="required">
</div> 
<div class="form-group">
    <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" required="required">
</div> 
<form method="POST" action="validarServicios.php">
    <input type="checkbox" name="checkbox[]" value="AireAcondicionado">Aire Acondicionado <br>
    <input type="checkbox" name="checkbox[]" value="Ascensor">Ascensor <br>
    <input type="checkbox" name="checkbox[]" value="Recepcion24h">Recepcion 24 hs <br>
    <input type="checkbox" name="checkbox[]" value=Lavanderia">Servicio de lavanderia <br>
</form>
<div class="container">
    <button type="submit" class="btn btn-success btn-lg btn-block" name="enviar">Crear</button>
</div>