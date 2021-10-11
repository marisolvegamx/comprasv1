<section class="content-header">
<h1><?php echo Estructura::nombreNivel(5, 1)?></h1>
<h1><?php //echo Datosncua::nombreNivel4(filter_input(INPUT_GET, "idncu",FILTER_SANITIZE_NUMBER_INT),"ca_nivel4" )?></h1>


</section>

<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; "><a href="index.php?action=nuevon5&niv=5&admin=nuevo&ref=<?php echo filter_input(INPUT_GET, "idncu",FILTER_SANITIZE_NUMBER_INT)?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>
 <div class="box-body no-padding">
              <table class="table">
                <tr>
                  <th style="width: 10%">No.</th>
                  <th style="width: 15%">CLIENTE</th>
                  <th style="width: 15%">REGION</th>
                  <th style="width: 15%">PAIS</th>
                  <th style="width: 15%">CIUDAD</th>
                  <th style="width: 15%">NOMBRE</th>
                  <th style="width: 15%">BORRAR</th>
                </tr>
              
<?php

$ingreso = new NcinController();
$ingreso -> vistancinController();

?>

               </table>
            </div>
            <!-- /.box-body -->
           
    

</section>
