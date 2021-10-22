<?php
require_once '../../Models/conexion.php';
require '../../Models/crud_catalogoDetalle.php';
require '../../Models/crud_atributos.php';


//para devolver los catalogos en json
class CatalogosController{
    
    private $listaCatalogos; //para poner los catalogos que devuelvo
    private $resultCat;
    private $resultAtr;
    function __construct(){
        
        $this->listaCatalogos=[2=>"TIPO DE TIENDA",8=>"UBICACION DE LA MUESTRA",
            15=>"TIPO DE MUESTRA"
        ];
        
        
    }
    
    public function getCatalogos(){
        
        foreach ($this->listaCatalogos as $key=>$catalogo)
        {
            //echo "*****".$key;
            $rs = DatosCatalogoDetalle::listaCatalogo($key, "ca_catalogosdetalle");
            
        
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($rs as $row) {
            
                $this->resultCat[] = $row;
            }
        }
    }
    
    public function getAtributos(){
        $rs = DatosAtrib::getAtributos( "ca_atributo");
        
        
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($rs as $row) {
            
            $this->resultAtr[] = $row;
        }
    }
    
    public function response()
    {
        $response=array();
        $this->getCatalogos();
        $this->getAtributos();
        $response["catalogos"]= $this->resultCat;
        $response["atributos"] = $this->resultAtr;
        
    
        return json_encode($response);
    }
}
  