  <?php include "Controllers/catalogosController.php";
  $catalogosControl=new CatalogosController();
  $catalogosControl->vistaLista();
  if($catalogosControl->op=="cat"){
  	$nuevo="&cat=".filter_input(INPUT_GET, "cat",FILTER_SANITIZE_NUMBER_INT);
  }
  else{
  $nuevo="";
  }
  ?>

<section class="content-header">
      <h1><?php echo $catalogosControl->titulo?></h1>
     <h1><small>
      <?php echo $catalogosControl->nombrecat?></small></h1>
          <?php if($catalogosControl->op=="cat"){?>
     <ol class="breadcrumb" >
	<li><a href="index.php?action=listacatalogos&admin=lis"><em class="fa fa-dashboard"></em>CATALOGOS</a></li>
     

       
</ol>
<?php }?>
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
	<div class="col-md-12" ><button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; "><a href="index.php?action=nuevocatalogo&admin=nvo&op=<?php echo $catalogosControl->op.$nuevo?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>
  
 <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>NOMBRE DE OPCION</th>
                   
              <th>BORRAR</th>
                </tr>
 <?php
      foreach($catalogosControl->lista as  $item){
         if($catalogosControl->op=="cat"){
            $id=$item["cad_idcatalogo"].'.'.$item["cad_idopcion"]."&cat=".$item["cad_idcatalogo"];
          }
          else{
            $id=$item[0];
          }
      

        echo '
        <tr>
                  <td>'.$item[0].'</td>
                  <td><a href="index.php?action=nuevocatalogo&admin=li&op='.$catalogosControl->op.'&id='.$id.'"><strong>'.$item[1].'</strong></a></td>
                  <td> <a  onclick="return dialogoEliminar()"  href="index.php?action=listacatalogosgen&admin=eli&op='.$catalogosControl->op.'&id='.$id.'"><i class="fa fa-times"></i></a>
                    </td> 
                </tr>
 
        ';
      }

        echo '  </table>
            </div>';
    ?>



    </section>

