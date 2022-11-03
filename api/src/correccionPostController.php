<?php
error_reporting(E_ERROR);
ini_set("display_errors", 1);
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
            
        //TODO lo pongo en una transaccion
         //   var_dump($correccion);
        $resp= $this->datosCor->getCorreccionxid($indice,$cverecolector,$correccion[ContratoCorreccion::ID],$this->tabla);
        
       // die();
        if($resp!=null&&$resp[ContratoCorreccion::ID]==$correccion[ContratoCorreccion::ID]){
       
        //actualizo
        
            $this->datosCor->update($correccion, $cverecolector, $indice, $this->tabla);
        }else
         $this->datosCor->insertar($correccion,$cverecolector,$indice,$this->tabla);
       
        
        }catch(Exception $ex){
           // $ex->getTrace();
            throw new Exception($this->TAG." *Hubo un error al insertar ".$ex->getMessage());
           
        }
        
        
    }
    
    //se insertan pendientes es una lista
    public function insertarPend($lista){
        try{
            foreach($lista as $campos){
                $this->insertarTodo($campos);     
            }
            
        }catch(Exception $ex){
            throw new Exception($this->TAG."*Hubo un error al insertar ".$ex->getMessage());
           
        }
        
        
        
    }
  
  
}