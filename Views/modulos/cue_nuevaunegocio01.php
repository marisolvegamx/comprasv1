 <?php $unegocioContoller=new unegocioController();
                        $unegocioContoller->vistaNuevoUnegocio();
                        $idc = filter_input(INPUT_GET, "refer",FILTER_SANITIZE_NUMBER_INT);
                      
                    ?>﻿
<section class="content-header">
      <h1>AGREGAR TIENDA </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <?php echo $unegocioContoller->getMensaje()?>
      
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listaunegocio&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                <div class="form-group col-md-12">
                  <label>NOMBRE</label>
                  <input type="hidden" class="form-control" name="ncuenta" id="ncuenta" value="<?php echo $idc?>" >
                  <input type="text" class="form-control" name="desuneg" id="desuneg" required>
                <input name="numpun" type="hidden" value="<?= $unegocioContoller->getNumpunto() ?>" >
                </div>
                
               <div class="form-group col-md-6">
                  <label>COORDENADASXY</label>
                  <input type="text" class="form-control" name="une_dir_telefono" id="une_dir_telefono" >
                </div>
                <div class="form-group col-md-6">
                  <label>ESTATUS</label>
                  <select class="form-control" name="estatus">
                       <option value="">Seleccione una opción</option>
                   <?php foreach($unegocioContoller->getListaEstatus() as $estatus){
                     echo $estatus ;
                  }?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label>TIPO DE TIENDA</label>
                  <select class="form-control" name="estatus">
                       <option value="">Seleccione una opción</option>
                   <?php foreach($unegocioContoller->getListaTipoTienda() as $tipotienda){
                     echo $tipotienda;
                  }?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label>CADENA COMERCIAL</label>
                  <select class="form-control" name="estatus">
                       <option value="">Seleccione una opción</option>
                   <?php foreach($unegocioContoller->getListaCadena() as $cadena){
                     echo $cadena ;
                  }?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label>PUNTO CARDINAL</label>
                  <select class="form-control" name="estatus">
                       <option value="">Seleccione una opción</option>
                   <?php foreach($unegocioContoller->getListaPuntoc() as $puntoC){
                     echo $puntoC ;
                  }?>
                  </select>
                </div>




                <!-- Clasificación punto de venta -->
                <br>
                <div class="col-md-12">
                <h4>CLASIFICACIÓN</h4>
                </div>
                <div class="form-group col-md-6">
                  <label>CLIENTE</label>
                  <select class="form-control" name="clanivel1"    data-id="category"
                        data-group="niv-1"
                        data-target="niv-2"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1">
                       <option value="">Seleccione una opción</option>
                     <?php foreach($unegocioContoller->getListanivel1() as $nivel1){
                     echo $nivel1 ;
                  }?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>REGION</label>
                  <select class="form-control" name="clanivel2"       data-group="niv-1"
                        data-id="niv-2"
                        data-target="niv-3"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una region" disabled>
                    <option value="">Seleccione una opción</option>
                   
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>PAIS</label>
                  <select class="form-control" name="clanivel3" 
                        data-group="niv-1"
                        data-id="niv-3"
                        data-target="niv-4"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione un pais" disabled>
                    <option value="">Seleccione una opción</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label>CIUDAD</label>
                  <select class="form-control" name="clanivel4" 
                        data-group="niv-1"
                        data-id="niv-4"
                        data-target="niv-5"
                        data-url="getNivelUnegocio.php?"
                        data-replacement="container1"
                        data-default-label="Seleccione una ciudad" disabled>
                 
                  </select>
                </div>
                
                
                <!-- Dirección punto de venta -->
               <br>
               <div class="col-md-12">
                <h4>DIRECCIÓN</h4>
                </div>
               <div class="form-group col-md-12">
                  <label>CALLE</label>
                  <input type="text" class="form-control" name="calle" id="calle" >
                </div>
                
               <div class="form-group col-md-3">
                  <label>NUM. EXTERIOR</label>
                  <input type="text" class="form-control" name="numext" id="numext" >
                </div>
                
                
                <div class="form-group col-md-3">
                  <label>NUM. INTERIOR</label>
                  <input type="text" class="form-control" name="numint" id="numint" >
                </div>
				
                <div class="form-group col-md-3">
                  <label>MANZANA</label>
                  <input type="text" class="form-control" name="mz" id="mz" >
                </div>
                <div class="form-group col-md-3">
                  <label>LOTE</label>
                  <input type="text" class="form-control" name="lt" id="lt">
                </div>
                <div class="form-group col-md-6">
                  <label>COLONIA</label>
                  <input type="text" class="form-control" name="col" id="col" >
                </div>
                <div class="form-group col-md-6">
                  <label>DELEGACIÓN</label>
                  <input type="text" class="form-control" name="del" id="del" >
                </div>
                <div class="form-group col-md-6">
                  <label>CIUDAD</label>
                  <input type="text" class="form-control" name="une_dir_municipio" id="une_dir_municipio" >
                </div>
                <div class="form-group col-md-3">
                  <label>C.P.</label>
                  <input type="text" class="form-control" name="une_dir_cp" id="une_dir_cp" >
                </div>
                <div class="form-group col-md-9">
                  <label>COMPLEMENTO</label>
                  <input type="text" class="form-control" name="une_dir_referencia" id="une_dir_referencia" >
                </div>
                 
                 <!-- Pie de formulario -->
                 <div class="box-footer col-md-12">
                 <div class="pull-right">
                      <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 echo '
                 <a  class="btn btn-default" style="margin-left: 10px" href="index.php?action=listaunegocio&idc='.$idc.'"> CANCELAR </a> ';
                 ?>
                 </div>
              </div>
              </form>
              </div>
              </div>
            </div>
     
        </div>
	 </section>
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/jquery.cascading-drop-down.js"></script>
    <script>
    $('.form-control').ssdCascadingDropDown({
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
    <!-- /.content -->
  </div>
