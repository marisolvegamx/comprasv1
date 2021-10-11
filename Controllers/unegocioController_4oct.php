<?php

class unegocioController {

private $descript;
private $listanivel2;
private $listanivel3;
private $listanivel4;
private $listanivel5;
private $listanivel6;
private $nombrenivel1;
private $nombrenivel2;
private $nombrenivel3;
private $nombrenivel4;
private $nombrenivel5;
private $nombrenivel6;
private $TipoTienda;
private $listaCuentas;
private $listaEstatus;
private $listaEstados;
private $idt;
private $idref;
private $desuneg;
private $idpepsi;
private $idcta;
private $idnud;
private $calle;
private $numext;
private $numint;
private $mz;
private $lt;
private $col;
private $del;
private $mun;
private $edo;
private $cp;
private $ref;
private $tel;
private $numpunto;
private $cuenta;
private $mensaje;
private $ciudades;
private $cadcom;
public $fecest;

public function vistaunegocioController() {
  //echo "Entre a unegociocontroller";
	$admin=filter_input(INPUT_GET, "admin",FILTER_SANITIZE_STRING);
	if(isset($admin))
		if($admin=="ins")
			$this->insertar();
    if($admin=="act")
      $this->actualizar();
    if($admin=="eli")
      $this->eliminar();
   // $idc=$_GET["idc"];
		$page_size=20;
    if (isset($_GET["pages"])) {
      $pages = $_GET["pages"];
      $init = ($pages - 1) * $page_size;
    } else {
      $init = 0;
      $totpages = 1;

    }
//$totuneg=Datosunegocio::cuentaUnegocioModel($idc, "ca_unegocios");
//$totpages = ceil($totuneg / $page_size);

		$respuesta =Datosunegocio::vistaUnegocioModel("ca_unegocios");
   //var_dump($respuesta);


//echo $totuneg;
foreach ($respuesta as $row => $item) {
echo '  <tr>
	      
	       <td>'.$item["une_id"].'</td>
          <td>' . $item["n3_nombre"] . '</td>  
           <td>' . $item["n4_nombre"] . '</td>
			<td>
	                     <a href="index.php?action=editatienda&referencia='.$item["une_id"].'">' . $item["une_descripcion"] . '</a>
	                  </td>
                   <td> <a type="button" href="index.php?action=listaunegocio&admin=eli&id='.$item[0].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
                    </td>
	                </tr>';
	            
}

          echo '
               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">';


if ($totpages > 1) {
if (isset($pages)) {
if ($pages != 1) {
	      			echo '<li><a href="index.php?action=listaunegocio&idc='.$idc.'&pages='.($pages -1 ).'">&laquo;</a></li>';

				}
			}	
		}
$idc=1;
		for ($i=1; $i<=$totpages;$i++){
if (isset($page)) {
if ($page == $i) {
echo $page;
} else {
						echo '<li><a href="index.php?action=listaunegocio&idc='.$idc.'&pages='.$i.'">'.$i.'</a></li>';
}
} else {
				 		echo '<li><a href="index.php?action=listaunegocio&idc='.$idc.'&pages='.$i.'">'.$i.'</a></li>';
} //IF 	
} //FOR
echo '</ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        </div>';
}


public function vistarunegocioController() {
	$page_size=30;
$sv = $_GET["sv"];
  $idcta=$_GET["idc"];
if (isset($_GET["pages"])) {
$pages = $_GET["pages"];
$init = ($pages - 1) * $page_size;
} else {
$init = 0;
$pages = 1;
}
		$totuneg=Datosunegocio::cuentaUnegocioModel($idcta,"ca_unegocios");
$totpages = ceil($totuneg / $page_size);
$estado=filter_input(INPUT_POST, "estado",FILTER_SANITIZE_STRING);
$ciudad=filter_input(INPUT_POST, "ciudad",FILTER_SANITIZE_STRING);
if (isset($_POST["opcionuneg"])||$estado!=0) {
$op = "%" . $_POST["opcionuneg"] . "%";
//echo $op;

	$respuesta =Datosunegocio::vistaFiltroUnegocioModel($idcta, $op, $estado,$ciudad,"ca_unegocios");
	$totpages = ceil(sizeof($respuesta)/ $page_size);

} else

{
			$respuesta =Datosunegocio::vistaUnegocioModel($init,$page_size, $idcta, "ca_unegocios");
}


foreach ($respuesta as $row => $item) {
echo '  <tr>
	              
	                  <td>'.$item["est_nombre"].'</td>
           <td>'.$item["une_dir_municipio"].'</td>
                      <td>' . $item["une_num_unico_distintivo"] . '</td>
	                  <td>
	                    <a href="index.php?action=runegociodetalle&idc='.$idcta.'&un='.$item["une_id"].'&sv='.$sv.'">'.$item["une_descripcion"].'</a>
	                  </td>
	                </tr>';
	            
}  // foreach
echo '
               </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">';

#trabajemos con la paginacion
if ($totpages > 1) {
if (isset($pages)) {
if ($pages != 1) {
	      			echo '<li><a href="index.php?action=rlistaunegocio&idc='.$idcta.'&sv='.$sv.'&pages='.($pages -1 ).'">&laquo;</a></li>';

				}
			}	
		}	
			for ($i=1; $i<=$totpages;$i++){
if (isset($page)) {
if ($page == $i) {
echo $page;
} else {
						echo '<li><a href="index.php?action=rlistaunegocio&idc='.$idcta.'&sv='.$sv.'&pages='.$i.'">'.$i.'</a></li>';
}
} else {
				 		echo '<li><a href="index.php?action=rlistaunegocio&idc='.$idcta.'&sv='.$sv.'&pages='.$i.'">'.$i.'</a></li>';
} //IF 	
} //FOR
echo '</ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        </div>';
        		
	} // function


public function vistaunegocioDetalle() {
$uneg = $_GET["un"];
$serv = $_GET["sv"];
    $idc=$_GET["idc"];
$respuesta = Datosunegocio::vistaUnegocioDetalle($uneg, "ca_unegocios");
#presrenta datos de unegocio
echo '<h3 class="box-title">' . $respuesta["une_descripcion"] . '</h3>
              <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
             
               <div class="row" >
                
                   <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-text">ID PEPSI</h5>
              		<strong>' . $respuesta["une_idpepsi"] . '</strong><br>
          </div>
          <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-text">ID CUENTA</h5>
            <strong>' . $respuesta["une_idcuenta"] . '</strong><br>
             </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
  
                 <a class="btn btn-block btn-primary"  href="index.php?action=runegociocomp&idc='.$idc.'&uneg='.$respuesta["une_id"].'&sv='.$serv.'"> Detalle </a>
';
}

public function vistaReportesunegocio() {
$uneg = $_GET["un"];
$serv = $_GET["sv"];
    $idc=$_GET["idc"];
    $gpo = UsuarioController::Obten_grupo();
    //echo $gpo;
   
              
    $respuesta =Datosunegocio::ReportesUnegocio($serv, $uneg, "ins_generales");
  
foreach ($respuesta as $row => $item) {
      $numrep=$item["i_numreporte"];
echo '<div class="col-sm-4 border-right">
                  <div class="description-block">'; 
      if ($gpo=='adm') {
               echo '<strong> <a href="index.php?action=editarep&idc='.$idc.'&sv='.$serv.'&pv='.$uneg.'&nrep='.$item["i_numreporte"].'">'.$item["i_numreporte"].'</a>';
      } else {  // no es administrador
        if ($serv==3){
           
           $totsol =DatosSolicitud::cuentasolicitudModel($numrep, $serv, "sol_estatussolicitud");
            # existe solicitud?
           if ($totsol>0){
              $respuesta =DatosSolicitud::estatusSolicitudModel($numrep, $serv, "sol_estatussolicitud");
              $final=$respuesta["sol_estatussolicitud"];
              if ($final ==3){
                  echo '<strong> '.$item["i_numreporte"].'</a>';
               }  else { # estatus diferente a 3
                  echo '<strong> <a href="index.php?action=editarep&sv='.$serv.'&pv='.$uneg.'&nrep='.$item["i_numreporte"].'&idc='.$idc.'">'.$numrep.'</a>';
               }  // FINAL=3 
           } else {
              echo '<strong>'.$numrep.'/SS';
                 
           }  // EXISTE SOLICITUD
        } else {   // no es servicio 3
          $final=$item["i_finalizado"];
          if ($final==1){
              
              echo '<strong>'.$numrep;
              
          }  else {
                   echo '<strong> <a href="index.php?action=editarep&sv='.$serv.'&pv='.$uneg.'&nrep='.$item["i_numreporte"].'&idc='.$idc.'">'.$numrep.'</a>';
          }  
        } // SERVICIO = 3
      }
      echo '
                   </strong><br>
                  </div>
                   </div>';
    
    } // foreach  

 
     
	
}


public function insertar(){
    
  include "Utilerias/leevar.php";
  //try{
    $regresar="index.php?action=listaunegocio";

    $datosController= array("nomuneg"=>$nomuneg,
                            "dirtien"=>$dirtien,
                               "paisuneg"=>$paisuneg,
                               "ciudaduneg"=>$ciudaduneg,
                               "puncaruneg"=>$puncaruneg,
                               "cadcomuneg"=>$cadcomuneg,
                               "cxy"=>$cxy,
                               "refer"=>$refer,
                               "estatusuneg"=>$estatusuneg,
                               "tipouneg"=>$tipouneg
                               );
     
    DatosUnegocio::insertarUnegocio($datosController, "ca_unegocios");
      
    
    echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
  //}catch(Exception $ex){
    //echo Utilerias::mensajeError($ex->getMessage());
  //}
    
  }


public function vistaNuevoUnegocio() {


$rs = Datosnuno::vistan1Model("ca_nivel1");
foreach ($rs as $row) {
//            if ($row["n1_id"] == $clanivel1) {
//                $this->listanivel1[] = "<option value='" . $row["reg_clave"] . "' selected='selected'>" . $row["reg_nombre"] . "</option>";
//            } else {
$this->listanivel1[] = "<option value='" . $row["n1_id"] . "'>" . $row["n1_nombre"] . "</option>";
  }
}


public function eliminar(){
    
  //include "Utilerias/leevar.php";
  try{
    $nuneg = $_GET["id"];
    $regresar="index.php?action=listaunegocio";
    $datosController =  DatosUnegocio::eliminauneg($nuneg, "ca_unegocios");
    
    
    echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
  }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }
    
  }

public function vistaEditaUnegocio() {
   $idref = filter_input(INPUT_GET, "referencia", FILTER_SANITIZE_SPECIAL_CHARS);

    $row = DatosUnegocio::UnegocioCompleta($idref, "ca_unegocios");

    $this->estatus = $row['une_estatus'];
    $this->puncar = $row['une_puntocardinal'];
    $this->cadcom = $row['une_cadenacomercial'];
    $this->TipoTienda = $row['une_tipotienda'];
    $this->ciudad = $row['une_cla_ciudad'];
    $this->pais = $row['une_cla_pais'];
    $this->descript=$row['une_descripcion'];
    $this->direccion = $row['une_direccion'];
    $this->cp = $row['une_dir_cp'];
    $this->ref = $row['une_dir_referencia'];
    $this->cxy = $row['une_coordenadasxy'];
    $this->idt = $idref;
    
    
}

public function selectNivelJsonController() {
foreach ($_GET as $nombre_campo => $valor) {
$asignacion = "\$" . $nombre_campo . "='" . filter_input(INPUT_GET, $nombre_campo,FILTER_SANITIZE_STRING) . "';";
eval($asignacion);
}
//$nivel = filter_input(INPUT_GET, "ni", FILTER_SANITIZE_SPECIAL_CHARS);
$res = Datosnuno::vistan1Model("ca_nivel1");
$nivel = 1;
if (isset($clanivel1)) {
$res = Datosndos::vistandosModel($clanivel1, "ca_nivel2");
$nivel = 2;
} if (isset($clanivel2)) {
$res = Datosntres::vistantresModel($clanivel2, "ca_nivel3");
$nivel = 3;
} if (isset($clanivel3)) {
$res = Datosncua::vistancuaModel($clanivel3, "ca_nivel4");
$nivel = 4;
} if (isset($clanivel4)) {
$res = Datosncin::vistancinModel($clanivel4, "ca_nivel5");
$nivel = 5;
} if (isset($clanivel5)) {
$res = Datosnsei::vistanseiModel($clanivel5, "ca_nivel6");
$nivel = 6;
}

foreach ($res as $item) {

$menu[] = array("name" => $item["n" . $nivel . "_nombre"], "value" => $item["n" . $nivel . "_id"]);
}

echo json_encode(['success' => 'true', "replacement" => "", 'menu' => $menu]);
}

public function selectNivelController($nivel,$id,$idselect) {
switch($nivel){
    case 2:

$res = Datosndos::vistandosModel($id, "ca_nivel2");
        break;
    case 3:
$res = Datosntres::vistantresModel($id, "ca_nivel3");
        break;
    case 4:
$res = Datosncua::vistancuaModel($id, "ca_nivel4");


        break;
    case 5:
$res = Datosncin::vistancinModel($id, "ca_nivel5");
        break;
case 6:
$res = Datosnsei::vistanseiModel($id, "ca_nivel6");
    break;
    default:
        $res = Datosnuno::vistaN1Model( "ca_nivel1");

}

$lista=null;

foreach ($res as $item) {
if ($idselect == $item["n" . $nivel . "_id"]) {
$lista[] = "<option value='" . $item["n" . $nivel . "_id"]. "' selected='selected'>" .  $item["n" . $nivel . "_nombre"] . "</option>";
} else {
$lista[] = "<option value='" . $item["n" . $nivel . "_id"] . "'>" .  $item["n" . $nivel . "_nombre"] . "</option>";
//  }
}}

return $lista;
}

public function iniciarFiltros(){
	include "Utilerias/leevar.php";
	$numcuen=$idc;
	if ($numcuen) {
		if (!isset($_SESSION['cuenta'])) {
			$_SESSION['cuenta']=$numcuen;
		} else {
			$_SESSION['cuenta']=$numcuen;
		}
	}else {
		$numcuen=$_SESSION['cuenta'];
	}
	
	//        echo $ssqe;
	$rse=DatosUnegocio::unegocioEstado($numcuen);
	$cad="";
	foreach($rse as $row) {
		
		//preselecciono el estado
		if($estado==$row["est_id"])
			$cad=$cad."<option value=\"".$row["est_id"]."\" selected >".
			$row["est_nombre"]."</option>";
			else
				$cad=$cad."<option value=\"".$row["est_id"]."\" >".
				$row["est_nombre"]."</option>";
				
	}
	$this->listaEstados=$cad;
	
	//busca ciudades
	
	$sqlc="SELECT ca_unegocios.une_dir_municipio FROM
ca_unegocios where cue_clavecuenta=:numcuen ";
	$parametros["numcuen"]=$numcuen;
	if(isset($estado)&&$estado!="0")//si ya hay seleccionado un estado
	{	$sqlc.=" and une_dir_idestado=:estado";
		$parametros["estado"]=$estado;
	}
		
		$sqlc.=" group by ca_unegocios.une_dir_municipio";
		
		//echo $sqlc;
		$rs=Conexion::ejecutarQuery($sqlc,$parametros);
		$cad="";
		foreach ($rs as $row) {
			
			if(isset($ciudad)&&$ciudad==$row["une_dir_municipio"])		//si ya hay selec una ciudad
				$cad=$cad."<option value=\"".$row["une_dir_municipio"]."\" selected >".
				$row["une_dir_municipio"]."</option>";
				else
					$cad=$cad."<option value=\"".$row["une_dir_municipio"]."\" >".
					$row["une_dir_municipio"]."</option>";
					
		}
		
		$this->ciudades=$cad;
		
		//                        $html->asignar('refer',$idclien.'.'.$idserv.".".$cve_cuenta);
		$this->ref=$numcuen;
	
}


public function actualizar(){
    
  include "Utilerias/leevar.php";
  try{
    $regresar="index.php?action=listaunegocio";

    $datosController= array("nomuneg"=>$nomuneg,
                            "dirtien"=>$dirtien,
                               "pais"=>$paisuneg,
                               "ciudad"=>$ciudaduneg,
                               "puncar"=>$puncaruneg,
                               "tipo"=>$tipouneg,
                               "cadcom"=>$cadcomuneg,
                               "refer"=>$refer,
                               "estatus"=>$estatusuneg,
                               "cxy"=>$cxy,
                               "idt"=>$idpv
                               );
   
    DatosUnegocio::actualizarUnegocio($datosController, "ca_unegocios");
      
    
    echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
  }catch(Exception $ex){
    echo Utilerias::mensajeError($ex->getMessage());
  }
    
  }


function getListaEstatus() {
return $this->listaEstatus;
}

function getidt() {
return $this->idt;
}

function getListaEstados() {
return $this->listaEstados;
}

function getdesc() {
return $this->descript;
}

function getDirec() {
return $this->direccion;
}

function getPais() {
return $this->pais;
}
function getciudad() {
return $this->ciudad;
}

function getestatus() {
return $this->estatus;
}
function gettipotienda() {
return $this->TipoTienda;
}

function getcadcom() {
return $this->cadcom;
}

function getpuncar() {
return $this->puncar;
}

function getNumext() {
return $this->numext;
}

function getNumint() {
return $this->numint;
}

function getMz() {
return $this->mz; 
}

function getLt() {
return $this->lt;
}

function getCol() {
return $this->col;
}

function getDel() {
return $this->del;
}

function getMun() {
return $this->mun;
}

function getEdo() {
return $this->edo;
}

function getCp() {
return $this->cp;
}

function getRef() {
return $this->ref;
}

function getcxy() {
return $this->cxy;
}

function getlistaedo() {
return $this->listaedo;
}



function setListaEstatus($listaEstatus) {
$this->listaEstatus = $listaEstatus;
}



function setListaEstados($listaEstados) {
$this->listaEstados = $listaEstados;
}

function setIdref($idref) {
$this->idref = $idref;
}

function setDesuneg($desuneg) {
$this->desuneg = $desuneg;
}

function setCalle($calle) {
$this->calle = $calle;
}

function setNumext($numext) {
$this->numext = $numext;
}

function setNumint($numint) {
$this->numint = $numint;
}

function setMz($mz) {
$this->mz = $mz;
}

function setLt($lt) {
$this->lt = $lt;
}

function setCol($col) {
$this->col = $col;
}

function setDel($del) {
$this->del = $del;
}

function setMun($mun) {
$this->mun = $mun;
}

function setEdo($edo) {
$this->edo = $edo;
}

function setCp($cp) {
$this->cp = $cp;
}

function setRef($ref) {
$this->ref = $ref;
}

function setTel($tel) {
$this->tel = $tel;
}


function getIdpv() {
    return $this->idpv;
}
function getCuenta() {
    return $this->cuenta;
}


function getNombreSeccion() {
    return $this->nombreSeccion;
}

function getTitulopagina() {
    return $this->titulopagina;
}

function getListaCuentas() {
    return $this->listaCuentas;
}

function setListaCuentas($listaCuentas) {
    $this->listaCuentas = $listaCuentas;
}
/**
	 * @return mixed
	 */
	public function getMensaje() {
		return $this->mensaje;
	}

/**
	 * @param mixed $mensaje
	 */
	public function setMensaje($mensaje) {
		$this->mensaje = $mensaje;
	}
	/**
	 * @return mixed
	 */
	public function getCiudades() {
		return $this->ciudades;
	}

	/**
	 * @param mixed $ciudades
	 */
	public function setCiudades($ciudades) {
		$this->ciudades = $ciudades;
	}





}
?>