<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);


require_once '../../Models/crud_supvalfotos.php';

//para devolver los datos en json
class solCorreccionController{
    
   
    private $listasolicitudesi;
   
    private $listasolicitudesu;
    private $listacanceladas;
   
    private $datosInf;
    private $fechaini="";
    private $fechafin="";
 
   
    function __construct(){
        
       $this->listasolicitudesi=array();
       $this->listasolicitudesu=array();
     
       
    //    $this->datosListaCom=new DatosListaCompra();
        $this->datosInf=new DatosValFotos();
    }
    
    public function getNuevos($indice,$recolector, $etapa){
        
       if($etapa==2)//para compras
       {
        $rs = $this->datosInf->getValidacionFotos($indice,$recolector, $etapa,1, "sup_validacion");
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
        $rs2 = $this->datosInf->getValidacionFotosVis($indice,$recolector, $etapa,1, "sup_validacion");
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
           $rs = $this->datosInf->getValidacionFotosEta($indice,$recolector, $etapa,1, "sup_validacion");
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
           $this->listasolicitudesi=$rs;
       }
        
       
        
    }
    public function getCanceladas($indice,$recolector){
        
        
        $rs = $this->datosInf->getMuestrasCanceladas($indice,$recolector, 2);
       //  var_dump($rs);
        //  die();
        $this->listacanceladas=$rs;
        //actualizo el estatus a leido
        foreach ($this->listacanceladas as $muestra){
            DatosInformeDetalle::actualizarEstatus($muestra["ind_id"], $recolector, $indice, 5, "informe_detalle");
            
        }
       
     
    }
   
    
    public function getUpdate($indice,$recolector, $etapa){
        
       
    }
    
    public function response($indice,$recolector, $etapa)
    {
        $response=array();
        $this->getNuevos($indice,$recolector, $etapa);
        
       // $this->getUpdate($fecha, $recolector,$indice);
       if($etapa==3)
            $this->getCanceladas($indice, $recolector,2);
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

