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

function imprimirlis(id){

//'var mform = document.form1;

//var nsec=document.getElementById(numsecc).value;

  // window.open('MEZprincipal.php?op=anaFQ&admin=imp&ntoma='+mform.numsecc.value);

   window.open('Controllers/RepListaCompra.php?id='+id);

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
        <tr>
          <td>NOTAS</td>
          <td><?php echo  $listaCompraContoller->getnotas(); ?></td>
        </tr>
      </tbody>
    </table>
  </div>

 
<div class="row">
<div class="col-md-12" >
<form role="form" method="post" action="index.php?action=listacompra&admin=ord">
 <table id="example2" class="table table-bordered">
    <tr>
    <td style="width: 55%"> </td> 

<td style="width: 15%">  
  <button  class="btn btn-default float-sm-right" ><a href="index.php?action=nuevalistaCompraDetalle&id=<?php echo $listaCompraContoller->getLista(); ?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
</br>
</td>
<td style="width: 10%">
  <button  class="btn btn-default float-sm-right" ><a href="index.php?action=listacompradet&admin=li&id=<?php echo $listaCompraContoller->getLista(); ?>">   Reordenar  </a></button>
</td>  

<td style="width: 10%">
  <button  class="btn btn-default float-sm-right" ><a href=javascript:imprimirlis(<?php echo $listaCompraContoller->getLista(); ?>)>   Imprimir  </a></button>
</td>  

<td style="width: 10%">  
  <button type="submit" class="btn btn-info float-sm-right" style="margin-right: 10px; margin-top:0px; margin-bottom:10px; "> Regresar</button>
</td>
</tr>
</table>
   </div>

 </div>
</section>
<section>

<?php

$ingreso = new ListaComDetController();
$ingreso -> vistalisComDetController();

?>
</form>
</section>

