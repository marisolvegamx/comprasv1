<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
require_once '../../Models/conexion.php';
require '../../Models/crud_visitas.php';
require '../../Models/crud_informes.php';
require '../../Models/crud_informesDetalle.php';
require '../../Models/crud_productoExhibido.php';
require '../../Models/crud_imagenesDetalle.php';
//require '../../Models/crud_unegocios.php';
require 'contratoapp.php';
//clase para manejar el json e insertarlo
class InformePostController{
    private $datosInf;
    
    public function __construct(){
        $this->datosInf= new DatosInforme();
    }
    //se inserta por primera vez
    public function insertarTodo($campos){
        $pdo=Conexion::conectar();
        try{
        $visita=$campos["visita"];
        $informe=$campos["informeCompra"];
        $informe_det=$campos["informeCompraDetalles"]; //este es un array
        $fotos_ex=$campos["productosEx"]; //es array
        $imagenes_det=$campos["imagenDetalles"]; //es array
        $cverecolector=$visita[ContratoVisitas::CVEUSUARIO];
        $indice=$visita[ContratoVisitas::INDICE];
      
        //TODO lo pongo en una transaccion
       
        $pdo->beginTransaction();
   
        DatosVisita::insertar($visita,"visitas",$pdo);
       foreach ($fotos_ex as $lisfotos_ex)
           DatosProductoExhibido::insertar($lisfotos_ex,$cverecolector,$indice,"producto_exhibido",$pdo);
        
      //  echo "insertar imagenes";
       
        foreach ($imagenes_det as $imagen)
            DatosImagenDetalle::insertar($imagen,$cverecolector,$indice,"imagen_detalle",$pdo);
        $datosInfdet=new DatosInformeDetalle();
        
      
        foreach ($informe_det as $detalle)
            $datosInfdet->insertar($detalle,$cverecolector,$indice,"informe_detalle",$pdo);
        
           
           
        
            $this->datosInf->insertar($informe,$cverecolector,$indice,"informes",$pdo);
       // echo "rrrrrrrrrr".$visita[ContratoVisitas::TIENDAID];
        //reviso si es una tienda nueva para insertarla
        if($visita[ContratoVisitas::TIENDAID]==null||$visita[ContratoVisitas::TIENDAID]==0){
        //      echo "estoy aqui"; 
                //es tienda nueva
            $datostienda=$this->tiendaNueva($visita);
          
            $idtienda=$this->datosInf->insertarUnegocio($datostienda, "ca_unegocios",$pdo);
         
          //  echo "estoy aqui"; 
                //actualizo en la visita
            DatosVisita::actualizar($visita, $idtienda, "visitas",$pdo);
            
            
        }
        $pdo->commit();
        
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar ".$ex->getMessage());
            $pdo->rollBack();
        }
        
        
    }
    
    //se inserta por primera vez
    public function insertarPend($campos){
        try{
            
            $lisvisita=$campos["visita"]; //es array
            $lisinforme=$campos["informeCompra"]; //es array
            $lisinforme_det=$campos["informeCompraDetalles"]; //este es un array
            $lisfotos_ex=$campos["productosEx"]; //es array
            $cverecolector=$campos[ContratoVisitas::INDICE];
            $indice=$campos[ContratoVisitas::INDICE];
         //   $imagenes_det=$campos["imagenDetalles"]; //es array
          
         
            //TODO lo pongo en una transaccion
            //  $conexion=Conexion::conectar();
            foreach ($lisvisita as $visita){
                DatosVisita::insertar($visita,"visitas");
               
            }
            foreach ($lisfotos_ex as $fotos_ex)
                DatosProductoExhibido::insertar($fotos_ex,$cverecolector,$indice,"producto_exhibido");
            
           // foreach ($imagenes_det as $imagen)
           //     DatosImagenDetalle::insertar($imagen,$cverecolector,$indice,"imagen_detalle");
            $datosInfdet=new DatosInformeDetalle();
                
            foreach ($lisinforme_det as $detalle)
                    $datosInfdet->insertar($detalle,"informe_detalle");
                    
                    
                    
            foreach ($lisinforme as $informe)
                $this->datosInf->insertar($informe,$cverecolector,$indice,"informes");
                    //  echo "rrrrrrrrrr".$visita[ContratoVisitas::TIENDAID];
                    //reviso si es una tienda nueva para insertarla
            if($visita[ContratoVisitas::TIENDAID]==null||$visita[ContratoVisitas::TIENDAID]==0){
                        //es tienda nueva
                 $datostienda=$this->tiendaNueva($visita);
                     //   var_dump($datostienda);
                 $idtienda=$this->datosInf->insertarUnegocio($datostienda, "ca_unegocios");
                 echo $idtienda;
                 if($idtienda>0)
                 //actualizo la visita
                 DatosVisita::actualizar($visita, $idtienda, "visitas");
                 
                        
            }
                    
                    
        }catch(Exception $ex){
            throw new Exception("Hubo un error al insertar ".$ex->getMessage());
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
          
            $this->datosInf->insertar($informe,"informes");
            
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
    
    public function tiendaNueva($tiendarem){
        //BUSCO LOS DATOS DE cd, pais, con las coordenadas en google
        $datosModel=array();
        $datosModel["nomuneg"]=$tiendarem[ContratoVisitas::TIENDANOMBRE];
        $datosModel["dirtien"]="falta dir";
        $datosModel["refer"]=$tiendarem[ContratoVisitas::COMPLEMENTODIR];
        $datosModel["paisuneg"]=1;
        $datosModel["ciudaduneg"]=1;
        $datosModel["cxy"]=$tiendarem[ContratoVisitas::GEOLOCALIZACION];
        $datosModel["cadcomuneg"]=0;
      
        $datosModel["estatusuneg"]=1;
        return $datosModel;
      
    }
    
}