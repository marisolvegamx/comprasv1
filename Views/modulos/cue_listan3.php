<script type="text/javascript" src="js/stacktable.js/stacktable.js"></script>
<link href="js/stacktable.js/stacktable.css" rel="stylesheet">

 
<section class="content-header">
  <script type="text/javascript" >
function dialogoEliminar(){
  if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
    return true;
  else return false;
}
 </script>
<h1> <?php echo Estructura::nombreNivel(3, 1)?></h1>
<h1><?php echo Datosndos::nombreNivel2(filter_input(INPUT_GET, "idnd",FILTER_SANITIZE_NUMBER_INT),"ca_nivel2" )?></h1>



</section>

<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=nuevon3&niv=3&admin=nvo&ref=<?php echo filter_input(INPUT_GET, "idnd",FILTER_SANITIZE_NUMBER_INT)?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>
 <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 20%">No.</th>
                 <th style="width: 20%">CLIENTE</th>
                  <th style="width: 20%">REGION</th>
                  <th style="width: 20%">NOMBRE</th>
                  <th style="width: 20%">BORRAR</th>
                </tr>
              
<?php

$ingreso = new NtresController();
$ingreso -> vistantresController();

?>

               </table>
            </div>
            <!-- /.box-body -->
      
</section>