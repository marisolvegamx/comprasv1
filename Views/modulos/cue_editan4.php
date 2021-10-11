<?php 
  
  $estructuraController=new EstructuraController();
  $estructuraController->vistaNuevo();
  $nivel=$estructuraController->resultado;
  //var_dump($nivel);
  $idc = filter_input(INPUT_GET, "refer",FILTER_SANITIZE_NUMBER_INT);
                       
  ?>
  <section class="content-header">
  <h1>  <?php echo $estructuraController->titulo2." ".$estructuraController->titulo1?></h1>
  <h1><?php echo $estructuraController->titulo?></h1>
   
  </section>
 
  <section class="content container-fluid">
     <div class="row">
      <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
  
 
  
   <form role="form" method="post" action="<?php echo $estructuraController->action?>">
      <?php     
          $op="";
         
          $RS_SQM_TE = Datosnuno::vistaN1Model("ca_nivel1");
         // var_dump($RS_SQM_TE);
           foreach ($RS_SQM_TE as $registro) {
            if($registro [0]==$nivel["n4_idn1"])
            $op.= "<option value='" . $registro [0] . "' selected='selected'>" . $registro [1] . "</option>";
          else
            $op.= "<option value='" . $registro [0] . "' >" . $registro [1] . "</option>";
            }
              ?>

          <div class="form-group col-md-12">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $nivel["n4_id"]; ?>">

           
               <label>CLIENTE</label>
                    <select class="form-control cascada" name="clanivel1"    data-id="niv-1"
                        data-group="niv-1"
                        data-target="niv-2"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1">
                       <option value="">Seleccione una opción</option>
                        <?php     
                       echo $op;  
                        ?>
                  </select>
                </div>
   

                 <?php     
                  $op="";
                  $region=$nivel["n4_idn2"];
                  $RS_SQM_TE = Datosndos::vistandosModel("ca_nivel2");
         
           foreach ($RS_SQM_TE as $registro) {
            if($registro [0]==$region)
            $op.= "<option value='" . $registro ["n2_id"] . "' selected='selected'>" . $registro ["n2_nombre"] . "</option>";
          else
            $op.= "<option value='" . $registro ["n2_id"] . "' >" . $registro ["n2_nombre"] . "</option>";
            }
              ?>


           <div class="form-group col-md-12">
                  <label>REGION</label>
                  <select class="form-control cascada" name="clanivel2"       data-group="niv-1"
                        data-id="niv-2"
                        data-target="niv-3"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una opción" >
                    <option value="">Seleccione una opción</option>
                   <?php     
                       echo $op;  
                        ?>
                  </select>
                </div>
 

                  <?php     
                  $op="";
                  $region=$nivel["n4_idn3"];
                  $RS_SQM_TE = Datosntres::vistaN3Byn2($nivel["n4_idn2"],"ca_nivel3");
                 // var_dump($RS_SQM_TE);
           foreach ($RS_SQM_TE as $registro) {
            if($registro ["n3_id"]==$region)
            $op.= "<option value='" . $registro ["n3_id"] . "' selected='selected'>" . $registro ["n3_nombre"] . "</option>";
          else
            $op.= "<option value='" . $registro ["n3_id"] . "' >" . $registro ["n3_nombre"] . "</option>";
            }
              ?>
                  <div class="form-group col-md-12">
                  <label>PAIS</label>
                  <select class="form-control cascada" name="clanivel3"       data-group="niv-1"
                        data-id="niv-3"
                        data-target="niv-4"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una opción" >
                    <option value="">Seleccione una opción</option>
                    <?php     
                       echo $op;  
                        ?>
                  </select>
                </div>


        <div class="form-group col-md-6">
            <label >NOMBRE</label>   
            <input name="nombre" class="form-control " type="text"  size="70" value="<?php echo $nivel["n4_nombre"]?>">
         </div>    
            <div class="box-footer" style="border-bottom: hidden">
                 <a  class="btn btn-default pull-right" style="margin-left: 10px" href="<?= $estructuraController->regresar ?>"> Cancelar </a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>

              </div>
             
    </form>
    </div>
</div>
</div>
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
 
 