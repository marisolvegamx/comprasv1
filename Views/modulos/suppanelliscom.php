 <?php foreach($supMuesCon->listaCompra as $detalle){
 
 ?>
 <div class="listado">
                      <div class="row">
                        <div class="col-md-10 listadoTitulo"><?= $detalle["pro_producto"]?></div>
                        <div class="col-md-2"><?= $detalle["comprados"]."/".$detalle["lid_cantidad"]?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 listadoTitulo"><?= $detalle["desctam"]." ".$detalle["descemp"]?></div>
                      </div>                 
                      <div class="row">
                        <div class="col-md-12"><?= $detalle["desctipa"]?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-12"><?= $detalle["desctipm"]?></div>
                      </div>
                      <div class="row">
                      <div class="col-md-12 listadoLink"><a href="#">VER CÓDIGOS NO PERMITIDOS</a></div>
                      </div>
                      <div class="row">
                      <div class="col-md-12"><?= $detalle["codigosno"]?></div>
                      </div>
      </div>
      <?php }?>
      