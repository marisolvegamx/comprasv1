
<div class="row">
<div class="col-md-6 areaImagen areaScrollP6">
  <div >

<div >

<?php 
$idimagen=1;
foreach($supMuesCon->listaimagenes as $imagen){
    echo '<div class="img-magnifier-container">
				    <img id="myimage'.$idimagen.'" src="'.$supMuesCon->dirimagen.'\\'.$imagen["ruta"].'"class="d-block w-100"  >
				    </div>';
    $idimagen++;
}?>
				</div> 	</div>
<!---Termina carrusel-->	    
	  
  </div>
      <div class="col-md-6 areaImagen areaScrollP6">
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
  