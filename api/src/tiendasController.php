<?php
require_once '../../Models/conexion.php';
require '../../Models/crud_unegocios.php';



//para devolver los catalogos en json
class TiendasController{
    
//para poner los catalogos que devuelvo
    
    private $result;
   
    public function getTiendas($pais,$ciudad, $cadenacomercial,$unedescripcion){
        
       
        $rs = DatosUnegocio::getUnegocioxFiltros($pais,$ciudad, $cadenacomercial,$unedescripcion);
            
            
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rs as $row) {
                
                $this->result[] = $row;
            }
        
    }
    
   
    
    public function response($pais,$ciudad, $cadenacomercial,$unedescripcion)
    {
     
        $this->getTiendas($pais,$ciudad, $cadenacomercial,$unedescripcion);
        return json_encode(array("tiendas"=>$this->result));
    }
}
