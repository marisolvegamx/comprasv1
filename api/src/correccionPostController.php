<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
require '../../Models/crud_supcorrecciones.php';


//clase para manejar el json e insertarlo
class CorreccionPostController{
    private $datosCor;
    private $TAG="CorreccionPostController";
    private $tabla="sup_correccion";
    public function __construct(){
        $this->datosCor= new DatosCorreccion();
    }
    //se inserta por primera vez
    public function insertarTodo($campos){
       
        try{
            $correccion=$campos["correccion"]; //es array
         
            $cverecolector=$campos[ContratoVisitas::CVEUSUARIO];
            $indice=$campos[ContratoVisitas::INDICE];
            //   $imagenes_det=$campos["imagenDetalles"]; //es array
          
           // var_dump($correccion);
        $resp= $this->datosCor->getCorreccionxid($indice,$cverecolector,$correccion[ContratoCorreccion::ID],$this->tabla);
      
       // die();
        if($resp!=null&&$resp["cor_id"]==$correccion[ContratoCorreccion::ID]){
       
        //actualizo
            //veo el estatus que no esté revisada
            $resp2=$this->LeeIdvalidafoto($correccion[ContratoCorreccion::VALID],$correccion[ContratoCorreccion::NUMFOTO],"sup_validafotos");
          // var_dump($resp2);
            if($resp2!=null&&$resp2[0]["vai_estatus"]==2||$resp2[0]["vai_estatus"]==3)
                $this->datosCor->update($correccion, $cverecolector, $indice, $this->tabla);
        }else
             $this->datosCor->insertar($correccion,$cverecolector,$indice,$this->tabla);
       //actualizo estatus de la solicitud
         $datosController= array("idval"=>$correccion[ContratoCorreccion::VALID],
             "idimg"=>$correccion[ContratoCorreccion::NUMFOTO],
             "est"=>4
          );
         // var_dump($idval);
         //  var_dump($datosController);
         $ex= $this->actualizaValidacionimg($datosController, "sup_validafotos");
         
         
        
        }catch(Exception $ex){
           // $ex->getTrace();
            throw new Exception($this->TAG." *Hubo un error al insertar ".$ex->getMessage());
           
        }
        
        
    }
    
    //se insertan pendientes es una lista
    public function insertarPend($campos){
        try{
           
            $lista=$campos["correcciones"]; //es array
            $cverecolector=$campos[ContratoVisitas::CVEUSUARIO];
            $indice=$campos[ContratoVisitas::INDICE];
            //   $imagenes_det=$campos["imagenDetalles"]; //es array
        
            foreach($lista as $correccion){
                $resp= $this->datosCor->getCorreccionxid($indice,$cverecolector,$correccion[ContratoCorreccion::ID],$this->tabla);
                
                // die();
                if($resp!=null&&$resp["cor_id"]==$correccion[ContratoCorreccion::ID]){
                    
                    //actualizo
                    //veo el estatus que no esté revisada
                    $resp2=$this->LeeIdvalidafoto($correccion[ContratoCorreccion::VALID],$correccion[ContratoCorreccion::NUMFOTO],"sup_validafotos");
                    // var_dump($resp2);
                    if($resp2!=null&&$resp2[0]["vai_estatus"]==2||$resp2[0]["vai_estatus"]==3)
                        $this->datosCor->update($correccion, $cverecolector, $indice, $this->tabla);
                }else
                    $this->datosCor->insertar($correccion,$cverecolector,$indice,$this->tabla);
                    //actualizo estatus de la solicitud
                    $datosController= array("idval"=>$correccion[ContratoCorreccion::VALID],
                        "idimg"=>$correccion[ContratoCorreccion::NUMFOTO],
                        "est"=>4
                    );
                    // var_dump($idval);
                    //  var_dump($datosController);
                    $ex= $this->actualizaValidacionimg($datosController, "sup_validafotos");
                    
            }
            // var_dump($correccion);
          
                
      
        
          
            
        }catch(Exception $ex){
            throw new Exception($this->TAG."*Hubo un error al insertar ".$ex->getMessage());
           
        }
        
        
        
    }
    
    public function LeeIdvalidafoto($idval, $idimg, $tabla){
        
        // busca el id de validacion
        $stmt = Conexion::conectar()-> prepare("SELECT * FROM `sup_validafotos` where vai_id=:idval and vai_numfoto=:idimg;");
        
        $stmt->bindParam(":idval", $idval, PDO::PARAM_INT);
        $stmt->bindParam(":idimg", $idimg, PDO::PARAM_INT);
        $stmt-> execute();
     //   $stmt->debugDumpParams();
        return $stmt->fetchall();
        
    }
    
    
    public function actualizaValidacionimg($datosModel, $tabla){
        try {
            // busca el id de validacion
            $stmt = Conexion::conectar()-> prepare("UPDATE $tabla SET `vai_estatus`=:estatus WHERE `vai_id`=:idval and `vai_numfoto`=:numimg");
            
            $stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
            $stmt->bindParam(":estatus", $datosModel["est"], PDO::PARAM_INT);
            $stmt->bindParam(":numimg", $datosModel["idimg"], PDO::PARAM_INT);
            
            $stmt-> execute();
            return "success";
        } catch (Exception $ex) {
            
            return "error";
        }
    }
    
    
  
  
}