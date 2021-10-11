<?php

class NunoController{
Private $admin;
public function vistanunoController(){
			include "Utilerias/leevar.php";
			if(isset($_GET["admin"])){
                //$admin=$_GET["admin"];
			  if($admin=="eli"){
			  	 $ec=new EstructuraController();
				 $ec->eli();
			  }	
			}

 echo '<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>NOMBRE DEL CLIENTE</th>
                  <th>BORRAR</th>
                </tr>';
  


			$respuesta =Datosnuno::vistan1Model("ca_nivel1");
			//var_dump($respuesta);
			foreach($respuesta as $row => $item){

           echo '  <tr>
	                  <td>'.$item["n1_id"].'</td>
	                 
	                  <td>
	                    <a href="index.php?action=nuevonivel&admin=li&ref=&niv=1&id='.$item["n1_id"].'">'.$item["n1_nombre"].'</a>
	                  </td>
	                  
<td> <a type="button" href="index.php?action=listan1&admin=eli&niv=1&id='.$item["n1_id"].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
		                </td>
	                </tr>';

	        }        





		}

	


}


?>