<?php
class MvcController{
	#llamada a template
	public function plantilla(){
 		include "Views/template.php";
	}
	public function inicio(){
		
		include "Views/modulos/cue_login.php";
	}
	
	public function repFQ(){

		$tiporep=$_GET["action"];
		
		include "Views/modulos/cue_".$tiporep.".php";

		
	}
    	
    public function enlacesPaginasController(){
        
    	if(isset($_GET["action"])){
		
			$enlacesController = $_GET["action"];
    	}	

    	else {

    	$enlacesController= "index";	

     //echo $enlacesController;
    	}

    		
    		//echo $enlacesController;
    	$respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);

    	if ($enlacesController=="index"){

    	} else {
    		include $respuesta;	
    	}
    		
    }

	
	
}

?>