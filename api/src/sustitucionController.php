<?php
//require_once '../../Models/conexion.php';
//require '../../Models/crud_catalogoDetalle.php';
//require '../../Models/crud_atributos.php';


//para devolver los catalogos
class SustitucionController{
    
    private $listaCatalogos; //para poner los catalogos que devuelvo
    private $resultCat;
    private $resultAtr;
    private $datosCatdet;
    private $datosInf;
    function __construct(){
        
        $this->datosInf=new DatosInforme();
    }
    
  
    public function getSustitucion(){
        $rs = $this->datosInf->getSustitucion( "ca_sustitucion");
        
        $resultAtr=array();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rs as $row) {
            
            $resultAtr[] = $row;
        }
        return $resultAtr;
    }
    
    public function response()
    {
        //$response=array();
      
        $response= $this->getSustitucion();
        
        
        return json_encode($response);
    }
}
