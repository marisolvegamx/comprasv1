<?php $listaCompraContoller=new ListaComController();
      $listaCompraContoller->vistaNuevaListaCompraDet();
      $idlc=$listaCompraContoller->getlista();
      //echo $idlc;
 ?>﻿

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
$("#btn_save_line").click(function() {
   
      var newRow = document.getElementById('tbl_cotizacion').insertRow();
      newRow.innerHTML = "<tr><td align='center'>1 </td><td>2</td><td>3</td><td> <span class='glyphicon glyphicon-chevron-up arriba'></span>  <span class='glyphicon glyphicon-chevron-down down abajo'> </span></td></tr>";
 

});
    $(document).on("click", ".arriba,.abajo", function(){
      
    var row = $(this).parents("tr:first");
    if ($(this).is(".arriba")) {
        //var cod = document.getElementById("ordn");
        //alert(cod);
        
        //var selected = cod.options[cod.selectedIndex].text;
        //alert(selected);
         row.insertBefore(row.prev());
    } else {
        row.insertAfter(row.next());
    }
});
});
</script>
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

  
  <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:10px; "><a href="index.php?action=nuevalistaCompraDetalle&id=<?php echo $listaCompraContoller->getLista(); ?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
</br>
  <button type="submit" class="btn btn-info float-sm-right" style="margin-right: 10px; margin-top:0px; margin-bottom:10px; "> Regresar</button>

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