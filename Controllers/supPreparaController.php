<?php
//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
//ini_set("display_errors", 1); 

include "Models/crud_informesetapa.php";
include 'Models/crud_infetapadet.php';

include 'Models/crud_supvalmuestras.php';
include 'Models/crud_supcorrecciones.php';

class SupPreparaController
{
    public $informe;
  
    public $infdetalle;
    public $idinf;
    public $mesas;
    public $rec_id;
    public $idcli;
    public $pantalla;
    public $indiceletra;
  
    public $infdetalles;
    public $imagenes;
    public $dirimagen;
    public $liga;
     
    public $listaCompra;
    public $correccionFoto;
    public $valSeccion;
    public $etapa=1;
    public $seccion;
    public $idval;
    public $numpan;
    public $numdet;
    public $idplan;
    public $totalsol;
   
     
    public function vistaPreparacion(){
        //$vis=$_GET["id"]; //si es el del informe
        $this->mesas=$_GET["idmes"];
        $this->rec_id=$_GET["idrec"];
       // $this->id=$_GET["id"];
        $this->idplan=$_GET["idplan"];
    
       // $this->numdet=$_GET["numdet"];
        $admin=$_GET["admin"];
      
        $this->indiceletra=Utilerias::indiceConLetra($this->mesas);
        $resp =DatosInformeEtapa::getInformesEtapaxPlan($this->mesas,$this->rec_id,$this->idplan, "informes_etapa");
         // var_dump($resp);
        if($resp!=null)
        {   $this->informe=$resp;
            $this->idinf=$this->informe["ine_id"];
        }
       
        $this->liga="index.php?action=suppreparacion&idmes=".$this->mesas."&id=".$this->idinf."&idrec=".$this->rec_id."&idplan=".$this->idplan.'&cli='.$this->idcli.'&eta='.$this->etapa;
    
        $aux = explode(".", $this->mesas);
        
        $solomes = $aux[0];
        $soloanio = $aux[1];
        $this->dirimagen = "fotografias\\".$solomes."_".$soloanio;

        
        
         $this->destruirSesion();
         $this->buscarDetalles();
         $this->buscarImagenes();
       
        $this->pantalla=array("pa_seccion"=>22,"pa_preguntaseccion"=>"¿ETIQUETAS COMPLETAS Y DEL MES CORRESPONDIENTE?");
        
        //var_dump($this->infdetalles);
        $this->infdetalle=$this->infdetalles[$this->numdet-1];
        $this->getListaCompra($this->informe["ine_plantasid"]);
    
   
        $datosController= array("id"=>$this->idinf,
            "idrec"=>$this->rec_id,
            "indice"=>$this->mesas,
            "ideta"=>$this->etapa,
        );
        $this->buscarSeccion($datosController,$this->pantalla["pa_seccion"]);
        $datoscorr=array("idval"=>$this->idval,
            "idfoto"=>$this->imagenes[0]["id"]
        );
        
        $this->buscarCorreccionFoto($datoscorr);
    //  echo $admin;
        if($admin=="aceptarsec"){
            $this->aceptarsec(1);
        }
        if($admin=="noaceptarsec"){
            $this->aceptarsec(0);
        }
       
        if($admin=="solcor"){
       
            $this->solcorreccion();
        }
        
        
    }
    
    public function buscarDetalles(){
       // var_dump($_SESSION["supdetalleta"]);
       
        
            $this->infdetalles=DatosInfEtapaDet::getInfEtapaDetxInf(  $this->mesas,    $this->rec_id,$this->idinf,$this->etapa, "informes_etapadet");
         
           // var_dump($this->infdetalles);
        
            
    }
    public function buscarImagenes(){
        foreach ($this->infdetalles as $detalle){
       // var_dump($detalle);
        //busco la ruta
        
        $result=DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$detalle["ied_rutafoto"],"imagen_detalle");
        
        $this->imagenes[]=$result;
        }
        
        
       
     //   var_dump($this->imagenes);
        
    }
    
   
    
    public function destruirSesion(){
        $_SESSION["supdetalleta"]=null;
        
    }
   
  
    public function aceptarsec($aprob){
        
        include "Utilerias/leevar.php";
       // var_dump($_GET);
        try{
           
            $estatus=$na=0;
              $datosController= array("id"=>$id,
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
                        "nummuestra"=>0
                    );
                   // var_dump($datosController);
                 
                    DatosValSeccion::actualizaValidacionsecmues($datosController,"sup_validasecciones");
                  //  die();
            }else{
              
                if($this->idval==0)
                {
                
               
                  //  echo "no hay nada";
                    // inserta validacion
                    $datosController= array("id"=>$id,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "estatus"=>1,
                        "ideta"=>1,
                    );
                    
                    // inserta validacion detalle
                    DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
                
                    // busca numero de validacion
                    $datosController= array("id"=>$id,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "ideta"=>1
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
                    "nummuestra"=>0
                );
                //var_dump($datosController2);
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
                
            } 
            if($estatus==1)//se acepta el informe reviso que los demas estén aceptados
            {
                $ban=0;
                //busco las lista que tiene el recolector y el indice
                $resplis=DatosListaCompra::getListaComRec($idrec,$idmes,"pr_listacompra");
               // var_dump($resplis);
                foreach($resplis as $row){
               //     echo "<br>--".$row["lis_idplanta"];
                    //para cada planta reviso que ya esté aceptada
                    $resprev=DatosCorreccion::getPrepPlanta($idmes,$idrec,$row["lis_idplanta"],$sec,1,"informes_etapa");
                    
                  //  var_dump($resprev);
                    if($resprev!=null)//ya está aprovada
                    {
                        $ban=1;
                        
                    }
                    else 
                    {$ban=0;
                    break; //con uno no aprobado o uno que falte no puedo continuar
                    }
                   
                }
                //echo "***".$ban;
                if($ban==1)//ya están todas las plantas
                {
                    DatosRecolector::actualizarEtapa($idrec,2,"ca_recolectores");
                }
                
            }
            // if existe en validacion
            if($estatus==2&&$can==1)//si se cancela
            {
                //busco el informe estapa
                DatosInformeEtapa::updateEstatus($id,2,$idrec,$idmes,"informes_etapa");
                $datosController2= array("idval"=> $this->idval,
                    
                    "estatus"=>2,
                    
                );
                DatosValidacion::actualizaValidacionpr($datosController2,"sup_validacion");
                
            }
        
        //die();
                echo "
            <script type='text/javascript'>
              window.location='$this->liga'
                </script>
                  ";
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
    }
    
    public function solcorreccion(){
        
        include "Utilerias/leevar.php";
        
        
     
        
        try{
          
                //revisa si existe validacion en imagenes
                 if ($this->correccionFoto!=null) {
                    // actualiza g
                   // echo "encontre la foto";
                    $datosController= array("idval"=>$this->idval,
                        "idimg"=>$numimg,
                        "est"=>$est
                       
                    );
                 //   var_dump($idval);
                //    var_dump($datosController);
                    $ex= DatosValidacion::actualizaValidacionimg($datosController, "sup_validafotos");
                    $datoscorr=array("idval"=>$this->idval,
                        "idfoto"=>$numimg
                    );
                    $this->buscarCorreccionFoto($datoscorr);
                   // die();
                    
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
                        "desimg"=>10,
                        "est"=>$est,
                        "observ"=>$observ,
                        "cli"=>$cli,
                        "cons"=>1
                    );
                    DatosValidacion::ingresaValidacionimg2($datosController, "sup_validafotos");
                    $datoscorr=array("idval"=>$this->idval,
                        "idfoto"=>$numimg
                    );
                    $this->buscarCorreccionFoto($datoscorr);
                
            }
            
            echo "
            <script type='text/javascript'>
              window.location='$this->liga'
                </script>  ";
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
        
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
    
    public function buscarSeccion($datosController,$sec){
       // var_dump( $datosController);
        $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");
     // var_dump($respuesta);
        // valido si se encuentra
        if (sizeof($respuesta)>0) {
            foreach($respuesta as $row => $item){
                $this->idval= $item["val_id"];
            }
          //  var_dump($respuesta);
            // valida si existe validacion en seccion
            // revisa si ya existe
            $datosController= array("idval"=>$this->idval,
                "idsec"=>$sec,
                "nummuestra"=>0
            );
           // var_dump($this->muestra);
          //  var_dump($datosController);
            $respuestaS =DatosValSeccion::getValSeccionMues($datosController, "sup_validasecciones");
           //echo "**********";
          //  var_dump($respuestaS);
            if (sizeof($respuestaS)>0) {
                $this->valSeccion=$respuestaS[0];   
                $resnoap= $this->valSeccion["vas_noaplica"];
                if ($resnoap==0){
                    $resacep= $this->valSeccion["vas_aprobada"];
                    if ($resacep==0){
                        $this->opcsel=3;
                    } else {
                        $this->opcsel=1;
                    }
                } else {
                    $this->opcsel=2;
                }  
            
            }
            
        }
       // var_dump($this->valSeccion);
    }
    
 
    public function getopcsel() {
        return $this->opcsel;
    }
    
    public function getListaCompra($planta){
       // echo $idcompra;
        $respuesta =DatosListaCompra::getListaComDetxPlanRec($planta,$this->rec_id,$this->mesas,"pr_listacompradetalle");
        $this->totalsol=0;
     
        if($respuesta!=null){
            $listanueva=array();
            //busco codigos no permitidos
            foreach($respuesta as $row => $item){
                $nuevaitem= $item;
               
                $mes_asig=$item["lis_idindice"];
                $idcompra=$item["lis_idlistacompra"];
                
                $aux = explode(".", $mes_asig);
                
                $solomes = $aux[0];
                $soloanio = $aux[1];
                
                $mes1 = $solomes -1;
                if ($mes1==0){
                    $mes1=12;
                    $soloanio = $aux[1]-1;
                }
                $mes2 = $solomes -2;
                if ($mes2==-1){
                    $mes2=11;
                    $soloanio = $aux[1]-1;
                } else if ($mes2==0){
                    $mes2=12;
                    $soloanio = $aux[1]-1;
                }
                
                
                $mesant1=$mes1.".".$soloanio;
                $mesant2=$mes2.".".$soloanio;
                
                //       solicita codigos del primer mes
                $datosCont= array("cnpindi1"=>$mesant1,
                    "cnpindi2"=>$mesant2,
                    "mesasig" =>$mes_asig,
                    "planta"=>$item["lis_idplanta"],
                    "cnpprod"=>$item["lid_idproducto"],
                    "cnptam"=>$item["lid_idtamano"],
                    "cnpempa"=> $item["lid_idempaque"],
                    "cnptipana"=>$item["lid_idtipoanalisis"],
                );
                $nuevaitem["codigosnop"]= $this->getCodigosNoPerm($datosCont);
                $this->totalsol=$item["lid_cantidad"]+$this->totalsol;
                $listanueva[]=$nuevaitem;
                
            }
            $detalles=$this->buscarTotMuestras($idcompra,$listanueva);
           
        //   var_dump($detalles);
           $detalles = $this->buscarBU($idcompra,$detalles);
           
           
       // calcularTotales(detalles);
        
        
        //ordeno la lista
        /* Collections.sort( detalles, new Comparator<ListaCompraDetalle>() {
         @Override
         public int compare(ListaCompraDetalle lhs, ListaCompraDetalle rhs) {
         return Integer.compare( lhs.getLid_orden(),rhs.getLid_orden());
         }
         });*/
         $siglas="";
        // Log.d(TAG,"siglas kkkkkk "+lista.getSiglas());
        //pongo el nombre
        }
    
        
          $this->listaCompra=$detalles;
       //   var_dump( $this->listaCompra);
                    
    }
  
    
    public function buscarTotMuestras($idlistacompra,$listalcd){
       
        $listanueva=array();
        foreach ($listalcd as $lcdo ) {
            // Log.d(Constantes.TAG, "revisando nuevos codigos " +lcd.getNvoCodigo());
            $nuevaitem= $lcdo;
            
            $comprados = $this->getNumMuestra($idlistacompra,$lcdo["lid_idprodcompra"]);
              
            $nuevaitem["comprados"]=$comprados;
                  
            $listanueva[]=$nuevaitem;
        }
        return $listanueva;
    }
    //aqui guardo los backups
    public function buscarBU($idlistacompra,$listalcd){
       
       $listanueva=array();
        foreach ($listalcd as $lcdo ) {
                // Log.d(Constantes.TAG, "revisando nuevos codigos " +lcd.getNvoCodigo());
               $nuevaitem= $lcdo;
              // echo "<br>";
             //   var_dump($nuevaitem);
               $comprabu = $this->getBackup($idlistacompra,$lcdo["lid_idprodcompra"]);
               $totbu=sizeof($comprabu);
             //  echo "<br>".$lcdo["lid_idprodcompra"]."--".$totbu;
                if (sizeof($comprabu) > 0) {
                    
                    //  listacomprasbu.addAll(comprabu);
                   // $nuevaitem["comprados"]=$nuevaitem["comprados"]-$totbu;
                  //  $nuevaitem["lid_cantidad"]=$nuevaitem["lid_cantidad"]-$totbu;
                    if($comprabu["ind_estatus"]==3) //aceptada
                        $nuevaitem["lid_saldoaceptado"]= $nuevaitem["lid_saldoaceptado"]-$totbu;
                    $nuevaitem["Infcd"]=$comprabu;
                    if($nuevaitem["comprados"]==$nuevaitem["lid_cantidad"])
                        $nuevaitem["completado"]=true;
                }
                $listanueva[]=$nuevaitem;
        }
        return $listanueva;
    }
    
   
    
    public function getBackup($idcompra,$iddetalle) {
        //busco si tiene un backup
        return DatosInformeDetalle::getByCompraBu($idcompra,$iddetalle,$this->mesas,$this->rec_id,"informe_detalle");
    }
    
    public function getNumMuestra($idcompra,$iddetalle){
        $resp=DatosInformeDetalle::getByCompra($idcompra,$iddetalle,$this->mesas,$this->rec_id,"informe_detalle");
        return sizeof($resp);
    }
    
    public function getCodigosNoPerm($datosCont){
      //  solicita codigos del primer mes
       
        //var_dump($datosCont);
        
        $CodNoPerm="";
        
        $resp1 =DatosListaCompraDet::vistacodigosnopermitidos($datosCont, "informe_detalle");
        //var_dump($resp1);
        foreach($resp1 as $row => $item1){
            //    var_dump($item1["ind_caducidad"]);
            $fecpartida=explode("-", $item1["ind_caducidad"]);
            
            $codnop = $fecpartida[2]."-".$fecpartida[1]."-".substr($fecpartida[0],2,2);
            //var_dump($codnop);
            $CodNoPerm= $CodNoPerm."=".$codnop." , ";
        } 
        return $CodNoPerm;
    }
    
    public function getLigapanp(){
        //devuelve a la 1er pantalla
        if($this->numpan>4)
            return "index.php?action=suppreparacion&idmes=".$this->mesas."&idrec=".$this->rec_id."&idplan=".$this->idplan.'&cli='.$this->idcli."&eta=".$this->etapa;
        return "";
        
    }
    public function getLigapanu(){
        //devuelve a la ultima pantalla
       
        if($this->numpan<9)
            return "index.php?action=suppreparacion&idmes=".$this->mesas."&idrec=".$this->rec_id."&idplan=".$this->idplan.'&cli='.$this->idcli."&eta=".$this->etapa.'&numdet='. $this->numdet;
        return "";
    }
    
    
    
    
}



