<?php

include 'Models/crud_geocercas.php';

class GeocercaServController
{
    public $puntos;
    public $regcve=array("1"=>"N",
        "2"=>"S",
        "3"=>"E",
        "4"=>"O",
        "5"=>"C"
        
    );
    
    
    //recibe el id de nivel 4 ciudad y devuel ve un arreglo con los puntos como lat, long
   
    
    public function buscarGeocercas($n4id){
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
    }
    
    public function buscarGeocercaxPlanta($idplanta){
        $idn4=0;
        $res=Datosncin::vistancinOpcionModel($idplanta,"ca_nivel5");
      
        //var_dump($res);
        foreach($res as $row){
            $idn4=$row["n5_idn4"];
        }
        $this->buscarGeocercas($idn4);
        
        
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
}

