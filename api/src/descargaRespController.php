<?php

namespace api\src;
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
include "informeEnvio.php";
include "informeEtapaenv.php";
require '../../Models/crud_informesetapa.php';
require '../../Models/crud_infetapadet.php';

require_once '../../Models/crud_visitas.php';
require_once '../../Utilerias/constantes.php';

define( "TAG","DescargaRespController");
class DescargaRespController
{
   
    public function prepararInformes($indice,$recolector){
        
        $envio=new InformeEnvio();
        $visitaenv=array();
        $informeCompraenv=array();
        $informeCompraDetallesenv=array();
        $imagenDetallesenv=array();
        $productosExenv=array();
        $dvisit=new \DatosVisita();
        $visitas=$dvisit->getVisitas($indice, $recolector, "visitas");
        foreach($visitas as $informe) {
            $informe["estatus"]=2; //cambio estatus a finalizado y enviado
                $visitaenv[]=$informe;
              //  echo "<br>".TAG."->buscando prodexh".$informe["id"];
                $productoExhibidos=\DatosProductoExhibido::getProductosExxVisita($indice,$recolector,$informe["id"],\ConsTablas::PRODUCTOEX);
               
                foreach($productoExhibidos as $produc){
                   
                        $productosExenv[]=$produc;
                }
                //var_dump($productosExenv);
                //voy a buscar los informes de cada visita
                $vis_informes=\DatosInforme::getInformesxVisita($indice,$recolector,$informe["id"],"informes");
               // echo "<br>".TAG."->informes".sizeof($vis_informes);
                foreach ($vis_informes as $informe){
                        $informe["estatus"]=2;//cambio estatus a finalizado
                        $informeCompraenv[]=$informe;
                        //busco los detalles
                        $detalles = \DatosInformeDetalle::getInformesDetxInf($indice,$recolector,$informe["id"],\ConsTablas::INFDETALLE);
                      
                        foreach ($detalles as $informedet){
                            
                            $informeCompraDetallesenv[]=$informedet;
                        }
                        //   envio.setImagenDetalles(buscarImagenes(visita, informe, detalles));
                    
                }
        }
        $imagenDetallesenv=\DatosImagenDetalle::getImagenes($indice,$recolector,\ConsTablas::IMAGENES);
      //  echo "<br>".TAG."->imagenes ".sizeof($imagenDetallesenv);
        if(sizeof($imagenDetallesenv)>0)
            $envio->setImagenDetalles($imagenDetallesenv);
            if(sizeof($informeCompraenv)>0)
                $envio->setInformeCompra($informeCompraenv);
                if(sizeof($informeCompraDetallesenv)>0)
                   $envio->setInformeCompraDetalles($informeCompraDetallesenv);
                    if(sizeof($productosExenv)>0)
                       $envio->setProductosEx($productosExenv);
                        if(sizeof($visitaenv)>0)
                           $envio->setVisita($visitaenv);
                          // $envio->setClaveUsuario($recolector);
                            //TODO talvez sacar el de la visita
                           //$envio->setIndice($indice);
                          // var_dump($envio);//
                            return $envio;
    }
    
    public function response($indice,$recolector){
       return json_encode($this->prepararInformes($indice, $recolector));
    }
    
    
    public function prepararInformesEta($indice,$recolector){
        
        $envio=new InformeEtapaEnv();
        $informeenv=array();
       
        $informeDetsenv=array();
        $detallecajaenv=array();
      
        $dinfe=new \DatosInformeEtapa();
       $resp=$dinfe->getAll($indice,$recolector,"informes_etapa");
        foreach($resp as $informe) {
         
            $informeenv[]=$informe;
            //  echo "<br>".TAG."->buscando prodexh".$informe["id"];
            $informeDetsenv=\DatosInfEtapaDet::getAll($indice,$recolector,$informe["id"],\ConsTablas::INFORMEETAPADET);
            
            foreach ($informeDetsenv as $detalles){
                
                $informeDetallesenv[]=$detalles;
            }
           
        }
        
        if(sizeof($informeenv)>0)
                $envio->setInformeEtapa($informeenv);
                if(sizeof($informeDetsenv)>0)
                    $envio->setInformeEtapaDet($informeDetallesenv);
                    
             return $envio;
    }
    
    public function responseEtapas($indice,$recolector){
        return json_encode($this->prepararInformesEta($indice, $recolector));
    }
    
    public function prepararCorrecciones($indice,$recolector){
        
        
        $correccenv=array();
        
      
        $dcorre=new \DatosCorreccion();
        $correccenv=$dcorre->getCorrecciones($indice,$recolector,\ConsTablas::CORRECCIONES);
        
                
        return $correccenv;
    }
    
    public function responseCorrec($indice,$recolector){
        return json_encode($this->prepararCorrecciones($indice, $recolector));
    }
}

