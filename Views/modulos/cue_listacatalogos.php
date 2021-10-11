  <?php include "Controllers/catalogosController.php";
  $catalogosControl=new CatalogosController();
  $catalogosControl->vistaListaCat();
  ?>

<section class="content-header">
      <h1>CATALOGOS<small></small></h1>
     
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
	<div class="col-md-12" >
	

<button class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px;"><a  href="index.php?action=nuevocatalogo&admin=nvo&op=cc"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>

  
	 </div>
	 </div>
    
     <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>NOMBRE DEL CATALOGO</th>
                  <th>DETALLE</th>
    
              <th>BORRAR</th>
                </tr>
  <?php
      foreach($catalogosControl->lista as  $item){
        echo '
        <tr>
                  <td>'.$item[0].'</td>
                  <td><a href="index.php?action=nuevocatalogo&admin=ed&op=cc&id='.$item[0].'"><strong>'.$item[1].'</strong></a></td>
                  <td> <a href="index.php?action=listacatalogosgen&op=cat&admin=lis&cat='.$item["ca_idcatalogo"].'">DETALLE</a></td>
                  <td>  <a  onclick="return dialogoEliminar()"  href="index.php?action=listacatalogos&admin=eli&cat='.$item["ca_idcatalogo"].'"><i class="fa fa-times"></i></a></td> 
                </tr>
 
        ';
      }

        echo '  </table>
            </div>';
    ?>
        
    </section>

