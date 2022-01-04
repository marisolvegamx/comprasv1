<?php

error_reporting(E_ERROR);
ini_set("display_errors", 1);
include '../../Models/conexion.php';
define ('RAIZ',getcwd());
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Informes</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="../../Views/plugins/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="../../js/fancybox/dist/jquery.fancybox.min.css" />
<script src="../../js/fancybox/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript">
function verFotos(idreporte,indice,rec, cli){
	   console.log(idreporte);
        $.ajax({
            type: 'POST',
            url: 'detallefotos.php',
         
            data: { rep: idreporte,
            	 ind: indice, 
            	 rec: rec,
            	 cli: cli   },
            dataType: 'json',
            success: function (data) {
                $.fancybox.open(data);
            }
        });
    }
</script>
</head>
<body>


<div class="box-header with-border">INFORMES</div>
<table class="table">
  <thead>
    <tr>
    <th scope="col">Id</th>
      <th scope="col">#Tienda</th>
      <th scope="col">Indice</th>
      <th scope="col">Recolector</th>
      
      <th scope="col">Fecha</th>
      <th scope="col">Cliente</th>
      <th scope="col">Planta</th>
      <th scope="col">Nombre tienda</th>
      
      <th scope="col">Dirección</th>
      <th scope="col">Comentarios</th>
      
      <th scope="col">Complemento dirección</th>
      <th scope="col">Se compró producto</th>
      <th scope="col">Fotos</th>
      <th scope="col">Muestras</th>
      
      
   
  
    </tr>
  </thead>
  <tbody>
  <?php 
// 				$sql = "SELECT 
//     id_ruta, id_idimagen, id_descripcion, ubicacion, id_idlocal
// FROM
//     api_imagenes
//         INNER JOIN
//     api_reportes ON api_reportes.id = api_imagenes.id_idreporte;";
  $sql = "select vi_idlocal, inf_id,inf_consecutivo ,vi_indice ,vi_createdat ,cn2.n1_nombre ,cn.n5_nombre ,
une_descripcion,une_direccion,vi_geolocalizacion, inf_comentarios ,cr.rec_nombre ,n5_idn1,inf_usuario
from informes i 
inner join visitas v on v.vi_idlocal =i.inf_visitasIdlocal and v.vi_indice =i.inf_indice and v.vi_cverecolector =i.inf_usuario 
inner join ca_recolectores cr on cr.rec_id =inf_usuario 
inner join ca_nivel5 cn  on cn.n5_id =inf_plantasid 
inner join ca_nivel1 cn2 on cn2.n1_id =n5_idn1
left join ca_unegocios cu  on cu.une_id =vi_tiendaid;";
				// echo $sql;
				$rs1 = Conexion::ejecutarQuerysp ($sql );
                        
				// if (mysql_num_rows($rs1) > 0) {
                        
				foreach ( $rs1 as $row_max ) {
				//	$rutaFoto = $row_max ["id_ruta"];
				//	$idimagen = $row_max ["id_idimagen"];
                        
				/*	echo ' <div class="col-md-12 text-center">
					<img  src="archivos/' . $rutaFoto . '" width="220" height="220" alt=""
					 title="imagen" /></div>*/
  
  
    echo '<tr>
      <th scope="row">' . $row_max ["inf_id"] . '</th>

 <td>' . $row_max ["inf_consecutivo"] . '</td>
 <td>' . $row_max ["vi_indice"] . '</td>
      <td>' . $row_max ["rec_nombre"] . '</td>
      <td>' . $row_max ["vi_createdat"] . '</td>
 <td>' . $row_max ["n1_nombre"] . '</td>
 <td>' . $row_max ["n5_nombre"] . '</td>
      <td>' . $row_max ["une_descripcion"] . '
    <a  data-fancybox data-width="300" href="javascript:;" data-type="iframe" data-src="mapa.php?coor='.  urlencode($row_max ["vi_geolocalizacion"]).'"   class="card-link">Ver ubicación</a>

</td>
      <td>' . $row_max ["une_direccion"] . '</td>
    <td>' . $row_max ["inf_comentarios"] . '</td>
 <td></td>
 <td></td>
      <td>  <a  href="javascript:verFotos(' . $row_max ["inf_id"] . ',\'' . $row_max ["vi_indice"] . '\',' . $row_max ["inf_usuario"] . ','. $row_max ["n5_idn1"] . ');" class="btn btn-primary">Ver foto</a>

      <td>  <a  href="vermuestras.php?rep=' . $row_max ["inf_id"] . '&ind=' . $row_max ["vi_indice"] . '&rec=' . $row_max ["inf_usuario"] . '" class="btn btn-primary">Ver detalle</a>
</td>
    </tr>';
				}
    ?>
   
  </tbody>
</table>

				      
					      
</body></html>