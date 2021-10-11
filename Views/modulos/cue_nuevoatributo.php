 <section class="content-header">
      <h1>NUEVO ATRIBUTO</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listaatributos&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                   

                     <div class="card-body">
                <div class="row">

                    <div class="col-12">
                    <label>TIPO DE EMPAQUE</label>
                    <select class="form-control" name="tipoemp" id="tipoemp">
                         <option value="">Seleccione una opción</option>
                         <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(12, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                            $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              //}
                          echo $opcion; }?>
                                      </select>
                  </div>

                  
                  </div>
                </div>
              </div>

                      
                <div class="form-group col-md-12">
                      <label>ATRIBUTO</label>
                      <input type="text" class="form-control" placeholder="ATRIBUTO" name="nomatr" id="nomatr" required>
                      </div>


                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listaatributos"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
