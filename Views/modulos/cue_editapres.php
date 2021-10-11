<?php $presContoller=new presController();
        $presContoller->editaPres();
        $numc= $presContoller->getnumc();  
        $numte= $presContoller->getnumte();
        $numtam= $presContoller->getnumtam();
        $nompres= $presContoller->getnompres();
 ?>﻿


<section class="content-header">
      <h1>EDITA PRESENTACION</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listapres&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                   

                     <div class="card-body">
                <div class="row">

                  <div class="col-4">
                    <input type="hidden" class="form-control" name="idpres" id="idpres" value="<?php echo $presContoller->getidpres(); ?>">
                    <label>CLIENTE</label>
                    <select class="form-control" name="cliente">
                    <option value="">Seleccione una opción</option>

                    <?php 
                      $rs = Datosnuno::vistaN1Model("ca_nivel1");
                      foreach ($rs as $row) {
                          if (($row["n1_id"]) == $numc) {
                              $opcion = "<option value='" . $row["n1_id"] . "' selected>" . $row["n1_nombre"] . "</option>";
                          } else {
                              $opcion = "<option value='" . $row["n1_id"] . "'>" . $row["n1_nombre"] . "</option>";
                          }
                          echo $opcion;
                      }

                      ?>

                  </select>

                  </div>



                  <div class="col-4">
                    <label>TIPO DE EMPAQUE</label>
                    <select class="form-control" name="tipoemp">
                         <option value="">Seleccione una opción</option>
                         <?php 
                         $rs = DatosCatalogoDetalle::listaCatalogoDetalle(12, "ca_catalogosdetalle");
                         foreach ($rs as $row) {
                            if (($row["cad_idopcion"]) == $numte) {
                                $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                            } else {
                                $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                            }
                            echo $opcion;
                          }?>
                                      </select>
                  </div>

                  <div class="col-4">
                    <label>TAMAÑO</label>
                    <select class="form-control" name="tampres">
                         <option value="">Seleccione una opción</option>
                         <?php 

                         $rs = DatosCatalogoDetalle::listaCatalogoDetalle(13, "ca_catalogosdetalle");
         
                        foreach ($rs as $row) {
                          if (($row["cad_idopcion"]) == $numtam) {
                          $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                          } else {
                          $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                          }
                          echo $opcion;
                        }?>
                         </select>
                  </div>
                  </div>
                </div>
              </div>

                      
                <div class="form-group col-md-12">
                      <label>DESCRIPCION DE PRESENTACION</label>
                      <input type="text" class="form-control" placeholder="DESCRIPCION" name="nompres" id="nompres" value="<?php echo $nompres; ?>" required>
                </div>


                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listapres"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
