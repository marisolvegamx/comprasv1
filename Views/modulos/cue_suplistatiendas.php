<section class="content-header">
<h1>INFORMES DE COMPRA</h1>
</section>
<section class="content container-fluid">
	    
<?php
//include "Utilerias/leevar.php";
$idsup=$_GET["idsup"];
$idciu=$_GET["idciu"];
$idmes=$_GET["idmes"];

        $nomsup= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",18,$idsup);
         //$respuesta5=Datosncua::vistaN4opcionModel($idciu, "ca_nivel4");
        //$nomciudad= $respuesta5["nomciudad"];
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
        <td style="width: 40%">SUPERVISOR : <?php echo $nomsup ?></td>
        <td style="width: 20%">INDICE : <?php echo $mesasignacion ?></td>
        <td style="width: 20%">CIUDAD : <?php echo $idciu ?></td>
        <td style="width: 10%">
            <button  class="btn btn-default float-sm-right" ><a 
            <?php echo
              'href="index.php?action=suplistaetapas&admin=li&idmes='.$idmes.'&idsup='.$idsup.'&idciu='.$idciu.'&eta=2&idc='.$id_ciu.'">   Regresar  ';
                ?>
                </a>
              </button>
</td>
      </tr>
     
</table>
         <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                
<?php

$ingreso = new SupInformesController();
$ingreso -> SuplistaTiendasController();

?>



</section>