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
			    }	
			}

      echo '<div class="card-body">
<table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                   
                    <th>PRODUCTO</th>
                    <th>TAMAÑO</th>
                    <th>EMPAQUE</th>
                    <th>ANALISIS</th>
                    <th>CANTIDAD</th>
                    <th>TIPO MUESTRA</th>
                    <th>RANGO RESTRINGIDO</th>
                    <th>RANGO PERMITIDO</th>
                    <th>ELIMINAR</th>
                  </tr>
                  </thead>
                  <tbody>
              ';
            $totcant=0;  
// lee la lista de compra detalle con el numero de lista
      $respuesta =DatosListaCompraDet::vistalistacomModel($id,"pr_listacompradetalle");
      
      foreach($respuesta as $row => $item){
          $numprodlis= $item["lid_idprodcompra"];
          $idprod = $item["lid_idproducto"];
          $producto = DatosProd::getnomprodModel($idprod, "ca_productos");
          $idtam= $item["lid_idtamano"];
          $tamano = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",13,$idtam);
          $idemp = $item["lid_idempaque"];
          $tipoempaque = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",12,$idemp);  
          $idtipoana = $item["lid_idtipoanalisis"];
          $tipoanalisis = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",7,$idemp);  
          $cantidad = $item["lid_cantidad"];
          $idtipomues = $item["lid_tipo"];
          $tipomuestra = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",15,$idtipomues);  

          $fecperm = $item["lid_fechapermitida"];
          $fecrest = $item["lid_fecharestringida"];
          
          $totcant= $totcant+$cantidad;
          $i=1;
          
      
        echo '      
                  <tr>
                   
                    <td><a href="index.php?action=editacompradetalle&id='.$id.'&idp='.$numprodlis.'">'.$producto.'</a></td>
                    <td>'. $tamano.' </td>
                    <td>'.$tipoempaque.'</td>
                    <td>'.$tipoanalisis.'</td>
                    <td >'.$cantidad.'</td>
                    <td>'.$tipomuestra.'</td>
                    <td>'.$fecrest.'</td>
                    <td>'.$fecperm.'</td>
                    <td><a type="button" href="index.php?action=listacompradet&admin=eli&id='.$id.'&idp='.$numprodlis.'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a></td>
                    
                  </tr>';
              $i = $i+1;

            }     

            echo '
                  </tbody>
                  <tfoot>
                  <tr>
                     <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>TOTAL</th>
                    <th>'.$totcant.'</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->';


			$respuesta =DatosListaCompra::vistalistacomModel("pr_listacompra");
			foreach($respuesta as $row => $item){
           // var_dump($item);
          $idcliente=$item["lis_idcliente"];
           $resclien=Datosnuno::vistaN1opcionModel($idcliente, "ca_nivel1");
           foreach($resclien as $row => $itemc){
               $nomcliente=$itemc["n1_nombre"];
           }   
           $idplanta=$item["lis_idplanta"];
           $resplanta=Datosncin::vistancinOpcionModel($idplanta, "ca_nivel5");
          // foreach($resplanta as $row => $regplan){
           $nomplanta=$resplanta["n5_nombre"];
          // }  
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

      $rs = DatosProd::vistaprodModel("ca_productos");    
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
          $numprod= $item["lid_idproducto"];
          $numtam= $item["lid_idtamano"];
          $numemp= $item["lid_idempaque"];
          $tipana= $item["lid_idtipoanalisis"];
          $tipmues= $item["lid_tipo"];
          $this->cante= $item["lid_cantidad"];
          $this->fecrese= $item["lid_fecharestringida"];
          $this->fecpere= $item["lid_fechapermitida"];
          $this->ide= $id;
          $this->idpe=$idp;
          }

      $rs = DatosProd::vistaprodModel("ca_productos");
          
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


public function getide() {
     // var_dump($this->ide);
      return $this->ide;
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



}



?>