<?php
//require_once '../../Models/conexion.php';
//require '../../Models/crud_informes.php';
//require '../../Models/crud_atributos.php';


//para devolver los ultimos ids en json


class IdsInfController{
    
    
  
    private $datosInf;
    private $recolector;
    private $indice;
    function __construct(){
        
        
        $this->datosInf=new DatosInforme();
    }
    
    public function getVisita(){
        
        try{
            $rs = $this->datosInf->getUltVisita($this->recolector,$this->indice, "visitas");
            
            return $rs;
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $ex){
            Utilerias::guardarError(" IdsInfController: Error al hacer consulta".$ex->getMessage());
            
        }
        
        
    }
    
    public function getInforme(){
        try{
            $rs = $this->datosInf->getUltInforme($this->recolector,$this->indice, "informes",$this->planta);
            
            
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $rs;
        }catch (Exception $ex){
            Utilerias::guardarError(" IdsInfController: Error al hacer consulta".$ex->getMessage());
            
        }
        
    }
    public function getImagen(){
        try{
            $rs = $this->datosInf->getUltImagenDet( $this->recolector,$this->indice,"imagen_detalle");
            
            return $rs;
        }catch (Exception $ex){
            Utilerias::guardarError(" IdsInfController: Error al hacer consulta".$ex->getMessage());
            
        }
        
    }
     //  public function response($recolector,$indice,$planta)
    public function response($recolector,$indice,$planta=null)
    {

        $this->recolector=$recolector;
        $this->indice=$indice;
        $this->planta=$planta;
        $response=array();
        if($planta!=null&&$planta>0)
        	  $response["informe"] = $this->getInforme();
        else{
        $response["visita"]= $this->getVisita();
         $response["imagen_detalle"] =  $this->getImagen();
     }
      
       
        
        return json_encode($response);
    }
}

  