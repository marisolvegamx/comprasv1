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
ind_segunda_muestra, ind_qr qr,
ind_condiciones_traslado, ind_comentarios, ind_estatus estatus, 
2  estatusSync, ind_atributoc atributoc,
ind_foto_atributoc foto_atributoc, ind_azucares azucares,
ind_tipoanalisis tipoAnalisis,
            cta.cad_descripcionesp  as tipoAnalisis,
ind_nummuestra numMuestra, ind_comprasid comprasId,
ind_compraddetid comprasDetId, ind_comprasIdbu comprasIdbu, 
ind_comprasDetIdbu comprasDetIdbu
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
ind_segunda_muestra, ind_qr qr,
ind_condiciones_traslado, ind_comentarios, ind_estatus estatus,
2  estatusSync, ind_atributoc atributoc,
ind_foto_atributoc foto_atributoc, ind_azucares azucares,
ind_tipoanalisis tipoAnalisis,
            cta.cad_descripcionesp  as nombreAnalisis,
ind_nummuestra numMuestra, ind_comprasid comprasId,
ind_compraddetid comprasDetId, ind_comprasIdbu comprasIdbu,
ind_comprasDetIdbu comprasDetIdbu
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
ind_segunda_muestra, ind_qr qr,
ind_condiciones_traslado, ind_comentarios, ind_estatus estatus,
2  estatusSync, ind_atributoc atributoc,
ind_foto_atributoc foto_atributoc, ind_azucares azucares,
ind_tipoanalisis tipoAnalisis,
       ind_nummuestra numMuestra, ind_comprasid comprasId,
ind_compraddetid comprasDetId, ind_comprasIdbu comprasIdbu,
ind_comprasDetIdbu comprasDetIdbu
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
 ind_comprasid, ind_compraddetid,ind_recolector,ind_indice, ind_qr)
VALUES(:ind_id,:ind_informes_id, :ind_productos_id, :ind_tamanio, :ind_empaque, :ind_codigo, :ind_caducidad, 
:ind_backup, :ind_origen, :ind_costo, :ind_foto_codigo_produccion,
 :ind_energia,
:ind_foto_num_tienda, :ind_marca_traslape, :ind_atributoa,
 :ind_foto_atributoa, :ind_atributob, :ind_foto_atributob, :ind_etiqueta_evaluacion,
  :ind_comentarios, 
:ind_estatus, :ind_atributoc, :ind_foto_atributoc, :ind_azucares, :ind_tipoanalisis,
 :ind_nummuestra,
 :ind_comprasid, :ind_compraddetid, :ind_recolector,:ind_indice,:ind_qr); ";
            
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
            
           
            if(!$stmt-> execute())
            {   
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            
        //    $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    
    public  function getMuestrasxcliente($idlocal,$INDICE,$CVEUSUARIO,$cliente,$tabla){
        
        
        $sSQL= "SELECT `ind_id`, `ind_informes_id`,
`ind_productos_id`, `ind_tamanio_id`, `ind_empaque`,
cem.cad_descripcionesp  empaque,
 ctp.cad_descripcionesp  as nombreTipoMuestra,
   cta.cad_descripcionesp  as tipoAnalisis,
`ind_codigo`, `ind_caducidad`,
`ind_tipomuestra`, `ind_origen`, `ind_costo`, `ind_comentarios`, `ind_estatus`,
 `ind_tipoanalisis`, `ind_nummuestra`, `ind_comprasid`, `ind_compraddetid`, `ind_indice`,
 `ind_recolector`, pro_producto, inf_ticket_compra, inf_plantasid, 
 inf_productoexhibido,cor.cad_descripcionesp origen,
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
  ind_condiciones_traslado
FROM $tabla
inner join pr_listacompradetalle ON ind_comprasid=lid_idlistacompra
and ind_compraddetid=lid_idprodcompra
inner join informes on ind_id= inf_id and ind_indice=inf_indice
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
          
        //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
      
        
    }
    
    public static function actualizar($ind_id,$codigo, $costo,$caducidad, $atributoa, $atributob, $atributoc,$recolector,$indice,$tabla){
        try{
            
            $sSQL= "UPDATE comprasdata.informe_detalle
                    SET 
                    ind_codigo=:ind_codigo, ind_caducidad=:ind_caducidad,
                    ind_costo=:ind_costo, 
                     ind_atributoa=:ind_atributoa,  ind_atributob=:ind_atributoa,  ind_atributoc=:ind_atributoc
                     WHERE ind_id=:ind_id AND ind_indice=:ind_indice AND ind_recolector=:ind_recolector; ";
            
            $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
            $stmt->bindParam(":ind_id", $ind_id,PDO::PARAM_INT);
            $stmt->bindParam(":ind_codigo", $codigo, PDO::PARAM_STR);
            $stmt->bindParam(":ind_caducidad", $caducidad, PDO::PARAM_STR);
             $stmt->bindParam(":ind_costo", $costo,PDO::PARAM_STR);
            $stmt->bindParam(":ind_atributoa", $atributoa,PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_atributob", $atributob, PDO::PARAM_INT);
             $stmt->bindParam(":ind_atributoc", $atributoc, PDO::PARAM_INT);
             $stmt->bindParam(":ind_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ind_recolector", $recolector, PDO::PARAM_INT);
            
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
            
            //    $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.actualizar "+$ex->getMessage());
            throw new Exception("Hubo un error al actualizar el informe detalle");
        }
        
    }
    
   
    public function getByCompraBu(  $idcompra,  $iddet,$INDICE,$CVEUSUARIO,$tabla){
        $sSQL= "SELECT * FROM $tabla where ind_comprasid=:idcompra 
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
}