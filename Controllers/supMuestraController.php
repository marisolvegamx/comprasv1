<?php
//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
//ini_set("display_errors", 1); 
include "Models/crud_pantalla.php";
include 'Models/crud_informesDetalle.php';
include 'Models/crud_imagenesDetalle.php';

class SupMuestraController
{
    public $informe;
    public $visita;
    public $muestra;
    public $idinf;
    public $mesas;
    public $rec_id;
    public $idcli;
    public $pantalla;
    public $indiceletra;
     public $numuestra;
     public $muestras;
     public $listaimagenes;
     public $dirimagen;
     public $liga;
     
     public $listaCompra;
     
    public function vistaMuestra(){
        $this->idinf=$_GET["id"];
        $this->mesas=$_GET["idmes"];
        $this->rec_id=$_GET["idrec"];
        $this->idcli=$_GET["cli"];
        $numpantalla=$_GET["numpant"];
        $this->numuestra=$_GET["nummues"];
        $admin=$_GET["admin"];
        
        $this->liga="index.php?action=supinformecli02&idmes=".$this->mesas."&idrec=".$this->rec_id."&id=".$this->idinf.'&cli='.$this->idcli.'&numpant='.$numpantalla.'&nummues='. $this->numuestra;
          
        if($admin=="act"){
            $this->actualizarMuestra();
        }
        if($admin=="aceptar"){
            $this->aceptarsec(1);
        }
        if($admin=="noaceptar"){
            $this->aceptarsec(0);
        }
        
        $this->buscarMuestras();
      //  var_dump($this->muestras);
      $this->destruirSesion();
    
        $datosCont= array("idinf"=>$this->idinf,
            "idmes"=>$this->mesas,
            "idrec"=>$this->rec_id,
        );
        $this->indiceletra=Utilerias::indiceConLetra($this->mesas);
        
        $resp =DatosSupInformes::vistaSupInformeDetalleModel($datosCont, "informes");
     //  var_dump($resp);
        if($resp!=null)
        $this->informe=$resp[0];
       // $logemail= $_SESSION['Usuario'];
        // busca el email y lee el numero de sugetsupervisorpervisor
      //  $resp1 =UsuarioModel::getsupervisor($logemail,"cnfg_usuarios");
     /*   foreach($resp1 as $row => $item1){
            $numsup1= $item1["cus_cliente"];
        }*/
        $aux = explode(".", $this->mesas);
        
        $solomes = $aux[0];
        $soloanio = $aux[1];
        $this->dirimagen = "fotografias\\".$solomes."_".$soloanio;
         $resp2=DatosSupvisita::vistaSupInfvisModel($datosCont, "visitas");
        if($resp2!=null)
            $this->visita=$resp2[0];
        $this->pantalla=DatosPantalla::getPantalla($numpantalla,"sup_pantallas");
       // var_dump($this->pantalla);
        $this->muestra=$this->muestras[$this->numuestra-1];
        if($numpantalla==5){
            //echo "wwwww";
            $this->getListaCompra($this->muestra["ind_comprasid"]);
        }
       // var_dump( $this->muestra);
        $this->buscarImagenes();
        
    }
    
    public function buscarMuestras(){
        if(!isset($_SESSION["supmu_muestrascli"]))//reviso si ya tengo la consulta si no no la hago
        {   $this->muestras=DatosInformeDetalle::getMuestrasxcliente($this->idinf,  $this->mesas,    $this->rec_id,$this->idcli, "informe_detalle");
          //var_dump($this->muestras);
            //guardo en session las muestras
        $_SESSION["supmu_muestrascli"]=$this->muestras;
          
        }else
        $this->muestras= $_SESSION["supmu_muestrascli"];
        
            
    }
    
    public function actualizarMuestra(){
        include "Utilerias/leevar.php";
            try{
                
                DatosInformeDetalle::actualizar($ind_id,$codigo,$costo,$caducidad,$atributoa,$atributob,$atributoc, $idrec, $idmes, "informe_detalle");
            }catch(Exception $ex){
                echo "hubo un error ".$ex->getMessage();
            }
    }
    
    public function destruirSesion(){
        $_SESSION["supmu_muestrascli"]=null;
        
    }
    public function buscarImagenes(){
        //de lo que tengo en la tabla pantalla busco en los campos de la muestra con ind_
        //por el id en la tabla de imagenes
        //var_dump($this->pantalla);
      //  echo "+++".$this->pantalla["pa_foto1"];
     //   var_dump($this->muestra);
        $idfoto1=$this->muestra["ind_".$this->pantalla["pa_foto1"]];
       // die($idfoto1);
        //busco la ruta
        $result=DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto1,"imagen_detalle");
        
        $this->listaimagenes[]=$result;
        
        if($this->pantalla["pa_foto2"]!=null&&strlen($this->pantalla["pa_foto2"])>0){
            $idfoto2=$this->muestra["ind_".$this->pantalla["pa_foto2"]];
            $result=DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto2,"imagen_detalle");
           
                $this->listaimagenes[]=$result;
            
        }
        if($this->pantalla["pa_foto3"]!=null&&strlen($this->pantalla["pa_foto3"])>0){
            $idfoto3=$this->muestra["ind_".$this->pantalla["pa_foto3"]];
            $result=DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto3,"imagen_detalle");
           
            $this->listaimagenes[]=$result;
           
            
        }
       // var_dump($this->listaimagenes);
        
    }
    public function aceptarsec($aprob){
        
        include "Utilerias/leevar.php";
        try{
            if ($pan) {
                $pan= "0".$pan;
            }
            $est=0;
              $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                  "indice"=>$idmes,
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
                        "idaprob"=>$aprob,
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
                        "idaprob"=>$aprob,
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
                    "idaprob"=>$aprob,
                    "noap"=>0,
                    "observ"=>$solicitud,
                    "estatus"=>$est,
                );
                //var_dump($datosController2);
                DatosValidacion::ingresaregvalsec($datosController2, "sup_validasecciones");
                
                
            }  // if existe en validacion
          //  die("--".$aprob);
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
        
        
        if ($pan) {
            switch ($pan) {
                case 2:
                    $desima = "FotoFachada";
                    break;
            }
            
            $pan ="0".$pan;
            
        }
        
        try{
            
            
            // busca si el registro ya existe
            $datosController= array("id"=>$id,
                "idrec"=>$idrec,
                "indice"=>$idmes,
                "ideta"=>$eta,
            );
         //   var_dump($datosController);
            $respuesta =DatosValidacion::LeeIdValidacion($datosController, "sup_validacion");
            
            if (sizeof($respuesta)>0) {
                echo "lo encontre";
                foreach($respuesta as $rogw => $item){
                    $idval= $item["val_id"];
                    
                }
             //   var_dump($idval);
            //    var_dump($numimg);
                //revisa si existe validacion en imagenes
                $respuesta1 =DatosValidacion::LeeIdvalidafoto($idval, $numimg, "sup_validafotos");
                if (sizeof($respuesta1)>0) {
                    // actualiza g
                    echo "encontre la foto";
                    $datosController= array("idval"=>$idval,
                        "numimg"=>$numimg,
                        "estatus"=>$est,
                    );
                    var_dump($idval);
                    var_dump($datosController);
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
                    "indice"=>$idmes,
                    "ideta"=>$eta,
                    "estatus"=>1,
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
            
            echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
        }catch(Exception $ex){
            echo Utilerias::mensajeError($ex->getMessage());
        }
        
    }
    public function getopcsel() {
        return $this->opcsel;
    }
    
    public function getListaCompra($idcompra){
        
        $respuesta =DatosListaCompraDet::vistalistacomModel($idcompra,"pr_listacompradetalle");
        $i=0;
     
        if($respuesta!=null){
            $detalles=$this->buscarTotMuestras($idcompra,$respuesta);
           
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
                    
    }
   /* public void calcularTotales($detalles)
    {
        $totalPedidos=0;
        $totalcomprados=0;
        foreach($detalles as $detalle){
            int $bus=$detalle.getInfcd()!=null?detalle.getInfcd().size():0;
            totalcomprados=totalcomprados+detalle.getComprados()+bus;
            totalPedidos=totalPedidos+detalle.getCantidad();
        }
        //  Log.d(TAG,"WWWWWWWWWW estoy en los totales"+detalles.);
        //sumo los bu
        /* if(detalles.!=null) {
         totalcomprados = totalcomprados + listacomprasbu.size();
         // totalPedidos=totalPedidos+ listacomprasbu.size();
         }*/
        //pongo en el textview
     /*   mBinding.setTotal(totalcomprados+"/"+totalPedidos);
        Constantes.NM_TOTALISTA=totalPedidos;
        
    }*/
    
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
                
               $comprabu = $this->getBackup($idlistacompra,$lcdo["lid_idprodcompra"]);
               $totbu=sizeof($comprabu);
              // echo "<br>".$lcdo["lid_idprodcompra"]."--".$totbu;
                if (sizeof($comprabu) > 0) {
                    
                    //  listacomprasbu.addAll(comprabu);
                  
                  //  $nuevaitem["comprados"]=$nuevaitem["comprados"]-$totbu;
                  //  $nuevaitem["Infcd"]=$comprabu;
                    if($nuevaitem["comprados"]==$nuevaitem["cantidad"])
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
       
    
    
    
}



