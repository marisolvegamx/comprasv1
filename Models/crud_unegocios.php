<?php

require_once "Models/conexion.php";

class DatosUnegocio extends Conexion {
#vistaservicios

	public function vistaUnegocioModel( $tabla){
		$stmt = Conexion::conectar()-> prepare("SELECT une_id, n3_nombre, n4_nombre, une_descripcion FROM `ca_unegocios` left JOIN ca_nivel3 ON `une_cla_pais`= N3_ID LEFT JOIN ca_nivel4 ON une_cla_ciudad= N4_ID ORDER BY une_id DESC;");
		
        $stmt->execute();
	
        
        return $stmt->fetchAll();
    }
    
    public function vistaUnegocioModelCiudad( $tabla){
        $stmt = Conexion::conectar()-> prepare("SELECT une_id,cad_descripcionesp,cad_descripcioning,ciu_descripcionesp,ciu_descripcioning,
  une_descripcion 
FROM `ca_unegocios` 
inner join ca_catalogosdetalle on cad_idopcion=une_cla_pais and cad_idcatalogo=10
inner join ca_ciudadesresidencia on ciu_id=une_cla_ciudad and ciu_paisid=une_cla_pais
 ORDER BY une_id DESC;");
        
        $stmt->execute();
        
        
        return $stmt->fetchAll();
    }


	public function vistaFiltroUnegocioModel($cta, $datosbus,$estado,$ciudad, $tabla){

		$sql="SELECT une_id, une_descripcion, une_idpepsi,
 une_idcuenta,une_num_unico_distintivo,une_dir_estado, une_dir_municipio,est_nombre FROM $tabla
inner join `ca_uneestados` ON `est_id`=`une_dir_idestado`
where cue_clavecuenta=:cta and une_descripcion
LIKE :opbusqueda ";
	
		// agregando filtros
		if(isset($estado)&&$estado!="0") {
			$sql.=" and ca_unegocios.une_dir_idestado=:estado";
		
		}
		      
		if(isset($ciudad)){
			
			if($ciudad!="") {
				$sql.=" and ca_unegocios.une_dir_municipio=:ciudad";
			
			}
		}
		$stmt = Conexion::conectar()-> prepare($sql." order by une_dir_estado" );
		if(isset($estado)&&$estado!="0") {
			
			$stmt-> bindParam(":estado", $estado, PDO::PARAM_INT);
		}
		
		if(isset($ciudad)){
			
			if($ciudad!="") {
			
				$stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
			}
		}
        $stmt->bindParam(":opbusqueda", $datosbus, PDO::PARAM_STR);
		$stmt-> bindParam(":cta", $cta, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

	public function cuentaUnegocioModel($cta, $tabla){

		$stmt = Conexion::conectar()-> prepare("SELECT une_id, une_descripcion, une_idpepsi, une_idcuenta FROM $tabla where cue_clavecuenta=:cta");
		$stmt-> bindParam(":cta", $cta, PDO::PARAM_INT);		


        $stmt->execute();



        return $qty = $stmt->RowCount();
    }

    public function vistaUnegocioDetalle($uneg, $tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT une_id, une_descripcion, une_idpepsi, une_idcuenta FROM $tabla WHERE une_id=:uneg");



        $stmt->bindParam(":uneg", $uneg, PDO::PARAM_STR);



        $stmt->execute();



        return $stmt->fetch();
    }

    public function ReportesUnegocio($idser, $iduneg, $tabla) {

		$stmt = Conexion::conectar()-> prepare("SELECT i_claveservicio, i_numreporte, i_finalizado FROM $tabla WHERE i_claveservicio=:idser and i_unenumpunto=:iduneg");



		$stmt-> bindParam(":idser", $idser, PDO::PARAM_INT);

		$stmt-> bindParam(":iduneg", $iduneg, PDO::PARAM_INT);



        $stmt->execute();



        return $stmt->fetchall();
    }

    public function UnegocioCompleta($iduneg, $tabla) {

        $stmt = Conexion::conectar()->prepare("SELECT une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad, une_estatus, une_coordenadasxy, une_puntocardinal, une_tipotienda, une_cadenacomercial FROM ca_unegocios WHERE une_id=:iduneg;");

        $stmt->bindParam(":iduneg", $iduneg, PDO::PARAM_STR);
        $stmt->execute();
      
        return $stmt->fetch();
    }
    
    
   
    public function actualizarUnegocio($datosModel, $tabla) {

        try {

//procedimiento de insercion de  la cuenta	   
          
            $sSQL = "UPDATE ca_unegocios SET une_descripcion=:descuneg, une_direccion=:dirtien, une_dir_referencia=:refer, une_cla_pais=:pais, une_cla_ciudad=:ciudad, une_estatus=:estatus, une_coordenadasxy=:cxy, une_puntocardinal=:puncar, une_tipotienda=:tipo, une_cadenacomercial=:cadcom WHERE une_id=:idt";

            $stmt = Conexion::conectar()->prepare($sSQL);

            $stmt->bindParam(":descuneg", $datosModel["nomuneg"]);
            $stmt->bindParam(":dirtien", $datosModel["dirtien"]);
            $stmt->bindParam(":refer", $datosModel["refer"]);
            $stmt->bindParam(":pais", $datosModel["pais"]);
            $stmt->bindParam(":ciudad", $datosModel["ciudad"]);
            $stmt->bindParam(":estatus", $datosModel["estatus"]);
            $stmt->bindParam(":cxy", $datosModel["cxy"]);
            $stmt->bindParam(":puncar", $datosModel["puncar"]);
            $stmt->bindParam(":tipo", $datosModel["tipo"]);
            $stmt->bindParam(":cadcom", $datosModel["cadcom"]);
            $stmt->bindParam(":idt", $datosModel["idt"]);
            $stmt->execute();

            return "success";
        } catch (Exception $ex) {

            return "error";
        }
    }

   

    function unegociosxNivel($fil_ptoventa, $fil_idpepsi, $filx, $fily, $ini, $fin) {



        $sql = " select  ca_unegocios.une_id,

ca_unegocios.une_descripcion, concat(une_dir_calle,' ',

    une_dir_numeroext,' ',

    une_dir_colonia) as direccion,

   une_dir_municipio, une_idcuenta,une_id,cue_clavecuenta,fc_idfranquiciacta,

    une_idpepsi,une_num_unico_distintivo

FROM

ca_unegocios

where 1=1 ";

        if ($fil_ptoventa != "") {

            $sql .= " and une_descripcion like '%" . $fil_ptoventa . "%' ";
        }

        if ($fil_idpepsi != "") {

            $sql .= " and une_num_unico_distintivo='" . $fil_idpepsi . "'";
        }

        if (isset($filx["pais"]) && $filx["pais"] != "") {

            $sql .= " AND `une_cla_region`=:pais";

            $parametros["pais"] = $filx["pais"];
        }

        if (isset($filx["uni"]) && $filx["uni"] != "") {

            $sql .= " AND `une_cla_pais`=:uni";

            $parametros["uni"] = $filx["uni"];
        }

        if (isset($filx["zon"]) && $filx["zon"] != "") {

            $sql .= "  and     ca_unegocios.une_cla_zona=:zon";

            $parametros["zon"] = $filx["zon"];
        }

        if (isset($fily["cta"]) && $fily["cta"] != "") {

            $sql .= " and ca_unegocios.cue_clavecuenta=:cta";

            $parametros["cta"] = $fily["cta"];
        }

        if (isset($filx["reg"]) && $filx["reg"] != "") {

            $sql .= " and ca_unegocios.une_cla_estado=:reg";

            $parametros["reg"] = $filx["reg"];
        }

        if (isset($filx["ciu"]) && $filx["ciu"] != "") {

            $sql .= " and ca_unegocios.une_cla_ciudad=:ciu";

            $parametros["ciu"] = $filx["ciu"];
        }

        if (isset($filx["niv6"]) && $filx["niv6"] != "") {

            $sql .= " and ca_unegocios.une_cla_franquicia=:niv6";

            $parametros["niv6"] = $filx["niv6"];
        }

        if (isset($fily["fra"]) && $fily["fra"] != "") {

            $sql .= " and ca_unegocios.fc_idfranquiciacta=:fra";

            $parametros["fra"] = $fily["fra"];
        }





        $sql .= " order by une_id";



        if ($fin != "") {
            $sql .= " LIMIT $ini,$fin";



//      $parametros["start"]=$ini;
//        $parametros["end"]=$fin;
        }



        $res = Conexion::ejecutarQuery($sql, $parametros);





        return $res;
    }

    function unegociosxNivelxServicio($servicio, $fil_ptoventa, $fil_idpepsi, $filx, $fily, $ini, $fin) {



        $sql = " select  ca_unegocios.une_id,

ca_unegocios.une_descripcion, concat(une_dir_calle,' ',

    une_dir_numeroext,' ',

    une_dir_colonia) as direccion,

   une_dir_municipio, une_idcuenta,une_id,cue_clavecuenta,fc_idfranquiciacta,

    une_idpepsi,une_num_unico_distintivo

FROM

ca_unegocios

INNER JOIN

ins_generales ON i_unenumpunto=une_id 

 WHERE `i_claveservicio`=:servicio ";

        $parametros["servicio"] = $servicio;

        if ($fil_ptoventa != "") {

            $sql .= " and une_descripcion like '%" . $fil_ptoventa . "%' ";
        }

        if ($fil_idpepsi != "") {

            $sql .= " and une_idpepsi='" . $fil_idpepsi . "'";
        }

        if (isset($filx["pais"]) && $filx["pais"] != "") {

            $sql .= " AND `une_cla_region`=:pais";

            $parametros["pais"] = $filx["pais"];
        }

        if (isset($filx["uni"]) && $filx["uni"] != "") {

            $sql .= " AND `une_cla_pais`=:uni";

            $parametros["uni"] = $filx["uni"];
        }

        if (isset($filx["zon"]) && $filx["zon"] != "") {

            $sql .= "  and     ca_unegocios.une_cla_zona=:zon";

            $parametros["zon"] = $filx["zon"];
        }

        if (isset($fily["cta"]) && $fily["cta"] != "") {

            $sql .= " and ca_unegocios.cue_clavecuenta=:cta";

            $parametros["cta"] = $fily["cta"];
        }

        if (isset($filx["reg"]) && $filx["reg"] != "") {

            $sql .= " and ca_unegocios.une_cla_estado=:reg";

            $parametros["reg"] = $filx["reg"];
        }

        if (isset($filx["ciu"]) && $filx["ciu"] != "") {

            $sql .= " and ca_unegocios.une_cla_ciudad=:ciu";

            $parametros["ciu"] = $filx["ciu"];
        }

        if (isset($filx["niv6"]) && $filx["niv6"] != "") {

            $sql .= " and ca_unegocios.une_cla_franquicia=:niv6";

            $parametros["niv6"] = $filx["niv6"];
        }

        if (isset($fily["fra"]) && $fily["fra"] != "") {

            $sql .= " and ca_unegocios.fc_idfranquiciacta=:fra";

            $parametros["fra"] = $fily["fra"];
        }





        $sql .= "  GROUP BY une_id order by une_id";



        if ($fin != "") {
            $sql .= " LIMIT $ini,$fin";



            //      $parametros["start"]=$ini;
            //        $parametros["end"]=$fin;
        }



        $res = Conexion::ejecutarQuery($sql, $parametros);





        return $res;
    }

    public function unegociosxTipoMercado($tipomercado, $cliente, $franq) {

        $sql = "SELECT une_id, une_descripcion FROM ca_unegocios Inner Join ca_cuentas ON ca_cuentas.cue_id = ca_unegocios.cue_clavecuenta

WHERE ca_cuentas.cue_tipomercado =:tipomer "
                . "  and fc_idfranquiciacta=:fc_idfranquiciacta

  order by une_descripcion;";



        $parametros = array("tipomer" => $tipomercado,
           
            "fc_idfranquiciacta" => $franq);

        $res = Conexion::ejecutarQuery($sql, $parametros);

        return $res;
    }

    public function unegocioxIdCuentaCuenta($idcta, $cta, $tabla) {

    	$sql = "SELECT une_id, une_descripcion FROM ca_unegocios 
WHERE ca_unegocios.une_idcuenta =:idcta
    			
AND ca_unegocios.cue_clavecuenta =:cta";
    	



        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":idcta", $idcta);

       $stmt->bindParam(":cta", $cta);

        $stmt->execute();
//$stmt->debugDumpParams();die();
        return $stmt->fetchAll();
    }
    
    
    public function unegocioxNudCuenta($nud, $cta, $tabla) {
    	
    	$sql = "SELECT * FROM ca_unegocios
WHERE ca_unegocios.une_num_unico_distintivo=:nud
AND ca_unegocios.cue_clavecuenta =:cta";
    	
    	$stmt = Conexion::conectar()->prepare($sql);
    	
    	$stmt->bindParam(":nud", $nud);
    	
    	$stmt->bindParam(":cta", $cta);
    	
    	$stmt->execute();
    //	$stmt->debugDumpParams();die();
    	return $stmt->fetch();
    }
    
  

    public function unegociosxNivelxTipoMer($VarNivel2, $referencianivel, $tipoMercado, $cliente, $franquicia) {

        $aux2 = explode(".", $referencianivel);

        $slq_franquicia = "SELECT

ca_unegocios.une_id,

ca_unegocios.une_descripcion

FROM

ca_unegocios

Inner Join ca_cuentas ON ca_unegocios.cue_clavecuenta = ca_cuentas.cue_id AND ca_unegocios.ser_claveservicio = ca_cuentas.ser_claveservicio AND ca_unegocios.cli_idcliente = ca_cuentas.cli_idcliente";



        switch ($VarNivel2) {

            case 6: $filtro = " ca_unegocios.une_cla_region=$aux2[1] and

ca_unegocios.une_cla_pais=$aux2[2] and

ca_unegocios.une_cla_zona=$aux2[3] and

ca_unegocios.une_cla_estado=$aux2[4] and

ca_unegocios.une_cla_ciudad=$aux2[5] and

ca_unegocios.une_cla_franquicia=$aux2[6] ";

                break;

            case 5: $filtro = " ca_unegocios.une_cla_region=$aux2[1] and

ca_unegocios.une_cla_pais=$aux2[2] and

ca_unegocios.une_cla_zona=$aux2[3] and

ca_unegocios.une_cla_estado=$aux2[4] and

ca_unegocios.une_cla_ciudad=$aux2[5] ";

                break;

            case 4: $filtro = " ca_unegocios.une_cla_region=$aux2[1] and

ca_unegocios.une_cla_pais=$aux2[2] and

ca_unegocios.une_cla_zona=$aux2[3] and

ca_unegocios.une_cla_estado=$aux2[4] ";

                break;

            case 3: $filtro = "ca_unegocios.une_cla_region=$aux2[1] and

ca_unegocios.une_cla_pais=$aux2[2] and

ca_unegocios.une_cla_zona=$aux2[3] ";

                break;

            case 2: $filtro = "ca_unegocios.une_cla_region=$aux2[1] and

ca_unegocios.une_cla_pais=$aux2[2]";

                break;

            case 1: $filtro = "ca_unegocios.une_cla_region=$aux2[1]";

                break;
        }//fin switch

        $slq_franquicia .= " where " . $filtro . " and ca_cuentas.cue_tipomercado =:tipomer and `ca_unegocios`.`cli_idcliente`=:scli and

  and fc_idfranquiciacta=:franq;";

        $parametros = array("opcionSeleccionadaCuenta" => $tipoMercado,
            "scli" => $cliente,
            "franq" => $franquicia);

        return Conexion::ejecutarQuery($slq_franquicia, $parametros);
    }
   public function insertarUnegociodesdeSolicitud($servicio, $reporte) {
    	try{

        $ssql = "select max(une_id) as claveuneg from ca_unegocios";



        $stmt = Conexion::conectar()->prepare($ssql);



        $stmt->execute();

        $rs = $stmt->fetch();



        if (sizeof($rs) > 0) {



            $numunineg = $rs["claveuneg"];
        } else {

            $numunineg = 0;
        }

        $numunineg += 1;

       // calcula numero de punto general
        // asigna nuevo numero de punto de venta
        $sqlc="SELECT Max(ca_unegocios.une_numpunto) AS ulnum FROM ca_unegocios";
        $rsm=Conexion::ejecutarQuerysp($sqlc);
        foreach($rsm as $rowm){
        	$npunto = $rowm["ulnum"] + 1;
        }



        $stmt = null;

        //procedimiento de insercion de  la cuenta

        $sqli = "INSERT INTO ca_unegocios (cue_clavecuenta, une_id, une_descripcion,  une_idcuenta, 

 une_dir_calle, une_dir_numeroext, une_dir_numeroint,

 une_dir_manzana, une_dir_lote, une_dir_colonia,

 une_dir_delegacion, une_dir_municipio, une_dir_idestado, une_dir_cp, une_dir_referencia, une_dir_telefono, 

 une_numpunto,ca_unegocios.une_estatus,une_fechaestatus,une_idpepsi,
  une_num_unico_distintivo)

 SELECT cer_solicitud.sol_cuenta,  :numunineg, cer_solicitud.sol_descripcion,

cer_solicitud.sol_idcuenta,

 cer_solicitud.sol_dir_calle, cer_solicitud.sol_dir_numeroext, cer_solicitud.sol_dir_numeroint,

 cer_solicitud.sol_dir_manzana, cer_solicitud.sol_dir_lote, cer_solicitud.sol_dir_colonia,

 cer_solicitud.sol_dir_delegacion, cer_solicitud.sol_dir_municipio, cer_solicitud.sol_dir_estado, cer_solicitud.sol_dir_cp, cer_solicitud.sol_dir_referencia, cer_solicitud.sol_dir_telefono, 

:npunto, 1, curdate(),'',''

 FROM cer_solicitud 
WHERE cer_solicitud.sol_claveservicio =:servicio 
AND cer_solicitud.sol_idsolicitud =:reporte";

        $stmt = Conexion::conectar()->prepare($sqli);



        $stmt->bindParam(":numunineg", $numunineg, PDO::PARAM_INT);

        $stmt->bindParam(":npunto", $npunto, PDO::PARAM_INT);

        $stmt->bindParam(":servicio", $servicio, PDO::PARAM_INT);

        $stmt->bindParam(":reporte", $reporte, PDO::PARAM_INT);



        $res = $stmt->execute();

       // $stmt->debugDumpParams();

        return $npunto;

        if (!$res)
            throw new Exception("Error al insertar solicitud");
    	}catch(PDOException $ex){
    		throw new Exception("Error al insertar solicitud");
    	}
    }
   
   
   
   
	 public function insertarUnegocio($datosModel, $tabla) {
        try {
           
            $stmt = null;
//procedimiento de insercion de  la cuenta	   
            $sSQL = "INSERT INTO ca_unegocios(une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad, une_estatus, une_coordenadasxy, une_puntocardinal, une_tipotienda, une_cadenacomercial) VALUES (:nomuneg, :dirtien, :refer, :paisuneg, :ciudaduneg, :estatusuneg, :cxy, :puncaruneg,:tipouneg,:cadcomuneg)";
            $stmt = Conexion::conectar()->prepare($sSQL);

            $stmt->bindParam(":nomuneg", $datosModel["nomuneg"], PDO::PARAM_STR);
            $stmt->bindParam(":dirtien", $datosModel["dirtien"], PDO::PARAM_STR);
            $stmt->bindParam(":refer", $datosModel["refer"], PDO::PARAM_STR);
            $stmt->bindParam(":paisuneg", $datosModel["paisuneg"], PDO::PARAM_INT);
            $stmt->bindParam(":ciudaduneg", $datosModel["ciudaduneg"], PDO::PARAM_INT);
            $stmt->bindParam(":cxy", $datosModel["cxy"], PDO::PARAM_STR);
            $stmt->bindParam(":puncaruneg", $datosModel["puncaruneg"], PDO::PARAM_INT);
            $stmt->bindParam(":cadcomuneg", $datosModel["cadcomuneg"], PDO::PARAM_INT);
            $stmt->bindParam(":estatusuneg", $datosModel["estatusuneg"], PDO::PARAM_INT);
            $stmt->bindParam(":tipouneg", $datosModel["tipouneg"], PDO::PARAM_INT);

            $res = $stmt->execute();

           if($res)
              return "success";
        } catch (Exception $ex) {
            return "error";
        }
    }
    
    public function unegocioxCuentaFranq( $cta,$fran) {
        
        $sql = "SELECT une_id, une_descripcion FROM ca_unegocios 
            
WHERE ca_unegocios.cue_clavecuenta =:idcta and  fc_idfranquiciacta=:franqcuenta";
        
        
        
        $stmt = Conexion::conectar()->prepare($sql);
        
        $stmt->bindParam(":idcta", $cta,PDO::PARAM_INT);
        $stmt->bindParam(":franqcuenta", $fran,PDO::PARAM_STR);
        
      
        
        $stmt->execute();
       // $stmt->debugDumpParams();
        return $stmt->fetchAll();
    }

    
    public function unegocioEstado($cta){
    	$ssqe="SELECT ca_unegocios.une_dir_idestado, ca_uneestados.est_id,
 ca_uneestados.est_nombre FROM ca_unegocios
	Inner Join ca_uneestados ON ca_unegocios.une_dir_idestado = ca_uneestados.est_id
 	where cue_clavecuenta=:numcuen
	group by ca_unegocios.une_dir_idestado";
    	   	
    	
    	$stmt = Conexion::conectar()->prepare($ssqe);
    	
    	$stmt->bindParam(":numcuen", $cta,PDO::PARAM_INT);
    	
    	
    	
    	$stmt->execute();
    	// $stmt->debugDumpParams();
    	return $stmt->fetchAll();
    	
    }
    
    public function actualizarUnegocioContacto($uneid,$telefono1,$telefono2,$correo){
    	$ssqe="UPDATE `ca_unegocios`
SET 
  `une_dir_telefono` =:telefono,
  `une_dir_telefono2` =:telefono2,
  `une_dir_correoe` =:correo
 WHERE `une_id` =:une_id;";
    	try{
    	$stmt = Conexion::conectar()->prepare($ssqe);
    	
    	$stmt->bindParam(":telefono", $telefono1,PDO::PARAM_STR);
    	$stmt->bindParam(":telefono2", $telefono2,PDO::PARAM_STR);
    	$stmt->bindParam(":correo", $correo,PDO::PARAM_STR);
    	$stmt->bindParam(":une_id", $uneid,PDO::PARAM_INT);
    	$stmt->execute();
    	
    	}catch(Exception $ex){
    		Utilerias::guardarError($ex);
    		throw new Exception("Error al actualizar los datos de contacto");
    	}
    	
    }
    
    
    public function eliminauneg($iduneg,$tabla){
            //try{      
              
              $sSQL= "DELETE FROM $tabla WHERE une_id=:iduneg";
              
              $stmt=Conexion::conectar()->prepare($sSQL);
              $stmt->bindParam(":iduneg", $iduneg,PDO::PARAM_INT);
                 
              $stmt-> execute();
              
            //}//catch(PDOException $ex){
              //throw new Exception("Hubo un error al insertar el recolector");
            //}
            
    }

}

?>	