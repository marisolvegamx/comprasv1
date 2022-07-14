<?php

class SupervisaInformeController{

    public function vistaSupInformesController(){

         
			$respuesta =DatosSupInformes::vistaSupInfModel("informes");
			foreach($respuesta as $row => $item){
          $this->idinf= $item["inf_id"];
          $this->indice=$item["inf_indice"];
          $this->rec =$item["rec_nombre"];
          $this->planta =$item["inf_plantasid"];
          $this->visita=$item["inf_visitasIdlocal"];
          // busca la informacion de visitas
      }
    }

    public function getidinf() {
        return $this->idinf;
    }

    public function getindice() {
       return $this->indice;
    }       

    public function getrec() {
       return $this->rec;
    }   
    public function getplanta() {
       return $this->planta;
    }
  }

?>      
      
		