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
$grupoController -> control();

?>

<section class="content-header">
<h1>GRUPOS</h1>
</section>
<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=snuevogrupo&admin=nvo"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 
	 
	 </div>
	 </div>
<?php echo $grupoController->getMensaje()?>

<!----- Inicia contenido ----->
<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 20%">CLAVE</th>
                  <th style="width: 20%">NOMBRE</th>
                  <th style="width: 25%">PERMISOS</th>
                    <th style="width: 25%">USUARIOS</th>
                  <th style="width: 10%">ELIMINAR</th>
                </tr>

<?php foreach ($grupoController->getListaGrupos() as $grupo){
   ?>

   <tr>
                 <td><?php echo $grupo["clavegrupo"]?></td>
                  <td><?php echo $grupo["editagrupo"]?></td>
   
                     <td> <a type="button" href="index.php?action=slistapermisos&id=<?php echo $grupo["clavegrupo"]?>"><i class="fa fa-plus"></i></a>
		                </td>   
 <td> <a type="button" href="index.php?action=slistausuarios&id=<?php echo $grupo["clavegrupo"]?>"><i class="fa fa-plus"></i></a>
		                </td>    
                  
<td> <a type="button" href="index.php?action=slistapermisos&admin=eli&id=<?php echo $grupo["borrargrupo"]?>" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
                    </td>
                  </tr>
                  <?php } //fin foreach?>
 </table>

</div>



</section>