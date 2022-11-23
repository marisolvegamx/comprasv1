   <div class="row">
      <div class="col-md-12 espacioHor">
      </div>
</div>
    <div class="row">
      
      
       <div class="col-md-4 areaBoton" > 
    <?php
   
    
 echo '
      <a href="" class="btn btn-informes btn-sm btn-block" data-toggle="modal" data-target="#modal-motivo" >SOLICITAR NUEVAMENTE</a>';
   
    ?> 
        
      </div>
 
      <div class="col-md-4 areaBoton"><a href="<?= $supCorCon->liga.'&admin=noaceptar'?>" class="btn btn-informes btn-sm btn-block ">NO REEMPLAZAR</a>
      </div>
     
      <div class="col-md-4 areaBoton"><a href="<?= $supCorCon->liga.'&admin=aceptar' ?>" class="btn btn-informes btn-sm btn-block ">ACEPTAR</a>
      </div>
      
    </div>
    
    
<!-- /.formulario modal para corregir foto-->
        <div class="modal fade" id="modal-motivo">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">CORREGIR</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            


            <form role="form" method="post" action="

        <?php
        echo $supCorCon->liga.'&admin=solcor'
            ?>"
              >
              
              <p> Escribe el motivo de corrección</p>
             
              <input type="text"  name="observ" id="observ" style="width: 450px;">
              <p>  </p>

              <button type="submit" class="btn btn-primary">Enviar</button>
            </form>


            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      </div>
