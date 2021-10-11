 <?php $recContoller=new recController();
        $recContoller->vistaNuevoRecolector();
 ?>﻿


<section class="content-header">
      <h1>EDITAR RECOLECTOR</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php echo $recContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listarecolector&admin=act">
                <!-- Datos iniciales alta de punto de venta -->
                    
                 <?php $recContoller=new recController();
                     $recContoller->editaRecolector();
                  ?>﻿
                


                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listarecolector"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
            </section>
