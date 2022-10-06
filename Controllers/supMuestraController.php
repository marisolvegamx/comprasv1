<?php
//error_reporting(E_ERROR|E_NOTICE|E_WARNING);
//ini_set("display_errors", 1); 
include "Models/crud_pantalla.php";
include 'Models/crud_informesDetalle.php';
//include 'Models/crud_imagenesDetalle.php';
include 'Models/crud_supvalmuestras.php';
include 'Models/crud_supvalseccion.php';
include 'Models/crud_productoExhibido.php';
include 'Models/crud_informes.php';

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
     public $correccionFoto;
     public $valSeccion;
     public $etapa=2;
     public $seccion;
     public $idval;
     public $numpan;
     
    public function vistaMuestra(){
        $vis=$_GET["id"];
        $this->mesas=$_GET["idmes"];
        $this->rec_id=$_GET["idrec"];
        $this->idcli=$_GET["cli"];
        $this->idinf=$_GET["inf"];
        $numpantalla=$_GET["pan"];
        $this->numuestra=$_GET["nummues"];
        $admin=$_GET["admin"];
        $this->numpan=$numpantalla;
          
        if($admin=="act"){
            $this->actualizarMuestra();
        }
       
        
      
    
        $datosCont= array("idinf"=>$vis,
            "idmes"=>$this->mesas,
            "idrec"=>$this->rec_id,
            "cli"=>$this->idcli
        );
        $this->indiceletra=Utilerias::indiceConLetra($this->mesas);
        
        $resp =DatosInforme::vistaSupInformeDetalleModel($datosCont, "informes");
      // var_dump($resp);
        if($resp!=null)
        $this->informe=$resp[0];
        $this->idinf=$this->informe["inf_id"];
        $this->liga="index.php?action=supinformecli02&idmes=".$this->mesas."&idrec=".$this->rec_id."&id=".$vis.'&cli='.$this->idcli.'&pan='.$numpantalla.'&nummues='. $this->numuestra.'&inf='.$this->idinf;
        
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
        
        $datosCont= array("idinf"=>$this->idinf,
            "idmes"=>$this->mesas,
            "idrec"=>$this->rec_id,
            "cli"=>$this->idcli
        );
         $resp2=DatosSupvisita::vistaSupInfvisModel($datosCont, "visitas");
         $this->buscarMuestras();
         //  var_dump($this->muestras);
         $this->destruirSesion();
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
       if($numpantalla==7)
           $this->buscarImagenesPan7();
       else
             $this->buscarImagenes();
       // var_dump($this->listaimagenes);
        $datosController= array("id"=>$this->idinf,
            "idrec"=>$this->rec_id,
            "indice"=>$this->mesas,
            "ideta"=>$this->etapa,
        );
        $this->buscarSeccion($datosController,$numpantalla);
        $datoscorr=array("idval"=>$this->idval,
            "idfoto"=>$this->listaimagenes[0]["id"]
        );
        
        $this->buscarCorreccionFoto($datoscorr);
        
        if($admin=="aceptarsec"){
            $this->aceptarsec(1);
        }
        if($admin=="noaceptarsec"){
            $this->aceptarsec(0);
        }
        if($admin=="solcor"){
            $this->solcorreccion($est);
        }
        
        
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
                //$fcaducidad=Utilerias::$caducidad
                DatosInformeDetalle::actualizar($ind_id,$origen,$qr,$siglasprod,$codigo,$costo,$caducidad,$atributoa,$atributob,$atributoc, $idrec, $idmes, "informe_detalle");
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
        $idfoto4=$this->informe["inf_ticket_compra"];
        $result=DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto4,"imagen_detalle");
        
        $this->listaimagenes[]=$result;
       // var_dump($this->listaimagenes);
        
    }
    
    public function buscarImagenesPan7(){
        //de lo que tengo en la tabla pantalla busco en los campos de la muestra con ind_
        //por el id en la tabla de imagenes
       // var_dump($this->informe);
        //  echo "+++".$this->pantalla["pa_foto1"];
       
        $idfoto1=$this->informe["inf_ticket_compra"];
      
        //busco la ruta
        $result=DatosImagenDetalle::getImagen($this->mesas,$this->rec_id,$idfoto1,"imagen_detalle");
        
        $this->listaimagenes[]=$result;
        
        if($this->pantalla["pa_foto2"]!=null&&$this->pantalla["pa_foto2"]=="foto producto exhibido"){
             
            //busco en productos exhibidos
          //  echo $this->mesas."--".$this->rec_id."--".$this->informe["inf_visitasIdlocal"]."--".$this->idcli;
            $result=DatosProductoExhibido::getProdExxCliente($this->mesas,$this->rec_id,$this->informe["inf_visitasIdlocal"],$this->idcli,"producto_exhibido");
          /*  if($result!=null)//paso a imagen
            {
                $imagenex=array("imd_idlocal"=>$result["imagenId"],
                    "imd_descripcion"=>$result["foto producto exhibido"], 
                    "imd_ruta"=>$result["id"], 
                    "imd_estatus"=>$result["id"], 
                    "imd_indice"=>$result["id"],
                    "imd_usuario"=>$result["id"]);


                    
            }*/
           // var_dump($result);
            $this->listaimagenes[]=$result;
            
        }
       
        // var_dump($this->listaimagenes);
        
    }
    public function aceptarsec($aprob){
        
        include "Utilerias/leevar.php";
      //  var_dump($_GET);
        try{
            if ($pan) {
                $pan= "0".$pan;
            }
            $estatus=0;
              $datosController= array("id"=>$inf,
                "idrec"=>$idrec,
                  "indice"=>$idmes,
                "ideta"=>$eta,
            );
                //ya tenía respuesta
              //var_dump($this->valSeccion);
              if($aprob==0){
                  $estatus=2;
              }else
              {    $estatus=3; //aceptada
              
              
              }
            if ($this->valSeccion!=null) {
                    //echo "lo encontre";
                    $datosController= array("idval"=>$this->idval,
                        "idsec"=>$sec,
                        "idaprob"=>$aprob,
                        "noap"=>0,
                        "observ"=>$observacionessec,
                        "estatus"=>$estatus,
                        "nummuestra"=>$iddet
                    );
                    DatosValSeccion::actualizaValidacionsecmues($datosController,"sup_validasecciones");
            }else{
              
                if($this->idval==0)
                {
                
               
                    //echo "no hay nada";
                    // inserta validacion
                    $datosController= array("id"=>$inf,
                        "idrec"=>$idrec,
                        "indice"=>$idmes,
                        "estatus"=>1,
                        "ideta"=>2,
                    );
                    
                    // inserta validacion detalle
                    DatosValidacion::InsertaValidacion($datosController, "sup_validacion");
                
                    // busca numero de validacion
                    $datosController= array("id"=>$inf,
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
                if ($sec==1){
                    $descrip="ubicacion de la tienda";
                }else{
                    if ($sec==2){
                        $descrip="direccion en ticket";
                    }
                }
                $datosController2= array("idval"=> $this->idval,
                    "idsec"=>$sec,
                    "descrip"=>$descrip,
                    "idaprob"=>$aprob,
                    "noap"=>0,
                    "observ"=>$observacionessec,
                    "estatus"=>$estatus,
                    "nummuestra"=>$iddet
                );
               // var_dump($datosController2);
                DatosValSeccion::ingresaregvalsecmues($datosController2, "sup_validasecciones");
                $datosController= array("idval"=>$this->idval,
                    "idsec"=>$sec,
                );
                //var_dump($datosController);
                $respuestaS =DatosValidacion::LeeIdImgValidacion($datosController, "sup_validasecciones");
                if (sizeof($respuestaS)>0) {
                    $this->valSeccion=$respuestaS[0];   
                }
                
            }  // if existe en validacion
            //inserto la muestra en la tabla de supervision para poner el resultado
            
          //  $respmue=DatosValMuestra::getValidacionMuestra($idval,$this->numuestra,"sup_validamuestras");
                 
         //  var_dump($respmue);
          
           /* if($respmue!=null&&sizeof($respmue)>0){
                //actualizo
                $respmue["vam_estatus"]=$estatus;
                DatosValMuestra::UpdateValidacion($respmue,"sup_validamuestras");
            }else //inserto
            { */
            //todo ver primero si la muestra ya se acepto o se rechazo para antes de sumar o restar
            
                if($aprob==1){
                    //actualizo los aceptados en la lista de compra
                    
                    DatosListaCompraDet::sumaAceptadosLista($this->muestra["ind_comprasid"],$this->muestra["ind_compraddetid"],1,"pr_listacompradetalle");
                    
                }else 
                {   //quito una comprada
                    DatosListaCompraDet::restaAceptadosLista($this->muestra["ind_comprasid"],$this->muestra["ind_compraddetid"],1,"pr_listacompradetalle");
                    
                    //reviso si es la unica muestra para cancelar el informe
                    if(sizeof($this->muestras)==1){
                        $datosController2= array("idval"=> $this->idval,
                           
                            "estatus"=>3,
                          
                        );
                        DatosValidacion::actualizaValidacionpr($datosController2,"sup_validacion");
                    }
                }
              /*  $datosControllermu= array("vam_id"=>$idval,
                    "vam_idprod"=>$this->muestra["ind_comprasid"],
                    "vam_cantidad"=>1,
                    "vam_idmuestra"=>$this->numuestra,
                    "vam_prodcompra"=>$this->muestra["ind_compraddetid"],
                    "vam_estatus"=>$estatus
                );*/
                 //   echo "****".$this->muestra["ind_id"];
               //     DatosValMuestra::InsertaValidacion($datosControllermu,"sup_validamuestras");
                DatosInformeDetalle::actualizarEstatus($this->muestra["ind_id"], $idrec, $idmes, $estatus, "informe_detalle");
            
           // die($this->muestra["ind_comprasid"]."--".$this->muestra["ind_compraddetid"]);
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
    
    public function solcorreccion($aprob){
        
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
                        $datosController= array("id"=>$inf,
                            "idrec"=>$idrec,
                            "indice"=>$idmes,
                            "ideta"=>$eta,
                            "estatus"=>1,
                        );
                        
                        // inserta validacion detalle
                        DatosValidacion::InsertaValidacion($datosController, "sup_validacion")
                        ;
                        // busca numero de validacion
                        $datosController= array("id"=>$inf,
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
                    $resfoto= DatosCatalogoDetalle::getDetallexDesc($this->pantalla["pa_foto1"],20,"ca_catalogosdetalle");
                   // var_dump($resfoto);
                   if($resfoto!=null)
                        $numfoto=$resfoto["cad_idopcion"];
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
        // valido si se encuentra
        if (sizeof($respuesta)>0) {
            foreach($respuesta as $row => $item){
                $this->idval= $item["val_id"];
            }
            //var_dump($idval);
            // valida si existe validacion en seccion
            // revisa si ya existe
            $datosController= array("idval"=>$this->idval,
                "idsec"=>$sec,
                "nummuestra"=>$this->muestra["ind_id"]
            );
            //var_dump($datosController);
            $respuestaS =DatosValSeccion::getValSeccionMues($datosController, "sup_validasecciones");
           //echo "**********";
           // var_dump($respuestaS);
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
      //  var_dump($this->valSeccion);
    }
    
 
    public function getopcsel() {
        return $this->opcsel;
    }
    
    public function getListaCompra($idcompra){
        
        $respuesta =DatosInformeDetalle::getListaComDet($idcompra,"pr_listacompradetalle");
        $i=0;
     
        if($respuesta!=null){
            $listanueva=array();
            //busco codigos no permitidos
            foreach($respuesta as $row => $item){
                $nuevaitem= $item;
               
                $mes_asig=$item["lis_idindice"];
                
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
    
    public function calcularVigencia($fechacompra,$fechacad){
        
        $fechacompf=new DateTime($fechacompra);
        $fechacadf=new DateTime($fechacad);
      //  echo $fechacompra."--".$fechacad;
        $vig=$fechacadf->diff($fechacompf);
        return $vig->days;
        
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
            return "index.php?action=supinformecli01&idmes=".$this->mesas."&idrec=".$this->rec_id."&id=".$this->idinf.'&cli='.$this->idcli;
        return "";
        
    }
    public function getLigapanu(){
        //devuelve a la ultima pantalla
       
        if($this->numpan<9)
            return "index.php?action=supinformecli09&idmes=".$this->mesas."&idrec=".$this->rec_id."&id=".$this->idinf.'&cli='.$this->idcli;
        return "";
    }
    
    
    
    
}



