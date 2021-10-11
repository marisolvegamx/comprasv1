<?php

class atributoController{
Private $listaPais;
Private $listaTipo;
private $mensaje;
private $numc;
private $numte;
private $numtam;
private $nompres;


Private $admin;

    public function vistaatribController(){
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
                  <th style="width: 35%">TIPO DE EMPAQUE</th>
                  <th style="width: 35%">ATRIBUTO</th>
                  <th style="width: 15%">BORRAR</th>
                </tr>';
  


			$respuesta =DatosAtrib::vistaatribModel("ca_atributo");
			foreach($respuesta as $row => $item){
					$numte= $item["id_tipoempaque"];
					$tipoempaque = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",12,$numte);	
	
					
				    $numat = $item["id_atributo"];
				   
           echo


            '  <tr>
	               <td>'.$numat.'</td>
	                <td>'.$tipoempaque.'</td>
	                	 
	                 <td>
	                    <a href="index.php?action=editaatributo&admin=li&id='.$numat.'">'.$item["at_nombre"].'</a>
	                  </td>               
						<td> <a type="button" href="index.php?action=listaatributos&admin=eli&id='.$numat.'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        

		}



	public function insertar(){
	
	include "Utilerias/leevar.php";

	try{
		$regresar="index.php?action=listaatributos";

    $datosController= array("tipoemp"=>$tipoemp,
      					    "nomatrib"=>$nomatr
                               );

		// var_dump($datosController);

		DatosAtrib::insertarAtrib($datosController, "ca_atributos");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
	    echo Utilerias::mensajeError($ex->getMessage());
	}
	
	}

	

	public function editaAtributo() {
        $idatr=$_GET["id"];
        //echo $idpres;
		$respuesta =DatosAtrib::editaprodModel($idatr, "ca_atributo");

			foreach($respuesta as $row => $item){
					$this->numemp= $item["id_tipoempaque"];
					$this->nomatr= $item["at_nombre"];
					$this->idatr= $idatr;
					}
		  		
   }



public function actualizar(){
		
	include "Utilerias/leevar.php";
	//try{
		$regresar="index.php?action=listaatributos";

		$datosController= array("tipoemp"=>$tipoemp,
      					        "nomatrib"=>$nomatr,
                               "idatr"=>$idatr
                               );
		 
		DatosAtrib::actualizarAtr($datosController, "ca_atributo");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	//}catch(Exception $ex){
		//echo Utilerias::mensajeError($ex->getMessage());
	//}
	
	}

    function getidatr() {
      return $this->idatr;
    }
  

  function getidemp() {
      return $this->numemp;
    }

    function getnomatr() {
      return $this->nomatr;
    }


public function eliminar(){
		
	//include "Utilerias/leevar.php";
	try{
	$natr = $_GET["id"];
		$regresar="index.php?action=listaatributos";
		$datosController =	DatosAtrib::eliminaAtrib($natr, "ca_atributo");
		
		
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
