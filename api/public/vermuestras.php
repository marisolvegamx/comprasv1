<?php
include '../../Models/conexion.php';
define ('RAIZ',getcwd());
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Muestras</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="../../Views/plugins/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="../../js/fancybox/dist/jquery.fancybox.min.css" />
<script src="../../js/fancybox/dist/jquery.fancybox.min.js"></script>

<script type="text/javascript">
function verFotos(idreporte,det,indice,rec){
	   console.log(idreporte);
        $.ajax({
            type: 'POST',
            url: 'detallefotosmue.php',
         
            data: { rep: det,
            	 ind: indice, 
            	 rec: rec,
            	 cli: idreporte   },
            dataType: 'json',
            success: function (data) {
                $.fancybox.open(data);
            }
        });
    }
</script>
</head>
<body>


<div class="box-header with-border">MUESTRAS INFORME</div>
<table class="table">
  <thead>
    <tr>
   
      <th scope="col">#Muestra</th>
      <th scope="col">Producto</th>
      <th scope="col">Análisis</th>
      
      <th scope="col">Tipo muestra</th>
      <th scope="col">Fecha caducidad</th>
      <th scope="col">Código producción</th>
      <th scope="col">Tomado de</th>
      
      <th scope="col">Costo muestra</th>
      <th scope="col">Daño A</th>
       <th scope="col">Daño B</th>
        <th scope="col">Daño C</th>
      <th scope="col">QR</th>
      <th scope="col">Fotos</th>
     
  
    </tr>
  </thead>
  <tbody>
  <?php 
  $inf=filter_input(INPUT_GET, "rep",FILTER_SANITIZE_NUMBER_INT);
  $indice=filter_input(INPUT_GET, "ind",FILTER_SANITIZE_STRING);
  $recolector=filter_input(INPUT_GET, "rec",FILTER_SANITIZE_NUMBER_INT);
  //$cliente=filter_input(INPUT_POST, "cli",FILTER_SANITIZE_NUMBER_INT);
  
  $sql = "SELECT  
ind_id, ind_informes_id, ind_productos_id, ind_tamanio_id, ind_empaque, ind_codigo, ind_caducidad, 
ind_tipomuestra, ind_origen, ind_costo, ind_foto_codigo_produccion, ind_energia, ind_foto_num_tienda,
ind_marca_traslape, ind_atributoa, ind_foto_atributoa, ind_atributob, ind_foto_atributob,
ind_etiqueta_evaluacion, ind_segunda_muestra, ind_qr, ind_condiciones_traslado, 
ind_comentarios, ind_estatus, ind_atributoc, ind_foto_atributoc, ind_azucares,
ind_tipoanalisis, ind_nummuestra, ind_comprasid, ind_compraddetid, ind_indice,
ind_recolector, cp.pro_producto ,cc.cad_descripcionesp empaque,c2.cad_descripcionesp muestra,
c3.cad_descripcionesp tomadode, c4.cad_descripcionesp analisis,ca.at_nombre atra,cb.at_nombre atrb,
ac.at_nombre  atrc
FROM informe_detalle
inner join ca_productos cp on cp.pro_id =ind_productos_id
inner join ca_catalogosdetalle cc on cc.cad_idopcion=ind_empaque and cc.cad_idcatalogo=12
inner join ca_catalogosdetalle c2 on c2.cad_idopcion=ind_tipomuestra and c2.cad_idcatalogo=15
inner join ca_catalogosdetalle c3 on c3.cad_idopcion=ind_origen and c3.cad_idcatalogo=8
inner join ca_catalogosdetalle c4 on c4.cad_idopcion=ind_tipoanalisis and c4.cad_idcatalogo=7
left join ca_atributo ca on ca.id_atributo =ind_atributoa 
left join ca_atributo cb on cb.id_atributo =ind_atributob 
left join ca_atributo ac on ac.id_atributo =ind_atributoc 
where ind_informes_id =$inf
and ind_indice='$indice' and ind_recolector =$recolector
";
				// echo $sql;
				$rs1 = Conexion::ejecutarQuerysp ($sql );
                        
				// if (mysql_num_rows($rs1) > 0) {
                        
				foreach ( $rs1 as $row_max ) {
				
  
  
    echo '<tr>
    

 <td>' . $row_max ["ind_nummuestra"] . '</td>
 <td>' . $row_max ["pro_producto"] . ' '.$row_max ["ind_tamanio_id"] .' '. $row_max ["empaque"] .'</td>
      <td>' . $row_max ["analisis"] . '</td>
      <td>' . $row_max ["muestra"] . '</td>
    <td>' . $row_max ["ind_caducidad"] . '</td>
      <td>' . $row_max ["ind_codigo"] . '</td>
 <td>' . $row_max ["tomadode"] . '
   
</td>
 <td>' . $row_max ["ind_costo"] . '</td>
     
<td>' . $row_max ["atra"] . '</td>
 
<td>' . $row_max ["atrb"] . '</td>
 
<td>' . $row_max ["atrc"] . '</td>
 
      <td>' . $row_max ["ind_qr"] . '</td>
  
      <td>  <a  href="javascript:verFotos('. $row_max ["ind_informes_id"] . ',' . $row_max ["ind_id"] . ',\'' . $row_max ["ind_indice"] . '\',' . $row_max ["ind_recolector"] . ');" class="btn btn-primary">Ver foto</a>

    
    </tr>';
				}
    ?>
   
  </tbody>
</table>

				      
					      
</body></html>
