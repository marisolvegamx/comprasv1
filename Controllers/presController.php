<?php

class presController{
Private $listaPais;
Private $listaTipo;
private $mensaje;
private $numc;
private $numte;
private $numtam;
private $nompres;


Private $admin;

    public function vistapresController(){
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
                  <th style="width: 20%">TIPO DE EMPAQUE</th>
                  <th style="width: 20%">TAMAÑO</th>
                  <th style="width: 20%">PRESENTACION</th>
                  <th style="width: 10%">BORRAR</th>
                </tr>';
  


			$respuesta =DatosPres::vistapresModel("ca_presentacion");
			foreach($respuesta as $row => $item){
					$numc= $item["pre_cliente"];
					
					$rc =Datosnuno::vistaN1opcionModel($numc, "ca_nivel1");
					
					$cliente=$rc["n1_nombre"];
					
				    $numte = $item["pre_tipoempaque"];
				    $tipoempaque = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",12,$numte);	


				    $numt = $item["pre_tamano"];
				    $tamano = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",13,$numt);	
           echo


            '  <tr>
	               <td>'.$item[0].'</td>
	                <td>'.$cliente.'</td>
	                <td>'.$tipoempaque.'</td>	 
	                 <td>'.$tamano.'</td>	 
	                 <td>
	                    <a href="index.php?action=editapres&admin=li&id='.$item[0].'">'.$item["pre_presentacion"].'</a>
	                  </td>               
						<td> <a type="button" href="index.php?action=listapres&admin=eli&id='.$item[0].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        





		}



	public function insertar(){
		
	include "Utilerias/leevar.php";
	//try{
		$regresar="index.php?action=listapres";

		$datosController= array("cliente"=>$cliente,
								"tipoemp"=>$tipoemp,
      						   "tamano"=>$tampres,
                               "pres"=>$nompres
                               );
		 
		DatosPres::insertarPres($datosController, "ca_presentacion");
			
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	//}catch(Exception $ex){
		//echo Utilerias::mensajeError($ex->getMessage());
	//}
	
	}

	

	public function editaPres() {
        $idpres=$_GET["id"];
        //echo $idpres;
		$respuesta =DatosPres::editapresModel($idpres, "ca_presentacion");

		

			foreach($respuesta as $row => $item){
					//$numc= $item["pre_cliente"];
					$this->numc = $item["pre_cliente"];
					$this->numte= $item["pre_tipoempaque"];
					$this->numtam= $item["pre_tamano"];
					$this->nompres= $item["pre_presentacion"];
					$this->idpres= $idpres;
					}
		  		
   }



public function actualizar(){
		
	include "Utilerias/leevar.php";
	//try{
		$regresar="index.php?action=listapres";

		$datosController= array("cliente"=>$cliente,
								"tipoemp"=>$tipoemp,
      						   "tamano"=>$tampres,
                               "pres"=>$nompres,
                               "idpres"=>$idpres
                               );
		 
		DatosPres::actualizarPres($datosController, "ca_presentacion");
			
		
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
  

  function getnumte() {
      return $this->numte;
    }

    function getnumtam() {
      return $this->numtam;
    }

     function getnompres() {
      return $this->nompres;
    }

    function getidpres() {
      return $this->idpres;
    }
}
