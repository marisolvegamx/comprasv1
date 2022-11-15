<?php
//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
//ini_set("display_errors", 1); 
include "Models/crud_supcorrecciones.php";
include 'Models/crud_supvalfotos.php';

class SupCorreccionController
{
    public $valfoto;
    public $correccion;

    public $idcor;
    public $mesas;
    public $rec_id;
    public $indiceletra;
    public $dirimagen;
    public $liga;
    public $imagenOrig; //laoriginal 
    public $etapa;
   public $numf;
    public $idval; 
     
    public function vistaCorrec(){
      
        $this->mesas=$_GET["idmes"];
        $this->rec_id=$_GET["idrec"];
      //  $this->idcli=$_GET["cli"];
     
        $this->numfoto=$_GET["numf"];
        $this->idcor=$_GET["id"];
        $admin=$_GET["admin"];
      
        $this->indiceletra=Utilerias::indiceConLetra($this->mesas);
        
        $respval=DatosValFotos::getValidacionxId($this->mesas,$this->rec_id,$this->idcor,$this->numf);
        if($respval!=null)
        {   $this->valfoto=$respval;
        
        }
        //todo depende del estatus busco si hay correccion
        
        $resp =DatosCorreccion::getCorreccionxValFoto($this->mesas,$this->rec_id,$this->idcor, $this->numfoto,"sup_validacion");
         // var_dump($resp);
        if($resp!=null)
        {   $this->correccion=$resp;
           
        }
       
        $this->liga="index.php?action=supnvacorreccion&idmes=".$this->mesas."&idrec=".$this->rec_id."&id=".$this->idcor;
    
        $aux = explode(".", $this->mesas);
        
        $solomes = $aux[0];
        $soloanio = $aux[1];
        $this->dirimagen = "fotografias\\".$solomes."_".$soloanio;

       //busco la imagen original 
        $this->buscarCorreccionFoto($this->valfoto["vai_numfoto"]);
    //  echo $admin;
        if($admin=="aceptarsec"){
            $this->aceptarFoto(1);
        }
        if($admin=="noaceptarsec"){
            $this->aceptarsec(0);
        }
       
        if($admin=="solcor"){
       
            $this->solcorreccion();
        }
        
        
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
            
            //revisa si existe validacion en imagenes
            if ($this->correccionFoto!=null) {
                // actualiza g
                // echo "encontre la foto";
                $datosController= array("idval"=>$this->idval,
                    "numimg"=>$numimg,
                    "estatus"=>$est
                    
                );
                //   var_dump($idval);
                //   var_dump($datosController);
                $ex= DatosValidacion::actualizaValidacionimg($datosController, "sup_validafotos");
                $datoscorr=array("idval"=>$this->idval,
                    "idfoto"=>$numimg
                );
                $this->buscarCorreccionFoto($datoscorr);
                
            } else {
                if ($this->idval==0) {
                    
                    
                    //   echo "no hay nada";
                    // inserta validacion
                    $datosController= array("id"=>$id,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "ideta"=>$eta,
                        "estatus"=>1,
                        ""
                    );
                    
                    // inserta validacion detalle
                    DatosValidacion::InsertaValidacion($datosController, "sup_validacion")
                    ;
                    // busca numero de validacion
                    $datosController= array("id"=>$id,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "ideta"=>$eta,
                    );
                    
                    $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");
                    
                    if (sizeof($respuesta)>0) {
                        foreach($respuesta as $row => $item){
                            $this->idval= $item["val_id"];
                        }
                    }
                }
                // inserta validacion de imagen
                //busco el id descripcion foto
                //   $resfoto= DatosCatalogoDetalle::getDetallexDesc($this->pantalla["pa_foto1"],20,"ca_catalogosdetalle");
                //  $resfoto=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",20,$this->pantalla["pa_foto1"]);
                // var_dump($resfoto);
                //  if($resfoto!=null)
                //  $numfoto=$resfoto["cad_idopcion"];
                    $numfoto= $this->pantalla["pa_foto1"];
                    $datosController= array("idval"=>$this->idval,
                        "idimg"=>$numimg,
                        "desimg"=>$numfoto,
                        "est"=>$est,
                        "observ"=>$observ,
                        "cli"=>$cli
                    );
                    //    var_dump($datosController);
                    DatosValidacion::ingresaValidacionimg($datosController, "sup_validafotos");
                    $datoscorr=array("idval"=>$this->idval,
                        "idfoto"=>$numimg
                    );
                    $this->buscarCorreccionFoto($datoscorr);
                    
            }
            
            /*  echo "
             <script type='text/javascript'>
             window.location='$regresar'
             </script>  ";*/
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
        
    }
    
  
  
    public function aceptarFoto($aprob){
        
        include "Utilerias/leevar.php";
      //  var_dump($_GET);
        try{
           
            $estatus=$na=0;
              $datosController= array("id"=>$d,
                "idrec"=>$idrec,
                  "indice"=>$idmes,
                "ideta"=>$eta,
            );
             //echo "***".$aprob;
                //ya tenía respuesta
              //var_dump($this->valSeccion);
              if($aprob==0){
                  $estatus=2;//cancelada
              }else if($aprob==1){
                  $estatus=1;//aceptada
              }
             
            if ($this->valSeccion!=null) {
                   
                    $datosController= array("idval"=>$this->idval,
                        "idsec"=>$sec,
                        "idaprob"=>$aprob,
                        "noap"=>0,
                        "observ"=>$observacionessec,
                        "estatus"=>$estatus,
                        "nummuestra"=>$iddet
                    );
                  //  var_dump($datosController);
                   // die();
                    DatosValSeccion::actualizaValidacionsecmues($datosController,"sup_validasecciones");
                  //  die();
            }else{
              
                if($this->idval==0)
                {
                
               
                    echo "no hay nada";
                    // inserta validacion
                    $datosController= array("id"=>$id,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "estatus"=>1,
                        "ideta"=>2,
                    );
                    
                    // inserta validacion detalle
                    DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
                
                    // busca numero de validacion
                    $datosController= array("id"=>$id,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "ideta"=>2
                    );
                    
                    $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");
                  //  var_dump($respuesta);
                    if (sizeof($respuesta)>0) {
                        foreach($respuesta as $row => $item){
                            $this->idval= $item["val_id"];
                        }
                    }
                }
              //  die($idval);
                // var_dump($idval);
               //busco la descripcion en el catálogo
                $descrip=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",21,$this->pantalla["pa_seccion"]);
             //   var_dump($descrip);
            //    die();
                //  if($resfoto!=null)
                //      $descrip=$resfoto["cad_descripcionesp"];
                $datosController2= array("idval"=> $this->idval,
                    "idsec"=>$sec,
                    "descrip"=>$descrip,
                    "idaprob"=>$aprob,
                    "noap"=>$na,
                    "observ"=>$observacionessec,
                    "estatus"=>$estatus,
                    "nummuestra"=>$iddet
                );
               // var_dump($datosController2);
                DatosValSeccion::ingresaregvalsecmues($datosController2, "sup_validasecciones");
                $datosController= array("idval"=>$this->idval,
                    "idsec"=>$sec,
                );
               // var_dump($datosController);
              //  die();
              //  $respuestaS =DatosValidacion::LeeIdImgValidacion($datosController, "sup_validasecciones");
             //   if (sizeof($respuestaS)>0) {
               //     $this->valSeccion=$respuestaS[0];   
              //  }
                
            }  // if existe en validacion
            //inserto la muestra en la tabla de supervision para poner el resultado
            
          //  $respmue=DatosValMuestra::getValidacionMuestra($idval,$this->numuestra,"sup_validainfdetalles");
                 
         //  var_dump($respmue);
          
           /* if($respmue!=null&&sizeof($respmue)>0){
                //actualizo
                $respmue["vam_estatus"]=$estatus;
                DatosValMuestra::UpdateValidacion($respmue,"sup_validainfdetalles");
            }else //inserto
            { */
            //todo ver primero si la muestra ya se acepto o se rechazo para antes de sumar o restar
         
         
        
                echo "
            <script type='text/javascript'>
              window.location='$this->liga'
                </script>
                  ";
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
    }
    
   
    
    public function buscarCorreccionFoto($idfoto1){
       // var_dump($datosController);
        $respuesta = DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto1,"imagen_detalle");
        
        // valido si se encuentra
        if (sizeof($respuesta)>0) {
           
                $this->imagenOrig=$respuesta[0];
                
            }
          //  var_dump($this->correccionFoto);
    }
    
 
 
    public function getopcsel() {
        return $this->opcsel;
    }
    
  
   
  
    
    
    
    
}



