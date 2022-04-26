<section class="content-header">
<h1><?php echo Estructura::nombreNivel(4, 1)?></h1>
<h1><?php //echo Datosntres::nombreNivel3(filter_input(INPUT_GET, "idnt",FILTER_SANITIZE_NUMBER_INT),"ca_nivel3" )?></h1>


</section>

<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=nuevon4&niv=4&admin=nuevo&ref=<?php echo filter_input(INPUT_GET, "idnt",FILTER_SANITIZE_NUMBER_INT)?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>
    
 <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 10%">No.</th>
                  <th style="width: 20%">CLIENTE</th>
                  <th style="width: 20%">REGION</th>
                  <th style="width: 20%">PAIS</th>
                  <th style="width: 20%">NOMBRE</th>
                 
                  <th style="width: 10%">BORRAR</th>
                </tr>
              
<?php

$ingreso = new NcuaController();
$ingreso -> vistancuaController();

?>

               </table>
            </div>
            <!-- /.box-body -->
           
      

</section>
