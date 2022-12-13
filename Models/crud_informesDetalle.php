<?php
class DatosInformeDetalle{
    private static $conexion;
    
    public static function getInstance()
    {
        
        if (!isset(self::$conexion)) {
            $con=new Conexion();
            self::$conexion=$con->conectar();
        }
        
        return self::$conexion;
    }
    
    public  function getInformesDet($INDICE,$CVEUSUARIO,$tabla){
        
        
        $sSQL= "SELECT ind_id id, ind_informes_id informesId, 
ind_productos_id productoId,
pro_producto producto ,ind_tamanio_id tamanioId,
      cc.cad_descripcionesp as presentacion,
ind_empaque empaquesId, cem.cad_descripcionesp  empaque,
   ctp.cad_descripcionesp  as nombreTipoMuestra,ind_codigo codigo,
 ind_caducidad caducidad
, ind_tipomuestra tipoMuestra, 
ind_origen origen, 
ind_costo costo, ind_foto_codigo_produccion foto_codigo_produccion , 
ind_energia energia, ind_foto_num_tienda foto_num_tienda,
ind_marca_traslape marca_traslape, ind_atributoa atributoa,
ind_foto_atributoa foto_atributoa, ind_atributob atributob, 
ind_foto_atributob foto_atributob, ind_etiqueta_evaluacion etiqueta_evaluacion, 
 ind_qr qr,
 ind_comentarios, ind_estatus estatus, 
2  estatusSync, ind_atributoc atributoc,
ind_foto_atributoc foto_atributoc, ind_azucares azucares,
ind_tipoanalisis tipoAnalisis,
            cta.cad_descripcionesp  as tipoAnalisis,
ind_nummuestra numMuestra, ind_comprasid comprasId,
ind_compraddetid comprasDetId, ind_comprasIdbu comprasIdbu, 
ind_comprasDetIdbu comprasDetIdbu,ind_siglasprod
FROM $tabla
inner join ca_productos cp on cp.pro_id =ind_productos_id
            inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =cp.pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =ind_tamanio_id and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =ind_empaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =ind_tipoanalisis and cta.cad_idcatalogo =7
             inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =ind_tipomuestra and ctp.cad_idcatalogo =15
where ind_indice=:indice and ind_recolector=:cverecolector";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    public  function getInformesDetxInf($INDICE,$CVEUSUARIO,$informe,$tabla){
        
        
        $sSQL= "SELECT ind_id id, ind_informes_id informesId,
ind_productos_id productoId,
pro_producto producto ,ind_tamanio_id tamanioId,
      cc.cad_descripcionesp as presentacion,
ind_empaque empaquesId, cem.cad_descripcionesp  empaque,
   ctp.cad_descripcionesp  as nombreTipoMuestra,ind_codigo codigo, ind_caducidad caducidad
, ind_tipomuestra tipoMuestra,
ind_origen origen,
ind_costo costo, ind_foto_codigo_produccion foto_codigo_produccion ,
ind_energia energia, ind_foto_num_tienda foto_num_tienda,
ind_marca_traslape marca_traslape, ind_atributoa atributoa,
ind_foto_atributoa foto_atributoa, ind_atributob atributob,
ind_foto_atributob foto_atributob, ind_etiqueta_evaluacion etiqueta_evaluacion,
 ind_qr qr,
ind_comentarios, ind_estatus estatus,
2  estatusSync, ind_atributoc atributoc,
ind_foto_atributoc foto_atributoc, ind_azucares azucares,
ind_tipoanalisis tipoAnalisis,
            cta.cad_descripcionesp  as nombreAnalisis,
ind_nummuestra numMuestra, ind_comprasid comprasId,
ind_compraddetid comprasDetId, ind_comprasIdbu comprasIdbu,
ind_comprasDetIdbu comprasDetIdbu,ind_siglasprod
FROM $tabla
inner join ca_productos cp on cp.pro_id =ind_productos_id
            inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =cp.pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =ind_tamanio_id and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =ind_empaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =ind_tipoanalisis and cta.cad_idcatalogo =7
             inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =ind_tipomuestra and ctp.cad_idcatalogo =15
where ind_indice=:indice and ind_recolector=:cverecolector and ind_informes_id=:informe";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":informe",  $informe, PDO::PARAM_INT);
        
        $stmt-> execute();
      //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public  function getInformesDetxid($idlocal,$INDICE,$CVEUSUARIO,$tabla){
        
        
        $sSQL= "SELECT ind_id id, ind_informes_id informesId,
ind_productos_id productoId,
ind_tamanio_id tamanioId,
    ind_empaque empaquesId,
 ind_codigo codigo, ind_caducidad caducidad
, ind_tipomuestra tipoMuestra,
ind_origen origen,
ind_costo costo, ind_foto_codigo_produccion foto_codigo_produccion ,
ind_energia energia, ind_foto_num_tienda foto_num_tienda,
ind_marca_traslape marca_traslape, ind_atributoa atributoa,
ind_foto_atributoa foto_atributoa, ind_atributob atributob,
ind_foto_atributob foto_atributob, ind_etiqueta_evaluacion etiqueta_evaluacion,
 ind_qr qr,
 ind_comentarios, ind_estatus estatus,
2  estatusSync, ind_atributoc atributoc,
ind_foto_atributoc foto_atributoc, ind_azucares azucares,
ind_tipoanalisis tipoAnalisis,
       ind_nummuestra numMuestra, ind_comprasid comprasId,
ind_compraddetid comprasDetId, ind_comprasIdbu comprasIdbu,
ind_comprasDetIdbu comprasDetIdbu,ind_siglasprod
FROM $tabla
where ind_indice=:indice and ind_recolector=:cverecolector and ind_id=:id";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":id", $idlocal, PDO::PARAM_INT);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
     //   $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public static function insertar($datosModel,$recolector,$indice,$tabla,$pdo){
        try{
            
            $sSQL= "INSERT INTO informe_detalle
(ind_id,ind_informes_id, ind_productos_id, ind_tamanio_id, ind_empaque, ind_codigo, ind_caducidad,
 ind_tipomuestra, ind_origen, ind_costo, ind_foto_codigo_produccion, ind_energia, 
 ind_foto_num_tienda, ind_marca_traslape, ind_atributoa, 
ind_foto_atributoa, ind_atributob, ind_foto_atributob, ind_etiqueta_evaluacion, 
 ind_comentarios, 
ind_estatus, ind_atributoc, ind_foto_atributoc, ind_azucares, ind_tipoanalisis, ind_nummuestra,
 ind_comprasid, ind_compraddetid,ind_recolector,ind_indice, ind_qr,ind_siglasprod)
VALUES(:ind_id,:ind_informes_id, :ind_productos_id, :ind_tamanio, :ind_empaque, :ind_codigo, :ind_caducidad, 
:ind_backup, :ind_origen, :ind_costo, :ind_foto_codigo_produccion,
 :ind_energia,
:ind_foto_num_tienda, :ind_marca_traslape, :ind_atributoa,
 :ind_foto_atributoa, :ind_atributob, :ind_foto_atributob, :ind_etiqueta_evaluacion,
  :ind_comentarios, 
:ind_estatus, :ind_atributoc, :ind_foto_atributoc, :ind_azucares, :ind_tipoanalisis,
 :ind_nummuestra,
 :ind_comprasid, :ind_compraddetid, :ind_recolector,:ind_indice,:ind_qr,:ind_siglasprod); ";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":ind_id", $datosModel[ContratoInformesDet::ID],PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_informes_id", $datosModel[ContratoInformesDet::INFORMESID],PDO::PARAM_INT);
            $stmt->bindParam(":ind_productos_id", $datosModel[ContratoInformesDet::PRODUCTOID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_tamanio", $datosModel[ContratoInformesDet::TAMANIOID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_empaque", $datosModel[ContratoInformesDet::EMPAQUESID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_codigo", $datosModel[ContratoInformesDet::CODIGO], PDO::PARAM_STR);
            $stmt->bindParam(":ind_caducidad", $datosModel[ContratoInformesDet::CADUCIDAD], PDO::PARAM_STR);
            $stmt->bindParam(":ind_backup", $datosModel[ContratoInformesDet::TIPOMUESTR], PDO::PARAM_INT);
            $stmt->bindParam(":ind_origen", $datosModel[ContratoInformesDet::ORIGEN], PDO::PARAM_INT);
            $stmt->bindParam(":ind_costo", $datosModel[ContratoInformesDet::COSTO],PDO::PARAM_STR);
            $stmt->bindParam(":ind_foto_codigo_produccion", $datosModel[ContratoInformesDet::FOTOCODIGOPROD], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_energia", $datosModel[ContratoInformesDet::ENERGIA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_num_tienda", $datosModel[ContratoInformesDet::FOTONUMTIENDA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_marca_traslape", $datosModel[ContratoInformesDet::MARCATRAS], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributoa", $datosModel[ContratoInformesDet::ATRIBUTOA],PDO::PARAM_INT);
            
            
            $stmt->bindParam(":ind_foto_atributoa", $datosModel[ContratoInformesDet::FOTOATRA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributob", $datosModel[ContratoInformesDet::ATRIBUTOB], PDO::PARAM_INT);
             $stmt->bindParam(":ind_foto_atributob", $datosModel[ContratoInformesDet::FOTOATRB], PDO::PARAM_INT);
            $stmt->bindParam(":ind_etiqueta_evaluacion", $datosModel[ContratoInformesDet::ETIQUETAEVAL], PDO::PARAM_INT);
            
         //   $stmt->bindParam(":ind_ticket_compra", $datosModel[ContratoInformesDet::QR], PDO::PARAM_INT);
            $stmt->bindParam(":ind_comentarios", $datosModel[ContratoInformesDet::COMENT], PDO::PARAM_STR);
           
            $stmt->bindParam(":ind_estatus", $datosModel[ContratoInformesDet::ESTATUS], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributoc", $datosModel[ContratoInformesDet::ATRIBUTOC], PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_atributoc", $datosModel[ContratoInformesDet::FOTOATRC], PDO::PARAM_INT);
            $stmt->bindParam(":ind_azucares", $datosModel[ContratoInformesDet::AZUCARES], PDO::PARAM_INT);
            $stmt->bindParam(":ind_tipoanalisis", $datosModel[ContratoInformesDet::TIPOANA], PDO::PARAM_INT);
           
            $stmt->bindParam(":ind_nummuestra", $datosModel[ContratoInformesDet::NUMMUESTRA],PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_comprasid", $datosModel[ContratoInformesDet::COMPRASID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_compraddetid", $datosModel[ContratoInformesDet::COMPRASDETID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ind_recolector", $recolector, PDO::PARAM_INT);
            $stmt->bindParam(":ind_qr", $datosModel[ContratoInformesDet::QR], PDO::PARAM_STR);
            $stmt->bindParam(":ind_siglasprod", $datosModel[ContratoInformesDet::SIGLASPROD], PDO::PARAM_STR);
            
           
            if(!$stmt-> execute())
            {   
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            
        //    $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.insertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
    public  function getMuestrasxcliente($idlocal,$INDICE,$CVEUSUARIO,$cliente,$tabla){
        
      //  echo $idlocal."--".$INDICE."--".$CVEUSUARIO."--".$cliente."--".$tabla;
        $sSQL= "SELECT `ind_id`, `ind_informes_id`,
`ind_productos_id`, `ind_tamanio_id`, `ind_empaque`,
cem.cad_descripcionesp  empaque,
 ctp.cad_descripcionesp  as nombreTipoMuestra,
   cta.cad_descripcionesp  as tipoAnalisis,
`ind_codigo`,DATE_FORMAT(ind_caducidad,'%d-%m-%y') as caducidad, ind_caducidad,
`ind_tipomuestra`, `ind_origen`, `ind_costo`, `ind_comentarios`, `ind_estatus`,
 `ind_tipoanalisis`, `ind_nummuestra`, `ind_comprasid`, `ind_compraddetid`, `ind_indice`,
 `ind_recolector`, pro_producto, inf_ticket_compra, inf_plantasid, 
cor.cad_descripcionesp origen,
     cc.cad_descripcionesp as presentacion,
     ind_atributoa,ind_atributob,ind_atributoc,
    caa.at_nombre atributoa,
    cab.at_nombre atributob,
    cac.at_nombre atributoc,
 ind_foto_codigo_produccion,
    ind_foto_num_tienda,ind_qr,
  ind_foto_atributoa,
  ind_foto_atributob,ind_foto_atributoc,
  ind_etiqueta_evaluacion,
 ind_siglasprod
FROM $tabla
inner join pr_listacompradetalle ON ind_comprasid=lid_idlistacompra
and ind_compraddetid=lid_idprodcompra
inner join informes on ind_informes_id= inf_id and ind_indice=inf_indice
and ind_recolector=inf_usuario
INNER JOIN ca_productos on pr_listacompradetalle.lid_idproducto=ca_productos.pro_id
   inner join ca_catalogosdetalle cc on cc.cad_idopcion =ind_tamanio_id and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =ind_empaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =ind_tipoanalisis and cta.cad_idcatalogo =7
           inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =ind_tipomuestra and ctp.cad_idcatalogo =15
             inner join ca_catalogosdetalle cor on cor.cad_idopcion =ind_origen and cor.cad_idcatalogo =8
             left join ca_atributo caa on caa.id_atributo =ind_atributoa 
             left join ca_atributo cab on cab.id_atributo =ind_atributob 
              left join ca_atributo cac on cac.id_atributo =ind_atributoc 
      WHERE ind_indice=:indice and ind_recolector=:cverecolector and ind_informes_id=:id
and pro_cliente=:cliente
       order by ind_id";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":id", $idlocal, PDO::PARAM_INT);
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
         $stmt-> execute();
          
       //$stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
      
        
    }
    
    public static function actualizar($ind_id,$origen,$qr,$siglasprod,$codigo, $costo,$caducidad, $atributoa, $atributob, $atributoc,$recolector,$indice,$tabla){
        try{
            
            $sSQL= "UPDATE informe_detalle
                    SET 
ind_origen=:origen,ind_qr=:qr,ind_siglasprod=:siglasprod,
                    ind_codigo=:ind_codigo, ind_caducidad=:ind_caducidad,
                    ind_costo=:ind_costo, 
                     ind_atributoa=:ind_atributoa,  ind_atributob=:ind_atributob,  ind_atributoc=:ind_atributoc
                     WHERE ind_id=:ind_id AND ind_indice=:ind_indice AND ind_recolector=:ind_recolector; ";
            
            $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
            $stmt->bindParam(":ind_id", $ind_id,PDO::PARAM_INT);
            $stmt->bindParam(":ind_codigo", $codigo, PDO::PARAM_STR);
            $stmt->bindParam(":ind_caducidad", $caducidad, PDO::PARAM_STR);
             $stmt->bindParam(":ind_costo", $costo,PDO::PARAM_STR);
             $stmt->bindParam(":origen", $origen, PDO::PARAM_STR);
             $stmt->bindParam(":qr", $qr, PDO::PARAM_STR);
             $stmt->bindParam(":siglasprod", $siglasprod,PDO::PARAM_STR);
            $stmt->bindParam(":ind_atributoa", $atributoa,PDO::PARAM_INT);
        
            $stmt->bindParam(":ind_atributob", $atributob, PDO::PARAM_INT);
             $stmt->bindParam(":ind_atributoc", $atributoc, PDO::PARAM_INT);
             $stmt->bindParam(":ind_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ind_recolector", $recolector, PDO::PARAM_INT);
            
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            
         //     $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.actualizar "+$ex->getMessage());
            throw new Exception("Hubo un error al actualizar el informe detalle");
        }
        
    }
    
    public static function actualizarEstatus($ind_id,$recolector,$indice,$estatus,$tabla){
        try{
            
            $sSQL= "UPDATE informe_detalle
                    SET
                    ind_estatus=:ind_estatus
                     WHERE ind_id=:ind_id AND ind_indice=:ind_indice AND ind_recolector=:ind_recolector; ";
            
            $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
            $stmt->bindParam(":ind_id", $ind_id,PDO::PARAM_INT);
           
            $stmt->bindParam(":ind_estatus", $estatus, PDO::PARAM_INT);
            $stmt->bindParam(":ind_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ind_recolector", $recolector, PDO::PARAM_INT);
            
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            
             //  $stmt->debugDumpParams();
            //   die();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.actualizar "+$ex->getMessage());
            throw new Exception("Hubo un error al actualizar el informe detalle");
        }
        
    }
    
   
    public function getByCompraBu(  $idcompra,  $iddet,$INDICE,$CVEUSUARIO,$tabla){
        $sSQL= "SELECT
	`ind_id`,
	`ind_informes_id`,
	`ind_productos_id`,
	`ind_tamanio_id`,
	`ind_empaque`,
	cem.cad_descripcionesp empaque,
	ctp.cad_descripcionesp as nombreTipoMuestra,
	cta.cad_descripcionesp as tipoAnalisis,
	`ind_codigo`,
	`ind_caducidad`,
	`ind_tipomuestra`,
	`ind_origen`,
	`ind_costo`,
	`ind_comentarios`,
	`ind_estatus`,
	`ind_tipoanalisis`,
	`ind_nummuestra`,
	`ind_comprasid`,
	`ind_compraddetid`,
	`ind_indice`,
	`ind_recolector`,ind_siglasprod,
	pro_producto,
	cc.cad_descripcionesp as presentacion
FROM $tabla
INNER JOIN ca_productos on
	ind_productos_id = ca_productos.pro_id
inner join ca_catalogosdetalle cc on
	cc.cad_idopcion = ind_tamanio_id
	and cc.cad_idcatalogo = 13
inner join ca_catalogosdetalle cem on
	cem.cad_idopcion = ind_empaque
	and cem.cad_idcatalogo = 12
inner join ca_catalogosdetalle cta on
	cta.cad_idopcion = ind_tipoanalisis
	and cta.cad_idcatalogo = 7
	    inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =ind_tipomuestra and ctp.cad_idcatalogo =15
          where ind_comprasid=:idcompra 
and ind_compraddetid=:iddet and ind_tipomuestra=3 and ind_recolector=:recolector
 and ind_indice=:indice";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":iddet", $iddet, PDO::PARAM_INT);
        $stmt->bindParam(":idcompra", $idcompra, PDO::PARAM_INT);
        $stmt->bindParam(":recolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
    }
    
    public function getByCompra(  $idcompra,  $iddet,$INDICE,$CVEUSUARIO,$tabla){
        $sSQL= "SELECT * FROM $tabla where ind_comprasid=:idcompra
and ind_compraddetid=:iddet and ind_tipomuestra<>3 and ind_recolector=:recolector
 and ind_indice=:indice";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":iddet", $iddet, PDO::PARAM_INT);
        $stmt->bindParam(":idcompra", $idcompra, PDO::PARAM_INT);
        $stmt->bindParam(":recolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        //   $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
    }
    
    # CLASE NIVEL 1n1
    public function getListaComDet($idliscomp, $tabla){
        
        $stmt = Conexion::conectar()-> prepare("SELECT lid_idprodcompra,lid_idlistacompra,lis_idplanta, pro_id, pro_orden, lis_idindice, lid_idproducto, `lid_fechapermitida`,`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad, pro_producto, lid_idtamano,
 lid_idempaque, lid_idtipoanalisis, desctam, ordtam,lid_saldoaceptado,lid_saldocomprado comprados,
 lid_tipo, idemp, descemp, ordemp, idtipa, desctipa, ordtipa, idtipm, desctipm,
 ordtipm FROM (
    SELECT lis_idplanta,lid_idlistacompra, lid_idprodcompra, lis_idindice, 
`lid_fechapermitida`, `lid_fecharestringida`, `lid_backup`, lid_idproducto,
 lid_cantidad, pro_id, pro_orden, pro_producto, lid_idtamano, lid_idempaque,
 lid_idtipoanalisis, lid_tipo,lid_saldocomprado, lid_saldoaceptado FROM pr_listacompradetalle 
inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra 
inner join ca_productos ON lid_idproducto=pro_id where lid_idlistacompra=:idliscomp) as A inner JOIN (SELECT cad_idopcion as idtam, cad_descripcionesp as desctam, cad_otro as ordtam FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as B ON A.lid_idtamano=B.idtam INNER JOIN (SELECT cad_idopcion as idemp, cad_descripcionesp as descemp, cad_otro as ordemp FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=12) as C ON A.lid_idempaque=C.idemp INNER JOIN (SELECT cad_idopcion as idtipa, cad_descripcionesp as desctipa, cad_otro as ordtipa FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=7) as D ON A.lid_idtipoanalisis=D.idtipa INNER JOIN (SELECT cad_idopcion as idtipm, cad_descripcionesp as desctipm, cad_otro as ordtipm FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=15) as E ON A.lid_tipo=E.idtipm ORDER BY pro_orden ASC, ordtam DESC, ordemp ASC, ordtipa ASC, ordtipm;");
        
        
        //$stmt = Conexion::conectar()-> prepare("SELECT lis_idplanta, pro_id, lis_idindice, lid_idproducto, `lid_fechapermitida`,`lid_fecharestringida`,`lid_backup`, lid_idprodcompra, lid_cantidad, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, cad_descripcionesp, cad_otro, lid_tipo FROM (SELECT lis_idplanta, lid_idprodcompra, lis_idindice, `lid_fechapermitida`, `lid_fecharestringida`, `lid_backup`, lid_idproducto, lid_cantidad, pro_id, pro_producto, lid_idtamano, lid_idempaque, lid_idtipoanalisis, lid_tipo FROM $tabla inner join pr_listacompra ON lis_idlistacompra=lid_idlistacompra inner join ca_productos ON lid_idproducto=pro_id where lid_idlistacompra=:idliscomp) as a INNER JOIN (SELECT cad_idopcion, cad_descripcionesp, cad_otro FROM `ca_catalogosdetalle` WHERE cad_idcatalogo=13) as b ON lid_idtamano=cad_idopcion ORDER BY pro_id, cad_otro ASC, lid_idempaque ASC, lid_idtipoanalisis ASC, lid_tipo;");
        
        $stmt->bindParam(":idliscomp", $idliscomp,PDO::PARAM_INT);
        
        $stmt-> execute();
        //$stmt->debugDumpParams();
        return $stmt->fetchAll();
        
    }
    
    public function sumaCompradosLista($idlis,$prdocom,$cantidad,$tabla){
        try{
            
            $sSQL= "UPDATE $tabla SET
            lid_saldocomprado=IFNULL(lid_saldocomprado,0)+:cantidad
             WHERE lid_idlistacompra=:idlis and lid_idprodcompra=:claop";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
            $stmt->bindParam(":claop", $prdocom, PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt-> execute();
            //      $stmt->debugDumpParams();
           
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar la cantidad ");
        }
    }
    
    public function restaCompradosLista($idlis,$prdocom,$cantidad,$tabla){
        try{
            
            $sSQL= "UPDATE $tabla SET

            lid_saldocomprado=if(lid_saldocomprado<0,0,IFNULL(lid_saldocomprado,0))-:cantidad
             WHERE lid_idlistacompra=:idlis and lid_idprodcompra=:claop";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
            $stmt->bindParam(":claop", $prdocom, PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt-> execute();
         //   $this->updateFechaLista($idlis, "pr_listacompra");
            //      $stmt->debugDumpParams();
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar la cantidad ");
        }
    }
    
    public function updateFechaLista($idlis,$tabla){
        try{
            
            $sSQL= "UPDATE $tabla
SET  lis_fechaactualizacion=now()
WHERE lis_idlistacompra=:idlis;";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
          
            $stmt-> execute();
            //      $stmt->debugDumpParams();
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar");
        }
    }

   
    public function  findByInformeAtra(  $idinf,  $fotoatra,$recolector,$indice,$tabla){
 
        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla
where ind_informes_id=:idinf and ind_foto_atributoa=:fotoatra  and ind_recolector=:recolector
 and ind_indice=:indice");
       
        $stmt->bindParam(":idinf", $idinf,PDO::PARAM_INT);
        $stmt->bindParam(":fotoatra", $fotoatra,PDO::PARAM_INT);
        $stmt->bindParam(":recolector", $recolector,PDO::PARAM_INT);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        //$stmt->debugDumpParams();
        return $stmt->fetch();
        
    }
    
    
    public function actualizarCancelada($indice,$rec,$id,$estatus,$tabla){
        try{
           // echo $indice."--".$rec."--".$id."--".$estatus;
            $sSQL= "UPDATE $tabla
                    SET
                    ind_estatus=:ind_estatus
                     WHERE ind_id=:id and ind_indice=:indice and ind_recolector=:rec";
            
            $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
            $stmt->bindParam(":id", $id,PDO::PARAM_INT);
            $stmt->bindParam(":rec", $rec, PDO::PARAM_INT);
            $stmt->bindParam(":indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ind_estatus", $estatus, PDO::PARAM_INT);
            $stmt->debugDumpParams();
           // die($sSQL);
          //  
            $stmt->execute();
            //   $this->updateFechaLista($idlis, "pr_listacompra");
                 
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar el estatus ".$ex);
        }
    }
    public function getCancelada($idlis,$prdocom,$estatus,$tabla){
        try{
            //echo $idlis."--".$prdocom."--".$estatus;
            $sSQL= "select * from $tabla
                     WHERE ind_comprasid=:idlis and ind_compraddetid=:claop and (ind_estatus=2 or ind_estatus=5)";
            
            $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
            $stmt->bindParam(":idlis", $idlis,PDO::PARAM_INT);
            $stmt->bindParam(":claop", $prdocom, PDO::PARAM_INT);
           // $stmt->bindParam(":ind_estatus", $estatus, PDO::PARAM_INT);
             $stmt->debugDumpParams();
            // die($sSQL);
            //
            $stmt->execute();
            //   $this->updateFechaLista($idlis, "pr_listacompra");
            return $stmt->fetch();
            
        }catch(PDOException $ex){
            throw new Exception("Hubo un error al actualizar el estatus ".$ex);
        }
    }
}