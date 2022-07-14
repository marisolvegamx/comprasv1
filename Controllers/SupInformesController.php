<?php

class SupInformesController{
    
    public $idciudadres;

    public function vistaSupInformesController(){

        include "Utilerias/leevar.php";


        echo '<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 30%">SUPERVISOR</th>
                  <th style="width: 15%">INDICE</th>
                  <th style="width: 15%">CLIENTE</th>
                  <th style="width: 20%">PLANTA</th>
                  <th style="width: 20%">ESTATUS</th>
                </tr>';
  
        $gpousuario = $_SESSION['GrupoUs'];
        if ($gpousuario=="adm"){
        	//$condi= "";
        	//echo "entre a usuario admi";
        	//var_dump($supervisor);
        	if ($supervisor=="") {
        		$condi= "";  
        		
        	}else{
        	    
        	    $condi =" and idsup=".$supervisor; 
        	}
        	$this->numsup=$supervisor;	
        } else {
           // busca supervisor 
        	$logemail= $_SESSION['Usuario'];
        	// busca el email y lee el numero de sugetsupervisorpervisor
        	$resp =UsuarioModel::getsupervisor($logemail,"cnfg_usuarios");
        	foreach($resp as $row => $item){
        		$numsup= $item["cus_cliente"];
        	}	
        	$condi =" and idsup=".$numsup;
            $this->numsup=$condi;  
        }

         // echo $condi;          
        	// calcula la fechaactual
                if ( is_null($indiceinf)){
                   $fechaact=getdate();
                   $indiceinf=$fechaact["mon"]. ".".$fechaact["year"];
               }

			$respuesta =DatosSupInformes::vistaSupInfModel($condi, $indiceinf,"informes");
			foreach($respuesta as $row => $item){
				$id= $item["inf_id"];
				$cliente= $item["n1_nombre"];
				//$rec_id=$item["nomsup"];
				$mes_asig= $item["inf_indice"];
				$aux = explode(".", $mes_asig);
                       
          $solomes = $aux[0];
          $soloanio = $aux[1];
            
            switch ($solomes) {
              case 1:
                $mesnom="ENERO";
              break;
             case 2:
                $mesnom="FEBRERO";
              break;
             case 3:
                $mesnom="MARZO";
              break;   
             case 4:
                $mesnom="ABRIL";
              break;   
             case 5:
                $mesnom="MAYO";
              break;   
             case 6:
                $mesnom="JUNIO";
              break;   
             case 7:
                $mesnom="JULIO";
              break;   
             case 8:
                $mesnom="AGOSTO";
              break;   
             case 9:
                $mesnom="SEPTIEMBRE";
              break;   
             case 10:
                $mesnom="OCTUBRE";
              break;   
             case 11:
                $mesnom="NOVIEMBRE";
              break;   
             case 12:
                $mesnom="DICIEMBRE";
              break;
             }

          $mesasignacion = $mesnom." - ".$soloanio;

				$supervisorn= $item["nomsup"];
				$sup_id=$item["idsup"];
				$plan_id=$item["inf_plantasid"];

				$planta= $item["n5_nombre"];
				
				if ($item["totinf"]==$item["totestatus"]) {
					$nomestatus="green";
				} else {
					$nomestatus="red";
				}
           echo
            '  <tr>
	               <td>'.$supervisorn.'</td>
					<td>'.$mesasignacion.'</td>
					<td>'.$cliente.'</td>	
	                
	                
	                 <td>
	                    <a href="index.php?action=suplistatiendas&admin=li&idmes='.$mes_asig.'&idsup='.$sup_id.'&idplan='.$plan_id.'">'.$planta.'</a>
	                  </td>
					<td><i class="fa fa-circle fa-2x" style="color:red;"></i></td>
					';

	        }        

		}

public function vistaSupInformeComController(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];

       $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
      
	  $respuesta =DatosSupInformes::vistaSupInformeDetalleModel($datosCont, "informes");
			
			foreach($respuesta as $row => $item){
				$this->idinf= $item["inf_consecutivo"];
				$this->cliente= $item["n1_nombre"];

				$logemail= $_SESSION['Usuario'];
        	// busca el email y lee el numero de sugetsupervisorpervisor
        	$resp1 =UsuarioModel::getsupervisor($logemail,"cnfg_usuarios");
        	foreach($resp1 as $row => $item1){
        		$numsup1= $item1["cus_cliente"];
        	}
        		$this->numsup= $numsup1;


				$mes_asig= $item["inf_indice"];

				$aux = explode(".", $mes_asig);
                       
          		$solomes = $aux[0];
          		$soloanio = $aux[1];
            
            switch ($solomes) {
              case 1:
                $mesnom="ENERO";
              break;
             case 2:
                $mesnom="FEBRERO";
              break;
             case 3:
                $mesnom="MARZO";
              break;   
             case 4:
                $mesnom="ABRIL";
              break;   
             case 5:
                $mesnom="MAYO";
              break;   
             case 6:
                $mesnom="JUNIO";
              break;   
             case 7:
                $mesnom="JULIO";
              break;   
             case 8:
                $mesnom="AGOSTO";
              break;   
             case 9:
                $mesnom="SEPTIEMBRE";
              break;   
             case 10:
                $mesnom="OCTUBRE";
              break;   
             case 11:
                $mesnom="NOVIEMBRE";
              break;   
             case 12:
                $mesnom="DICIEMBRE";
              break;
             }

          $this->indice = $mesnom." - ".$soloanio;

				$this->recolector= $item["rec_nombre"];
				$this->planta= $item["n5_nombre"];
				$this->consec =$item["inf_consecutivo"];
				$this->vilocal =$item["inf_visitaslocal"];
				$idplan=$item["inf_plantasid"];
	    		$this->idplan= $idplan;
	    		//var_dump($idplan);
	        }  

	    
	    $respuesta2 =DatosSupvisita::vistaSupInfvisModel($datosCont, "visitas");
	    // asigna datos a variables
    	foreach($respuesta2 as $row => $item2){
			$this->nomplan= $item2["vi_unedesc"];
			$this->idtienda=$item2["vi_tiendaid"];
			$idcadena= $item2["vi_cadenacomercial"];
			$this->idcad = $idcadena;	
			$this->cadena= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",1,$idcadena);
			$idtipo= $item2["vi_tipotienda"];
			$this->idtip = $idtipo;
			$this->tipotienda=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",2,$idtipo); 
			$this->fecha= $item2["fecharep"];
			$this->hora= $item2["horarep"];
			$this->coord= $item2["vi_geolocalizacion"];
			$this->direc= $item2["vi_direccion"];
			$this->direc2= $item2["vi_direccion"];
			$this->complem2= $item2["vi_dirreferencia"];
			$idzona= $item2["vi_zona"];
			$this->idzona= $idzona;
			$this->zona=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",4,$idzona); 
			
			$this->complem= $item2["vi_complementodir"];
			$this->coment= $item2["inf_comentarios"];
	    }


			$respuesta3 =DatosUnegocio::consultaUnegocioModel($this->idtienda, "ca_unegocios");
	    // asigna datos a variables
				//var_dump($respuesta3);
    	foreach($respuesta3 as $row => $item3){
			$this->nomtienc= $item3["une_descripcion"];
			$idcadc= $item3["une_cadenacomercial"];
			//echo $idcadc;
			$this->idcadc=$idcadc;
			$this->cadenac= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",1,$idcadc);
			$this->idtipc= $item3["une_tipotienda"];
			//var_dump($this->idtipc);
			$this->tipotiendac=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",2,$this->idtipc); 
			//var_dump($this->tipotiendac);
			$this->coordc= $item3["une_coordenadasxy"];
			$this->direcc= $item3["une_direccion"];
			$this->idzonac= $item3["une_puntocardinal"];
			$this->zonac= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",4,$this->idzonac);
			$this->complemc= $item3["une_dir_referencia"];
			$this->idciudadres=$item3["une_cla_ciudad"];
			
	    }


}


public function getTiendasxindice($pais,$ciudad, $cadenacomercial,$unedescripcion,$planta,$indice,$cliente){
    
    
    $rs=$this->getUnegocioxFiltros3($pais, $ciudad, $planta, $indice, $cliente) ;
    
    return $rs;
    
}
public function getidsig(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
      
	 $respuesta =DatosSupInformes::vistaSigtiendaModel($datosCont, "informes");
			
	 foreach($respuesta as $row => $item){
	 	$ncons[]=$item["inf_id"];
	  }	
	  //$totreg=array_count_values($ncons);
	  if ($ncons){
	  	 $this->siginf=$ncons[0];  
	  } else {
	  	$this->siginf=0;
	  }
	  return $this->siginf;
}

public function getidant(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
      
	 $respuesta =DatosSupInformes::vistaAnttiendaModel($datosCont, "informes");
			
	 foreach($respuesta as $row => $item){
	 	$ncons[]=$item["inf_id"];
	  }	
	  //$totreg=array_count_values($ncons);
	  if ($ncons){
	  	 $this->siginf=$ncons[0];  
	  } else {
	  	$this->siginf=0;
	  }
	  return $this->siginf;
}


public function getidfirst(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
      
	 $respuesta =DatosSupInformes::vistaFirtstiendaModel($datosCont, "informes");
				
	 foreach($respuesta as $row => $item){
	 	$ncons[]=$item["inf_id"];
	  }	
	  //$totreg=array_count_values($ncons);
	  //var_dump($totreg);
	  if ($ncons){
	  	 $this->siginf=$ncons[0];
	  	 //var_dump($this->siginf);  
	  } else {
	  	$this->siginf=0;
	  }
	  return $this->siginf;
}


public function getidlast(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
      
	 $respuesta =DatosSupInformes::vistalasttiendaModel($datosCont, "informes");
			
	 foreach($respuesta as $row => $item){
	 	$ncons[]=$item["inf_id"];
	  }	
	 
	 // $totreg=array_count_values($ncons);
	  if ($ncons){
	     $this->siginf=$ncons[0];  
	  } else {
	  	$this->siginf=0;
	  }
	  return $this->siginf;
}

public function getcomplem2() {
      return $this->complem2;
}



public function getidplan() {
      return $this->idplan;
}

public function asdirec2() {
      return $this->direc2;
}
public function getidinf() {
      return $this->idinf;
}

public function getidmes() {
      return $this->mesas;
}

public function getidtien() {
      return $this->idtienda;
}

public function getidrec() {
      return $this->rec_id;
}
     
public function getdirec() {
      return $this->direc;
}

public function getidcad() {
      return $this->idcad;
}

public function getidtip() {
      return $this->idtip;
}

public function getidzona() {
      return $this->idzona;
}
public function getzona() {
      return $this->zona;
}

public function getcomplem() {
      return $this->complem;
}

public function getcoment() {
      return $this->coment;
}

public function getnomplan() {
      return $this->nomplan;
}

public function getcadena() {
      return $this->cadena;
}

public function gettipot() {
      return $this->tipotienda;
}

public function getfecha() {
      return $this->fecha;
}

public function gethora() {
      return $this->hora;
}

public function getnumsup() {
   return $this->numsup;
}

public function getcoord() {
      return $this->coord;
}

public function getidinforme() {
      return $this->idinf;
}

public function getcliente() {
      return $this->cliente;
    }

public function getindice() {
      return $this->indice;
    }
public function getrecolector() {
      return $this->recolector;
    }
public function getplanta() {
      return $this->planta;
    }
public function getconsec() {
      return $this->consec;
}

public function getnomtienc() {
      return $this->nomtienc;
}

public function getidcadcomc() {
      return $this->idcadc;
}

public function getnomcadcomc() {
	 // var_dump($this->cadenac);
      return $this->cadenac;
}

public function getidtipc() {
      return $this->idtipc;
}

public function gettipotiendac() {
	 // var_dump($this->tipotiendac);
      return $this->tipotiendac;
}
				
public function getcoordc() {
      return $this->coordc;
}

public function getdirecc() {
      return $this->direcc;
}

public function getidzonac() {
      return $this->idzonac;
}

public function getnomzonac() {
      return $this->zonac;
}

public function getnomcomplemc() {
      return $this->complemc;
}




public function editaInformeComController(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];


       $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
//var_dump($datosCont);
$respuesta =DatosSupvisita::vistaSupInfvisModel($datosCont, "visitas");
	    // asigna datos a variables
//var_dump($respuesta);
    	foreach($respuesta as $row => $item2){
			$this->nomplan= $item2["vi_unedesc"];
			$this->idcad= $item2["vi_cadenacomercial"];	
			$this->cadena= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",1,$idcad);
			$this->idtip= $item2["vi_tipotienda"];
			$this->tipotienda=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",2,$idtip); 
			$this->idtien=$item2["vi_tiendaid"];
			$this->fecha= $item2["fecharep"];
			$this->hora= $item2["horarep"];
			$this->coord= $item2["vi_geolocalizacion"];
			$this->direc= $item2["vi_direccion"];
			$idzona= $item2["vi_zona"];
			$this->zona= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",4,$idzona);
		
			$this->complem= $item2["vi_complementodir"];
			$this->coment= $item2["inf_comentarios"];
	    }

	}
	
public function editacatalogoController(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
     $tien_id=$_GET["idtien"];
//var_dump($tien_id);


$respuesta3 =DatosUnegocio::consultaUnegocioModel($tien_id, "ca_unegocios");
	    // asigna datos a variables
//var_dump($respuesta3);
    	foreach($respuesta3 as $row => $item3){
			$this->nomtienc= $item3["une_descripcion"];
			$this->idcadc= $item3["une_cadenacomercial"];	
			$this->cadenac= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",1,$this->idcadc);
			$this->idtipc= $item3["une_tipotienda"];
			$this->tipotiendac=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",2,$this->idtip); 
			$this->coordc= $item3["une_coordenadasxy"];
			$this->direcc= $item3["une_direccion"];
			$this->idzonac= $item3["une_puntocardinal"];
			$this->zonac= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",4,$this->idzonac);
			$this->complemc= $item3["une_dir_referencia"];
		
	    }

	}


public function SuplistaTiendasController(){
     $this->idplan=$_GET["idplan"];
     $this->idmes=$_GET["idmes"];
     $this->idsup=$_GET["idsup"];


       $datosCont= array("idplan"=>$this->idplan,
                         "idmes"=>$this->idmes,
                         "idsup"=>$this->idsup,
                     );
    //   var_dump($datosCont);
  $respuesta =DatosSupvisita::vistaSuplistatiendasModel($datosCont, "visitas");
  
   foreach($respuesta as $row => $item){
				$idtienda= $item["inf_id"];
				$mes_asig= $item["inf_indice"];
				$id= $item["inf_id"];
				
				$aux = explode(".", $mes_asig);
                       
          $solomes = $aux[0];
          $soloanio = $aux[1];
            
            switch ($solomes) {
              case 1:
                $mesnom="ENERO";
              break;
             case 2:
                $mesnom="FEBRERO";
              break;
             case 3:
                $mesnom="MARZO";
              break;   
             case 4:
                $mesnom="ABRIL";
              break;   
             case 5:
                $mesnom="MAYO";
              break;   
             case 6:
                $mesnom="JUNIO";
              break;   
             case 7:
                $mesnom="JULIO";
              break;   
             case 8:
                $mesnom="AGOSTO";
              break;   
             case 9:
                $mesnom="SEPTIEMBRE";
              break;   
             case 10:
                $mesnom="OCTUBRE";
              break;   
             case 11:
                $mesnom="NOVIEMBRE";
              break;   
             case 12:
                $mesnom="DICIEMBRE";
              break;
             }

          $mesasignacion = $mesnom." - ".$soloanio;

				$idzona= $item["une_puntocardinal"];
				$nomtien= $item["une_descripcion"];
				$idtipot=$item["une_tipotienda"];
				$idrec=$item["inf_usuario"];

 				
				// busca supervisor
				$resp=DatosCatalogoDetalle::listaCatalogoDetalleOpc(2, $idtipot,"ca_catalogosdetalle");
				$tipot=$resp["cad_descripcionesp"];

				$resp3=DatosCatalogoDetalle::listaCatalogoDetalleOpc(4, $idzona,"ca_catalogosdetalle");
				$zona=$resp3["cad_descripcionesp"];



				if ($item["infestatus"]==2) {
					$nomestatus="yellow";
				} else if ($item["infestatus"]==3) {
					$nomestatus="green";
				} else if ($item["infestatus"]==4) {
					$nomestatus="red";
				} else {
					$nomestatus="white";
				}
           echo
            '  <tr>
	               
					<td>
	                    <a href="index.php?action=supinforme&idmes='.$mes_asig.'&idrec='.$idrec.'&id='.$id.'">'.$idtienda.'</a>
	                  </td>
	                  
					<td>
					 <a href="index.php?action=supinforme&idmes='.$mes_asig.'&idrec='.$idrec.'&id='.$id.'">'.$tipot.'</a></td>               
	                <td> <a href="index.php?action=supinforme&idmes='.$mes_asig.'&idrec='.$idrec.'&id='.$id.'">'.$zona.'</a></td>
	                 
					<td><i class="fa fa-circle fa-2x" style="color:'.$nomestatus.';"></i></td>
					';

	        }        

 }

 public function actualizadir(){
		
	include "Utilerias/leevar.php";
      
	try{
         // echo "entre a direccion";
		$regresar="index.php?action=supinforme&idmes=".$indice."&idrec=".$idrec."&id=".$id;

		$datosController= array("numtien"=>$numtien,
                                "dirtien"=>$direc,
                                "compdir"=>$compdir,
                               );
		
		//var_dump($datosController); 
		DatosSupInformes::ActualizaSupDirtienda($datosController, "ca_unegocios");
		// pregunta de direccion


		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}
		
	
	}

public function actualizar(){
		
	include "Utilerias/leevar.php";
      
	try{
       //echo "entre a actualizar la direccion";
		$regresar="index.php?action=supinforme&idmes=".$indice."&idrec=".$idrec."&id=".$id;

		$datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"nomtien"=>$nomtien,
								"cadcom"=>$cadcomuneg,
      						    "tipotien"=>$tipouneg,
      						    "numtien"=>$numtien,
                                "cxy"=>$cxy,
                                "zona"=>$zona,
                                "dirtien"=>$dirtien,
                                "compdir"=>$compdir,
                                "coment"=>$coment,
                               );
		
		//var_dump($datosController); 
		DatosSupInformes::ActualizaSuptienda($datosController, "informes");
		// pregunta de direccion

		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}

}


public function actualizarc(){
		
	include "Utilerias/leevar.php";
      
	try{
       //echo "entre a actualizar la direccion";
		$regresar="index.php?action=supinforme&idmes=".$indicec."&idrec=".$idrecc."&id=".$numtienc;

		$datosController= array("ntien"=>$idtienc,
								"nomtienc"=>$nomtienc,
								"cadcom"=>$cadcomunegc,
      						    "tipotien"=>$tipounegc,      						    
                                "cxy"=>$cxyc,
                                "zona"=>$zonac,
                                "dirtien"=>$dirtienc,
                                "compdir"=>$compdirc,
                               );
		
		//var_dump($datosController); 
		DatosUnegocio::actualizarSupUnegocio($datosController, "ca_unegocios");
		// pregunta de direccion

		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}

}




public function aceptarsec1(){
		
	include "Utilerias/leevar.php";
      
	try{
       //echo "entre a solicitar correccion";
		$regresar="index.php?action=supinforme02&idmes=".$indice."&idrec=".$idrec."&id=".$id;
	    //echo $regresar;
		if ($admin=="aceptar"){
			// valido calificacion
			//var_dump($radio1);

	
		   //	var_dump($SI);
		   // busca si el registro ya existe
		   $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
                               );
		
		   $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

		   if (sizeof($respuesta)>0) {
		   //echo "lo encontre";
		   	 	foreach($respuesta as $row => $item){
					$idval= $item["val_id"];
				}
	           //echo $idval;
		   	  // actualiza validacion
		   	  $datosController= array("idval"=>$idval,
								"idsec"=>1,
								"idaprob"=>1,
								"observ"=>"",
								"estatus"=>2,
                               );
		   	  //var_dump($datosController);
				DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");

		   }else {
		       echo "no hay nada"; 	
		       // inserta validacion
		       		$datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
								"estatus"=>1,
                               );

		       // inserta validacion detalle
		       DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
		       // busca numero de validacion
		       $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
                               );
		
		   		$respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

				   if (sizeof($respuesta)>0) {
				   	 	foreach($respuesta as $row => $item){
							$idval= $item["val_id"];
						}
					}	


					$datosController= array("idval"=>$idval,
											"idsec"=>1,
											"descrip"=>"ubicacion de la tienda",
											"idaprob"=>1,
											"noap"=>0,
											"observ"=>"",
											"estatus"=>2,
			                             );

				DatosValidacion::insertaValidacionsec($datosController, "sup_validasecciones");
		   }
		   //var_dump($respuesta);

		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
      }

	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}			
}


public function noaceptarsec1(){
		
	include "Utilerias/leevar.php";
      
	try{

		if ($cancelar){
			$estatus=3;

		} else {
			$estatus=1; 
		}
       //echo "entre a solicitar correccion";
		$regresar="index.php?action=supinforme&idmes=".$indice."&idrec=".$idrec."&id=".$id;
	    //echo $regresar;
		if ($admin=="cor"){
		   // busca si el registro ya existe
		   $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
                               );
		
		   $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

		   if (sizeof($respuesta)>0) {
		   //echo "lo encontre";
		   	 	foreach($respuesta as $row => $item){
					$idval= $item["val_id"];
				}
	           //echo $idval;
		   	  // actualiza validacion
		   	  $datosController= array("idval"=>$idval,
								"idsec"=>1,
								"idaprob"=>0,
								"observ"=>$solicitud,
								"estatus"=>$estatus,
                               );
		   	  //var_dump($datosController);
				DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");

				if ($estatus==3){
					DatosValidacion::actualizaValidacionpr($datosController,"sup_validacion");
				}
		   }else {
		       //echo "no hay nada"; 	
		       // inserta validacion
		       		$datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
								"estatus"=>1,
                               );

		       // inserta validacion detalle
		       DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
		       // busca numero de validacion
		       $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
                               );
		
		   		$respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

				   if (sizeof($respuesta)>0) {
				   	 	foreach($respuesta as $row => $item){
							$idval= $item["val_id"];
						}
					}	


					$datosController= array("idval"=>$idval,
											"idsec"=>1,
											"descrip"=>"ubicacion de la tienda",
											"idaprob"=>0,
											"noap"=>0,
											"observ"=>$solicitud,
											"estatus"=>$estatus,
			                             );

				DatosValidacion::insertaValidacionsec($datosController, "sup_validasecciones");
		   }
		   //var_dump($respuesta);

		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
      }

	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}			
}


public function noaplicasec1(){
		
	include "Utilerias/leevar.php";
      
	try{

		$estatus=1; 
		
       //echo "entre a solicitar correccion";
		$regresar="index.php?action=supinforme&idmes=".$indice."&idrec=".$idrec."&id=".$id;
	    //echo $regresar;
		if ($admin=="noap"){
		   // busca si el registro ya existe
		   $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
                               );
		
		   $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

		   if (sizeof($respuesta)>0) {
		   //echo "lo encontre";
		   	 	foreach($respuesta as $row => $item){
					$idval= $item["val_id"];
				}
	           //echo $idval;
		   	  // actualiza validacion
		   	  $datosController= array("idval"=>$idval,
								"idsec"=>1,
								"idaprob"=>0,
								"observ"=>"",
								"estatus"=>$estatus,
                               );
		   	  //var_dump($datosController);
				DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");

				
		   }else {
		       //echo "no hay nada"; 	
		       // inserta validacion
		       		$datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
								"estatus"=>1,
                               );

		       // inserta validacion detalle
		       DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
		       // busca numero de validacion
		       $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"idplan"=>$idplan,
                               );
		
		   		$respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

				   if (sizeof($respuesta)>0) {
				   	 	foreach($respuesta as $row => $item){
							$idval= $item["val_id"];
						}
					}	


					$datosController= array("idval"=>$idval,
											"idsec"=>1,
											"descrip"=>"ubicacion de la tienda",
											"idaprob"=>0,
											"noap"=>1,
											"observ"=>"",
											"estatus"=>$estatus,
			                             );

				DatosValidacion::insertaValidacionsec($datosController, "sup_validasecciones");
		   }
		   //var_dump($respuesta);

		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
      }

	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}			
}

public function getUnegocioxFiltros3($pais,$ciudad, $planta,$indice,$cliente){
    
    
    $sql="select cu.une_id,une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad,
 une_estatus, une_coordenadasxy, une_puntocardinal,
str_to_date(concat('01.', vi_indice ),'%d.%m.%Y') as fec,
une_tipotienda, une_cadenacomercial, une_estatus
 from ca_unegocios cu
inner join visitas on vi_tiendaid=cu.une_id
 inner join informes i on i.inf_visitasIdlocal =vi_idlocal
and vi_cverecolector=i.inf_usuario  and vi_indice=i.inf_indice ";
    // agregando filtros
    if(isset($planta)&&$planta!="") {
        $sql.=" and inf_plantasid=:planta";
        
    }
    $sql.="   where  vi_indice=:fechafin ";
    
    // $sql.=" left join ca_nivel5 on n5_id=inf_plantasid
    //where  une_cla_ciudad=:ciudad ";
    //and une_cla_pais=:pais";
    
    // agregando filtros
    $sql.="  group by cu.une_id";
    //    echo $sql;
    $stmt = Conexion::conectar()-> prepare($sql." order by une_descripcion" );
    //   $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
    // $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
    
    
    $stmt-> bindParam(":fechafin", $indice, PDO::PARAM_STR);
    
    if(isset($planta)){
        
        if($planta!="") {
            
            $stmt-> bindParam(":planta", $planta, PDO::PARAM_STR);
        }
    }
    /* if(isset($cadenacomercial)){
    
    if($cadenacomercial!="") {
    
    $stmt-> bindParam(":cadena", $cadenacomercial, PDO::PARAM_STR);
    }
    }
    if(isset($pais)){
    
    if($pais!="") {
    
    $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
    }
    }
    */
    
    $stmt->execute();
  //   $stmt->debugDumpParams();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
