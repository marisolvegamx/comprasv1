<?php $unegocioContoller=new unegocioController();
      $unegocioContoller->vistaEditaUnegocio();
           $pais= $unegocioContoller->getPais();  
           $ciudad= $unegocioContoller->getciudad();
           $tipotienda= $unegocioContoller->gettipotienda();
           $cadcom= $unegocioContoller->getcadcom();
           $puncar= $unegocioContoller->getpuncar();
           $estatus= $unegocioContoller->getestatus();
                    ?>

<section class="content-header">
      <h1>EDITA TIENDA  </h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listaunegocio&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                    <div class="row">
                    <div class="form-group col-md-12">
                      <label>NOMBRE</label>
                      <input type="text" class="form-control" placeholder="NOMBRE DE TIENDA" name="nomuneg" id="nomuneg" value="<?php echo $unegocioContoller->getdesc(); ?>"  required>
                      <input type="hidden" class="form-control" name="idpv" id="idpv" value="<?php echo $unegocioContoller->getidt(); ?>">
                      </div>
					</div>
  
                     <div class="row">

                      <div class="form-group col-md-12">
                      <label>DIRECCION</label>
                      <input type="text" class="form-control" placeholder="DIRECCION" name="dirtien" id="dirtien" value="<?php echo $unegocioContoller->getDirec(); ?>" required>
                      </div>                    

                    </div>
            
              <div class="row">

                    <div class="col-6">
                    <label>PAIS</label>
                    <select class="form-control cascada" name="paisuneg" data-id="pais"
                        data-group="category"
                        data-target="ciudad"
                        data-url="getPaisesCiudades.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una opci??n">
                
                            <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(10, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == $pais) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; 
                    }?>
                  </select>
                </div>
                  <div class="col-6">
                    <label>CIUDAD</label>
                     <select class="form-control cascada" name="ciudaduneg" data-id="ciudad"
                        data-group="category"
                        data-target=""
                     
                        data-replacement="container1"
                        data-default-label="Seleccione una opci??n">
                    <option value="">Seleccione una opci??n</option>
                  <?php $rs = DatosCiudadesResidencia::listaCiudadesxPais($pais, "ca_ciudadesresidencia");
                          foreach ($rs as $row) {
                              if (($row["ciu_id"]) == $ciudad) {
                              $opcion = "<option value='" . $row["ciu_id"] . "' selected>" . $row["ciu_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["ciu_id"] . "'>" . $row["ciu_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }?>
                  </select>
                


              </div>
	</div>
   <div class="card-body">  
            <div class="row">
                  
              <div class="form-group col-md-6">
                  <label>COORDENADAS XY</label>
                  <input type="text" class="form-control" placeholder="COORDENADAS XY" name="cxy" id="cxy">
              </div>

                  <div class="col-6">
                    <label>PUNTO CARDINAL</label>
                    <select class="form-control" name="puncaruneg">
                         <option value="">Seleccione una opci??n</option>
                         <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(4, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == $puncar) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }?>
                                      </select>
                  </div>
                </div>
                </div>
 
                      
              <div class="row">
                <div class="col-4">
                      <label>TIPO DE TIENDA</label>
                      <select class="form-control" name="tipouneg">
                         <option value="">Seleccione una opci??n</option>
                         <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(2, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) ==$tipotienda) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }?>
                                      </select>
                      </div>

                     <div class="col-4">
                      <label>CADENA COMERCIAL</label>
                      <select class="form-control" name="cadcomuneg">
                         <option value="">Seleccione una opci??n</option>
                         <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(1, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == $cadcom) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }?>
                                      </select>
                      </div>



                  <div class="col-4">
                    <label>ESTATUS</label>
                    <select class="form-control" name="estatusuneg">
                         <option value="">Seleccione una opci??n</option>
                         <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(3, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) ==$estatus) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }?>
                                      </select>
              
              </div>
                	</div>
   <div class="card-body">      
                  <div class="row">
                      <div class="col-md-12">
                      <label>REFERENCIA</label>
                      <input type="text" class="form-control" placeholder="OTROS DATOS DE LA TIENDA" name="refer" id="refer" value="<?php echo $unegocioContoller->getRef(); ?>" required>
                      </div>
                   </div>   
              

           
              <div class="row" style="margin-top: 10px">
              
                   <button type="submit" class="btn btn-info float-sm-right">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listaunegocio"> CANCELAR </a> ';
                 ?>
             </div>
             </div>    
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
            
