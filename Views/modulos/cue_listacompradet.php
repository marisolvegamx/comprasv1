<?php $listaCompraContoller=new ListaComController();
      $listaCompraContoller->vistaNuevaListaCompraDet();
      $idlc=$listaCompraContoller->getlista();
      //echo $idlc;
 ?>﻿


<script type="text/javascript" >
function dialogoEliminar(){
	if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
		return true;
	else return false;
}
 </script>

<section class="content-header">
<h1>DETALLE DE LISTA DE COMPRA</h1>


</section>

<section class="content container-fluid">
<div class="card-body">
    <table class="table table-bordered">
      
      <tbody>
        <tr>
          <td>CLIENTE</td>   

          <td><?php echo  $listaCompraContoller->getCliente(); ?>
          	 <input type="hidden" class="form-control" name="idlis" id="idlis" value=
          	 
          	 >
          </td>
        </tr>  
          
        <tr>
          <td>PLANTA</td>
          <td><?php echo  $listaCompraContoller->getPlanta(); ?></td>
         
        </tr>
        <tr>
          <td>INDICE</td>
          <td><?php echo  $listaCompraContoller->getIndice(); ?></td>
        </tr>
        <tr>
          <td>RECOLECTOR</td>
          <td><?php echo  $listaCompraContoller->getRecolector(); ?></td>
        </tr>
      </tbody>
    </table>
  </div>

<div class="row">
<div class="col-md-12" >
 <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; "><a href="index.php?action=listacompra">  Regresar  </a></button>
  <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; "><a href="index.php?action=nuevalistaCompraDetalle&id=<?php echo $listaCompraContoller->getLista(); ?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
  
   </div>
 </div>
</section>



<?php

$ingreso = new ListaComDetController();
$ingreso -> vistalisComDetController();

?>

</section>