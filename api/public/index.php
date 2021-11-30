<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
include "../src/catalogosController.php";
include "../src/tiendasController.php";
include '../src/informePostController.php';
include '../src/Subirfotos.php';
include "../src/listaComController.php";
use api\Subefotos;
// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true
]];



$app = new \Slim\App($config);
$container = $app->getContainer();

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('comprasapilog');
    $file_handler = new \Monolog\Handler\StreamHandler('../../logs/comprasapi.log');
    $logger->pushHandler($file_handler);
    return $logger;
};
//echo "ssssss".$request->getMethod();
//echo "iuuuuuu".$request->getUri();
//echo "ssssss".$app->request->getMethod();
///echo "iuuuuuu".$app->request->getUri();

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
    $app->get('/listacompras', function ($request, $response, $args) {
        $cc=new listaComController();
        $recolector= filter_input(INPUT_GET, "usuario",FILTER_SANITIZE_STRING) ;
        $fechal= filter_input(INPUT_GET, "version_lista",FILTER_SANITIZE_STRING) ;
        $fechad= filter_input(INPUT_GET, "version_detalle",FILTER_SANITIZE_STRING) ;
        $indice= filter_input(INPUT_GET, "indice",FILTER_SANITIZE_STRING); 
        return $response->withHeader('Content-type', 'application/json')
        ->getBody()
        ->write( $cc->response($fechal,$recolector,$indice));
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
            $this->get('logger')->addInfo('CrearInforme: Llegó un informe '.$request->getBody());
            
            try {
               $informeContrl=new InformePostController();
               $informeContrl->insertarTodo($campos);
               
                $datos = array('status' => 'ok', 'data' => 'Informe dado de alta correctamente.');
                $this->get('logger')->addInfo('CrearInforme: Respuesta Informe dado de alta correctamente');
                return $response->withJson($datos, 200);
            } catch (Exception $e) {
                $datos = array('status' => 'error', 'data' => $e->getMessage());
                $this->get('logger')->addInfo('CrearInforme: hubo un error '.$e->getMessage());
                
                return $response->withJson($datos, 500);
            }
        }
        );
        $app->post('/informes/create', function(Request $request, Response $response)
        {
             // Si necesitamos acceder a alguna variable global en el framework
            // Tenemos que pasarla con use($variable) en la cabecera de la función.
            // Va a devolver un objeto JSON con los datos de usuarios.
            
            $campos = $request->getParsedBody();
            $this->get('logger')->addInfo('InforemesPend: Llegaron varios informes'.$request->getBody());
            
            try {
                $informeContrl=new InformePostController();
                $informeContrl->insertarPend($campos);
                
                $datos = array('status' => 'ok', 'data' => 'Informes guardados correctamente.');
                $this->get('logger')->addInfo('InforemesPend: Respuesta Informes guardados correctamente');
                return $response->withJson($datos, 200);
            } catch (Exception $e) {
                $datos = array('status' => 'error', 'data' => $e->getMessage());
                $this->get('logger')->addInfo('InforemesPend: hubo un error '.$e->getMessage());
                
                return $response->withJson($datos, 500);
            }
        }
        );
        $app->post('/imagenes', function(Request $request, Response $response)
        {
            // Si necesitamos acceder a alguna variable global en el framework
            // Tenemos que pasarla con use($variable) en la cabecera de la función.
            // Va a devolver un objeto JSON con los datos de usuarios.
            
            $campos = $request->getParsedBody();
            $this->get('logger')->addInfo('InforemesPend: Llegaron varios informes'.$request->getBody());
            
            try {
                $informeContrl=new InformePostController();
                $informeContrl->insertarPend($campos);
                
                $datos = array('status' => 'ok', 'data' => 'Informes guardados correctamente.');
                $this->get('logger')->addInfo('InforemesPend: Respuesta Informes guardados correctamente');
                return $response->withJson($datos, 200);
            } catch (Exception $e) {
                $datos = array('status' => 'error', 'data' => $e->getMessage());
                $this->get('logger')->addInfo('InforemesPend: hubo un error '.$e->getMessage());
                
                return $response->withJson($datos, 500);
            }
        }
        );
        
        $app->post('/subirfoto', function(Request $request, Response $response)
        {
            
            
          
              echo "aqui";
          
            $this->get('logger')->addInfo('SubirFoto: Llegó una foto '.$request->getBody());
            
            try {
                $file=$request->getQueryParam("file");
                $va1=new Subefotos();
                $res=$va1->subirImagen();
                echo "resss".$res;
                if($res){
                    $datos = array('status' => 'ok', 'data' => 'Imagen guardada.');
                    $this->get('logger')->addInfo('SubirFoto: Respuesta imagen guardada');
                    return $response->withJson($datos, 200);
                    
                    
                }
                else
                {
                    $datos = array('status' => 'error', 'data' => $e->getMessage());
                    $this->get('logger')->addInfo('SubirFoto: hubo un error '.$e->getMessage());
                    return $response->withJson($datos, 500);
                }
           
               
            } catch (Exception $e) {
                $datos = array('status' => 'error', 'data' => $e->getMessage());
                $this->get('logger')->addInfo('SubirFoto: hubo un error '.$e->getMessage());
                
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
