<?php 


  include_once  'Controllers/supMuestraController.php';
  include "api/src/contratoapp.php";
  include "Utilerias/leevar.php";
  $supMuesCon=new SupMuestraController();
  $supMuesCon->vistaMuestra();
  //var_dump($supMuesCon->muestra);

  // $enlacesModel == "supinformecli02" ||
   //echo "--".$idc;
  //clave mari AIzaSyANZ_tj0m9KI-W0MZKmXImqpH_V6AkJgfI
  ?>

<div class="row" style="margin-top: 5px;">
      <div class="col-md-10 tituloSup" >INFORME DE COMPRA
      </div>
      <div class="col-md-1 tituloSup2" >PANTALLA <?= $numpant?>
      </div>
      <div class="col-md-1 " >
              <div class="row">
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".($numpant-1)."&nummues=".$supMuesCon->numuestra?>"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".($numpant-1)."&nummues=".$supMuesCon->numuestra?>"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".($numpant+1)."&nummues=".$supMuesCon->numuestra?>"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".($numpant+1)."&nummues=".$supMuesCon->numuestra?>"><img src="Views/dist/img/Avanza-Final.jpg"></a>
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
                <a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".$numpant."&nummues=".$supMuesCon->numuestra?>"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".$numpant."&nummues=".($supMuesCon->numuestra-1)?>"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".$numpant."&nummues=".($supMuesCon->numuestra+1)?>"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php echo "index.php?action=supinformecli02&idmes=".$supMuesCon->mesas."&idrec=".$supMuesCon->rec_id."&id=".$supMuesCon->idinf."&cli=".$supMuesCon->idcli."&numpant=".$numpant."&nummues=".$supMuesCon->numuestra?>"><img src="Views/dist/img/Avanza-Final.jpg"></a>
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
    <!-- esto va en otro archivo -->
   <?php   if ($admin=="edI"){
             echo '<form role="form" method="post" action="index.php?action=supinformecli02&admin=act&idmes='.$supMuesCon->mesas.'&idrec='.$supMuesCon->rec_id.'&id='.$supMuesCon->idinf.'&cli='.$supMuesCon->idcli.'&nummues='.$supMuesCon->numuestra.'&numpant='.$numpant.'">';
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
              echo $supMuesCon->informe["inf_consecutivo"];
          ?>
      </div>
      <div class="col-md-1 labelAzul1">CÓDIGO QR:
      </div>
      <div class="col-md-3 labelAzulDato"><?php 
              echo $supMuesCon->muestra["ind_qr"];
          ?>
      </div>

      <div class="col-md-1 labelAzul1">TOMADA DE:
      </div>
      <div class="col-md-1 labelAzulDato"><?php  echo $supMuesCon->muestra["origen"];
          
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
      <div class="col-md-3 labelAzulDato"><?php  echo $supMuesCon->muestra["ind_caducidad"];
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
      <div class="col-md-12 areaBotonDer">
       <?php 
        if ($admin=="edI"){
          echo '    
          <button type="submit" class="btn btn-informes btn-sm btn-block">Guardar</button>';

        } else {
             echo '
            <a href="index.php?action=supinformecli02&admin=edI&idmes='.$supMuesCon->mesas.'&idrec='.$supMuesCon->rec_id.'&id='.$supMuesCon->idinf.'&cli='.$supMuesCon->idcli.'&numpant='.$numpant.'&nummues='.$nummues.'" class="btn btn-informes btn-block ">EDITAR</a>';
        } 
        ?>
     
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor"></div>
    </div>
 <?php include "suppanelfotos.php";?>
 
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario"><?php echo $supMuesCon->pantalla["pa_preguntaseccion"]?>
      </div>
      <div class="col-md-3 areaBoton" >  <?php 
        $opcsel=$supMuesCon->getopcsel();
        if ($opcsel==1){
          $clase= "btn-informesActivado";
          
        } else {
        $clase= "btn-informes";
       
        }
        echo '
        <a href="'.$supMuesCon->liga.'&admin=aceptar&sec='.$numpant.'&eta=2" class="btn '.$clase .' btn-sm btn-block ">SI</a>';
        ?>
      </div>
      <div class="col-md-3 areaBoton">
        <?php 
      if ($opcsel==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      echo '
        <a href="'.$supMuesCon->liga.'&admin=noaceptar&sec='.$numpant.'&eta=2" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">NO</a>';
        ?>
      </div>
    
    </div>

        <div class="modal fade" id="modal-correccion">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">No está bien distribuida</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            <form role="form" method="post" action="index.php?action=supinforme&admin=cor&sec=1&eta=2&idmes='.<?php echo $informeCont->getidmes(); ?>.'&idrec='.<?php echo $informeCont->getidrec(); ?> .'&id='.<?php echo $informeCont->getidmes(); ?>">
              <?php echo '
                 <input type="hidden" name="id" id="id" value="'.$numtienda.'">
                 <input type="hidden" name="idplan" id="idplan" value="'.$idplan.'"> 
                 <input type="hidden"  name="indice" id="idmes" value="'.$idmes.'">
                 <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">';
            ?>
              <p> Escribe el motivo </p>
              <input type="text"  name="solicitud" id="solicitud" style="width: 450px;">
              <p>  </p>

              <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </div>