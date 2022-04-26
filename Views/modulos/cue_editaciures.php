<?php $ciuresContoller=new ciuresController();
      $ciuresContoller->editaciures();
      
        $idpais= $ciuresContoller->getidpais();  
        $numciures= $ciuresContoller->getnomciu();

 ?>﻿


<section class="content-header">
      <h1>EDITA CIUDAD DE RESIDENCIA</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listaciures&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                  <div class="form-group col-md-12">
                    <label>PAIS</label>
                       <input type="hidden" class="form-control" name="idciures" id="idciures" value="<?php echo $ciuresContoller->getidciu(); ?>">

                    <select class="form-control" name="idpais" id="idpais">
                     <option value="">Seleccione una opción</option>
                    <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(10, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                            
                              if (($row["cad_idopcion"]) == $idpais) {
                                    $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                           
                              } else {
                                    $opcion = "<option value='" . $row["cad_idopcion"] ."'>". $row["cad_descripcionesp"] . "</option>";
                              }

                          echo $opcion; 
                            }?>
                         </select>
                  </div>
                      
                <div class="form-group col-md-12">
                      <label>NOMBRE DE LA CIUDAD</label>
                      <input type="text" class="form-control" placeholder="CIUDAD" name="nomciures" id="nomciures" value=" <?php echo $numciures ?> " required>
                      </div>


                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listaciures"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
