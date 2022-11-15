<?php
class ListaComDetController{
Private $listaCliente;
Private $listaPlanta;
Private $listaIndice;
Private $listaRecolector;
private $mensaje;

Private $admin;

public function NvolisComDetController(){
     // leer registro de lista y obtener idclien para producto


     $rs = DatosProd::listaprodModel(10, "ca_catalogosdetalle");
          
      $this->listaPais = null;

      foreach ($rs as $row) {
        if (($row["cad_idopcion"]) == 1) {
        $this->listaPais[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
        } else {
        $this->listaPais[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
        }
      }
}

    public function vistalisComDetController(){
			include "Utilerias/leevar.php";
			if(isset($_GET["admin"])){
          $admin=$_GET["admin"];
          $id=$_GET["id"];

	        if($admin=="ins"){
		        	$this->insertar();
 				  }else if($admin=="act"){
				      $this->actualizar();    			
			    }else if($admin=="eli"){
				      $this->eliminar();
          }else if($admin=="dup"){
              $this->duplica();
          }else if($admin=="cnp"){
              $this->addcodigo();
          }else if($admin=="imp"){
              $this->imprimir();    
          }	
			}

      echo '
     <div class="card-body"> 
     <table class="table table-bordered" id="listacompra">
                  <thead>
                    <th align="center" style="width: 15%">PRODUCTO</th>
                    <th align="center" style="width: 5%">TAMAÑO</th>
                    <th align="center" style="width: 5%">EMPAQUE</th>
                    <th align="center" style="width: 5%">ANALISIS</th>
                    <th align="center" style="width: 5%">CANT</th>
                    <th align="center" style="width: 5%">TIPO MUESTRA</th>
                    <th align="center" style="width: 8%">CODIGOS NO PERMITIDOS</th>
                    <th align="center" style="width: 8%">RESTRINGIR CODIGO</th>
                    <th align="center" style="width: 8%">PERMITIR CODIGO</th>
                    <th align="center" style="width: 5%">BACKUP 
                        <input type="hidden" class="form-control" name="idlis" id="idlis" value='.$id.'
                       
                    </th>
                    <th align="center" style="width: 5%">NO. TIENDA</th>
                    <th align="center" style="width: 5%">BORRAR</th>
                  </tr>
                  </thead>
                  <tbody>
              ';
            $totcant=0;  
// lee la lista de compra detalle con el numero de lista
//die($id);
      $respuesta =DatosListaCompraDet::vistalistacomModel($id,"pr_listacompradetalle");
   //   echo "hola?";
      $i=0;

      foreach($respuesta as $row => $item){

          $numtienbk =$item["lid_numtienbak"];
          $numprod =$item["lid_orden"];
          $numprodlis= $item["lid_idprodcompra"];
          $idprod = $item["lid_idproducto"];
          $producto = DatosProd::getnomprodModel($idprod, "ca_productos");
          $idtam= $item["lid_idtamano"];
          $tamano = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",13,$idtam);
          $idemp = $item["lid_idempaque"];
          $tipoempaque = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",12,$idemp);  
          $idtipoana = $item["lid_idtipoanalisis"];
          $tipoanalisis = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",7,$idtipoana);  
          $cantidad = $item["lid_cantidad"];
          $idtipomues = $item["lid_tipo"];
          $tipomuestra = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",15,$idtipomues);
          $idbackup =  $item["lid_backup"];

          $fecperm = $item["lid_fechapermitida"];
         // $fecrest = $item["lid_fecharestringida"];
          if(strlen($item["lid_fecharestringida"])>0){
              $fecrest=$this->ordenarFechas($item["lid_fecharestringida"]);
          }else $fecrest="";
          
          $totcant= $totcant+$cantidad;
          
       
          
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

          $planta=$item["lis_idplanta"];
          $mesant1=$mes1.".".$soloanio;
          $mesant2=$mes2.".".$soloanio;
         
//       solicita codigos del primer mes
          $datosCont= array("cnpindi1"=>$mesant1,
                            "cnpindi2"=>$mesant2,
                            "mesasig" =>$mes_asig,
                            "planta"=>$planta,
                            "cnpprod"=>$idprod,
                            "cnptam"=>$idtam,
                            "cnpempa"=>$idemp,
                            "cnptipana"=>$idtipoana, 
                               );
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
     
     // solicita codigos del segundo mes
        //$datosController2= array("cnpindi"=>$mesant2,
        //                    "planta"=>$planta,
        //                    "cnpprod"=>$idprod,
        //                    "cnptam"=>$idtam,
        //                    "cnpempa"=>$idemp,
        //                    "cnptipana"=>$idtipoana, 
        //                       );
        
      //$resp2 =DatosListaCompraDet::vistacodigosnopermitidos($datosController2, "informe_detalle");
    foreach($resp2 as $row => $item1){
         // var_dump($item1["ind_caducidad"]);
          $fecpartida=explode("-", $item1["ind_caducidad"]);
         
          $codnop = $fecpartida[2]."-".$fecpartida[1]."-".substr($fecpartida[0],2,2);
           //var_dump($codnop);
         $CodNoPerm= $CodNoPerm."=".$codnop.",  ";
      } 

      if ($idbackup==-1){
         $opb='<div class="form-group clearfix"><input type="checkbox"  class="icheck-primary d-inline" name="chk'.$numprodlis.'" checked></div>';

      } else {
        $opb='<div class="form-group clearfix"><input type="checkbox"  class="icheck-primary d-inline" name="chk'.$numprodlis.'" value="no" ></div>';
      }
      $txtnumtienbk='<input type="text" class="form-control" name="ntchk'.$numprodlis.'" value='.$numtienbk.'>';
      
      echo '      
                  <tr >   
                    
                    <td align="center"><a href="index.php?action=editacompradetalle&id='.$id.'&idp='.$numprodlis.'">'.$producto.'</a></td>
                    <td align="center">'. $tamano.'<input type="hidden" class="form-control" id="ordn" name="ordn" value="'.$numprodlis.'" > </td>
                    <td align="center">'.$tipoempaque.'</td>
                    <td align="center">'.$tipoanalisis.'</td>
                    <td align="center">'.$cantidad.'</td>
                    <td align="center">'.$tipomuestra.'</td>
                    <td align="center">'.$CodNoPerm.'</td>
                    <td align="center">'.$fecrest.'</td>                   
                    <td align="center">'.$fecperm.'</td>
                    <td align="center">'.$opb.'</td>
                    <td align="center">'.$txtnumtienbk.'</td>

                   
                    <td align="center"><a type="button" href="index.php?action=listacompradet&admin=eli&id='.$id.'&idp='.$numprodlis.'" onclick="return dialogoEliminar();"><i class="fa fa-trash-alt fa-lg"></i></a></td>
                    
                  </tr>';
              $i = $i+1;

            }     

            echo '
                  </tbody>
                  <tfoot>
                  <tr>
                     <th></th>
                    <th><input type="hidden" class="form-control" id="totreg" name="totreg" value="'.$i.'" > </th>
                    <th></th>
                    <th>TOTAL</th>
                    <th align="center">'.$totcant.'</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->';


			$respuesta =DatosListaCompra::vistalistacomModel("","pr_listacompra");
			foreach($respuesta as $row => $item){
           // var_dump($item);
           $idcliente=$item["lis_idcliente"];
           $resclien=Datosnuno::vistaN1opcionModel($idcliente, "ca_nivel1");
           foreach($resclien as $row => $itemc){
               $nomcliente=$itemc["n1_nombre"];
           }   
           $idplanta=$item["lis_idplanta"];
           $resplanta=Datosncin::vistancinOpcionModel($idplanta, "ca_nivel5");
           foreach($resplanta as $row => $regplan){
              $nomplanta=$regplan["n5_nombre"];
           }  
				   $idindice= $item["lis_idindice"];

           $idrec= $item["lis_idrecolector"];   
                
           $resrecolector=DatosRecolector::vistarecdetModel($idrec, "ca_recolectores");
           foreach($resrecolector as $row => $regrec){
              $nomrecolector=$regrec["rec_nombre"];
           }  

				

	        }        
		}

    public function vistaNuevoProductoCompra() {
      include "Utilerias/leevar.php";
      $this->numlista = $id;
      // busca el cliente
      $rs=DatosListaCompra::vistalistaEnccomModel($id, "pr_listacompra");
      $cliente = null;
      foreach ($rs as $row) {
        $cliente = $row ["lis_idcliente"];
      }

      $rs = DatosProd::listaprodModel($cliente,"ca_productos");    
      $this->listaProducto = null;
      foreach ($rs as $row) {
        $this->listaProducto[] = "<option value='" . $row ["pro_id"] . "'>" . $row ["pro_producto"] . "</option>";
      }

        $rs = DatosCatalogoDetalle::listaCatalogoDetalle(13, "ca_catalogosdetalle");
        $this->listatamano = null;
        foreach ($rs as $row) {     
            $this->listatamano[] =  "<option value='" . $row [1] . "'>" . $row [2] . "</option>";  
        }
 
        $rs = DatosCatalogoDetalle::listaCatalogoDetalle(7, "ca_catalogosdetalle");     
        $this->listatipoana = null;
        foreach ($rs as $row) {     
            $this->listatipoana[] =  "<option value='" . $row [1] . "'>" . $row [2] . "</option>";  
        }
 
        $rs = DatosCatalogoDetalle::listaCatalogoDetalle(12, "ca_catalogosdetalle");
        $this->listaempaque = null;
        foreach ($rs as $row) {
           $this->listaempaque[] = "<option value='" . $row[1] . "'>" . $row[2] . "</option>";
        }

        $rs = DatosCatalogoDetalle::listaCatalogoDetalle(15, "ca_catalogosdetalle");
        $this->listatpomues = null;
        foreach ($rs as $row) {
           $this->listatipomues[] = "<option value='" . $row[1] . "'>" . $row[2] . "</option>";
        }

    }

	public function getListaProducto() {
      var_dump($this->listaProducto);
      return $this->listaProducto;
    }
  public function getListaTamano() {
    var_dump($this->listatamano);
      return $this->listatamano;
    }
  public function getListatipoana() {
    var_dump($this->listatipoana);
      return $this->listatipoana;
    }
  public function getListaEmpaque() {
    var_dump($this->listaempaque);
      return $this->listaempaque;
    }  
  public function getListaTipoMues() {
    var_dump($this->listatipomues);
      return $this->listatipomues;
    }  
  public function getnumLista() {
      return $this->numlista;
    }
	
public function insertar(){
		
	include "Utilerias/leevar.php";
     $regresar="index.php?action=listacompradet&id=".$idlista;
     $ssql="SELECT max(`lid_idprodcompra`) FROM `pr_listacompradetalle` WHERE `lid_idlistacompra` = :idlista";
   // try{
    $stmt = Conexion::conectar()->prepare($ssql);
    $stmt->bindParam(":idlista", $idlista,PDO::PARAM_INT);
    $stmt->execute();
    $res=$stmt->fetch();
    if($res){
        $claop=$res[0]+1;
      
    }else{
      $claop=1;
    }
   
	try{
		
    
		$datosController= array("idlis"=>$idlista,
                            "claop"=>$claop,
                            "numprod"=>$numprod,
								             "numtam"=>$numtam,
      						           "numemp"=>$numemp,
                             "tipana"=>$tipana,
                            "cantidad"=>$cantidad,
                            "tipomues"=>$tipomues,
                            "fecres"=>$fecres,
                            "fechab"=>$fechab,
                               );
		$rs= DatosListaCompraDet::insertarProdLista($datosController, "pr_listacompradetalle");
			
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
	   echo Utilerias::mensajeError($ex->getMessage());
	}
		
	}


public function editaliscompradet(){
     // lee registro
  include "Utilerias/leevar.php";
        
  $respuesta =DatosListaCompraDet::vistalistacomdetModel($id, $idp, "pr_listacompradetalle");
      foreach($respuesta as $row => $item){
          $numclien = $item["lis_idcliente"];
          $numprod= $item["lid_idproducto"];
          $numtam= $item["lid_idtamano"];
          $numemp= $item["lid_idempaque"];
          $tipana= $item["lid_idtipoanalisis"];
          $tipmues= $item["lid_tipo"];
          $this->cante= $item["lid_cantidad"];
          $this->fecrese= $item["lid_fecharestringida"];
          $this->fecpere= $item["lid_fechapermitida"];
          $this->orden= $item["lid_orden"];
          $this->ide= $id;
          $this->idpe=$idp;
          }

      //$rs = DatosProd::vistaprodModel("ca_productos");
      $rs = DatosProd::listaprodModel($numclien,"ca_productos");    
      $this->listaProde = null;

      foreach ($rs as $row) {
        if (($row["pro_id"]) == $numprod) {
        $this->listaProde[] = "<option value='" . $row["pro_id"] . "' selected>" . $row["pro_producto"] . "</option>";
        } else {
        $this->listaProde[] = "<option value='" . $row["pro_id"] . "'>" . $row["pro_producto"] . "</option>";
        }
      }


      $rs = DatosCatalogoDetalle::listaCatalogoDetalle(13, "ca_catalogosdetalle");
          
      $this->listatamano = null;

      foreach ($rs as $row) {
        if (($row["cad_idopcion"]) == $numtam) {
        $this->listatamanoe[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
        } else {
        $this->listatamanoe[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
        }
      }
      
      $rs = DatosCatalogoDetalle::listaCatalogoDetalle(12, "ca_catalogosdetalle");
             
      $this->listaTipempe = null;

      foreach ($rs as $row) {
        if (($row["cad_idopcion"]) == $numemp) {
        $this->listaTipempe[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
        } else {
        $this->listaTipempe[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
        }
      }
       

      $rs = DatosCatalogoDetalle::listaCatalogoDetalle(7, "ca_catalogosdetalle");
             
      $this->listatipanae = null;

      foreach ($rs as $row) {
        if (($row["cad_idopcion"]) == $tipana) {
        $this->listatipanae[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
        } else {
        $this->listatipanae[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
        }
      }  

      $rs = DatosCatalogoDetalle::listaCatalogoDetalle(15, "ca_catalogosdetalle");
             
      $this->listatipmuese = null;

      foreach ($rs as $row) {
        if (($row["cad_idopcion"]) == $tipmues) {
        $this->listatipmuese[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
        } else {
        $this->listatipmuese[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
        }
      }  

}
//chechie
public function ordenarFechas($cadenafechas){
    $listarestrin=array();
    $codigos="";
   
  //  echo "<br>mmmmmm". $cadenafechas;
    
    $listarestrin=explode(",", $cadenafechas);
 //   var_dump($listarestrin);
    if(sizeof($listarestrin)>0)
    {
    // var_dump($arreglo);
    $nuevoarreglo=array();
   
    foreach($listarestrin as $fecha){
        $fecha=trim($fecha);
       //  echo "<br>".$fecha."--".strpos($fecha,"=");
        if(strpos($fecha,"=")!==false)
        {  
            $row =substr($fecha,1); //lequito el igual
            $row=trim($row);
            //echo "**".$row;
              $fecha = DateTime::createFromFormat('d-m-y', $row);
              if($fecha!==false)
              $nuevoarreglo[]=$fecha->format("y-m-d");
              
        
        //      var_dump($nuevoarreglo);
        }
    }
    
   
    rsort($nuevoarreglo, SORT_STRING);
    // var_dump($ntodojunto);
    foreach($nuevoarreglo as $row){
        $fecha = DateTime::createFromFormat('y-m-d', $row);
        
        $codigos.="=".$fecha->format("d-m-y").", ";
    }
    }
    
    return $codigos;
}





public function getide() {
     // var_dump($this->ide);
      return $this->ide;
    }

public function getorden() {
     // var_dump($this->ide);
      return $this->orden;
    }
 

public function getListaProductoe() {
      var_dump($this->listaProde);
      return $this->listaProde;
    }
  public function getListaTamanoe() {
    var_dump($this->listatamanoe);
      return $this->listatamanoe;
    }
  public function getListatipoanae() {
    var_dump($this->listatipanae);
      return $this->listatipanae;
    }
  public function getListaEmpaquee() {
    var_dump($this->listaTipempe);
      return $this->listaTipempe;
    }  
  public function getListaTipoMuese() {
    var_dump($this->listatipmuese);
      return $this->listatipmuese;
    }  
  public function getnumListae() {
      return $this->ide;
    }

  public function getnumprde() {
      return $this->idpe;
    }  

public function getcantidad() {
      return $this->cante;
    }

public function getfecrese() {
      return $this->fecrese;
    }

public function getfecpere() {
      return $this->fecpere;
    }    
         





public function actualizar(){
		
	include "Utilerias/leevar.php";
	try{

		$regresar="index.php?action=listacompradet&id=".$idlista;

    // reordena
    $ordentemp=0;
    //echo $nvoorden;
    //echo $ordenori;
    if ($nvoorden<$ordenori){
       //$rs= DatosListaCompraDet::vistalistaordenas($idlista, $ordenori, "pr_listacompradetalle");
       // reservo la posicion
           $datosController1= array("idlis"=>$idlista,
                            "orden"=>$ordenori,
                            "nvoorden"=>$ordentemp,
                             ); 
        
        $rs= DatosListaCompraDet::actualizaorden($datosController1,"pr_listacompradetalle");
        //recalculo los registros
        for ($i=$ordenori; $i>$nvoorden; $i=$i-1) {
            // actualiza los numeros de ordenacion
             $datosController2= array("idlis"=>$idlista,
                            "orden"=>$i-1,
                            "nvoorden"=>$i,
                             ); 
             //var_dump($datosController2);
            $rs= DatosListaCompraDet::actualizaorden($datosController2,"pr_listacompradetalle");
        }
        $datosController3= array("idlis"=>$idlista,
                            "orden"=>0,
                            "nvoorden"=>$nvoorden,
                             ); 
        $rs= DatosListaCompraDet::actualizaorden($datosController3,"pr_listacompradetalle");
    } else if ($nvoorden>$ordenori){
           $datosController1= array("idlis"=>$idlista,
                            "orden"=>$ordenori,
                            "nvoorden"=>$ordentemp,
                             ); 
        
        $rs= DatosListaCompraDet::actualizaorden($datosController1,"pr_listacompradetalle");
        //recalculo los registros
        for ($i=$ordenori; $i<$nvoorden; $i=$i+1) {
            // actualiza los numeros de ordenacion
             $datosController2= array("idlis"=>$idlista,
                            "orden"=>$i+1,
                            "nvoorden"=>$i,
                             ); 
             //var_dump($datosController2);
            $rs= DatosListaCompraDet::actualizaorden($datosController2,"pr_listacompradetalle");
        }
        $datosController3= array("idlis"=>$idlista,
                            "orden"=>0,
                            "nvoorden"=>$nvoorden,
                             ); 
        $rs= DatosListaCompraDet::actualizaorden($datosController3,"pr_listacompradetalle");
    }

    // actualiza registro   
		$datosController= array("idlis"=>$idlista,
                            "claop"=>$claop,
                            "numprod"=>$numprod,
                             "numtam"=>$numtam,
                             "numemp"=>$numemp,
                             "tipana"=>$tipana,
                            "cantidad"=>$cantidad,
                            "tipomues"=>$tipomues,
                            "fecres"=>$fecres,
                            "fechab"=>$fechab,

                               ); 
		//var_dump($datosController); 
		$rs= DatosListaCompraDet::actualizaProdLista($datosController, "pr_listacompradetalle");
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}
		
	}


public function eliminar(){
	try{
  $id = $_GET["id"];
  $idp = $_GET["idp"];
  $regresar="index.php?action=listacompradet&id=".$id;

    $rs = DatosListaCompraDet::eliminaProLis($id, $idp, "pr_listacompradetalle");
    
    echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
  }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }
		
	}

public function nuevocodigocontroller(){
     // lee registro
  include "Utilerias/leevar.php";
        
  $respuesta =DatosListaCompraDet::vistalistacomdetModel($id, $idp, "pr_listacompradetalle");
      foreach($respuesta as $row => $item){
          $numprod= $item["lid_idproducto"];

          $this->producto1 = DatosProd::getnomprodModel($numprod, "ca_productos");
          
          $numtam= $item["lid_idtamano"];
          $this->tamano1 = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",13,$numtam);
          
        $numemp= $item["lid_idempaque"];
        $this->tipoempaque1 = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",12,$numemp);


        $tipana= $item["lid_idtipoanalisis"];
        $this->tipoanalisis1 = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",7,$tipana);  
          
          $this->idp= $id;
          $this->idep=$idp;

     }

 }

 public function getproducto1() {
      return $this->producto1;
    }
  
public function gettamano1() {
      return $this->tamano1;
    }

public function gettipoempaque1() {
      return $this->tipoempaque1;
    }

public function gettipoanalisis1() {
      return $this->tipoanalisis1;
    }

//public function getidp() {
//      return $this->idp;
//    }

//public function getidep() {
//      return $this->idep;
//    }




public function addcodigo(){
    
//  include "Utilerias/leevar.php";
//  echo $date_input;
//   echo $idsigno;



//     $regresar="index.php?action=listacompradet&id=".$idlista;
//     $ssql="SELECT max(`lid_idprodcompra`) FROM `pr_listacompradetalle` WHERE `lid_idlistacompra` = :idlista";
   // try{
//    $stmt = Conexion::conectar()->prepare($ssql);
//    $stmt->bindParam(":idlista", $idlista,PDO::PARAM_INT);
//    $stmt->execute();
//    $res=$stmt->fetch();
//    if($res){
//        $claop=$res[0]+1;
//      
//    }else{
//      $claop=1;
//    }
   
//  try{
    
    
//    $datosController= array("idlis"=>$idlista,
//                            "claop"=>$claop,
//                            "numprod"=>$numprod,
//                             "numtam"=>$numtam,
//                             "numemp"=>$numemp,
//                             "tipana"=>$tipana,
//                            "cantidad"=>$cantidad,
//                            "tipomues"=>$tipomues,
//                            "fecres"=>$fecres,
//                            "fechab"=>$fechab,
//                               );
//    $rs= DatosListaCompraDet::insertarProdLista($datosController, "pr_listacompradetalle");
      
//    echo "
//            <script type='text/javascript'>
//              window.location='$regresar'
//                </script>
//                  ";
//  }catch(Exception $ex){
//     echo Utilerias::mensajeError($ex->getMessage());
//  }
    
  }


}


?>