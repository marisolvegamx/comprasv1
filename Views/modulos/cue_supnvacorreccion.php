
<?php 
include_once  'Controllers/supCorreccionController.php';

  include "Utilerias/leevar.php";
  $supCorCon=new SupCorreccionController();
  $supCorCon->vistaCorrec(); 
  
  ?>
<div class="row" style="margin-top: 5px;">
      <div class="col-md-12 tituloSupCorreciones" >CORRECIONES
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">CLIENTE:
      </div>
      <div class="col-md-4 labelAzulDato">PEPSI
      </div>
       <div class="col-md-2 labelAzul1">TIENDA:
      </div>
      <div class="col-md-4 labelAzulDato">WALMART UNIVERSIDAD
      </div>
     
    </div>
      <div class="row">
      <div class="col-md-2 labelAzul1">PLANTA:
      </div>
      <div class="col-md-4 labelAzulDato">PEPSI
      </div>
      <div class="col-md-2 labelAzul1">FECHA SOLICITUD:
      </div>
      <div class="col-md-4 labelAzulDato">3 L PET
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">ÍNDICE:
      </div>
      <div class="col-md-4 labelAzulDatoFecha">AGO 2021
      </div>
      <div class="col-md-2 labelAzul1">NO DE CORRECCION:
      </div>
      <div class="col-md-4 labelAzulDato">12345
      </div>
    </div>
  
    <div class="row">
      <div class="col-md-2 labelAzul1">RECOLECTOR:
      </div>
      <div class="col-md-4 labelAzulDato">1
      </div>
      <div class="col-md-2 labelAzul1">TIEMPO DE RESPUESTA:
      </div>
      <div class="col-md-4 labelAzulDato">SLP
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">CORRECCION SOLICITADA:
      </div>
      <div class="col-md-10 labelAzulDato">10/11/21
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 labelAzul1">MOTIVO:
      </div>
      <div class="col-md-10 labelAzulDato">ETIQUETA ABANDERADA
      </div>
    </div>


    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 areaImagen areaScrollP6">
      <div class="carousel slide" id="carousel-920444" data-interval="0">

<div class="carousel-inner">
  <div class="carousel-item active">
        <img class="d-block w-100"  src="fotografias\7_2022\IMG_1_20220708_154518.JPG" />
      </div>
      <div class="carousel-item">
        <img class="d-block w-100"  src="fotografias\7_2022\IMG_1_20220708_155037.JPG" />
      </div>
  </div> 	
  <a class="carousel-control-prev" href="#carousel-920444" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="sr-only">Anterior</span></a>
  <a class="carousel-control-next" href="#carousel-920444" data-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="sr-only">Siguiente</span></a>
</div>
</div>
      <div class="col-md-6 areaImagenDer areaScrollP6">
      <img class="w-100"   src="fotografias\7_2022\IMG_1_20220708_122000.JPG" /> 
      </div>
      </div>
   
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
    <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
</div>
    <div class="row">
      <div class="col-md-4 areaBoton" ><a href="#" class="btn btn-informes btn-sm btn-block ">SOLICITAR NUEVAMENTE</a>
      </div>
      <div class="col-md-4 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">NO REMPLZAR</a>
      </div>
      <div class="col-md-4 areaBoton"><a href="#" class="btn btn-informes btn-sm btn-block ">ACEPTAR</a>
      </div>
    </div>
