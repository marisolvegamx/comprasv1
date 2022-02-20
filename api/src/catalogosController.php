<?php
require_once '../../Models/conexion.php';
require '../../Models/crud_catalogoDetalle.php';
//require '../../Models/crud_atributos.php';


//para devolver los catalogos
class CatalogosController{
    
    private $listaCatalogos; //para poner los catalogos que devuelvo
    private $resultCat;
    private $resultAtr;
    private $datosCatdet;
    private $datosInf;
    function __construct(){
        
        $this->listaCatalogos=[2=>"TIPO DE TIENDA",8=>"UBICACION DE LA MUESTRA",
            15=>"TIPO DE MUESTRA"
        ];
        $this->datosCatdet=new DatosCatalogoDetalle();
        $this->datosInf=new DatosInforme();
    }
    
    public function getCatalogos(){
        
        foreach ($this->listaCatalogos as $key=>$catalogo)
        {
            //echo "*****".$key;
            $rs = $this->datosCatdet->listaCatalogo($key, "ca_catalogosdetalle");
            
            
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rs as $row) {
                
                $this->resultCat[] = $row;
            }
        }
    }
    
    public function getAtributos(){
        $rs = $this->datosInf->getAtributos( "ca_atributo");
        
        
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rs as $row) {
            
            $this->resultAtr[] = $row;
        }
    }
    public function getCausas(){
        $rs = $this->datosInf->getCausas( "ca_causas");
        
        $resultAtr=array();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rs as $row) {
            
            $resultAtr[] = $row;
        }
        return $resultAtr;
    }
    
  
    
    public function response()
    {
        $response=array();
        $this->getCatalogos();
        $this->getAtributos();
        
        $response["catalogos"]= $this->resultCat;
        $response["atributos"] = $this->resultAtr;
        $response["causas"] =  $this->getCausas();
        
        
        return json_encode($response);
    }
}
