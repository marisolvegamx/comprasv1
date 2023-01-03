<?php
session_start();
//echo $_SESSION['Usuario'];

//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
ini_set("display_errors", 0); 


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
require_once "Controllers/ListaComController.php";

require_once "Controllers/n1controller.php";
require_once "Controllers/n2Controller.php";
require_once "Controllers/n3Controller.php";
require_once "Controllers/n4Controller.php";
require_once "Controllers/n5Controller.php";
require_once "Controllers/n6Controller.php";
require_once "Controllers/LisComDetController.php";
require_once "Controllers/sustitucionController.php";
require_once "Controllers/ciuresController.php";
require_once "Controllers/causaController.php";
require_once "Controllers/SupInformesController.php";
require_once "Models/crud_sup_informes.php";
require_once "Models/crud_sup_visitas.php";

 require_once "Controllers/SupervisainformeController.php";
 require_once "Models/crud_sup_imagenes.php";
 require_once "Controllers/SupInformesMuesController.php";
 require_once "Models/crud_supmuestras.php";
 //require_once "Models/crud_imagenesDetalle.php";
 


require_once "Models/crud_clientes.php";
require_once "Models/crud_recolectores.php";
require_once "Models/crud_atributos.php";

require_once "Models/crud_listacompra.php";

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

require_once "Models/crud_sustitucion.php";
require_once "Models/crud_listacompradetalle.php";
require_once "Models/crud_ciudadresidencia.php";
require_once "Models/crud_causas.php";
require_once "Models/crud_Supvalidacion.php";
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
