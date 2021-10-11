<section class="content-header">
   <script type="text/javascript" >
function dialogoEliminar(){
  if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
    return true;
  else return false;
}
 </script>
  <div class="row mb-2">
  <div class="col-sm-6">    
    <h1> <?php echo Estructura::nombreNivel(2, 1)?></h1>
    <h1><?php echo Datosnuno::nombreNivel1(filter_input(INPUT_GET, "idnuno",FILTER_SANITIZE_NUMBER_INT),"ca_nivel1" )?></h1>
  </div><!-- /.col -->
  <div class="col-sm-6">
  

  </div><!-- /.col -->
 </div><!-- /.row -->

</section>

<section class="content container-fluid">

  <div class="row mb-2">
    <div class="col-sm-6">
 
   </div><!-- /.col -->
 
	   <div class="col-md-6" >
      	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
      	<a href="index.php?action=nuevonivel&admin=edit&niv=2&ref=<?php echo filter_input(INPUT_GET, "idnuno",FILTER_SANITIZE_NUMBER_INT)?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
      </div>
	 </div>
 <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 20%">No.</th>
                 
                  <th style="width: 30%">CLIENTE</th>
                  <th style="width: 30%">REGION</th>
                  <th style="width: 20%">BORRAR</th>
                </tr>
              
<?php

$ingreso = new NdosController();
$ingreso -> vistandosController();

?>

               </table>
            </div>
            <!-- /.box-body -->
        

</section>