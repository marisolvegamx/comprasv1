 <?php $recContoller=new recController();
        $recContoller->vistaNuevoRecolector();
 ?>﻿


<section class="content-header">
      <h1>NUEVO PRODUCTO</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listaprod&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                   

              <div class="card-body">
                <div class="row">

                  <div class="col-4">
                    <label>CLIENTE</label>
                    <select class="form-control" name="cliente">
                          <option value="">Seleccione una opción</option>
                        <?php $rs = Datosnuno::vistaN1Model("ca_nivel1");
                        foreach ($rs as $row) {
                        $opcion = "<option value='" . $row["n1_id"] . "'>" . $row["n1_nombre"] . "</option>";
                        echo $opcion; }?>
                    </select>
                  
                  </div>


                  <div class="col-4">
                    <label>CATEGORIA</label>
                    <select class="form-control" name="categoria">
                          <option value="">Seleccione una opción</option>
                        <?php $rs = DatosCatalogoDetalle::listaCatalogoDetalle(5, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                            $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              //}
                          echo $opcion; }?>
                    </select>
                  
                  </div>
              </div>

              <div class="row">
                <div class="form-group col-md-12">
                      <label>NOMBRE DEL PRODUCTO</label>
                      <input type="text" class="form-control" placeholder="PRODUCTO" name="producto" required>
                      </div>
                     </div> 

<div class="row">
                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listarecolector"> CANCELAR </a> ';
                 ?>
                 </div>
              </form>  
</div>
              </div></div>
              </div>
            </section>
