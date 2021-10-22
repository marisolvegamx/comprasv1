<?php
error_reporting(E_ERROR|E_NOTICE|E_WARNING);
ini_set("display_errors", 1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
include "../src/catalogosController.php";
include "../src/tiendasController.php";
// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true
]];


$app = new \Slim\App($config);
$container = $app->getContainer();

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};
// Define app routes
$app->get('/', function ($request, $response, $args) {
    return $response->write("Hello ");
});
$app->get('/catalogos', function ($request, $response, $args) {
    $cc=new CatalogosController();
   
    return $response->withHeader('Content-type', 'application/json')
    ->getBody()
    ->write( $cc->response());
});
    $app->get('/tiendas', function ($request, $response, $args) {
        $cc=new TiendasController();
      
        $pais= filter_input(INPUT_GET, "pais",FILTER_SANITIZE_STRING) ;
        $ciudad= filter_input(INPUT_GET, "ciudad",FILTER_SANITIZE_STRING) ;
        $nombre= filter_input(INPUT_GET, "nombre",FILTER_SANITIZE_STRING); 
        $cadena= filter_input(INPUT_GET, "cadena",FILTER_SANITIZE_STRING); 
        return $response->withHeader('Content-type', 'application/json')
        ->getBody()
        ->write( $cc->response($pais,$ciudad,$cadena,$nombre));
    });
        $app->post('/informe/create', function(Request $request, Response $response)
        {
         
            
            // Si necesitamos acceder a alguna variable global en el framework
            // Tenemos que pasarla con use($variable) en la cabecera de la función.
            // Va a devolver un objeto JSON con los datos de usuarios.
            
            $campos = $request->getParsedBody();
            
            try {
               $informeContrl=new InformePostController();
               $informeContrl->insertar($campos);
               
                $datos = array('status' => 'ok', 'data' => 'Informe dado de alta correctamente.');
                return $response->withJson($datos, 200);
            } catch (Exception $e) {
                $datos = array('status' => 'error', 'data' => $e->getMessage());
                return $response->withJson($datos, 500);
            }
        }
        );

    //$this->logger->addInfo('Something interesting happened');
//para grupos
 /*   $app->group('/user/', function () {
        
        $this->get('test', function ($req, $res, $args) {
            return $res->getBody()
            ->write('Hello Users');
        });
            
    });*/
// Run app
$app->run();
