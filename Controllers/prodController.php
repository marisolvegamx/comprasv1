<?php

class prodController{
Private $listaPais;
Private $listaTipo;
private $mensaje;
private $numc;
private $numte;
private $numtam;
private $nompres;


Private $admin;

    public function vistaprodController(){
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
                  <th style="width: 20%">CLIENTE</th>
                  <th style="width: 20%">CATEGORIA</th>
                  <th style="width: 20%">PRODUCTO</th>
                  <th style="width: 10%">BORRAR</th>
                </tr>';
  


			$respuesta =DatosProd::vistaprodModel("ca_productos");
			foreach($respuesta as $row => $item){
					$numc= $item["pro_cliente"];
					
					$rc =Datosnuno::vistaN1opcionModel($numc, "ca_nivel1");
					
					$cliente=$rc["n1_nombre"];
					
				    $numte = $item["pro_categoria"];
				    $categoria = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",5,$numte);	
	
           echo


            '  <tr>
	               <td>'.$item[0].'</td>
	                <td>'.$cliente.'</td>
	                <td>'.$categoria.'</td>	 	 
	                 <td>
	                    <a href="index.php?action=editaprod&admin=li&id='.$item[0].'">'.$item["pro_producto"].'</a>
	                  </td>               
						<td> <a type="button" href="index.php?action=listaprod&admin=eli&id='.$item[0].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        

		}



	public function insertar(){
	
	include "Utilerias/leevar.php";
	
	try{
		$regresar="index.php?action=listaprod";

    $datosController= array("cliente"=>$cliente,
							"categoria"=>$categoria,
      					    "nomprod"=>$producto
                               );

		 //var_dump($datosController);

		DatosProd::insertarProd($datosController, "ca_productos");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	}catch(Exception $ex){
	    echo Utilerias::mensajeError($ex->getMessage());
	}
	
	}

	

	public function editaProd() {
        $idprod=$_GET["id"];
        //echo $idpres;
		$respuesta =DatosProd::editaprodModel($idprod, "ca_productos");

			foreach($respuesta as $row => $item){
					//$numc= $item["pre_cliente"];
					$this->numc = $item["pro_cliente"];
					$this->numca= $item["pro_categoria"];
					$this->nompro= $item["pro_producto"];
					$this->idprod= $idprod;
					}
		  		
   }



public function actualizar(){
		
	include "Utilerias/leevar.php";
	//try{
		$regresar="index.php?action=listaprod";

		$datosController= array("cliente"=>$cliente,
								"categoria"=>$categoria,
      						   "producto"=>$nomprod,
                               "idprod"=>$idprod
                               );
		 
		DatosProd::actualizarProd($datosController, "ca_productos");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	//}catch(Exception $ex){
		//echo Utilerias::mensajeError($ex->getMessage());
	//}
	
	}

    function getnumc() {
      return $this->numc;
    }
  

  function getnumca() {
      return $this->numca;
    }

    function getnomprod() {
      return $this->nompro;
    }

    function getidprod() {
      return $this->idprod;
    }

public function eliminar(){
		
	//include "Utilerias/leevar.php";
	try{
	$nprod = $_GET["id"];
		$regresar="index.php?action=listaprod";
		$datosController =	DatosProd::eliminaProd($nprod, "ca_productos");
		
		
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
