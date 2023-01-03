<?php
class enlacesController{



public function listaopciones(){
    
         $grupo=UsuarioController::Obten_Grupo();
                     
     
        $respuesta = EnlacesModel::listaOpcionesMenu($grupo, "cnfg_permisos");
        
        foreach($respuesta as $row => $item){  


            echo '<li >
            <a href="index.php?op=P'.$item["idpermiso"].'"><em class="fa fa-circle-o"></em>'.$item["nombrepermiso"].'<span class="pull-right-container">
                  </em>
                </span></a>
            </li>';
        }
        echo '</ul> ';
   }     

   }
?>