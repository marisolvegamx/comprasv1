<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);

require '../../Models/crud_visitas.php';
require '../../Models/crud_informes.php';
require '../../Models/crud_informesDetalle.php';
require '../../Models/crud_productoExhibido.php';
require '../../Models/crud_imagenesDetalle.php';
require '../../Models/crud_uneimagenes.php';

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
        $tengovis;
        $pdo=Conexion::conectar();
        try{
        $visita=$campos["visita"];
        $informe=$campos["informeCompra"];
        $informe_det=$campos["informeCompraDetalles"]; //este es un array
        $fotos_ex=$campos["productosEx"]; //es array
        $imagenes_det=$campos["imagenDetalles"]; //es array
      //  $uneimagenes=$campos["uneimagenes"]; //es array
        $cverecolector=$campos[ContratoVisitas::CVEUSUARIO];
        $indice=$campos[ContratoVisitas::INDICE];
      
        //TODO lo pongo en una transaccion
      
        $pdo->beginTransaction();
        if(isset($visita))
        {   
            //reviso si ya existe
            $dv=new DatosVisita();
            $result=$dv->getVisita( $visita[ContratoVisitas::ID],  $visita[ContratoVisitas::INDICE], $cverecolector, "visitas");
            if($result==null||sizeof($result)==0)
            {   DatosVisita::insertar($visita,"visitas",$pdo);
            $tengovis=0;
            }
            else $tengovis=1;
        }
       
        if(isset($fotos_ex))
           foreach ($fotos_ex as $lisfotos_ex)
           {   
               
               DatosProductoExhibido::insertaru($lisfotos_ex,$cverecolector,$indice,"producto_exhibido",$pdo);
               
           }
       
      // echo "insertar imagenes";
       //die();
            if(isset($imagenes_det))
        foreach ($imagenes_det as $imagen)
        {  DatosImagenDetalle::insertaru($imagen,$cverecolector,$indice,"imagen_detalle",$pdo);
       
            }
        $datosInfdet=new DatosInformeDetalle();
        
        if(isset($informe_det))
        foreach ($informe_det as $detalle)
        { 
          
            $datosInfdet2=new DatosInformeDetalle();
           $resp= $datosInfdet2->getInformesDetxid($detalle[ContratoInformesDet::ID],$indice,$cverecolector,"informe_detalle");
         
         //  die();
          // echo "<br>".$resp[ContratoInformesDet::ID]."--".$detalle[ContratoInformesDet::ID];
          
           if($resp!=null&&$resp[ContratoInformesDet::ID]==$detalle[ContratoInformesDet::ID]){
           }else
           {
            
                $datosInfdet->insertar($detalle,$cverecolector,$indice,"informe_detalle",$pdo);
                //actualizo la lista de compra
                $datosInfdet->sumaCompradosLista($detalle[ContratoInformesDet::COMPRASID],$detalle[ContratoInformesDet::COMPRASDETID],1,"pr_listacompradetalle");
               
                 //veo si es    x un informe cancelado
                 $datosinf3=new DatosInformeDetalle();
                 $respc=$datosinf3->getCancelada($detalle[ContratoInformesDet::COMPRASID],$detalle[ContratoInformesDet::COMPRASDETID],2,"informe_detalle");
               
               if($respc!=null)
                   $datosinf3->actualizarCancelada($respc["ind_indice"],$respc["ind_recolector"],$respc["ind_id"],4,"informe_detalle");
               
           }
        }
        $datosInf2=new DatosInforme();
        $resp= $datosInf2->getInformexid($indice,$cverecolector,$informe[ContratoInformes::ID],"informes");
       // var_dump($resp);
      
        if($resp!=null&&$resp[ContratoInformes::ID]==$informe[ContratoInformes::ID]){
        }else
         $this->datosInf->insertar($informe,$cverecolector,$indice,"informes",$pdo);
       // echo "rrrrrrrrrr".$visita[ContratoVisitas::TIENDAID];
        //reviso si es una tienda nueva para insertarla
       
        if($visita[ContratoVisitas::TIENDAID]==null||$visita[ContratoVisitas::TIENDAID]==0){
        //      echo "estoy aqui"; 
                //es tienda nueva
            if(isset($informe[ContratoInformes::CAUSANOCOMPRA]))
                $causanocompra=$informe[ContratoInformes::CAUSANOCOMPRA];
            else 
                $causanocompra=0;
            $datostienda=$this->tiendaNueva($visita,$causanocompra,$indice,$cverecolector);
            //busco la zona
            
            if($tengovis==0)
            $idtienda=$this->datosInf->insertarUnegocio($datostienda, "ca_unegocios",$pdo);
            //inserto las fotos
           // die();
            $datosui=new DatosUneImagenes();
            if($idtienda>0)
            { 
               //ahora lo hace el supervisor 
               /* foreach ($fotos_ex as $lisfotos_ex)
                {
                    if($lisfotos_ex["imagenId"]>0)
                    $datosui->insertar($lisfotos_ex,$idtienda,$cverecolector,$indice, "ca_uneimagenes");
                   
                }*/
              
               /* if(isset($informe))
                {  $resp=$datosui->getUneImagenxCli($idtienda, $informe[ContratoInformes::CLIENTESID], "ca_uneimagenes");
                    if($resp!=null){
                         
                        $datosui->actualizarTicket($informe, $idtienda, $cverecolector, $indice, "ca_uneimagenes");
                    }else 
                        //insertar
                        $datosui->insertarTicket($informe,$idtienda,$cverecolector,$indice, "ca_uneimagenes");
                    
                }*/
                
              //  echo "estoy aqui"; 
                    //actualizo en la visita
                DatosVisita::actualizar($visita, $idtienda, "visitas",$pdo);
            }
            
            
        }else{
            //actualizo el estatus si no hubo prod
            $tiendaid=$visita[ContratoVisitas::TIENDAID];
            
            if(isset($informe[ContratoInformes::CAUSANOCOMPRA])&&$informe[ContratoInformes::CAUSANOCOMPRA]==4){
               if($informe[ContratoInformes::CLIENTESID]==4)
                $this->datosInf->actualizarUnegocioEstatus($tiendaid,2,"ca_unegocios");
               if($informe[ContratoInformes::CLIENTESID]==5)
                   $this->datosInf->actUnegEstatusPen($tiendaid,2,"ca_unegocios");
               if($informe[ContratoInformes::CLIENTESID]==6)
                    $this->datosInf->actUnegEstatusEle($tiendaid,2,"ca_unegocios");
            }
            if(isset($informe_det)&&sizeof($informe_det)>0){
                //si hubo
                //si tenia habilitado el mes lo modifico
                $datosController= array("idt"=>$tiendaid,
                    "indice"=>$indice);
                
                $datosController =  DatosInforme::eliminauneghab($datosController, "ca_unegocioshabilitada");
              //y activo otra vez el estatus
                if($informe[ContratoInformes::CLIENTESID]==4)
                    $this->datosInf->actualizarUnegocioEstatus($tiendaid,1,"ca_unegocios");
                if($informe[ContratoInformes::CLIENTESID]==5)
                    $this->datosInf->actUnegEstatusPen($tiendaid,1,"ca_unegocios");
                if($informe[ContratoInformes::CLIENTESID]==6)
                    $this->datosInf->actUnegEstatusEle($tiendaid,1,"ca_unegocios");
                            
            }
            
            
           /* $datosuneim=new DatosUneImagenes();
            if(isset($informe))
            $resp=$datosuneim->getUneImagenxCli($tiendaid, $informe[ContratoInformes::CLIENTESID], "ca_uneimagenes");
            if($resp==null){
               
                foreach ($fotos_ex as $lisfotos_ex)
                {  
                    $datosuneim->insertar($lisfotos_ex,$idtienda,$cverecolector,$indice, "ca_uneimagenes");
                       
                }
                if(isset($informe))
                    $datosuneim->actualizarTicket($informe, $idtienda, $cverecolector, $indice, "ca_uneimagenes");
                    
            }*/
        }
        $pdo->commit();
        
        }catch(Exception $ex){
           // $ex->getTrace();
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
            $imagenes_det=$campos["imagenDetalles"]; //es array
          
            $pdo->beginTransaction();
            //TODO lo pongo en una transaccion
            //  $conexion=Conexion::conectar();
            foreach ($lisvisita as $visita){
                DatosVisita::insertar($visita,"visitas",$pdo);
                if($visita[ContratoVisitas::TIENDAID]==null||$visita[ContratoVisitas::TIENDAID]==0){
                    //es tienda nueva
                    $datostienda=$this->tiendaNueva($visita,0,$indice,$cverecolector);
                    //   var_dump($datostienda);
                    $idtienda=$this->datosInf->insertarUnegocio($datostienda, "ca_unegocios",$pdo);
                    //inserto las fotos
                  /*  $datosui=new DatosUneImagenes();
                    foreach ($fotos_ex as $lisfotos_ex)
                    {
                        
                        
                        $datosui->insertar($lisfotos_ex,$idtienda,$cverecolector,$indice, "ca_uneimagenes");
                        if(isset($informe))
                            $datosui->actualizarTicket($informe, $idtienda, $cverecolector, $indice, "ca_uneimagenes");
                            
                    }*/
                   // echo $idtienda;
                    if($idtienda>0)
                        //actualizo la visita
                        DatosVisita::actualizar($visita, $idtienda, "visitas");
                        
                        
                }
            }
            
            foreach ($lisfotos_ex as $fotos_ex)
                DatosProductoExhibido::insertaru($fotos_ex,$cverecolector,$indice,"producto_exhibido",$pdo);
            
            foreach ($imagenes_det as $imagen)
                DatosImagenDetalle::insertar($imagen,$cverecolector,$indice,"imagen_detalle",$pdo);
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
   
 
    
    
    public function tiendaNueva($tiendarem,$causa,$indice,$recolector){
        //BUSCO LOS DATOS DE cd, pais, con las coordenadas en google
        $datosModel=array();
        $datosModel["nomuneg"]=$tiendarem[ContratoVisitas::TIENDANOMBRE];
        $datosModel["dirtien"]=$tiendarem[ContratoVisitas::DIRECCION];
        $datosModel["tipouneg"]=$tiendarem[ContratoVisitas::TIPOTIENDAID];
        $datosModel["refer"]=$tiendarem[ContratoVisitas::COMPLEMENTODIR];
        $datosModel["paisuneg"]=$tiendarem[ContratoVisitas::PAISID];
        $datosModel["ciudaduneg"]=$tiendarem[ContratoVisitas::CIUDADID];
        $datosModel["cxy"]=$tiendarem[ContratoVisitas::GEOLOCALIZACION];
        $datosModel["puncaruneg"]=$tiendarem[ContratoVisitas::PUNTOCARDINAL];
        $datosModel["cadcomuneg"]=0;
      //  $datosModel["une_fotofachada"]=$tiendarem[ContratoVisitas::FOTOFACHADA];
      //  $datosModel["une_facrecolector"]=$recolector;
      //      $datosModel["une_facindice"]=$indice;
        if($causa==4)
        $datosModel["estatusuneg"]=2;
        else 
            $datosModel["estatusuneg"]=1;
        return $datosModel;
      
    }
    public function tiendaNuevaInf($informe,$indice,$recolector){
       
      $datosinf=new DatosVisita();
      $res=$datosinf->getVisita($informe[ContratoInformes::VISITASID],$indice, $recolector, "visitas");
      if($res!=null){
          $tiendaid=$res["vi_tiendaid"];
      }
      if($tiendaid>0) //es nueva inserto el ticket{
      {
          //veo si existe el ticket
          $datosuneim=new DatosUneImagenes();
          $resp=$datosuneim->getUneImagenxCli($tiendaid, $informe[ContratoInformes::CLIENTESID], "ca_uneimagenes");
          if($resp!=null){
              //ya existe actualizo
              $datosuneim->actualizarTicket($informe, $tiendaid, $recolector, $indice, "ca_uneimagenes");
          }
          
      }
      
    }
    
   
    
}