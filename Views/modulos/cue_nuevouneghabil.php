<?php $listaCompraContoller=new unegocioController();
      $listaCompraContoller->vistaNuevouneghabil();
 ?>﻿


<section class="content-header">
      <h1>HABILITAR NUEVO PERIODO PARA LA TIENDA</h1>
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
      <?php //echo $listaCompraContoller->getMensaje()
  include "Utilerias/leevar.php";
      echo '
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listauneghabil&admin=ins&id='.$id.'">
                <!-- Datos iniciales alta de punto de venta -->
                    
                      <div class="form-group col-md-12">
                <input type="hidden" class="form-control" name="idtienda" id="idtienda" value="'.$id.'">

                      <label>INDICE</label>
                       <select class="form-control" name="indice">
                         <option value="">Seleccione una opción</option>';

                         $listaCompraContoller->getListaIndice();

                         echo '           
                      </select>
                      </div>
                  
                   <button type="submit" class="btn btn-info">GUARDAR</button>';
             
                
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listauneghabil&admin=li&id='.$id.'"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
