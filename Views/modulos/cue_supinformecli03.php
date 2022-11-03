<?php
   include "Utilerias/leevar.php";
   include "api/src/contratoapp.php";
   include_once  'Controllers/supMuestraController.php';
  
   $supMuesCon=new SupMuestraController();
   $supMuesCon->vistaMuestra();
?>

<script type="text/javascript">
function noaceptarsec(liga,numsec,idval,muestra,op){
	if(op=="si")
	  ligasub=liga+'&admin=noaceptarseccan&sec='+numsec+'&vasid='+idval+'&iddet='+muestra;
	else
		  ligasub=liga+'&admin=noaceptarsec&sec='+numsec+'&vasid='+idval+'&iddet='+muestra;
	 
	document.getElementById("form_secc").action=ligasub;
	console.log(ligasub);
	document.getElementById("form_secc").submit();
}
function prepararMotivo(){
	document.getElementById('divcanc').style.display='none';
	 document.getElementById('divpreg').style.display='block';
}
</script>
<div class="row" style="margin-top: 5px;">
      <div class="col-md-10 tituloSup" >INFORME DE COMPRA
      </div>
      <div class="col-md-1 tituloSup2" >PANTALLA 6
      </div>
      <div class="col-md-1 " >
              <div class="row">
               <?php
                echo '
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli01&idmes='.$idmes.'&idrec='.$idrec.'&id='.$id.'&cli='.$cli.'&sec='.$sec.'&eta=2"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$id.'&cli='.$cli.'&nummues='.$supMuesCon->numuestra.'&pan=5&eta=2"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$id.'&cli='.$cli.'&eta=2&pan=7&nummues='.$supMuesCon->numuestra.'"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinformecli02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$id.'&cli='.$cli.'&sec='.$sec.'&eta=2&pan=9&nummues='.$supMuesCon->numuestra.'"><img src="Views/dist/img/Avanza-Final.jpg"></a>
                </div>
                ';
                ?>
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">CLIENTE:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supMuesCon->informe["n1_nombre"]?>
      </div>
      <div class="col-md-1 labelAzul1">ÍNDICE:
      </div>
      <div class="col-md-2 labelAzulDatoFecha"><?php echo $supMuesCon->indiceletra?>
      </div>
      <div class="col-md-1 labelAzul1">PLANTA:
      </div>
      <div class="col-md-3 labelAzulDato"><?php echo $supMuesCon->informe["n5_nombre"]?>
      </div>
      <div class="col-md-1 labelAzul1">MUESTRA <?php echo $supMuesCon->numuestra?>
      </div>
      <div class="col-md-1 ">
      <div class="row">
               <div class="col-md-3 tituloSupBotones" >
                <a href="<?php
                
                if($supMuesCon->numuestra>1)
                    echo "index.php?action=supinformecli03&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&pan=6&nummues=1&idsup=&eta=2"?>"> <?php if ($supMuesCon->numuestra==1) echo '<img src="Views/dist/img/Retrocede-Final-off.jpg">'; 
           else echo '  <img src="Views/dist/img/Retrocede-Final.jpg">';  ?></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php  if($supMuesCon->numuestra>1) echo "index.php?action=supinformecli03&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&pan=6&idsup=&eta=2&nummues=".($supMuesCon->numuestra-1)?>"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php
                $classof="-off"; 
                if($supMuesCon->numuestra<sizeof($supMuesCon->muestras)){  $classof=""; echo "index.php?action=supinformecli03&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&pan=6&idsup=&eta=2&nummues=".($supMuesCon->numuestra+1);
                }?>"><img src="Views/dist/img/Avanza-1<?= $classof ?>.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php  if(sizeof($supMuesCon->muestras)>1) echo "index.php?action=supinformecli03&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&pan=6&idsup=&eta=2&nummues=".(sizeof($supMuesCon->muestras))?>"> <?php if(sizeof($supMuesCon->muestras)==$supMuesCon->numuestra) echo '<img src="Views/dist/img/Avanza-Final-off.jpg">';
                else echo ' <img src="Views/dist/img/Avanza-Final.jpg">';?></a>
                </div>
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">TIENDA:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supMuesCon->visita["vi_unedesc"]?>
      </div>
      <div class="col-md-1 labelAzul1">ID TIENDA:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supMuesCon->visita["vi_tiendaid"]?>
      </div>
      <div class="col-md-1 labelAzul1">FECHA:
      </div>
      <div class="col-md-3 labelAzulDato"><?php echo $supMuesCon->visita["fecharep"]?>
      </div>
      <div class="col-md-1 labelAzul1">HORA:
      </div>
      <div class="col-md-1 labelAzulDato"><?php echo $supMuesCon->visita["horarep"]?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">RECOLECTOR:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supMuesCon->informe["rec_nombre"]?>
      </div>
      <div class="col-md-1 labelAzul1">ID INFORME:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supMuesCon->informe["inf_id"]?>
      </div>
      <div class="col-md-1 labelAzul1">COMENTARIOS:
      </div>
      <div class="col-md-5 labelAzulDato"><?php echo $supMuesCon->informe["inf_comentarios"]?>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    
      <?php   if ($admin=="edI"){
             echo '<form role="form" method="post" action="index.php?action=supinformecli03&admin=act&idmes='.$supMuesCon->mesas.'&idrec='.$supMuesCon->rec_id.'&id='.$supMuesCon->idinf.'&cli='.$supMuesCon->idcli.'&nummues='.$supMuesCon->numuestra.'&numpant='.$numpant.'">';
          }?>


      <div class="row">
    <div class="col-md-1 labelAzul1">PRODUCTO:
      </div>
      <div class="col-md-2 labelAzulDato"><?php  
              echo $supMuesCon->muestra["pro_producto"];
          ?>
      </div>
      <div class="col-md-1 labelAzul1">PRESENTACIÓN:
      </div>
      <div class="col-md-2 labelAzulDato"><?php 
              echo $supMuesCon->muestra["presentacion"];
          ?>
      </div>
      <div class="col-md-1 labelAzul1">ANÁLISIS:
      </div>
      <div class="col-md-3 labelAzulDato"><?php  
              echo $supMuesCon->muestra["tipoAnalisis"];
          ?>
      </div>
      <div class="col-md-1 labelAzul1">TIPO MUESTRA:
      </div>
      <div class="col-md-1 labelAzulDato"><?php 
              echo $supMuesCon->muestra["nombreTipoMuestra"];
          ?>
      </div>
    </div>
    <div class="row">
    <div class="col-md-1 labelAzul1">NÚMERO TIENDA:
      </div>
      <div class="col-md-2 labelAzulDato"><?php  echo $supMuesCon->informe["inf_consecutivo"];
          ?>
      </div>
      <div class="col-md-1 labelAzul1">SIGLA PLANTA:
      </div>
      <div class="col-md-2 labelAzulDato"><?php 
      if ($admin=="edI"){
          echo '<input class="form-control form-control-informes" type="text" placeholder="" id="'.ContratoInformesDet::SIGLASPROD.'" name="'.ContratoInformesDet::SIGLASPROD.'" value="'.$supMuesCon->muestra["ind_siglasprod"].'">';
      }else{echo $supMuesCon->muestra["ind_siglasprod"];}
          ?>
      </div>
      <div class="col-md-1 labelAzul1">CÓDIGO QR:
      </div>
      <div class="col-md-3 labelAzulDato"><?php 
      if ($admin=="edI"){
          echo '<input class="form-control form-control-informes" type="text" placeholder="" id="'.ContratoInformesDet::QR.'" name="'.ContratoInformesDet::QR.'" value="'.$supMuesCon->muestra["ind_qr"].'">';
      }else{echo $supMuesCon->muestra["ind_qr"];
      }
          ?>
      </div>

      <div class="col-md-1 labelAzul1">TOMADA DE:
      </div>
      <div class="col-md-1 labelAzulDato"><?php   if ($admin=="edI"){
          $rso = DatosCatalogoDetalle::listaCatalogoDetalle( 8,"ca_catalogosdetalle");
          echo '<select class="form-control form-control-select-informes" id="'.ContratoInformesDet::ORIGEN.'" name="'.ContratoInformesDet::ORIGEN.'">
             <option value="">Seleccione una opción</option>';
          
          
          foreach ($rso as $row) {
              if (($row["cad_idopcion"]) == $supMuesCon->muestra["ind_origen"]) {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
              } else {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
              }
              echo $opcion;
          }
          echo '</select>';
          
      }else{echo $supMuesCon->muestra["origen"];
      }
          ?>
      </div>
    </div>
    <div class="row">
    <div class="col-md-1 labelAzul1">CADUCIDAD:
      </div>
      <div class="col-md-2 labelAzulDato"><?php  if ($admin=="edI"){
          echo '<input type="hidden" name="id" id="id" value="'.$id.'">
         <input type="hidden"  name="cli" id="cli" value="'.$cli.'">
 <input type="hidden"  name="ind_id" id="ind_id" value="'.$supMuesCon->muestra["ind_id"].'">
 <input type="hidden"  name="nummues" id="nummues" value="'.$nummues.'">
          <input type="hidden"  name="idmes" id="idmes" value="'.$idmes.'">
          <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">';
          echo '<input class="form-control form-control-informes" type="text" placeholder="" id="'.ContratoInformesDet::CADUCIDAD.'" name="'.ContratoInformesDet::CADUCIDAD.'" value="'.$supMuesCon->muestra["ind_caducidad"].'">';
          }else{echo $supMuesCon->muestra["ind_caducidad"];
          }
         
                
          ?>
          
      </div>
      <div class="col-md-1 labelAzul1">C PRODUCCIÓN:
      </div>
      <div class="col-md-2 labelAzulDato"><?php  if ($admin=="edI"){
          echo '<input class="form-control form-control-informes" type="text" placeholder="" id="'.ContratoInformesDet::CODIGO.'" name="'.ContratoInformesDet::CODIGO.'" value="'.$supMuesCon->muestra["ind_codigo"].'">';
      }else{echo $supMuesCon->muestra["ind_codigo"];
      }
      ?>
      </div>
     <div class="col-md-1 labelAzul1">VIGENCIA <span style="font-size: 11px">(DIAS)</span>:
      </div>
      <div class="col-md-3 labelAzulDato"><?php 
      $diasvig=$supMuesCon->calcularVigencia($supMuesCon->visita["fecharep"], $supMuesCon->muestra["ind_caducidad"]);
      if($diasvig<30){
          echo '<span style="color:red;">'.$diasvig.'</span>';
      }else
      echo $diasvig;
          ?>
      </div>
      <div class="col-md-1 labelAzul1">COSTO ($):
      </div>
      <div class="col-md-1 labelAzulDato"><?php  if ($admin=="edI"){
          echo '<input class="form-control form-control-informes" type="text" placeholder="" id="'.ContratoInformesDet::COSTO.'" name="'.ContratoInformesDet::COSTO.'" value="'.$supMuesCon->muestra["ind_costo"].'">';
      }else{echo $supMuesCon->muestra["ind_costo"];}?>
      </div>
    </div>
    <div class="row">
    <div class="col-md-1 labelAzul1">DAÑO A:
      </div>
      <div class="col-md-2 labelAzulDato"><?php  if ($admin=="edI"){
          $rs = DatosAtrib::vistaatribModel( "ca_atributo");
          echo '<select class="form-control form-control-select-informes" id="'.ContratoInformesDet::ATRIBUTOA.'" name="'.ContratoInformesDet::ATRIBUTOA.'">
             <option value="">Seleccione una opción</option>';
        
          
          foreach ($rs as $row) {
              if (($row["id_atributo"]) == $supMuesCon->muestra["ind_atributoa"]) {
                  $opcion = "<option value='" . $row["id_atributo"] . "' selected>" . $row["at_nombre"] . "</option>";
              } else {
                  $opcion = "<option value='" . $row["id_atributo"] . "'>" . $row["at_nombre"] . "</option>";
              }
              echo $opcion;
          }
          echo '</select>';
          
            }else{echo $supMuesCon->muestra["atributoa"];}?>
      </div>
      <div class="col-md-1 labelAzul1">DAÑO B:
      </div>
      <div class="col-md-2 labelAzulDato"><?php  if ($admin=="edI"){
          echo '<select class="form-control form-control-select-informes" id="'.ContratoInformesDet::ATRIBUTOB.'" name="'.ContratoInformesDet::ATRIBUTOB.'">
             <option value="">Seleccione una opción</option>';
          
          
          foreach ($rs as $row) {
              if (($row["id_atributo"]) == $supMuesCon->muestra["ind_atributob"]) {
                  $opcion = "<option value='" . $row["id_atributo"] . "' selected>" . $row["at_nombre"] . "</option>";
              } else {
                  $opcion = "<option value='" . $row["id_atributo"] . "'>" . $row["at_nombre"] . "</option>";
              }
              echo $opcion;
          }
          echo '</select>';
      }else{echo $supMuesCon->muestra["atributob"];}
      ?>
      </div>
      <div class="col-md-1 labelAzul1">DAÑO C:
      </div>
      <div class="col-md-3 labelAzulDato"><?php  if ($admin=="edI"){
          echo '<select class="form-control form-control-select-informes" id="'.ContratoInformesDet::ATRIBUTOC.'" name="'.ContratoInformesDet::ATRIBUTOC.'">
             <option value="">Seleccione una opción</option>';
          
          
          foreach ($rs as $row) {
              if (($row["id_atributo"]) == $supMuesCon->muestra["ind_atributoc"]) {
                  $opcion = "<option value='" . $row["id_atributo"] . "' selected>" . $row["at_nombre"] . "</option>";
              } else {
                  $opcion = "<option value='" . $row["id_atributo"] . "'>" . $row["at_nombre"] . "</option>";
              }
              echo $opcion;
          }
          echo '</select>';
      }else{echo $supMuesCon->muestra["atributoc"];}?>
      </div>
      <div class="col-md-1 labelAzul1">DAÑO D:
      </div>
      <div class="col-md-1 labelAzulDato">
      <?php  if ($admin=="edI"){
          echo '<select class="form-control form-control-select-informes" id="atributod" name="atributod">
             <option value="">Seleccione una opción</option>';
          
          
          foreach ($rs as $row) {
             
                  $opcion = "<option value='" . $row["id_atributo"] . "'>" . $row["at_nombre"] . "</option>";
              
              echo $opcion;
          }
          echo '</select>';
      }?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 areaBoton">

  <?php 
        if ($admin=="edI"){
          echo '    
          <button type="submit" class="btn btn-informes btn-sm btn-block">Guardar</button>';

        } else {
             echo '
            <a href="index.php?action=supinformecli03&admin=edI&idmes='.$supMuesCon->mesas.'&idrec='.$supMuesCon->rec_id.'&id='.$supMuesCon->idinf.'&cli='.$supMuesCon->idcli.'&numpant='.$numpant.'&nummues='.$nummues.'" class="btn btn-informes btn-sm btn-block ">EDITAR</a>';
        } 
        ?>




      </div>
    </div>

    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 areaImagen areaScrollP6">
      <div >

<div >
  <div class="img-magnifier-container">
        <img id="myimage1" class="d-block w-100"  src="<?= $supMuesCon->dirimagen.'\\'.$supMuesCon->listaimagenes[0]["ruta"]?>" />
      </div>
      <div style="height: 20px"></div>
     
  </div> 	

</div>
</div>
      <div class="col-md-6 areaImagenDer areaScrollP6 img-magnifier-container">
      <img id="myimage3" class="w-100"   src="<?= $supMuesCon->dirimagen.'\\'.$supMuesCon->listaimagenes[1]["ruta"]?>"/> 
      </div>
      </div>
   
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">

      <div class="col-md-2 areaBoton" > 
    <?php
   
    if ($supMuesCon->correccionFoto["vai_estatus"]==1){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
 echo '
      <a href="" class="btn '.$clase .' btn-sm btn-block" data-toggle="modal" data-target="#modal-motivo" >CORREGIR</a>';
   
    ?> 
        
      </div>
 <?php if ($supMuesCon->correccionFoto["vai_estatus"]==2){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="col-md-2 areaBoton"><a href="<?= $supMuesCon->liga2.'&admin=solcor&est=2&numimg='.$supMuesCon->listaimagenes[0]["id"]?>" class="btn <?= $clase?> btn-sm btn-block ">CANCELAR</a>
      </div>
      <?php if ($supMuesCon->correccionFoto["vai_estatus"]==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="col-md-2 areaBoton"><a href="<?= $supMuesCon->liga2.'&admin=solcor&est=3&numimg='.$supMuesCon->listaimagenes[0]["id"] ?>" class="btn <?= $clase?> btn-sm btn-block ">ACEPTAR</a>
      </div>
  <div class="col-md-6 vacio">
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
</div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario">¿LA FECHA DE CADUCIDAD CAPTURADA ES CORRECTA?
      </div>
      <?php 
      $opcsel=$supMuesCon->getopcsel();
        if ($opcsel==1){
          $clase= "btn-informesActivado";
          
        } else {
        $clase= "btn-informes";
       
        }?>
      <div class="col-md-3 areaBoton" ><a href="<?= $supMuesCon->liga2.'&admin=aceptarsec&sec=10&vasid='.$supMuesCon->idval.'&iddet='.$supMuesCon->muestra["ind_id"] ?>" class="btn btn-informes <?= $clase ?> btn-sm btn-block ">SI</a>
      </div>
        <?php 
      if ($opcsel==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
    ?>
      <div class="col-md-3 areaBoton">
      <a href="" onclick="javascript:prepararMotivo();" class="btn btn-informes btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">NO</a>
      </div>
      
    </div>
   <!-- /.formulario modal para corregir foto-->
        <div class="modal fade" id="modal-motivo">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">CORREGIR</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            


            <form role="form" method="post" action=

        <?php
              echo $supMuesCon->liga2.'&admin=solcor&est=1&numimg='.$supMuesCon->listaimagenes[0]["id"];
            ?>
              >
              
              <p> Escribe el motivo de corrección</p>
              <?php echo '
                  <input type="hidden" name="img" id="img" value='.$supMuesCon->listaimagenes[0]["id"].'>';
              ?>
              <input type="text"  name="observ" id="observ" style="width: 450px;">
              <p>  </p>

              <button type="submit" class="btn btn-primary">Enviar</button>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 </div>
        <div class="modal fade" id="modal-correccion">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            <form role="form" method="post" id="form_secc" action="">
                <div id="divpreg">
              <?php echo '
                
                 <input type="hidden" name="idplan" id="idplan" value="'.$idplan.'"> 
              
                ';
            ?>
              <p> Escribe el motivo </p>
              <input type="text"  name="observacionessec" id="observacionessec" style="width: 450px;">
              <p>  </p>

              <button type="button" class="btn btn-primary" onclick="javascript: document.getElementById('divcanc').style.display='block'; document.getElementById('divpreg').style.display='none'">Actualizar</button>
               </div>
               <div id="divcanc" style="display: none">
              <p>¿Desea cancelar la muestra?</p>
              <?php 
              echo '<button type="button" class="btn btn-secondary" onclick="javascript:noaceptarsec(\''.$supMuesCon->liga2.'\',\''.$numsec.'\',\''.$supMuesCon->idval.'\',\''.$supMuesCon->numuestra.'\',\'si\')">Sí</button>
               <button type="button" class="btn btn-primary" onclick="javascript:noaceptarsec(\''.$supMuesCon->liga2.'\',\''.$numsec.'\',\''.$supMuesCon->idval.'\',\''.$supMuesCon->numuestra.'\',\'no\')">No</button>';
             ?> </div>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    
<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage1", 2);

magnify("myimage3", 2);
</script>