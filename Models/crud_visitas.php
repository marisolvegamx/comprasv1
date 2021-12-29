<?php


class DatosVisita{
    
    private $conexion;
    public function __construct(){
        $this->conexion=new Conexion();
    }
    
    public static function insertar($datosModel,$tabla,$pdo){
        try{
            
            $sSQL= " INSERT INTO $tabla
( vi_idlocal, vi_indice,vi_geolocalizacion, vi_tiendaid, vi_fotofachada,
 vi_estatus, vi_cverecolector, vi_createdat, vi_updatedat)
VALUES( :vi_idlocal, :vi_indice,:vi_geolocalizacion, :vi_tiendaid, :vi_fotofachada,
 :vi_estatus, :vi_cverecolector, :vi_createdat, :vi_updatedat);";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":vi_idlocal", $datosModel[ContratoVisitas::ID],PDO::PARAM_INT);
            $stmt->bindParam(":vi_indice", $datosModel[ContratoVisitas::INDICE], PDO::PARAM_STR);
            
            $stmt->bindParam(":vi_geolocalizacion", $datosModel[ContratoVisitas::GEOLOCALIZACION], PDO::PARAM_STR);
            $stmt->bindParam(":vi_tiendaid", $datosModel[ContratoVisitas::TIENDAID], PDO::PARAM_INT);
            $stmt->bindParam(":vi_fotofachada", $datosModel[ContratoVisitas::FOTOFACHADA], PDO::PARAM_INT);
           
            $stmt->bindParam(":vi_estatus", $datosModel[ContratoVisitas::ESTATUS], PDO::PARAM_INT);
            $stmt->bindParam(":vi_cverecolector",  $datosModel[ContratoVisitas::CVEUSUARIO], PDO::PARAM_STR);
            $stmt->bindParam(":vi_createdat",  $datosModel[ContratoVisitas::CREATEDAT], PDO::PARAM_STR);
            $stmt->bindParam(":vi_updatedat", $datosModel[ContratoVisitas::UPDATEDAT], PDO::PARAM_STR);
            
           if(!$stmt-> execute())
               throw new Exception("Hubo un error al insertar ".$stmt->errorInfo());
            //echo $stmt->debugDumpParams();
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosVisita.insertar "+$ex->getMessage());
           
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
    public static function actualizar($datosModel,$idtienda,$tabla,$pdo){
        try{
            
            $sSQL= " UPDATE $tabla
SET vi_indice=:indice,  vi_geolocalizacion=:geo, vi_tiendaid=:tienda,
 vi_fotofachada=:fotofac,  vi_cverecolector=:reco, vi_createdat=:fcreated,
 vi_updatedat=:fupdated
WHERE vi_idlocal=:idlocal;";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":idlocal", $datosModel[ContratoVisitas::ID],PDO::PARAM_INT);
            $stmt->bindParam(":indice", $datosModel[ContratoVisitas::INDICE], PDO::PARAM_STR);
            $stmt->bindParam(":geo", $datosModel[ContratoVisitas::GEOLOCALIZACION], PDO::PARAM_STR);
            $stmt->bindParam(":tienda", $idtienda, PDO::PARAM_INT);
           
            $stmt->bindParam(":fotofac", $datosModel[ContratoVisitas::FOTOFACHADA], PDO::PARAM_INT);
            $stmt->bindParam(":reco",  $datosModel[ContratoVisitas::CVEUSUARIO], PDO::PARAM_STR);
            $stmt->bindParam(":fcreated",  $datosModel[ContratoVisitas::CREATEDAT], PDO::PARAM_STR);
            $stmt->bindParam(":fupdated", $datosModel[ContratoVisitas::UPDATEDAT], PDO::PARAM_STR);
            
            if(!$stmt-> execute())
                throw new Exception("Hubo un error al actualizar ".$stmt->errorInfo()[2]);
                //echo $stmt->debugDumpParams();
                
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosVisita.actualizar "+$ex->getMessage());
            
            
            throw new Exception("Hubo un error al actualizar el informe");
        }
        
    }
    
}