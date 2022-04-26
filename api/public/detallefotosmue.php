<?php 


include '../../Models/conexion.php';
$inf=filter_input(INPUT_POST, "rep",FILTER_SANITIZE_NUMBER_INT);
$indice=filter_input(INPUT_POST, "ind",FILTER_SANITIZE_STRING);
$recolector=filter_input(INPUT_POST, "rec",FILTER_SANITIZE_NUMBER_INT);
$cliente=filter_input(INPUT_POST, "cli",FILTER_SANITIZE_NUMBER_INT);
//$cliente=filter_input(INPUT_POST, "cli",FILTER_SANITIZE_NUMBER_INT);
buscarFotosInf($inf, $indice, $recolector, $cliente);


function buscarFotosInf($inf,$indice,$recolector,$cliente){
$sql = "SELECT ind_id, ind_informes_id, 
ind_foto_codigo_produccion, 
ind_foto_atributoa,ind_foto_atributob, 
ind_etiqueta_evaluacion, 
 ind_foto_atributoc

FROM informe_detalle
where ind_id=$inf and ind_indice='$indice'  and ind_recolector =$recolector
 limit 0,1;";

 //echo $sql;
$rs1 = Conexion::ejecutarQuerysp ($sql );
$imagenes=array();
$idvisita=0;

    foreach($rs1 as $row_max) 
    {
        $imagenes[]=buscarImagen($row_max["ind_foto_codigo_produccion"], $indice, $recolector);
        $imagenes[]=buscarImagen($row_max["ind_foto_atributoa"], $indice, $recolector);
        $imagenes[]=buscarImagen($row_max["ind_foto_atributob"], $indice, $recolector);
        $imagenes[]=buscarImagen($row_max["ind_foto_atributoc"], $indice, $recolector);
        
        $imagenes[]=buscarImagen($row_max["ind_etiqueta_evaluacion"], $indice, $recolector);
        
      
    }
 
                        
     echo json_encode($imagenes);
}
                     
  
 function buscarImagen($idimagen, $indice,$recolector) {
     
     $sql = "SELECT imd_idlocal, imd_descripcion, imd_ruta, imd_estatus, imd_indice, imd_usuario, imd_created_at, imd_updated_at
FROM imagen_detalle
where imd_idlocal =$idimagen  and  imd_indice ='$indice' and imd_usuario =$recolector;";
     
     // echo $sql;
     $rs1 = Conexion::ejecutarQuerysp ($sql );
     $imagenes=array();
     $ind_ruta=str_replace('.', '_', $indice);
     foreach($rs1 as $row_max)
     {
         $rutaFoto="../../fotografias/".$ind_ruta."/".$row_max["imd_ruta"];
         /* $html->asignar('imagen',"<td  class='$color' ><div align='center'>".
          "<a href='../fotografias/".$rutaFoto."' class='lytebox'   data-lyte-options='group:seccion".$cont."'>".
          "<img src='../img/agregar.gif' width='27' height='21' border='0'></a></div>");*/
         
         /*    $imagenes.='<a href="'.$rutaFoto.'" data-fancybox="gallery" data-caption="'.$row_max["id_descripcion"].'" style="display:none;">
          foto
          </a>';*/
         $foto=array(
             "src" =>$rutaFoto,
             "opts" => [
                 "caption"=> $row_max["imd_descripcion"]]);
         
     }
     return $foto;
 }
                        
                        