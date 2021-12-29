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
 
    /**
     * @return mixed
     */
    public function getDetallesi()
    {
        return $this->detallesi;
    }

   
    public function getDetallesu()
    {
        return $this->detallesu;
    }
    
    /**
     * @param mixed $detallesi
     */
    public function setDetallesi($detallesi)
    {
        $this->detallesi = $detallesi;
    }

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
        	$listaperm=$listarestrin=array();
        	//armo un array con los no permitidos;  lid_fechapermitida , lid_fecharestringida,
        	//echo "<br>mmmmmm". $row2["lid_fecharestringida"];
        	if(strlen($row2["lid_fecharestringida"])>1)
        	{$listarestrin=explode(",", $row2["lid_fecharestringida"]);
        	//var_dump($listarestrin);
        	$listarestrin=$this->dejarSoloFecha($listarestrin);
        	}
        	//echo "------------------<br>";
        //	var_dump($listarestrin);
        	if(strlen($row2["lid_fechapermitida"])>1){
            	$listaperm=explode(",", $row2["lid_fechapermitida"]);
           // 	echo "zzzzzzzzzzzzzzzzzzz<br>";
           // 	var_dump($listaperm);
            	$listaperm=$this->dejarSoloFecha($listaperm);
        	}
        	
            //busco los codigos no perm
            $codigos=$this->getCodigosNoPer($row2,$listaperm,$listarestrin);
            $nuevorow2["codigosNoPermitidos"]=$codigos;
             $this->detallesi[]=$nuevorow2;
        }
       
        
    }
    public function dejarSoloFecha($arreglo){
       // var_dump($arreglo);
        $nuevoarreglo=array();
        foreach($arreglo as $fecha){
            $fecha=trim($fecha);
           // echo "<br>".$fecha."--".strpos($fecha,"=");
            if(strpos($fecha,"=")==0)
            {    $nuevoarreglo[]=substr($fecha,1); //lequito el igual   
          //      var_dump($nuevoarreglo);
            }
        }
        return $nuevoarreglo;
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
    
    public function getCodigosNoPer($datos,$listapermitidos,$listarestrin){
        $fechaini="";
        $fechafin="";
        $resp=$this->datosInf->getCodigosNoPer($fechaini,$fechafin,$datos["productosId"],$datos["tamanio"],$datos["empaquesId"],$datos["tipoAnalisis"],$datos["planta"],"informe_detalle");
        $codigos="";
        //primero agrego los restringidos
        $listanoper=array();
        foreach($resp as $row){
            $listanoper[]=$row["ind_caducidad"];
        }
        $todojunto=$listanoper;
      
        if(sizeof($listarestrin)>0){
            if(sizeof($listanoper)<1){
                $todojunto=$listarestrin;
            }else
            $todojunto=$this->insertarRestringidos($listarestrin, $listanoper);
        }
      //  echo "<br>**************restr";
      //  var_dump($listapermitidos);
        //quito los permitidos
        if(sizeof($listapermitidos)>0)
            $todojunto=$this->eliminarPermitidos($listapermitidos, $todojunto);
       //  echo "<br>+++++++++++++restr+++++++++++";
       //     var_dump($todojunto);
         foreach($todojunto as $row){
            $codigos.=$row.";";
        }
        return substr($codigos,0,strlen($codigos)-1);
    }
    //codigos restringidos y no permitidos llegan como array
    public function insertarRestringidos($listRest,$codnoper){
        $todojunto=array();
        foreach($listRest as $restringido){
           $nuevoarray= $this->comparar($codnoper, $restringido, $todojunto);
           $todojunto=$nuevoarray;
          
        }
        return $todojunto;
    }
    public function comparar($codnoper,$restringido, $todojunto){
        for($i=0;$i<sizeof($codnoper);$i++){
            $fechares=strtotime($restringido);
            $fechanoper = strtotime($codnoper[$i]);
            
            if($fechares > $fechanoper)
            {   $todojunto[]=$restringido;
                $nuevoarray=array_merge($todojunto,array_slice($codnoper, $i));
                return $nuevoarray;
            }
            $todojunto[]=$codnoper[$i];
        }
        //nunca fue mayor queda al final
        $codnoper[]=$restringido;
        return $codnoper;
    }
    public function eliminarPermitidos($listapermitidos,$codnoper){
        $nuevoarray=$codnoper;
        foreach ($listapermitidos as $permitido){
         
            $nuevoarray=$this->eliminardeArray($permitido, $nuevoarray);
          //  var_dump($nuevoarray);
        }
        return $nuevoarray;
    }
    public function eliminardeArray($valor, $codnoper){
      //  echo "<br>borrando a ".$valor;
     //   var_dump($codnoper);
        $pos=array_search($valor, $codnoper,false);
        
        if($pos>=0)
        {  // echo "<br>esta en ".$pos;
            return array_splice($codnoper, $pos, 1);
        }

        else 
            return $codnoper;
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
        //var_dump($rs2);
        foreach ($rs2 as $row2) {
        	$nuevorow2=$row2;
        	$listaperm=$listarestrin=array();
        	//armo un array con los no permitidos;  lid_fechapermitida , lid_fecharestringida,
        	//echo "<br>mmmmmm". $row2["lid_fecharestringida"];
        	if(strlen($row2["lid_fecharestringida"])>1)
        	{$listarestrin=explode(",", $row2["lid_fecharestringida"]);
        	//var_dump($listarestrin);
        	$listarestrin=$this->dejarSoloFecha($listarestrin);
        	}
        	//echo "------------------<br>";
        	//	var_dump($listarestrin);
        	if(strlen($row2["lid_fechapermitida"])>1){
        	    $listaperm=explode(",", $row2["lid_fechapermitida"]);
        	    // 	echo "zzzzzzzzzzzzzzzzzzz<br>";
        	    // 	var_dump($listaperm);
        	    $listaperm=$this->dejarSoloFecha($listaperm);
        	}
        	
        	//busco los codigos no perm
        	$codigos=$this->getCodigosNoPer($row2,$listaperm,$listarestrin);
            //busco los codigos no perm
           // $codigos=$this->getCodigosNoPer($row2);
            $nuevorow2["codigosNoPermitidos"]=$codigos;
             $this->detallesu[]=$nuevorow2;
            
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

