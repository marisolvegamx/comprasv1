<?php $listaCompraContoller=new ListaComController();
      $listaCompraContoller->vistaEditaListaCompra();
 ?>﻿


<section class="content-header">
      <h1>EDITA LISTA DE COMPRA</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $listaCompraContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listacompra&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                    <div class="form-group col-md-12">
                      <label>CLIENTE : </label>
                       <input type="hidden" class="form-control" name="idlis" id="idlis" value=
                              <?php echo  $listaCompraContoller->getLista(); ?>
                       >
                         <?php echo  $listaCompraContoller->getCliente(); ?>
                      
                    </div>

                      <div class="form-group col-md-12">
                      <label>PLANTA : </label>
                        <?php echo  $listaCompraContoller->getPlanta(); ?>
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
                      <select class="form-control" name="reclis">
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaRecolector()?>
                                    
                      </select>
                      </div>

                     <div class="form-group col-md-12">
                    <label>NOTA</label>
                     <input type="text" class="form-control" placeholder="NOTA" name="notalis" value="<?php echo  $listaCompraContoller->getnotas(); ?> ">
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
            </section>