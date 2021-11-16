<?php
class DatosInformeDetalle{
    
    public static function insertar($datosModel,$recolector,$indice,$tabla){
        try{
            
            $sSQL= "INSERT INTO informe_detalle
(ind_informes_id, ind_productos_id, ind_tamanio, ind_empaque, ind_codigo, ind_caducidad,
 ind_tipomuestra, ind_origen, ind_costo, ind_foto_codigo_produccion, ind_energia, 
 ind_foto_num_tienda, ind_marca_traslape, ind_atributoa, 
ind_foto_atributoa, ind_atributob, ind_foto_atributob, ind_etiqueta_evaluacion, 
 ind_qr,  ind_comentarios, 
ind_estatus, ind_atributoc, ind_foto_atributoc, ind_azucares, ind_tipoanalisis, ind_nummuestra,
 ind_comprasid, ind_compraddetid,ind_recolector,ind_indice)
VALUES(:ind_informes_id, :ind_productos_id, :ind_tamanio, :ind_empaque, :ind_codigo, :ind_caducidad, 
:ind_backup, :ind_origen, :ind_costo, :ind_foto_codigo_produccion, :ind_energia,
:ind_foto_num_tienda, :ind_marca_traslape, :ind_atributoa,
 :ind_foto_atributoa, :ind_atributob, :ind_foto_atributob, :ind_etiqueta_evaluacion,
 :ind_ticket_compra, :ind_comentarios, 
:ind_estatus, :ind_atributoc, :ind_foto_atributoc, :ind_azucares, :ind_tipoanalisis, :ind_nummuestra,
 :ind_comprasid, :ind_compraddetid); ";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
          //  $stmt->bindParam(":ind_id", $datosModel[ContratoInformesDet::ID],PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_informes_id", $datosModel[ContratoInformesDet::INFORMESID],PDO::PARAM_INT);
            $stmt->bindParam(":ind_productos_id", $datosModel[ContratoInformesDet::PRODUCTOID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_tamanio", $datosModel[ContratoInformesDet::PRESENTACION], PDO::PARAM_INT);
            $stmt->bindParam(":ind_empaque", $datosModel[ContratoInformesDet::EMPAQUESID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_codigo", $datosModel[ContratoInformesDet::CODIGO], PDO::PARAM_STR);
            $stmt->bindParam(":ind_caducidad", $datosModel[ContratoInformesDet::CADUCIDAD], PDO::PARAM_STR);
            $stmt->bindParam(":ind_backup", $datosModel[ContratoInformesDet::TIPOMUESTR], PDO::PARAM_INT);
            $stmt->bindParam(":ind_origen", $datosModel[ContratoInformesDet::ORIGEN], PDO::PARAM_INT);
            $stmt->bindParam(":ind_costo", $datosModel[ContratoInformesDet::COSTO],PDO::PARAM_STR);
            $stmt->bindParam(":ind_foto_codigo_produccion", $datosModel[ContratoInformesDet::FOTOCODIGOPROD], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_energia", $datosModel[ContratoInformesDet::ENERGIA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_num_tienda", $datosModel[ContratoInformesDet::FOTONUMTIENDA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":ind_recolector", $recolector, PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_marca_traslape", $datosModel[ContratoInformesDet::MARCATRAS], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributoa", $datosModel[ContratoInformesDet::ATRIBUTOA],PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_atributoa", $datosModel[ContratoInformesDet::FOTOATRA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributob", $datosModel[ContratoInformesDet::ATRIBUTOB], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_foto_atributob", $datosModel[ContratoInformesDet::FOTOATRB], PDO::PARAM_INT);
            $stmt->bindParam(":ind_etiqueta_evaluacion", $datosModel[ContratoInformesDet::ETIQUETAEVAL], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_ticket_compra", $datosModel[ContratoInformesDet::QR], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_comentarios", $datosModel[ContratoInformesDet::COMENT], PDO::PARAM_STR);
            $stmt->bindParam(":ind_estatus", $datosModel[ContratoInformesDet::ESTATUS], PDO::PARAM_INT);
              
            $stmt->bindParam(":ind_atributoc", $datosModel[ContratoInformesDet::ATRIBUTOC], PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_atributoc", $datosModel[ContratoInformesDet::FOTOATRC], PDO::PARAM_INT);
            $stmt->bindParam(":ind_azucares", $datosModel[ContratoInformesDet::AZUCARES], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_tipoanalisis", $datosModel[ContratoInformesDet::TIPOANA], PDO::PARAM_INT);
            $stmt->bindParam(":ind_nummuestra", $datosModel[ContratoInformesDet::NUMMUESTRA],PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_comprasid", $datosModel[ContratoInformesDet::COMPRASID], PDO::PARAM_INT);
            $stmt->bindParam(":ind_compraddetid", $datosModel[ContratoInformesDet::COMPRASDETID], PDO::PARAM_INT);
            
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