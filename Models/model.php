<?php

class EnlacesPaginas{
	
	public function enlacesPaginasModel ($enlacesModel){

		//echo $enlacesModel; 
		If($enlacesModel == "listacliente"  ||
			$enlacesModel == "nuevocliente"  || 
			$enlacesModel == "editacliente" || 
			$enlacesModel == "listarecolector" ||
			$enlacesModel == "nuevorecolector" ||
			$enlacesModel == "general" || 
			$enlacesModel == "editarecolector" ||
			$enlacesModel == "listaprod" ||
			$enlacesModel == "editan4" ||
			$enlacesModel == "listaunegocio" ||
			$enlacesModel == "nuevatienda" ||
			$enlacesModel == "nuevon3" ||
			$enlacesModel == "editatienda" ||

  	        $enlacesModel == "editan3" ||
		    $enlacesModel == "editanivel" ||

			$enlacesModel == "nuevoproducto" ||
			$enlacesModel == "editaprod" ||
			$enlacesModel == "editaatributo" ||
			$enlacesModel == "listaatributos" ||
			$enlacesModel == "nuevoatributo" ||
			$enlacesModel == "listacompra" ||
			$enlacesModel == "nuevalistaCompra" ||
			$enlacesModel == "listacompradet" ||
			$enlacesModel == "nuevalistaCompraDetalle" ||
			$enlacesModel == "listasustitucion" ||
			$enlacesModel == "nuevasustitucion" ||
			$enlacesModel == "editalistacompra" ||
			$enlacesModel == "editasustitucion" ||
			$enlacesModel == "copialistacompra" ||
			$enlacesModel == "editacompradetalle" ||
			$enlacesModel == "listacausas" ||
			$enlacesModel == "editaproducto" ||
			$enlacesModel == "presentamapa" ||
			$enlacesModel == "listaciures" ||
			$enlacesModel == "nuevaciures" ||
			$enlacesModel == "editaciures" ||
			$enlacesModel == "editacausa" ||
			$enlacesModel == "nuevacausa" ||
			$enlacesModel == "listauneghabil" ||
			$enlacesModel == "nuevouneghabil" ||
			$enlacesModel == "presentamapa" ||
			$enlacesModel == "geocerca" ||
		    $enlacesModel == "nuevogeocerca"||
		    
			$enlacesModel == "suplistainformes" ||
			$enlacesModel == "supinforme" ||
			$enlacesModel == "suplistatiendas" ||
			
			#AQUI INICIA SECCION REPORTE	
			$enlacesModel == "editainforme" ||
			
			//$enlacesModel == "runegociocomp" ||
			//$enlacesModel == "editarep" ||

			//$enlacesModel == "nvorep" ||
			
			#AQUI INICIA SECCION muestras	
			//$enlacesModel == "anapend" ||
			//$enlacesModel == "anarealiza" ||
			//$enlacesModel == "estanalisis" ||
			//$enlacesModel == "nuevoanalisis" ||
			//$enlacesModel == "recepcion" ||
			//$enlacesModel == "prueba" ||
			//$enlacesModel == "listapruebasdet" ||
			//$enlacesModel == "analisisFQ" ||
			//$enlacesModel == "listarecepcion" ||
			//$enlacesModel == "recepciondetalle" ||
			//$enlacesModel == "nuevarecepcion" ||
			//$enlacesModel == "nuevaprueba" ||
			//$enlacesModel == "nuevarecepciondet" ||

			#AQUI INICIA LA SECCION DE SEGURIDAD
			$enlacesModel == "login" ||			

			#AQUI INICIA SECCION CATALOGOS
			$enlacesModel == "listan1" ||
			$enlacesModel == "listan2" ||
			$enlacesModel == "listan3" ||
			$enlacesModel == "listan4" ||
			$enlacesModel == "listan5" ||
			$enlacesModel == "listan6" ||
			$enlacesModel == "nuevonivel" ||
			$enlacesModel == "nuevon4" || 
			$enlacesModel == "nuevon5" ||   
			$enlacesModel == "nuevon6" || 
			//$enlacesModel == "nuevoReporteProducto"|| 
			$enlacesModel == "nuevocatalogo"||  
			$enlacesModel == "listacatalogos"||  
			$enlacesModel == "listacatalogosgen"||  
			$enlacesModel == "listacatalogosgen2"||  
			$enlacesModel == "listamesas"||  
			#AQUI INICIA SECCION INDICADORES   
			//$enlacesModel == "indgraficaindicadorgrv2" ||
            //$enlacesModel == "indgraficaindicadorgr" ||
            //$enlacesModel == "indestadisticares"  ||
            //$enlacesModel == "indindicadoresgrid"  ||
            //$enlacesModel == "indcumplimientoestabl" ||
            //$enlacesModel == "indindicadores" ||
            //$enlacesModel == "indbuscapv" ||
            //$enlacesModel == "indhistorialreportes"  ||
            //$enlacesModel == "indresultadosxrep"|| 
            //$enlacesModel == "indrepdiario" ||
            //$enlacesModel == "indrepxperiodo"  ||
            //$enlacesModel == "indhistoricoxpv"  ||
			//$enlacesModel == "indcumplimientoestabl" ||
			//$enlacesModel == "indestadisticares"  ||
			//$enlacesModel == "indgraficares" ||
			//$enlacesModel == "indgraficaindicadorgr" ||
			//$enlacesModel == "indhistorialreportes" ||
			//$enlacesModel == "indhistoricoxpv" ||
			//$enlacesModel == "indindicadoresgrid" ||
			//$enlacesModel == "indrepdiario" ||
			//$enlacesModel == "indrepxperiodo" ||
			//$enlacesModel == "indresultadosxrep" ||
			//$enlacesModel == "indresumenresultados" ||
		    
            //$enlacesModel == "indconsultaponderada" ||
            //$enlacesModel == "indconsultaabiertadetalle" ||
            //$enlacesModel == "indconsultaestandar" ||
            //$enlacesModel == "indconsultasecciones" ||
            //$enlacesModel == "indlistasecciones" ||
		   
		    //$enlacesModel == "indconsultageneral" ||
			//$enlacesModel == "indgraficaaplica" ||
			//$enlacesModel == "indgraficacomportamiento" ||
			//$enlacesModel == "indgraficacumplimiento" ||
			//$enlacesModel == "indgraficacumplimientoaj" ||
            //$enlacesModel == "indgraficafrecuencia"  ||
		    //$enlacesModel == "indgraficapromediojarabe"  ||
		    //ligas a certificacion
		    //$enlacesModel == "editasolicitud" ||
		    //$enlacesModel == "listasolicitudes" ||
		    //$enlacesModel == "listacertificados"||
			//$enlacesModel == "listacertificadosg"||
			//$enlacesModel == "listaalertas"||
		    //$enlacesModel == "listaestatussolicitud"||
				
			//$enlacesModel == "nuevasolicitudgepp"||
		    
		    //seccion de consultas
		    //$enlacesModel=="inicio_excel"||
            //$enlacesModel=="repfacturacion" ||
		    //$enlacesModel=="listafacturas"||
			//$enlacesModel=="consultaResultados"||
			//$enlacesModel=="resultadosxrep"||
			//$enlacesModel=="listaconsultaRep"||
			//$enlacesModel=="resumenresultados"||
		    //seccion de configuracion
		    //$enlacesModel=="slistagrupos"||
		    //$enlacesModel=="slistapermisos" ||
		    //$enlacesModel=="slistausuarios"||
		    //$enlacesModel=="snuevogrupo"||
		    //$enlacesModel=="snuevopermiso" ||
		    //$enlacesModel=="snuevousuario"||
		    //$enlacesModel=="srangosgraffrec"||
		    //$enlacesModel=="ssecciongrafica" ||
		    //$enlacesModel=="snuevorango"||
		    //$enlacesModel=="ssurveydata"||
		    //$enlacesModel=="snuevosd"||
		    //$enlacesModel=="seditasd"||
		    //$enlacesModel=="srespaldoimagenes"||
		    //$enlacesModel=="srestaurarimagen"||
		    $enlacesModel=="seditasd"||
                    $enlacesModel=="simportarpvasignados"||
		    $enlacesModel == "indgraficaindicadorv2" ||
                    $enlacesModel == "indgrafindicadordetalle" ||
		    $enlacesModel == "indgraficacobertura" ||
                    $enlacesModel == "indgraficacomparares" ||
                    $enlacesModel=="sconfiguragrafica" 
			 ){

			$module ="Views/modulos/cue_". $enlacesModel.".php";
		}
		else if($enlacesModel == 'sn'){
			// aqui meteremos todas las secciones del cuestionario
			$module ="views/modulos/cue_subnivel.php";	
		}

		else if($enlacesModel == 'rsn'){
			// aqui meteremos todas las secciones del cuestionario
			$module ="views/modulos/cue_reporte.php";	
		}

// 		else if($enlacesModel == "index"){

// 			$module = "views/modulos/enlaces.php";
// 		}

		else if($enlacesModel == "ok"){

			$module = "views/modulos/enlaces.php";
		}

		else if($enlacesModel == "cambio"){

			$module = "views/modulos/cue_listafranquicia.php";
		}
 		else{

 			$module = "views/modulos/enlaces.php";
 		}

		return $module;
	}

}

?>
