
<div class="row">
<div class="col-md-6 areaImagen  areaScrollP5">
<!---Inicia carrusel-->
<div class="carousel slide" id="carousel-920444" data-interval="0">
<div class="carousel-inner">

<?php foreach($supMuesCon->listaimagenes as $imagen){
    echo '<div class="carousel-item active">
				    <img src="'.$supMuesCon->dirimagen.'\\'.$imagen["ruta"].'" class="img-fluid" >
				    </div>';
    
}?>
				</div> <a class="carousel-control-prev" href="#carousel-920444" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-920444" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
			</div>
<!---Termina carrusel-->	    
	  
  </div>
      <div class="col-md-6 areaImagenDer areaScrollP5">
<!---Inicia listado-->	 

     <?php 
    // echo "****".$numpant;
     if($numpant==5){
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
      if ($opcsel==3){
          $clase= "btn-informesActivado";
          
      } else {
        $clase= "btn-informes";
       
      }
 echo '
      <a href="#" class="btn '.$clase .' btn-sm btn-block " data-toggle="modal" data-target="#modal-correccion">CORREGIR</a>';
   
    ?> 
        
      </div>

      
      <div class="col-md-2 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">CANCELAR</a>
      </div>
      <div class="col-md-2 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">ACEPTAR</a>
      </div>
    
      <div class="col-md-6 areaBoton">
      <div class=" btn-informes btn-sm btn-block">&nbsp;</div>
      </div>
    
    </div>