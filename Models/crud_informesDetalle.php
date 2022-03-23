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
where ind_indice=:indice and ind_recolector=:cverecolector and ind_id=:informe";
        
        $stmt=DatosInformeDetalle::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        $stmt->bindParam(":informe",  $informe, PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
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
}