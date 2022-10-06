<?php


include 'Models/crud_imagenesDetalle.php';
class SupInfmuestraController{
    

	public function vistaSupInfMuesController(){
         $this->idinf=$_GET["id"];
	     $this->mesas=$_GET["idmes"];
	     $this->rec_id=$_GET["idrec"];
	     $this->idcli=$_GET["cli"];
        $this->idsec=$_GET["sec"];
        $this->ideta=$_GET["eta"];



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
				//$this->prodex= $item["inf_productoexhibido"];
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
		    
		    //$this->eta="2";
            $datosCont2= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "ideta"=>$this->ideta,
                     );
            $respuesta4 =DatosImgInformes::vistaImgInfModel($datosCont2, "imagen_detalle");
              foreach($respuesta4 as $row => $item4){
                 $this->nombreimg= $item4["imd_ruta"];
                 $this->idimg= $item4["imd_idlocal"];
              }             

           
        $datosCont2= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "ideta"=>$this->eta,
                         "idsec"=>$this->idsec,
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

        $datosCont3= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "ideta"=>$this->eta,
                         "idfoto"=>$this->idimg,
      );

      $respuesta5 =DatosValidacion::LeeEstatusFoto($datosCont3, "sup_validacion");
        //var_dump($respuesta4);
        foreach($respuesta5 as $row => $item5){
            $this->estfot= $item5["vai_estatus"];      
        }


      // busca imagen ticket
       $result=DatosImagenDetalle::getnomImagen($this->mesas,$this->rec_id,$this->ticket,"imagen_detalle");

        //foreach($result as $row => $result5){
            $this->nomticket=$result["imd_ruta"];

            //busca el id de prod exhibido
//var_dump($this->idinf);
//var_dump($this->rec_id);
//var_dump($this->mesas);
//var_dump($this->idcli);

      $datosCont3= array("idinf"=>$this->idinf,
                         "idmes"=>$this->mesas,
                         "idrec"=>$this->rec_id,
                         "idcli"=>$this->idcli,
  
      );
   

//    $result3=DatosInfoProdExhib::buscaprodexhib($datosCont3,"producto_exhibido");

  //  $this->idprodex=$result3["pe_imagenId"];

        //}        
  //    $result2=DatosImagenDetalle::getnomImagen($this->mesas,$this->rec_id,$this->idprodex,"imagen_detalle");

        //foreach($result as $row => $result5){
  //          $this->nomprodex=$result2["imd_ruta"];      

        

	}

public function getnomtick() {
      return $this->nomticket;
  }

public function getnomprodex() {
      return $this->nomprodex;
  }


  public function getestfot() {
      return $this->estfot;
  }

    public function getopcsel() {
      return $this->opcsel;
  }


    public function getidimg() {
      return $this->idimg;
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
      //var_dump($datosCont);
     $respuesta =DatosInfoMues::vistaFirstMuesModel($datosCont, "informes");
     //var_dump($respuesta);     
     foreach($respuesta as $row => $item){
      $ncons[]=$item["inf_id"];
      } 
      //$totreg=array_count_values($ncons);
      //var_dump($totreg);
      if ($ncons){
         $this->first=$ncons[0];
         //var_dump($this->siginf);  
      } else {
        $this->first=0;
      }
      return $this->first;
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
       $this->ant=$ncons[0];  
    } else {
      $this->ant=0;
    }
    return $this->ant;
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
          $respuestaS =DatosValidacion::LeeIdvalidafoto($idval, $img, "sup_validafotos");
          //var_dump($respuestaS);
           if (sizeof($respuestaS)>0) {   
          
          // actualiza validacion
              $datosController= array("idval"=>$idval,
                 "est"=>$est,
                 "idimg"=>$img,
                               );
          //var_dump($datosController);
             DatosValidacion::actualizaValidacionimg($datosController,"sup_validafotos");
            } else {
              // ingresa seccion
              echo "no existe seccion";
                $datosController2= array("idval"=>$idval,
                      "idcli"=>$cli,
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
                      "idcli"=>$cli,
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

public function aceptarsec(){
    
  include "Utilerias/leevar.php";
   try{
    if ($pan) {
    $pan= "0".$pan;
   }
   $est=2;
    $regresar="index.php?action=supinformecli".$pan."&idmes=".$indice."&idrec=".$idrec."&id=".$id."&cli=".$cli."&sec=4&eta=2";

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
              //echo "lo encontre";  
               $datosController= array("idval"=>$idval,
                "idsec"=>$sec,
                "idaprob"=>$acep,
                "noap"=>$noa,
                "observ"=>"",
                "estatus"=>$est,
              );
              DatosValidacion::actualizaValidacionsec($datosController,"sup_validasecciones");
           }else{
               //echo "no esta la seccion";
              if ($sec==4){
                  $descrip="producto exhibido PEPSI";
               }else{
                 if ($sec==5){
                    $descrip="producto exhibido PEÑAFIEL";
                 } else {
                 if ($sec==6){
                    $descrip="producto exhibido ELECTRO";   
                 }
               }
              }
        
                  $datosController2= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>$acep,
                      "noap"=>$noa,
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
                "ideta"=>2,
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
         // var_dump($idval);
          if ($sec==4){
                  $descrip="producto exhibido PEPSI";
          }else{
             if ($sec==5){
                $descrip="producto exhibido PEÑAFIEL";
             }
          }
          $datosController2= array("idval"=>$idval,
                      "idsec"=>$sec,
                      "descrip"=>$descrip,
                      "idaprob"=>$acep,
                      "noap"=>$noa,
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


}
?>	