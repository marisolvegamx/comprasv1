 <?php $recContoller=new recController();
        $recContoller->vistaNuevoRecolector();
 ?>﻿


<section class="content-header">
      <h1>NUEVO RECOLECTOR</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listarecolector&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                    <div class="form-group col-md-12">
                      <label>NOMBRE</label>
                      <input type="text" class="form-control" placeholder="NOMBRE COMPLGETO" name="nomrec" id="nomrec" required>
                      </div>

                      <div class="form-group col-md-12">
                      <label>DIRECCION CASA</label>
                      <input type="text" class="form-control" placeholder="DIRECCION" name="dircasa" id="desuneg" required>
                      </div>

                      <div class="form-group col-md-12">
                      <label>DIRECCION DE ENVIO DE ETIQUETAS</label>
                      <input type="text" class="form-control" placeholder="DIRECCION 2" name="direti" id="desuneg" required>
                      </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-4">
                    <label>PAIS</label>
                    <select class="form-control" name="paisrec">
                    <option value="">Seleccione una opción</option>
                  <?php echo $recContoller->getListaPais();
                  ?>
                  </select>
                  </div>



                  <div class="col-4">
                    <label>TIPO</label>
                    <select class="form-control" name="tiporec">
                         <option value="">Seleccione una opción</option>
                         <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(9, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == 1) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }?>
                                      </select>
                  </div>

                  <div class="col-4">
                    <label>NO. TARJETA</label>
                    <input type="text" class="form-control" placeholder="NUM TARJETA" name="numtarjeta">
                  </div>
                </div>
              </div>

                      


                    <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>EMAIL TRABAJO</label>
                    <input type="text" class="form-control" placeholder="EMAIL TRAB" name="emailtrab">
                  </div>
                  <div class="col-4">
                    <label>EMAIL PERSONAL</label>
                    <input type="text" class="form-control" placeholder="EMAIL PERSONAL" name="emailper">
                  </div>
                  <div class="col-4">
                    <label>NO. CELULAR</label>
                    <input type="text" class="form-control" placeholder="NUM CELULAR" name="numcel">
                  </div>
                </div>
              </div>


                    <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>TELEFONO CASA</label>
                    <input type="text" class="form-control" placeholder="TEL CASA" name="telcasa">
                  </div>
                  <div class="col-4">
                    <label>TELEFONO OFICINA</label>
                    <input type="text" class="form-control" placeholder="TEL OFICINA" name="telofi">
                  </div>
                  <div class="col-4">
                    <label>TELEFONO FAMILIAR</label>
                    <input type="text" class="form-control" placeholder="TEL FAMILIAR" name="telfam">
                  </div>
                </div>
              </div>



                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listarecolector"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
