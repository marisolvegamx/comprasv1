<?php
require_once '../../Models/conexion.php';

require_once '../../Models/crud_informes.php';
require_once '../../Models/crud_n6.php';
//para devolver los catalogos en json
class listaComController{
    
    private $inserts;
    private $updates;
    private $listacomprasi;
    private $detallesi;
    private $listacomprasu;
    private $detallesu;
    private $datosInf;
 
    function __construct(){
        
       
    //    $this->datosListaCom=new DatosListaCompra();
        $this->datosInf=new DatosInforme();
    }
    
    public function getNuevos($fecha,$recolector,$indice){
        
       
        $rs = $this->datosInf->getNvaLisComprxRecol($recolector, $fecha,$indice, "pr_listacompra");
           
        foreach ($rs as $row) {
        	$nuevorow=$row;
            //busco las siglas de la planta
            $siglas=$this->getSiglas($row["plantasId"]);
            $nuevorow["siglas"]=$siglas;

            $this->listacomprasi[]=$nuevorow;
        }
    
        $rs2 = $this->datosInf->getNvaLisComprDetxRecol($recolector, $fecha,$indice, "pr_listacompradetalle");
        $codigos="";
        foreach ($rs2 as $row2) {
        	$nuevorow2=$row2;
            //busco los codigos no perm
          //  $codigos=$this->getCodigosNoPer($row2);
            $nuevorow2["codigosNoPermitidos"]=$codigos;
             $this->detallesi[]=$nuevorow2;
        }
       
        
    }
    
    public function getSiglas($idplanta){
        $datosplan=new Datosnsei();
        $resp=$datosplan->vistanN6Byn5($idplanta,"ca_nivel6");
       // var_dump($resp);
        $siglas="";
        foreach($resp as $row){

            $siglas.=$row["n6_nombre"]."/";
        }
        return substr($siglas,0,strlen($siglas)-1);
    }
    
    public function getCodigosNoPer($datos){
        $fechaini="";
        $fechafin="";
        $resp=$this->datosInf->getCodigosNoPer($fechaini,$fechafin,$datos["productosId"],$datos["tamanio"],$datos["empaquesId"],"pr_listacompradetalle");
        $codigos="";
        foreach($resp as $row){
            $codigos.=$row["ind_caducidad"].";";
        }
        return substr($codigos,0,strlen($codigos)-1);
    }
    
    public function getUpdate($fecha,$recolector,$indice){
        $rs = $this->datosInf->getActLisComprxRecol($recolector, $fecha,$indice, "pr_listacompra");
        
        foreach ($rs as $row) {
        	$nuevorow=$row;
            //busco las siglas de la planta
            $siglas=$this->getSiglas($row["plantasId"]);
            $nuevorow["siglas"]=$siglas;
            $this->listacomprasu[]=$nuevorow;
        }
      
        $rs2 = $this->datosInf->getActLisComprDetxRecol($recolector, $fecha,$indice, "pr_listacompradetalle");
        $codigos="";
        foreach ($rs2 as $row2) {
        	$nuevorow2=$row2;
            //busco los codigos no perm
           // $codigos=$this->getCodigosNoPer($row2);
            $nuevorow2["codigosNoPermitidos"]=$codigos;
             $this->detallesu=$nuevorow2;
            
        }
       
    }
    
    public function response($fecha,$recolector,$indice)
    {
        $response=array();
        $this->getNuevos($fecha, $recolector,$indice);
        $this->getUpdate($fecha, $recolector,$indice);
        if(sizeof($this->listacomprasi)>0||sizeof($this->detallesi)>0||sizeof($this->detallesu)||sizeof($this->listacomprasu)>0)
        { $response["inserts"]=array("ListaCompra"=>$this->listacomprasi,
                                    "ListaCompraDetalle"=>$this->detallesi);
        $response["updates"] =array("ListaCompra"=>$this->listacomprasu,
            "ListaCompraDetalle"=>$this->detallesu);
        }else 
        {
            $response = array('status' => 'error', 'data' => "ya está actualizado");
        }
        
        
        return json_encode($response);
    }
}