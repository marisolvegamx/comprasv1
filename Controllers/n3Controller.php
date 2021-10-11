<?php
class NtresController{


	public function vistantresController(){
		
		if($_GET["admin"]=="eli"){
			$ec=new EstructuraController();
			$ec->eli();
		}else if($_GET["admin"]=="ins"){
			$ec=new EstructuraController();
			$ec->insertar();
		}else if($_GET["admin"]=="act"){
			$ec=new EstructuraController();
			$ec->actualizar();
		}


	

		if (isset($_GET["idnd"])) {
			$datosController = $_GET["idnd"];
		}else{
			$datosController = 1;

		}

		$respuesta =Datosntres::vistantresModel("ca_nivel3");

		foreach($respuesta as $row => $item){
			echo '  <tr>
	                  <td>'.$item["n3_id"].'</td>
	                 <td>'. $item["n1_nombre"].'</td>
	                 <td>'.$item["n2_nombre"].'</td>
	                  <td>
	                    <a href="index.php?action=editan3&admin=edita&niv=3&ref=&id='.$item["n3_id"].'">'.$item["n3_nombre"].'</a>
	                  </td>
	                  <td> <a type="button" href="index.php?action=listan3&admin=eli&niv=3&id='.$item["n3_id"].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';
	            
		}
	}

	public function asignavar(){
		
		//busco el idn2
		
		if (isset($_GET["idnd"])) {
			$datosController = $_GET["idnd"];
			$reg=Datosndos::vistaN2opcionModel($datosController,"ca_nivel2");
			$id2=$reg["n2_idn1"];
			echo '<li><a href="index.php?action=listan2&admin=lista&idnuno='.$id2.'"> / REGIONES</a></li>';
		} else
				
			echo '<li><a href="index.php?action=listan1"><em class="fa fa-dashboard"></em>NIVEL 1</a></li>';
			}


public function selectNivelJsonController() {
foreach ($_GET as $nombre_campo => $valor) {
$asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_GET, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
echo(eval($asignacion));
}
//$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
$res = Datosnuno::vistan1Model("ca_nivel1");
$nivel = 1;
if (isset($clanivel1)) {
$res = Datosndos::vistandosModel($clanivel1, "ca_nivel2");
$nivel = 2;
} if (isset($clanivel2)) {
$res = Datosntres::vistantresModel($clanivel2, "ca_nivel3");
$nivel = 3;
} if (isset($clanivel3)) {
$res = Datosncua::vistancuaModel($clanivel3, "ca_nivel4");
$nivel = 4;
} if (isset($clanivel4)) {
$res = Datosncin::vistancinModel($clanivel4, "ca_nivel5");
$nivel = 5;
} if (isset($clanivel5)) {
$res = Datosnsei::vistanseiModel($clanivel5, "ca_nivel6");
$nivel = 6;
}

foreach ($res as $item) {

$menu[] = array("name" => $item["n" . $nivel . "_nombre"], "value" => $item["n" . $nivel . "_id"]);
}

echo json_encode(['success' => 'true', "replacement" => "", 'menu' => $menu]);
}

}	// fin de controller

?>