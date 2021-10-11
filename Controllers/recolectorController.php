<?php

class recController{
Private $listaPais;
Private $listaTipo;
private $mensaje;

Private $admin;

    public function vistarecController(){
			include "Utilerias/leevar.php";
			if(isset($_GET["admin"])){
                $admin=$_GET["admin"];

		        if($admin=="ins"){
		        	$this->insertar();
 				}else if($admin=="act"){
				    $this->actualizar();    			
			    }else if($admin=="eli"){
				$this->eliminar();
			    }	
			}




        echo '<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 10%">ID</th>
                  <th style="width: 20%">PAIS</th>
                  <th style="width: 20%">CIUDAD</th>
                  <th style="width: 20%">NOMBRE DEL RECOLECTOR</th>
                  <th style="width: 20%">CORREO ELECTRONICO</th>
                  <th style="width: 10%">BORRAR</th>
                </tr>';
  


			$respuesta =DatosRecolector::vistarecModel("ca_recolectores");
			foreach($respuesta as $row => $item){
				$nump= $item["rec_pais"];
				$pais = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",10,$nump);
				$numC= $item["rec_ciudad"];
				$ciudad = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",11,$numC);
           echo
            '  <tr>
	               <td>'.$item[0].'</td>
	                <td>'.$pais.'</td>
	                <td>'.$ciudad.'</td>
	                 <td>
	                    <a href="index.php?action=editarecolector&admin=li&id='.$item[0].'">'.$item[1].'</a>
	                  </td>

	                  		
	                  <td>'.$item["rec_email_oficina"].'</td>
	                  
<td> <a type="button" href="index.php?action=listarecolector&admin=eli&id='.$item[0].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        





		}

		public function vistaNuevoRecolector() {

            $rs = DatosCatalogoDetalle::listaCatalogoDetalle(10, "ca_catalogosdetalle");
          
			$this->listaPais = null;

			foreach ($rs as $row) {
				if (($row["cad_idopcion"]) == 1) {
				$this->listaPais[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
				} else {
				$this->listaPais[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
				}
			}

			 $rs = DatosCatalogoDetalle::listaCatalogoDetalle(11, "ca_catalogosdetalle");
          
			$this->listaCiudad = null;

			foreach ($rs as $row) {
				
				$this->listaCiudad[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
				
			}
  		
			//$this->mensaje='<div class="alert alert-danger">Error al insertar</div>';

  			$rs = DatosCatalogoDetalle::listaCatalogoDetalle(9, "ca_catalogosdetalle");
             
			$this->listaTipo = null;

			foreach ($rs as $row) {
				if (($row["cad_idopcion"]) == 1) {
				$this->listaTipo[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
				} else {
				$this->listaTipo[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
				}
			}
  		
		}


		public function getListaPais() {
			//echo "estoy en lista pais";
			//var_dump($this->listaPais);
			var_dump($this->listaPais) ;
			return $this->listaPais;
		}

		public function getListaCiudad() {
			//echo "estoy en lista pais";
			//var_dump($this->listaPais);
			var_dump($this->listaCiudad) ;
			return $this->listaCiudad;
		}

		public function setListaPais($listaPais) {
			//var_dump($this->listaPais) ;
			$this->listaPais = $listaPais;
		}
		


		public function getListaTipo() {
			var_dump($this->listaTipo) ;
			return $this->listaTipo;
		}

		public function setListaTipo($listaTipo) {
			$this->listaTipo = $listaTipo;
		}

	public function getMensaje() {
		return $this->mensaje;
	}

	public function setMensaje($mensaje) {
		$this->mensaje = $mensaje;
	}

     public function getListaPaise() {
			//echo "estoy en lista pais";
			//var_dump($this->listaPais);
			var_dump($this->listaPaise) ;
			return $this->listaPaise;
		}

		public function setListaPaise($listaPais) {
			//var_dump($this->listaPais) ;
			$this->listaPais = $listaPaise;
		}
		


		public function getListaTipoe() {
			var_dump($this->listaTipoe) ;
			return $this->listaTipoe;
		}

		public function setListaTipoe($listaTipo) {
			$this->listaTipo = $listaTipoe;
		}







public function insertar(){
		
	include "Utilerias/leevar.php";
	//try{
		$regresar="index.php?action=listarecolector";


		 if  ($chkpepsi=="si"){
                $chekpepsi=-1;
              } else {
                $chekpepsi=0;
              }

		if  ($chkpenaf){
                $chekpenaf=-1;
              } else {
                $chekpenaf=0;
              }

 		if  ($chkelectro){
                $chekelectro=-1;
              } else {
                $chekelectro=0;
              }

		$datosController= array("nomrec"=>$nomrec,
								"dircasa"=>$dircasa,
      						   "dircasa"=>$dircasa,
                               "direti"=>$direti,
                               "paisrec"=>$paisrec,
                               "ciudadrec"=>$ciudadrec,
                               "tiporec"=>$tiporec,
                               "chkpepsi"=>$chekpepsi,
                               "chkpenaf"=>$chekpenaf,
                               "chkelectro"=>$chekelectro,
                               "numtarjeta"=>$numtarjeta,
                               "emailtrab"=>$emailtrab,
                               "emailper"=>$emailper,
                               "numcel"=>$numcel,
                               "telcasa"=>$telcasa,
                               "telofi"=>$telofi,
                               "telfam"=>$telfam
                               );
		 
		DatosRecolector::insertarRec($datosController, "ca_recolectores");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	//}catch(Exception $ex){
		//echo Utilerias::mensajeError($ex->getMessage());
	//}
		
	}


public function editaRecolector(){
			$rs = DatosCatalogoDetalle::listaCatalogoDetalle(10, "ca_catalogosdetalle");
          
			$this->listaPaise = null;

			foreach ($rs as $row) {
				if (($row["cad_idopcion"]) == 1) {
				$this->listaPaise[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
				} else {
				$this->listaPaise[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
				}
			}

			$rs = DatosCatalogoDetalle::listaCatalogoDetalle(11, "ca_catalogosdetalle");
          
			$this->listaciudade = null;

			foreach ($rs as $row) {
				if (($row["cad_idopcion"]) == 1) {
				$this->listaciudade[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
				} else {
				$this->listaciudade[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
				}
			}
  		
			//$this->mensaje='<div class="alert alert-danger">Error al insertar</div>';

  			$rs = DatosCatalogoDetalle::listaCatalogoDetalle(9, "ca_catalogosdetalle");
             
			$this->listaTipo = null;

			foreach ($rs as $row) {
				if (($row["cad_idopcion"]) == 1) {
				$this->listaTipoe[] = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
				} else {
				$this->listaTipoe[] = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
				}
			}
  		
  $nrec = $_GET["id"];
  $respuesta = DatosRecolector::vistarecolectorDetalle($nrec, "ca_recolectores");
		

   echo '
	<div class="form-group col-md-12">
      <label>NOMBRE</label>
      <input type="text" class="form-control" placeholder="NOMBRE COMPLETO" name="nomrec" id="nomrec" value="'.$respuesta["rec_nombre"].'" required>
      <input type="hidden" name="ideditar" value="'.$nrec.'" >
      </div>



      <div class="form-group col-md-12">
      <label>DIRECCION CASA</label>
      <input type="text" class="form-control" placeholder="DIRECCION" name="dircasa" id="dircasa" value="'.$respuesta["rec_direccion"].'" required>
      </div>

      <div class="form-group col-md-12">
      <label>DIRECCION DE ENVIO DE ETIQUETAS</label>
      <input type="text" class="form-control" placeholder="DIRECCION 2" name="direti" id="direti" value="'.$respuesta["rec_direccion_eti"].'" required>
      </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-4">
                    <label>PAIS</label>
                    <select class="form-control" name="paisrec">
                    <option value="">Seleccione una opción</option>';
                  $rs = DatosCatalogoDetalle::listaCatalogoDetalle(10, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == $respuesta["rec_pais"]) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }
                          echo'
                  </select>
                  </div>


 				<div class="col-4">
                    <label>CIUDAD</label>
                    <select class="form-control" name="ciudadrec">
                    <option value="">Seleccione una opción</option>';
                  $rs = DatosCatalogoDetalle::listaCatalogoDetalle(11, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == $respuesta["rec_ciudad"]) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }
                          echo'
                  </select>
                  </div>


                  <div class="col-4">
                    <label>TIPO</label>
                    <select class="form-control" name="tiporec">
                         <option value="">Seleccione una opción</option>';
                         
                         $rs = DatosCatalogoDetalle::listaCatalogoDetalle(9, "ca_catalogosdetalle");
     
                          foreach ($rs as $row) {
                              if (($row["cad_idopcion"]) == $respuesta["rec_tipo"]) {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "' selected>" . $row["cad_descripcionesp"] . "</option>";
                              } else {
                              $opcion = "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                              }
                          echo $opcion; }
                          echo'
                                      </select>
                	  </div>
				 </div>
              </div>


              <div class="card-body">
                <div class="row">
                  <div class="col-3">
                    <label>NO. TARJETA</label>
                    <input type="text" class="form-control" placeholder="NUM TARJETA" name="numtarjeta"  value="'.$respuesta["rec_tarjeta"].'">
                  </div>

                  <div class="col-3">
                    <label>PEPSI</label>
                    ';

                      if  ($respuesta["rec_ser_pepsi"]){   
                      	echo '<input type="checkbox"  class="form-control" name="chkpepsi" value="si"  checked> ';
                      }else{
                      	echo '<input type="checkbox"  class="form-control" name="chkpepsi" value="si" >';
                      }	
                  echo ' 
                  </div>
                  <div class="col-3">
                    <label>PEÑAFIEL</label>';
                    if  ($respuesta["rec_ser_penafiel"]){
                        echo '<input type="checkbox"  class="form-control" name="chkpenaf" value="si" checked>';
                    }else{
                    	echo '<input type="checkbox"  class="form-control" name="chkpenaf" value="si">';
                    }    
                    echo '
                  </div>
                  <div class="col-3">
                    <label>ELECTROPURA</label>';
					if  ($respuesta["rec_ser_electro"]){
                        echo '<input type="checkbox" class="form-control" name="chkelectro" value="si" checked>';
                    }else{
 						echo '<input type="checkbox" class="form-control" name="chkelectro" value="si" >';
                    }   
                    echo ' 
                  </div>
                </div>
              </div>

                      


                    <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>EMAIL TRABAJO</label>
                    <input type="text" class="form-control" placeholder="EMAIL TRAB" name="emailtrab"  value="'.$respuesta["rec_email_oficina"].'">
                  </div>
                  <div class="col-4">
                    <label>EMAIL PERSONAL</label>
                    <input type="text" class="form-control" placeholder="EMAIL PERSONAL" name="emailper"  value="'.$respuesta["rec_email_personal"].'">
                  </div>
                  <div class="col-4">
                    <label>NO. CELULAR</label>
                    <input type="text" class="form-control" placeholder="NUM CELULAR" name="numcel"  value="'.$respuesta["rec_celular"].'">
                  </div>
                </div>
              </div>


                    <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <label>TELEFONO CASA</label>
                    <input type="text" class="form-control" placeholder="TEL CASA" name="telcasa"  value="'.$respuesta["rec_telefono_casa"].'">
                  </div>
                  <div class="col-4">
                    <label>TELEFONO OFICINA</label>
                    <input type="text" class="form-control" placeholder="TEL OFICINA" name="telofi"  value="'.$respuesta["rec_telefono_trabajo"].'">
                  </div>
                  <div class="col-4">
                    <label>TELEFONO FAMILIAR</label>
                    <input type="text" class="form-control" placeholder="TEL FAMILIAR" name="telfam"  value="'.$respuesta["rec_telefono_familia"].'">
                  </div>
                </div>
              </div>';
}


public function actualizar(){
		
	include "Utilerias/leevar.php";
	try{

		$regresar="index.php?action=listarecolector";

		  if  ($chkpepsi=="si"){
                $chekpepsi=-1;
              } else {
                $chekpepsi=0;
              }

		if  ($chkpenaf){
                $chekpenaf=-1;
              } else {
                $chekpenaf=0;
              }

 		if  ($chkelectro){
                $chekelectro=-1;
              } else {
                $chekelectro=0;
              }

		$datosController= array("nomrec"=>$nomrec,
								"idrec"=>$ideditar,
      						   "dircasa"=>$dircasa,
                               "direti"=>$direti,
                               "paisrec"=>$paisrec,
                               "ciudadrec"=>$ciudadrec,
                               "tiporec"=>$tiporec,
                               "numtarjeta"=>$numtarjeta,
                               "chkpepsi"=>$chekpepsi,
                               "chkpenaf"=>$chekpenaf,
                               "chkelectro"=>$chekelectro,
                               "emailtrab"=>$emailtrab,
                               "emailper"=>$emailper,
                               "numcel"=>$numcel,
                               "telcasa"=>$telcasa,
                               "telofi"=>$telofi,
                               "telfam"=>$telfam
                               );
		 
		//var_dump($datosController); 
		DatosRecolector::actualizaRec($datosController, "ca_recolectores");
		
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
		
	//include "Utilerias/leevar.php";
	//try{
	$nrec = $_GET["id"];
		$regresar="index.php?action=listarecolector";
		$datosController =	DatosRecolector::eliminaRec($nrec, "ca_recolectores");
		
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	//}catch(Exception $ex){
		//echo Utilerias::mensajeError($ex->getMessage());
	//}
		
	}



}



?>