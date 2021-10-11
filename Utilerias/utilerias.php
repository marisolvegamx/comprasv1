<?php


class Utilerias {
    
    static function cambiaMesG($mesas) {
        $lonmes = strlen ( $mesas );
        if ($lonmes == 6) { // para los meses menores a 10
            $mesasnum = substr ( $mesas, 0, 1 );
            $peras = substr ( $mesas, 2, 4 );
        } else {
            $mesasnum = substr ( $mesas, 0, 2 );
            $peras = substr ( $mesas, 3, 4 );
        }
        // cambia el mes
        switch ($mesasnum) {
            case 1 :
                $mesaslet = "Enero";
                break;
            case 2 :
                $mesaslet = "Febrero";
                break;
            case 3 :
                $mesaslet = "Marzo";
                break;
            case 4 :
                $mesaslet ="Abril";
                break;
            case 5 :
                $mesaslet = "Mayo";
                break;
            case 6 :
                $mesaslet = "Junio";
                break;
            case 7 :
                $mesaslet ="Julio";
                break;
            case 8 :
                $mesaslet = "Agosto";
                break;
            case 9 :
                $mesaslet = "Septiembre";
                break;
            case 10 :
                $mesaslet = "Octubre";
                break;
            case 11 :
                $mesaslet = "Noviembre";
                break;
            case 12 :
                $mesaslet ="Diciembre";
                break;
        }
        return strtoupper($mesaslet)." ".$peras;
    }
static function cambiaMesGIng($mesas) {
	$lonmes = strlen ( $mesas );
	if ($lonmes == 6) { // para los meses menores a 10
		$mesasnum = substr ( $mesas, 0, 1 );
		$peras = substr ( $mesas, 2, 4 );
	} else {
		$mesasnum = substr ( $mesas, 0, 2 );
		$peras = substr ( $mesas, 3, 4 );
	}
	// cambia el mes
	switch ($mesasnum) {
		case 1 :
			$mesaslet = T_("Enero");
			break;
		case 2 :
			$mesaslet = T_("Febrero");
			break;
		case 3 :
			$mesaslet = T_("Marzo");
			break;
		case 4 :
			$mesaslet =T_("Abril");
			break;
		case 5 :
			$mesaslet = T_("Mayo");
			break;
		case 6 :
			$mesaslet = T_("Junio");
			break;
		case 7 :
			$mesaslet =T_("Julio");
			break;
		case 8 :
			$mesaslet = T_("Agosto");
			break;
		case 9 :
			$mesaslet = T_("Septiembre");
			break;
		case 10 :
			$mesaslet = T_("Octubre");
			break;
		case 11 :
			$mesaslet = T_("Noviembre");
			break;
		case 12 :
			$mesaslet =T_("Diciembre");
			break;
	}
	return strtoupper($mesaslet)." ".$peras;
}


//llega m�ximo de 30
static function cortarPalabra($cadena){
  // echo strlen($cadena);
    if(strlen($cadena)>15){ //corto
        //primero dejo en 30
        if(strlen($cadena)>32)
            $cadena=substr($cadena,0,32);
        $palabras=explode(" ", $cadena);
        //print_r($palabras);
        $contpedazos=0;
        $reng1="";
        foreach ($palabras as $pedazo){
            $reng1.=$pedazo." ";
            $long=strlen($reng1);
           
            $contpedazos++;
            if($long>15)//cuando se pase de 15 paro y quito la ultima
            {
                $aux=explode(" ", $reng1);
                $reng1=substr($reng1, 0, strrpos($reng1," "));
                $long=strlen($reng1);
                break;
            }
        }
        //el renglon 2 ser�a el resto de la cadena
        $reng2=substr($cadena,$long);
        $cadena=$reng1."\r".$reng2;
        
        
    }
    else
        $cadena=$cadena."\r";
    //echo $cadena;
        return $cadena;
}
  static function fecha_res($fecha) {
    
      preg_match("/([0-9]{1,2}).([0-9]{1,4})/", $fecha, $mifecha);

            switch ($mifecha [1]) {
                case "01" :
                    $strMes = T_("Enero");
                    break;
                case "02" :
                    $strMes = T_("Febrero");
                    break;
                case "03" :
                    $strMes = T_("Marzo");
                    break;
                case "04" :
                    $strMes = T_("Abril");
                    break;
                case "05" :
                    $strMes = T_("Mayo");
                    break;
                case "06" :
                    $strMes = T_("Junio");
                    break;
                case "07" :
                    $strMes = T_("Jul");
                    break;
                case "08" :
                    $strMes = T_("Ago");
                    break;
                case "09" :
                    $strMes = T_("Sep");
                    break;
                case "10" :
                    $strMes = T_("Oct");
                    break;
                case "11" :
                    $strMes = T_("Nov");
                    break;
                case "12" :
                    $strMes = T_("Dic");
                    break;
            }
            $lafecha = strtoupper($strMes) . "-" . $mifecha [2];
            return $lafecha;
        }
     
   
   
   static function mysql_fecha($fecha)	//pasa la fecha de d/m/a?o a formato a?o/m/d
   {
   		
   	
   		$nva_fecha=str_split('/',$fecha);
		
		return $nva_fecha[2].'/'.$nva_fecha[1].'/'.$nva_fecha[0];
	
   }

   static function mysql_fecha2($fecha)	//pasa la fecha de d/m/a?o a formato a?o/m/d
   {
   		
   	
   		$nva_fecha=str_split('/',$fecha);
		
		return $nva_fecha[2].'-'.$nva_fecha[1].'-'.$nva_fecha[0];
	
   }

   
   static function formato_fecha($fechacad) {
       if($fechacad!="") //<-- verifico que el campo fecha no esté vacío
       {
           $fechacad=str_replace("-01-",'Ene',$fechacad);
           $fechacad=str_replace("-02-",'Feb',$fechacad);
           $fechacad=str_replace("-03-",'Mar',$fechacad);
           $fechacad=str_replace("-04-",'Abr',$fechacad);
           $fechacad=str_replace("-05-",'May',$fechacad);
           $fechacad=str_replace("-06-",'Jun',$fechacad);
           $fechacad=str_replace("-07-",'Jul',$fechacad);
           $fechacad=str_replace("-08-",'Ago',$fechacad);
           $fechacad=str_replace("-09-",'Sep',$fechacad);
           $fechacad=str_replace("-10-",'Oct',$fechacad);
           $fechacad=str_replace("-11-",'Nov',$fechacad);
           $fechacad=str_replace("-12-",'Dic',$fechacad);
           if(preg_match("/([0-9]{4})([A-Za-z]{3})([0-9]{2})/",$fechacad,$res)) {
            
               $aux="{$res[3]}-{$res[2]}-{$res[1]}";
               return $aux;
               //$html->asignar('FechaVisita',$aux);
               //echo $aux;
           }
       }
   }



//funcion para crear el combolist
   static function llenaListBox($res) {

    /* llena listas  */

   $cad="";
    foreach ($res as $rowcu) {

        $cad.= "<option value='" . $rowcu[0] . "'>"
                . $rowcu[1] . "</option>";

       
    }
   
    return $cad;
}

//funcion para crear el combolist con una opcion seleccionada
static function llenaListBoxSel($res,$opcion_sel) {

    /* llena listas  */

    
    $cad="";
    foreach ($res as $rowcu) {
        if( $rowcu[0]==$opcion_sel)
            $cad.= "<option value='" . $rowcu[0] . "' selected>"
                    . $rowcu[1] . "</option>";
        else
            $cad.= "<option value='" . $rowcu[0] . "'>"
                    . $rowcu[1] . "</option>";

       
    }

    return $cad;
}
   static function crearOpcionesSel($SQL_TEM,$parametros, $seleccion) {

    $RS_SQM_TE = Conexion::ejecutarQuery($SQL_TEM,$parametros);


    foreach ($RS_SQM_TE as $registro ) {
    if($registro[0]==$seleccion)
     $op.= "<option value='" . $registro[0] . "'selected='selected' >" . $registro[1] . "</option>";
    else
        $op.= "<option value='" . $registro[0] . "' >" . $registro[1] . "</option>";
    }
    return  $op ;
}

 static function crearOpcionesSelCad($RS_SQM_TE, $seleccion) {

   
    foreach ($RS_SQM_TE as $registro ) {
    if($registro[0]==$seleccion)
     $op.= "<option value='" . $registro[0] . "'selected='selected' >" . $registro[1] . "</option>";
    else
        $op.= "<option value='" . $registro[0] . "' >" . $registro[1] . "</option>";
    }
    return  $op ;
}

static function redondear($valor) {
$float_redondeado=round($valor*1000)/1000;
return $float_redondeado;
}
static function redondear2($valor,$cifras) {
	if($cifras==1)
		$float_redondeado=round($valor*10)/10;
	if($cifras==2)
		$float_redondeado=round($valor*100)/100;
	return $float_redondeado;
}


  public static function crearOpcionesNivel($nivel,$id,$select) {
    //  echo $nivel."--".$id."--".$select;
switch($nivel){
    case 2:

        $res = Datosndos::vistandosByn1($id, "ca_nivel2");
        break;
    case 3:
        $res = Datosntres::vistaN3Byn2($id, "ca_nivel3");
        break;
    case 4:
        $res = Datosncua::vistaN4Byn3($id, "ca_nivel4");


        break;
    case 5:
        $res = Datosncin::vistanN5Byn4($id, "ca_nivel5");
        break;
case 6:
    $res = Datosnsei::vistanN6Byn5($id, "ca_nivel6");
    break;
    default:
        $res = Datosnuno::vistaN1Model( "ca_nivel1");

}

$lista=null;
$campoid="n".$nivel."_id";
foreach ($res as $registro) {
    if($select== $registro [$campoid])
        $lista[]= "<option value='" . $registro [$campoid] . "' selected>" . $registro ["n".$nivel.'_nombre'] . "</option>";
                    else
                        $lista[]=  "<option value='" . $registro [$campoid] . "'>" . $registro ["n".$nivel.'_nombre'] . "</option>";
                   
                   
                }
                return $lista;
                
          
}
static function crearSelect($nombresel,$RS_SQM_TE,$select2){
     
         $listanivel[] = "<select class='form-control' name='$nombresel' id='$nombresel' onChange='cargaContenido(this.id)'>
                               <option value=''>- ".strtoupper(T_("TODOS"))." -</option>";
            
            foreach ($RS_SQM_TE as $registro) {
      
                if($select2== $registro [0])
                     $listanivel[] = "<option value='" . $registro [0] . "' selected>" . $registro [1] . "</option>";
                else
                     $listanivel[] = "<option value='" . $registro [0] . "'>" . $registro [1] . "</option>";
                
              
            }
             $listanivel[] ="</select>";
             return $listanivel;
}

//funcion que crea y llena un nuevo select a partir deu una consulta
static function crearSelectOnChange($RS_SQM_TE, $nomselect,$funcionOC) {
    $cad = '<select class="form-control" name="'.$nomselect.'" id="'.$nomselect.'" onchange="'.$funcionOC.'">' .
            "<option value=''>- ".T_("TODOS")." -</option>";

    
        if(sizeof($RS_SQM_TE)>1)
          {  if($_SESSION["idiomaus"]==2) {
             
//              die();
                foreach ($RS_SQM_TE as $registro ) {
                   if($preseleccion==$registro[0])
                        $op.= "<option value='" . $registro[0] . "' selected >" . $registro[2] . "</option>";
                   else
                       $op.= "<option value='" . $registro[0] . "' selected >" . $registro[2] . "</option>";
                }

            }
            else {

                 foreach ($RS_SQM_TE as $registro ) {

                  if($preseleccion==$registro[0])
                    $op.= "<option value='" . $registro[0] . "' selected >" . $registro[1] . "</option>";
                  else
                      $op.= "<option value='" . $registro[0] . "' >" . $registro[1] . "</option>"; 
                }
            }
          }


    
    return $cad . $op . "</select>";
}

public static function crearSelectCascada($nombreNivel,$nivel,$opciones,$activo){
      $texto="";
    if(is_array($opciones)){
      
        foreach($opciones as $op){
        $texto.=$op." ";
        }
    } else {
    $texto=$opciones;    
    }
    return ' <div class="form-group ">
                            <label>'.$nombreNivel.'</label>
                            <select class="form-control cascada" name="clanivel'.$nivel.'" id="select'.$nivel.'"
                                    data-group="niv-1"
                                    data-id="niv-'.$nivel.'"
                                    data-target="niv-'.($nivel+1).'"
                                    data-url="getNivelUnegocio.php?"
                                    data-replacement="container1"'
                                    //data-default-label="-'.T_("TODOS").'-" '.$activo.'>
                                //<option value="">-'.T_("TODOS").'-</option>

   .'data-default-label="-'."TODOS".'-" '.$activo.'>
                                <option value="">-'."TODOS".'-</option>
'.$texto.'
                            </select>
                        </div>';
}

//formato de fechas para su uso en el despliegue de reportes
//Autor : Diego Alvarez F.
//Fecha de creación : 04 de Septiembre de 2006
//Funciones adicionales para el trabajo con fechas
static function cambiaf_a_normal($fecha){
    preg_match("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
    return $lafecha;
}



//Transforma la fecha al formato requerido en factura
static function fecha_factura($fecha){
    preg_match( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    switch ($mifecha[2])
    {
        case "01":
            $strMes="Enero";
            break;
        case "02":
            $strMes="Febrero";
            break;
        case "03":
            $strMes="Marzo";
            break;
        case "04":
            $strMes="Abril";
            break;
        case "05":
            $strMes="Mayo";
            break;
        case "06":
            $strMes="Junio";
            break;
        case "07":
            $strMes="Julio";
            break;
        case "08":
            $strMes="Agosto";
            break;
        case "09":
            $strMes="Septiembre";
            break;
        case "10":
            $strMes="Octubre";
            break;
        case "11":
            $strMes="Noviembre";
            break;
        case "12":
            $strMes="Diciembre";
            break;
    }
    $lafecha=$mifecha[3]."-".$strMes."-".substr($mifecha[0],3,1);
    return $lafecha;
}

static function fecha_comp($fecha){
    preg_match( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    switch ($mifecha[2])
    {
        case "01":
            $strMes="Enero";
            break;
        case "02":
            $strMes="Febrero";
            break;
        case "03":
            $strMes="Marzo";
            break;
        case "04":
            $strMes="Abril";
            break;
        case "05":
            $strMes="Mayo";
            break;
        case "06":
            $strMes="Junio";
            break;
        case "07":
            $strMes="Jul";
            break;
        case "08":
            $strMes="Ago";
            break;
        case "09":
            $strMes="Sep";
            break;
        case "10":
            $strMes="Oct";
            break;
        case "11":
            $strMes="Nov";
            break;
        case "12":
            $strMes="Dic";
            break;
    }
    $lafecha=$mifecha[3]."-".$strMes."-".substr($mifecha[0],0,4);
    return $lafecha;
}

function creaFiltro($filtro) {
	
	$titulo_fil = array('unidadneg' => "UNIDAD DE NEGOCIO: ", "franquicia" => "FRANQUICIA: ", "region" => "REGION/GRUPO: ", "zona" => "ZONA/ESTADO: ", "cedis" => "CEDIS/CIUDAD: ");
	$clase="Titulo2";
	if (isset ($_SESSION["f" . $filtro])&&$_SESSION["f" . $filtro]!="")
	{ 
		
	 return '<div class="col-md-6">' . $titulo_fil[$filtro] . $_SESSION["f" . $filtro] . "</div>";
	}
}

function michr($indice){
	if($indice>=65&&$indice<=90){
		return chr($indice);
	}
	if($indice>142){
		return "C".chr($indice-(78));
	}
	if($indice>116){
		return "B".chr($indice-52);
	}
	if($indice>90){
		return "A".chr($indice-26);
	}
}

static function mensajeError($ex){
	
	return "<div class='alert alert-danger'>".$ex."</div>";


}

static function mensajeExito($mensaje){
	return "<div class='alert alert-success'>".$mensaje."</div>";
	

}

function comprimirImagen($nombrearchivo,$rtOriginal,$tipo,$ruta){
	
		
		//Funciones optimizar imagenes
		
		//Ruta de la carpeta donde se guardarán las imagenes
		$patch=$ruta;
		
		//Parámetros optimización, resolución máxima permitida
		$max_ancho = 1080;
		$max_alto = 700;
		
		//Si no, se generan nuevas imagenes optimizadas
		ini_set("memory_limit","120M");
		//$nombrearchivo=$_FILES['images']['name'];
		
		if($tipo=='image/jpeg'){
			$original = imagecreatefromjpeg($rtOriginal);
		}
		else if($tipo=='image/png'){
			$original = imagecreatefrompng($rtOriginal);
		}
		else if($tipo=='image/gif'){
			$original = imagecreatefromgif($rtOriginal);
		}
		
		
		list($ancho,$alto)=getimagesize($rtOriginal);
		
		$x_ratio = $max_ancho / $ancho;
		$y_ratio = $max_alto / $alto;
	
		
		if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
			$ancho_final = $ancho;
			$alto_final = $alto;
		}
		elseif (($x_ratio * $alto) < $max_alto){
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
		}
		else{
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
		}
		
		$lienzo=imagecreatetruecolor($ancho_final,$alto_final);
		
		imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
		
		imagedestroy($original);
	
	
		$cal=8;
		
		if($tipo=='image/jpeg'){
			imagejpeg($lienzo,$patch."/".$nombrearchivo);
		}
		else if($tipo=='image/png'){
			imagepng($lienzo,$patch."/".$nombrearchivo);
		}
		else if($tipo=='image/gif'){
			imagegif($lienzo,$patch."/".$nombrearchivo);
		}
	//	die("listo");
	
				
	}
			
			public static function enviarPagina($enlace){
				return  "
             <script type='text/javascript'>
               window.location='$enlace'
                 </script>
                   ";
			}
			
			public static function guardarError($mensaje){
			
				date_default_timezone_set('America/Mexico_City');
				$fecvis=date("Y-m-d H:i:s");
		
			error_log("\n".$fecvis.": ".$mensaje,3,getcwd()."/Archivos/errorespostmix.log");
			}
			
		
}