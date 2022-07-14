<?php 


include '../../Models/conexion.php';
$inf=filter_input(INPUT_POST, "rep",FILTER_SANITIZE_NUMBER_INT);
$indice=filter_input(INPUT_POST, "ind",FILTER_SANITIZE_STRING);
$recolector=filter_input(INPUT_POST, "rec",FILTER_SANITIZE_NUMBER_INT);
$cliente=filter_input(INPUT_POST, "cli",FILTER_SANITIZE_NUMBER_INT);
//$cliente=filter_input(INPUT_POST, "cli",FILTER_SANITIZE_NUMBER_INT);
buscarFotosInf($inf, $indice, $recolector, $cliente);

/*
 * SELECT imd_idlocal, imd_descripcion, imd_ruta, imd_estatus, imd_indice, imd_usuario, imd_created_at, imd_updated_at
FROM imagen_detalle
where imd_idlocal =227 and imd_indice ='5.2022' and imd_usuario =4;
 */
function buscarFotosInf($inf,$indice,$recolector,$cliente){
$sql = "select vi_idlocal, vi_fotofachada, inf_ticket_compra,inf_condiciones_traslado ,vi_indice, vi_cverecolector
from informes i 
inner join visitas v on v.vi_idlocal =i.inf_visitasIdlocal and v.vi_indice =i.inf_indice and v.vi_cverecolector =i.inf_usuario 
where inf_id =$inf and v.vi_indice ='$indice' and vi_cverecolector=$recolector limit 0,1;";

// echo $sql;
$rs1 = Conexion::ejecutarQuerysp ($sql );
$imagenes=array();
$idvisita=0;

    foreach($rs1 as $row_max) 
    {
        $imagenes[]=buscarImagen($row_max["vi_fotofachada"], $indice, $recolector);
        $imagenes[]=buscarImagen($row_max["inf_ticket_compra"], $indice, $recolector);
        $imagenes[]=buscarImagen($row_max["inf_condiciones_traslado"], $indice, $recolector);
        $idvisita=$row_max["vi_idlocal"];
    }
    $imagenes[]=buscarProductoEx($idvisita, $indice, $recolector, $cliente);
                        
     echo json_encode($imagenes);
}
                     
 function buscarProductoEx($idvisita, $indice,$recolector,$cliente) {
     
     $sql = "SELECT imd_descripcion,imd_ruta

FROM producto_exhibido pe
inner join imagen_detalle imd on imd.imd_idlocal =pe_imagenId  and  imd_indice =pe.pe_indice and imd_usuario =pe.pe_recolector 

where pe.pe_visitasId =$idvisita and  pe_indice ='$indice' and pe_recolector =$recolector
and pe_clienteId=$cliente;";
     
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
                        
                        