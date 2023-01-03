<?php

include "Models/crud_permisos.php";

class MenuController {
	public function desplegarMenu() {
		//include "Utilerias/leevar.php";
		$user = $_SESSION ['Usuario'];

		$grupous = $_SESSION ['GrupoUs'];
		$op = "menugen";

			

			$cont = 0;
			$rs2 = DatosPermisos::getPermisosxgrupo ( $grupous );
		//	var_dump($rs2);
			$td = "";
			foreach ( $rs2 as $row2 ) {
				// nivel 1
			   
				echo '  <li class="nav-item"><a href="#" class="nav-link">
<i class="nav-icon fas ' . $row2 ["men_imagenopcion"] . '"></i><p>' . $row2 ["men_nombreopcion"] . '
					<i class="right fas fa-angle-left"></i></p>
						
						</a>';
				$cont ++;

				// comprueba que no este la opcion
			
				$rs_com = DatosPermisos::getSubmenusxgrupo ( $grupous, $row2 ["men_claveopcion"] );
			
			

				if (sizeof ( $rs_com )) {
				   	echo ' <ul class="nav nav-treeview">';
					foreach ( $rs_com as $rowsub ) { // nivel 2
						$sql2 = "SELECT * FROM cnfg_menu where men_claveopcion='" . $row2 ["men_superopcion"] . "';";
						//$rs3 = DatosPermisos::getSubmenusxgrupo ( $grupous, $rowsub ["men_claveopcion"] );
					      //echo $rowsub["cpe_claveopcion"]; 
						if ($rowsub ["men_nivelopcion"] ==1) {
							echo '
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i>' . $rowsub ["men_nombreopcion"] . '
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>';
							echo ' <ul class="nav nav-treeview">';
				
					
					
					echo '
					<li class="nav-item">
                <a href="index.php?action=' . $rowsub ["men_liga"] . '" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>' . $rowsub ["men_nombreopcion"] .' </p>
                  </a>
                  </li>';
					
							
							echo '</ul>';
							echo '</li>';
						} else {
						    echo '
					<li class="nav-item">
                <a href="index.php?action=' . $rowsub ["men_liga"] . '" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i>
                  <p>' . $rowsub ["men_nombreopcion"] .' </p>
                  </a>
                  </li>';
						}
					} // termina for nivel2
					echo "</ul>";
				}

				echo "</li>";
			}

			
		}
		
}

