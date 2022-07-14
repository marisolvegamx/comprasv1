<section class="content-header">
<h1>INFORMES DE COMPRA</h1>
</section>
<section class="content container-fluid">
	    
<?php
//include "Utilerias/leevar.php";
$idsup=$_GET["idsup"];
$idplan=$_GET["idplan"];
$idmes=$_GET["idmes"];




$resp1=Datosncin::getDatosPlanta($idplan,"ca_nivel5");
        $nomplan= $resp1["n5_nombre"];
        $nomcliente =  $resp1["n1_nombre"]; 
        $nomsup=$resp1["nomsup"];

        $aux = explode(".", $idmes);
                       
          $solomes = $aux[0];
          $soloanio = $aux[1];
            
            switch ($solomes) {
              case 1:
                $mesnom="ENERO";
              break;
             case 2:
                $mesnom="FEBRERO";
              break;
             case 3:
                $mesnom="MARZO";
              break;   
             case 4:
                $mesnom="ABRIL";
              break;   
             case 5:
                $mesnom="MAYO";
              break;   
             case 6:
                $mesnom="JUNIO";
              break;   
             case 7:
                $mesnom="JULIO";
              break;   
             case 8:
                $mesnom="AGOSTO";
              break;   
             case 9:
                $mesnom="SEPTIEMBRE";
              break;   
             case 10:
                $mesnom="OCTUBRE";
              break;   
             case 11:
                $mesnom="NOVIEMBRE";
              break;   
             case 12:
                $mesnom="DICIEMBRE";
              break;
             }

          $mesasignacion = $mesnom." - ".$soloanio;
 
//}  
?>



 <table class="table table-bordered table-hover">
      <tr>
        <td style="width: 50%">SUPERVISOR : <?php echo $nomsup ?></td>
        <td style="width: 50%">PLANTA : <?php echo $nomplan ?></td>
      </tr>
</table>
<table class="table table-bordered table-hover">
       <tr>
        
        <td style="width: 50%">INDICE : <?php echo $mesasignacion ?></td>
        <td style="width: 50%">CLIENTE : <?php echo $nomcliente ?></td>
      </tr>
      
 </table>     
          
         <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 15%">No. de TIENDA</th>
                  <th style="width: 20%">TIPO DE TIENDA</th>
                  <th style="width: 20%">ZONA</th>
                  <th style="width: 15%">ESTATUS</th>
                </tr>	
<?php

$ingreso = new SupInformesController();
$ingreso -> SuplistaTiendasController();

?>



</section>