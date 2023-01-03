<script>
function confirmar(){

	if(confirm("¿Realmente desea eliminar?")){
		return true;
	}else{
		//Si el codigo llega hasta aqu�, todo estar� bien  y realizamos el Submit
		return false;
	}

	
}
</script>
<?php

include 'Controllers/permisosController.php';
$permisoController= new PermisosController();
$permisoController->vistaListaPermisos();

?>
<section class="content-header">

<h3>PERMISOS</h3>
<h3><?php echo $permisoController->getGrupo()?></h3>

   <div class="row">
<div class="col-md-12">
  <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	
<a  href="index.php?action=snuevopermiso&id=<?php echo $permisoController->getIdGrup() ?>" > <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a>
   </button> 
   <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; " ><a href="index.php?action=slistagrupos">   Regresar  </a></button>
   </div>
   
   </div>   
</section>


<!-- Main content -->

<section class="content container-fluid">
 
<!----- Inicia contenido ----->


<?php
echo $permisoController->getMensaje();
?>
<!----- Inicia contenido ----->
<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 45%">OPCION MENU PRINCIPAL</th>
                  <th style="width: 45%">NOMBRE DEL PERMISO</th>
               
                  <th style="width: 10%">ELIMINAR</th>
                </tr>
<?php 
$bac=1;
$reg=sizeof($permisoController->getListaPermisos());
foreach ($permisoController->getListaPermisos() as $permiso){
   
  
    ?>

  <tr>

<td><?php echo $permiso["claveopcion"]?></td>


<td><?php echo $permiso["editapermiso"]?></td>

<td>

 <a type="button" onclick="return confirmar();" href="index.php?action=slistapermisos&admin=borrar&id2=<?php echo $permiso["borraid"]."&id=".$permisoController->getIdGrup() ?>"><i class="fa fa-times"></i></a>
 </td>
</tr>

<?php

} //fin foreach?>
</table>

</div>


</section>