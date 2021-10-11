<?php
session_start();
//echo $_SESSION['Usuario'];

//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
//ini_set("display_errors", 1); 


require_once "Controllers/usuarioController.php";
require_once "Controllers/controller.php";
require_once "Models/model.php";
require_once "Models/crud_usuario.php";
require_once "Controllers/enlacesController.php";
require_once "Models/crud_enlaces.php";

require_once "Controllers/recolectorController.php";

require_once "Controllers/clientescontroller.php";
require_once "Controllers/prodController.php";
require_once "Controllers/atributosController.php";
require_once "Controllers/unegocioController.php";
//require_once "Controllers/muestrasController.php";

require_once "Controllers/n1controller.php";
require_once "Controllers/n2Controller.php";
require_once "Controllers/n3Controller.php";
require_once "Controllers/n4Controller.php";
require_once "Controllers/n5Controller.php";
require_once "Controllers/n6Controller.php";
//require_once "Controllers/subnivelController.php";
//require_once "Controllers/ponderacionController.php";
//require_once "Controllers/estandarController.php";
//require_once "Controllers/abiertaController.php";
//require_once "Controllers/generalController.php";
//require_once "Controllers/productoController.php";

 //require_once "Controllers/indpostmix/estadisticasController.php";
 //require_once "Controllers/indpostmix/graficaIndicadorController.php";
 //require_once "Controllers/indpostmix/resumenResultadosController.php";
 //require_once "Controllers/indpostmix/resumenResxRepController.php";
 //require_once "Controllers/indpostmix/generadorGraficas.php";
 //require_once "Controllers/indpostmix/TablaEstadistica.php";
 //require_once "Controllers/indpostmix/tablaDinamicaController.php";
 //require_once "Controllers/indpostmix/buscapvController.php";
 //require_once "Controllers/indpostmix/historialReportesController.php";
 //require_once "Controllers/indpostmix/basePostmixController.php";


//require_once "Controllers/reporteController.php";



require_once "Models/crud_clientes.php";
require_once "Models/crud_recolectores.php";
require_once "Models/crud_atributos.php";

//require_once "Models/crud_franquicias.php";

require_once "Models/crud_producto.php";

require_once "Models/crud_unegocios.php";

require_once "Models/crud_estructura.php";

require_once "Models/crud_n1.php";
require_once "Models/crud_n2.php";
require_once "Models/crud_n3.php";
require_once "Models/crud_n4.php";
require_once "Models/crud_n5.php";
require_once "Models/crud_n6.php";
require_once "Models/crud_ciudades.php";

//require_once "Models/crud_ponderacion.php";
//require_once "Models/crud_estandar.php";
//require_once "Models/crud_abierta.php";
//require_once "Models/crud_subnivel.php";
//require_once "Models/crud_generales.php";
//require_once "Models/crud_productos.php";
//require_once "Models/crud_muestras.php";

//require_once "Models/crud_solicitudes.php";
//require_once "Models/crud_reporte.php";
require_once "Models/crud_catalogos.php";
require_once "Models/crud_catalogoDetalle.php";
//require_once "Models/crud_inspectores.php";
require_once "Models/crud_mesasignacion.php";

if (isset($_GET["salir"])) {
	$nuevo =new UsuarioController();
	$nuevo->Destruye_Sesion();
}


// ******************************************
//require_once "Models/uNegocio.php";

//require_once "Models/crud_usuario.php";
//require_once "Models/crud_estado.php";

//require_once "Models/crud_imagendetalle.php";
  

$mvc =new MvcController();



if (isset($_SESSION['Usuario'])) {
	//echo "con usuario";
	$mvc -> plantilla();
	
} else {
	//echo "inicio";
	$mvc -> inicio();
}


?>
