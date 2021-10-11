<?php
class NcinController{


	public function vistancinController(){
		
		if($_GET["admin"]=="eli"){
			$ec=new EstructuraController();
			$ec->eli();
		}else{
		if (isset($_GET["idncu"])){
			$datosController = $_GET["idncu"];
		} else {
			$datosController =1;
		}	
		$respuesta =Datosncin::vistancinModel("ca_nivel5");
	
		foreach($respuesta as $row => $item){
			echo '  <tr>
	                  <td>'.$item["n5_id"].'</td>
	                  <td>'.$item["n1_nombre"].'</td>
	                  <td>'.$item["n2_nombre"].'</td>
	                  <td>'.$item["n3_nombre"].'</td>
	                  <td>'.$item["n4_nombre"].'</td>
	                  <td>
	                    <a href="index.php?action=editanivel&admin=lis&ref=&niv=5&id='.$item["n5_id"].'">'.$item["n5_nombre"].'</a>
	                  </td>
	                 
<td> <a type="button" href="index.php?action=listan5&admin=eli&niv=5&id='.$item["n5_id"].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';
	            
		}
		}
	}

	public function asignavar(){
		if (isset($_GET["idncu"])){
			$datosController = $_GET["idncu"];
			$reg=Datosncua::vistaN4opcionModel($datosController, "ca_nivel4");
			$id4=$reg["n4_idn3"];
			$reg=Datosntres::vistaN3opcionModel($id4, "ca_nivel3");
			$id3=$reg["n3_idn2"];
			$reg=Datosndos::vistaN2opcionModel($id3,"ca_nivel2");
			$id2=$reg["n2_idn1"];
		} else {
			$datosController =6;
		}

			
		echo '<li><a href="index.php?action=listan2&idnuno='.$id2.'"> / REGIONES</a></li>';
		echo '<li><a href="index.php?action=listan3&idnd='.$id3.'"> / PAISES</a></li>';
		
		echo '<li><a href="index.php?action=listan4&idnt='.$id4.'"> / CIUDADES</a></li>';
		
	}
}

?>