 <?php $comdetContoller=new ListaComDetController();
        $comdetContoller->vistaNuevoProductoCompra();
 ?>﻿


<section class="content-header">
      <h1>NUEVO PRODUCTO A COMPRAR</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
    
        <div class="col-md-12">
             <div class="box box-info">
             <div class="card-body">
                 <form role="form" method="post" action="index.php?action=listacompradet&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                <div class="row">
                    <div class="form-group col-md-4">
                      <input type="hidden" class="form-control" name="idlista" id="idlista" value="<?php echo $comdetContoller->getnumLista(); ?>">
                      <label>PRODUCTO</label>
                            <select class="form-control" name="numprod" autofocus>
                             <option value="">Seleccione una opción</option>
                             <?php echo $comdetContoller->getListaProducto();
                             ?>
                         </select>
                      </div>

                      <div class="form-group col-md-4">
                         <label>TAMAÑO</label>
                         <select class="form-control" name="numtam">
                             <option value="">Seleccione una opción</option>
                             <?php echo $comdetContoller->getListaTamano();
                             ?>
                         </select>
                      </div>

                      <div class="form-group col-md-4">
                      <label>EMPAQUE</label>
                      <select class="form-control" name="numemp">
                             <option value="">Seleccione una opción</option>
                             <?php echo $comdetContoller->getListaEmpaque();
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
                  <?php echo $comdetContoller->getListatipoana();
                  ?>
                  </select>
                  </div>

                  <div class="col-4">
                    <label>CANTIDAD</label>
                     <input type="text" class="form-control" placeholder="CANTIDAD" name="cantidad"  required>
                    
                  </div>


                  <div class="col-4">
                    <label>TIPO DE MUESTRA</label>
                    <select class="form-control" name="tipomues">
                         <option value="">Seleccione una opción</option>
                         <?php echo $comdetContoller->getListaTipoMues();
                  ?>
                    </select>
                  </div>

            </div>   
              </div>
              <div class="card-body">
                <div class="row">


                  <div class="col-6">
                    <label>FECHA O RANGO A RESTRINGIR</label>
                    <input type="text" class="form-control" placeholder="=dd-mm-aa" name="fecres">
                  </div>

                  <div class="col-6">
                    <label>FECHA O RANGO A HABILITAR</label>
                       <input type="text" class="form-control" placeholder="=dd-mm-aa" name="fechab">
                  </div>

                </div>
              </div>

                <button type="submit" class="btn btn-info">GUARDAR</button>
               
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listacompradet&id=<?php echo $comdetContoller->getnumLista(); ?>"> CANCELAR </a>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
