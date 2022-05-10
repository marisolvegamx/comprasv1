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
    private $TAG="InformePostController";
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
        $cverecolector=$campos[ContratoVisitas::CVEUSUARIO];
        $indice=$campos[ContratoVisitas::INDICE];
      
        //TODO lo pongo en una transaccion
       
        $pdo->beginTransaction();
        if(isset($visita))
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
            $datostienda=$this->tiendaNueva($visita,$informe[ContratoInformes::CAUSANOCOMPRA]);
            //busco la zona
            
            
            $idtienda=$this->datosInf->insertarUnegocio($datostienda, "ca_unegocios",$pdo);
         
          //  echo "estoy aqui"; 
                //actualizo en la visita
            DatosVisita::actualizar($visita, $idtienda, "visitas",$pdo);
            
            
        }else{
            //actualizo el estatus si no hubo prod
            $tiendaid=$visita[ContratoVisitas::TIENDAID];
            if(isset($informe[ContratoInformes::CAUSANOCOMPRA])&&$informe[ContratoInformes::CAUSANOCOMPRA]==4){
               $this->datosInf->actualizarUnegocioEstatus($tiendaid,2,"ca_unegocios");
            }
        }
        $pdo->commit();
        
        }catch(Exception $ex){
            throw new Exception($this->TAG." *Hubo un error al insertar ".$ex->getMessage());
            $pdo->rollBack();
        }
        
        
    }
    
    //se inserta por primera vez
    public function insertarPend($campos){
        try{
            $pdo=Conexion::conectar();
            $lisvisita=$campos["visita"]; //es array
            $lisinforme=$campos["informeCompra"]; //es array
            $lisinforme_det=$campos["informeCompraDetalles"]; //este es un array
            $lisfotos_ex=$campos["productosEx"]; //es array
            $cverecolector=$campos[ContratoVisitas::CVEUSUARIO];
            $indice=$campos[ContratoVisitas::INDICE];
         //   $imagenes_det=$campos["imagenDetalles"]; //es array
          
            $pdo->beginTransaction();
            //TODO lo pongo en una transaccion
            //  $conexion=Conexion::conectar();
            foreach ($lisvisita as $visita){
                DatosVisita::insertar($visita,"visitas",$pdo);
                if($visita[ContratoVisitas::TIENDAID]==null||$visita[ContratoVisitas::TIENDAID]==0){
                    //es tienda nueva
                    $datostienda=$this->tiendaNueva($visita,0);
                    //   var_dump($datostienda);
                    $idtienda=$this->datosInf->insertarUnegocio($datostienda, "ca_unegocios",$pdo);
                    echo $idtienda;
                    if($idtienda>0)
                        //actualizo la visita
                        DatosVisita::actualizar($visita, $idtienda, "visitas");
                        
                        
                }
            }
            
            foreach ($lisfotos_ex as $fotos_ex)
                DatosProductoExhibido::insertar($fotos_ex,$cverecolector,$indice,"producto_exhibido",$pdo);
            
           // foreach ($imagenes_det as $imagen)
           //     DatosImagenDetalle::insertar($imagen,$cverecolector,$indice,"imagen_detalle");
            $datosInfdet=new DatosInformeDetalle();
                
            foreach ($lisinforme_det as $detalle)
                $datosInfdet->insertar($detalle,$cverecolector,$indice,"informe_detalle",$pdo);
                    
                    
                    
            foreach ($lisinforme as $informe)
                $this->datosInf->insertar($informe,$cverecolector,$indice,"informes",$pdo);
                    //  echo "rrrrrrrrrr".$visita[ContratoVisitas::TIENDAID];
                    //reviso si es una tienda nueva para insertarla
           
                    
                    
            $pdo->commit();
            
        }catch(Exception $ex){
            throw new Exception($this->TAG."*Hubo un error al insertar ".$ex->getMessage());
            $pdo->rollBack();
        }
        
        
        
    }
    //se inserta por primera vez
    public function insertarVisita($campos){
        try{
            $pdo=Conexion::conectar();
            $visita=$campos["visita"];
         
            
            DatosVisita::insertar($visita,"visitas",$pdo);
           
            
        }catch(Exception $ex){
            throw new Exception($this->TAG."Hubo un error al insertar visita"+$ex->getMessage());
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
            throw new Exception($this->TAG."Hubo un error al insertar informe "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarInfDet($campos){
        try{
          
            $informe_det=$campos["informe_detalle"]; //este es un array
          
            DatosInformeDetalle::insertar($informe_det,"informe_detalle");
            
          
        }catch(Exception $ex){
            throw new Exception($this->TAG."Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarProdEx($campos){
        try{
         
            $fotos_ex=$campos["fotos_ex"]; //es array
          
           //  $conexion=Conexion::conectar();
            DatosProductoExhibido::insertar($fotos_ex,"producto_exhibido");
            
            
        }catch(Exception $ex){
            throw new Exception($this->TAG."Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    //se inserta por primera vez
    public function insertarImagenes($campos){
        try{
        
            $imagenes_det=$campos["imagenes_det"]; //es array
            
            DatosImagenDetalle::insertar($imagenes_det,"imagen_detalle");
                  
        }catch(Exception $ex){
            throw new Exception($this->TAG."Hubo un error al insertar "+$ex->getMessage());
        }
        
        
    }
    
    public function tiendaNueva($tiendarem,$causa){
        //BUSCO LOS DATOS DE cd, pais, con las coordenadas en google
        $datosModel=array();
        $datosModel["nomuneg"]=$tiendarem[ContratoVisitas::TIENDANOMBRE];
        $datosModel["dirtien"]=$tiendarem[ContratoVisitas::DIRECCION];
        $datosModel["tipouneg"]=$tiendarem[ContratoVisitas::TIPOTIENDAID];
        $datosModel["refer"]=$tiendarem[ContratoVisitas::COMPLEMENTODIR];
        $datosModel["paisuneg"]=$tiendarem[ContratoVisitas::PAISID];
        $datosModel["ciudaduneg"]=$tiendarem[ContratoVisitas::CIUDADID];
        $datosModel["cxy"]=$tiendarem[ContratoVisitas::GEOLOCALIZACION];
        $datosModel["cadcomuneg"]=0;
        if($causa==4)
        $datosModel["estatusuneg"]=2;
        else 
            $datosModel["estatusuneg"]=1;
        return $datosModel;
      
    }
    
}