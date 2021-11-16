<?php

namespace api;
include "../../Utilerias/utilerias.php";


use Exception;
use Utilerias;

error_reporting(E_ALL);
define ('RAIZ',getcwd());


class Subefotos{
    
    
    public $mensaje_exito="El archivo fue cargado exitosamente.";
    private $mesaje_error="El archivo  no es válido";
    private $mensaje_ya_existe="La imagen  ya existe";
    private $respuesta;
    private $archivo_grande="El archivo  excede el tamaño máximo";
    private $directorio_no_existe="No se encontró el directorio especificado";
    public function subirImagen() {
  
        foreach($_POST as $nombre_campo=>$valor){
            $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_POST, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
            
            eval($asignacion);
        }
      
       
        $ban = 0;
     //   $idusuario=null
        $contdes = 1; /* para los campos de descripcion */ // valida si hay archivo para ingresar
     //    guardarError(var_dump($_POST));
     //   var_dump($_POST);
       // var_dump($_FILES);
    //     die();
        
        try{
             $carpeta = "../../fotografias" . "/" . $indice ;
             $this->crearCarpeta($carpeta);
         //si traigo archivos
        if(isset($_FILES))
        foreach ( $_FILES as $imagen ) {
          
            if ($imagen ["size"] > 0) {
              
              
                $name = $imagen ["name"];
       
                if ($imagen ["error"] == UPLOAD_ERR_OK) {
            
                  $tmp_name = $imagen ["tmp_name"];
            
                  $uploadfile = $carpeta."/". basename ( $name );
                // echo "aqui".$name;
            if (! is_file ( $uploadfile )) {
                
                $tipo = $imagen ["type"];
                if ($tipo == 'image/gif' || $tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/x-png' || $tipo == 'image/pjpeg' || $tipo == 'application/octet-stream') {
                    //reviso el tamaño
                    $medidasimagen= getimagesize($imagen['tmp_name']);
                   
                    
                    //Si las imagenes tienen una resolución y un peso aceptable se suben tal cual
                    if($medidasimagen[0] < 1280 && $imagen['size'] < 110000){
                        try{
                            
                                if (move_uploaded_file ( $tmp_name, $uploadfile )) {
                                   
                                   //inserto en la bd
                                  //  $this->insertarInfo();
                                    
                                    // me regreso
                                    $this->respuesta[]=$name."-".$this->mensaje_exito;
                                    return true;
                                         // guardar en la bd
                                } else {
                                   
                                $this->respuesta[]=$name."-Error al cargar el archivo, intenta de nuevo";
                                                    $ban = 1;
                                                    return false;
                                                }
                              }catch(Exception $ex){
                                                Utilerias::guardarError(" error al subir imagen".$ex->getMessage());
                                       throw new \Exception("Error al guardar archivo");
                              }
                            }
                         else{ //comprimimos
                              //	echo $tmp_name."voy a comprimir";
                                            
                               Utilerias::comprimirImagen($name, $tmp_name, $tipo,  $carpeta );
                              // $this->insertarInfo();
                                            
                              $this->respuesta[]=$name."-".$this->mensaje_exito;
                                            // guardar en la bd
                                     return true;       
                                            
                              }
                     } else {
                         
                                        $this->respuesta[]=$name."-".$this->mesaje_error;
                                        $ban = 1;
                                    return false;
                                    }
               } else {
                      $this->respuesta[]=$name."-".$this->mensaje_ya_existe;
                      $ban = 1;
                      return true;
               }
                            } else if ($imagen ["error"] == UPLOAD_ERR_FORM_SIZE) {
                                $this->respuesta[]=$name."-".$this->archivo_grande;
                                $ban = 1;
                                return false;
                            } else if ($imagen ["error"] == UPLOAD_ERR_CANT_WRITE) {
                                $this->respuesta[]=$name."-".$this->directorio_no_existe;
                                $ban = 1;
                                return false;
                            }
                            $contdes ++;
                        } // termin
                        
                    }
                }catch(Exception $ex){
                    Utilerias::guardarError("eror al subir "+$ex->getTraceAsString());
                	echo json_encode(array("error"=>$ex->getMessage()));
                }
         
                 Utilerias::guardarError(json_encode($this->respuesta));
                echo json_encode($this->respuesta);
                  
                
    }
    public function crearCarpeta($ruta){
        echo "revisando carpeta".$ruta;
        if (! is_dir (  $ruta )) {
          
            try {
                    mkdir ( $ruta, 0777, true );
                } catch ( Exception $ex ) {
                    throw $ex;
                }
            } 
               
            
    }
   
    

    
    
    
}

  