<?php $comdetContoller=new ListaComDetController();
        $comdetContoller->editaliscompradet();
        $id =$comdetContoller->getide();
 ?>﻿


<section class="content-header">
      <h1>EDITA COMPRA DE PRODUCTO</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
    
        <div class="col-md-12">
             <div class="box box-info">
             <div class="card-body">
                 <form role="form" method="post" action="index.php?action=listacompradet&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                <div class="row">
                    <div class="form-group col-md-4">
                      <input type="hidden" class="form-control" name="idlista" id="idlista" value="<?php echo $comdetContoller->getnumListae(); ?>">
                      <input type="hidden" class="form-control" name="claop" id="claop" value="<?php echo $comdetContoller->getnumprde(); ?>">


                      <label>PRODUCTO</label>
                            <select class="form-control" name="numprod" autofocus="">
                             <option value="">Seleccione una opción</option>
                             <?php echo $comdetContoller->getListaProductoe();
                             ?>
                         </select>
                      </div>

                      <div class="form-group col-md-4">
                         <label>TAMAÑO</label>
                         <select class="form-control" name="numtam">
                             <option value="">Seleccione una opción</option>
                             <?php echo $comdetContoller->getListaTamanoe();
                             ?>
                         </select>
                      </div>

                      <div class="form-group col-md-4">
                      <label>EMPAQUE</label>
                      <select class="form-control" name="numemp">
                             <option value="">Seleccione una opción</option>
                             <?php echo $comdetContoller->getListaEmpaquee();
                             ?>
                         </select>
                      </div>
                   </div>   
                 </div>


              <div class="card-body">
                <div class="row">

                  <div class="col-4">
                    <label>ANALISIS</label>
                    <select class="form-control" name="tipana">
                    <option value="">Seleccione una opción</option>
                  <?php echo $comdetContoller->getListatipoanae();
                  ?>
                  </select>
                  </div>

                  <div class="col-4">
                    <label>CANTIDAD</label>
                     <input type="text" class="form-control" placeholder="CANTIDAD" name="cantidad"  required value="<?php echo $comdetContoller->getcantidad();
                  ?>">
                  </div>


                  <div class="col-4">
                    <label>TIPO DE MUESTRA</label>
                    <select class="form-control" name="tipomues">
                         <option value="">Seleccione una opción</option>
                         <?php echo $comdetContoller->getListaTipoMuese();
                  ?>
                    </select>
                  </div>

            </div>   
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <label>FECHA O RANGO A RESTRINGIR</label>
                    <input type="text" class="form-control" placeholder="=dd-mm-aa" name="fecres" value="<?php echo $comdetContoller->getfecrese();
                  ?>">
                  </div>

                  <div class="col-6">
                    <label>FECHA O RANGO A HABILITAR</label>
                       <input type="text" class="form-control" placeholder="=dd-mm-aa" name="fechab" value="<?php echo $comdetContoller->getfecpere();
                  ?>">
                  </div>

                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <label>ORDEN</label>
                    <input type="text" class="form-control" name="nvoorden" value="<?php echo $comdetContoller->getorden();
                  ?>">
                   <input type="hidden" class="form-control" name="ordenori" id="ordenori" value="<?php echo $comdetContoller->getorden(); ?>">
                  </div>

                  
                </div>
              </div>


                <button type="submit" class="btn btn-info">GUARDAR</button>
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listacompradet&id=<?php echo $id; ?>"> CANCELAR </a>
              
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
