<?php
class DatosGeocercas extends Conexion{
    public $catPuntos=[ 'C'=>"Centro",
    'N'=>"Norte",
    'S'=>"Sur",
    'E'=>"Este",
    'O'=>"Oeste"];
    //regresa las geocercas de una ciudad
    public function vistaGeocercaModel($geo_n4id,$tabla){
        
        $stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where geo_n4id=:geo_n4id");
        $stmt->bindParam(":geo_n4id", $geo_n4id,PDO::PARAM_INT);
           
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
 /*   public function vistaGeocercaModel($geo_n4id,$tabla){
        
        $stmt = Conexion::conectar()-> prepare("SELECT * FROM $tabla where geo_n4id=:geo_n4id");
        $stmt->bindParam(":geo_n4id", $geo_n4id,PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll();
        
    }*/
    
    
    
    public function insertarGeocerca($datosModel,$tabla){
        // var_dump($datosModel);
        try{
            
            $sSQL= " INSERT INTO $tabla
                (geo_n4id,geo_region, geo_p1, geo_p2, geo_p3, geo_p4)
                VALUES(:n4id,:region, :p1, :p2, :p3, :p4);";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":n4id", $datosModel["geo_n4id"],PDO::PARAM_INT);
            
            $stmt->bindParam(":region", $datosModel["geo_region"],PDO::PARAM_STR);
            $stmt->bindParam(":p1", $datosModel["geo_p1"],PDO::PARAM_STR);
            $stmt->bindParam(":p2", $datosModel["geo_p2"],PDO::PARAM_STR);
            $stmt->bindParam(":p3", $datosModel["geo_p3"],PDO::PARAM_STR);
          
            $stmt->bindParam(":p4", $datosModel["geo_p4"],PDO::PARAM_STR);
            
            $res= $stmt->execute();
          //$stmt->debugDumpParams();
          return $res;
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al insertar la geocerca");
        }
        
    }
    
    public function editaGeocercaModel($id, $tabla){
        $stmt = Conexion::conectar()-> prepare(" select * from $tabla
            WHERE geo_id=:id;");
        $stmt->bindParam(":id", $id,PDO::PARAM_INT);
        
        return $stmt->fetch();
    }
    
    public function actualizarGeocerca($datosModel,$tabla){
        try{
            
            $stmt = Conexion::conectar()-> prepare(" UPDATE $tabla
            SET geo_n4id=:geo_n4id, geo_region=:region,
geo_p1=:p1, geo_p2=:p2,
 geo_p3=:p3, geo_p4=:p4
            WHERE geo_id=:id;");
            $stmt->bindParam(":id", $datosModel["geo_id"],PDO::PARAM_INT);
            $stmt->bindParam(":n4id", $datosModel["geo_n4id"],PDO::PARAM_INT);
            
            $stmt->bindParam(":region", $datosModel["geo_region"],PDO::PARAM_STR);
            $stmt->bindParam(":p1", $datosModel["geo_p1"],PDO::PARAM_STR);
            $stmt->bindParam(":p2", $datosModel["geo_p2"],PDO::PARAM_STR);
            $stmt->bindParam(":p3", $datosModel["geo_p3"],PDO::PARAM_STR);
            
            $stmt->bindParam(":p4", $datosModel["geo_p4"],PDO::PARAM_STR);
           $res= $stmt-> execute();
           return $res;
           
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al insertar la geocerca");
        }
        
    }
    
    
    public function eliminarGeocerca($idGeocerca,$tabla){
        
        try{
            
            $sSQL= "DELETE FROM $tabla WHERE geo_id=:idGeocerca";
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":idGeocerca", $idGeocerca,PDO::PARAM_INT);
            
            $stmt-> execute();
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al eliminar la geocerca");
        }
        
    }
}	