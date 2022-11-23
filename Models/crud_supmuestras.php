<?php

require_once "Models/conexion.php";
class DatosInfoMues extends Conexion{

	
	public function vistaInfMuesDetModel($datosModel, $tabla){
	$stmt = Conexion::conectar()-> prepare("SELECT `ind_id`, `ind_informes_id`, `ind_productos_id`, `ind_tamanio_id`, `ind_empaque`, `ind_codigo`, `ind_caducidad`, `ind_tipomuestra`, `ind_origen`, `ind_costo`, `ind_comentarios`, `ind_estatus`, `ind_tipoanalisis`, `ind_nummuestra`, `ind_comprasid`, `ind_compraddetid`, `ind_indice`, `ind_recolector`, pro_producto, inf_ticket_compra, inf_plantasid FROM `informe_detalle` inner join pr_listacompradetalle ON ind_comprasid=lid_idlistacompra and ind_compraddetid=lid_idprodcompra inner join informes on ind_id= inf_id and ind_indice=inf_indice and ind_recolector=inf_usuario INNER JOIN ca_productos on pr_listacompradetalle.lid_idproducto=ca_productos.pro_id WHERE ind_indice=:indice and ind_recolector=:idrec and ind_informes_id=:idinf and pro_cliente=:idcli");

		$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();

		return $stmt->fetchall();

    }

	public function vistaInfMuesModel($datosModel, $tabla){


    $stmt = Conexion::conectar()-> prepare("SELECT `inf_visitasIdlocal`, `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_comentarios`, `inf_estatus`, date_format(vi_createdat, '%d-%m-%Y') as fecharep, date_format(vi_createdat, '%H:%i') as horarep,  `inf_plantasid`, n5_nombre, n5_idn1, n5_idn4,  `inf_ticket_compra`, vi_idlocal,`inf_condiciones_traslado`, `inf_causa_nocompra`, vi_tiendaid, VI_UNEDESC, vi_createdat, ca_recolectores.rec_nombre, rec_usuario FROM `informes` INNER JOIN visitas ON inf_indice=vi_indice AND inf_visitasidlocal=vi_idlocal and inf_usuario=vi_cverecolector INNER JOIN ca_recolectores ON inf_usuario=rec_id inner join ca_nivel5 ON n5_id= inf_plantasid where inf_indice=:indice and inf_id=:idinf and inf_usuario=:idrec and n5_idn1=:idcli;");

	$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
	$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
	$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
	$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
	$stmt-> execute();
   // $stmt->debugDumpParams();
	return $stmt->fetchall();
}




	public function vistaFirstMuesModel($datosModel, $tabla){


    $stmt = Conexion::conectar()-> prepare("SELECT `inf_visitasIdlocal`, `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_plantasid`, n5_nombre, n5_idn1 vi_tiendaid FROM `informes` INNER JOIN visitas ON inf_indice=vi_indice AND inf_id=vi_idlocal and inf_usuario=vi_cverecolector inner join ca_nivel5 ON n5_id= inf_plantasid where inf_indice=:indice and informes.inf_id<:idinf and inf_usuario=:idrec and n5_idn1=:idcli order by informes.inf_id;");

	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
	$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
	$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
	$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
	$stmt-> execute();

	return $stmt->fetchall();
}

public function vistaAnttiendaModel($datosModel, $tabla){
    

	$stmt = Conexion::conectar()-> prepare("SELECT `inf_visitasIdlocal`, `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_plantasid`, n5_nombre, n5_idn1 vi_tiendaid FROM `informes` INNER JOIN visitas ON inf_indice=vi_indice AND inf_id=vi_idlocal and inf_usuario=vi_cverecolector inner join ca_nivel5 ON n5_id= inf_plantasid where inf_indice=:idmes and informes.inf_id<:idinf and inf_usuario=:idrec and n5_idn1=:idcli order by informes.inf_id desc;");

	    $stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

    public function vistaSigtiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT `inf_visitasIdlocal`, `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_plantasid`, n5_nombre, n5_idn1 vi_tiendaid FROM `informes` INNER JOIN visitas ON inf_indice=vi_indice AND inf_id=vi_idlocal and inf_usuario=vi_cverecolector inner join ca_nivel5 ON n5_id= inf_plantasid where inf_indice=:idmes and informes.inf_id>:idinf and inf_usuario=:idrec and n5_idn1=:idcli order by informes.inf_id ;");

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }


    public function vistalasttiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT `inf_visitasIdlocal`, `inf_id`, `inf_consecutivo`, `inf_indice`, `inf_usuario`, `inf_plantasid`, n5_nombre, n5_idn1 vi_tiendaid FROM `informes` INNER JOIN visitas ON inf_indice=vi_indice AND inf_id=vi_idlocal and inf_usuario=vi_cverecolector inner join ca_nivel5 ON n5_id= inf_plantasid where inf_indice=:idmes and informes.inf_id>:idinf and inf_usuario=:idrec and n5_idn1=:idcli order by informes.inf_id desc;");

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }


 
   public function vistamuesdetModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("
SELECT `ind_id`, `ind_informes_id`, `ind_productos_id`, `ind_tamanio_id`, `ind_empaque`, `ind_codigo`, `ind_caducidad`, `ind_tipomuestra`, `ind_origen`, `ind_costo`, `ind_foto_codigo_produccion`, `ind_energia`, `ind_foto_num_tienda`, `ind_marca_traslape`, `ind_atributoa`, `ind_foto_atributoa`, `ind_atributob`, `ind_foto_atributob`, `ind_etiqueta_evaluacion`, `ind_qr`, `ind_comentarios`, `ind_estatus`, `ind_atributoc`, `ind_foto_atributoc`, `ind_azucares`, `ind_tipoanalisis`, `ind_nummuestra`, `ind_comprasid`, `ind_compraddetid`, `ind_indice`, `ind_recolector`, `ind_comprasIdbu`, `ind_comprasDetIdbu`, `lid_idproducto`, `pro_cliente`, `pro_producto` FROM `informe_detalle` inner join pr_listacompradetalle ON lid_idlistacompra=ind_comprasid AND lid_idprodcompra=ind_compraddetid INNER JOIN ca_productos on lid_idproducto=pro_id where ind_id=:idinf and ind_indice = :idmes and ind_recolector=:idrec AND pro_cliente=:idcli;");

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

public function buscaprodexhib($datosModel, $tabla){

	//$stmt = Conexion::conectar()-> prepare("SELECT pe_imagenid FROM `producto_exhibido` where pe_idlocal = :idinf and pe_clienteid=:idcli and pe_recolector=:idrec and pe_indice=:idmes;");sql=


			//$stmt->debugDumpParams();:idmes
			$sql="SELECT pe_imagenid FROM producto_exhibido where pe_clienteid=".$datosModel["idcli"]." and pe_recolector=".$datosModel["idrec"]." and pe_indice='".$datosModel["idmes"]."' and pe_visitasID=".$datosModel["idinf"].";";
					echo $sql;
			$stmt = Conexion::conectar()-> prepare($sql);

		//$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		//$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		//$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		//$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
			//$stmt->debugDumpParams();
		$stmt-> execute();
		return $stmt->fetchall();

    }

 public function fotoproexhib($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT pe_imagenid FROM `producto_exhibido` where pe_clienteid=:idcli and pe_recolector=:idrec and pe_indice=:idmes and pe_visitasID=:idinf;");


		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idcli", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }


}


?>