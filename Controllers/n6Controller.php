<?php
class NseisController{


	public function vistanseisController(){
		
		if($_GET["admin"]=="eli"){
			$ec=new EstructuraController();
			$ec->eli();
		}else{
		//$datosController = $_GET["idnci"];
		$respuesta =Datosnsei::vistanseiModel("ca_nivel6");
	    
		foreach($respuesta as $row => $item){
			echo '  <tr>
	                 <td>'.$item["n6_id"].'</td>
	                  <td>'.$item["n1_nombre"].'</td>
	                  <td>'.$item["n2_nombre"].'</td>
	                  <td>'.$item["n3_nombre"].'</td>
	                  <td>'.$item["n4_nombre"].'</td>
	                 <td>'.$item["n5_nombre"].'</td>
	                  <td>
	                    <a href="index.php?action=editanivel&admin=editar&ref=&niv=6&id='.$item["n6_id"].'">'.$item["n6_nombre"].'</a>
	                  </td>
	                  <td> <a type="button" href="index.php?action=listan6&admin=eli&niv=6&id='.$item["n6_id"].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';
	            
		}
		}
	}


	public function asignavar(){
		if (isset($_GET["idnci"])){
			$datosController = $_GET["idnci"];
			$reg=Datosncin::vistancinOpcionModel($datosController, "ca_nivel5");
			$id5=$reg["n5_idn4"];
			$reg=Datosncua::vistaN4opcionModel($id5, "ca_nivel4");
			$id4=$reg["n4_idn3"];
			$reg=Datosntres::vistaN3opcionModel($id4, "ca_nivel3");
			$id3=$reg["n3_idn2"];
			$reg=Datosndos::vistaN2opcionModel($id3,"ca_nivel2");
			$id2=$reg["n2_idn1"];
		} else {
			$datosController =1;
		}

		//$datosController = $_GET["idncu"];
			echo '<li><a href="index.php?action=listan2&idnuno='.$id2.'"> / REGIONES </a></li>';
		echo '<li><a href="index.php?action=listan3&idnd='.$id3.'"> / PAISES </a></li>';

		echo '<li><a href="index.php?action=listan4&idnt='.$id4.'"> / CIUDADES </a></li>';

		echo '<li><a href="index.php?action=listan5&idncu='.$id5.'"> / PLANTAS</a></li>';
		
	}


}

?>