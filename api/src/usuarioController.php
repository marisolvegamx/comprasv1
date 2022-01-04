<?php


class UsuarioController{

	public function validarUsuarioController(){
		  //los dats vienen en base 64
       		# vamos a validar el mail y el password
	    $logemail= filter_input(INPUT_POST, "user",FILTER_SANITIZE_SPECIAL_CHARS) ;
	    $pass= filter_input(INPUT_POST, "pass",FILTER_SANITIZE_SPECIAL_CHARS) ;
	 
       	$datoslogController= array("logemail"=>base64_decode($logemail),
        			"logpass"=>base64_decode($pass)); 
      
       	//var_dump($_POST);
		$respuesta =$this->validaUsuarioModel($datoslogController, "cnfg_usuarios");	
		//var_dump($respuesta);		
	//	echo $respuesta;
	
		if ($respuesta>0) {
		 	 	#actualiza Estatus del usuario
			date_default_timezone_set('America/Mexico_City');
			$ultimacon= date('Y-M-d G:i:s');
			
			$datosController= array("estatus"=>'Conectado',
        			"horalog"=>$ultimacon,
        			"emusuario"=>$logemail); 
			
			//$respuesta =UsuarioModel::actualizaLogEntUsuarioModel($datosController, "cnfg_usuarios");


			//echo $respuesta;
			/*$respuesta =UsuarioModel::consultaUsuarioModel($datoslogController, "cnfg_usuarios");
			 
			$gpo = $respuesta["cus_clavegrupo"];
        	$idioma = $respuesta["cus_idioma"];
        	$cargo=$respuesta["cus_cargo"];
        	$NombreUsuario=$respuesta["cus_usuario"];
			
			 
        	 session_start();
			$_SESSION['Usuario'] = $logemail;
		    $_SESSION['GrupoUs'] = $gpo;
		    $_SESSION['Cargo'] = $cargo;
			//echo $logemail;
			//echo $_SESSION['Usuario'];
			//echo $_SESSION['GrupoUs'];
			//echo $_SESSION['Cargo'];	
        	//$ini=UsuarioController::Inicia_Sesion($logemail);
			//$ini=UsuarioController::Guarda_Grupo($gpo);
    		$_SESSION['autentificado'] = 'SI';
    		$_SESSION['NombreUsuario'] = $NombreUsuario;
    		$_SESSION["idiomaus"] = $idioma;
		
			*/
		return true;
		} else {
				//echo "El usuario o la contrasena son incorrectos";
				return false;
		} 	    
	       	 	
	}
	
	public function validaUsuarioModel($datosModel, $tabla){
	    
	    
	    
	    $stmt = Conexion::conectar()-> prepare("SELECT cus_usuario, cus_contrasena, cus_email  FROM $tabla WHERE cus_email=:email and cus_contrasena=:pass");
	    
	    
	    
	    $stmt->bindParam(":email", $datosModel["logemail"], PDO::PARAM_STR);
	    
	    $stmt->bindParam(":pass", $datosModel["logpass"], PDO::PARAM_STR);
	    
	    
	    
	    $stmt-> execute();
	    
	    
	    
	    return $stmt->rowCount();
	    
	    
	    
	    $stmt->close();
	    
	}
	
	

	Public Function Obten_Usuario() {
	    @session_start();
	    $Usuario = $_SESSION['Usuario'];
	    //@session_write_close(); 
	    return $Usuario;
	}

	Public Function Obten_NomUsuario() {
	    @session_start();
	    $Usuario = $_SESSION['NombreUsuario'];
	    //@session_write_close(); 
	    return $Usuario;
	}

	Public Function Obten_Grupo() {
    //session_start(); 
    $Grupo = $_SESSION['GrupoUs'];
    // session_unset; 
    return $Grupo;
	}

	Public Function Obten_Cargo() {
    //session_start(); 
    $Cargo = $_SESSION['Cargo'];
    // session_unset; 
    return $Cargo;
	}

	Public Function Destruye_Sesion() {
    @session_start();
    // Destruye todas las variables de la sesi&oacute;n 
    @session_unset();
    // Finalmente, destruye la sesi&oacute;n 
    @session_destroy();
}



}
