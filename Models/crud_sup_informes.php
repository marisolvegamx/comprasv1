<?php

require_once "Models/conexion.php";
class DatosSupInformes extends Conexion{

	
	public function vistaSupInfModel($condi, $indiceact, $tabla){

	//$stmt = Conexion::conectar()-> prepare("select count(inf_id) as totinf, inf_usuario, inf_indice, idsup, nomsup, n5_nombre, inf_plantasid, n1_nombre, sum(if(inf_estatus=3 or inf_estatus=4,1,0)) as totestatus from (SELECT inf_id, inf_indice, inf_usuario, inf_plantasid, inf_estatus, n5_nombre, n1_nombre, n5_supervisor FROM `informes` INNER JOIN ca_nivel5 on inf_plantasid=n5_id inner join ca_nivel1 on n5_idn1 = n1_id) as a inner join (SELECT cad_idopcion as idsup, cad_descripcionesp as nomsup FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=18) as B ON a.n5_supervisor=B.idsup WHERE inf_indice=:indiceinf ".$condi." group BY idsup, inf_indice, n1_nombre;");

//$sql="SELECT  id_sup, inf_indice, n5_idn4 as id_ciudad, sum(val_estatus) as val_estatus FROM ( SELECT inf_id, inf_indice, inf_usuario, inf_plantasid, inf_estatus, n5_nombre, n5_supervisor as id_sup, n5_idn4, val_estatus FROM `informes` INNER JOIN ca_nivel5 on inf_plantasid=n5_id  LEFT JOIN sup_validacion ON inf_indice=val_indice AND inf_usuario=val_rec_id AND inf_id=val_inf_id) as A WHERE inf_indice= :indiceinf ".$condi." GROUP BY id_sup, inf_indice, n5_idn4";


$sql="SELECT inf_indice, n5_supervisor as id_sup, n4_nombre as id_ciudad, sum(val_estatus) as val_estatus FROM `informes` INNER JOIN ca_nivel5 on inf_plantasid=n5_id inner join ca_nivel4 on n5_idn4=n4_id LEFT JOIN sup_validacion ON inf_indice=val_indice AND inf_usuario=val_rec_id AND inf_id=val_inf_id where inf_indice =:indiceinf ".$condi." GROUP BY inf_indice, n5_supervisor, n4_nombre";



	$stmt = Conexion::conectar()-> prepare($sql);


		$stmt->bindParam(":indiceinf", $indiceact, PDO::PARAM_STR);
		$stmt-> execute();
		return $stmt->fetchAll();

    }

    public function vistaSupInformeDetalleModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT informes.inf_id, informes.inf_plantasid,inf_visitasIdlocal, informes.inf_indice, informes.inf_usuario, ca_recolectores.rec_nombre, informes.inf_plantasid, n5_supervisor, n5_nombre, n5_idn1, n1_nombre, informes.inf_consecutivo FROM informes inner join ca_recolectores on inf_usuario=rec_id inner join ca_nivel5 on n5_id=inf_plantasid inner join ca_nivel1 on n1_id=n5_idn1 where informes.inf_id=:idinf and inf_indice=:idmes and inf_usuario=:idrec;");

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

    public function vistaSuptiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT * FROM `visitas` inner join informes on inf_visitasIdlocal=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector INNER JOIN ca_unegocios on vi_tiendaid=une_id where inf_id=:idinf and inf_indice=:idmes and inf_usuario=:idrec;");

	

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

  
    public function ActualizaSuptienda($datosModel, $tabla){

			
    // actualiza visita
    $stmt = Conexion::conectar()-> prepare("UPDATE `visitas` SET `vi_tipotienda`=:tipotien, `vi_cadenacomercial`=:cadcom, `vi_unedesc`=:nomtien, `vi_geolocalizacion`=:cxy, `vi_complementodir`=:compdir, `vi_direccion`=:dirtien, `vi_zona`=:zona WHERE `vi_idlocal`=:id and `vi_indice`=:indice and `vi_cverecolector`=:idrec");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":nomtien", $datosModel["nomtien"], PDO::PARAM_STR);
		$stmt->bindParam(":cxy", $datosModel["cxy"], PDO::PARAM_STR);
		$stmt->bindParam(":tipotien", $datosModel["tipotien"], PDO::PARAM_INT);
		$stmt->bindParam(":compdir", $datosModel["compdir"], PDO::PARAM_STR);
		$stmt->bindParam(":cadcom", $datosModel["cadcom"], PDO::PARAM_INT);
		$stmt->bindParam(":zona", $datosModel["zona"], PDO::PARAM_INT);
		$stmt->bindParam(":dirtien", $datosModel["dirtien"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		
// actualiza informe
	$stmt = Conexion::conectar()-> prepare("UPDATE `informes` SET `inf_comentarios`=:coment WHERE `inf_id`=:id and `inf_indice`=:indice and `inf_usuario`=:idrec");

		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":coment", $datosModel["coment"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		

    }

    public function vistaSigtiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT informes.inf_id, informes.inf_plantasid, informes.inf_indice, informes.inf_usuario, informes.inf_consecutivo FROM informes inner join visitas on inf_id=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector where informes.inf_id>:idinf and inf_indice=:idmes and inf_usuario=:idrec order by informes.inf_id;");

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

    public function vistalasttiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT informes.inf_id, informes.inf_plantasid, informes.inf_indice, informes.inf_usuario, informes.inf_consecutivo FROM informes inner join visitas on inf_id=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector where informes.inf_id>:idinf and inf_indice=:idmes and inf_usuario=:idrec order by informes.inf_id desc;");

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

 public function vistaAnttiendaModel($datosModel, $tabla){
    

	$stmt = Conexion::conectar()-> prepare("SELECT informes.inf_id, informes.inf_plantasid, informes.inf_indice, informes.inf_usuario, informes.inf_consecutivo FROM informes inner join visitas on inf_id=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector where informes.inf_id<:idinf and inf_indice=:idmes and inf_usuario=:idrec order by informes.inf_id desc;");

	    $stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

public function vistaFirtstiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT informes.inf_id, informes.inf_plantasid, informes.inf_indice, informes.inf_usuario, informes.inf_consecutivo FROM informes inner join visitas on inf_id=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector where informes.inf_id<:idinf and inf_indice=:idmes and inf_usuario=:idrec order by informes.inf_id;");



	    $stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }




    public function ActualizaSupDirtienda($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("UPDATE `ca_unegocios` SET `une_direccion`=:nomdir,`une_dir_referencia`=:comdir WHERE `une_id`=:numtien");

    	$stmt->bindParam(":numtien", $datosModel["numtien"], PDO::PARAM_INT);
		$stmt->bindParam(":nomdir", $datosModel["dirtien"], PDO::PARAM_STR);
		$stmt->bindParam(":comdir", $datosModel["compdir"], PDO::PARAM_STR);
		$stmt-> execute();
	}

    public function leeticketinforme($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("SELECT inf_id,inf_ticket_compra, n5_idn1 as cliente FROM `informes` inner join ca_nivel5 ON n5_id=inf_plantasid
 where inf_indice=:indice and inf_usuario=:numrec and inf_visitasIdlocal=:numvis order by n5_idn1;");

    	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":numrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":numvis", $datosModel["numvis"], PDO::PARAM_INT);
		$stmt-> execute();
		//$stmt->debugDumpParams();
		return $stmt->fetchall();
	}

   public function ActualizaComentinf($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("UPDATE `informes` SET `inf_comentarios`=:comen WHERE `inf_id`=:idinf and `inf_indice`=:idmes AND `inf_usuario`=:idrec AND inf_plantasid =:idplan");

    	$stmt->bindParam(":comen", $datosModel["coment"], PDO::PARAM_STR);
    	$stmt->bindParam(":idinf", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt->bindParam(":idplan", $datosModel["idplan"], PDO::PARAM_INT);
		$stmt-> execute();


	}


}
?>