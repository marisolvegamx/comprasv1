<?php 


  include_once  'Controllers/supPreparaController.php';
  include "api/src/contratoapp.php";
  include "Utilerias/leevar.php";
  $supPrepCon=new SupPreparaController();
  $supPrepCon->vistaPreparacion();
// var_dump($supPrepCon->informe);
// var_dump($supPrepCon->infdetalle);
  // $enlacesModel == "suppreparacion" ||
   //echo "--".$idc;
  //clave mari AIzaSyANZ_tj0m9KI-W0MZKmXImqpH_V6AkJgfI
  ?>

   <script type="text/javascript">
    $( document ).ready(function() {
  
	$(".ocodigosnop").css('display', 'none');
	});
	
    function vercodigos(selector){
    	$("."+selector).toggle(400);
       
    	
    	}
  
    </script>
  
<div class="row" style="margin-top: 5px;">
      <div class="col-md-10 tituloSup" >INFORME DE PREPARACION
      </div>
      <div class="col-md-2 tituloSup2" >PANTALLA 1
      </div>
      <div class="col-md-1 " >
              <div class="row">
               
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">CLIENTE:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supPrepCon->informe["n1_nombre"]?>
      </div>
      <div class="col-md-1 labelAzul1">ÍNDICE:
      </div>
      <div class="col-md-2 labelAzulDatoFecha"><?php echo $supPrepCon->indiceletra?>
      </div>
      <div class="col-md-1 labelAzul1">PLANTA:
      </div>
      <div class="col-md-3 labelAzulDato"><?php echo $supPrepCon->informe["n5_nombre"]?>
      </div>
      <div class="col-md-1 labelAzul1">FOTO <?php echo $supPrepCon->numdet?>
      </div>
      <div class="col-md-1 ">
      <div class="row">
                <div class="col-md-3 tituloSupBotones" >
               
                <a href="<?php 
                if($supPrepCon->numdet>1)
                echo "index.php?action=suppreparacion&idmes=".$supPrepCon->mesas."&idrec=".$supPrepCon->rec_id."&id=".$id."&eta=".$supPrepCon->etapa."&cli=".$supPrepCon->idcli."&numdet=1"?>">
           <?php if ($supPrepCon->numdet==1) echo '<img src="Views/dist/img/Retrocede-Final-off.jpg">'; 
           else echo '  <img src="Views/dist/img/Retrocede-Final.jpg">';  ?>
              
                
                </a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php if ($supPrepCon->numdet>1) echo "index.php?action=suppreparacion&idmes=".$supPrepCon->mesas."&idrec=".$supPrepCon->rec_id."&id=".$id."&eta=".$supPrepCon->etapa."&cli=".$supPrepCon->idcli."&numdet=".($supPrepCon->numdet-1)?>"><img src="Views/dist/img/Retrocede-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a href="<?php if($supPrepCon->numdet<sizeof($supPrepCon->infdetalles))echo "index.php?action=suppreparacion&idmes=".$supPrepCon->mesas."&idrec=".$supPrepCon->rec_id."&id=".$id."&eta=".$supPrepCon->etapa."&cli=".$supPrepCon->idcli."&numdet=".($supPrepCon->numdet+1)?>"><img src="Views/dist/img/Avanza-1.jpg"></a>
                </div>
                <div class="col-md-3 tituloSupBotones" ><a  href="<?php 
                if(sizeof($supPrepCon->infdetalles)>1) echo "index.php?action=suppreparacion&idmes=".$supPrepCon->mesas."&idrec=".$supPrepCon->rec_id."&id=".$id."&eta=".$supPrepCon->etapa."&cli=".$supPrepCon->idcli."&numdet=".sizeof($supPrepCon->infdetalles)?>">
                <?php if(sizeof($supPrepCon->infdetalles)<2) echo '<img src="Views/dist/img/Avanza-Final-off.jpg">';
                else echo ' <img src="Views/dist/img/Avanza-Final.jpg">';?>
               </a>
                </div>
              </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 labelAzul1">RECOLECTOR:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supPrepCon->informe["rec_nombre"]?>
      </div>
      <div class="col-md-1 labelAzul1">ID INFORME:
      </div>
      <div class="col-md-2 labelAzulDato"><?php echo $supPrepCon->informe["ine_id"]?>
      </div>
      <div class="col-md-1 labelAzul1">FECHA:
      </div>
      <div class="col-md-3 labelAzulDato"><?php echo Utilerias::verFecha($supPrepCon->informe["fecharep"])?>
      </div>
      <div class="col-md-1 labelAzul1">HORA:
      </div>
      <div class="col-md-1 labelAzulDato"><?php echo $supPrepCon->informe["horarep"]?>
      </div>
    </div>
    <div class="row">
     
      <div class="col-md-1 labelAzul1">COMENTARIOS:
      </div>
      <div class="col-md-11 labelAzulDato"><?php echo $supPrepCon->informe["ine_comentarios"]?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
  
  
  
    <div class="row">
      <div class="col-md-12 espacioHor"></div>
    </div>
    
    
 <?php 
 $claseboton="col-md-2";

   
   
         ?>
         <div class="row">
<div class="col-md-6 areaImagen areaScrollP6">
  <div >

<div >

<?php 
$idimagen=1;

    echo '<div class="img-magnifier-container">
				    <img id="myimage'.$idimagen.'" src="'.$supPrepCon->dirimagen.'\\'.$supPrepCon->infdetalle["ied_rutafoto"].'"class="d-block w-100" height="1134" >
				    </div>';
 
?>
				</div> 	</div>
<!---Termina carrusel-->	    
	  
  </div>
      <div class="col-md-6 areaImagen areaScrollP6">
<!---Inicia listado-->	 

     <?php 
   $supMuesCon=$supPrepCon;
     include "suppanelliscom.php";
     ?>
<!---Termina listado-->		  
      </div>
</div>

 <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
  

 
    <div class="row">

      <div class="<?= $claseboton?> areaBoton" > 
    <?php
   
    if ($supPrepCon->correccionFoto["vai_estatus"]==1){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
 echo '
      <a href="" class="btn '.$clase .' btn-sm btn-block" data-toggle="modal" data-target="#modal-motivo" >CORREGIR</a>';
   
    ?> 
        
      </div>
 <?php if ($supPrepCon->correccionFoto["vai_estatus"]==2){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="<?= $claseboton?> areaBoton"><a href="<?= $supPrepCon->liga.'&admin=solcor&est=2&numimg='.$supPrepCon->listaimagenes[0]["id"]?>" class="btn <?= $clase?> btn-sm btn-block ">CANCELAR</a>
      </div>
      <?php if ($supPrepCon->correccionFoto["vai_estatus"]==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="<?= $claseboton?> areaBoton"><a href="<?= $supPrepCon->liga.'&admin=solcor&est=3&numimg='.$supPrepCon->listaimagenes[0]["id"] ?>" class="btn <?= $clase?> btn-sm btn-block ">ACEPTAR</a>
      </div>
    <?php  if($pan!=9){ ?>
        <div class="col-md-6 vacio">
      </div>
    <?php }?>
    </div>

 
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 labelAzul1Comentario"><?php echo $supPrepCon->pantalla["pa_preguntaseccion"]?>
      </div>
      <div class="col-md-3 areaBoton" >  <?php 
        $opcsel=$supPrepCon->getopcsel();
        if ($opcsel==1){
          $clase= "btn-informesActivado";
          
        } else {
        $clase= "btn-informes";
       
        }
        $numsec=$supPrepCon->pantalla["pa_seccion"];
        if($supPrepCon->idcli==5)
            $numsec=$numsec+1;
            if($supPrepCon->idcli==6)
                $numsec=$numsec+2;
        echo '
        <a href="'.$supPrepCon->liga.'&admin=aceptarsec&sec='.$numsec.'&vasid='.$supPrepCon->idval.'&iddet='.$supPrepCon->infdetalle["ied_id"].'" class="btn '.$clase .' btn-sm btn-block ">SI</a>';
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
        <a href="" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">NO</a>';
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
            


            <form role="form" method="post" action=

        <?php
              echo $supPrepCon->liga.'&admin=solcor&est=1&numimg='.$supPrepCon->listaimagenes[0]["id"];
            ?>
              >
              
              <p> Escribe el motivo de corrección</p>
              <?php echo '
                  <input type="hidden" name="img" id="img" value='.$supPrepCon->listaimagenes[0]["id"].'>';
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
              
            <form role="form" method="post" action="<?php echo $supPrepCon->liga.'&admin=noaceptarsec&sec='.$numsec.'&vasid='.$supPrepCon->idval.'&iddet='.$supPrepCon->infdetalle["ied_id"]; ?>">
              <?php echo '
                
                 <input type="hidden" name="idplan" id="idplan" value="'.$idplan.'"> 
              
                ';
            ?>
              <p> Escribe el motivo </p>
              <input type="text"  name="observacionessec" id="observacionessec" style="width: 450px;">
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
    
 <script type="text/javascript">
   
   <?php 
    /* Initiate Magnify Function
    with the id of the image, and the strength of the magnifier glass:*/
   echo  'magnify("myimage1", 3);';
  
   
   ?>
    </script>