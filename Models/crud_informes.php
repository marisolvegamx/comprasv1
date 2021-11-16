<?php

class DatosInforme{
   
    private static $conexion;
    
    public static function getInstance()
    {
        
        if (!isset(self::$conexion)) {
            $con=new Conexion();
            self::$conexion=$con->conectar();
        }
        
        return self::$conexion;
    }
    public  function insertar($datosModel,$cveusuario,$indice,$tabla){
        try{
         
            $econexion=self::getInstance();
            $sSQL= "INSERT INTO $tabla
( inf_id,inf_consecutivo, inf_visitasIdlocal, inf_segunda_muestra, inf_tercera_muestra,
inf_indice, inf_usuario,
 inf_comentarios, inf_estatus, inf_primera_muestra, inf_plantasid,
 inf_ticket_compra, inf_condiciones_traslado)
VALUES(:inf_id,:inf_consecutivo, :inf_visitasIdlocal, :inf_segunda_muestra, :inf_tercera_muestra, 
:inf_indice,:inf_recolector, 
:inf_comentarios, :inf_estatus,  :inf_primera_muestra, :inf_plantasid,
:inf_ticket_compra, :inf_condiciones_traslado);
";
            
            $stmt=$econexion->prepare($sSQL);
            $stmt->bindParam(":inf_id", $datosModel[ContratoInformes::ID],PDO::PARAM_INT);
            
            $stmt->bindParam(":inf_consecutivo", $datosModel[ContratoInformes::CONSECUTIVO],PDO::PARAM_INT);
            $stmt->bindParam(":inf_visitasIdlocal", $datosModel[ContratoInformes::VISITASID], PDO::PARAM_INT);
            $stmt->bindParam(":inf_segunda_muestra", $datosModel[ContratoInformes::SEGUNDAMUESTRA], PDO::PARAM_INT);
            $stmt->bindParam(":inf_tercera_muestra", $datosModel[ContratoInformes::TERCERAMUESTRA], PDO::PARAM_INT);
            $stmt->bindParam(":inf_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":inf_usuario", $cveusuario, PDO::PARAM_STR);
            $stmt->bindParam(":inf_comentarios", $datosModel[ContratoInformes::COMENTARIOS], PDO::PARAM_STR);
            
            $stmt->bindParam(":inf_estatus", $datosModel[ContratoInformes::ESTATUS], PDO::PARAM_INT);
          //  $stmt->bindParam(":inf_created_at", $datosModel[ContratoInformes::CREA], PDO::PARAM_STR);
            //$stmt->bindParam(":inf_updated_at", $datosModel[ContratoInformes::"inf_updated_at"], PDO::PARAM_STR);
            $stmt->bindParam(":inf_primera_muestra", $datosModel[ContratoInformes::PRIMERAMUESTRA],PDO::PARAM_INT);
            $stmt->bindParam(":inf_plantasid", $datosModel[ContratoInformes::PLANTASID], PDO::PARAM_INT);
            $stmt->bindParam(":inf_ticket_compra", $datosModel[ContratoInformes::TICKETCOMPRA], PDO::PARAM_INT);
            $stmt->bindParam(":inf_condiciones_traslado", $datosModel[ContratoInformes::CONDICIONESTRASLADO], PDO::PARAM_INT);
               
           $stmt-> execute();
           if(sizeof($stmt->errorInfo())){
               throw new Exception($stmt->errorInfo()[2]);
           }
       //     echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInforme.inesertar "+$ex->getMessage());
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    public  function getAtributos($tabla){
        $econexion=self::getInstance();
        $stmt =   $econexion-> prepare("SELECT id_tipoempaque, cad_descripcionesp as nombre_empaqueesp,
    cad_descripcioning as nombre_empaque_ing,
    id_atributo, at_nombre, at_idcliente, at_idclasificaciondano, at_idponderaciondano
    FROM $tabla
    inner join ca_catalogosdetalle
    on cad_idopcion=id_tipoempaque and cad_idcatalogo=12");
        
        $stmt-> execute();
        //    echo $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public function getNvaLisComprxRecol($idrecolector,$fecha,$indice,$tabla){
        $econexion=self::getInstance();
        //me faltan las siglas
        $sSQL="SELECT lis_idlistacompra as id,
            lis_idplanta as plantasId,
            cc.n5_nombre  as plantaNombre,
            
            lis_idcliente as clientesId,
            cn.n1_nombre  as clienteNombre,
            lis_idindice as indice,
            cn2.n4_id as ciudadesId,
            cn2.n4_nombre as ciudadNombre,
            lis_idusuario as createdBy,
            lis_nota
            FROM $tabla
             inner join ca_nivel1 cn on lis_idcliente=cn.n1_id 
             inner join ca_nivel5 cc on lis_idplanta=cc.n5_id 
             inner join ca_nivel4 cn2 on cn2.n4_id =cc.n5_idn4 
            where lis_fechacreacion >:fechareq
            and lis_idrecolector =:recolector
             and lis_idindice=:indice";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getActLisComprxRecol($idrecolector,$fecha,$indice,$tabla){
        $econexion=self::getInstance();
        //me faltan las siglas
        $sSQL="SELECT lis_idlistacompra as id,
            lis_idplanta as plantasId,
            cc.n5_nombre  as plantaNombre,
            
            lis_idcliente as clientesId,
            cn.n1_nombre  as clienteNombre,
            lis_idindice as indice,
            cn2.n4_id as ciudadesId,
            cn2.n4_nombre as ciudadNombre,
            lis_idusuario as createdBy,
            lis_nota
            FROM $tabla
             inner join ca_nivel1 cn on lis_idcliente=cn.n1_id
             inner join ca_nivel5 cc on lis_idplanta=cc.n5_id
             inner join ca_nivel4 cn2 on cn2.n4_id =cc.n5_idn4
            where lisfechaactualizacion >:fechareq
            and lis_idrecolector =:recolector
            and lis_idindice=:indice";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
      //  echo $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    //vistanN6Byn5
   /* public function getSiglas($idplanta,$tabla){
        //me faltan las siglas
        $sSQL="select n6_id, n6_nombre from $tabla cn 
where cn.n6_idn5 =:idplan";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":idpla", $idplanta,PDO::PARAM_INT);
       
        $stmt-> execute();
        return $stmt->fetchAll();
        
    }*/
    public function getNvaLisComprDetxRecol($idrecolector,$fecha,$indice,$tabla){
        $econexion=self::getInstance();
        //me faltan las siglas
        $sSQL="SELECT lid_idlistacompra as id, lid_idprodcompra as listaId, 
            lid_idproducto as productosId, 
            cp.pro_producto as productoNombre,
            cc.cad_descripcionesp as tamanio, lid_idempaque as empaquesId,
            cem.cad_descripcionesp  as empaque,
            lid_idtipoanalisis as analisisId,
            cta.cad_descripcionesp  as tipoAnalisis,
            lid_cantidad as cantidad, lid_tipo as tipoMuestra,
             ctp.cad_descripcionesp  as nombreTipoMuestra,
            lid_fechapermitida , lid_fecharestringida,
            cp.pro_categoria as categoriaid, ccp.cad_descripcionesp as categoria
            FROM $tabla
            inner join pr_listacompra pl on pl.lis_idlistacompra =lid_idlistacompra
            inner join ca_productos cp on cp.pro_id =lid_idproducto 
            inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =cp.pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =lid_idtamano and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =lid_idempaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =lid_idtipoanalisis and cta.cad_idcatalogo =7
             inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =lid_tipo and ctp.cad_idcatalogo =15
            where pl.lis_idrecolector =:recolector and pl.lis_fechacreacion>:fechareq
            and pl.lis_idindice=:indice";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getActLisComprDetxRecol($idrecolector,$fecha,$indice,$tabla){
        $econexion=self::getInstance();
        //me faltan las siglas
        $sSQL="SELECT lid_idlistacompra as id, lid_idprodcompra as listaId,
            lid_idproducto as productosId,
            cp.pro_producto as productoNombre,
            cc.cad_descripcionesp as tamanio, lid_idempaque as empaquesId,
            cem.cad_descripcionesp  as empaque,
            lid_idtipoanalisis as analisisId,
            cta.cad_descripcionesp  as tipoAnalisis,
            lid_cantidad as cantidad, lid_tipo as tipoMuestra,
             ctp.cad_descripcionesp  as nombreTipoMuestra,
            lid_fechapermitida , lid_fecharestringida,
            cp.pro_categoria as categoriaid, ccp.cad_descripcionesp as categoria
            FROM $tabla
            inner join pr_listacompra pl on pl.lis_idlistacompra =lid_idlistacompra
            inner join ca_productos cp on cp.pro_id =lid_idproducto
            inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =cp.pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =lid_idtamano and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =lid_idempaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =lid_idtipoanalisis and cta.cad_idcatalogo =7
             inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =lid_tipo and ctp.cad_idcatalogo =15
            where pl.lis_idrecolector =:recolector and pl.lisfechaactualizacion>:fechareq
            and pl.lis_idindice=:indice";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getCodigosNoPer($fechaini,$fechafin,$prod,$tamanio,$empaque,$tabla){
        $econexion=self::getInstance();
            //me faltan las siglas
        $sSQL="SELECT ind_id, ind_informes_id, ind_productos_id, ind_tamanio, ind_empaque, 
ind_codigo, ind_caducidad
FROM $tabla
inner join informes
on ind_informes_id =inf_id and inf_indice=ind_indice and ind_recolector =inf_recolector
inner join visitas v on v.vi_cverecolector =inf_recolector and inf_indice=v.vi_indice 
and inf_visitasId=v.vi_idlocal 
where
ind_productos_id =:producto
and ind_tamanio =:tamanio
and ind_empaque =:empaque
and v.vi_createdat<=:fechafin and v.vi_createdat >=:fechaini";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":fechaini", $fechaini,PDO::PARAM_STR);
        $stmt->bindParam(":fechafin", $fechafin,PDO::PARAM_STR);
        $stmt->bindParam(":tamanio", $tamanio,PDO::PARAM_STR);
        $stmt->bindParam(":empaque", $empaque,PDO::PARAM_INT);
        $stmt->bindParam(":producto", $prod,PDO::PARAM_INT);
       
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function insertarUnegocio($datosModel, $tabla) {
        try {
            $econexion=self::getInstance();
            
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
           
            
            //  echo $stmt->debugDumpParams();
            if($res)
            { $sql2="select max(id) from $tabla";
               $stmt=$econexion->prepare($sql2);
              $stmt->execute();
              $res2=$stmt->fetch();
              return $res2;
            }
          else 
              throw new Exception("error al insertar tienda");
            
        } catch (Exception $ex) {
            return "error";
        }
    }
    
    
    
}