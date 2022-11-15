<?php

namespace api;



use Exception;
use Utilerias;


 //recibe un archivo txt con la bitacora de la app, loguarda con id del recolector y fecha de envio

class Subelog{
    
    
    public $mensaje_exito="El archivo fue cargado exitosamente.";
    private $mesaje_error="El archivo  no es válido";
    private $respuesta;
    private $directorio_no_existe="No se encontró el directorio especificado";
    public function subirLog() {
  
        foreach($_POST as $nombre_campo=>$valor){
            $asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_POST, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
            
            eval($asignacion);
        }
      
       
        $ban = 0;
     //   $idusuario=null
          //    guardarError(var_dump($_POST));
       // var_dump($_POST);
        //var_dump($_FILES);
    //     die();
       
        try{
            $carpeta = "../../logs/usuarios";
             $this->crearCarpeta($carpeta);
         //si traigo archivos
            if(isset($_FILES))
            foreach ( $_FILES as $arch ) {
              
                if ($arch ["size"] > 0) {
                  
                    $fecvis=date("Ymd_His");
                    $name = $usuario."_".$fecvis.".txt";
       
                if ($arch ["error"] == UPLOAD_ERR_OK) {
            
                  $tmp_name = $arch ["tmp_name"];
            
                  $uploadfile = $carpeta."/". basename ( $name );
                 // echo "aqui".$uploadfile."--".$tmp_name;
                  Utilerias::guardarError("aqui".$name);
            
                
                $tipo = $arch ["type"];
                if ($tipo == 'text/plain') {
                    //reviso el tamaño
                   
                   
                    
                   if (move_uploaded_file ( $tmp_name, $uploadfile )) {
                                   
                                 
                                    // me regreso
                       $this->respuesta[]=$name."-".$this->mensaje_exito;
                      return true;
                                         // guardar en la bd
                   } else {
                                  
                       Utilerias::guardarError($name."-Error al cargar el archivo");
                                    
                       $this->respuesta[]=$name."-Error al cargar el archivo, intenta de nuevo  ".$arch["error"];;
                        $ban = 1;
                       return false;
                  }
                    
              } else {
                         
                  $this->respuesta[]=$name."-".$this->mesaje_error;
                                        $ban = 1;
                                    return false;
                                    }
             
           } else if ($arch ["error"] == UPLOAD_ERR_FORM_SIZE) {
                                Utilerias::guardarError($name."-".$this->archivo_grande);
                                $this->respuesta[]=$name."-".$this->archivo_grande;
                                $ban = 1;
                                return false;
                            } else if ($arch ["error"] == UPLOAD_ERR_CANT_WRITE) {
                                Utilerias::guardarError($name."-".$this->directorio_no_existe);
                                
                                $this->respuesta[]=$name."-".$this->directorio_no_existe;
                                $ban = 1;
                                return false;
                            }
                           
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
        // echo "revisando carpeta".$ruta;
        Utilerias::guardarError("revisando carpeta".$ruta);
        if (! is_dir (  $ruta )) {
            
            try {
                Utilerias::guardarError("no existe... creando");
                mkdir ( $ruta, 0777, true );
            } catch ( Exception $ex ) {
                throw $ex;
            }
        }
        
        
    }
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    
    
    
}

  