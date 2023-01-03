<script>
function confirmar(){
	if(confirm("¿Realmente desea eliminar?")){		
		return true;	}
	else{	
			// realizamos el Submit
					
		return false;
			}	
	}

</script><?php
include 'Controllers/usuarioPermisosController.php';
$usuarioController= new UsuarioPermisosController();
$usuarioController->vistaListausuarios();
?>

<section class="content-header">
<h1>USUARIOS</h1><h1><?php echo $usuarioController->getTITULO5()?></h1>
   <div class="row"><div class="col-md-12">    <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; " ><a href="index.php?action=snuevousuario&admin=nuevo&id=<?php echo $usuarioController->getIdnum()?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a>  </button>    
    <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; " ><a href="index.php?action=slistagrupos">   Regresar  </a></button></div></div>
</section>
<!-- Main content -->
<section class="content container-fluid">

<!----- Inicia contenido -----><?php echo $usuarioController->getMensaje()?>
<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 20%">CLAVE</th>
                  <th style="width: 20%">NOMBRE</th>
                  <th style="width: 25%">EMAIL</th>
                
                  <th style="width: 10%">ELIMINAR</th>
                </tr>
<?php 

foreach ($usuarioController->getListaUsuarios() as $usuario){     ?>
  <tr><td>
 <?php echo $usuario["claveusuario"]?></td>

<td><?php echo $usuario["editausuario"]?></td>
<td><?php echo $usuario["email"]?></td>
<td> <a type="button" onclick="return confirmar();" href="index.php?action=slistausuarios&admin=borrar&usu=<?php echo $usuario['borrarusurario']."&id=".$usuarioController->getIdnum()?>"><i class="fa fa-times"></i></a>
</td>
</tr>
<?php } //fin foreach?>
</table>
</div>

</section>