<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);


require_once '../../Models/crud_supvalfotos.php';

//para devolver los datos en json
class solCorreccionController{
    
   
    private $listasolicitudesi;
   
    private $listasolicitudesu;
    private $listacanceladas;
   
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
    public function getCanceladas($indice,$recolector){
        
        
        $rs = $this->datosInf->getMuestrasCanceladas($indice,$recolector, 2);
       //  var_dump($rs);
        //  die();
        $this->listacanceladas=$rs;
        //actualizo el estatus a leido
        foreach ($this->listacanceladas as $muestra){
            DatosInformeDetalle::actualizarEstatus($muestra["ind_id"], $recolector, $indice, 4, "informe_detalle");
            
        }
     
    }
   
    
    public function getUpdate($indice,$recolector, $etapa){
        
       
    }
    
    public function response($indice,$recolector, $etapa)
    {
        $response=array();
        $this->getNuevos($indice,$recolector, $etapa);
        
       // $this->getUpdate($fecha, $recolector,$indice);
       $this->getCanceladas($indice, $recolector,2);
        if(sizeof($this->listasolicitudesi)>0||sizeof($this->listacanceladas)>0)
        { 
            $response["inserts"]=$this->listasolicitudesi;
            $response["canceladas"]=$this->listacanceladas;
       
        }else 
        {
            $response = array('status' => 'error', 'data' => "ya está actualizado");
        }
        
        
        return json_encode($response);
    }
    
    
    
}

