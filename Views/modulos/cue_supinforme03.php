<?php 

$informeCont=new SupInformesController();
        $informeCont->vistaSupInformeComController();
        $cliente= $informeCont->getcliente();  
        $planta= $informeCont->getplanta();
        $idrec=$informeCont->getidrec();
        $indice= $informeCont->getindice();
        $recolector= $informeCont->getrecolector();
        $nunminf= $informeCont->getidinforme();
        $nomtienda=$informeCont->getnomplan();
        $infcadena=$informeCont->getcadena();
        $inftipot=$informeCont->gettipot();
        $inffecha=$informeCont->getfecha();
        $infhora=$informeCont->gethora();
        $infdir=$informeCont->getdirec();
        $complem=$informeCont->getcomplem();
         $server="/comprasv1/fotografias/";

        $numtienda= $informeCont->getconsec();
        $coord= $informeCont->getcoord();
       
        $xy=explode(",", $coord);
        
        $idzona =$informeCont->getidzona();
        $zona =$informeCont->getzona();
        $idmes=$informeCont->getidmes();
        $tipotiendac=$informeCont->gettipotiendac();
        
        $idplan=$informeCont->getidplan();
        $idsup=$informeCont->getnumsup();
        $infsig=$informeCont->getidsig();
        $infant=$informeCont->getidant();
        $direc2=$informeCont->asdirec2();
        $inffirst=$informeCont->getidfirst();

        $inflast=$informeCont->getidlast();

        // datos de edicion
         // $informeContoller=new SupInformesController();
         // $informeContoller->editaInformeComController();
           $nomtiendaC=$informeCont->getnomtienc();
           $nomplanta= $informeCont->getnomplan();  
           $idcadena= $informeCont->getidcad();
           $nomcadcomc= $informeCont->getnomcadcomc();
           $cadcomc=$informeCont->getidcadcomc();
           //echo $cadcomc;
           $idzonac=$informeCont->getidzonac();
           //echo $idzonac;
           $nomzonac= $informeCont->getnomzonac();
           //var_dump($nomzonac);
           $idtipotienda= $informeCont->getidtip();
           $direccionc= $informeCont->getdirecc() ;
           $compdireccc= $informeCont->getnomcomplemc();
           $comentarios= $informeCont->getcoment();
           $coordc =$informeCont->getcoordc();
           $idtienda=$informeCont->getidtien();
           $idtipc=$informeCont->getidtipc();
           $numfotof=$informeCont->getfotof();
           $dirimagen=$informeCont->getdirimagen();
           $fotofacc=$informeCont->getfotofacc(); 
           $nomimg=$informeCont->getnombreimg();
           $numimg=$informeCont->getfotof();
           $stimg = $informeCont->getestfot();
           $nomticketc=$informeCont->getnomticket();
           $nomticketf= $informeCont->getnomticketf();
           $nomciudad= $informeCont->getnomciudad();
           $numtkt= $informeCont->getnumtkt(); 
           var_dump($nomticketc);

      include "Utilerias/leevar.php";
      if(isset($_GET["admin"])){
          $admin=$_GET["admin"];
          $id=$_GET["id"];
          $idmes=$_GET["idmes"];
          $idrec=$_GET["idrec"];
          if($admin=="act"){
            $informeCont->actualizar();  
          } else if ($admin=="actc"){
            $informeCont->actualizarc();          
          } else if ($admin=="dir"){
            $informeCont->actualizadir();
          } else if ($admin=="cor"){
            $informeCont->noaceptarimg(); 
          } else if ($admin=="aceptar"){
            $informeCont->aceptarsec1();   
          } else if ($admin=="noap"){
            $informeCont->noaplicasec1();
          } else if ($admin=="solcor"){  
            $informeCont->solcorreccion();
          } else if ($admin=="actcat"){  
            $informeCont->actcatalogoimg();  
          
           } else if ($admin=="edic"){
 
          }
        }     

       ?>﻿

<div class="row" style="margin-top: 0px;">
      <div class="col-md-10 tituloSup" >INFORME DE COMPRA
      </div>
      <div class="col-md-1 tituloSup2" >PANTALLA 3
      </div>
      <div class="col-md-1 " >
              <div class="row">
                <?php
                echo '
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
                </div>

                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme03&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=3&eta=2"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme03&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=3&eta=2"><img src="Views/dist/img/Avanza-Final.jpg"></a>
                </div>';
                ?>
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">CIUDAD:
      </div>
      <div class="col-md-3 labelAzulDato"><?php echo $nomciudad ?>
      </div>
      <div class="col-md-1 labelAzul1">ÍNDICE:
      </div>
      <div class="col-md-1 labelAzulDato"><?php echo $indice ?>
      </div>
      <div class="col-md-1 labelAzul1">RECOLECTOR:
      </div>
      <div class="col-md-3 labelAzulDato"><?php echo $recolector ?>
      </div>
      <div class="col-md-1 labelAzul1">TIENDA  <?php echo $numtienda  ?>
      </div>
      <div class="col-md-1 ">
        <div class="row">
           <?php
           if ($inffirst==0){ 
           echo '      
        <div class="col-md-3 tituloSupBotones" ><a href=#><img src="Views/dist/img/Retrocede-Final-off.jpg"></a>
            </div>';
              }else{

                echo '      
        <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme03&idmes='.$idmes.'&idrec='.$idrec.'&id='.$inffirst.'&sec=3&eta=2"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
            </div>';
          }
            //var_dump($infant);
          if ($infant==0){ 
            echo '  
            <div class="col-md-3 tituloSupBotones" ><a href="#"><img src="Views/dist/img/Retrocede-1-off.jpg"></a>
            </div>';
          }else{
            echo '  
            <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme03&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infant.'&sec=3&eta=2"><img src="Views/dist/img/Retrocede-1.jpg"></a>
            </div>';
          }  

          if ($infsig==0){
              echo '
            <div class="col-md-3 tituloSupBotones" ><a href="#"><img src="Views/dist/img/Avanza-1-off.jpg"></a>
            </div>';
          } else {
              echo '
            <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme03&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infsig.'&sec=3&eta=2"><img src="Views/dist/img/Avanza-1.jpg"></a>
            </div>';
          }  
          if ($inflast==0){
            echo '
            <div class="col-md-3 tituloSupBotones" ><a href=#><img src="Views/dist/img/Avanza-Final-off.jpg"></a>
            </div>';
          }else{  
            echo '
            <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme03&idmes='.$idmes.'&idrec='.$idrec.'&id='.$inflast.'&sec=3&eta=2"><img src="Views/dist/img/Avanza-Final.jpg"></a>
            </div>';
          }
            ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 subtituloMitadIzq">INFORMES
      </div>
      <div class="col-md-6 subtituloMitadDer">CATÁLOGO
      </div>
    </div>
    <?php 
        //$admin="edI";
          if ($admin=="edI"){
             echo '<form role="form" method="post" action="index.php?action=supinforme03&admin=act&pan=3">';
          }else if ($admin=="ediC"){
             echo '<form role="form" method="post" action="index.php?action=supinforme03&admin=actc&pan=3">';
          }   
         ?>
    <div class="row">
      <div class="col-md-1 labelAzul1">TIENDA:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php 
          //$admin="edI1";
          if ($admin=="edI"){
             echo '<input class="form-control form-control-informes" type="text" placeholder="" id="nomtien" name="nomtien" value="'.$nomtienda.'">';
          }else{
             echo $nomtienda; 
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1">CADENA:
      </div>
      <div class="col-md-1 labelAzulDatoMitadDer">
         <?php 
          //$admin="edI2";
          if ($admin=="edI"){
             echo '<select class="form-control form-control-select-informes" id="cadcomuneg" name="cadcomuneg">
             <option value="">Seleccione una opción</option>';
            $rs = DatosCatalogoDetalle::listaCatalogoDetalle(1, "ca_catalogosdetalle");
     
              foreach ($rs as $row) {
                if (($row["cad_idopcion"]) == $idcadena) {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                } else {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                }
                echo $opcion; 
              }                          
              echo '</select>';
          }else{
             echo $infcadena; 
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1MitadIzq">TIENDA:
           
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php
           //$admin="ediC";
          if ($admin=="ediC"){
            echo '<input class="form-control form-control-informes" type="text" placeholder="" name="nomtienc" id="nomtienc" value="'.$nomtiendaC.'">';
          } else {
            echo $nomtiendaC;
          }
          ?>

        
      </div>
      <div class="col-md-1 labelAzul1">CADENA:
      </div>
      <div class="col-md-1 labelAzulDato">
        <?php
           //$admin="ediC";
          if ($admin=="ediC"){
            echo '<select class="form-control form-control-select-informes" name="cadcomunegc" id="cadcomunegc">
            <option value="">Seleccione una opción</option>';
            $rs = DatosCatalogoDetalle::listaCatalogoDetalle(1, "ca_catalogosdetalle");
     
              foreach ($rs as $row) {
                if (($row["cad_idopcion"]) == $cadcomc) {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                } else {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                }
                echo $opcion; 
              }                          
              echo '</select>';

          } else {  
              echo $nomcadcomc;
          }
          ?>  
            
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">TIPO DE TIENDA:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php 
          //$admin="edI";
          if ($admin=="edI"){
             echo '<select class="form-control form-control-select-informes" id="tipouneg" name="tipouneg">
             ';
            $rs = DatosCatalogoDetalle::listaCatalogoDetalle(2, "ca_catalogosdetalle");
     
              foreach ($rs as $row) {
                if (($row["cad_idopcion"]) == $idtipotienda) {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                } else {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                }
                echo $opcion; 
              }                          
              echo '</select>';
          }else{
             echo $inftipot; 
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1">ID TIENDA:
        <?php   
            if ($admin=="edI"){
              echo '
                 <input type="hidden" name="id" id="id" value="'.$nunminf.'">
                 <input type="hidden"  name="indice" id="idmes" value="'.$idmes.'">
                 <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">';

            }     
            ?>
          
      </div>
      <div class="col-md-1 labelAzulDatoMitadDer"><?php echo $idtienda ?>
      </div>
      <div class="col-md-1 labelAzul1MitadIzq">TIPO DE TIENDA:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php   
           //$admin="ediC";
            if ($admin=="ediC"){
              echo '
        <select class="form-control form-control-select-informes" name="tipounegc" id="tipounegc">
        <option value="">Seleccione una opción</option>';
               $rs = DatosCatalogoDetalle::listaCatalogoDetalle(2, "ca_catalogosdetalle");

                foreach ($rs as $row) {
                    if (($row["cad_idopcion"]) ==$idtipc) {
                        $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                    } else {
                    $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                    }
                echo $opcion;
              }
               echo '</select>';
                        
          } else {   
              echo $tipotiendac; 
          }   ?>
      </div>
      <div class="col-md-1 labelAzul1">ID TIENDA:
      </div>
      <div class="col-md-1 labelAzulDato">
        <?php
        //$admin="ediC";
        if ($admin=="ediC"){
          echo '<input type="hidden" name="id" id="id" value='.$nunminf.'>
                <input type="hidden" name="numtienc" id="numtienc" value="'.$idtienda.'"> 
                <input type="hidden"  name="indicec" id="idmes" value="'.$idmes.'">
                <input type="hidden" name="idrecc" id="idrec" value="'.$idrec.'">';

              echo $idtienda;
        }else{
          echo $idtienda;
        }      
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">COORDENADAS:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php 
          //$admin="edI4";
          if ($admin=="edI"){
             echo '<input class="form-control form-control-informes" type="text" placeholder="" id="cxy" name="cxy" value="'.$coord.'">';
          }else{
             echo $coord;
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1">ZONA:
      </div>
      <div class="col-md-1 labelAzulDatoMitadDer">
        <?php 
          
          if ($admin=="edI"){
             echo '<select class="form-control form-control-select-informes" id="zona" name="zona">
             <option value="">Seleccione una opción</option>';
            $rs = DatosCatalogoDetalle::listaCatalogoDetalle(4, "ca_catalogosdetalle");
     
              foreach ($rs as $row) {
                if (($row["cad_idopcion"]) == $idzona) {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                } else {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                }
                echo $opcion; 
              }                          
              echo '</select>';
          }else{
             echo $zona; 
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1MitadIzq">COORDENADAS:
      </div>
      <div class="col-md-3 labelAzulDato">
        <?php
        //$admin="ediC";
        if ($admin=="ediC"){
           echo '<input class="form-control form-control-informes" type="text" placeholder="" name="cxyc" id="cxyc" value="'.$coordc.'">';
        } else {
          echo $coordc;
        }
        ?>
      </div>
      <div class="col-md-1 labelAzul1">ZONA:
      </div>
      <div class="col-md-1 labelAzulDatoMitadDer">
      
         <?php
          //$admin="ediC";
         if ($admin=="ediC"){
            echo '<select class="form-control form-control-select-informes" name="zonac" id="zonac">
            <option value="">Seleccione una opción</option> ';
            $rs = DatosCatalogoDetalle::listaCatalogoDetalle(4, "ca_catalogosdetalle");

            foreach ($rs as $row) {
              if (($row["cad_idopcion"]) ==$idzonac) {
                 $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
              } else {
                  $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
              }
              echo $opcion; 
            }
            echo '</select>';
        } else {   
            echo $nomzonac; 
        }          ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">FECHA:
      </div>
      <div class="col-md-3 labelAzulDato">
         <?php 
           echo $inffecha;
         ?>  
      </div>
      <div class="col-md-1 labelAzul1">HORA:
        
      </div>
      <div class="col-md-1 labelAzulDatoMitadDer">
        <?php 
         echo $infhora;
        ?>
      </div>
      <div class="col-md-6 labelAzul1MitadIzq">
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">DIRECCIÓN:
      </div>
      <div class="col-md-5 labelAzulDatoMitadDer">
        <?php 
          //$admin="edI";
          if ($admin=="edI"){
             echo '<input class="form-control form-control-informes" type="text" placeholder="" id="dirtien" name="dirtien" value="'.$infdir.'">';
          }else{
             echo $infdir;
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1MitadIzq">DIRECCIÓN:
      
      </div>
      <div class="col-md-5 labelAzulDato">
        <?php
          //$admin="ediC";
         if ($admin=="ediC"){
            echo ' <input class="form-control form-control-informes" type="text" placeholder="" name="dirtienc" id="dirtienc" value="'.$direccionc.'">';
          } else {
             echo $direccionc;
          }
        ?>  
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">COMPLEMENTO:
      </div>
      <div class="col-md-5 labelAzulDatoMitadDer">
        <?php 
          //$admin="edI";
          if ($admin=="edI"){
             echo '<input class="form-control form-control-informes" type="text" placeholder="" id="compdir" name="compdir" value="'.$complem.'">';
          }else{
             echo $complem;
          }   
         ?>
      </div>
      <div class="col-md-1 labelAzul1MitadIzq">COMPLEMENTO:
      </div>
      <div class="col-md-5 labelAzulDato">
        <?php
          //$admin="ediC";
         if ($admin=="ediC"){
            echo '<input class="form-control form-control-informes" type="text" placeholder=""  name="compdirc" id="compdirc" value="'.$compdireccc.'">';
         }else{
             echo $compdireccc; 
         }   
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">COMENTARIOS:
      </div>
      <div class="col-md-5 labelAzulDatoMitadDer">
        <?php 
          //$admin="edI7";
          if ($admin=="edI"){
             echo '<input class="form-control form-control-informes" type="text" placeholder="" id="coment" name="coment" value="'.$comentarios.'">';
          }else{
             echo $comentarios;
          }   
         ?>
      </div>
      <div class="col-md-6 labelAzul1MitadIzq">
      </div>
    </div>
  
    <div class="row">
      <div class="col-md-6 areaBotonIzq">
        <?php 
        if ($admin=="edI"){
          echo '    
          <button type="submit" class="btn btn-informes btn-sm btn-block">Guardar</button>';

        } else {
             echo '
            <a href="index.php?action=supinforme02&admin=edI&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'" class="btn btn-informes btn-sm btn-block ">EDITAR</a>';
        } 
        ?>
      </div>
      <div class="col-md-6 areaBotonDer">
        <?php 
        if ($admin=="ediC"){
          echo '
            <button type="submit" class="btn btn-informes btn-sm btn-block">Guardar</button>';
        }else{    
         echo '<a href="index.php?action=supinforme02&admin=ediC&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'" class="btn btn-informes btn-sm btn-block "> EDITAR</a>';
        }
        ?>
      </div>
    </div>
    </form>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 areaImagen areaScrollP6"> <div>
         <div> 
          <div class="img-magnifier-container">
           <img id="myimage" class="d-block w-100" height="1134" src=
        <?php
        
        $img=$server.$dirimagen.'/'.$nomticketf;
         echo '"'.$img.'"';
        ?>
        />
          </div>
        </div>
      </div>
    </div>
      
      <?php
         echo '
           <div class="col-md-6 areaImagen areaScrollP6"> <div>
         <div>
          <div class="img-magnifier-container">
           <img id="myimage2" class="d-block w-100" height="1134" src=';
        
        $img=$server.$dirimagen.'/'.$nomticketc;
         echo '"'.$img.'"';
          echo '
        />
          </div>
          </div></div></div>';
     ?>  
    </div>
    <div class="row">
    <div class="col-md-2 areaBoton" > 
      <?php
      if ($stimg==1){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      echo '
      <a href="#" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-motivo">CORREGIR</a>';
   
    ?>
      
      </div>
      <div class="col-md-2 areaBoton" ><a 

      <?php
      if ($stimg==2){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      echo '
     href="index.php?action=supinforme03&pan=3&admin=cor&est=2&eta=2&sec='.$sec.'&img='.$idimg.'&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&img='.$numimg.'" class="btn '.$clase .' btn-sm btn-block "';

      ?> 
      >CANCELAR</a>

      </div>
      <div class="col-md-2 areaBoton"><a 
        <?php
        if ($stimg==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      
      echo '
      href="index.php?action=supinforme03&pan=3&admin=cor&est=3&eta=2&sec='.$sec.'&img='.$idimg.'&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&img='.$numimg.'" class="btn '.$clase.' btn-sm btn-block "';
      ?>
      >ACEPTAR </a>
      </div>
      <div class="col-md-6 areaBoton">
      <?php
      echo '
        <a href="index.php?action=supinforme03&pan=3&admin=actcat&numtkt='.$numtkt.'&idtien='.$idtienda.'&eta=2&sec='.$sec.'&indice='.$idmes.'&id='.$id.'&idrec='.$idrec.'&cli='.$cliente.'" class="btn btn-informes btn-sm btn-block ">ACTUALIZAR</a>';
      ?>  
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario">¿CONOCE EL NOMBRE Y DIRECCION DE LA TIENDA ASI COMO LA FECHA Y HORA DE VISITA?
      </div>
      <div class="col-md-2 areaBoton" >
        <?php 
        $opcsel=$informeCont->getopcsel();
        //var_dump($opcsel);
      if ($opcsel==1){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      
         echo '
        <a href="index.php?action=supinforme&admin=aceptar&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=3&eta=2&pan=3&est=2" class="btn '.$clase .' btn-sm btn-block ">SI</a>'; 
        ?>
      </div>
      
      <div class="col-md-2 areaBoton">
        <?php 
      if ($opcsel==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      echo '
      <a href="#" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">NO</a>';
      ?>
      </div>
      <div class="col-md-2 areaBoton">
        <?php 
      if ($opcsel==2){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      echo '
        <a href="index.php?action=supinforme&admin=noap&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=3&eta=2&pan=3"  class="btn '.$clase .' btn-sm btn-block ">NO APLICA</a>';
        ?>
      </div>
    </div>

        <div class="modal fade" id="modal-correccion">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Foto de fachada</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
            <form role="form" method="post" action="index.php?action=supinforme&admin=cor&sec=3&eta=2&est=1&pan=3&idmes='.<?php echo $informeCont->getidmes(); ?>.'&idrec='.<?php echo $informeCont->getidrec(); ?> .'&id='.<?php echo $nunminf ?>">
              <?php echo '
                 <input type="hidden" name="id" id="id" value='.$nunminf.'>
                 
                 <input type="hidden"  name="indice" id="indice" value='.$idmes.'>
                 <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">';
            ?>
              <p> Escribe el motivo </p>
              <input type="text"  name="solicitud" id="solicitud" style="width: 450px;">
              <p>  </p>

              <button type="submit" class="btn btn-primary">Enviar
              </button>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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
              echo '
              "index.php?action=supinforme03&pan=3&admin=cor&est=1&eta=2&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&img='.$idimg.'&sec='.$sec.'"';
            ?>
              >
              
              <p> Escribe el motivo de corrección</p>
              <?php echo '
                  <input type="hidden" name="img" id="img" value='.$numimg.'>';
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

<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage", 2);
</script>
<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage2", 2);
</script>
<script>
/* Initiate Magnify Function
with the id of the image, and the strength of the magnifier glass:*/
magnify("myimage3", 2);
</script>