<?php
ini_set("display_errors", 1); 
error_reporting(E_ERROR);
include "Utilerias/utilerias.php";

class EstructuraController {
	
	public $titulo;
	public $titulo1;
	public $titulo2;
	public $listacliente;
//	public $admin;
	
	public $resultado;
	public $listanivel1;
	public $listanivel2;
	public $listanivel3;
	public $listanivel4;
	public $listanivel5;
	public $listanivel6;
	
	
	public function vistaNuevo(){
		include "Utilerias/leevar.php";
		
		$this->titulo1= Estructura::nombreNivel($niv, 1);
		if($admin=="insertar"){
			$this->insertar();
			
		}else if($admin=="edi"){
			$this->actualizar();
		}else{
			$this->titulo1=Estructura::getDescripcionNivel($niv, "cnfg_estructura");
			switch($niv){
				
				case "1":
					break;
				case "2":
					
					$op="";
					
					$RS_SQM_TE = Datosnuno::vistaN1Model("ca_nivel1");
					foreach ($RS_SQM_TE as $registro) {
						$idn1=$_GET["ref"];
						if ($registro [0]==$idn1){
						   $op.= "<option value='" . $registro [0] . "'  selected>" . $registro [1] . "</option>";	
						} else {
						$op.= "<option value='" . $registro [0] . "'>" . $registro [1] . "</option>";
						}
					}
					$this->listacliente='<label>CLIENTE</label>
					 <div class="form-group col-md-6"><select class="form-control" name="cliente">
					'.$op.'</select></div>';


					$this->titulo=Datosnuno::nombreNivel1($ref, "ca_nivel1");
					
					
					break;
				case "3":
				     $op="";
					
					
	

					$this->titulo=Datosnuno::nombreNivel1($ref, "ca_nivel1");
					
				
					break;
				case "4":
					$this->titulo=Datosntres::nombreNivel3($ref, "ca_nivel3");
						break;
				case "5":
					
					$this->titulo=Datosncua::nombreNivel4($ref, "ca_nivel4");
					
					break;
				case "6":
					$this->titulo=Datosncin::nombreNivel5($ref, "ca_nivel5");
					
					break;
			}
			$arr_nomids=array("","idnuno","idnd","idnt","idncu","idnci");
			
			$this->regresar="index.php?action=listan".$niv."&".$arr_nomids[$niv-1]."=".$ref."&admin=detalle";
			if(isset($id)&&$id!="") //es edicion
			{	
			    $this->titulo2="EDITAR";
			$this->action="index.php?action=nuevonivel&admin=edi&niv=".$niv;
			$this->vistaEditar();
			}
			else {
				$this->titulo2="NUEVA";
				$this->action="index.php?action=nuevonivel&admin=insertar&niv=".$niv;
				//echo $this->titulo2;
				//echo $this->action;
			}
		}
	}

	public function vistaEditar(){
		include "Utilerias/leevar.php";
		$this->titulo1= Estructura::nombreNivel($niv, 1);
		if ($niv>1){
		    $ref="n".$niv."_idn".($niv-1);
		} else {
		    $ref=0;
		}
		switch($niv){
			
			case "1":
				//busco clientes
			//	$sql_cli="SELECT
//`ca_clientes`.`cli_idcliente`,
//`ca_clientes`.`cli_nombrecliente`
//FROM `muestreo`.`ca_clientes`;";
//				$op="";
				
//				$RS_SQM_TE = Datos::vistaClientesModel("ca_clientes");
				
				
				$resultado=Datosnuno::getNombre($id, "ca_nivel1");
				//foreach ($RS_SQM_TE as $registro) {
				//	if($registro [0]==$resultado["n1_idcliente"])
				//		$op.= "<option value='" . $registro [0] . "' selected='selected'>" . $registro [1] . "</option>";
				//	else
				//		$op.= "<option value='" . $registro [0] . "' >" . $registro [1] . "</option>";
				//}
				//$this->listacliente='<label>CLIENTE</label>
				//	 <div class="form-group col-md-6"><select class="form-control" name="cliente">
				//	'.$op.'</select></div>';
				$this->resultado=$resultado;
				$this->resultado=array("descripcion"=>$resultado["n".$niv."_nombre"],"referencia"=>$resultado[$ref],"id"=>$resultado["n".$niv."_id"]);
				
				break;
			case "2":
					
				
				$resultado=Datosndos::vistaN2opcionModel($id, "ca_nivel2");
				$this->titulo=Datosnuno::nombreNivel1($resultado["n2_idn1"], "ca_nivel1");
				$this->resultado=$resultado;
				$this->resultado=array("descripcion"=>$resultado["n".$niv."_nombre"],"referencia"=>$resultado[$ref],"id"=>$resultado["n".$niv."_id"]);
				
				
				break;
			case "3":
				$resultado=Datosntres::vistaN3opcionModel($id, "ca_nivel3");
				$this->titulo=Datosndos::nombreNivel2($resultado["n3_idn2"], "ca_nivel2");
				$this->resultado=$resultado;
				
				break;
			case "4":
				$resultado=Datosncua::vistaN4opcionModel($id, "ca_nivel4");
				$this->titulo=Datosntres::nombreNivel3($resultado["n4_idn3"], "ca_nivel3");
				$this->resultado=$resultado;
				break;
			case "5":
				$resultado=Datosncin::getNombre($id, "ca_nivel5");
				
				$this->titulo=Datosncua::nombreNivel4($resultado["n5_idn4"], "ca_nivel4");
				$this->resultado=$resultado;
				break;
			case "6":
				$resultado=Datosnsei::vistanseiOpcionModel($id, "ca_nivel6");
				$this->titulo=Datosncin::nombreNivel5($resultado["n6_idn5"], "ca_nivel5");
				$this->resultado=$resultado;
				break;
		}
		
		
		$arr_nomids=array("","idnuno","idnd","idnt","idncu","idnci");
		
		$this->regresar="index.php?action=listan".$niv."&".$arr_nomids[$niv-1]."=".$resultado[$ref]."&admin=detalle";
		//var_dump($this->resultado);
		if($niv>4){
		$this->listanivel1 = Utilerias::crearSelectCascada("CLIENTE",1, Utilerias::crearOpcionesNivel(1,  0,$this->resultado["n".$niv."_idn1"]),"");
		
		$this->listanivel2 = Utilerias::crearSelectCascada("REGION",2, Utilerias::crearOpcionesNivel(2,  $this->resultado["n".$niv."_idn1"],$this->resultado["n".$niv."_idn2"]),"");
		
		$this->listanivel3 = Utilerias::crearSelectCascada("PAIS",3, Utilerias::crearOpcionesNivel(3,  $this->resultado["n".$niv."_idn2"],$this->resultado["n".$niv."_idn3"]),"");
		$this->listanivel4=Utilerias::crearSelectCascada("CIUDAD",4,Utilerias::crearOpcionesNivel(4,  $this->resultado["n".$niv."_idn3"],$this->resultado["n".$niv."_idn4"]),"");
		    
	//	$this->listanivel5=Utilerias::crearSelectCascada($this->titulo,5,Utilerias::crearOpcionesNivel(5, $this->resultado["n".$niv."_idn4"],$this->resultado[$id]),"");
		}
		if($niv>5)
		    $this->listanivel5=Utilerias::crearSelectCascada("PLANTA",5,Utilerias::crearOpcionesNivel(5, $this->resultado["n".$niv."_idn4"],$this->resultado["n".$niv."_idn5"]),"");
		
		//    $this->listanivel6= Utilerias::crearSelectCascada($this->titulo,6,Utilerias::crearOpcionesNivel(6,  $this->resultado["n".$niv."_idn],$this->resultado["n".$niv."_idn6"]),"");
		
	
	
	}
	
	
// 	$dataCa_nivel3 = new Datosntres();
	
	
	
// 	$postData['n3_idn2'] = intval($_POST['n3_idn2']);
// 	$postData['n3_id'] = intval($_POST['n3_id']);
// 	$postData['n3_nombre'] = $_POST['n3_nombre'];
	
	
// 	$fieldsNames= array('n3_idn2','n3_id','n3_nombre');
	
// 	$orderBy='';
// 	if(in_array($_GET['orderBy'], $fieldsNames)){
// 		$orderBy = $_GET['orderBy'];
// 	}
	
// 	$order='asc';
// 	if($_GET['order']){
// 		$order = $_GET['order'];
// 	}
	
// 	$task = addslashes($_GET['task']);
// 	if($task == 'edit' && $_POST){
// 		$n3_id = intval($_POST['n3_id']);
// 	}
// 	else{
// 		$n3_id = intval($_GET['n3_id']);
// 	}
	
// 	$HTMLCa_nivel3->menu();
	
// 	switch ($task) {
		
		
// 		//-----------------------------------------------------------------------------------------
// 		// Edit
// 		//-----------------------------------------------------------------------------------------
// 		case 'edit':
// 			// get calendar date for this training
// 			// Get training infos
// 			if($_POST){
// 				$dataCa_nivel3->update($postData);
// 			}
			
// 			$dataCa_nivel3->get($n3_id);
// 			$HTMLCa_nivel3->form($dataCa_nivel3->element);
			
// 			break;
			
// 			//-----------------------------------------------------------------------------------------
// 			// Add
// 			//-----------------------------------------------------------------------------------------
// 		case 'add':
// 			if($_POST){
// 				if($dataCa_nivel3->add($postData)){
// 					echo 'Done!';
// 				}
// 				else{
// 					echo 'Error!';
// 				}
// 			}
// 			else{
// 				$HTMLCa_nivel3->form($dataCa_nivel3->element);
// 			}
			
// 			break;
			
			
// 			//-----------------------------------------------------------------------------------------
// 			// Delete
// 			//-----------------------------------------------------------------------------------------
// 		case 'del':
// 			if($n3_id){
// 				if($dataCa_nivel3->del($n3_id)){
// 					echo 'Done!';
// 				}
// 				else{
// 					echo 'Error!';
// 				}
// 			}
// 			else{
// 				echo 'Error!';
// 			}
			
			
// 			//-----------------------------------------------------------------------------------------
// 			// List
// 			//-----------------------------------------------------------------------------------------
// 		default:
			
			public function insertar(){

				include "Utilerias/leevar.php";
				try{
				switch($niv){
					
					case "1":
					$cliente=1;
						$tabla="ca_nivel1";
						$resultado=Datosnuno::insertar($nombre, $cliente, $tabla);
						$this->regresar="index.php?action=listan1";
						break;
					case "2":
					  	$data['n2_idn1']=$cliente;
						$data['n2_nombre']=$nombre;
						$resultado=Datosndos::add($data, "ca_nivel2");
						$this->regresar="index.php?action=listan2&admin=lis&idnuno=".$referencia;
						break;
					case "3":
						
						$resultado=Datosntres::add($clanivel1, $clanivel2, $nombre, "ca_nivel3");
						
						$this->regresar="index.php?action=listan3&admin=lis&idnd=".$referencia;
						//die("termine");
						break;
					case "4":
						//$data['n2_idn1']=$cliente;
						//$data['n2_nombre']=$nombre;
						//$resultado=Datosndos::add($data, "ca_nivel2");
						$resultado=Datosncua::add( $clanivel3,$nombre,$clanivel1,$clanivel2, "ca_nivel4");
						$this->regresar="index.php?action=listan4&admin=lis&idnt=".$referencia;
						break;
					case "5":
						
						$resultado=Datosncin::add($clanivel4,$clanivel3,$clanivel2,$clanivel1,$nombre,$clasup,"ca_nivel5");
						$this->regresar="index.php?action=listan5&admin=lis&idncu=".$referencia;
						break;
					case "6":
						
						$resultado=Datosnsei::add($clanivel5, $clanivel4,$clanivel3,$clanivel2,$clanivel1,$nombre, "ca_nivel6");
						$this->regresar="index.php?action=listan6&admin=lis&idnci=".$referencia;
						break;
				}
				
 				echo "
             <script type='text/javascript'>
               window.location='$this->regresar'
                 </script>
                   ";
			}catch(Exception $ex){
				echo Utilerias::mensajeError($ex->getMessage());
			}
			}
			
			
			public function actualizar(){
				include "Utilerias/leevar.php";
				try{
					switch($niv){
						
						case "1":
							//$data['n1_idcliente']=$cliente;
							$data['n1_nombre']=$nombre;
							$data["n1_id"]=$id;
							$resultado=Datosnuno::update($data, "ca_nivel1");
							$this->regresar="index.php?action=listan1";
							break;
						case "2":
							$data['n2_idn1']=$referencia;
							$data['n2_nombre']=$nombre;
							$data["n2_id"]=$id;
							$resultado=Datosndos::update($data, "ca_nivel2");
							$this->regresar="index.php?action=listan2&admin=detalle&idnuno=".$referencia;
							break;
						case "3":
						    //echo "entre a EstructuraController";
					        $data['n3_idn2']=$clanivel2;
							$data['n3_idn1']=$clanivel1;
							$data['n3_nombre']=$nombre;
							$data["n3_id"]=$id;
						
							$resultado=Datosntres::update($data, "ca_nivel3");
							$this->regresar="index.php?action=listan3&admin=lis&idnd=".$referencia;
							break;
						case "4":
						    $data['n4_idn3']=$clanivel3;
							$data['n4_idn2']=$clanivel2;
							$data['n4_idn1']=$clanivel1;
							$data['n4_nombre']=$nombre;
							$data["n4_id"]=$id;
							$resultado=Datosncua::update($data, "ca_nivel4");
							
							$this->regresar="index.php?action=listan4&admin=lis&idnt=".$referencia;
							break;
						case "5":
						   $resultado=Datosncin::update($clanivel4,$clanivel3,$clanivel2,$clanivel1,$clasup, $nombre,$id ,"ca_nivel5");
							$this->regresar="index.php?action=listan5&admin=lis&idncu=".$referencia;
							break;
						case "6":
							$resultado=Datosnsei::update($clanivel5,$clanivel4,$clanivel3,$clanivel2,$clanivel1,$nombre,$id ,"ca_nivel6");
							$this->regresar="index.php?action=listan6&admin=lis&idnci=".$referencia;
						
							break;
					}
					if($resultado)
					echo "
             <script type='text/javascript'>
               window.location='$this->regresar'
                 </script>
                   ";
					else {
						echo Utilerias::mensajeError("No se pudo editar");
					}
				}catch(Exception $ex){
					echo Utilerias::mensajeError($ex->getMessage());
				}
			}
			
			public function eli(){
				include "Utilerias/leevar.php";
				try{
					$ref="n".$niv."_idn".($niv-1);
					switch($niv){
						
						case "1":
						
							$resultado=Datosnuno::del( $id, "ca_nivel1");
							$this->regresar="index.php?action=listan1";
							break;
						case "2":
							$resultado=Datosndos::vistaN2opcionModel($id, "ca_nivel2");
							$referencia=$resultado[$ref];
							$resultado=Datosndos::del($id, "ca_nivel2");
							$this->regresar="index.php?action=listan2&idnuno=".$referencia."&admin=detalle";
							break;
						case "3":
							$resultado=Datosntres::vistaN3opcionModel($id, "ca_nivel3");
							$referencia=$resultado[$ref];
							$resultado=Datosntres::del($id, "ca_nivel3");
							$this->regresar="index.php?action=listan3&admin=lis&idnd=".$referencia;
							break;
						case "4":
							$resultado=Datosncua::vistaN4opcionModel($id, "ca_nivel4");
							$referencia=$resultado[$ref];
							$resultado=Datosncua::del($id, "ca_nivel4");
							$this->regresar="index.php?action=listan4&admin=lis&idnt=".$referencia;
							break;
						case "5":
							$resultado=Datosncin::vistancinopcionModel($id, "ca_nivel5");
							$referencia=$resultado[$ref];
							$resultado=Datosncin::del($id,"ca_nivel5");
							$this->regresar="index.php?action=listan5&admin=lis&idncu=".$referencia;
							break;
						case "6":
							$resultado=Datosnsei::vistanseiOpcionModel($id, "ca_nivel6");
							$referencia=$resultado[$ref];
							$resultado=Datosnsei::del($id,"ca_nivel6");
							$this->regresar="index.php?action=listan6&admin=lis&idnci=".$referencia;
							break;
					}
					
					echo "
             <script type='text/javascript'>
               window.location='$this->regresar'
                 </script>
                   ";
				}catch(Exception $ex){
					echo Utilerias::mensajeError($ex->getMessage());
				}
			}
}

