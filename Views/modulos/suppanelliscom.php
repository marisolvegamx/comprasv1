 <?php 
 
 foreach($supMuesCon->listaCompra as $detalle){
    // var_dump($detalle);
    // echo $supMuesCon->muestra["ind_comprasid"]."--",$supMuesCon->muestra["ind_compraddetid"];
    // echo "**".$detalle["lid_idlistacompra"]."--".$detalle["lid_idlistacompra"];
     if($supMuesCon->muestra["ind_comprasid"]==$detalle["lid_idlistacompra"]&&$supMuesCon->muestra["ind_compraddetid"]==$detalle["lid_idprodcompra"])
         $clasesel="background-color: #ffffcc;";
         else $clasesel="";
 ?>
 <div class="listado" style="<?= $clasesel?>" >
                      <div class="row">
                        <div class="col-md-10 listadoTitulo"><?= $detalle["pro_producto"]?></div>
                        <div class="col-md-2"><?= ($detalle["lid_saldoaceptado"]==""?0:$detalle["lid_saldoaceptado"])."/".($detalle["comprados"]==""?0:$detalle["comprados"])."/".$detalle["lid_cantidad"]?></div>
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
                      <div class="col-md-12 listadoLink"><a class="vercods" href="javascript:vercodigos('codigosnop<?=$detalle['lid_idprodcompra']?>');">VER CÓDIGOS NO PERMITIDOS</a></div>
                      </div>
                      
                      <div class="row ocodigosnop codigosnop<?=$detalle["lid_idprodcompra"] ?>">
                      <div class="col-md-12"><?= $detalle["codigosnop"]?></div>
                      </div>
                       <?php foreach($detalle["Infcd"] as $detbu){
 
 ?>
 <div style="margin-left: 20px; margin-top:10px;" >
                      <div class="row">
                        <div class="col-md-10 listadoTitulo"><?= $detbu["pro_producto"]?></div>
                        <div class="col-md-2"><?= ($detbu["ind_estatus"]==3?1:0)."/1/0"?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 listadoTitulo"><?= $detbu["presentacion"]." ".$detbu["empaque"]?></div>
                      </div>                 
                      <div class="row">
                        <div class="col-md-12"><?= $detbu["tipoAnalisis"]?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-12"><?= $detbu["nombreTipoMuestra"]?></div>
                      </div>
                     
      </div>
      <?php }?>
      
      </div>
      <?php }?>
      