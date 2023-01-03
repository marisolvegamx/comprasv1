<section class="content-header">
<h1>ETAPAS CLIENTES</h1>
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
        <td style="width: 30%">INDICE : <?php echo $mesasignacion ?></td>
        <td style="width: 30%">CIUDAD : <?php echo $idciu ?></td>
        <td style="width: 10%">
          <?php echo
            '<button  class="btn btn-default float-sm-right" ><a href="index.php?action=suplistainformes&supervisor='.$idsup.'&indiceinf='.$idmes.'">   Regresar  </a></button>';
            ?>
        </td>
      </tr>
      
</table>
         <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                
<?php
             // busca encabezados de plantas
$ingreso = new SupInformesController();
$ingreso -> SuplistaEtapasController();

?>



</section>