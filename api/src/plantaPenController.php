<?php
//require_once '../../Models/conexion.php';
//require '../../Models/crud_informes.php';
//require '../../Models/crud_atributos.php';


//para devolver los ultimos ids en json


class PlantaPenController{
    
    
  
    private $datosInf;
    private $recolector;
    private $siglas;
    function __construct(){
        
        
        $this->datosInf=new DatosInforme();
    }
    
    public function getPlantaPen(){
        
        try{
            $rs = $this->datosInf->getPlantaPen($this->siglas,$this->cliente, "visitas");
            
            return $rs;
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            Utilerias::guardarError(" IdsInfController: Error al hacer consulta".$ex->getMessage());
            
        }
        
        
    }
    
  
     //  public function response($recolector,$indice,$planta)
    public function response($recolector,$siglas,$cliente)
    {

        $this->recolector=$recolector;
        $this->siglas=$siglas;
        $this->cliente=$cliente;
       // $response=array();
      
        $response=$this->getPlantaPen();
     
 
       
       return $response; 
       // return json_encode($response);
    }
}

  