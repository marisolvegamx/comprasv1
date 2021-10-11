<section class="content-header">
<h1><?php echo Estructura::nombreNivel(1, 1)?></h1>
</section>
<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=nuevonivel&admin=nvo&niv=1&ref=<?php echo filter_input(INPUT_GET, "idnuno",FILTER_SANITIZE_NUMBER_INT)?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>


<?php

$ingreso = new NunoController();
$ingreso -> vistanunoController();

?>

</section>