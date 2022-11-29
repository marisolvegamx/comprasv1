<?php

include "conexion.php";
$listalcd=getListaComDet();

foreach ($listalcd as $lcdo ) {
    // Log.d(Constantes.TAG, "revisando nuevos codigos " +lcd.getNvoCodigo());
   
    
    $comprados = getNumMuestra($lcdo["lid_idlistacompra"],$lcdo["lid_idprodcompra"]);
    $sSQL= "UPDATE pr_listacompradetalle
SET  lid_saldocomprado=".$comprados."
WHERE lid_idlistacompra=:idlis AND lid_idprodcompra=:iddet;";
    
    $stmt=Conexion::conectar()->prepare($sSQL);
    $stmt->bindParam(":idlis", $lcdo["lid_idlistacompra"],PDO::PARAM_INT);
    $stmt->bindParam(":iddet", $lcdo["lid_idprodcompra"],PDO::PARAM_INT);
    
    $stmt-> execute();
   
}
function getListaComDet(){
    
    $stmt = Conexion::conectar()-> prepare("SELECT * FROM pr_listacompradetalle");
    
    //$stmt = Conexion::conectar()-> prepare("SELECT lis_idplanta, pro_id, lis_idindice, lid_idproducto, `lid_fechapermitida`,`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, cad_descripcionesp, cad_otro, lid_tipo FROM (SELECT lis_idplanta, lid_idprodcompra, lis_idindice, `lid_fechapermitida`, `lid_fecharestringida`, `lid_backup`, lid_idproducto, lid_cantidad, pro_id, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, lid_tipo FROM $tabla inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra inner join ca_productos ON lid_idproducto=pro_id where lid_idlistacompra=:idliscomp) as a INNER JOIN (SELECT cad_idopcion, cad_descripcionesp, cad_otro FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as b ON lid_idtamano=cad_idopcion ORDER BY pro_id, cad_otro ASC, lid_idempaque ASC, lid_idtipoanalisis ASC, lid_tipo;");
    
    
    
    $stmt-> execute();
    //$stmt->debugDumpParams();
    return $stmt->fetchAll();
    
}
 function getNumMuestra($idcompra,$iddetalle){
    $resp=getByCompra($idcompra,$iddetalle,"informe_detalle");
    return sizeof($resp);
}

function getByCompra(  $idcompra,  $iddet,$tabla){
    $sSQL= "SELECT * FROM $tabla where ind_comprasid=:idcompra
and ind_compraddetid=:iddet and ind_tipomuestra<>3";
    
    $stmt=Conexion::conectar()->prepare($sSQL);
    //$stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
    $stmt->bindParam(":iddet", $iddet, PDO::PARAM_INT);
    $stmt->bindParam(":idcompra", $idcompra, PDO::PARAM_INT);
  //  $stmt->bindParam(":recolector",  $CVEUSUARIO, PDO::PARAM_INT);
    
    $stmt-> execute();
    //   $stmt->debugDumpParams();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
    
}