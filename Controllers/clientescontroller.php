<?php

include "Controllers/estructuraController.php";

class ClienteController{
	#llamada a template

    # interaccion del usuario
    public function enlacesPaginasController(){
    	if(isset($_GET["action"])){
		
			$enlacesController = $_GET["action"];
    	}	
    	else {
    	$enlacesController= "index";	
    	}
    	$respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);
    	include $respuesta;	
    }
	#registro de usuarios
    #-----------
    public function registroClienteController(){
    	if (isset($_POST["nombrecliente"])){	
    	
	    	$datosController=array("nombrecliente"=>$_POST["nombrecliente"]);
	    	
	    	
	    	$respuesta = Datos::registroUsuarioModel($datosController, "ca_clientes");
	    	
	    	       // if($respuesta=="success"){
            echo "
            <script type='text/javascript'>
              window.location.href='index.php?action=listacliente'
                </script>
                  ";
        //} else {
        //  echo "error";
        //}
    	}
    }
    	#vista clientes
		public function vistaClientesController(){
			
			

       	echo '<div class="row mb-2">
        <div class="col-sm-6">
 
   </div><!-- /.col -->
 
	   <div class="col-md-6" >
      	<button  class="btn btn-default float-sm-right" style="margin-right: 18px; margin-top:15px; margin-bottom:15px; ">
      	<a href="index.php?action=nuevocliente"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Nuevo  </a></button>
      </div>
	 </div>';





  echo '<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>NOMBRE DEL CLIENTE</th>
                  <th>BORRAR</th>
                </tr>';
                
			$i=$bac=1;
			$respuesta =Datos::vistaClientesModel("ca_clientes");
			foreach($respuesta as $row => $item){
				if(($i-1)%3==0){
					echo '<div class="row">';
					$bac=0;
				}
				echo '
				<tr>
                  <td>'.$item["cli_id"].'</td>
                  <td><a href="index.php?action=editacliente&id='.$item["cli_id"].'"><strong>'.$item["cli_nombre"].'</strong></a></td>
                  <td> <a class="btn btn-block btn-info" href="index.php?action=listan2&idnuno='.$item["cli_id"].'&admin=detalle">DETALLE</a></td>
                  <td> <a class="btn btn-block btn-info" onclick="return dialogoEliminar();" href="index.php?action=listacliente&idb='.$item["cli_id"].'"><i class="fa fa-trash-o" ></i>borrar</a></td> 
                </tr>

            
        ';

			if(($i)%3==0){
				
				echo '  </table>
            </div>';
				$bac=1;
			}
			$i++;
		}
	}	
	public function editarClienteController(){
		//echo "entre a edita clientes controller";
		$datosController = $_GET["id"];
		//echo $datosController;
		$respuesta = Datos::editarClienteModel($datosController, "ca_clientes");
	    	
			echo '<input type="hidden" name="ideditar" value="'.$respuesta["cli_id"].'" >
				 <input name="nombreeditar" id="nombreeditar" class="form-control" value="'.$respuesta["cli_nombre"].'" required>';	
	}	
	public function actualizarClienteController(){
		
		if(isset($_POST["nombreeditar"])){
            $datosController= array("id"=>$_POST["ideditar"],
            			"nombre"=>$_POST["nombreeditar"]); 
         	$respuesta = Datos::actualizarClienteModel($datosController, "ca_clientes");
         //&&	$liga='';
	    	if($respuesta=="success"){
				  echo "
            	<script type='text/javascript'>
                window.location.href='index.php?action=listacliente'
                </script>
                  ";
			
	    	} else {
	    		echo "error";
	    	}
		}
	}	
public function borrarClienteController(){

		if(isset($_GET["idb"])){

			$datosController = $_GET["idb"];
			

			$respuesta = Datos::borrarClienteModel($datosController, "ca_clientes");
			//echo $respuesta;
		    if($respuesta=="success"){
		    	 echo '<script> windows.location= "index.php?op=listacliente" </script>';
				
				
		   	} else {
		    		echo "error";
		    	}
		}		    		
	}	
}

?>