<?php

class DatosUneImagenes{
    
    private $conexion;
        
    public function __construct(){
        $con=new Conexion();
        $this->conexion=$con->conectar();
    }
    public  function insertar($datosModel,$idtienda,$cverecolector,$indice,$tabla){
        
        try{
            $sSQL= " INSERT INTO $tabla
        ( ui_uneid, ui_clienteid, ui_tikindice, ui_tikrecolector, ui_ticket,
     ui_exindice, ui_exhibidor, ui_exrecolector)
     VALUES(  :ui_uneid, :ui_clienteid,:ui_tikindice, :ui_tikrecolector, :ui_ticket,
     :ui_exindice, :ui_exhibidor, :ui_exrecolector); ";
            
            $stmt=$this->conexion->prepare($sSQL);
            $stmt->bindParam(":ui_uneid", $idtienda, PDO::PARAM_INT);
            $stmt->bindParam(":ui_clienteid",   $datosModel[ContratoProductoEx::CLIENTESID], PDO::PARAM_INT);
            $stmt->bindParam(":ui_ticket",  $datosModel[ContratoInformes::TICKETCOMPRA], PDO::PARAM_STR);
            $stmt->bindParam(":ui_exhibidor",   $datosModel[ContratoProductoEx::IMAGENID], PDO::PARAM_STR);
            
            $stmt->bindParam(":ui_tikindice",  $datosModel[ContratoUneImagenes::TIKINDICE], PDO::PARAM_STR);
            $stmt->bindParam(":ui_tikrecolector",   $datosModel[ContratoUneImagenes::TIKRECOLECTOR], PDO::PARAM_INT);
            $stmt->bindParam(":ui_exindice",  $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ui_exrecolector",   $cverecolector, PDO::PARAM_INT);
            
            if(!$stmt->execute())
            { $stmt->debugDumpParams();
            var_dump($stmt->errorInfo());
            throw new Exception("Hubo un error al insertar uneimagenes ".$stmt->errorInfo()[1]);
            
            }
        
        }catch(PDOException $ex){
             Utilerias::guardarError("DatosUneImagenes.insertar "+$ex->getMessage());
        //  echo "error";
          
          throw new Exception("Hubo un error al insertar uneimagenes");
        }
        
        
       
    }
    public  function  getUneImagenxCli($uneid,$cliente,$tabla){
        
            
            $sSQL= "SELECT ui_id, ui_uneid,
    ui_clienteid, ui_tikindice,
    ui_tikrecolector, ui_ticket,
    ui_exindice, ui_exhibidor,
    ui_exrecolector FROM $tabla
 where ui_uneid=:ui_uneid and ui_clienteid=:ui_clienteid ;";
            
            $stmt=$this->conexion->prepare($sSQL);
            $stmt->bindParam(":ui_uneid", $uneid, PDO::PARAM_INT);
            $stmt->bindParam(":ui_clienteid", $cliente, PDO::PARAM_INT);
            
            $stmt->execute();
            //    $stmt->debugDumpParams();
            return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
            
            
    
    }
    public  function insertarTicket($datosModel,$idtienda,$cverecolector,$indice,$tabla){
        
        try{
            $sSQL= " INSERT INTO $tabla
        ( ui_uneid, ui_clienteid, ui_tikindice, ui_tikrecolector, ui_ticket)
     VALUES(  :ui_uneid, :ui_clienteid,:ui_tikindice, :ui_tikrecolector, :ui_ticket); ";
            
            $stmt=$this->conexion->prepare($sSQL);
            $stmt->bindParam(":ui_uneid", $idtienda, PDO::PARAM_INT);
            $stmt->bindParam(":ui_clienteid",   $datosModel[ContratoInformes::CLIENTESID], PDO::PARAM_INT);
            $stmt->bindParam(":ui_ticket",  $datosModel[ContratoInformes::TICKETCOMPRA], PDO::PARAM_STR);
            
            $stmt->bindParam(":ui_tikindice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ui_tikrecolector",   $cverecolector, PDO::PARAM_INT);
            
            if(!$stmt->execute())
            { $stmt->debugDumpParams();
            throw new Exception("Hubo un error al insertar uneimagenes ".$stmt->errorInfo()[1]);
            
            }
            
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosUneImagenes.insertar "+$ex->getMessage());
            //  echo "error";
            
            throw new Exception("Hubo un error al insertar uneimagenes");
        }
        
        
        
    }
    
    public  function actualizarTicket($datosModel,$idtienda,$cverecolector,$indice,$tabla){
        
        try{
            $sSQL= "UPDATE $tabla
 SET ui_tikindice=:ui_tikindice, ui_tikrecolector=:ui_tikrecolector, ui_ticket=:ui_ticket
 WHERE ui_uneid=:ui_uneid and ui_clienteid=:ui_clienteid ;
 ";
            
            $stmt=$this->conexion->prepare($sSQL);
            $stmt->bindParam(":ui_uneid", $idtienda, PDO::PARAM_INT);
            $stmt->bindParam(":ui_clienteid",   $datosModel[ContratoInformes::CLIENTESID], PDO::PARAM_INT);
            $stmt->bindParam(":ui_ticket",  $datosModel[ContratoInformes::TICKETCOMPRA], PDO::PARAM_STR);
             
            $stmt->bindParam(":ui_tikindice",  $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ui_tikrecolector", $cverecolector ,PDO::PARAM_INT);
            echo "**actualizando ticket";
            if(!$stmt->execute())
            { $stmt->debugDumpParams();
            throw new Exception("Hubo un error al actualizarTicket uneimagenes".$stmt->errorInfo()[0]);
            
            }
            $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosUneImagenes.actualizarTicket "+$ex->getMessage());
            echo "error";
            
            throw new Exception("Hubo un error al actualizar el uneimagenes");
        }
        
        
        
    }
}
