<?php

class ListaComController{
private $listaCliente;
private $listaPlanta;
private $listaIndice;
private $listaRecolector;
private $mensaje;
private $admin;
private $Cliente;
private $Planta;


    public function vistaliscController(){
			include "Utilerias/leevar.php";
      $this->numliscomp=$_GET["id"];
      echo  $id;
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




        echo '<div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  <th style="width: 5%">ID</th>
                  <th style="width: 10%">CLIENTE</th>
                  <th style="width: 10%">PLANTA</th>
                  <th style="width: 15%">INDICE</th>
                  <th style="width: 15%">RECOLECTOR</th>
                  <th style="width: 10%" colspan="3">OPCIONES</th>
                  <th style="width: 35%">NOTAS</th></tr>
                  </thead>
                  <tbody>
                  ';
  


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
           foreach($resplanta as $row => $regplanta){
              $nomplanta=$regplanta["n5_nombre"];
           }  
				   $mes_asig= $item["lis_idindice"];
            // lee indice
      
          $aux = explode(".", $mes_asig);
                       
          $solomes = $aux[0];
          $soloanio = $aux[1];
            
            switch ($solomes) {
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

          $mesasignacion = $mesnom." - ".$soloanio;

           $idrec= $item["lis_idrecolector"];   
                
           $resrecolector=DatosRecolector::vistarecdetModel($idrec, "ca_recolectores");
           foreach($resrecolector as $row => $regrec){
              $nomrecolector=$regrec["rec_nombre"];
           }  
            $notas= $item["lis_nota"];
		       echo
            '  <tr>
	               <td>'.$item[0].'</td>
	                <td>'.$nomcliente.'</td>
	                <td>'.$nomplanta.'</td>
                  <td>'.$mesasignacion.'</td>
                  <td>'.$nomrecolector.'</td>
                  <td> 
<a type="button" href="index.php?action=editalistacompra&id='.$item[0].'"><i class="fa fa-edit fa-lg"></i></a>
</td>
<td> <a type="button" href="index.php?action=listacompradet&admin=li&id='.$item[0].'"><i class="fa fa-plus fa-lg"></i></a>
</td>
<td>  <a type="button" href="index.php?action=copialistacompra&id='.$item[0].'"><i class="fa fa-copy fa-lg"></i></a>
                    </td>	                  

 <td>'.$notas.'</td> 

	                </tr>';
	        }  
           echo '</tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->'  ;   
		}

    public function vistaNuevaListaCompra() {
      $rs = Datosnuno::vistaN1Model("ca_nivel1");    
      $this->listaCliente = null;
      foreach ($rs as $row) {
        $this->listaCliente[] = "<option value='" . $row [0] . "'>" . $row [1] . "</option>";
      }

       $rs = Datosncin::listaplantaClien(4, "ca_nivel5");
       $this->listaPlanta = null;
       foreach ($rs as $row) {     
        $this->listaPlanta[] =  "<option value='" . $row [0] . "'>" . $row [1] . "</option>";  
        }
 
        $rs = DatosMesasignacion::listaMesAsignacion("ca_mesasignacion");       
        $this->listaIndice = null;
        $sele="";
        $mesnom="----";
        foreach ($rs as $rowc) {
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

     $rs = DatosRecolector::vistarecModel("ca_recolectores");
     $this->listaRecolector = null;
     foreach ($rs as $row) {
        $this->listaRecolector[] = "<option value='" . $row["rec_id"] . "'>" . $row["rec_nombre"] . "</option>";
        }


    }

		public function getListaCliente() {	
			var_dump($this->listaCliente);
			return $this->listaCliente;
		}

		public function getListaPlanta() {
			var_dump($this->listaPlanta) ;
			return $this->listaPlanta;
		}

	  public function getListaIndice() {
       var_dump($this->listaIndice) ;
		   return $this->listaIndice;
	   }

	   public function getListaRecolector() {
       var_dump($this->listaRecolector) ;
       return $this->listaRecolector;
     }

     public function getidliscom() {
       var_dump($this->numliscomp) ;
       return $this->numliscomp;
     }

	
public function insertar(){
		
	include "Utilerias/leevar.php";
	//try{
		$regresar="index.php?action=listacompra";
    $usuariolis=UsuarioController::Obten_NomUsuario();

		$datosController= array("clientelis"=>$clientelis,
								             "plantalis"=>$plantalis,
      						           "indicelis"=>$indicelis,
                         "recolectorlis"=>$recolectorlis,
                               "notalis"=>$notalis,
                            "usuariolis"=>$usuariolis
                               );
		// var_dump($datosController);
		$rs= DatosListaCompra::insertarLista($datosController, "pr_listacompra");
			
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
	//}catch(Exception $ex){
		//echo Utilerias::mensajeError($ex->getMessage());
	//}
		
	}

   public function vistaNuevaListaCompraDet() {
    $idlis=$_GET["id"];
     $this->Lista=$idlis; 

    $rs = DatosListaCompra::vistalistaEnccomModel($idlis,"pr_listacompra");
    //var_dump($rs);
    foreach ($rs as $row) { 
     //lee cliente
     $idclien = $row["lis_idcliente"];
     $rs = Datosnuno::vistaN1opcionModel($idclien, "ca_nivel1");    
     foreach ($rs as $rowc) {
        $this->Cliente= $rowc[1];
      }

      // lee planta
      $idplanta = $row["lis_idplanta"];
      $rs = Datosncin::encplantaClien($idclien, $idplanta, "ca_nivel5");
      $this->listaPlanta = null;
      foreach ($rs as $rowp) {     
        $this->Planta =  $rowp[1];  
        }
 
      // lee nota
        $this->nota =  $row["lis_nota"];
 
       // lee recolector
      $idrec = $row["lis_idrecolector"];
      $rs = DatosRecolector::vistarecdetModel($idrec, "ca_recolectores");
      foreach ($rs as $rowr) {
         $this->Recolector = $rowr["rec_nombre"];
      }

      // lee indice
      $mes_asig=$row["lis_idindice"];
      $aux = explode(".", $mes_asig);
                   
      $solomes = $aux[0];
      $soloanio = $aux[1];
        
        switch ($solomes) {
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

          $this->mesasignacion = $mesnom." - ".$soloanio;
   
        } 

    }     

 public function getCliente() { 
      return $this->Cliente;
    }

 public function getPlanta() { 
      return $this->Planta;
    }

public function getRecolector() { 
      return $this->Recolector;
    }

public function getIndice() { 
      return $this->mesasignacion;
    }

public function getnotas() {
      
      return $this->nota;
    }


 public function getLista() { 
      return $this->Lista;
    }

public function vistaEditaListaCompra() {
    $idlis=$_GET["id"]; 
    $this->Lista=$idlis; 
    $rs = DatosListaCompra::vistalistaEnccomModel($idlis,"pr_listacompra");
    //var_dump($rs);
    foreach ($rs as $row) { 
     //lee cliente
     $idclien = $row["lis_idcliente"];
     $rs = Datosnuno::vistaN1opcionModel($idclien, "ca_nivel1");    
     foreach ($rs as $rowc) {
        $this->Cliente= $rowc[1];
      }

      // lee planta
      $idplanta = $row["lis_idplanta"];
      $rs = Datosncin::encplantaClien($idclien, $idplanta, "ca_nivel5");
      $this->listaPlanta = null;
      foreach ($rs as $rowp) {     
        $this->Planta =  $rowp[1];  
        }
 
       // lee recolector
        $idrecolector = $row["lis_idrecolector"];
        $indice= $row["lis_idindice"];
        $this->nota = $row["lis_nota"];
        //echo  $this->nota;  
        $rs = DatosRecolector::vistarecxCliente($idclien,"ca_recolectores");
        $this->listaRecolector = null;
        foreach ($rs as $row) {
          if ($idrecolector== $row["rec_id"]) {
              $this->listaRecolector[] = "<option value='" . $row["rec_id"] . "' selected>" . $row["rec_nombre"] . "</option>";
          }else{    
          $this->listaRecolector[] = "<option value='" . $row["rec_id"] . "'>" . $row["rec_nombre"] . "</option>";
          }
        }

      // lee indice
      
      $rs = DatosMesasignacion::listaMesAsignacion("ca_mesasignacion");       
      $this->listaIndice = null;
      $sele="";
      $mesnom="----";

        foreach ($rs as $rowc) {
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
                 $mesasig=$rowc["num_mes_asig"].".".$rowc["num_per_asig"];
             
              if ($indice== $mesasig) {
                  $sele =" selected";
              }else{
                $sele =" ";
              }      
              $this->listaIndice[] = "<option value=".$rowc["num_mes_asig"].".".$rowc["num_per_asig"]." ".$sele.">".$mesnom."-".$rowc["num_per_asig"]."</option>";
        }  

    }     
  }




public function actualizar(){
		
	include "Utilerias/leevar.php";
	try{

		$regresar="index.php?action=listacompra";

		$datosController= array("indicelis"=>$indicelis,
								"reclis"=>$reclis,
      				  "notalis"=>$notalis,
                "idlis"=>$idlis,
                               );
		 
	
		DatosListaCompra::actualizalista($datosController, "pr_listacompra");
		
		echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
                   // var_dump($datosController); 
	}catch(Exception $ex){
		echo Utilerias::mensajeError($ex->getMessage());
	}
		
	}


public function eliminar(){
		
	//include "Utilerias/leevar.php";
	//try{
	$nrec = $_GET["id"];
		$regresar="index.php?action=listacompra";
		// elimina detalle de lista

    $datosController1 = DatosListaCompraDet::eliminaLisDetalle($nrec, "pr_listacompradetalle");
    // elimina lista
    $datosController =	DatosListaCompra::eliminalista($nrec, "pr_listacompra");
		
		
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