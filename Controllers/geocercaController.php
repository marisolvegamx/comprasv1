<?php


include 'Models/crud_geocercas.php';

class GeocercaController {
	
	public $ciudad;
	public $regiones;
//	public $admin;
	public $puntos;
	public $listageo;
	public $isedit;
	
	private $db;
	
	public $arrreg=array("N"=>"Norte",
	                     "S"=>"Sur",
	                     "E"=>"Este",
	                     "O"=>"Oeste",
	                     "C"=>"Centro"
	    
	);
	public $regcve=array("1"=>"N",
	    "2"=>"S",
	    "3"=>"E",
	    "4"=>"O",
	    "5"=>"C"
	    
	);
	public function __construct(){
	    $this->db=new DatosGeocercas();
	}
	
	public function vistaNuevo(){
		include "Utilerias/leevar.php";
		if(isset($admin)){
		if($admin=="eliminar"){
		    $this->eli();
		    return;
		    
		}else
		if($admin=="insertar"){
			$this->insertar();
			return;
		
		}}else{
		
		    //veo si ya existen las regiones
		    $puntos=DatosGeocercas::vistaGeocercaModel($n4id,"ca_geocercas");
		    if(sizeof( $puntos)>0){
		        $this->isedit=true;
		        foreach($puntos as $reg){
		            $res=array();
		         //  var_dump($reg);
		            $res[]= $this->crearCoordenada($reg["geo_p1"]);
		            $res[]= $this->crearCoordenada($reg["geo_p2"]);
		            $res[]= $this->crearCoordenada($reg["geo_p3"]);
		            $res[]= $this->crearCoordenada($reg["geo_p4"]);
		            
		            $this->puntos[$this->regcve[$reg["geo_region"]]]=$res;
		        }
		      //  print_r($this->puntos);
		      //  echo json_encode($this->puntos);
		      /*  [
		        { lat: 25.774, lng: -80.19 },
		        { lat: 18.466, lng: -66.118 },
		        { lat: 32.321, lng: -64.757 },
		        { lat: 25.774, lng: -80.19 },
		        ]*/
		    }
		    
			$this->regiones="";	
		   // $res=Datosncua::vistaN4opcionModel($n4id, "ca_nivel4");
			$res=DatosCiuResidencia::editaciuresModel($n4id, "ca_ciudadesresidencia");
		    
		   // var_dump($res);
		    foreach($res as $reg){
			     $this->ciudad=$reg["ciu_descripcionesp"];
		    }
			$this->listar();
			//lleno las regiones
			foreach ( $this->arrreg as $key=>$reg){
			    $this->regiones.= "<option value='" . $key . "' >"
			        . $reg . "</option>";
			
		      }
		}
	}
	
	public function crearCoordenada($reg){
	    $aux=explode(',',$reg);
	   // $coor["lat"]=$aux[0];
	    //$coor["lng"]=$aux[1];
	    settype($aux[0], 'float') ;
	    settype($aux[1], 'float');
	    $coor["lat"]=$aux[0];
	    $coor["lng"]=$aux[1];
	   // echo "<br>++++";
	    //var_dump($coor);
	    return $coor;
	}


	public function insertar(){

		//include "Utilerias/leevar.php";
		try{
		  //  var_dump($_POST);
		    $puntos=$_POST["puntos"];
		    //var_dump($geocerca);
		    foreach($puntos as $geocerca)
		    { if(isset($geocerca["geo_id"])&&$geocerca["geo_id"]>0)//ya existe es edicion
		    
				$resultado=$this->db->actualizarGeocerca($geocerca, "ca_geocercas");
		    else //es nuevo
		    $resultado=$this->db->insertarGeocerca($geocerca, "ca_geocercas");
		  //  echo ">>>".$resultado;
		    }
		    if($resultado){
		        echo "se guardó bien";
		    }
	     }catch(Exception $ex){
		echo $ex->getMessage();
	     }
	}
	
	
	
	public function eli(){
		include "Utilerias/leevar.php";
		try{
		    if($geo_id>0)
		        $this->db->eliminarGeocerca($geo_id, "ca_geocercas");
		    echo "Se eliminó correctamente";
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	public function listar(){
	    include "Utilerias/leevar.php";
	//echo "listando".$n4id;
	    //llega la ciudad
	    if($n4id>0){
	        $this->listageo=$this->db->vistaGeocercaModel($n4id, "ca_geocercas");
	    }
	}
}

