<?php $prodContoller=new prodController();
        $prodContoller->editaProd();
        $numc= $prodContoller->getnumc();  
        $numte= $prodContoller->getnumca();
        $nomprod= $prodContoller->getnomprod();
 ?>﻿


<section class="content-header">
      <h1>EDITA PRODUCTO</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listaprod&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                   
                     <div class="card-body">
                <div class="row">

                  <div class="col-6">
                    <input type="hidden" class="form-control" name="idprod" id="idprod" value="<?php echo $prodContoller->getidprod(); ?>">
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



                  <div class="col-6">
                    <label>CATEGORIA</label>
                    <select class="form-control" name="categoria">
                         <option value="">Seleccione una opción</option>
                         <?php 
                         $rs = DatosCatalogoDetalle::listaCatalogoDetalle(5, "ca_catalogosdetalle");
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

                
                  </div>
                </div>
              </div>

                      
                <div class="form-group col-md-12">
                      <label>NOMBRE PRODUCTO</label>
                      <input type="text" class="form-control" placeholder="DESCRIPCION" name="nomprod" id="nomprod" value="<?php echo $nomprod; ?>" required>
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
