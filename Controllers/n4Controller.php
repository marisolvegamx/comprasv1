<?php
class NcuaController{


	public function vistancuaController(){
		if($_GET["admin"]=="eli"){
			$ec=new EstructuraController();
			$ec->eli();
		}else{
		if (isset($_GET["idnt"])) {
			$datosController = $_GET["idnt"];
		}else{
			$datosController = 1;

		}
		//$datosController = $_GET["idnt"];
		$respuesta =Datosncua::vistancuaModel($datosController,"ca_nivel4");

		foreach($respuesta as $row => $item){
			$n3=$item["n4_idn3"];
			$resp =Datosntres::vistaN3opcionModel($n3,"ca_nivel3");  
			$n3_nombre =$resp["n3_nombre"];
			echo '  <tr>
	                  <td>'.$item["n4_id"].'</td>
	                  <td>'.$item["n1_nombre"].'</td>
	                  <td>'.$item["n2_nombre"].'</td>
	                  <td>'.$n3_nombre.'</td>
	                  <td>
	                    <a href="index.php?action=editan4&admin=lis&ref=ref&niv=4&id='.$item["n4_id"].'">'.$item["n4_nombre"].'</a>
	                  </td>
	                 
<td> <a type="button" href="index.php?action=listan4&admin=eli&niv=4&id='.$item["n4_id"].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';
	            
		}
		}
	}

	public function asignavar(){
		//$datosController = $_GET["idnt"];
		if (isset($_GET["idnt"])) {
			$datosController = $_GET["idnt"];
			$reg=Datosntres::vistaN3opcionModel($datosController, "ca_nivel3");
			$id3=$reg["n3_idn2"];
			$reg=Datosndos::vistaN2opcionModel($id3,"ca_nivel2");
			$id2=$reg["n2_idn1"];
		}else{
			$datosController = 1;

		}
		echo '<li><a href="index.php?action=listan2&admin=lis&idnuno='.$id2.'"> REGION / </a></li>';
		echo '<li><a href="index.php?action=listan3&admin=lis&idnd='.$id3.'"> PAIS</a></li>';
		
			
	}
}

?>