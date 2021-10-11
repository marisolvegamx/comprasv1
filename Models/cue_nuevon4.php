<?php 
  
  $estructuraController=new EstructuraController();
  $estructuraController->vistaNuevo();
  $nivel=$estructuraController->resultado;

  $idc = filter_input(INPUT_GET, "refer",FILTER_SANITIZE_NUMBER_INT);
    
    function crearOpcionesSelCad($RS_SQM_TE, $seleccion) { 

   
    foreach ($RS_SQM_TE as $registro ) {
    if($registro[0]==$seleccion)
     $op.= "<option value='" . $registro[0] . "'selected='selected' >" . $registro[1] . "</option>";
    else
        $op.= "<option value='" . $registro[0] . "' >" . $registro[1] . "</option>";
    }
    return  $op ;
}                   
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
          foreach ($RS_SQM_TE as $registro) {
             $op.= "<option value='" . $registro [0] . "'>" . $registro [1] . "</option>";
           } 
      ?>
          <div class="form-group col-md-6">
               <label>EMPRESA</label>
                    <select class="form-control" name="clanivel1"    data-id="niv-1"
                        data-group="niv-1"
                        data-target="niv-2"
                        data-url="getNivelN3.php?"
                        data-replacement="container1">
                       <option value="">Seleccione una opción</option>
                        <?php     
                       echo $op;  
                        ?>
                  </select>
                </div>
   
           <div class="form-group col-md-6">
                  <label>REGION</label>
                  <select class="form-control" name="clanivel2"       data-group="niv-1"
                        data-id="niv-2"
                        data-target="niv-3"
                        data-url="getNivelN3.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una compañía" disabled>
                    <option value="">Seleccione una opción</option>
                   
                  </select>
                </div>

                 <div class="form-group col-md-6">
                  <label>PAIS</label>
                  <select class="form-control" name="clanivel3"       data-group="niv-2"
                        data-id="niv-3"
                        data-target="niv-4"
                        data-url="getNivelN4.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una compañía" disabled>
                    <option value="">Seleccione una opción</option>
                   
                  </select>
                </div>
 
        <div class="form-group col-md-6">
            <label >NOMBRE</label>   
            <input name="nombre" class="form-control" type="text" id="nomzona" size="70" value="<?php echo $nivel["descripcion"]?>">
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
</section> 
 
  <!-- /.content-wrapper -->
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
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