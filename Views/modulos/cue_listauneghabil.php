<?php $listaCompraContoller=new unegocioController();
      $listaCompraContoller->vistaNuevouneghabil();
 ?>﻿

<script type="text/javascript" >
function dialogoEliminar(){
  if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
    return true;
  else return false;
}
 </script>

 

   <section class="content-header">
      <h1>MESES HABILITADOS DE LA TIENDA &nbsp; &nbsp; <small></small></h1>
      <div class="card-body">
    <table class="table table-bordered">
      
      <tbody>
        <tr>
          <td>TIENDA</td>   

          <td><?php echo  $listaCompraContoller->getnombretienda(); ?>
            
          </td>
        </tr>  
      </tbody>
    </table>
  </div>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<?php
  include "Utilerias/leevar.php";

echo '
      
   <div class="row">
<div class="col-md-12" >
 
        <button   class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:10px; ">
        <a href="index.php?action=nuevouneghabil&id='.$id.'"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
        <button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:10px; ">
        <a href="index.php?action=listaunegocio">  Regresar  </a></button>
 </div>
   </div>';
   ?>     
        <div class="row">
           <div class="col-md-12">
          <div class="box">
                        <!-- /.box-header -->
            <div class="box-body ">
              <table class="table table-striped stacktable" id="tabla1">
                <tr>
                  <th style="width: 60%">MES DE ASIGNACION HABILITADO</th>
                     <th style="width: 20%">CLIENTE</th>
                  <th style="width: 20%" align="center">BORRAR</th>
                </tr>
              
<?php
$ingreso = new unegocioController();
$ingreso -> vistamesasigController();

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
 
 
    