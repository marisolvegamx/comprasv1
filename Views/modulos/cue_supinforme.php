
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
        $numtienda= $informeCont->getconsec();

        $coord= $informeCont->getcoord();
       
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
           $nomciudad= $informeCont->getnomciudad();

         // datos edicion cat
           //$informeContoller=new SupInformesController();
           //$informeContoller->editacatalogoController();
           //$nomtienc=$informeContoller->getnomtienc(); 
           //$idcadcomc=$informeContoller->getidcadcomc();
           //$nomcadcomc=$informeContoller->getnomcadcomc();
           
          // $tipotiendac=$informeContoller->gettipotiendac();
           //$coordc=$informeContoller->getcoordc();
           //$direcc=$informeContoller->getdirecc();
           //$idzonac=$informeContoller->getidzonac();
           //$nomzonac=$informeContoller->getnomzonac();
           //$nomcomplemc=$informeContoller->getnomcomplemc();

//var_dump($coordc);
//var_dump($tipotiendac);

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
            $informeCont->noaceptarsec1(); 
          } else if ($admin=="aceptar"){
            $informeCont->aceptarsec1();   
          } else if ($admin=="noap"){
            $informeCont->noaplicasec1();
          
           } else if ($admin=="edic"){

         //  $informeContoller=new SupInformesController();
         //  $informeContoller->editacatalogoController();
         //  $nomtienc=$informeContoller->getnomtienc(); 
         //  $cadcomc=$informeContoller->getidcadcomc();
         //  $idtipc=$informeContoller->getidtipc();
         //  $tipotienda=$informeContoller->gettipotiendac();
         //  $coordc=$informeContoller->getcoordc();
         //  $direcc=$informeContoller->getdirecc();
         //  $idzonac=$informeContoller->getidzonac();
         //  $nomzonac=$informeContoller->getnomzonac();
         //  $nomcomplemc=$informeContoller->getnomcomplemc(); 
          }
        }   
        //en este controller se piden las coordenadas para la geocerca x ciudad de residencia
        $geoserv=new GeocercaServController();
       // die($informeCont->idciudadres);
        $geoserv->buscarGeocercas($informeCont->idciudadres);
        
       ?>﻿
        <style>#map_canvas {
         height: 90vh;
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
 //var_dump($listatiendas);
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

}; 
</script>
<script src="js/geomapas.js"></script>
<body>
    <table border="1px"  bordercolor="#9d981c" width="100%">
      
        <tr> 
          <td  style=" text-align: center; background: #9d981c; color: #ffffff;  font-size: 16px; font-weight: 800; " colspan="10" height="10px">SUPERVISION INFORMES DE COMPRA</gtd>   
        </tr>
          
          
        <tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" width=" 10%";>RECOLECTOR :</td>   
 
          <td style="width: 23% ; font-size: 10px; padding-left: 5px; background: #f8f6b9;"> <?php echo  $informeCont->getrecolector(); ?>
            
          </td>
          <td style="width:7%; font-size: 10px; text-align: right; background: #f6f296;">INDICE :</td>   

          <td style="width: 8% ; font-size: 10px; padding-left: 5px; background: #f8f6b9;"> <?php echo  $informeCont->getindice(); ?>
            
          </td>
          <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;">CIUDAD :</td>   

          <td style="width:20% ; font-size: 10px; padding-left: 5px; background: #f8f6b9;">  <?php echo $nomciudad ?> 
          </td>
         <td style="width: 10px; font-size: 16px; text-align: center; background: #9d981c;">
  <?php 

      echo '<a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$inffirst.'"> <i class="fa fa-step-backward" aria-hidden="true" style="color: #ffffff;"></i></a>';
      
    
     ?>
           </td>
         <td style="width: 10px; font-size: 16px; text-align: center; background: #9d981c;">
  <?php 
    if ($infant==0){ 
        echo '<a  href=#> <i class="fa fa-caret-left fa-lg" aria-hidden="true"  style="color: grey;"></i></a>';
    } else {
      echo '<a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infant.'"> <i class="fa fa-caret-left fa-lg" aria-hidden="true" style="color: #ffffff;"></i></a>';
      
     }  
     ?>
           </td>
   
  
  <td style="width: 10px; font-size: 16px; text-align: center; background: #9d981c;">

  <?php 
      if ($infsig==0){
        echo '<a href=#> <i class="fa fa-caret-right fa-lg" aria-hidden="true" style="color: grey;"></i></a>';
      } else {
  echo '<a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infsig.'"> <i class="fa fa-caret-right fa-lg" aria-hidden="true" style="color: #ffffff;"></i></a>';
    }
  ?>
</td>
<td style="width: 10px; font-size: 16px; text-align: center; background: #9d981c;">

  <?php 
      //if ($infsig==0){
        //inputbox("es el final de la lista");
      //} else {
  echo '<a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$inflast.'"> <i class="fa fa-step-forward" aria-hidden="true" style="color: #ffffff;"></i></a>';
    //}
  ?>
</td>
        </tr>
       </table>
        <table border="2px"  bordercolor="#dbd66d" width="100%" > 
        <tbody>
        <tr>
          <td style=" text-align: center;  background: #9d981c; border-color: #9d981c; font-size: 12px; font-weight: 800; color: #ffffff; height=30px;" width="50%">INFORME DE COMPRA</td>
          <td style=" text-align: center; font-weight: 800; background: #9d981c; color: #ffffff; font-size: 12px; height=30px;" width="50%">CATALOGO DE TIENDAS</td>
        </tr>
        <tr>
          <td style="background: #f8f6b9; ">
           <table border="2px"  bordercolor="#dbd66d" lang="100%" height="25px">  
               <form role="form" method="post" action="index.php?action=supinforme&admin=act">
             <tr>
              <?php
                if ($admin=="edi"){
                   echo '              
                    <td style=" font-size: 10px; text-align: right; background: #f6f296;" width="10%"; height="25px">NOMBRE :</td>';
                } else {
                  echo '
                     <td style=" font-size: 10px; text-align: right; background: #f6f296;" width="5%"; height="25px">NOMBRE :</td>';
                }
                 ?> 
              
                <?php 

                if ($admin=="edi"){

                  echo  '
                      <td style="width: 15%;  font-size: 10px; text-align: left;  padding-left: 5px; background: #f8f6b9;" height="25px">
                  <input type="text" style="width:220px"  name="nomtien" id="nomtien" value="'.$informeCont->getnomplan().'"';
                } else { 
                    echo ' <td style="width: 15%;  font-size: 10px; text-align: left;  padding-left: 5px; background: #f8f6b9;" height="25px">';  
                  echo $informeCont->getnomplan(); 
                }
              ?>             
              </td>
               <?php
                if ($admin=="edi"){
                  echo '
              <td style="width:10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">CADENA :</td>';
              }else{
                  echo '
              <td style="width:5%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">CADENA :</td>';
              }   
              ?>
              <?php 
                
                if ($admin=="edi"){
                    echo '<td style="width: 8%;  font-size: 10px; text-align: left; padding-left: 5px; background: #f8f6b9;" >';
                    echo '   <select  name="cadcomuneg" style="width:90px">
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


                } else {   
                    echo '<td style="width: 8%;  font-size: 10px; text-align: left; padding-left: 5px; background: #f8f6b9;">';
                   echo $informeCont->getcadena(); 
                } ?>
            
            </td>
          </tr>
 <tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">TIPO DE TIENDA :</td>   

          <td style="width: 20%;  font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;">

            <?php  if ($admin=="edi"){
               echo '
                <select name="tipouneg" style="width:220px">
               <option value="">Seleccione una opción</option>';
               $rs = DatosCatalogoDetalle::listaCatalogoDetalle(2, "ca_catalogosdetalle");

                foreach ($rs as $row) {
                    if (($row["cad_idopcion"]) ==$idtipotienda) {
                    $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                    } else {
                    $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                    }
                echo $opcion;
              }
               echo '</select>';
                      
             } else {   
              echo $informeCont->gettipot(); 
              }   ?>
          </td>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">ID TIENDA :</td>
          <?php   
            if ($admin=="edi"){
              echo '
                 <input type="hidden" name="id" id="id" value="'.$numtienda.'">
                 <input type="hidden" name="numtien" id="numtien" value="'.$idtienda.'"> 
                 <input type="hidden"  name="indice" id="idmes" value="'.$idmes.'">
                 <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">';


            }     
            ?>
          <td style="  font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;"><?php echo $idtienda ?>
            
          </td>
        </tr>
 <tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">COORDENADAS :</td>   

          <td style=" font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;"><?php 
          if ($admin=="edi"){
                echo '
                <input type="text" style="width:220px; placeholder="COORDENADAS XY" name="cxy" id="cxy" value="'.$coord.'"';
             } else {   
              echo $coord; 
              }   ?>
            
          </td>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">ZONA :</td>   


          <td style="  font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;"><?php 
              if ($admin=="edi"){
                echo '
                <select name="zona" style="width:90px">
                <option value="">Seleccione una opción</option> ';
                $rs = DatosCatalogoDetalle::listaCatalogoDetalle(4, "ca_catalogosdetalle");

                  foreach ($rs as $row) {
                      if (($row["cad_idopcion"]) ==$idzona) {
                      $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                      } else {
                      $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                      }
                  echo $opcion; 
                }
                  echo '</select>';
        } else {   
                  echo $informeCont->getzona(); 
                }  

               ?>        
            
          </td>
        </tr>
<tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">FECHA :</td>   

          <td style=" font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;" ><?php echo $informeCont->getfecha(); ?>
            
          </td>
          <td style=" font-size: 10px; text-align: right; background:#f6f296; " height="25px">HORA :</td>   

          <td style="  font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;"><?php echo $informeCont->gethora(); ?>
          </td>
          </tr> 

           <tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">DIRECCION :</td>   

          <td style="  font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;" colspan="3"><?php 

          if ($admin=="edi"){
            echo '
                <input type="text" style="width:380px; placeholder="DIRECCION" name="dirtien" id="dirtien" value="'.$informeCont->getdirec().'">';
             } else {   
              echo $informeCont->getdirec(); 
              } ?>
            
          </td>
</tr>
<tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">COMPLEMENTO DIR:</td>   

          <td style=" font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;" colspan="3"><?php 
            if ($admin=="edi"){
                echo '
                <input type="text" style="width:380px; placeholder="COMPLEMENTO" name="compdir" id="dirtien" value="'.$compdireccion.'">';
            
             } else {   
              echo $informeCont->getcomplem(); 
              }
           ?>
            
          </td>
      </tr>    

<tr>
          <td style=" font-size: 10px; text-align: right; background: #f6f296;" height="25px">COMENTARIOS :</td>   

          <td style="  font-size: 10px; padding-left: 5px; text-align: left; background: #f8f6b9;" colspan="3"><?php 
            if ($admin=="edi"){
                echo '
                <input type="text" style="width:380px; placeholder="COMENTARIOS" name="coment" id="dirtien" value="'.$comentarios.'">';
            
             } else {   
              echo $informeCont->getcoment(); 
              }
           ?>
            
          </td>
</tr>

           <tr>
        <td style=" background: #9d981c; border-color: #ffffff; font-size: 12px; text-align: center; " colspan="4">

            <?php 
             if ($admin=="edi"){
            echo ' <button type="submit"  style="color: #ffffff; background: #9d981c; font-size: 12px; font-weight: 800; border-color:#bfba59; ">GUARDAR</button>'; 
          } else {   
             // echo '<button type="link"  style="color: #000000; font-size: 12px; font-weight: 800; border-color:#bfba59; background: #bfba59;  " <a href="index.php?action=supinforme&admin=edi&idmes='.$idmes.'&idrec='.$idrec.'&id='.$informeCont->getidinf().'"> EDITAR</a></button>';

              echo ' <a href="index.php?action=supinforme&admin=edi&idmes='.$idmes.'&idrec='.$idrec.'&id='.$informeCont->getidinf().'" style="color: #ffffff; background: #9d981c; font-size: 12px; font-weight: 800; "> EDITAR</a>';

              } ?>
           </td>
         </tr>
               </form>
          </table>
          </td>


          <td style="background: #f8f6b9; ">
            <form role="form" method="post" action="index.php?action=supinforme&admin=actc">
             
           <table border="2px"  bordercolor="#dbd66d" width="100%" lang="100%" height="12px">  
             <tr>  
              <td style="width: 20%; font-size: 10px; text-align: right; background: #f6f296; " height="25px">NOMBRE :</td>   

         
              <td style="width: 40%;  font-size: 10px; text-align: left; padding-left: 5px;"><?php 
                if ($admin=="edic"){
                  echo  '<input type="text" style="width:170px"  name="nomtienc" id="nomtienc" value="'.$informeCont->getnomtienc().'"';
                  

                } else {   
                  echo $informeCont->getnomtienc(); 
                }
              ?>             
          </td>
          <td style="width: 20%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">CADENA :</td>   

          <td style="width: 30%;  font-size: 10px; text-align: left;"><?php 
           if ($admin=="edic"){
             echo '   <select  name="cadcomunegc">
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
                   //var_dump($nomcadcomc);

              } ?>
             </td>           
               </tr>
               <tr>
        <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">TIPO TIENDA :</td>   

          <td style="width: 20%;  font-size: 10px; padding-left: 5px; text-align: left;"><?php  
          if ($admin=="edic"){
               echo '
                <select name="tipounegc" style="width:170px">
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
            
          </td>
          <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">ID TIENDA :</td>   

          <td style="width: 30%;  font-size: 10px; padding-left: 5px; text-align: left;">  
            <?php
            if ($admin=="edic"){
                  echo '<input type="hidden" name="idtienc" id="idtienc" value='.$idtienda.'>
                        <input type="hidden" name="numtienc" id="id" value="'.$numtienda.'"> 
                        <input type="hidden"  name="indicec" id="idmes" value="'.$idmes.'">
                        <input type="hidden" name="idrecc" id="idrec" value="'.$idrec.'">';

                  echo $idtienda;
            }else{
              echo $idtienda;
            }      
            ?>
          </td>
        </tr>

        <tr>
          <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">COORDENADAS :</td>   

          <td style="width: 20%;  font-size: 10px; padding-left: 5px; text-align: left;"><?php 
            if ($admin=="edic"){
                echo '
                <input type="text" style="width:170px; placeholder="COORDENADAS XY" name="cxyc" id="cxyc" value="'.$coordc.'"';
            } else {   
                echo $coordc; 
            }   ?>
            
          </td>
          <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">ZONA :</td>   

          <td style="width: 30%;  font-size: 10px; padding-left: 5px; text-align: left;"><?php 
              if ($admin=="edic"){
                echo '
                <select name="zonac" style="width:133px">
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
              }  

               ?>        
          </td>
        </tr>

         <?php 
        //   if ($admin=="edic"){
        //   }else{
            echo '    
        <tr>

          <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px"></td>   

          <td style="width: 20%;  font-size: 10px; padding-left: 5px; text-align: left;">
            
          </td>
          <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px"></td>   

          <td style="width: 30%;  font-size: 10px; padding-left: 5px; text-align: left;">
          </td>
        </tr>';
   //}
        ?>
        <tr>
           <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">DIRECCION :</td>   

          <td style="width: 10%;   font-size: 10px; padding-left: 5px; text-align: left;"  colspan="3"><?php 

          if ($admin=="edic"){
            echo '
               <input type="text" style="width:350px; placeholder="DIRECCION" name="dirtienc" id="dirtienc" value="'.$direccionc.'">';
          } else {   
              echo $direccionc; 
          } ?>
            
          </td>
          
        </tr>


        <tr>
          <td style="width: 20%; font-size: 10px; text-align: right; background: #f6f296;" height="25px">COMPLEMENTO DIR :</td>   

          <td style="width: 10%;  font-size: 10px; padding-left: 5px; text-align: left;"  colspan="3"><?php 
            if ($admin=="edic"){
                echo '
                <input type="text" style="width:350px; placeholder="COMPLEMENTO" name="compdirc" id="compdirc" value="'.$compdireccc.'">';
            
             } else {   
              echo $compdireccc; 
              }
           ?>
            
          </td>
          
        </tr>
        
          <?php 
          // if ($admin=="edic"){
            //echo '</form>';
          // } else { 
            echo '
            <tr>
         <td style="width: 10%; font-size: 10px; text-align: right; background: #f6f296;" height="25px"> </td>   

          <td style="width: 10%;  font-size: 10px; padding-left: 5px; text-align: left;"  colspan="3"> 
            
          </td>
          
        </tr>';
     // }
?>

               <tr>
                 <td style="width: 10%; background: #9d981c;  font-size: 12px; text-align: center;" colspan="4">
            <?php 

                if ($admin=="edic"){
                    echo ' <button type="submit"  style="color: #ffffff; background: #bfba59; font-size: 12px; font-weight: 800; border-color:#bfba59; ">GUARDAR</button>'; 
                } else {   
                  // echo '<button type="link"  style="color: #000000; font-size: 12px; font-weight: 800; border-color:#bfba59; background: #bfba59;  " <a href="index.php?action=supinforme&admin=edi&idmes='.$idmes.'&idrec='.$idrec.'&id='.$informeCont->getidinf().'"> EDITAR</a></button>';

                  echo ' <a href="index.php?action=supinforme&admin=edic&idtien='.$idtienda.'&idmes='.$idmes.'&idrec='.$idrec.'&id='.$informeCont->getidinf().'" style="color: #ffffff; background: #9D981C; font-size: 12px; font-weight: 800; "> EDITAR</a>';

                } ?>
              </td>    
               </tr>
            
          </table>
          </form>
          </td>
        </tr>    

        <tr>
          <td style="width: 50%;  font-size: 10px; text-align: center; height: 100px;" >
        <div id="map_canvas"></div> 
         </td>
        <td style="width: 50%; height: 90vh;">
         <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3760.2899843746186!2d-99.1929319!3d19.5291307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x52738f699069a7b3!2zMTnCsDMxJzQ1LjAiTiA5OcKwMTEnMzQuNyJX!5e0!3m2!1ses-419!2smx!4v1652490618684!5m2!1ses-419!2smx" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
       
       <iframe src="https://www.google.com/maps/embed/v1/place?q=<?php echo $coordc?>&key=AIzaSyB4iIUMXD0GrrxFC2BbNRhXcVZtfLDrhEQ" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </td> 
      </tr>
</tbody>
   </table>

<table border="1px"  bordercolor="#9d981c;" width="100%" >
  <tbody>
       <tr>
          <td style="width: 50%;  font-size: 10px; background: #9d981c; text-align: center;" > <button type="url" style="color:grey; font-size: 12px; border-color:#9d981c; font-weight: 800; background: #9d981c; " >
                  SOLICITAR CORRECCION
                </button></td>   

     
          <td style="width: 50%;  font-size: 10px; background: #9d981c; text-align: center;" >  
            <table style="width: 100%;">
              <tr> 
              <td style="width: 70%;  font-size: 10px; background: #9d981c; text-align: center;">    
            <button type="url" style="color: grey; font-size: 12px; border-color:#9d981c;  font-weight: 800; background: #9d981c;"  >
                  ACTUALIZAR CATALOGO
                </button> </td>   

            <td style=" text-align: center; font-weight: 800; background: #9d981c; color: #FFFFFF; font-size: 12px; height=30px;" >
                  PANTALLA 1
                 </td>
               </tr>  
            </table>       
          </td>
          
        </tr>
     </tbody>
   </table>


   <table border="1px"  bordercolor="#9D981C" width="100%">
       <tr>
          <td  style=" width: 50%; text-align: center; background: #9d981c;  border-color: #9d981c; color: #ffffff; font-size: 12px; font-weight: 800;  height=30px;" colspan="4">LA TIENDA VISITADA TIENE UNA BUENA DISTRIBUCION EN EL AREA DE MUESTREO?</td>  
          <td style="width: 40px;  font-size: 10px; text-align: center; background: #9d981c;" >

             <div class="btn-group">
             <?php
             echo ' 
              <button type="button" class="btn btn-warning" id= "si" style="width: 15%;  font-size: 12px; font-weight: 800;"><a href="index.php?action=supinforme&admin=aceptar&indice='.$idmes.'&idplan='.$idplan.'&idrec='.$idrec.'&id='.$informeCont->getidinf().'" style="color: #000000;  font-size: 12px; font-weight: 800; "> SI</a></button>';
                ?>
                <button type="button" class="btn btn-warning" style="width: 15%;  font-size: 12px; font-weight: 800;" data-toggle="modal" data-target="#modal-correccion">
                  NO
                </button>
<?php
             echo ' 
              <button type="button" class="btn btn-warning" id= "si" style="width: 45%;  font-size: 12px; font-weight: 800;"><a href="index.php?action=supinforme&admin=noap&indice='.$idmes.'&idplan='.$idplan.'&idrec='.$idrec.'&id='.$informeCont->getidinf().'" style="color: #000000;  font-size: 12px; font-weight: 800; ">NO APLICA</a></button>';
                ?>
                
            </div>
                 
          </td>
         
          <td bordercolor="#dbd66d"  style="background: #9d981c; width: 20px; font-size: 16px; text-align: center;  " >

<?php 
    //if ($infant==0){ 
    //  echo '<a href="index.php?action=suplistatiendas&admin=li&idmes='.$idmes.'&idsup='.$idsup.'&idplan='.$idplan.'"> <i class="fa fa-step-backward" aria-hidden="true" style="color: #000000;"></i></a>';
    //} else {
     echo '<td style="width: 20px; font-size: 16px; text-align: center; background: #9d981c; " >

      <a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$numtienda.'"> <i class="fa fa-step-backward" aria-hidden="true" style="color: #ffffff;"></i></a>';
      
      echo '</td>';
     //}  
     ?>
          <td style="width: 20px; font-size: 16px; text-align: center; background: #9d981c; " >  
             <?php 
    //if ($infant==0){ 
      echo '<a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$numtienda.'"> <i class="fa fa-caret-left fa-lg" aria-hidden="true" style="color: #ffffff;"></i></a>';
    //} else {
    //  echo '<a href="index.php?action=supinforme&idmes='.$idmes.'&idrec='.$idrec.'&id='.$infant.'"> <i class="fa fa-caret-left" aria-hidden="true"></i></a>';
      
     //}  
     ?>
       </td>
       <td style="width: 20px;  font-size: 16px; text-align: center; background: #9d981c;">
  <?php 
      echo '<a href="index.php?action=supinforme02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$numtienda.'"> <i class="fa fa-caret-right fa-lg" aria-hidden="true" style="color: #ffffff;"></i></a>';
   
  ?>
          </td>   
        
          <td style="width: 20px;  font-size: 16px; text-align: center; background: #9d981c; ">

  <?php 
      // ($infsig==0){
        //inputbox("es el final de la lista");
      //7lse {
  echo '<a href="index.php?action=supinforme02&idmes='.$idmes.'&idrec='.$idrec.'&id='.$numtienda.'"> <i class="fa fa-step-forward" aria-hidden="true" style="color: #ffffff;"></i></a>';
    //}
  ?>
</td>
          
        </tr>


      </tbody>
    </table>

    <div class="modal fade" id="modal-correccion">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">No está bien distribuida</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            echo '
            <form role="form" method="post" action="index.php?action=supinforme&admin=cor&idmes='.$informeCont->getidmes().'&idrec='.$informeCont->getidrec().'&id='.$informeCont->getidinf().'">';
             echo '
                 <input type="hidden" name="id" id="id" value="'.$numtienda.'">
                 <input type="hidden" name="idplan" id="idplan" value="'.$idplan.'"> 
                 <input type="hidden"  name="indice" id="idmes" value="'.$idmes.'">
                 <input type="hidden" name="idrec" id="idrec" value="'.$idrec.'">';
            ?>
            <div class="modal-body">
              <p> Escribe el motivo </p>
              <input type="text"  name="solicitud" id="solicitud" style="width: 450px;"> 
              <p>  </p>           
              <p><input type="checkbox"  name="cancelar" id="cancelar" >  Cancelar informe </p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
          </div>
        </form>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
 