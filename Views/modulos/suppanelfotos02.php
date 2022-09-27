
<div class="row">
 <div class="col-md-6 areaImagen areaScrollP6">
  <div >

<div >
<?php 
$idimagen=1;
$imagen=$supMuesCon->listaimagenes[0];
    echo ' <div class="img-magnifier-container">
				    <img id="myimage'.$idimagen.'" src="'.$supMuesCon->dirimagen.'\\'.$imagen["ruta"].'" class="d-block w-100" height="1134" >
				    </div>
  <div style="height: 20px"></div>';
?>
				</div>
				
					</div>
    
	 </div> 
 
   


   <div class="col-md-6 areaImagenDer areaScrollP6 img-magnifier-container">
      <img id="myimage2" class="w-100"   src="<?= $supMuesCon->dirimagen.'\\'.$supMuesCon->listaimagenes[1]["ruta"]?>" height="1134"/> 
      </div>
	  
     
</div>

 <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
   