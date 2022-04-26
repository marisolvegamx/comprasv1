<?php

class causaController{
Private $listaPais;
Private $listaTipo;
private $mensaje;
private $numc;
private $numte;
private $numtam;
private $nompres;


Private $admin;

    public function vistacausaController(){
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



			$respuesta =DatosCausa::vistacausaModel("ca_causas");
			foreach($respuesta as $row => $item){
					$numcau= $item["ID_causa"];
					$nomcau = $item["cau_descripcion"];
					$numat = $item["cau_estatus"];
				    if ($numat==1) {
				    	$nomestatus="Activo";
				    } else {
						$nomestatus="Inactivo";
				    }

				   
           echo


            '  <tr>
	               <td>'.$numcau.'</td>
	                	 
	                 <td>
	                    <a href="index.php?action=editacausa&admin=li&id='.$numcau.'">'.$nomcau.'</a>
	                  </td>
	                 
	                  <td>'.$nomestatus.'</td>               
						<td> <a type="button" href="index.php?action=listacausas&admin=eli&id='.$numcau.'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        

		}



	public function insertar(){
	
	include "Utilerias/leevar.php";

	try{
		$regresar="index.php?action=listacausas";

    $datosController= array("nomcausa"=>$nomcausa,
    						"estatus"=>$idest,
    					       );
       
		DatosCausa::insertarCausa($datosController, "ca_atributos");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
	    echo Utilerias::mensajeError($ex->getMessage());
	}
	
	}

	

	public function editaCausa() {
        $idcausa=$_GET["id"];
        //echo $idcausa;
		$respuesta =DatosCausa::editacausaModel($idcausa, "ca_causas");
		foreach($respuesta as $row => $item){
				$this->nomcausa= $item["cau_descripcion"];
				$this->idestatus= $item["cau_estatus"];
				$this->idcausa= $idcausa;
		}
		  		
   }



public function actualizar(){
		
	include "Utilerias/leevar.php";
	try{
		$regresar="index.php?action=listacausas";

		$datosController= array("nomcausa"=>$nomcausa,
								"idestatus"=>$idest,
								"idcausa"=>$idcausa
                               );
		 
		DatosCausa::actualizarCausa($datosController, "ca_causas");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}
	
	}

    function getnomcausa() {
      return $this->nomcausa;
    }
  

  function getidestatus() {
      return $this->idestatus;
    }

function getidcausa() {
      return $this->idcausa;
    }
   


public function eliminar(){
		
	//include "Utilerias/leevar.php";
	try{
	$idcausa = $_GET["id"];
		$regresar="index.php?action=listacausas";
		$datosController =	DatosCausa::eliminaCausa($idcausa, "ca_causas");
		
		
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
