<?php 


  include_once  'Controllers/supMuestraController.php';

  include "api/src/contratoapp.php";
  include "Utilerias/leevar.php";
 
  $supMuesCon=new SupMuestraController();
  $supMuesCon->vistaMuestra();
  //var_dump($supMuesCon->muestra);

  // $enlacesModel == "supinformecli02" ||

  //clave mari AIzaSyANZ_tj0m9KI-W0MZKmXImqpH_V6AkJgfI
  ?>

   <script type="text/javascript">
    $( document ).ready(function() {
  
	$(".ocodigosnop").css('display', 'none');
	});
	
    function vercodigos(selector){
    	$("."+selector).toggle(400);
       
    	
    	}
	function noaceptarsec(liga,numsec,idval,op){
		if(op=="si")
		  ligasub=liga+'&admin=noaceptarseccan&sec='+numsec+'&vasid='+idval;
		else
			  ligasub=liga+'&admin=noaceptarsec&sec='+numsec+'&vasid='+idval;
		 
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
      <div class="col-md-1 tituloSup2" >PANTALLA <?= $pan?>
      </div>
      <div class="col-md-1 " >
              <div class="row">
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo $supMuesCon->getLigapanp()?>"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php if($pan==7){
                    echo "index.php?action=supinformecli03&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&cli=".$supMuesCon->idcli."&idsup=".$supMuesCon->idsup."&eta=".$supMuesCon->etapa."&pan=".($pan-1)."&nummues=".$supMuesCon->numuestra;}
                    if($pan==5){
                        echo "index.php?action=supinformecli01&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&cli=".$supMuesCon->idcli."&eta=".$supMuesCon->etapa."&pan=".($pan-1)."&idsup=".$supMuesCon->idsup."&nummues=".$supMuesCon->numuestra;
                    }else{
                        echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&idsup=".$supMuesCon->idsup."&id=".$id."&cli=".$supMuesCon->idcli."&eta=".$supMuesCon->etapa."&pan=".($pan-1)."&nummues=".$supMuesCon->numuestra;
                    }?>"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a <?php if($pan==9){
                   echo "class='disabled'";
                }
                    ?>href="<?php 
                $classof="";
                if($pan==9){
                   $classof="-off";
                    if($supMuesCon->numuestra<sizeof($supMuesCon->muestras)){
                        echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&eta=".$supMuesCon->etapa."&idsup=".$supMuesCon->idsup."&cli=".$supMuesCon->idcli."&pan=5&nummues=".($supMuesCon->numuestra+1);
                        $classof="";
                    }
                }else
                if($pan==5){
                    echo "index.php?action=supinformecli03&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&cli=".$supMuesCon->idcli."&idsup=".$supMuesCon->idsup."&eta=".$supMuesCon->etapa."&pan=".($pan+1)."&nummues=".$supMuesCon->numuestra;}
                else{
                    if(($pan+1)==9&&$supMuesCon->idcli>4){ //no voy a la 9
                     
                        $classof="-off";
                    }else
                    echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idsup=".$supMuesCon->idsup."&idrec=".$supMuesCon->rec_id."&id=".$id."&cli=".$supMuesCon->idcli."&eta=".$supMuesCon->etapa."&pan=".($pan+1)."&nummues=".$supMuesCon->numuestra;}
                        
                    
                    ?>"><img src="Views/dist/img/Avanza-1<?= $classof?>.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo $supMuesCon->getLigapanu()?>"><img src="Views/dist/img/Avanza-Final<?= $classof?>.jpg"></a>
                </div>
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
                echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&eta=".$supMuesCon->etapa."&idsup=".$supMuesCon->idsup."&cli=".$supMuesCon->idcli."&pan=".$pan."&nummues=1"?>">
           <?php if ($supMuesCon->numuestra==1) echo '<img src="Views/dist/img/Retrocede-Final-off.jpg">'; 
           else echo '  <img src="Views/dist/img/Retrocede-Final.jpg">';  ?>
              
                
                </a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php if ($supMuesCon->numuestra>1) echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&eta=".$supMuesCon->etapa."&idsup=".$supMuesCon->idsup."&cli=".$supMuesCon->idcli."&pan=".$pan."&nummues=".($supMuesCon->numuestra-1)?>"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" >
                <a href="<?php 
              
               
                    $classof="-off";
                    if($supMuesCon->numuestra<sizeof($supMuesCon->muestras)){
                    echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&eta=".$supMuesCon->etapa."&idsup=".$supMuesCon->idsup."&cli=".$supMuesCon->idcli."&pan=".$pan."&nummues=".($supMuesCon->numuestra+1);
                    $classof="";
                    }?>"><img src="Views/dist/img/Avanza-1<?= $classof ?>.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a  href="<?php 
                if(sizeof($supMuesCon->muestras)>1) echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$id."&eta=".$supMuesCon->etapa."&cli=".$supMuesCon->idcli."&idsup=".$supMuesCon->idsup."&pan=".$pan."&nummues=".sizeof($supMuesCon->muestras)?>">
                <?php if(sizeof($supMuesCon->muestras)==$supMuesCon->numuestra) echo '<img src="Views/dist/img/Avanza-Final-off.jpg">';
                else echo ' <img src="Views/dist/img/Avanza-Final.jpg">';?>
               </a>
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
      <div class="col-md-3 labelAzulDato"><?php echo Utilerias::verFecha($supMuesCon->visita["fecharep"])?>
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
    <!-- esto va en otro archivo -->
   <?php   if ($admin=="edI"){
       echo '<form role="form" method="post" action="index.php?action=supinformecli02&admin=act&idmes='.$supMuesCon->mesas.'&idrec='.$supMuesCon->rec_id."&idsup=".$supMuesCon->idsup.'&id='.$id.'&cli='.$supMuesCon->idcli.'&nummues='.$supMuesCon->numuestra.'&pan='.$pan.'">';
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
      echo $supMuesCon->muestra["presentacion"]." ".$supMuesCon->muestra["empaque"];
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
    <div class="col-md-1 labelAzul1">TIENDA:
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
          echo '<input class="form-control form-control-informes" type="text" placeholder="" id="'.ContratoInformesDet::CADUCIDAD.'" name="'.ContratoInformesDet::CADUCIDAD.'" value="'.$supMuesCon->muestra["caducidad"].'">';
          }else{echo $supMuesCon->muestra["caducidad"];
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
          $rs = DatosAtrib::getArtributosxcli($cli, "ca_atributo");
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
      <div class="col-md-12 areaBotonDer">
       <?php 
        if ($admin=="edI"){
          echo '    
          <button type="submit" class="btn btn-informes btn-sm btn-block">GUARDAR</button>';

        } else {
             echo '
            <a href="'.$supMuesCon->liga.'&admin=edI" class="btn btn-informes btn-block ">EDITAR</a>';
        } 
        ?>
     
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor"></div>
    </div>
    
    
 <?php 
 $claseboton="col-md-2";
 if($pan==5){
     include "suppanelfotos.php";}
     if($pan==7){
         include "suppanelfotos07.php";}
         if($pan==8){
             include "suppanelfotos08.php";
           
         }
             if($pan==9){
                 include "suppanelfotos09.php";
                 $claseboton="col-md-4";
             }
             if($pan!=8){
     ?>

 
    <div class="row">

      <div class="<?= $claseboton?> areaBoton" > 
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
      <div class="<?= $claseboton?> areaBoton"><a href="<?= $supMuesCon->liga.'&admin=solcor&est=2&numimg='.$supMuesCon->listaimagenes[0]["id"]?>" class="btn <?= $clase?> btn-sm btn-block ">CANCELAR</a>
      </div>
      <?php if ($supMuesCon->correccionFoto["vai_estatus"]==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="<?= $claseboton?> areaBoton"><a href="<?= $supMuesCon->liga.'&admin=solcor&est=3&numimg='.$supMuesCon->listaimagenes[0]["id"] ?>" class="btn <?= $clase?> btn-sm btn-block ">ACEPTAR</a>
      </div>
    <?php  if($pan!=9){ ?>
        <div class="col-md-6 vacio">
      </div>
    <?php }?>
    </div>
<?php }?>
 
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario"><?php echo $supMuesCon->pantalla["pa_preguntaseccion"]?>
      </div>
      <div class="col-md-3 areaBoton" >  <?php 
        $opcsel=$supMuesCon->getopcsel();
        if($pan==5){ 
            if ($opcsel==1){
              $clase= "btn-informesActivado disabled";
              
            } else if ($opcsel==3){
                $clase= "btn-informes disabled";
            }else{
            $clase= "btn-informes";
           
            }
        }else {
            if ($opcsel==1){
                $clase= "btn-informesActivado disabled";
                
            } else{
                $clase= "btn-informes";
        }
        }
        $numsec=$supMuesCon->pantalla["pa_seccion"];
       // if($supMuesCon->idcli==5)
       //     $numsec=$numsec+1;
       //     if($supMuesCon->idcli==6)
       //         $numsec=$numsec+2;
        echo '
        <a href="'.$supMuesCon->liga.'&admin=aceptarsec&sec='.$numsec.'&vasid='.$supMuesCon->idval.'&iddet='.$supMuesCon->muestra["ind_id"].'" class="btn '.$clase .' btn-sm btn-block ">SI</a>';
        ?>
      </div>
      <div class="col-md-3 areaBoton">
        <?php 
        if($pan==5){ 
          if ($opcsel==3){
              $clase= "btn-informesActivado disabled";
              
          }else if ($opcsel==1){
              $clase= "btn-informes disabled";
          }
              else {
          
            $clase= "btn-informes";
           
          }
        }
        else{
            if ($opcsel==3){
                $clase= "btn-informesActivado disabled";
                
            }
            else {
                
                $clase= "btn-informes";
                
            }
        }
    
      echo '
        <a onclick="javascript:prepararMotivo();" href="" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">NO</a>';
        ?>
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
            


            <form role="form" method="post" action="

        <?php
              echo $supMuesCon->liga.'&admin=solcor&est=1&numimg='.$supMuesCon->listaimagenes[0]["id"];
            ?>"
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
              
            <form role="form" method="post" action="" id="form_secc">
            <div id="divpreg">
              <?php echo '
                
                 <input type="hidden" name="idplan" id="idplan" value="'.$idplan.'"> 
                 <input type="hidden" name="iddet" id="iddet" value="'.$supMuesCon->muestra["ind_id"].'"> 
                ';
            ?>
              <p> Escribe el motivo </p>
              <input type="text"  name="observacionessec" id="observacionessec" style="width: 450px;" value="<?php $supMuesCon->valSeccion["vas_observaciones"]?>">
              <p>  </p>

              <button type="button" class="btn btn-primary" onclick="<?php 
              if($pan==5&&$pan==6)
                  echo "javascript: document.getElementById('divcanc').style.display='block'; document.getElementById('divpreg').style.display='none'"; 
                  else echo 'javascript:noaceptarsec(\''.$supMuesCon->liga.'\',\''.$numsec.'\',\''.$supMuesCon->idval.'\',\'no\')';?>">Actualizar</button>
              </div>
              <div id="divcanc" style="display: none">
              <p>¿Desea cancelar la muestra?</p>
              <?php 
              echo '<button type="button" class="btn btn-secondary" onclick="javascript:noaceptarsec(\''.$supMuesCon->liga.'\',\''.$numsec.'\',\''.$supMuesCon->idval.'\',\'si\')">Sí</button>
               <button type="button" class="btn btn-primary" onclick="javascript:noaceptarsec(\''.$supMuesCon->liga.'\',\''.$numsec.'\',\''.$supMuesCon->idval.'\',\'no\')">No</button>';
             ?> </div>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>
    
 <script type="text/javascript">
   
   <?php $idimagen=1; foreach($supMuesCon->listaimagenes as $imagen){
    /* Initiate Magnify Function
    with the id of the image, and the strength of the magnifier glass:*/
   echo  'magnify("myimage'.$idimagen.'", 2);';
   $idimagen++;
   }
   ?>
    </script>