<?php 
include "Controllers/geocercaServController.php";

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

        $numtienda= $informeCont->getconsec();
        $coord= $informeCont->getcoord();
       
        $xy=explode(",", $coord);
        
        $idzona =$informeCont->getidzona();
        $zona =$informeCont->getzona();
        $idmes=$informeCont->getidmes();
        $tipotiendac=$informeCont->gettipotiendac();
        
        $idplan=$informeCont->getidplan();
        //$idsup=$informeCont->getnumsup();
        $infsig=$informeCont->getidsig();
        $infant=$informeCont->getidant();
        $direc2=$informeCont->asdirec2();
        $inffirst=$informeCont->getidfirst();
        //var_dump($inffirst);
        $inflast=$informeCont->getidlast();
      

        // datos de edicion
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
           $descest=$informeCont->getdescest();
           //$nomciudad= $informeCont->getnomciudad();

      include "Utilerias/leevar.php";
      $nomciudad=$_GET["idciu"];
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
            $informeCont->noaceptarsec1(); 
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
          //en este controller se piden las coordenadas para la geocerca x ciudad de residencia
        $geoserv=new GeocercaServController();
       // die($informeCont->idciudadres);
        $geoserv->buscarGeocercas($informeCont->idciudadres);
       ?>﻿
       <style>#map_canvas {
         height: 45vh;
         width: 100%;
         margin: 0 auto;
         border: 1px solid grey;
         border-radius: 5px;
         box-shadow: 0px 0px 8px #999;
         color: black;
         text-align: center;
        }
      </style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4iIUMXD0GrrxFC2BbNRhXcVZtfLDrhEQ&libraries=drawing" async defer></script>
 
<script type="text/javascript">
 /*****script para dibujar las geocercas, el mapa y los puntos****/
 var colors = {N:'#1E90FF',S: '#FF1493',E: '#32CD32',O: '#FF8C00',C: '#4B0082'};
 var selectedColor;
 var drawingManager;
 var selectedShape;
 var puntos;
 var regionAct; //para saber en que region voy
 var conta=0;
 var arrreg=[{key: 'C',nombre:"Centro",cve:5},
   {key:'N',nombre:"Norte",cve:1},
         {key:'S',nombre:"Sur",cve:2},
         {key:'E',nombre:"Este",cve:3},
         {key:'O',nombre:"Oeste",cve:4}];
 var markers=[];
 var map;

window.onload = function () {
     map = new google.maps.Map(document.getElementById("map_canvas"), {
      center: {lat: 19.36884, lng: -99.16410},
          zoom: 11   
    });
   
     drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: null,
      drawingControl: true,
      drawingControlOptions: {
        position: google.maps.ControlPosition.TOP_CENTER,
        drawingModes: [
         
          null,
        
        ],
      },
     
      polygonOptions: {
          fillColor: '#BCDCF9',
          fillOpacity: 0.5,
          strokeWeight: 2,
          strokeColor:'#57ACF9',
          clickable: true,
          editable: true,
          zIndex: 1
        }
     
    });

    drawingManager.setMap(map);
  
  

    drawingManager.setOptions({
    drawingControl: false
  });
//console.log("Esto es en el mapa");
<?php 
//dibujo la tienda
if($coord!=""){
$auxc=explode(",",$coord);
if($auxc[0]!=""&&$auxc[1]!="")
echo "dibujarPunto(".$auxc[0].",".$auxc[1].",map,'red');";
}
//dibujo las tiendas

  $lat=0;
  $long=0; //de la lista de tiendas que ya traje dibujo el punto sacando las coordenadas
 
  $listatiendas=$informeCont->getTiendasxindice(0,  $informeCont->idciudadres, "", "", 0, $informeCont->mesas,$idrec);
 
 //die();
 if($listatiendas!=null)
     foreach($listatiendas as $tienda){
         //si es la tienda en cuestion la salto
         if($tienda["une_id"]==$idtienda)
             continue;
     if($tienda["une_coordenadasxy"]!=null&&sizeof($tienda["une_coordenadasxy"])>0) {
         $auxcoor =explode(",",$tienda["une_coordenadasxy"]);
         
            if($auxcoor!=null&&sizeof($auxcoor)>0)
            { $lat=$auxcoor[0];
            $long=$auxcoor[1];
            if($lat!=""&&$long!="")
            echo "dibujarPunto(".$lat.",".$long.",map,'".$tienda["color"]."');";
            }
            
        }
    }
  

//dibujo los poligonos si ya tengo las opciones
       if(sizeof($geoserv->puntos)){
          echo "markers=new Array();";
          echo "dibujarRegion(eval(".json_encode($geoserv->puntos["N"])."),colors['N']);";
          echo "dibujarRegion(eval(".json_encode($geoserv->puntos["C"])."),colors['C']);";
          echo "dibujarRegion(eval(".json_encode($geoserv->puntos["S"])."),colors['S']);";
          echo "dibujarRegion(eval(".json_encode($geoserv->puntos["E"])."),colors['E']);";
          echo "dibujarRegion(eval(".json_encode($geoserv->puntos["O"])."),colors['O']);";
          echo "map.setCenter(". json_encode($geoserv->puntos["C"][0]).");";
    }
    ?>


	  const geocoder = new google.maps.Geocoder();
	<?php if($direccionc=="Ubicación registrada")
	    
	    echo "actualizarDireccionCat(geocoder);";
	if($infdir=="Ubicación registrada")
	    echo "actualizarDireccionInf(geocoder);";
	?>
};

var informe=<?= $nunminf ?>;
var idrec="<?= $idrec ?>";
var mesas="<?=$idmes ?>";
var idtienda=<?=$idtienda?>;

function actualizarDireccionCat(geocoder){
	input=document.getElementById("divcoorcat").innerHTML;
//	console.log("--"+input+"---");
	txtdireccionc=document.getElementById("divdircat");
	 geocodeLatLng(geocoder, input.trim(), txtdireccionc,"c")
}
function actualizarDireccionInf(geocoder){
	input=document.getElementById("divcoorinf").innerHTML;
	//console.log("--"+input+"---");
	txtdireccioni=document.getElementById("divdirinf");
	 geocodeLatLng(geocoder, input.trim(), txtdireccioni,"i")
	
}
function geocodeLatLng(geocoder, input, txtdireccioni,tabla) {
	console.log(input);
	  if(input!=""){
	  const latlngStr = input.split(",", 2);
			
	  const latlng = {
	    lat: parseFloat(latlngStr[0]),
	    lng: parseFloat(latlngStr[1]),
	  };

	  geocoder
	    .geocode({ location: latlng })
	    .then((response) => {
	      if (response.results[0]) {
	       nvadir=response.results[0].formatted_address;
		
	        txtdireccioni.innerHTML=nvadir;
	      	//actualizo en la tabla
			
			console.log(nvadir);
			   txtdireccioni.innerHTML=nvadir;
	      	mandarDir(nvadir, informe, idrec, mesas,idtienda, tabla);
	     
	       
	      
	      } else {
	       // window.alert("No se encontro dirección");
	      }
	    })
	    .catch((e) => window.alert("No se pudo encontrar la direccion " + e));
	  }
	}
	
function mandarDir(direccion, informe, idrec, mesas,idtienda, tabla){

	 // console.log(ciudad+"--"+ punto);
	   $.ajax({
	       type: 'POST',
	       url: 'actualizarDir.php',
	    
	       data: { dir: direccion,
		       		infid:informe,
		       		idrec:idrec,
		       		idtienda:idtienda,
		       		tab:tabla,
		       		mesas,mesas},
	       dataType: 'json',
	   }).done(function (data) {
	      
	       console.log("todo bien");
	    //   console.log(data);
	      
	         
	      
	   });
	}	 
</script>
<script src="js/geomapas.js"></script>


<div class="row" style="margin-top: 0px;">
      <div class="col-md-10 tituloSup" >INFORME DE COMPRA
      </div>
      <div class="col-md-1 tituloSup2" >PANTALLA 1
      </div>
      <div class="col-md-1 " >
              <div class="row">
                <?php
                echo '
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=suplistatiendas&admin=li&idmes='.$idmes.'&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/retroceder-lista.jpg"></a>
                </div>

                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2"><img src="Views/dist/img/Retrocede-1-off.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/Avanza-Final.jpg"></a>
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
            <div class="col-md-3 tituloSupBotones" ><a href="#"><img src="Views/dist/img/Retrocede-Final-off.jpg"></a>
            </div>';
          }else{
                echo '      
        <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$inffirst.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
            </div>';
          }  
            //var_dump($infant);
          if ($infant==0){ 
            echo '  
            <div class="col-md-3 tituloSupBotones" ><a href="#"><img src="Views/dist/img/Retrocede-1-off.jpg"></a>
            </div>';
          }else{
            echo '  
            <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infant.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/Retrocede-1.jpg"></a>
            </div>';
          }  

          if ($infsig==0){
              echo '
            <div class="col-md-3 tituloSupBotones" ><a href="#"><img src="Views/dist/img/Avanza-1-off.jpg"></a>
            </div>';
          } else {
              echo '
            <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infsig.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/Avanza-1.jpg"></a>
            </div>';
          }  
          if ($inflast==0){
              echo '
            <div class="col-md-3 tituloSupBotones" ><a href="#"><img src="Views/dist/img/Avanza-Final-off.jpg"></a>
            </div>';
          } else {
            echo '
            <div class="col-md-3 tituloSupBotones" ><a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$inflast.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"><img src="Views/dist/img/Avanza-Final.jpg"></a>
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
             echo '<form role="form" method="post" action="index.php?action=supinforme&admin=act">';
          }else if ($admin=="ediC"){
             echo '<form role="form" method="post" action="index.php?action=supinforme&admin=actc">';
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
                 <input type="hidden" name="idt" id="idt" value="'.$idtienda.'">
                 <input type="hidden" name="idsup" id="idsup" value="'.$idsup.'">
                 <input type="hidden" name="idciu" id="idciu" value="'.$nomciudad.'">
             
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
          echo '<input type="hidden" name="idtienc" id="idtienc" value='.$idtienda.'>
                <input type="hidden" name="numtienc" id="id" value="'.$numtienda.'"> 
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
      <div class="col-md-3 labelAzulDato" id="divcoorinf">
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
      <div class="col-md-3 labelAzulDato"  id="divcoorcat">
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
      <div class="col-md-5 labelAzulDatoMitadDer" id="divdirinf">
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
      <div class="col-md-5 labelAzulDato" id="divdircat">
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
            <a href="index.php?action=supinforme&admin=edI&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&idsup='.$idsup.'&idciu='.$nomciudad.'" class="btn btn-informes  btn-sm btn-block ">EDITAR</a>';
        } 
        ?>
      </div>
      <div class="col-md-6 areaBotonDer">
        <?php 
        if ($admin=="ediC"){
          echo '
            <button type="submit" class="btn btn-informes btn-sm btn-block">Guardar</button>';
        }else{    
         echo '<a href="index.php?action=supinforme&admin=ediC&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&idsup='.$idsup.'&idciu='.$nomciudad.'" class="btn btn-informes btn-sm btn-block "> EDITAR</a>';
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
      <div class="col-md-6 areaImagenIzq" id="map_canvas">
      </div>
      <div class="col-md-6 areaImagenDer"><iframe src="https://www.google.com/maps/embed/v1/place?q=<?php echo $coordc?>&key=AIzaSyB4iIUMXD0GrrxFC2BbNRhXcVZtfLDrhEQ" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario">LA TIENDA VISITADA TIENE BUENA DISTRIBUCION EN EL AREA DE MUESTREO?
      </div>
      <div class="col-md-2 areaBoton" >
        <?php 
        $opcsel=$informeCont->getopcsel();
        //
        ($opcsel);
        if ($opcsel==1){
          $clase= "btn-informesActivado";
          
        } else {
        $clase= "btn-informes";
       
        }
        echo '
        <a href="index.php?action=supinforme&admin=aceptar&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2&est=3&idsup='.$idsup.'&idciu='.$nomciudad.'" class="btn '.$clase .' btn-sm btn-block ">SI</a>';
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
        <a href="index.php?action=supinforme&admin=noap&indice='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&sec=1&eta=2&idsup='.$idsup.'&idciu='.$nomciudad.'"  class="btn '.$clase .' btn-sm btn-block ">NO APLICA</a>';
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
              
            <form role="form" method="post" action=
            <?php
            echo '
            "index.php?action=supinforme&admin=cor&sec=1&eta=2&est=1&idmes='.$idmes.'&idrec='.$idrec.'&id='.$nunminf.'&idsup='.$idsup.'&idciu='.$nomciudad.'"';

              echo '
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