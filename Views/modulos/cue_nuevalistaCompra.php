<?php $listaCompraContoller=new ListaComController();
      $listaCompraContoller->vistaNuevaListaCompra();
 ?>﻿


<section class="content-header">
      <h1>NUEVA LISTA</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $listaCompraContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listacompra&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                    <div class="form-group col-md-12">
                      <label>CLIENTE</label>
                      
                      <select class="form-control cascada" name="clientelis"  
                        data-id="niv-1"
                        data-group="niv-1"
                        data-target="niv-2"
                        data-url="getNivelUnegocio.php?op=lc&"
                        data-replacement="container1">
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaCliente()?>
                                    
                      </select>

                    </div>

                      <div class="form-group col-md-12">
                      <label>PLANTA</label>
                      <select class="form-control cascada" name="plantalis"  
                        data-group="niv-1"
                        data-id="niv-2"
                        data-target="niv-3"
                        data-replacement="container1"
                        data-default-label="Seleccione una opcion" disabled>
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaPlanta()?>
                                    
                      </select>

                      </div>

                      <div class="form-group col-md-12">
                      <label>INDICE</label>
                       <select class="form-control" name="indicelis">
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaIndice()?>
                                    
                      </select>
                      </div>

                      <div class="form-group col-md-12">
                      <label>RECOLECTOR</label>
                      <select class="form-control" name="recolectorlis">
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaRecolector()?>
                                    
                      </select>
                      </div>
                   </div>   

              
                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listacompra"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
               <script src="js/jquery.cascading-drop-down.js"></script>
    <script>
    $('.cascada').ssdCascadingDropDown({
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
            </section>
