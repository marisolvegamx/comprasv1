<?php


class DatosVisita{
    
    private $conexion;
    public function __construct(){
        $con=new Conexion();
        $this->conexion=$con->conectar();
    }
    public  function getVisitas($INDICE,$CVEUSUARIO,$tabla){
       
            
            $sSQL= " SELECT  vi_indice indice, vi_idlocal id,
 vi_geolocalizacion as geolocalizacion, vi_tiendaid as tiendaId,
 vi_fotofachada fotoFachada,
vi_estatus estatus, vi_cverecolector claveUsuario,
 vi_createdat createdAt, vi_updatedat updatedAt,
vi_direccion direccion ,
cu.une_cadenacomercial cadenaComercial ,vi_complementodir complementodireccion,
cu.une_puntocardinal puntoCardinal,
cu.une_cla_ciudad ciudadId, '' ciudad,une_descripcion as tiendaNombre,
une_tipotienda tipoId,cad_descripcionesp tipoTienda, '2' as estatusSync
FROM $tabla inner join ca_unegocios cu
 on vi_tiendaid =cu.une_id
left join ca_catalogosdetalle on  une_tipotienda=cad_idopcion and cad_idcatalogo=2
where vi_indice=:vi_indice and vi_cverecolector=:vi_cverecolector;";
            
            $stmt=$this->conexion->prepare($sSQL);
            $stmt->bindParam(":vi_indice", $INDICE, PDO::PARAM_STR);
            
            $stmt->bindParam(":vi_cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
            
           $stmt-> execute();
           //$stmt->debugDumpParams();
           return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
            
        
    }
    public static function insertar($datosModel,$tabla,$pdo){
        try{
            
            $sSQL= " INSERT INTO $tabla
( vi_idlocal, vi_indice,vi_geolocalizacion, vi_direccion,vi_complementodir,vi_tiendaid, vi_fotofachada,
 vi_estatus, vi_cverecolector, vi_createdat, vi_updatedat, vi_unedesc, vi_tipotienda,vi_puntocardinal)
VALUES( :vi_idlocal, :vi_indice,:vi_geolocalizacion,:vi_direccion,:vi_complementodir, :vi_tiendaid, :vi_fotofachada,
 :vi_estatus, :vi_cverecolector, :vi_createdat, :vi_updatedat,:vi_unedesc, :vi_tipotienda,:vi_puntocardinal);";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":vi_idlocal", $datosModel[ContratoVisitas::ID],PDO::PARAM_INT);
            $stmt->bindParam(":vi_indice", $datosModel[ContratoVisitas::INDICE], PDO::PARAM_STR);
            
            $stmt->bindParam(":vi_geolocalizacion", $datosModel[ContratoVisitas::GEOLOCALIZACION], PDO::PARAM_STR);
            $stmt->bindParam(":vi_direccion", $datosModel[ContratoVisitas::DIRECCION], PDO::PARAM_STR);
            $stmt->bindParam(":vi_complementodir", $datosModel[ContratoVisitas::COMPLEMENTODIR], PDO::PARAM_STR);
            $stmt->bindParam(":vi_tiendaid", $datosModel[ContratoVisitas::TIENDAID], PDO::PARAM_INT);
            $stmt->bindParam(":vi_fotofachada", $datosModel[ContratoVisitas::FOTOFACHADA], PDO::PARAM_INT);
            $stmt->bindParam(":vi_unedesc", $datosModel[ContratoVisitas::TIENDANOMBRE], PDO::PARAM_STR);
            $stmt->bindParam(":vi_tipotienda", $datosModel[ContratoVisitas::TIPOTIENDAID], PDO::PARAM_INT);
           
            $stmt->bindParam(":vi_estatus", $datosModel[ContratoVisitas::ESTATUS], PDO::PARAM_INT);
            $stmt->bindParam(":vi_cverecolector",  $datosModel[ContratoVisitas::CVEUSUARIO], PDO::PARAM_STR);
            $stmt->bindParam(":vi_createdat",  $datosModel[ContratoVisitas::CREATEDAT], PDO::PARAM_STR);
            $stmt->bindParam(":vi_updatedat", $datosModel[ContratoVisitas::UPDATEDAT], PDO::PARAM_STR);
            $stmt->bindParam(":vi_puntocardinal", $datosModel[ContratoVisitas::PUNTOCARDINAL], PDO::PARAM_STR);
            
           if(!$stmt-> execute())
           { $stmt->debugDumpParams();
               throw new Exception("Hubo un error al insertar visita".$stmt->errorInfo()[0]);
             
           }
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosVisita.insertar "+$ex->getMessage());
            echo "error";
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
    public static function actualizar($datosModel,$idtienda,$tabla,$pdo){
        try{
            
            $sSQL= " UPDATE $tabla
SET  vi_geolocalizacion=:geo, vi_tiendaid=:tienda,
 vi_fotofachada=:fotofac,   vi_createdat=:fcreated,
 vi_updatedat=:fupdated,
vi_direccion=:direccion,
vi_complementodir=:vi_complementodir
WHERE vi_idlocal=:idlocal and  vi_indice=:indice and vi_cverecolector=:reco;";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":idlocal", $datosModel[ContratoVisitas::ID],PDO::PARAM_INT);
            $stmt->bindParam(":indice", $datosModel[ContratoVisitas::INDICE], PDO::PARAM_STR);
            $stmt->bindParam(":geo", $datosModel[ContratoVisitas::GEOLOCALIZACION], PDO::PARAM_STR);
            $stmt->bindParam(":tienda", $idtienda, PDO::PARAM_INT);
           
            $stmt->bindParam(":fotofac", $datosModel[ContratoVisitas::FOTOFACHADA], PDO::PARAM_INT);
            $stmt->bindParam(":reco",  $datosModel[ContratoVisitas::CVEUSUARIO], PDO::PARAM_STR);
            $stmt->bindParam(":fcreated",  $datosModel[ContratoVisitas::CREATEDAT], PDO::PARAM_STR);
            $stmt->bindParam(":fupdated", $datosModel[ContratoVisitas::UPDATEDAT], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datosModel[ContratoVisitas::DIRECCION], PDO::PARAM_STR);
            $stmt->bindParam(":vi_complementodir", $datosModel[ContratoVisitas::COMPLEMENTODIR], PDO::PARAM_STR);
            
            if(!$stmt-> execute())
                throw new Exception("Hubo un error al actualizar ".$stmt->errorInfo()[2]);
              //   $stmt->debugDumpParams();
                
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosVisita.actualizar "+$ex->getMessage());
            
            
            throw new Exception("Hubo un error al actualizar el informe");
        }
        
    }
    
    public  function getVisita($visid,$indice,$recolector,$tabla){
        
        
        
        $sSQL= " SELECT  vi_indice , vi_idlocal ,
 vi_geolocalizacion , vi_tiendaid ,
 vi_fotofachada ,
vi_estatus , vi_cverecolector ,
 vi_createdat , vi_updatedat ,
vi_direccion 
FROM $tabla
where vi_indice=:vi_indice and vi_cverecolector=:vi_cverecolector and vi_idlocal=:vi_id;";
        
        $stmt=$this->conexion->prepare($sSQL);
        $stmt->bindParam(":vi_id", $visid, PDO::PARAM_INT);
        
        $stmt->bindParam(":vi_indice", $indice, PDO::PARAM_STR);
        
        $stmt->bindParam(":vi_cverecolector",  $recolector, PDO::PARAM_INT);
        
        $stmt-> execute();
        //    $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
        
    }
    
    public  function actualizardir($ID,$INDICE,$CVEUSUARIO,$DIRECCION,$tabla){
        try{
            
            $sSQL= " UPDATE $tabla
SET  
vi_direccion=:direccion
WHERE vi_idlocal=:idlocal and  vi_indice=:indice and vi_cverecolector=:reco;";
            
            $stmt=$this->conexion->prepare($sSQL);
            $stmt->bindParam(":idlocal", $ID,PDO::PARAM_INT);
            $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
            $stmt->bindParam(":reco",  $CVEUSUARIO, PDO::PARAM_STR);
             $stmt->bindParam(":direccion", $DIRECCION, PDO::PARAM_STR);
             if(!$stmt-> execute())
                throw new Exception("Hubo un error al actualizar ".$stmt->errorInfo()[2]);
                //   $stmt->debugDumpParams();
                
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosVisita.actualizarDir "+$ex->getMessage());
            
            
            throw new Exception("Hubo un error al actualizar dir del informe");
        }
        
    }
}