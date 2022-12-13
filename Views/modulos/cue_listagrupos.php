<script type="text/javascript" >
function dialogoEliminar(){
	if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
		return true;
	else return false;
}
 </script>
<?php
include "Controllers/gruposController.php";
$grupoController = new GruposController();
$grupoController -> vistaListaGrupos();

?>

<section class="content-header">
<h1>GRUPOS</h1>
</section>
<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=nuevaciures&admin=nvo"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>


<!----- Inicia contenido ----->
<?php echo $grupoController->getMensaje()?>
<div class="row">

<?php foreach ($grupoController->getListaGrupos() as $grupo){
   ?>

  
<div class="col-md-4" >

<div class="box box-info" >

<div class="box-header with-border">

<h3 class="box-title">CLAVE: <?php echo $grupo["clavegrupo"]?></h3>



<div class="box-tools pull-right">

<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

</button>



</div>

<!-- /.box-tools -->

</div>

<!-- /.box-header -->

<div class="box-body">

<div class="arrow">

<div class="box-footer no-padding">

<ul class="nav nav-stacked">

<li><?php echo $grupo["editagrupo"]?></li>

</ul>

</div>

</div>

<div class="row" >

<div class="col-sm-6 border-right">

<div class="description-block">

<a class="btn btn-block btn-info" href='index.php?action=slistapermisos&id=<?php echo $grupo["clavep"]?>'>
<span style="font-size: 12px">PERMISOS</span></a>
</div>

<!-- /.description-block -->
</div>
<!-- /.col -->

<div class="col-sm-6 border-right">

<div class="description-block">
<a class="btn btn-block btn-info" href='index.php?action=slistausuarios&id=<?php echo $grupo["clavep"]?>'>
<span style="font-size: 12px">USUARIOS</span></a>

</div>
<!-- /.description-block -->
</div>
<!-- /.col -->
</div>
</div>
<!-- /.box-body -->

</div>

</div>

<?php } //fin foreach?>

</div>
</section>