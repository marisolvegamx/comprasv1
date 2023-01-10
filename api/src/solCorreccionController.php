<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);


require_once '../../Models/crud_supvalfotos.php';

//para devolver los datos en json
class solCorreccionController{
    
   
    private $listasolicitudesi;
   
    private $listasolicitudesu;
    private $listacanceladas;
   
    private $datosVal;
    private $fechaini="";
    private $fechafin="";
 
   
    function __construct(){
        
       $this->listasolicitudesi=array();
       $this->listasolicitudesu=array();
     
       
    //    $this->datosListaCom=new DatosListaCompra();
        $this->datosVal=new DatosValFotos();
    }
    
    public function getNuevos($indice,$recolector, $etapa){
        
       if($etapa==2)//para compras
       {
        $rs = $this->datosVal->getValidacionFotos($indice,$recolector, $etapa,1, "sup_validacion");
          // var_dump($rs);
         //  die();
      //actualizo estatus a leido
        foreach ($rs as $solic){
           // var_dump($solic);
            $datosController= array("idval"=>$solic["id"],
                "idimg"=>$solic["numFoto"],
            "est"=>5
            
            );
        // var_dump($idval);
        //  var_dump($datosController);
         //    $this->actualizaValidacionimg($datosController, "sup_validafotos");
        }
       // $this->listasolicitudesi=$rs;
        $rs2 = $this->datosVal->getValidacionFotosVis($indice,$recolector, $etapa,1, "sup_validacion");
         //var_dump($rs2);
        //  die();
        //actualizo estatus a leido
        foreach ($rs2 as $solic){
            // var_dump($solic);
            $datosController= array("idval"=>$solic["id"],
                "idimg"=>$solic["numFoto"],
                "est"=>5
                
            );
            // var_dump($idval);
            //  var_dump($datosController);
            //    $this->actualizaValidacionimg($datosController, "sup_validafotos");
        }
        
        $this->listasolicitudesi=array_merge($rs,$rs2);
       
       }else{
           $rs = $this->datosVal->getValidacionFotosEta($indice,$recolector, $etapa,1, "sup_validacion");
           // var_dump($rs);
           //  die();
           //actualizo estatus a leido
           foreach ($rs as $solic){
               // var_dump($solic);
               $datosController= array("idval"=>$solic["id"],
                   "idimg"=>$solic["numfoto"],
                   "est"=>5
                   
               );
               // var_dump($idval);
               //  var_dump($datosController);
               //    $this->actualizaValidacionimg($datosController, "sup_validafotos");
           }
           $this->listasolicitudesi=$rs;
       }
        
       
        
    }
    public function getCanceladas($indice,$recolector){
        
        
        $rs = $this->datosVal->getMuestrasCanceladas($indice,$recolector, 2);
       //  var_dump($rs);
        //  die();
        $this->listacanceladas=$rs;
        //actualizo el estatus a leido
        foreach ($this->listacanceladas as $muestra){
            DatosInformeDetalle::actualizarEstatus($muestra["ind_id"], $recolector, $indice, 5, "informe_detalle");
            
        }
       
     
    }
    public function getEtaCanceladas($indice,$recolector){
        
        
        $rs = $this->datosVal->getEtapaCanceladas($indice,$recolector, 2);
        //  var_dump($rs);
        //  die();
        $this->listacanceladas=$rs;
        //actualizo el estatus a leido
        foreach ($this->listacanceladas as $muestra){
            DatosInformeEtapa::updateEstatus($muestra["inf_id"], 5,$recolector, $indice,  "informes_etapa");
            
        }
        
        
    }
    
    
    public function getUpdate($indice,$recolector, $etapa){
        
       
    }
    
    public function response($indice,$recolector, $etapa)
    {
        $response=array();
        $this->getNuevos($indice,$recolector, $etapa);
        
       // $this->getUpdate($fecha, $recolector,$indice);
       if($etapa==2)
            $this->getCanceladas($indice, $recolector,2);
       else 
           $this->getEtaCanceladas($indice, $recolector);
        if(sizeof($this->listasolicitudesi)>0||sizeof($this->listacanceladas)>0)
        { 
            $response["inserts"]=$this->listasolicitudesi;
            $response["canceladas"]=$this->listacanceladas;
       
        }else 
        {
            $response = array('status' => 'error', 'data' => "ya está actualizado");
        }
        
        
        return json_encode($response);
    }
    
    public function actualizaValidacionimg($datosModel, $tabla){
        try {
            // busca el id de validacion
            $stmt = Conexion::conectar()-> prepare("UPDATE $tabla SET `vai_estatus`=:estatus WHERE `vai_id`=:idval and `vai_numfoto`=:numimg");
            
            $stmt->bindParam(":idval", $datosModel["idval"], PDO::PARAM_INT);
            $stmt->bindParam(":estatus", $datosModel["est"], PDO::PARAM_INT);
            $stmt->bindParam(":numimg", $datosModel["idimg"], PDO::PARAM_INT);
            
            $stmt-> execute();
            return "success";
        } catch (Exception $ex) {
            
            return "error";
        }
    }
    
    
}

