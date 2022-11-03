<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
require '../../Models/crud_informesetapa.php';
require '../../Models/crud_infetapadet.php';


//clase para manejar el json e insertarlo
class InformeEtaPostController{
    private $datosInf;
    private $TAG="InformeEtaPostController";
    private $tablainf="informes_etapa";
    private $tablainfdet="informes_etapadet";
    public function __construct(){
        $this->datosInf= new DatosInformeEtapa();
    }
    //se inserta por primera vez
    public function insertarTodo($campos){
        $pdo=Conexion::conectar();
        try{
            $informe=$campos["informeEtapa"];
       
        $informe_det=$campos["informeEtapaDet"]; //este es un array
        $detallecaja=$campos["detalleCaja"]; //es array
       
        $cverecolector=$campos[ContratoVisitas::CVEUSUARIO];
        $indice=$campos[ContratoVisitas::INDICE];
      
        //TODO lo pongo en una transaccion
       
        $pdo->beginTransaction();
        $datosInf2=new DatosInformeEtapa();
        $resp= $datosInf2->getInformesEtapaxId($indice,$cverecolector,$informe[ContratoInfEtapa::ID],$this->tablainf);
      //  var_dump($resp);
        // die();
        if($resp!=null&&$resp["ine_id"]==$informe[ContratoInfEtapa::ID]){
            
            //deberia actualizar??
            
        }else
            $this->datosInf->insertar($informe,$cverecolector,$indice,$this->tablainf,$pdo);
            // echo "rrrrrrrrrr".$visita[ContratoVisitas::TIENDAID];
            
            
            $datosInfdet=new DatosInfEtapaDet();
        
        if(isset($informe_det))
        foreach ($informe_det as $detalle)
        { 
            $datosInfdet2=new DatosInfEtapaDet();
            $resp= $datosInfdet2->getInfEtapaDetxId($indice,$cverecolector,$detalle[ContratoInfEtapaDet::ID],$this->tablainfdet);
         //  var_dump($resp);
         //  die();
          // echo "<br>".$resp[ContratoInfEtapaDet::ID]."--".$detalle[ContratoInfEtapaDet::ID];
               
           if($resp!=null&&$resp[ContratoInfEtapaDet::ID]==$detalle["ied_id"]){
           }else
           
               $datosInfdet->insertar($detalle,$cverecolector,$indice,$this->tablainfdet,$pdo);
           
        }
       
       
        $pdo->commit();
        
        }catch(Exception $ex){
           // $ex->getTrace();
            throw new Exception($this->TAG." *Hubo un error al insertar ".$ex->getMessage());
            $pdo->rollBack();
        }
        
        
    }
    
    //se insertan en listas
    public function insertarPend($campos){
        try{
           
            
        }catch(Exception $ex){
            throw new Exception($this->TAG."*Hubo un error al insertar ".$ex->getMessage());
            $pdo->rollBack();
        }
        
        
        
    }

   
    
}