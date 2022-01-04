<?php $listaCompraContoller=new ListaComController();
      $listaCompraContoller->vistaNuevaListaCompra();
 ?>﻿


<section class="content-header">
      <h1>NUEVA LISTA</h1>
</section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php //echo $listaCompraContoller->getMensaje()?>
        <div class="row">
		
        <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <form role="form" method="post" action="index.php?action=listacompra&admin=ins">
                <!-- Datos iniciales alta de punto de venta -->
                    <div class="form-group col-md-12">
                      <label>CLIENTE</label>
                      
                      <select class="form-control cascada" name="clientelis"  
                        data-id="niv-1"
                       onchange="javascript:cargarCombobox(this.value)">
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaCliente()?>
                                    
                      </select>

                    </div>

                      <div class="form-group col-md-12">
                      <label>PLANTA</label>
                      <select class="form-control" name="plantalis"  
                       
                        id="niv-2"
                       disabled>
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaPlanta()?>
                                    
                      </select>

                      </div>

                      <div class="form-group col-md-12">
                      <label>INDICE</label>
                       <select class="form-control" name="indicelis">
                         <option value="">Seleccione una opción</option>

                         <?php $listaCompraContoller->getListaIndice()?>
                                    
                      </select>
                      </div>

                      <div class="form-group col-md-12">
                      <label>RECOLECTOR</label>
                      <select class="form-control" name="recolectorlis" id="recolectorlis" disabled>
                         <option value="">Seleccione una opción</option>

                     
                                    
                      </select>
                      </div>
                   

               <div class="form-group col-md-12">
                    <label>NOTA</label>
                     <input type="text" class="form-control" placeholder="NOTA" name="notalis">
                  </div>
                  
                   <button type="submit" class="btn btn-info">GUARDAR</button>
             
                 <?php
                 
                 echo '
                 <a class="btn btn-default" style="margin-left: 10px" href="index.php?action=listacompra"> CANCELAR </a> ';
                 ?>
                 
              </form>  
</div>
              </div></div>
              </div>
           
    <script>
    function cargarCombobox(cli)
    {
    	if(cli>0){
        	console.log(cli);
    	var parametro={"clientelis":cli
    			};

    	$.ajax({
    		data:parametro,
    	url:"getPlantaRec.php",
    	type:"post",
    	beforeSend:function(){
    		$("#niv-2").html("cargando...");
    		$("#recolectorlis").html("cargando...");
    	},
    	success:function(response){
    		var arr=response.split("¬¬");
    	
    		if(arr.length>0)
    		{//	primera=arr[0];
    		$("#niv-2").append("<option value=''>Seleccione una opción</option>");
    		$("#niv-2").append(arr[0]);
    		$("#niv-2").prop( "disabled", false );
    		$("#recolectorlis").append(arr[1]);
    		$("#recolectorlis").prop( "disabled", false );
    	
    		}
    		else
    		{	primera=response;
    		//$("#recolectorlis").append("<option value='0'>- TODOS -</option>");
    		$("#recolectorlis").append(primera);
    		$("#recolectorlis").prop( "disabled", false );
    		}
    		
    	
    	}
    	});
    	}else
    	{	
    		$("#niv-2").prop( "disabled", true );
    		$("#niv-2").html("<option value=''>Seleccione una opción</option>");
    	
    		$("#recolectorlis").prop( "disabled", true );
    		$("#recolectorlis").html("<option value=''>Seleccione una opción</option>");
    	}
    }
</script>
            </section>
