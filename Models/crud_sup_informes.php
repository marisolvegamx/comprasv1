<?php

require_once "Models/conexion.php";
class DatosSupInformes extends Conexion{

	
	public function vistaSupInfModel($condi, $indiceact, $tabla){

	//$stmt = Conexion::conectar()-> prepare("select count(inf_id) as totinf, inf_usuario, inf_indice, idsup, nomsup, n5_nombre, inf_plantasid, n1_nombre, sum(if(inf_estatus=3 or inf_estatus=4,1,0)) as totestatus from (SELECT inf_id, inf_indice, inf_usuario, inf_plantasid, inf_estatus, n5_nombre, n1_nombre, n5_supervisor FROM `informes` INNER JOIN ca_nivel5 on inf_plantasid=n5_id inner join ca_nivel1 on n5_idn1 = n1_id) as a inner join (SELECT cad_idopcion as idsup, cad_descripcionesp as nomsup FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=18) as B ON a.n5_supervisor=B.idsup WHERE inf_indice=:indiceinf ".$condi." group BY idsup, inf_indice, n1_nombre;");

//$sql="SELECT  id_sup, inf_indice, n5_idn4 as id_ciudad, sum(val_estatus) as val_estatus FROM ( SELECT inf_id, inf_indice, inf_usuario, inf_plantasid, inf_estatus, n5_nombre, n5_supervisor as id_sup, n5_idn4, val_estatus FROM `informes` INNER JOIN ca_nivel5 on inf_plantasid=n5_id  LEFT JOIN sup_validacion ON inf_indice=val_indice AND inf_usuario=val_rec_id AND inf_id=val_inf_id) as A WHERE inf_indice= :indiceinf ".$condi." GROUP BY id_sup, inf_indice, n5_idn4";


$sql="SELECT inf_indice, n5_supervisor as id_sup, n4_id as numciu, n4_nombre as id_ciudad, sum(val_estatus) as val_estatus FROM `informes` INNER JOIN ca_nivel5 on inf_plantasid=n5_id inner join ca_nivel4 on n5_idn4=n4_id LEFT JOIN sup_validacion ON inf_indice=val_indice AND inf_usuario=val_rec_id AND inf_id=val_inf_id where inf_indice =:indiceinf ".$condi." GROUP BY inf_indice, n5_supervisor, n4_nombre";

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

	$stmt = Conexion::conectar()-> prepare("SELECT * FROM `visitas` inner join informes on inf_visitasidlocal=vi_idlocal and inf_indice=vi_indice and inf_usuario=vi_cverecolector INNER JOIN ca_unegocios on vi_tiendaid=une_id where inf_id=:idinf and inf_indice=:idmes and inf_usuario=:idrec;");

	

		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

  
    public function ActualizaSuptienda($datosModel, $tabla){

//var_dump($datosModel["compdir"]);
			
    // actualiza visita
    $stmt = Conexion::conectar()-> prepare("UPDATE `visitas` SET `vi_tipotienda`=:tipotien, `vi_cadenacomercial`=:cadcom, `vi_unedesc`=:nomtien, `vi_geolocalizacion`=:cxy, `vi_complementodir`=:compdir1, `vi_direccion`=:dirtien, `vi_zona`=:zona WHERE `vi_tiendaid`=:id and `vi_indice`=:indice and `vi_cverecolector`=:idrec");

		$stmt->bindParam(":id", $datosModel["idt"], PDO::PARAM_INT);
		$stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);
		$stmt->bindParam(":nomtien", $datosModel["nomtien"], PDO::PARAM_STR);
		$stmt->bindParam(":cxy", $datosModel["cxy"], PDO::PARAM_STR);
		$stmt->bindParam(":tipotien", $datosModel["tipotien"], PDO::PARAM_INT);
		$stmt->bindParam(":compdir1", $datosModel["compdir"], PDO::PARAM_STR);
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
		$stmt-> execute();{}
		

    }

    public function vistaSigtiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT vi_idlocal FROM `visitas` inner join ca_recolectores on rec_id=vi_cverecolector inner join informes on vi_idlocal=inf_visitasidlocal left join ca_nivel5 on n5_id=inf_plantasid inner join ca_nivel4 on n5_idn4=n4_id where vi_idlocal>:idinf and vi_indice=:idmes and n5_supervisor =:idsup and n4_nombre=:idciu group by vi_idlocal ORDER BY vi_idlocal;
");




		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

    }

    public function vistalasttiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT vi_idlocal FROM `visitas` inner join ca_recolectores on rec_id=vi_cverecolector inner join informes on vi_idlocal=inf_visitasidlocal left join ca_nivel5 on n5_id=inf_plantasid inner join ca_nivel4 on n5_idn4=n4_id where vi_idlocal>:idinf and vi_indice=:idmes and n5_supervisor =:idsup and n4_nombre=:idciu group by vi_idlocal ORDER BY vi_idlocal DESC;");


		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_INT);
		$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt-> execute();
		return $stmt->fetchall();

    }

 public function vistaAnttiendaModel($datosModel, $tabla){
    

	$stmt = Conexion::conectar()-> prepare("SELECT vi_idlocal FROM `visitas` inner join ca_recolectores on rec_id=vi_cverecolector inner join informes on vi_idlocal=inf_visitasidlocal left join ca_nivel5 on n5_id=inf_plantasid inner join ca_nivel4 on n5_idn4=n4_id where vi_idlocal<:idinf and vi_indice=:idmes and n5_supervisor =:idsup and n4_nombre=:idciu group by vi_idlocal ORDER BY vi_idlocal DESC;");
	

	    $stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_STR);
		$stmt-> execute();
		return $stmt->fetchall();

    }

public function vistaFirtstiendaModel($datosModel, $tabla){

	$stmt = Conexion::conectar()-> prepare("SELECT vi_idlocal FROM `visitas` inner join ca_recolectores on rec_id=vi_cverecolector inner join informes on vi_idlocal=inf_visitasidlocal left join ca_nivel5 on n5_id=inf_plantasid inner join ca_nivel4 on n5_idn4=n4_id where vi_idlocal<:idinf and vi_indice=:idmes and n5_supervisor =:idsup and n4_nombre=:idciu group by vi_idlocal ORDER BY vi_idlocal;
");



	    $stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
		$stmt->bindParam(":idsup", $datosModel["idsup"], PDO::PARAM_INT);
		$stmt->bindParam(":idciu", $datosModel["idciu"], PDO::PARAM_INT);
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
    $stmt = Conexion::conectar()-> prepare("SELECT inf_ticket_compra, n5_idn1 as cliente FROM `informes` inner join ca_nivel5 ON n5_id=inf_plantasid
 where inf_indice=:indice and inf_usuario=:numrec and inf_visitasIdlocal=:numvis and n5_idn1=4 order by n5_idn1;");

    	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
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

   public function BuscaEncabezadoPlanta($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("SELECT n5_id, n1_id, n5_nombre, n1_nombre FROM `ca_nivel5` inner join ca_nivel4 on n5_idn4=n4_id inner join ca_nivel1 on n5_idn1= n1_id where n4_nombre=:ciudad and n5_idn1=:cliente;");

       	$stmt->bindParam(":ciudad", $datosModel["idciu"], PDO::PARAM_STR);
    	$stmt->bindParam(":cliente", $datosModel["idcli"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

	}

	public function BuscaEtapasPlanta($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("  
SELECT red_idetapa, ine_indice, ine_plantasid, val_estatus,ine_cverecolector FROM `informes_etapa` inner join ca_recolectoresdetalle 
on ine_cverecolector=red_id and ine_clientesid=red_idcliente and ine_etapa=red_idetapa left join sup_validacion 
on val_inf_id=ine_id and val_rec_id=ine_cverecolector and val_etapa=ine_etapa where ine_indice=:indice and ine_plantasid=:idplanta and ine_etapa=:ideta and ine_clientesid=:cliente;
");

       	$stmt->bindParam(":cliente", $datosModel["idcli"], PDO::PARAM_INT);
    	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
    	$stmt->bindParam(":idplanta", $datosModel["idpla"], PDO::PARAM_INT);
	$stmt->bindParam(":ideta", $datosModel["ideta"], PDO::PARAM_INT);
	$stmt-> execute();
return $stmt->fetchall();

	}
	

    public function verificaInforme($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("SELECT inf_id, inf_plantasid, inf_indice, inf_visitasidlocal, sum(vai_numfoto) as estatusinf FROM `informes` left join sup_validacion on inf_id=val_inf_id and inf_indice=val_indice and inf_usuario=val_rec_id left join sup_validafotos on val_id=vai_id where inf_plantasid=:planta and inf_indice=:indice and inf_visitasidlocal=:idtienda group by inf_plantasid;");

       	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
    	$stmt->bindParam(":planta", $datosModel["idplan"], PDO::PARAM_INT);
    	$stmt->bindParam(":idtienda", $datosModel["idtien"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

	}


    public function verificaalerta($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("
    SELECT val_id, val_inf_id, vai_numfoto, val_indice, val_rec_id, vai_descripcionfoto, vai_estatus, vai_observaciones, rec_nombre, n5_nombre, n1_nombre, vi_unedesc FROM sup_validafotos inner join sup_validacion on val_id=vai_id inner join informes on val_inf_id=inf_id and val_indice=inf_indice and val_rec_id=inf_usuario inner join visitas on inf_visitasidlocal=vi_idlocal and inf_usuario=vi_cverecolector and inf_indice=vi_indice inner join ca_recolectores on val_rec_id=rec_id inner join ca_nivel5 on inf_plantasid=n5_id inner join ca_nivel1 on n5_idn1=n1_id where val_indice=:indice and val_rec_id=:idrec and val_inf_id=:idinf and (vai_estatus=1 or vai_estatus=4 or vai_estatus=5);");



       	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
    	$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
    	$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

	}


 public function verificaalertatien($datosModel, $tabla){

	// actualiza tienda
    $stmt = Conexion::conectar()-> prepare("
      SELECT val_id, val_vis_id, vai_numfoto, vi_unedesc, val_indice, val_rec_id, vai_estatus, vai_observaciones, rec_nombre FROM sup_validafotos inner join sup_validacion on val_id=vai_id INNER JOIN visitas on vi_cverecolector=val_rec_id and vi_idlocal=val_vis_id and vi_indice=val_indice inner join ca_recolectores on val_rec_id=rec_id where val_indice=:indice and val_rec_id=:idrec and val_vis_id=:idinf and (vai_estatus=1 or vai_estatus=4 or vai_estatus=5);");



       	$stmt->bindParam(":indice", $datosModel["idmes"], PDO::PARAM_STR);
    	$stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
    	$stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
		$stmt-> execute();
		return $stmt->fetchall();

	}
}


?>