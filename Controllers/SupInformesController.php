<?php

class SupInformesController{

  public $i;
    
    public $idciudadres;

    public function vistaSupInformesController(){

        include "Utilerias/leevar.php";


        echo '<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 30%">SUPERVISOR</th>
                  <th style="width: 15%">INDICE</th>
                  
                  <th style="width: 20%">CIUDAD</th>
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
        	   $condi =" and n5_supervisor=".$supervisor; 
        	    //$condi =" and idsup=".$supervisor; 
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
        	//$condi =" and idsup=".$numsup;
          $condi =" and n5_supervisor=".$numsup;

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
				//$id= $item["inf_id"];
				$id_sup= $item["id_sup"];
        $nomsup= DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",18,$id_sup);
        $nomciudad5=$item["id_ciudad"];
        $id_ciu= $item["numciu"];

        //$respuesta5=Datosncua::vistaN4opcionModel($id_ciu, "ca_nivel4");
        //$nomciudad5= $respuesta5["nomciudad"];
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

				
				$sup_id=$item["idsup"];
				

				
				
				if ($item["val_estatus"]) {
            if ($item["val_estatus"]==1) {
                $nomestatus="yellow";    
            } else if ($item["val_estatus"]==2){
                $nomestatus="green";
            } else if ($item["val_estatus"]==3){
					       $nomestatus="red";
            }     
				} else {
					$nomestatus="blue";
				}
           echo
            '  <tr>
	               <td>'.$nomsup.'</td>
					<td>'.$mesasignacion.'</td>        
          <td>'.$nomciudad5.'</td>        
           <td>
              <a href="index.php?action=suplistaetapas&admin=li&idmes='.$mes_asig.'&idsup='.$id_sup.'&idciu='.$nomciudad5.'&eta=2&idc='.$id_ciu.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestatus.';"></i></a>
            </td>	';
	        }        

		}


public function SuplistaEtapasController(){
// busca encabezados de plantas
  $this->idciu=$_GET["idciu"];
  $this->idmes=$_GET["idmes"];
  $this->idsup=$_GET["idsup"];

  $enc_prin='<th>NOMBRE </th>';
  $enc_tot='<th ></th>';
  $nt=0;
   //$i=6;
   var_dump($i);
    for ($i=4; $i<=6; $i=$i+1) {
    $datosCont= array("idciu"=>$this->idciu,
                      "idcli"=>$i,
                     );
    //}
    //var_dump($datosCont);
    $resp0 =DatosSupInformes::BuscaEncabezadoPlanta($datosCont, "ca_nivel5");
    $nr=0;
    foreach($resp0 as $row => $item0){
        $planta= $item0["n5_nombre"];
             $enc_cli = '<th >'.$planta.'</th>'; 
             $cliente=$item0["n1_nombre"];
             $enc_tot=$enc_tot.$enc_cli;
             $nr=$nr+1;
    }
     $nt=$nt+$nr;

    $enc_prin=$enc_prin.'<th colspan="'.$nr.'" style="background-color: #cccccc;"> '.$cliente.' </th>';

  }

  echo $enc_prin;
  echo '<tr>'.$enc_tot.'</tr>';
                  
        //r_dump($datosCont);
$respetapas=DatosCatalogoDetalle::listaCatalogoDetalleAsc(19, "ca_catalogosdetalle");


foreach($respetapas as $row => $item){
        $numetapa= $item["cad_idopcion"];
        $nometapa= $item["cad_descripcionesp"];

    if ($numetapa == 1){
       for ($i=4; $i<=6; $i=$i+1) {
          $datosCont= array("idciu"=>$this->idciu,
                            "idcli"=>$i,
                           );
          //}
          //var_dump($datosCont);
          $resp0 =DatosSupInformes::BuscaEncabezadoPlanta($datosCont, "ca_nivel5");
          
          foreach($resp0 as $row => $item0){
              $idplan= $item0["n5_id"];
              $idcli =$item0["n1_id"];

                   $enc_cli = '<td align="center">
           <a href="index.php?action=suppreparacion&idmes='.$this->idmes.'&idrec=1&idplan='.$idplan.'&cli='.$idcli.'&numdet=1&eta=1"><i class="fa fa-circle fa-2x" style="color:'.$nomestatus.';"></i></a>
</td>  '; 

                //echo $enc_cli;
                $enc_tot1=$enc_tot1.$enc_cli;
                   
              }
           

          //$enc_prin=$enc_prin.'<th colspan="'.$nr.'" style="background-color: #cccccc;"> '.$cliente.' </th>';

        }
    }



  // presenta compra 
       $datosCont= array("idciu"=>$this->idciu,
                         "idmes"=>$this->idmes,
                         "idsup"=>$this->idsup,
                     );

    


    //presenta compra
    if ($numetapa==2) {

    }          
  $respuesta =DatosSupvisita::vistaSuplistacomprasModel($datosCont,"informes");
  
   foreach($respuesta as $row => $item1){
          //calcula tienda
         
           if ($item1["estatus"]>0) {
             if ($item1["totinf"]==$item1["estatus"]) {
               $nomesttien="green";
             } else {
               $nomestien="yellow"; 
             }   
           } else {
              $nomesttien="blue";
           }
    }
           echo
           '  <tr>      
          <td>'.$nometapa.'</td>';
          if  ($numetapa==1) {
            echo $enc_tot1;
           }
          if ($numetapa==2) {
            echo '
          <td colspan='.$nt.' align="center">
           <a href="index.php?action=suplistatiendas&admin=li&idmes='.$this->idmes.'&idsup='.$this->idsup.'&idciu='.$this->idciu.'&eta='.$numetapa.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestatus.';"></i></a>
</td>  ';
          }else{
            echo '
          <td colspan='.$nt.'> </td>  ';
          }

        //if ($item["pena"]>0) {
        //    echo '
        //  <td>
        //   <a href="index.php?action=suplistatiendas&admin=li&idmes='.$this->idmes.'&idsup='.$this->idsup.'&idciu='.$this->idciu.'&eta='.$numetapa.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestatus.';"></i></a>
//</td>  ';
  //        }else{
    //        echo '
      //    <td> </td>  ';
        //  }

        //if ($item["elec"]>0) {
        //    echo '
        //  <td>
        //   <a href="index.php?action=suplistatiendas&admin=li&idmes='.$this->idmes.'&idsup='.$this->idsup.'&idciu='.$this->idciu.'&eta='.$numetapa.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestatus.';"></i></a>
//</td>  ';
  //        }else{
    //        echo '
    //      <td> </td>  ';
    //      }

    }        

 }



public function vistaSupInformeComController(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
     $this->sec=$_GET["sec"];
     $this->eta=$_GET["eta"];
     $this->idsup=$_GET["idsup"];
     $this->idciu=$_GET["idciu"];
     //include "Utilerias/leevar.php";

       $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                               );
      
	  $respuesta =DatosSupInformes::vistaSupInformeDetalleModel($datosCont, "informes");
			//var_dump($respuesta);
			foreach($respuesta as $row => $item){
				$this->consec= $item["inf_consecutivo"];
         $this->numsup=$item["n5_supervisor"];
				$this->cliente= $item["n5_idn1"];
				$this->visid=$item["inf_visitasIdlocal"];
			//	$this->idrec=$item["inf_+usuario"];
				$logemail= $_SESSION['Usuario'];
        //var_dump($logemail);
        	// busca el email y lee el numero de sugetsupervisorpervisor
        	$resp1 =UsuarioModel::getsupervisor($logemail,"cnfg_usuarios");
        	foreach($resp1 as $row => $item1){
        		$numsup1= $item1["cus_cliente"];

        	}
        	//die($this->visid);
        		//$this->numsup= $numsup1;
            

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
        $this->dirimagen = $solomes."_".$soloanio; 
				$this->recolector= $item["rec_nombre"];
			    }  

	    
	    $respuesta2 =DatosSupvisita::vistaSupInfvisModel($datosCont, "visitas");
	    // asigna datos a variables
    	foreach($respuesta2 as $row => $item2){
			$this->nomplan= $item2["vi_unedesc"];
      //$this->consec= $item2["vi_idlocal"];
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
			//$this->direc2= $item2["vi_direccion"];
			//$this->complem2= $item2["vi_complementodir"];
			$idzona= $item2["vi_zona"];
			$this->idzona= $idzona;
			$this->zona=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",4,$idzona); 
			
			$this->complem= $item2["vi_complementodir"];
			$this->coment= $item2["inf_comentarios"];
      $this->fotof=$item2["vi_fotofachada"];
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
      // BUSCA NOMBRE CIUDAD
     // $this->nomciudadres=Datosncin::getnombreNivel5($this->idciudadres,"ca_nivel5");
			$resp=DatosCiuResidencia::editaciuresModel($this->idciudadres,"ca_ciudadesresidencia");
			
			foreach($resp as $row)
			{    $this->nomciudadres=trim($row["ciu_descripcionesp"]," ");
			}
			$this->fotofacc= $item3["une_fotofachada"];
	    }
      // lee imagenes de informe
      //$this->eta="2";
        $datosCont2= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "ideta"=>$this->eta,
                         "idsec"=>$this->sec,
      ); 
        //var_dump($datosCont2);
        $respuesta4 =DatosValidacion::LeeEstatusSec($datosCont2, "sup_validacion");
        //var_dump($respuesta4);
        foreach($respuesta4 as $row => $item4){
       
            $resnoap= $item4["vas_noaplica"];
            if ($resnoap==0){
              $resacep= $item4["vas_aprobada"];
              if ($resacep==0){
                 $this->opcsel=3; 
              } else {

                $this->opcsel=1;
              }
            } else {
              $this->opcsel=2;
            }  
        }


        $datosCont3= array("idinf"=>$this->fotof,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
      );

      //var_dump($datosCont2);
      $respuesta4 =DatosImgInformes::vistaImgInfModel($datosCont3, "imagen_detalle");
      foreach($respuesta4 as $row => $item4){
         $this->nombreimg= $item4["imd_ruta"];
      }
      //busca foto fachada de catalogo;
      $datosCont5= array("idinf"=>$this->fotofacc,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
      );
      $respuesta5 =DatosImgInformes::vistaImgInfModel($datosCont5, "imagen_detalle");

      foreach($respuesta5 as $row => $item5){
         $this->nomfotofacc= $item5["imd_ruta"];
      }
     // echo $this->visid;
      // busca imagen de ticket catalogo
     $datosCont6= array("numvis"=>$this->visid,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
      ); 
    // die($this->visid);
      //  var_dump($datosCont6);
      $respuesta6 =DatosSupInformes::leeticketinforme($datosCont6, "informes");  
     // var_dump($respuesta6);
     $i=0;
        foreach($respuesta6 as $row => $item6){
          $nimg=$item6["inf_ticket_compra"];
          $ncli=$item6["cliente"];
        
    //$totreg=array_count_values($ncons);
    
         if ($nimg>0){
           //  echo "****".$nimg[$i];
             $this->nimgs=$nimg[$i];
             $this->nclis=$ncli[$i]; 
             break;
          }
          $i++;
        }
        
      $datosCont7= array("idinf"=>$this->nimgs,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         //"iddesc"=>$this->"ticket compra",
       ); 
      //var_dump($datosCont7);
      $respuesta7=DatosImgInformes::vistaImgInfModel($datosCont7, "imagen_detalle");

      foreach($respuesta7 as $row => $item7){
         $this->nomimgticketf= $item7["imd_ruta"];
      }

      //var_dump($this->nomimgticketf);
      $datosCont8= array("idinf"=>$this->idtienda,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idcli"=>$this->nclis,                    
       );
      //var_dump($datosCont8);
      $respuesta8=DatosValidacion::LeeImgticket($this->idtienda,$this->rec_id,$this->mesas, "ca_uneimagenes"); 
      //var_dump($respuesta8);
        foreach($respuesta8 as $row => $item8){
           $this->numimgtik= $item8["ui_ticket"];
         
      }
      //var_dump($this->numimgtik);

        $datosCont2= array("idinf"=>$this->numimgtik,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
       ); 
      $respuesta4 =DatosImgInformes::vistaImgInfModel($datosCont2, "imagen_detalle");
      foreach($respuesta4 as $row => $item4){
         $this->nomimgticket= $item4["imd_ruta"];
      }
      
     $datosCont3= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "ideta"=>$this->eta,
                         "idfoto"=>$this->fotof,
      );
      // var_dump($datosCont3);
      $respuesta5 =DatosValidacion::LeeEstatusFoto($datosCont3, "sup_validacion");
        //var_dump($respuesta4);
        foreach($respuesta5 as $row => $item5){
            $this->estfot= $item5["vai_estatus"];      
        }
}


public function getTiendasxindice($pais,$ciudadres, $cadenacomercial,$unedescripcion,$planta,$indice,$recolector){
    
    
    $rs=$this->getUnegocioxFiltros3($pais, $ciudadres, $planta, $indice,$recolector) ;
    
    return $rs;
    
}
public function getidsig(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
     $this->sup_id=$_GET["idsup"];
     $this->ciu_id=$_GET["idciu"];



    $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idsup"=>$this->sup_id,
                         "idciu"=>$this->ciu_id,
                               );
    //var_dump($datosCont);
	 $respuesta =DatosSupInformes::vistaSigtiendaModel($datosCont, "informes");
			
;	 foreach($respuesta as $grow => $item){
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
     $this->idciu=$_GET["idciu"];
     $this->sup_id=$_GET["idsup"];


     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idsup"=>$this->sup_id,
                         "idciu"=>$this->idciu,
                               );
	 $respuesta1 =DatosSupInformes::vistaAnttiendaModel($datosCont, "informes");
		//var_dump($respuesta1);	
	 foreach($respuesta1 as $row => $item1){
	 	$ncons1[]=$item1["inf_id"];
	  }
    //var_dump($ncons1);	
	  //$totreg=array_count_values($ncons);
	  if ($ncons1){
	  	 $this->antinf=$ncons1[0];  
	  } else {
	  	$this->antinf=0;
	  }
    //var_dump($this->antinf);
	  return $this->antinf;
}


public function getidfirst(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
      $this->sup_id=$_GET["idsup"];
       $this->ciu_id=$_GET["idciu"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idsup"=>$this->sup_id,
                         "idciu"=>$this->ciu_id,
                               );
      
	 $respuesta =DatosSupInformes::vistaFirtstiendaModel($datosCont, "informes");
			//var_dump($respuesta);	
	 foreach($respuesta as $row => $item){
	 	$ncons[]=$item["ID"];
	  }	
	  //$totreg=array_count_values($ncons);
	  //var_dump($totreg);
	  if ($ncons){
	  	 $this->first=$ncons[0];
	  	 //var_dump($this->siginf);  
	  } else {
	  	$this->first=0;
	  }
   //    var_dump($this->first);
	  return $this->first;
}


public function getidlast(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
    $this->sup_id=$_GET["idsup"];
       $this->ciu_id=$_GET["idciu"];

  $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idsup"=>$this->sup_id,
                         "idciu"=>$this->ciu_id,
                               );
   //var_dump($datosCont);   
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

public function getnomciudad() {
      return $this->nomciudadres;
}

public function getnumimgtkt() {
      return $this->numimgtik;
}

public function getopcsel() {
  return $this->opcsel;
}

public function getnumtkt() {
  return $this->nimgs;
}


public function getnomticket() {
  return $this->nomimgticket;
}

public function getnomticketf() {
  return $this->nomimgticketf;
}

public function getnomfotofacc() {
  return $this->nomfotofacc;
}



public function getcomplem2() {
      return $this->complem2;
}

public function getdescest() {
      return $this->descest;
}

public function getfotofacc() {
      return $this->fotofacc;
}

public function getestfot() {
      return $this->estfot;
  }

public function getdirimagen() {
      return $this->dirimagen;
}
public function getidplan() {
      return $this->idplan;
}

public function asdirec2() {
      return $this->direc2;
}
//public function getidinf() {
//      return $this->idinf;
//}

public function getfotof() {
     return $this->fotof;
}

public function getrutaimg() {
     return $this->rutaimg;
}

public function getnombreimg() {
     return $this->nombreimg;
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
      //$this->fotofacc= $item3["une_fotofachada"];
		
	    }

	}


public function SuplistaTiendasController(){
     $this->idciu=$_GET["idciu"];
     $this->idmes=$_GET["idmes"];
     $this->idsup=$_GET["idsup"];
     $this->ideta=$_GET["eta"];


       $datosCont= array("idciu"=>$this->idciu,
                         "idmes"=>$this->idmes,
                         "idsup"=>$this->idsup,
                     );
    //var_dump($datosCont);
  $respuesta =DatosSupvisita::vistaSuplistatiendasModel($datosCont, "visitas");
  //var_dump($respuesta);
   foreach($respuesta as $row => $item){
				$idtienda= $item["vi_tiendaid"];
				$mes_asig= $item["inf_indice"];
                $idvis=$item["vi_idlocal"];
				$id= $item["ID"];
				
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

				//$idzona= $item["une_puntocardinal"];
				$nomtien= $item["vi_unedesc"];
				//$idtipot=$item["une_tipotienda"];
				$idrec=$item["vi_cverecolector"];

 				
				// busca supervisor
				//$resp=DatosCatalogoDetalle::listaCatalogoDetalleOpc(2, $idtipot,"ca_catalogosdetalle");
				//$tipot=$resp["cad_descripcionesp"];

				//$resp3=DatosCatalogoDetalle::listaCatalogoDetalleOpc(4, $idzona,"ca_catalogosdetalle");
				//$zona=$resp3["cad_descripcionesp"];

          //calcula tienda
         
				   if ($item["EST"]==1) {
					    $nomesttien="yellow";
				   } else if ($item["EST"]==2) {
					     $nomesttien="green";
				   } else if ($item["EST"]==3) {
					     $nomestien="red";  
			   } else {
					   $nomesttien="blue";
				  }



          // busca estatus de informes pepsi
           $datosContPEP= array("idmes"=>$this->idmes,
                         "idinf"=>$id,
                         "idrec"=>$this->idrec,
                         "ideta"=>$this->ideta,
                         "idcli"=>4,
                     );
    //
        $resp=DatosValidacion::LeeEstatusinforme($datosContPEP,"sup_validafotos");
        $estpep=$resp["val_estatus"];


          // valido color de pepsi
          if ($estpep=1) {
             $nomestpepsi="yellow";
          } else if ($estpep==3) {
            $nomestpepsi="green";
          } else if ($estpep==2) {
            $nomestpepsi="red";
          } else {
          $nomestpepsi="blue";
        }

        // busca estatus informes peñafiel
        $datosContPEN= array("idmes"=>$this->idmes,
                         "idinf"=>$id,
                         "idrec"=>$this->idrec,
                         "ideta"=>$this->ideta,
                         "idcli"=>5,
                     );
    //
        $resp=DatosValidacion::LeeEstatusinforme($datosContPEN,"sup_validafotos");
        $estpen=$resp["val_estatus"];


          // valido color de pepsi
          if ($estpen=1) {
             $nomestpena="yellow";
          } else if ($estpen==3) {
            $nomestpena="green";
          } else if ($estpen==2) {
            $nomestpena="red";
          } else {
          $nomestpena="blue";
        }

        // busca estatus informes electrop
        $datosContELE= array("idmes"=>$this->idmes,
                         "idinf"=>$id,
                         "idrec"=>$this->idrec,
                         "ideta"=>$this->ideta,
                         "idcli"=>6,
                     );
    //
        $resp=DatosValidacion::LeeEstatusinforme($datosContELE,"sup_validafotos");
        $estele=$resp["val_estatus"];


          // valido color de pepsi
          if ($estele=1) {
             $nomestele="yellow";
          } else if ($estele==3) {
            $nomestele="green";
          } else if ($estele==2) {
            $nomestele="red";
          } else {
            $nomestele="blue";
        }
           echo
            '  <tr>
	        <td>'.$id.'</td>       
					<td>'.$nomtien.'</td>
					<td>
					 <a href="index.php?action=supinforme&idmes='.$this->idmes.'&idrec='.$idrec.'&id='.$id.'&sec=1&eta=2&idsup='.$this->idsup.'&idciu='.$this->idciu.'"><i class="fa fa-circle fa-2x" style="color:'.$nomesttien.';"></i></a></td>  
                    
        ';
           if ($item["TPEPSI"]>0){
           echo '
           <td> 
           <a href="index.php?action=supinformecli01&idmes='.$this->idmes.'&idrec='.$idrec.'&id='.$id.'&cli=4&sec=4&eta=2&idsup='.$this->idsup.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestpepsi.';"></i></a></td>';
           } else {
            echo '<td> </td>';
           }  
            
            if ($item["TPENA"]>0){
              echo ' 
          <td>
           <a href="index.php?action=supinformecli01&idmes='.$this->idmes.'&idrec='.$idrec.'&id='.$id.'&cli=5&sec=4&eta=2&idsup='.$this->idsup.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestpena.';"></i></a></td>';
         } else {
            echo '<td> </td>';
           }
            if ($item["TELEC"]>0){
              echo'
        <td>
           <a href="index.php?action=supinformecli01&idmes='.$this->idmes.'&idrec='.$idrec.'&id='.$id.'&cli=6&sec=4&eta=2&idsup='.$this->idsup.'"><i class="fa fa-circle fa-2x" style="color:'.$nomestsele.';"></i></a></td>';
           } else {
            echo '<td> </td>';
           }          

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
     if ($pan){
    $pan="0".$pan;
  }    
 
	try{
       //var_dump($idsup);
       //var_dump($idciu);
		$regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&idsup=".$idsup."&idciu=".$idciu;

		$datosController= array("id"=>$id,
                  "idt"=>$idt,
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
      if ($pan){
        $pan="0".$pan;
      }    

	try{
       //echo "entre a actualizar la direccion";
		$regresar="index.php?action=supinforme".$pan."&idmes=".$indicec."&idrec=".$idrecc."&id=".$id."&idsup=".$idsup."&idciu=".$nomciudad;

		$datosController= array("ntien"=>$numtienc,
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
    if ($pan) {
    $pan= "0".$pan;
   }
    $regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&sec=".$sec."&eta=2&idsup=".$idsup."&idciu=".$idciu;
       $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );
    
       $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");
       // valido si se encuentra
       if (sizeof($respuesta)>0) {
          foreach($respuesta as $row => $item){
             $idval= $item["val_id"];
          }
           //var_dump($idval);
         // valida si existe validacion en seccion
         // revisa si ya existe
          $datosController= array("idval"=>$idval,
                "idsec"=>$sec, 
                  );
            //var_dump($datosController);
          $respuestaS =DatosValidacion::LeeIdImgValidacion($datosController, "sup_validasecciones");
          //var_dump($respuestaS);
           if (sizeof($respuestaS)>0) { 
             // echo "lo encontre";  
               $datosController= array("idval"=>$idval,
                "idsec"=>$sec,
                "idaprob"=>1,
                "noap"=>0,
                "observ"=>"",
                "estatus"=>$est,
              );
              DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");
           }else{
               //echo "no esta la seccion";
              if ($sec==1){
                  $descrip="ubicacion de la tienda";
               }else{
                 if ($sec==2){
                    $descrip="direccion en ticket";
                 }
                }
        
                  $datosController2= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>1,
                      "noap"=>0,
                      "observ"=>$solicitud,
                      "estatus"=>$est,
                                   );
                //var_dump($datosController2);
                DatosValidacion::ingresaregvalsec($datosController2, "sup_validasecciones");           
            }  // if validacion de seccion

       }else {
           //echo "no hay nada";  
           // inserta validacion
              $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "estatus"=>1,
                "ideta"=>$eta,
                               );

           // inserta validacion detalle
           DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
           // busca numero de validacion
           $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );
    
          $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

           if (sizeof($respuesta)>0) {
              foreach($respuesta as $row => $item){
              $idval= $item["val_id"];
            }
          } 
         // var_dump($idval);
          if ($sec==1){
                  $descrip="ubicacion de la tienda";
          }else{
             if ($sec==2){
                $descrip="direccion en ticket";
             }
          }
          $datosController2= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>1,
                      "noap"=>0,
                      "observ"=>$solicitud,
                      "estatus"=>$est,
                                   );
         //var_dump($datosController2);
        DatosValidacion::ingresaregvalsec($datosController2, "sup_validasecciones");
       
           
       }  // if existe en validacion
        echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";


   }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }
}


public function noaceptarsec1(){
		
	include "Utilerias/leevar.php";
      
	try{

   if ($pan) {
    $pan= "0".$pan;
   }
		if ($cancelar){
			$estatus=3;

		} else {
			$estatus=1; 
		}
     echo "entre a solicitar correccion";
    //var_dump($idsup);
    //var_dump($idciu);
		$regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&sec=".$sec."&eta=2&idsup=".$idsup."&idciu=".$idciu;

    if ($sec==1){
        $descrip="ubicacion de la tienda";
    }else if ($sec==2){
        $descrip="direccion en ticket";
    }
    
	    //echo $regresar;
		if ($admin=="cor"){
		   // busca si el registro ya existe
		   $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
                "ideta"=>$eta,
                               );
         //var_dump($datosController);
		   $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

		   if (sizeof($respuesta)>0) {
		      echo "lo encontre";
		   	 	foreach($respuesta as $row => $item){
					$idval= $item["val_id"];
				  }
          $datosController1= array("idval"=>$idval,
                "idsec"=>$sec,
                               );
    
	         // valida si existe la seccion
          $respuestaS =DatosValidacion::LeeIdImgValidacion($datosController1, "sup_validasecciones");
          //var_dump($respuestaS);
           if (sizeof($respuestaS)>0) {   
          
		   	  // actualiza validacion
		   	      $datosController= array("idval"=>$idval,
								"idsec"=>$sec,
								"idaprob"=>0,
                "noap"=>0,
								"observ"=>$solicitud,
								"estatus"=>$est,
                               );
		   	  //var_dump($datosController);
				     DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");
            } else {
              // ingresa seccion
              //echo "no existe seccion";
                $datosController2= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>0,
                      "noap"=>0,
                      "observ"=>$solicitud,
                      "estatus"=>$est,
                                   );
                //var_dump($datosController2);
                DatosValidacion::ingresaregvalsec($datosController2, "sup_validasecciones");

            }  

		   }else {
		       echo "no hay nada"; 	
		       // inserta validacion
		       		$datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
								"estatus"=>$est,
                "ideta"=>$eta,
                               );

		       // inserta validacion detalle
		       DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
		       // busca numero de validacion
		       $datosController= array("id"=>$id,
								"idrec"=>$idrec,
								"indice"=>$indice,
                "ideta"=>$eta,
                               );
		
		   		$respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

				   if (sizeof($respuesta)>0) {
				   	 	foreach($respuesta as $row => $item){
							$idval= $item["val_id"];
						}
					}	


					$datosController2= array("idval"=>$idval,
											"idsec"=>$sec,
											"descrip"=>1,
											"idaprob"=>0,
											"noap"=>0,
											"observ"=>$solicitud,
											"estatus"=>$est,
			                             );
          //var_dump($datosController2);
				DatosValidacion::ingresaregvalsec($datosController2, "sup_validasecciones");
		   }
		   //var_dump($respuesta);
        if ($est==3){
          DatosValidacion::actualizaValidacionpr($datosController,"sup_validacion");
        }

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
  //echo "entre a noaplicasec";
  $estatus="1";
   try{
    if ($pan) {
    $pan= "0".$pan;
   }

   if ($sec==1){
        $descrip="ubicacion de la tienda";
    }else if ($sec==2){
        $descrip="direccion en ticket";
    }
    $regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&sec=".$sec."&eta=2&idsup=".$idsup."&idciu=".$idciu;
       $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );
     // var_dump($datosController);


      $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");
       //var_dump($respuesta);
       // valido si se encuentra
       if (sizeof($respuesta)>0) {
          foreach($respuesta as $row => $item){
             $idval= $item["val_id"];
          }
        //var_dump($idval);
         // valida si existe validacion en seccion
         // revisa si ya existe
          $datosController= array("idval"=>$idval,
                "idsec"=>$sec,
                "ideta"=>$eta,
                  );
          //var_dump($datosController);
          $respuestaS =DatosValidacion::LeeIdImgValidacion($datosController, "sup_validasecciones");
          //var_dump($respuestaS);
           if (sizeof($respuestaS)>0) {   
               $datosController= array("idval"=>$idval,
                "idsec"=>$sec,
                "idaprob"=>0,
                "noap"=>1,
                "observ"=>"",
                "estatus"=>$estatus,
              );

            DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");
           }else{
              if ($sec==1){
                  $descrip="ubicacion de la tienda";
               }else{
                 if ($sec==2){
                    $descrip="direccion en ticket";
                 }
                }
           
                $datosController= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>0,
                      "noap"=>1,
                      "observ"=>$solicitud,
                      "estatus"=>$estatus,
                                   );

          //      var_dump($datosController);    
             DatosValidacion::ingresaregvalsec($datosController, "sup_validacion");           
            }  // if validacion de seccion

       }else {
           //echo "no hay nada";  
           // inserta validacion
              $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                "estatus"=>1,
                               );
            //  var_dump($datosController);
           // inserta validacion detalle
           DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
           // busca numero de validacion
           $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );
    
          $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

           if (sizeof($respuesta)>0) {
              foreach($respuesta as $row => $item){
              $idval= $item["val_id"];
            }
          } 
                $datosController= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>0,
                      "noap"=>1,
                      "observ"=>$solicitud,
                      "estatus"=>$estatus,
                                   );
                  //echo "entre a agregar el registro";
            //    var_dump($datosController);

        DatosValidacion::ingresaregvalsec($datosController, "sup_validasecciones");
       
           
       }  // if existe en validacion
        echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";


   }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }
}



public function getUnegocioxFiltros3($pais,$ciudadres, $planta,$indice,$recolector){
    
    $sqlcol=" ,if(n5_idn1=4,'yellow',if(n5_idn1=5,'pink',if(n5_idn1=6,'purple','blue' ))) as color ";

  

    $sql="select cu.une_id,une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad,
 une_estatus, une_coordenadasxy, une_puntocardinal,
str_to_date(concat('01.', vi_indice ),'%d.%m.%Y') as fec,
une_tipotienda, une_cadenacomercial, une_estatus";
    $sql=$sql.$sqlcol;
 $sql.=" from ca_unegocios cu
inner join visitas on vi_tiendaid=cu.une_id
 inner join informes i on i.inf_visitasIdlocal =vi_idlocal
and vi_cverecolector=i.inf_usuario  and vi_indice=i.inf_indice 
   left join ca_nivel5 on n5_id=inf_plantasid";

    // agregando filtros
   /* if(isset($planta)&&$planta!="") {
        $sql.=" and inf_plantasid=:planta";
        
    }*/
    $sql.="   where  vi_indice=:fechafin and vi_cverecolector=:recolector";
    
    // $sql.=" left join ca_nivel5 on n5_id=inf_plantasid
    //where  une_cla_ciudad=:ciudad ";
    //and une_cla_pais=:pais";
    if(isset($ciudadres)){
        
        if($ciudadres!="") {
            $sql.=" and une_cla_ciudad=:ciudad";
          
        }
    }
    // agregando filtros
  //  $sql.="  group by cu.une_id";
       //    echo $sql;
    $stmt = Conexion::conectar()-> prepare($sql );
    //   $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
    // $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
    $stmt-> bindParam(":recolector", $recolector, PDO::PARAM_INT);
    
    $stmt-> bindParam(":fechafin", $indice, PDO::PARAM_STR);
    
    if(isset($planta)){
        
        if($planta!="") {
            
            $stmt-> bindParam(":planta", $planta, PDO::PARAM_STR);
        }
    }
    if(isset($ciudadres)){
        
        if($ciudadres!="") {
          
            $stmt-> bindParam(":ciudad", $ciudadres, PDO::PARAM_STR);
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
   //  $stmt->debugDumpParams();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function solcorreccion(){
   
  include "Utilerias/leevar.php";
   

   if ($pan) {
      switch ($pan) {
      case 2:
        $desima = "FotoFachada";
        break;
       }       

      $pan ="0".$pan;
  
   }
     
  try{
    
   $regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id;

// busca si el registro ya existe
       $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );
      //var_dump($datosController);
       $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

       if (sizeof($respuesta)>0) {
       echo "lo encontre";
          foreach($respuesta as $rogw => $item){
             $idval= $item["val_id"];

           }
            //var_dump($idval);
             //var_dump($numimg);
             //revisa si existe validacion en imagenes
             $respuesta1 =DatosValidacion::LeeIdvalidafoto($idval, $numimg, "sup_validafotos");
           if (sizeof($respuesta1)>0) { 
               // actualiza g
              echo "encontre la foto";
                $datosController= array("idval"=>$idval,
                    "numimg"=>$numimg,
                    "estatus"=>$est,
                               );
                //var_dump($idval);
                 //var_dump($datosController); 
            $ex= DatosValidacion::actualizaValidacionimg($datosController, "sup_validafotos");
               

           } else {
            // ingresa registro de imagen
                 $datosController= array("idval"=>$idval,
                    "numimg"=>$numimg,
                    "descripimg"=>1,
                    "estatus"=>$est,
                               );

                DatosValidacion::ingresaValidacionimg($datosController, $tabla);
           }
       }else {
          echo "no hay nada";  
           // inserta validacion
              $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                "estatus"=>1,
                               );

              // inserta validacion detalle
              DatosValidacion::InsertaValidacion($datosController, "sup_validacion")
              ;
              // busca numero de validacion
             $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );
    
             $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

            if (sizeof($respuesta)>0) {
              foreach($respuesta as $row => $item){
                  $idval= $item["val_id"];
              }
               // inserta validacion de imagen

                 $datosController= array("idval"=>$idval,
                    "numimg"=>$numimg,
                    "descripimg"=>1,
                    "estatus"=>$est,
                               );
                DatosValidacion::ingresaValidacionimg($datosController, $tabla); 
             
             }
             
           }
       
   // echo "
   //         <script type='text/javascript'>
   //           window.location='$regresar'
   //             </script>
   //               ";
  }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }

}

public function actcatalogoimg(){
   
  include "Utilerias/leevar.php";


   if ($pan) {
           

      $pan ="0".$pan;
  
   }
     
  try{
    
   $regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&sec=".$sec."&eta=2";
   
      // busca si el registro ya existe
       $datosController= array("numtien"=>$idtien,
                               "idcli"=>$cli,
                               "indice"=>$indice,
                               "idrec"=>$idrec,
                               "numtkt"=>$numtkt,
                               );
       //var_dump($datosController);
   $resp1= DatosUnegocio::leecattkt($datosController, "ca_uneimagenes");
    if (sizeof($resp1)>0) {
        // actualiza imagen
       //echo "lo encontre";
      DatosUnegocio::actualizacatalogotkt($datosController, "ca_uneimagenes");
    } else {
       //echo "no lo encontew";
      DatosUnegocio::ingresacatalogotkt($datosController, "ca_uneimagenes");
    }  
       echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
  }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }
}


public function noaceptarimg(){
    
  include "Utilerias/leevar.php";
      
  try{

   if (is_null($observ)){
      $observ="a";
   }else {
    
   }
   if ($pan) {
    $pan= "0".$pan;
   }
    if ($cancelar){
      $estatus=3;

    } else {
      $estatus=1; 
    }
     
    $regresar="index.php?action=supinforme".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&sec=".$sec."&eta=2&idsup=".$idsup."&idciu=".$idciu;

    if ($sec==4){
        $descrip="foto anaquel";
    }else if ($sec==2){
        $descrip="foto de fachada";
    }
    
      //echo $regresar;
    if ($admin=="cor"){
       // busca si el registro ya existe
       $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );

       $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

       if (sizeof($respuesta)>0) {
          //echo "lo encontre en principal";
          foreach($respuesta as $row => $item){
          $idval= $item["val_id"];
          }
          $datosController1= array("idval"=>$idval,
                "idcli"=>$cli,
                        );

           // valida si existe la seccion
          $respuestaS =DatosValidacion::LeeIdvalidafoto($idval, $img, "sup_validafotos");
          //var_dump($respuestaS);
           if (sizeof($respuestaS)>0) {   
          
          // actualiza validacion
              $datosController= array("idval"=>$idval,
                 "est"=>$est,
                 "idimg"=>$img,
                               );
           // var_dump($datosController);
             DatosValidacion::actualizaValidacionimg($datosController,"sup_validafotos");
            } else {
              // ingresa seccion
              //echo "no existe seccion";
                $datosController2= array("idval"=>$idval,
                      "idcli"=>0,
                      "observ"=>$observ,
                      "est"=>$est,
                      "idimg"=>$img,
                      "desimg"=>2,
                                   );
                //var_dump($datosController2);
                DatosValidacion::ingresaValidacionimg($datosController2, "sup_validafotos");

            }  

         }else {
    //       echo "no hay nada";  
           // inserta validacion
              $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "estatus"=>$est,
                "ideta"=>$eta,
                               );
            //    var_dump($datosController);
           // inserta validacion detalle
           DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
           // busca numero de validacion
             $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$indice,
                "ideta"=>$eta,
                               );

       $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

           if (sizeof($respuesta)>0) {
              foreach($respuesta as $row => $item){
              $idval= $item["val_id"];
            }
          } 

        $datosController2= array("idval"=>$idval,
                      "idcli"=>0,
                      "observ"=>$observ,
                      "est"=>$est,
                      "idimg"=>$img,
                      "desimg"=>2,
                                   );
        
        DatosValidacion::ingresaValidacionimg($datosController2, "sup_validafotos"); }
       //var_dump($respuesta);
        if ($est==3){
          DatosValidacion::actualizaValidacionpr($datosController,"sup_validacion");
        }

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

}
