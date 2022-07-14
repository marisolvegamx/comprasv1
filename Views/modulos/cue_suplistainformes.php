<?php
   $gpousuario = $_SESSION['GrupoUs'];
   // busca supervisor 
 $logemail= $_SESSION['Usuario'];
   include "Utilerias/leevar.php";
   //var_dump($gpousuario); 
  //var_dump($supervisor);	 
?>
<section class="content-header">
<h1>INFORMES</h1>
</section>
<section class="content container-fluid">
	    
<form role="form" method="post" action="index.php?action=suplistainformes">

 <table id="example2" class="table table-bordered table-hover">
      <tr>
        <td style="width: 50%">Supervisor: 

		<?php
          //$gpousuario = $_SESSION['GrupoUs'];
                if ($gpousuario=="adm"){

                	//$this->listaSupervisor = null;
                	echo '<select class="form-control cascada" name="supervisor" id="supervisor" >  
           					<option value="">--- Todos  ---</option>';
                   	//if (isset($supervisor)) { 
              	   	   $rs = DatosCatalogoDetalle::listaCatalogoDetalle(18, "ca_catalogosdetalle");
                	
                          foreach ($rs as $row) {
                        //  	echo $row["cad_idopcion"];
                          	if ($row["cad_idopcion"]==$supervisor) {
								echo "<option value='" . $row["cad_idopcion"] ."' selected>" . $row["cad_descripcionesp"] . "</option>";       
                          	} else {
                              echo "<option value='" . $row["cad_idopcion"] . "'>" . $row["cad_descripcionesp"] . "</option>";
                          	}
                          }
                         

              	   	   //echo($this->listaSupervisor);
        	          
             
             	//	} else {

                  //	   $rs = DatosCatalogoDetalle::listaCatalogoDetalle(18, "ca_catalogosdetalle");
                	
                    //      foreach ($rs as $row) {
                    //         echo "<option value=" . $row["cad_idopcion"] . ">" . $row["cad_descripcionesp"] . "</option>";
                     //     }
                         
        	        	 //echo($this->listaSupervisor);
        	        //}	
            echo '</select>';
                               
                	 
                       //if ($row["cad_idopcion"]==$supervisor){
					//	   $this->listaSupervisor[] = "<option value='" . $row["cad_idopcion"] . "'selected>" . $row["cad_descripcionesp"] . "</option>";

                      // } else {
   						//	$this->listaSupervisor[] = "<option value='" . $row["cad_idopcion"] . "'selected>" . $row["cad_descripcionesp"] . "</option>";

                       //}
        	      
        	     
        	   
        	  }  else {
        	  	//muestra nombre de supervisor
        	  	$logemail= $_SESSION['Usuario'];
        	    // busca el email y lee el numero de sugetsupervisorpervisor
        	    $resp =UsuarioModel::getsupervisor($logemail,"cnfg_usuarios");
        	    foreach($resp as $row => $item){
        		   $numsup= $item["cus_cliente"];
        		  // var_dump($numsup);
        		   $nomsup=DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",18,$numsup);
        		   echo $nomsup;
        	    }	
        	  }           
        	?>

         </td>





        <td style="width: 50%">Indice :   <select class="form-control" name="indiceinf" name="indiceinf">
          <option value="">---  Todos  ---</option>
                         <?php
                          include "Utilerias/leevar.php";
            $fechaact=getdate();
            $peract=$fechaact["mon"]. ".".$fechaact["year"];
            $rs = DatosMesasignacion::listaMesAsignacion("ca_mesasignacion");       
            $this->listaIndice = null;
            
            $mesnom="----";
        foreach ($rs as $rowc) {
        	if ( is_null($indiceinf)){
        	   if ($rowc["num_mes_asig"].".".$rowc["num_per_asig"]==$peract){
            	   $sele ="selected";
               } else {
                   $sele="";
               }
            }else{
				if ($rowc["num_mes_asig"].".".$rowc["num_per_asig"]==$indiceinf){
            	   $sele ="selected";
               } else {
                   $sele="";
               }

            }   
           switch ($rowc["num_mes_asig"]) {
                     case 1:
                        $mesnom="ENERO";
                      break;
                     case 2:
                        $mesnom="FEBRERO";
                      break;
                     case 3:
                        $mesnom="MARZO";
                      break;   
                     case 4:
                        $mesnom="ABRIL";
                      break;   
                     case 5:
                        $mesnom="MAYO";
                      break;   
                     case 6:
                        $mesnom="JUNIO";
                      break;   
                     case 7:
                        $mesnom="JULIO";
                      break;   
                     case 8:
                        $mesnom="AGOSTO";
                      break;   
                     case 9:
                        $mesnom="SEPTIEMBRE";
                      break;   
                     case 10:
                        $mesnom="OCTUBRE";
                      break;   
                     case 11:
                        $mesnom="NOVIEMBRE";
                      break;   
                     case 12:
                        $mesnom="DICIEMBRE";
                      break;
                     }

           $this->listaIndice[] = "<option value=".$rowc["num_mes_asig"].".".$rowc["num_per_asig"]." ".$sele.">".$mesnom."-".$rowc["num_per_asig"]."</option>";
        } 

          var_dump($this->listaIndice);                           

      ?>
                      </select>
                      </br>

                      <button type="submit" class="btn btn-info float-sm-right" style="margin-right: 10px; margin-top:0px; margin-bottom:10px; "> Filtrar </button></td>
      </tr>
  </table>
</div>
</form>

<?php

$ingreso = new SupInformesController();
$ingreso -> vistaSupInformesController();

?>

</section>