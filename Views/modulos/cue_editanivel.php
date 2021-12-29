<?php 
  
  $estructuraController=new EstructuraController();
  $estructuraController->vistaEditar();
  $nivel=$estructuraController->resultado;

  $idc = filter_input(INPUT_GET, "id",FILTER_SANITIZE_NUMBER_INT);
  $niv = filter_input(INPUT_GET, "niv",FILTER_SANITIZE_NUMBER_INT);

  ?>
  <section class="content-header">
  <h1> EDITAR <?php echo $estructuraController->titulo2." ".$estructuraController->titulo1?></h1>
  <h1> <?php echo $estructuraController->titulo?></h1>
   
  </section>
 
  <section class="content container-fluid">
     <div class="row">
      <div class="col-md-12">
        <form role="form" method="post" action="<?php echo "index.php?action=nuevonivel&admin=edi&niv=".$niv?>">
  <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $idc ?>">
 
             <div class="box box-info">
             <div class="box-body">
  
 
  
    
<?php echo $estructuraController->listanivel1;
echo $estructuraController->listanivel2; 
echo $estructuraController->listanivel3;
echo $estructuraController->listanivel4;
echo $estructuraController->listanivel5;
echo $estructuraController->listanivel6;

?>
        <div class="form-group ">
            <label >NOMBRE</label>  
            <input name="nombre" class="form-control" type="text"  size="70" value="<?php echo $nivel["n".$niv."_nombre"]?>">
         </div>   
         </div> 
            <div class="box-footer" style="border-bottom: hidden">
                 <a  class="btn btn-default pull-right" href="<?= $estructuraController->regresar ?>"> Cancelar </a>
                <button type="submit" class="btn btn-info pull-right">Guardar</button>

              </div>
            
   
</div>
 </form>
  
</div>
</div>
</section> 
<script src="js/jquery.cascading-drop-down.js"></script>
    <script>
    $('.cascada').ssdCascadingDropDown({
        nonFinalCallback: function(trigger, props, data, self) {
            trigger.closest('form')
                    .find('input[type="submit"]')
                    .attr('disabled', true);
        },
        finalCallback: function(trigger, props, data) {
            if (props.isValueEmpty()) {
                trigger.closest('form')
                        .find('input[type="submit"]')
                        .attr('disabled', true);
            } else {
                trigger.closest('form')
                        .find('input[type="submit"]')
                        .attr('disabled', false);
            }
        }
    });
</script>
 
 