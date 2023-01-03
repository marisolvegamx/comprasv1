<section class="content-header">
<h1>CORRECCIONES SOLICITADAS</h1>
</section>
<section class="content container-fluid">
	    


 <table class="table table-bordered table-hover">
      <tr>
        <td style="width: 10%">
            <button  class="btn btn-default float-sm-right" ><a 
            <?php 
            include "Utilerias/leevar.php";
            echo
              'href="index.php?action=suplistatiendas&admin=li&idmes='.$idmes.'&idsup='.$idsup.'&idciu='.$idciu.'&eta=2&idc='.$id_ciu.'">   Regresar  ';
                ?>
                </a>
              </button>
</td>
      </tr>
     
</table>
         <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                <th style="background-color: #8596b0; text-align: center; color: #FFFFFF; width: 10%; " >No. Visita/Informe</th>
                <th style="background-color: #8596b0; text-align: center; color: #FFFFFF; width: 25%; " >Recolector</th>
                <th style="background-color: #8596b0; text-align: center; color: #FFFFFF; width: 25%; " >Estatus</th>
                <th style="background-color: #8596b0; text-align: center; color: #FFFFFF; width: 40%; " >Motivo</th>
                
                            
<?php

$ingreso = new SupInformesController();
$ingreso -> SuplistacorreccionController();

?>

  </table>
</div>

</section>