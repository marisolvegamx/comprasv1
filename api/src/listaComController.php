<?php
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
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
    private $fechaini="";
    private $fechafin="";
 
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
        
       $this->listacomprasi=array();
       $this->listacomprasu=array();
       $this->detallesi=array();
       $this->detallesu=array();
       
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
        	//var_dump($row2);
        	$listaperm=$listarestrin=array();
        	//armo un array con los no permitidos;  lid_fechapermitida , lid_fecharestringida,
	//echo "<br>mmmmmm". $row2["productoNombre"];
        	if(strlen($row2["lid_fecharestringida"])>1)
        	{$listarestrin=explode(",", $row2["lid_fecharestringida"]);
        	//var_dump($listarestrin);
        	if(sizeof($listarestrin)>0)
        	$listarestrin=$this->dejarSoloFecha($listarestrin);
        	}
        	//echo "------------------<br>";
        //	var_dump($listarestrin);
        	if(strlen($row2["lid_fechapermitida"])>1){
            	$listaperm=explode(",", $row2["lid_fechapermitida"]);
           // 	echo "zzzzzzzzzzzzzzzzzzz<br>";
           // 	var_dump($listaperm);
            	if(sizeof($listaperm)>0)
            	$listaperm=$this->dejarSoloFecha($listaperm);
        	}
        	
            //busco los codigos no perm
            $codigos=$this->getCodigosNoPer($row2,$listaperm,$listarestrin,$indice);
            //var_dump($codigos);
         //   echo "<br>".$row2["listaId"]."--".$row2["id"]."------------------".$codigos;
           // die();
            if($codigos!="")
            $nuevorow2["codigosNoPermitidos"]=$codigos;
            else 
                $nuevorow2["codigosNoPermitidos"]="";
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
    
    public function getCodigosNoPer($datos,$listapermitidos,$listarestrin,$indice){
        $this->calcularFechasNoPer($indice);

        $resp=$this->datosInf->getCodigosNoPer($this->fechaini,$this->fechafin,$datos["productosId"],$datos["tamanioId"],$datos["empaquesId"],$datos["analisisId"],$datos["planta"],"informe_detalle");
        $codigos="";
       // echo "<br>";
       // var_dump($resp);
       // echo"<br> calculando codigos";
        //primero agrego los restringidos
        $listanoper=array();
        foreach($resp as $row){
            $listanoper[]=$row["fec_caducidad"];
        }
        $todojunto=$listanoper;
      //  var_dump($listarestrin);
       // var_dump($listapermitidos);
        if(sizeof($listarestrin)>0){
            if(sizeof($listanoper)<1){
                $todojunto=$listarestrin;
            }else
            $todojunto=$this->insertarRestringidos($listarestrin, $listanoper);
        }
       // echo "<br>**************restr";
        //var_dump($todojunto);
        //quito los permitidos
        if(sizeof($listapermitidos)>0)
            $todojunto=$this->eliminarPermitidos($listapermitidos, $todojunto);
     //   echo "<br>+++++++++++++restr+++++++++++";
        //    var_dump($todojunto);
       //ordeno todo
        $ntodojunto=array();
        foreach($todojunto as $row){
               $fecha = DateTime::createFromFormat('d-m-y', $row);
               if($fecha!=null)
                $ntodojunto[]=$fecha->format("y-m-d");
               // $codigos.=$row.";";
            }
         //   var_dump($ntodojunto);
           // echo "<br>+++++++++++++restr+++++++++++";
            if($ntodojunto)
        {rsort($ntodojunto, SORT_STRING);
       // var_dump($ntodojunto);
         foreach($ntodojunto as $row){
             $fecha = DateTime::createFromFormat('y-m-d', $row);
             
            $codigos.=$fecha->format("d-m-y").";";
        }
    }
      //  die();
        if(strlen($codigos)>0)
        return substr($codigos,0,strlen($codigos)-1);
        else return "";
    }
    public function calcularFechasNoPer($indice){
        $aux=explode(".", $indice);
        if(sizeof($aux)>0){
            
            $fechacad=$aux[1]."-".$aux[0]."-"."01";
            $mifecha = new DateTime($fechacad);
            $this->fechafin=$mifecha->format('Y-m-d');
            $mifecha->modify('-2 month');
            $this->fechaini=$mifecha->format('Y-m-d');
        }
      //  echo "fechas ".$this->fechaini.",".$this->fechafin;
            
        
    }
    //codigos restringidos y no permitidos llegan como array
    public function insertarRestringidos($listRest,$codnoper){
        $todojunto=$codnoper;
        foreach($listRest as $restringido){
            $nuevoarray= $this->comparar($todojunto, $restringido);
           $todojunto=$nuevoarray;
          
        }
        return $todojunto;
    }
    public function comparar($codnoper,$restringido){
        $ban=0;
        $todojunto=array();
        for($i=0;$i<sizeof($codnoper);$i++){
            $fechares=strtotime($restringido);
            $fechanoper = strtotime($codnoper[$i]);
            
            if($fechares < $fechanoper)
            {   $todojunto[]=$restringido;
               $todojunto[]=$codnoper[$i];
               $ban=1;
               continue;
               // $nuevoarray=array_merge($todojunto,array_slice($codnoper, $i));
                //return $nuevoarray;
            }
            if($fechares == $fechanoper)
            {  
                $todojunto[]=$codnoper[$i];
            $ban=1;
            continue;
            // $nuevoarray=array_merge($todojunto,array_slice($codnoper, $i));
            //return $nuevoarray;
            }
            
            $todojunto[]=$codnoper[$i];
        }
        //nunca fue mayor queda al final
        if($ban==0)
            $todojunto[]=$restringido;
            return $todojunto;
    }
    public function eliminarPermitidos($listapermitidos,$codnoper){
        $nuevoarray=$codnoper;
        foreach ($listapermitidos as $permitido){
           //    echo "---".$permitido;
            $nuevoarray=$this->eliminardeArray($permitido, $nuevoarray);
        //    var_dump($nuevoarray);
        }
        return $nuevoarray;
    }
    public function eliminardeArray($valor, $codnoper){
       // echo "<br>borrando a ".$valor;
        //var_dump($codnoper);
        $pos=array_search($valor, $codnoper,false);
        
        if($pos>=0)
        {  
            //echo "<br>esta en ".$pos;
        array_splice($codnoper, $pos);
       // var_dump($codnoper);
        return $codnoper;
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
        	if(sizeof($listarestrin)>0)
        	$listarestrin=$this->dejarSoloFecha($listarestrin);
        	}
        	//echo "------------------<br>";
        	//	var_dump($listarestrin);
        	if(strlen($row2["lid_fechapermitida"])>1){
        	    $listaperm=explode(",", $row2["lid_fechapermitida"]);
        	    // 	echo "zzzzzzzzzzzzzzzzzzz<br>";
        	    // 	var_dump($listaperm);
        	    if(sizeof($listaperm)>0)
        	    $listaperm=$this->dejarSoloFecha($listaperm);
        	}
        	
        	//busco los codigos no perm
        	$codigos=$this->getCodigosNoPer($row2,$listaperm,$listarestrin,$indice);
         //   echo "<br>ooooooooooooooooooooooo";
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

