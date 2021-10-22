<?php
class DatosInformeDetalle{
    
    public static function insertar($datosModel,$tabla){
        try{
            
            $sSQL= "INSERT INTO informe_detalle
(ind_informes_id, ind_productos_id, ind_tamanio, ind_empaque, ind_codigo, ind_caducidad,
 ind_tipomuestra, ind_origen, ind_costo, ind_foto_codigo_produccion, ind_energia, 
 ind_foto_num_tienda, ind_marca_traslape, ind_atributoa, 
ind_foto_atributoa, ind_atributob, ind_foto_atributob, ind_etiqueta_evaluacion, 
ind_segunda_muestra, ind_qr, ind_condiciones_traslado, ind_comentarios, 
ind_estatus, ind_atributoc, ind_foto_atributoc, ind_azucares, ind_tipoanalisis, ind_nummuestra,
 ind_comprasid, ind_compraddetid)
VALUES(:ind_informes_id, :ind_productos_id, :ind_tamanio, :ind_empaque, :ind_codigo, :ind_caducidad, 
:ind_backup, :ind_origen, :ind_costo, :ind_foto_codigo_produccion, :ind_energia,
:ind_foto_num_tienda, :ind_marca_traslape, :ind_atributoa,
 :ind_foto_atributoa, :ind_atributob, :ind_foto_atributob, :ind_etiqueta_evaluacion,
 :ind_segunda_muestra, :ind_ticket_compra, :ind_condiciones_traslado, :ind_comentarios, 
:ind_estatus, :ind_atributoc, :ind_foto_atributoc, :ind_azucares, :ind_tipoanalisis, :ind_nummuestra,
 :ind_comprasid, :ind_compraddetid); ";
            
            $stmt=Conexion::conectar()->prepare($sSQL);
            $stmt->bindParam(":ind_informes_id", $datosModel["ind_informes_id"],PDO::PARAM_INT);
            $stmt->bindParam(":ind_productos_id", $datosModel["ind_productos_id"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_tamanio", $datosModel["ind_tamanio"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_empaque", $datosModel["ind_empaque"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_codigo", $datosModel["ind_codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":ind_caducidad", $datosModel["ind_caducidad"], PDO::PARAM_STR);
            $stmt->bindParam(":ind_backup", $datosModel["ind_tipomuestra"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_origen", $datosModel["ind_origen"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_costo", $datosModel["ind_costo"],PDO::PARAM_STR);
            $stmt->bindParam(":ind_foto_codigo_produccion", $datosModel["ind_foto_codigo_produccion"], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_energia", $datosModel["ind_energia"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_num_tienda", $datosModel["ind_foto_num_tienda"], PDO::PARAM_INT);
         //   $stmt->bindParam(":inf_indice", $datosModel["inf_indice"], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_marca_traslape", $datosModel["ind_marca_traslape"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributoa", $datosModel["ind_atributoa"],PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_atributoa", $datosModel["ind_foto_atributoa"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_atributob", $datosModel["ind_atributob"], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_foto_atributob", $datosModel["ind_foto_atributob"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_etiqueta_evaluacion", $datosModel["ind_etiqueta_evaluacion"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_segunda_muestra", $datosModel["ind_segunda_muestra"], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_ticket_compra", $datosModel["ind_qr"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_condiciones_traslado", $datosModel["ind_condiciones_traslado"],PDO::PARAM_INT);
           
            $stmt->bindParam(":ind_comentarios", $datosModel["ind_comentarios"], PDO::PARAM_STR);
            $stmt->bindParam(":ind_estatus", $datosModel["ind_estatus"], PDO::PARAM_INT);
              
            $stmt->bindParam(":ind_atributoc", $datosModel["ind_atributoc"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_foto_atributoc", $datosModel["ind_foto_atributoc"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_azucares", $datosModel["ind_azucares"], PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_tipoanalisis", $datosModel["ind_tipoanalisis"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_nummuestra", $datosModel["ind_nummuestra"],PDO::PARAM_INT);
            
            $stmt->bindParam(":ind_comprasid", $datosModel["ind_comprasid"], PDO::PARAM_INT);
            $stmt->bindParam(":ind_compraddetid", $datosModel["ind_compraddetid"], PDO::PARAM_INT);
            
            $stmt-> execute();
            $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInformeDetalle.inesertar "+$ex->getMessage());
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
}