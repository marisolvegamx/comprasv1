<?php

//clase para manejar el json e insertarlo
class InformePostController{
    
    //se inserta por primera vez
    public function insertarTodo($campos){
        try{
        $visita=$campos["visita"];
        $informe=$campos["informe"];
        $informe_det=$campos["informe_detalle"]; //este es un array
        $fotos_ex=$campos["fotos_ex"]; //es array
        $imagenes_det=$campos["imagenes_det"]; //es array
        
        //TODO lo pongo en una transaccion
      //  $conexion=Conexion::conectar();
     
        DatosVisita::insertar($visita,"visitas");
        DatosProductoExhibido::insertar($fotos_ex,"producto_exhibido");
 
        
        DatosImagenDetalle::insertar($imagenes_det,"imagen_detalle");
      
        
        
        DatosInformeDetalle::insertar($informe_det,"informe_detalle");
        
      
        
        
        DatosInforme::insertar($informe,"informes");
        
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarVisita($campos){
        try{
            $visita=$campos["visita"];
         
            
            DatosVisita::insertar($visita,"visitas");
           
            
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarInforme($campos){
        try{
          
            $informe=$campos["informe"];
        
            //TODO lo pongo en una transaccion
            //  $conexion=Conexion::conectar();
            
            DatosInforme::insertar($informe,"informes");
            
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarInfDet($campos){
        try{
          
            $informe_det=$campos["informe_detalle"]; //este es un array
          
            DatosInformeDetalle::insertar($informe_det,"informe_detalle");
            
          
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarProdEx($campos){
        try{
         
            $fotos_ex=$campos["fotos_ex"]; //es array
          
           //  $conexion=Conexion::conectar();
            DatosProductoExhibido::insertar($fotos_ex,"producto_exhibido");
            
            
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarImagenes($campos){
        try{
        
            $imagenes_det=$campos["imagenes_det"]; //es array
            
            DatosImagenDetalle::insertar($imagenes_det,"imagen_detalle");
                  
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    
}