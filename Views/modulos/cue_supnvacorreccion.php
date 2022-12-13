
<?php 
include_once  'Controllers/supCorreccionController.php';

  include "Utilerias/leevar.php";
  $supCorCon=new SupCorreccionController();
  $supCorCon->vistaCorrec(); 
  $estatus=array(1=>"SOLICITADA",2=>"CANCELADA",3=>"ACEPTADA",4=>"POR REVISAR",5=>"LEIDA");
 // var_dump($supCorCon->valfoto);
  ?>
<div class="row" style="margin-top: 5px;">

      <div class="col-md-11 tituloSupCorreciones" >CORRECCIONES
      </div>
      <?php
      echo '      
        <div class="col-md-1 tituloSupCorreciones" ><a href="index.php?action=suplistacorrecciones&idmes='.$idmes.'&idrec='.$idrec.'&id='.$idi.'&sec=4&cli='.$cli.'&eta=2&idsup='.$idsup.'&idciu='.$idciu.'"><img src="Views/dist/img/Retrocede-Final.jpg"></a>
            </div>';
      ?> 
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1"> NO. DE CORRECCION:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->valfoto["vai_consecutivoinf"]?>
   
      </div>
       <div class="col-md-2 labelAzul1">ESTATUS:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $estatus[$supCorCon->valfoto["vai_estatus"]]?>
      </div>
     
    </div>
   


    <div class="row">
      <div class="col-md-2 labelAzul1">CLIENTE:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->valfoto["clienteNombre"]?>
   
      </div>
       <div class="col-md-2 labelAzul1">TIENDA:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->valfoto["nombreTienda"]?>
      </div>
     
    </div>
      <div class="row">
      <div class="col-md-2 labelAzul1">PLANTA:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->valfoto["plantaNombre"]?>
      </div>
      <div class="col-md-2 labelAzul1">FECHA SOLICITUD:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->valfoto["fecha"]?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">ÍNDICE:
      </div>
      <div class="col-md-4 labelAzulDatoFecha"><?php echo $supCorCon->indiceletra ?>
      </div>
      <div class="col-md-2 labelAzul1">REPROCESO:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->valfoto["vai_numcorreccion"]?>
      </div>
    </div>
  
    <div class="row">
      <div class="col-md-2 labelAzul1">RECOLECTOR:
      </div>
      <div class="col-md-4 labelAzulDato"><?php echo $supCorCon->recolector?>
      </div>
      <div class="col-md-2 labelAzul1">TIEMPO DE RESPUESTA:
      </div>
      <div class="col-md-4 labelAzulDato"><?php if($supCorCon->valfoto["vai_estatus"]==4){
          echo $supCorCon->calcTiempoResp($supCorCon->valfoto["vai_fecha"],$supCorCon->correccionFoto["cor_createdat"]);
      
      }?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">CORRECCION SOLICITADA:
      </div>
      <div class="col-md-10 labelAzulDato"><?php echo $supCorCon->valfoto["descMostrar"]?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">MOTIVO:
      </div>
      <div class="col-md-10 labelAzulDato"><?php echo $supCorCon->valfoto["vai_observaciones"]?>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>

  <!-- area de fotos o botones -->
   <div class="row">
      <div class="col-md-6 areaImagen areaScrollP6">
      <div class="carousel slide" id="carousel-920444" data-interval="0">

<div class="carousel-inner">
  <div class="carousel-item active">
        <img class="d-block w-100"  src="<?= $supCorCon->dirimagen.'\\'.$supCorCon->imagenOrig["ruta"] ?>" />
      </div>
      <?php if($supCorCon->valfoto["vai_descripcionfoto"]==4){ //es 360?>
      <div class="carousel-item">
     
        <img class="d-block w-100"  src="<?= $supCorCon->dirimagen.'\\'.$supCorCon->imagenOrig2["ruta"] ?>" />
   
    
      </div>
      <div class="carousel-item">
     
        <img class="d-block w-100"  src="<?= $supCorCon->dirimagen.'\\'.$supCorCon->imagenOrig3["ruta"] ?>" />
   
    
      </div>
      <?php }?>
  </div> 	
    <?php if($supCorCon->valfoto["vai_descripcionfoto"]==4){ //es 360?>
  <a class="carousel-control-prev" href="#carousel-920444" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="sr-only">Anterior</span></a>
  <a class="carousel-control-next" href="#carousel-920444" data-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="sr-only">Siguiente</span></a>
      <?php }?>
</div>
</div>
<!-- panel 2 -->
      <div class="col-md-6 areaImagenDer areaScrollP6">
       <div class="carousel slide" id="carousel2" data-interval="0">

<div class="carousel-inner">
  <div class="carousel-item active">
       <?php if($supCorCon->valfoto["vai_estatus"]==4){?>
      <img class="w-100"   src="<?= $supCorCon->dirimagen.'\\'.$supCorCon->correccionFoto["cor_rutafoto1"] ?>" />
       <?php }?> 
      </div>
       <?php if($supCorCon->valfoto["vai_descripcionfoto"]==4){ //es 360?>
      <div class="carousel-item">
     
        <img class="d-block w-100"  src="<?= $supCorCon->dirimagen.'\\'.$supCorCon->correccionFoto["cor_rutafoto2"] ?>" />
   
    
      </div>
       <div class="carousel-item">
     
        <img class="d-block w-100"  src="<?= $supCorCon->dirimagen.'\\'.$supCorCon->correccionFoto["cor_rutafoto3"] ?>" />
   
    
      </div>
     
      <?php }?>
  </div> 
  	
    <?php if($supCorCon->valfoto["vai_descripcionfoto"]==4){ //es 360?>
  <a class="carousel-control-prev" href="#carousel2" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="sr-only">Anterior</span></a>
  <a class="carousel-control-next" href="#carousel2" data-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="sr-only">Siguiente</span></a>
      <?php }?>
      </div>
      </div>
   </div>
   <!-- fin fotos -->
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">

      <div class="col-md-6 labelAzulDatoCorrecciones" >FOTO ANTERIOR
      </div>
      <div class="col-md-6 labelAzulDatoCorrecciones">NUEVA FOTO
      </div>
    </div>
    
    <?php  if($supCorCon->valfoto["vai_estatus"]==4){
    
        include "cue_supcorrecfoto.php";
        
        }
     ?>