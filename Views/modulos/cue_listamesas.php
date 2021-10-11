  <?php include "Controllers/catalogosController.php";
  $catalogosControl=new CatalogosController();
  $catalogosControl->vistaLista();
  ?>

<section class="content-header">
      <h1><?php echo $catalogosControl->titulo?><small></small></h1>
     
    </section>
   <script type="text/javascript" >
function dialogoEliminar(){
	if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
		return true;
	else return false;
}
 </script>
    <!-- Main content -->
    <section class="content container-fluid">
    <div class="row">
	<div class="col-md-12" ><button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; "><a href="index.php?action=nuevocatalogo&admin=nvo&op=<?php echo $catalogosControl->op?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>
    
   <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>MES</th>
                  <th>AÑO</th>
                  <th>BORRAR</th>
                </tr>

    <?php 
    $i=$bac=1;
    foreach($catalogosControl->lista as  $item){
        	
        	
        	switch ($item["num_mes_asig"]){
        		case 1:
        			$nommes="ENERO";
        			break;
        		case 2:
        			$nommes="FEBRERO";
        			break;
        		case 3:
        			$nommes="MARZO";
        			break;
        		case 4:
        			$nommes="ABRIL";
        			break;
        		case 5:
        			$nommes="MAYO";
        			break;
        		case 6:
        			$nommes="JUNIO";
        			break;
        		case 7:
        			$nommes="JULIO";
        			break;
        		case 8:
        			$nommes="AGOSTO";
        			break;
        		case 9:
        			$nommes="SEPTIEMBRE";
        			break;
        		case 10:
        			$nommes="OCTUBRE";
        			break;
        		case 11:
        			$nommes="NOVIEMBRE";
        			break;
        		case 12:
        			$nommes="DICIEMBRE";
        			break;
        	}
          echo '        
          <tr>
            <td>'.$nommes.'</td>
                            <td>'.$item[1].'</td>
             <td> <a onclick="return dialogoEliminar()"  href="index.php?action=listamesas&admin=eli&op='.$catalogosControl->op.'&id='. $item["num_mes_asig"].'.'.$item["num_per_asig"].'"><i class="fa fa-times"></i></a>
                </td>';
                
           
           $i++;
      }
      echo '
    </section>';

?>