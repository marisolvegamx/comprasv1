<?php

class ciuresController{
Private $listaPais;
Private $listaTipo;
private $mensaje;
private $numc;
private $numte;
private $numtam;
private $nompres;
Private $admin;



    public function vistaciuresController(){
			include "Utilerias/leevar.php";
			//if(isset($_GET["admin"])){
            //    $admin=$_GET["admin"];

		        if($admin=="ins"){
		        	$this->insertar();
 				    }else if($admin=="act"){
				      $this->actualizar();    			
			      }else if($admin=="eli"){
			      	$this->eliminar();
			    }	
		



        echo '<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th style="width: 20%">ID</th>
                  <th style="width: 20%">PAIS</th>
                  <th style="width: 25%">CIUDAD</th>
                    <th style="width: 25%">ZONAS</th>
                  <th style="width: 10%">ELIMINAR</th>
                </tr>';
 

          $respuesta =DatosCiuResidencia::vistaciudadresModel("ca_ciudadesresidencia");
        //  $respuesta =Dciures::vistaciudadresidenciaModel("ca_ciudadesresidencia");
      foreach($respuesta as $row => $item){
          $numc= $item["ciu_id"];
          $nomc= $item["ciu_descripcionesp"];
          $nump= $item["ciu_paisid"];
        $pais = DatosCatalogoDetalle::getCatalogoDetalle("ca_catalogosdetalle",10,$nump);
                     echo
            '  <tr>
                 <td>'.$item[0].'</td>
                  <td>'.$pais.'</td>
                  
                   <td>
                      <a href="index.php?action=editaciures&admin=li&id='.$item[0].'">'.$nomc.'</a>
                    </td>
 <td> <a type="button" href="index.php?action=nuevogeocerca&n4id='.$item[0].'"><i class="fa fa-plus"></i></a>
		                </td>    
                  
<td> <a type="button" href="index.php?action=listaciures&admin=eli&id='.$item[0].'" onclick="return dialogoEliminar();"><i class="fa fa-times"></i></a>
                    </td>
                  </tr>';

          }      
       }


       public function insertar(){
  
          include "Utilerias/leevar.php";
  
          try{
             $regresar="index.php?action=listaciures";
  
             $datosController= array("idpais"=>$idpais,
                                    "nomciu"=>$nomciures
                               );
             DatosCiuResidencia::insertarCiuRes($datosController, "ca_ciudadesresidencia");
      
    
    echo "
            <script type='text/javascript'>
              window.location='$regresar'
                </script>
                  ";
  }catch(Exception $ex){
      echo Utilerias::mensajeError($ex->getMessage());
  }
 
 } 

  public function editaciures() {
    $idciures=$_GET["id"];
        //echo $idpres;
    $respuesta =DatosCiuResidencia::editaciuresModel($idciures, "ca_ciudadesresidencia");

      foreach($respuesta as $row => $item){
          $this->idpais= $item["ciu_paisid"];
          $this->nomciu= $item["ciu_descripcionesp"];
          $this->idciu= $idciures;
      }
          
  }


  function getidpais() {
      return $this->idpais;
    }

 function getnomciu() {
      return $this->nomciu;
    }

 function getidciu() {
      return $this->idciu;
    }


public function actualizar(){
    
  include "Utilerias/leevar.php";
  try{
    $regresar="index.php?action=listaciures";
  
     $datosController= array("idpais"=>$idpais,
                             "nomciu"=>$nomciures,
                             "idciu"=>$idciures
                               );
     DatosCiuResidencia::actualizarCiuRes($datosController, "ca_ciudadesresidencia");
         
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
    
  include "Utilerias/leevar.php";
  //try{
    $nrec = $_GET["id"];
    $regresar="index.php?action=listaciures";

    $datosController =  DatosCiuResidencia::eliminaCiuRes($nrec, "ca_ciudadesresidencia");
        
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