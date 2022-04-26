<?php $Sustit=new sustitucionController();
        $Sustit->editaSustit();
        $numclien= $Sustit->getnumclien();
       // echo $numclien;
        $numprod= $Sustit->getnumprod();  
        $nomtam= $Sustit->getnomtam();
        $tipemp= $Sustit->gettipemp();
        $idsus= $Sustit->getidsus();

 ?>﻿


<section class="content-header">
      <h1>EDITA SUSTITUCION</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listasustitucion&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                   
                     <div class="card-body">

                <div class="row">

                <div class="form-group col-md-12">
                          <label>CLIENTE</label>
                            <select class="form-control cascada" name="clanivel1"    
                                  data-id="niv-1"
                                    data-group="niv-1"
                                  data-target="producto"
                                  data-url="getproductocliente.php?"
                                  data-replacement="container1"
                                  data-default-label="Seleccione una opcion"  >
                           <option value="">Seleccione una opción</option> 
                           <?php 
                           $respuesta =Datosnuno::vistaN1Model("ca_nivel1");

                              foreach ($respuesta as $row) {
                                  if (($row["n1_id"]) == $numclien) {
                                  $opcion = "<option value='" . $row["n1_id"] . "' selected>" . $row["n1_nombre"] . "</option>";
                                }else{
                                     $opcion = "<option value='" . $row["n1_id"] . "'>" . $row["n1_nombre"] . "</option>";
                                }
                                echo $opcion; 
                                }?>
                           </select>
                        </div>

                  <div class="col-12">
                    <label>PRODUCTO</label>
                        <select class="form-control" name="numprod"
                         data-id="producto"
                                  data-group="niv-1"
                                  data-replacement="container1"
                                  data-default-label="Seleccione una opcion"  >
                         <option value="">Seleccione una opción</option>
                         <?php 
                        // $respuesta =DatosProd::vistaprodModel("ca_productos");
                         $respuesta=DatosProd::listaprodModel($numclien,"ca_productos");
                         foreach ($respuesta as $row) {
                            if (($row["pro_id"]) == $numprod) {
                                $opcion = "<option value='" . $row["pro_id"] . "' selected>" . $row["pro_producto"] . "</option>";
                            } else {
                                $opcion = "<option value='" . $row["pro_id"] . "'>" . $row["pro_producto"] . "</option>";
                            }
                            echo $opcion;
                          }?>
                         </select>

                  </div>
              </div>
</div>
 <div class="card-body">

                <div class="row">

                  <div class="col-12">
                    <label>TIPO DE EMPAQUE</label>
                     <input type="hidden" class="form-control" name="idsus" id="idsus" value="<?php echo $idsus ?>">
                    <select class="form-control" name="tipemp">
                         <option value="">Seleccione una opción</option>
                         <?php 
                         $rs = DatosCatalogoDetalle::listaCatalogoDetalle(12, "ca_catalogosdetalle");
                         foreach ($rs as $row) {
                            if (($row["cad_idopcion"]) == $tipemp) {
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
          
<div class="card-body">

                <div class="row">
                      
                <div class="form-group col-md-12">
                  <label>TAMAÑO</label>
                   <select class="form-control" name="nomtam" id="nomtam">
                     <option value="">Seleccione una opción</option>
                     <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(13, "ca_catalogosdetalle");
 
                       foreach ($rs as $row) {
                            if (($row["cad_idopcion"]) == $tipemp) {
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

                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listasustitucion"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>

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
