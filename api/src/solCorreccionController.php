<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);


require_once '../../Models/crud_supvalfotos.php';

//para devolver los datos en json
class solCorreccionController{
    
   
    private $listasolicitudesi;
   
    private $listasolicitudesu;
   
    private $datosInf;
    private $fechaini="";
    private $fechafin="";
 
   
    function __construct(){
        
       $this->listasolicitudesi=array();
       $this->listasolicitudesu=array();
     
       
    //    $this->datosListaCom=new DatosListaCompra();
        $this->datosInf=new DatosValFotos();
    }
    
    public function getNuevos($indice,$recolector, $etapa){
        
       
        $rs = $this->datosInf->getValidacionFotos($indice,$recolector, $etapa,1, "sup_validacion");
          // var_dump($rs);
         //  die();
      
            
        $this->listasolicitudesi=$rs;
       
        
       
        
    }
   
    
    public function getUpdate($indice,$recolector, $etapa){
        
       
    }
    
    public function response($indice,$recolector, $etapa)
    {
        $response=array();
        $this->getNuevos($indice,$recolector, $etapa);
       // $this->getUpdate($fecha, $recolector,$indice);
        if(sizeof($this->listasolicitudesi)>0)
        { $response["inserts"]=$this->listasolicitudesi;
       
        }else 
        {
            $response = array('status' => 'error', 'data' => "ya está actualizado");
        }
        
        
        return json_encode($response);
    }
    
}

