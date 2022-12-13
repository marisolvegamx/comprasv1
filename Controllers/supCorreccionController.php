<?php
//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
//ini_set("display_errors", 1); 
include "Models/crud_supcorrecciones.php";
include 'Models/crud_supvalfotos.php';
include 'Models/crud_informesDetalle.php';

class SupCorreccionController
{
    public $valfoto;
    public $correccionFoto;
    public $mesas;
    public $rec_id;
    public $indiceletra;
    public $dirimagen;
    public $liga;
    public $imagenOrig; //laoriginal 
    public $imagenOrig2;
    public $imagenOrig3; 
    public $etapa;
    public $numf;
    public $idval; 
    public $recolector;
    public $idfoto2;
    public $idfoto3;
     
    public function vistaCorrec(){
      
        $this->mesas=$_GET["idmes"];
        $this->rec_id=$_GET["idrec"];
      //  $this->idcli=$_GET["cli"];
     
        $this->numfoto=$_GET["numf"];
        $this->idval=$_GET["id"];
        $admin=$_GET["admin"];
       // var_dump($_GET);
        $this->indiceletra=Utilerias::indiceConLetra($this->mesas);
        
        $respval=DatosValFotos::getValidacionxId($this->mesas,$this->rec_id,$this->idval,$this->numfoto);
        if($respval!=null)
        {   $this->valfoto=$respval[0];
        
        }
        //var_dump($this->valfoto);
        $resp=DatosRecolector::vistarecolectorDetalle($this->rec_id,"ca_recolectores");
        if($resp!=null)
        $this->recolector=$resp[0];
        if($this->valfoto["vai_estatus"]>3)
        {//todo depende del estatus busco si hay correccion
          
                $resp =DatosCorreccion::getUltCorxValFoto($this->mesas,$this->rec_id,$this->idval, $this->numfoto,"sup_validacion");
         // var_dump($resp);
        if($resp!=null)
        {   $this->correccionFoto=$resp;
           
        }
        }
       // var_dump($this->correccionFoto);
       
        $this->liga="index.php?action=supnvacorreccion&idmes=".$this->mesas."&idrec=".$this->rec_id."&id=".$this->idval."&numf=".$this->numfoto;
      
        $aux = explode(".", $this->mesas);
        
        $solomes = $aux[0];
        $soloanio = $aux[1];
        $this->dirimagen = "fotografias\\".$solomes."_".$soloanio;

       //busco la imagen original 
        $this->buscarFotoOriginal($this->valfoto["vai_numfoto"]);
    //  echo $admin;
        if($admin=="aceptar"){
            $this->aceptarFoto();
        }
        if($admin=="noaceptar"){ //no reemplazar
            $this->noaceptar();
        }
       
        if($admin=="solcor"){  //nueva correccion
       
            $this->solcorreccion();
        }
        
        
    }
    
    public function solcorreccion(){
        
        include "Utilerias/leevar.php";

        try{
            
            
            if ($this->correccionFoto!=null) {
              
                $datosController= array("idval"=>$this->idval,
                    "idimg"=>$this->numfoto,
                    "est"=>1,
                    "motivo"=>$observ
                    
                );
                //   var_dump($idval);
                  // var_dump($datosController);
                   $ex= DatosValFotos::actualizaContValFotos($datosController, "sup_validafotos");
                
                
            } 
              
            
            echo "
            <script type='text/javascript'>
              window.location='$this->liga'
                </script>
                  ";
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
        
    }
    
    public function noaceptar(){
        
        include "Utilerias/leevar.php";
        
      
        
        try{
          //  var_dump($this->correccionFoto);
            //revisa si existe validacion en imagenes
            if ($this->correccionFoto!=null) {
                // actualiza g
                // echo "encontre la foto";
                $datosController= array("idval"=>$this->idval,
                    "idimg"=>$this->numfoto,
                    "est"=>3
                    
                );
                 // var_dump($idval);
                 //  var_dump($datosController);
                $ex= DatosValidacion::actualizaValidacionimg($datosController, "sup_validafotos");
               // if($this->imagenOrig2!=null){
                    
                //}
                
                echo "
            <script type='text/javascript'>
              window.location='$this->liga'
                </script>
                  ";
                
            }
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
        
    }
  
    public function aceptarFoto(){
        
        include "Utilerias/leevar.php";
      //  var_dump($_GET);
        try{
            if($this->imagenOrig!=null){
                //reemplazo el archivo
              //  var_dump($this->imagenOrig);
                DatosImagenDetalle::actualizarArchivo($this->numfoto,$this->correccionFoto["cor_rutafoto1"],$this->rec_id,$this->mesas,"imagen_detalle" );
                //borro el archivo original
                if (is_file($this->dirimagen."/".$this->imagenOrig["ruta"]) )
                   
                    unlink($this->dirimagen."/".$this->imagenOrig["ruta"]); 
                //actualizo estatus
                    $datosController= array("idval"=>$this->idval,
                        "idimg"=>$this->numfoto,
                        "est"=>3
                        
                    );
                    //   var_dump($idval);
                    //   var_dump($datosController);
                    DatosValidacion::actualizaValidacionimg($datosController, "sup_validafotos");
                   
            }
            if($this->imagenOrig2!=null){
                //reemplazo el archivo
               // var_dump($this->correccionFoto);
            //    var_dump($this->imagenOrig2);
                DatosImagenDetalle::actualizarArchivo($this->idfoto2,$this->correccionFoto["cor_rutafoto2"],$this->rec_id,$this->mesas,"imagen_detalle" );
                //borro el archivo original
                if (is_file($this->dirimagen."/".$this->imagenOrig2["ruta"]) )
                    
                    unlink($this->dirimagen."/".$this->imagenOrig2["ruta"]);
                    //actualizo estatus
                            
            }
            if($this->imagenOrig3!=null){
            //    var_dump($this->imagenOrig3);
                //reemplazo el archivo
               // var_dump($this->correccionFoto);
                DatosImagenDetalle::actualizarArchivo($this->idfoto3,$this->correccionFoto["cor_rutafoto3"],$this->rec_id,$this->mesas,"imagen_detalle" );
                //borro el archivo original
                if (is_file($this->dirimagen."/".$this->imagenOrig3["ruta"]) )
                    
                    unlink($this->dirimagen."/".$this->imagenOrig3["ruta"]);
                   
                    
            }
        
          // die();
                echo "
            <script type='text/javascript'>
              window.location='$this->liga'
                </script>
                  ";
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
    }
    
   
    
    public function buscarFotoOriginal($idfoto1){
        
       // var_dump($datosController);
        $respuesta = DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto1,"imagen_detalle");
       
        // valido si se encuentra
        if (sizeof($respuesta)>0) {
           
                $this->imagenOrig=$respuesta;
                
            }
       if($this->valfoto["vai_descripcionfoto"]==4) //es de 3 fotos
        {
                //busco el informe
               $infdet=DatosInformeDetalle::findByInformeAtra($this->valfoto["val_inf_id"],$idfoto1,$this->rec_id,$this->mesas,"informe_detalle");
              // var_dump($infdet);
               $this->idfoto2=$infdet["ind_foto_atributob"];
               $this->idfoto3=$infdet["ind_foto_atributoc"];
               $respuesta2 = DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$this->idfoto2,"imagen_detalle");
               // valido si se encuentra
               if (sizeof($respuesta2)>0) {
                   
                   $this->imagenOrig2=$respuesta2;
               }
               $respuesta3 = DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$this->idfoto3,"imagen_detalle");
               
               // valido si se encuentra
               if (sizeof($respuesta3)>0) {
                   
                   $this->imagenOrig3=$respuesta3;
               }
               
        }
          //  var_dump($this->imagenOrig);
    }
    
    public function buscarCorreccionFoto($datosController){
        // var_dump($datosController);
        $respuesta =DatosImgInformes::LeeEstatusfoto($datosController, "sup_validafotos");
        // valido si se encuentra
        if (sizeof($respuesta)>0) {
            
            $this->correccionFoto=$respuesta[0];
            
        }
        //  var_dump($this->correccionFoto);
    }
    
    public function calcTiempoResp($tiempoini,$tiempofin){
     // echo $tiempoini."--".$tiempofin;
        $firstDate  = new DateTime($tiempoini);
        $secondDate = new DateTime($tiempofin);
        $intvl = $firstDate->diff($secondDate);
            return $intvl->days." días";
        
    }
   
    public function getopcsel() {
        return $this->opcsel;
    }
    
  
   
  
    
    
    
    
}



