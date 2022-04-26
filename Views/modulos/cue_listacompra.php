<script type="text/javascript" >
function dialogoEliminar(){
	if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
		return true;
	else return false;
}
 </script>

<section class="content-header">
<h1>LISTA DE COMPRA</h1>
</section>
<section class="content container-fluid">
 <div class="row">
	<div class="col-md-12" >
	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
	<a href="index.php?action=nuevalistaCompra&admin=nvo"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
	 </div>
	 </div>


<?php

$ingreso = new ListaComController();
$ingreso -> vistaliscController();

?>

</section>

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
    	
    	},
    	success:function(response){
    		var arr=response.split("¬¬");
    	
    		if(arr.length>0)
    		{//	primera=arr[0];
    		$("#niv-2").append("<option value=''>---  Todos  ---</option>");
    		$("#niv-2").append(arr[0]);
    		$("#niv-2").prop( "disabled", false );
    		}
    		
    	
    	}
    	});
    	}else
    	{	
    		$("#niv-2").prop( "disabled", true );
    		$("#niv-2").html("<option value=''>---  Todos  ---</option>");
    	
    		
    	}
    }
</script>