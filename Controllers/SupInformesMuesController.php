<?php
include 'Models/crud_supmuestras.php';
class SupInfmuestraController{
    

	public function vistaSupInfMuesController(){
         $this->idinf=$_GET["id"];
	     $this->mesas=$_GET["idmes"];
	     $this->rec_id=$_GET["idrec"];
	     $this->idcli=$_GET["cli"];

	     // calcula la direccion de las imagenes
	     $aux = explode(".", $this->mesas);
                       
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
				
	     $datosCont= array("idinf"=>$this->idinf,
	                       "indice"=>$this->mesas,
	                       "idrec"=>$this->rec_id,
                         "idcli"=>$this->idcli,
	                             );
	      
		  $respuesta =DatosInfoMues::vistaInfMuesModel($datosCont, "informes");
          foreach($respuesta as $row => $item){
				$this->ticket= $item["inf_ticket_compra"];
				$this->prodex= $item["inf_productoexhibido"];
				$this->idplanta= $item["inf_plantasid"];
				$this->idtienda= $item["vi_tiendaid"];
				$this->coment=$item["inf_comentarios"];
				$this->nomrec=$item["rec_nombre"];
				$this->fecharep=$item["fecharep"];
				$this->horarep=$item["horarep"];
				$this->numtien=$item["inf_consecutivo"];
		   }

		   // busca cliente
		   $resp1 =Datosnuno::vistaN1opcionModel($this->idcli, "ca_nivel1");
           foreach($resp1 as $row => $item1){
		      $this->nomclien=$item1["n1_nombre"];
           }
		   // busca planta
		   
		   $resp2=Datosncin::getNombre($this->idplanta,"ca_nivel5");
		   $this->nomplanta=$resp2["n5_nombre"];


		   // busca nombre de la tienda
		   $respuesta3 =DatosUnegocio::consultaUnegocioModel($this->idtienda, "ca_unegocios");
	    // asigna datos a variables
				//var_dump($respuesta3);
    	    foreach($respuesta3 as $row => $item3){
			   $this->nomtienc= $item3["une_descripcion"];
			}
		    
		    $this->eta="2";
            $datosCont2= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "ideta"=>$this->eta,
                     );
            $respuesta4 =DatosImgInformes::vistaImgInfModel($datosCont2, "imagen_detalle");
              foreach($respuesta4 as $row => $item4){
                 $this->nombreimg= $item4["imd_ruta"];
              }             
      
	}

    public function getidticket() {
      return $this->ticket;
	}

    public function getidprodex() {
      return $this->prodex;
	}

	 public function getnombreimg() {
      return $this->nombreimg;
	}

	public function getdirimg() {
      return $this->dirimagen;
	}

	public function getidinf() {
      return $this->idinf;
	}

	public function getidmes() {
      return $this->mesas;
	}
 
 	public function getidrec() {
      return $this->rec_id;
	}

	public function getidcli() {
      return $this->idcli;
	}

	public function getindice() {
      return $this->indice;
	}
	
	public function getcoment() {
      return $this->coment;
	}

	public function getnomrec() {
      return $this->nomrec;
	}

	public function getfecrep() {
      return $this->fecharep;
	}
	
	public function gethorarep() {
      return $this->horarep;
	}			

	public function getnomclien() {
      return $this->nomclien;
	}

	public function getnomplan() {
      return $this->nomplanta;
	}

	public function getnomtien() {
      return $this->nomtienc;
	}

	public function getidtien() {
      return $this->idtienda;
	}

    public function getnumtien() {
      return $this->numtien;
	}

   //busca el primer registro		   
  public function getidfirst(){
       $this->idinf=$_GET["id"];
       $this->mesas=$_GET["idmes"];
       $this->rec_id=$_GET["idrec"];
       $this->cli_id=$_GET["cli"];

       $datosCont= array("idinf"=>$this->idinf,
                           "idmes"=>$this->mesas,
                           "idrec"=>$this->rec_id,
                           "idcli"=>$this->cli_id,
                                 );    
      
     $respuesta =DatosInfoMues::vistaFirstMuesModel($datosCont, "informes");
          
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

public function getidant(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
     $this->idcli=$_GET["cli"];


     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idcli"=>$this->idcli,
                               );
  
   $respuesta =DatosInfoMues::vistaAnttiendaModel($datosCont, "informes");
      
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

public function getidsig(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
     $this->idcli=$_GET["cli"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idcli"=>$this->idcli,
                               );
      
   $respuesta =DatosInfoMues::vistaSigtiendaModel($datosCont, "informes");
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

public function getlast(){
     $this->idinf=$_GET["id"];
     $this->mesas=$_GET["idmes"];
     $this->rec_id=$_GET["idrec"];
     $this->idcli=$_GET["cli"];

     $datosCont= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idcli"=>$this->idcli,
                               );
      
   $respuesta =DatosInfoMues::vistalasttiendaModel($datosCont, "informes");
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

public function noaceptarprodex(){
    
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
     
    $regresar="index.php?action=supinformecli".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&cli=".$cli;

    if ($sec==4){
        $descrip="foto anaquel";
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

       $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

       if (sizeof($respuesta)>0) {
          
          foreach($respuesta as $row => $item){
          $idval= $item["val_id"];
          }
          $datosController1= array("idval"=>$idval,
                "idcli"=>$cli,
                        );
            //var_dump($datosController1);
           // valida si existe la seccion
          $respuestaS =DatosInfoProdExhib::LeeEstatusProd($datosController1, "sup_validaprodexhib");
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
                      "idcli"=>$cli,
                      "observ"=>$observ,
                      "est"=>$est,
                                   );
                
                DatosInfoProdExhib::insertaEstatusProd($datosController2, "sup_validaprodexhib");

            }  

         }else {
           //echo "no hay nada";  
           // inserta validacion
              $datosController= array("idval"=>$idval,
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
                               );
    
          $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");

           if (sizeof($respuesta)>0) {
              foreach($respuesta as $row => $item){
              $idval= $item["val_id"];
            }
          } 


      $datosController2= array("idval"=>$idval,
                      "idcli"=>$cli,
                      "observ"=>$observ,
                      "est"=>$est,
                                   );
                
         DatosInfoProdExhib::insertaEstatusProd($datosController2, "sup_validaprodexhib");
 }
       //var_dump($respuesta);
        if ($est==3){
          DatosValidacion::actualizaValidacionpr($datosController,"sup_validacion");
        }

  //  echo "
  //          <script type='text/javascript'>
  //            window.location='$regresar'
  //              </script>
  //                ";
      }

  }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }     
}



}
?>	