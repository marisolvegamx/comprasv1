<script type="text/javascript" >
function dialogoEliminar(){
	if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
		return true;
	else return false;
}
 </script>

<section class="content-header">
<h1>CIUDADES DE RESIDENCIA</h1>
</section>
<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=nuevaciures&admin=nvo"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>


<?php

$ingreso = new ciuresController();
$ingreso -> vistaciuresController();

?>

</section>