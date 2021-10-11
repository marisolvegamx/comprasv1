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
            <h1 class="m-0">CLIENTES</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->

          
        </div><!-- /.row -->

<?php
$ingreso = new ClienteController();
$ingreso -> borrarClienteController();
$ingreso -> vistaClientesController();

?>

</section>