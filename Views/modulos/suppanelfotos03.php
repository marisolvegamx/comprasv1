
<div class="row">
<div class="col-md-6 areaImagen  areaScrollP5">
<!---Inicia carrusel-->
<div class="carousel slide" id="carousel-920444" data-interval="0">
<div class="carousel-inner">

<?php 
$idimagen=1;
foreach($supMuesCon->listaimagenes as $imagen){
    echo '<div class="carousel-item active">
				    <img id="myimage'.$idimagen.'" src="'.$supMuesCon->dirimagen.'\\'.$imagen["ruta"].'" class="img-fluid" >
				    </div>';
    $idimagen++;
}?>
				</div> <a class="carousel-control-prev" href="#carousel-920444" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-920444" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
			</div>
<!---Termina carrusel-->	    
	  
  </div>
      <div class="col-md-6 areaImagenDer areaScrollP5">
<!---Inicia listado-->	 

     <?php 
    // echo "****".$numpant;
     if($pan==5){
     include "suppanelliscom.php";
     }?>
<!---Termina listado-->		  
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
      <a href="'.$supMuesCon->liga.'&admin=solcor&est=1&eta='.$supMuesCon->etapa.'&numimg='.$supMuesCon->listaimagenes[0]["id"].'" class="btn '.$clase .' btn-sm btn-block" >CORREGIR</a>';
   
    ?> 
        
      </div>
 <?php if ($supMuesCon->correccionFoto["vai_estatus"]==2){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="col-md-2 areaBoton"><a href="<?= $supMuesCon->liga.'&admin=solcor&est=2&eta='.$supMuesCon->etapa.'&numimg='.$supMuesCon->listaimagenes[0]["id"]?>" class="btn <?= $clase?> btn-sm btn-block ">CANCELAR</a>
      </div>
      <?php if ($supMuesCon->correccionFoto["vai_estatus"]==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
      ?>
      <div class="col-md-2 areaBoton"><a href="<?= $supMuesCon->liga.'&admin=solcor&est=3&eta='.$supMuesCon->etapa.'&numimg='.$supMuesCon->listaimagenes[0]["id"] ?>" class="btn <?= $clase?> btn-sm btn-block ">ACEPTAR</a>
      </div>
    
        <div class="col-md-6 vacio">
      </div>
    
    </div>
    
    