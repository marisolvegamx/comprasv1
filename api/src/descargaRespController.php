<?php

namespace api\src;
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
include "informeEnvio.php";
require_once '../../Models/conexion.php';
require_once '../../Models/crud_informes.php';
require_once '../../Models/crud_informesDetalle.php';
require_once '../../Models/crud_imagenesDetalle.php';
require_once '../../Models/crud_productoExhibido.php';
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
        foreach($visitas as $visitapend) {
            $visitapend["estatus"]=2; //cambio estatus a finalizado y enviado
                $visitaenv[]=$visitapend;
              //  echo "<br>".TAG."->buscando prodexh".$visitapend["id"];
                $productoExhibidos=\DatosProductoExhibido::getProductosExxVisita($indice,$recolector,$visitapend["id"],\ConsTablas::PRODUCTOEX);
               
                foreach($productoExhibidos as $produc){
                   
                        $productosExenv[]=$produc;
                }
                //var_dump($productosExenv);
                //voy a buscar los informes de cada visita
                $vis_informes=\DatosInforme::getInformesxVisita($indice,$recolector,$visitapend["id"],"informes");
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
    
}

