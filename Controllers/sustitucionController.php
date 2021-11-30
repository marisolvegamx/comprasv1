<?php

class sustitucionController{
Private $listaPais;
Private $listaTipo;
private $mensaje;
private $numc;
private $numte;
private $numtam;
private $nompres;


Private $admin;

    public function vistasustitController(){
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
                  <th style="width: 15%">ID</th>
                  <th style="width: 20%">PRODUCTO</th>
                  <th style="width: 20%">TAMAÑO</th>
                  <th style="width: 20%">EMPAQUE</th>
                  <th style="width: 15%">BORRAR</th>
                </tr>';
  
             $respuesta =DatosSustit::vistasustitModel("ca_sustitucion");

			foreach($respuesta as $row => $item){
				    $numsus = $item["id_sustitucion"];
					$numprod= $item["su_producto"];
					$producto = DatosProd::getnomprodModel($numprod, "ca_productos");

					$idtipoemp = $item["su_tipoempaque"];
					$tipoempaque = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",12,$idtipoemp);
					
				    $numtam = $item["su_tamaño"];
				    $tamano = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",13,$numtam);
           echo


            '  <tr>
	               <td>'.$numsus.'</td>
	               <td>
	                    <a href="index.php?action=editasustitucion&admin=li&id='.$numsus.'">'.$producto.'</a>
	                  </td>               
	             
	                <td>'.$tamano.'</td>
	                <td>'.$tipoempaque.'</td>
	                  	 
	                 
						<td> <a type="button" href="index.php?action=listasustitucion&admin=eli&id='.$numsus.'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        

		
		}



	public function insertar(){
	
	include "Utilerias/leevar.php";

	try{
		$regresar="index.php?action=listasustitucion";

    $datosController= array("tipoemp"=>$tipoemp,
    						"tamano"=>$tamano,
      					    "idprod"=>$idprod
                               );

		DatosSustit::insertarSustit($datosController, "ca_sustitucion");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
	    echo Utilerias::mensajeError($ex->getMessage());
	}
	
	}

	

	public function editaSustit() {
        $idsus=$_GET["id"];
		$respuesta =DatosSustit::editasustitModel($idsus, "ca_sustitucion");

			foreach($respuesta as $row => $item){
					$this->numprod= $item["su_producto"];
					$this->nomtam= $item["su_tamaño"];
					$this->numtipemp= $item["su_tipoempaque"];
					$this->idsus= $idsus;
					}
		  		
   }



public function actualizar(){
		
	include "Utilerias/leevar.php";
	try{
		$regresar="index.php?action=listasustitucion";

		$datosController= array("numprod"=> $numprod,
								"nomtam"=>$nomtam,	
      					        "tipemp"=>$tipemp,
                               "idsus"=>$idsus
                               );

		DatosSustit::actualizarSus($datosController, "ca_sustitucion");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}
	
	}

    function getnumprod() {
      return $this->numprod;
    }
  

  function getnomtam() {
      return $this->nomtam;
    }

    function gettipemp() {
      return $this->numtipemp;
    }

 function getidsus() {
      return $this->idsus;
    }


public function eliminar(){
		
	//include "Utilerias/leevar.php";
	try{
	$nsus = $_GET["id"];
		$regresar="index.php?action=listasustitucion";
		$datosController =	DatosSustit::eliminaSustit($nsus, "ca_sustitucion");
		
		
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
