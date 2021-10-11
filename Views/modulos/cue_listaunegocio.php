<script type="text/javascript" >
function dialogoEliminar(){
  if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
    return true;
  else return false;
}
 </script>

 

   <section class="content-header">
      <h1>TIENDAS &nbsp; &nbsp; <small></small></h1>
      
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<?php

//$ingreso = new unegocioController();
//$ingreso->iniciarFiltros();
?>
      
    <div class="row mb-2">
        <div class="col-sm-6">
 
   </div><!-- /.col -->
 
     <div class="col-md-6" >
        <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
        <a href="index.php?action=nuevatienda"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
      </div>
   </div>
        
        <div class="row">
           <div class="col-md-12">
          <div class="box">
                        <!-- /.box-header -->
            <div class="box-body ">
              <table class="table table-striped stacktable" id="tabla1">
                <tr>
                  <th style="width: 10%">ID </th>
                  <th style="width: 25%">PAIS </th>
                  <th style="width: 25%">CIUDAD</th>
                  <th style="width: 40%">NOMBRE</th>
                  <th style="width: 10%">BORRAR</th>
                </tr>
              
<?php
$ingreso = new unegocioController();
$ingreso -> vistaunegocioController();

?>

  
               </table>
            </div>
            <!-- /.box-body -->
        </div>
          <!-- /.box -->
        </div>
        </div>


	  <!----- Finaliza contenido ----->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
   
 
    <script src="js/jquery.cascading-drop-down.js"></script>
    <script>
    $('.form-control').ssdCascadingDropDown({
        nonFinalCallback: function(trigger, props, data, self) {

            trigger.closest('form')
                    .find('input[type="submit"]')
                    .attr('disabled', true);

        },
        finalCallback: function(trigger, props, data) {

            if (props.isValueEmpty()) {
                trigger.closest('form')
                        .find('input[type="submit"]')
                        .attr('disabled', true);
            } else {
                trigger.closest('form')
                        .find('input[type="submit"]')
                        .attr('disabled', false);
            }

        }
    });
</script>
