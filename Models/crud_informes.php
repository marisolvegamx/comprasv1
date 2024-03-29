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
    public  function getInformesxVisita($INDICE,$CVEUSUARIO,$visita,$tabla){
        
        
        $sSQL= "SELECT inf_visitasIdlocal visitasId, inf_id id,
 inf_consecutivo consecutivo, 
  inf_comentarios comentarios, 
inf_estatus estatus,2 estatusSync,
  inf_plantasid plantasId, 
 inf_ticket_compra ticket_compra, inf_condiciones_traslado condiciones_traslado, 
inf_causa_nocompra causa_nocompra, cn.n5_nombre as plantaNombre  ,
cn2.n1_nombre clienteNombre,  n5_idn1 as clientesId
FROM $tabla
inner join ca_nivel5 cn on cn.n5_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n5_idn1 
where inf_indice=:indice and inf_usuario=:cverecolector and inf_visitasIdlocal=:visita ";
        
        $stmt=DatosInforme::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":visita",  $visita, PDO::PARAM_INT);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
      //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    public  function getInformes($INDICE,$CVEUSUARIO,$tabla){
        
        
        $sSQL= "SELECT inf_visitasIdlocal visitasId, inf_id id,
 inf_consecutivo consecutivo,   inf_comentarios comentarios,
inf_estatus estatus,2 estatusSync
 inf_plantasid plantasId,
 inf_ticket_compra ticket_compra, inf_condiciones_traslado condiciones_traslado,
inf_causa_nocompra causa_nocompra, cn.n4_nombre as plantaNombre  ,cn2.n1_nombre clienteNombre
1 estatus, 2 estatusSync
FROM informes
inner join ca_nivel4 cn on cn.n4_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n4_idn1
FROM $tabla
inner join ca_nivel4 cn on cn.n4_id =inf_plantasid
inner join ca_nivel1 cn2 on cn2.n1_id =cn.n4_idn1
where inf_indice=:indice and inf_usuario=:cverecolector ";
        
        $stmt=DatosInforme::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    
    public  function insertar($datosModel,$cveusuario,$indice,$tabla,$pdo){
        try{      
            $sSQL= "INSERT INTO $tabla
( inf_id,inf_consecutivo, inf_visitasIdlocal, 
inf_indice, inf_usuario,
 inf_comentarios, inf_estatus,  inf_plantasid,
 inf_ticket_compra, inf_condiciones_traslado,inf_causa_nocompra)
VALUES(:inf_id,:inf_consecutivo, :inf_visitasIdlocal,  
:inf_indice,:inf_recolector, 
:inf_comentarios, :inf_estatus,   :inf_plantasid,
:inf_ticket_compra, :inf_condiciones_traslado, :inf_causa_nocompra);
";
            
            $stmt=$pdo->prepare($sSQL);
            $stmt->bindParam(":inf_id", $datosModel[ContratoInformes::ID],PDO::PARAM_INT);
            $stmt->bindParam(":inf_consecutivo", $datosModel[ContratoInformes::CONSECUTIVO],PDO::PARAM_INT);
            $stmt->bindParam(":inf_visitasIdlocal", $datosModel[ContratoInformes::VISITASID], PDO::PARAM_INT);
          //  $stmt->bindParam(":inf_segunda_muestra", $datosModel[ContratoInformes::SEGUNDAMUESTRA], PDO::PARAM_INT);
          //  $stmt->bindParam(":inf_tercera_muestra", $datosModel[ContratoInformes::TERCERAMUESTRA], PDO::PARAM_INT);
           
            $stmt->bindParam(":inf_indice", $indice, PDO::PARAM_STR);
            $stmt->bindParam(":inf_recolector", $cveusuario, PDO::PARAM_STR);
            $stmt->bindParam(":inf_comentarios", $datosModel[ContratoInformes::COMENTARIOS], PDO::PARAM_STR);
            
            $stmt->bindParam(":inf_estatus", $datosModel[ContratoInformes::ESTATUS], PDO::PARAM_INT);
          //  $stmt->bindParam(":inf_created_at", $datosModel[ContratoInformes::CREA], PDO::PARAM_STR);
            //$stmt->bindParam(":inf_updated_at", $datosModel[ContratoInformes::"inf_updated_at"], PDO::PARAM_STR);
          //  $stmt->bindParam(":inf_primera_muestra", $datosModel[ContratoInformes::PRIMERAMUESTRA],PDO::PARAM_INT);
            $stmt->bindParam(":inf_plantasid", $datosModel[ContratoInformes::PLANTASID], PDO::PARAM_INT);
          
            $stmt->bindParam(":inf_ticket_compra", $datosModel[ContratoInformes::TICKETCOMPRA], PDO::PARAM_INT);
            $stmt->bindParam(":inf_condiciones_traslado", $datosModel[ContratoInformes::CONDICIONESTRASLADO], PDO::PARAM_INT);
            $stmt->bindParam(":inf_causa_nocompra", $datosModel[ContratoInformes::CAUSANOCOMPRA], PDO::PARAM_STR);
            
            if(!$stmt-> execute())
            {
                
                throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
            }
       //     echo $stmt->debugDumpParams();
        }catch(PDOException $ex){
            Utilerias::guardarError("DatosInforme.inesertar "+$ex->getMessage());
            
            throw new Exception("Hubo un error al insertar el informe");
        }
        
    }
    public function updateInforme($datosModel,$cveusuario,$indice,$tabla,$pdo){
        $sSQL= "UPDATE $tabla
SET inf_visitasIdlocal=:inf_visitasIdlocal, inf_consecutivo=:inf_consecutivo, 

inf_comentarios=:inf_comentarios, 
inf_estatus=:inf_estatus,
inf_plantasid=:inf_plantasid,  inf_ticket_compra=:inf_ticket_compra,
inf_condiciones_traslado=:inf_condiciones_traslado, inf_causa_nocompra=:inf_causa_nocompra
WHERE inf_id=:inf_id and inf_indice=:inf_indice and inf_recolector=:inf_recolector ;
";
        try{
        $stmt=$pdo->prepare($sSQL);
        $stmt->bindParam(":inf_id", $datosModel[ContratoInformes::ID],PDO::PARAM_INT);
        $stmt->bindParam(":inf_consecutivo", $datosModel[ContratoInformes::CONSECUTIVO],PDO::PARAM_INT);
        $stmt->bindParam(":inf_visitasIdlocal", $datosModel[ContratoInformes::VISITASID], PDO::PARAM_INT);
      //  $stmt->bindParam(":inf_segunda_muestra", $datosModel[ContratoInformes::SEGUNDAMUESTRA], PDO::PARAM_INT);
       // $stmt->bindParam(":inf_tercera_muestra", $datosModel[ContratoInformes::TERCERAMUESTRA], PDO::PARAM_INT);
        
        $stmt->bindParam(":inf_indice", $indice, PDO::PARAM_STR);
        $stmt->bindParam(":inf_recolector", $cveusuario, PDO::PARAM_STR);
        $stmt->bindParam(":inf_comentarios", $datosModel[ContratoInformes::COMENTARIOS], PDO::PARAM_STR);
        
        $stmt->bindParam(":inf_estatus", $datosModel[ContratoInformes::ESTATUS], PDO::PARAM_INT);
        //  $stmt->bindParam(":inf_created_at", $datosModel[ContratoInformes::CREA], PDO::PARAM_STR);
        //$stmt->bindParam(":inf_updated_at", $datosModel[ContratoInformes::"inf_updated_at"], PDO::PARAM_STR);
       // $stmt->bindParam(":inf_primera_muestra", $datosModel[ContratoInformes::PRIMERAMUESTRA],PDO::PARAM_INT);
        $stmt->bindParam(":inf_plantasid", $datosModel[ContratoInformes::PLANTASID], PDO::PARAM_INT);
        
        $stmt->bindParam(":inf_ticket_compra", $datosModel[ContratoInformes::TICKETCOMPRA], PDO::PARAM_INT);
        $stmt->bindParam(":inf_condiciones_traslado", $datosModel[ContratoInformes::CONDICIONESTRASLADO], PDO::PARAM_INT);
        $stmt->bindParam(":inf_causa_nocompra", $datosModel[ContratoInformes::CAUSANOCOMPRA], PDO::PARAM_STR);
        
        if(!$stmt-> execute())
        {
            
            throw new Exception($stmt->errorCode()."-".$stmt->errorInfo()[2]);
        }
        //     echo $stmt->debugDumpParams();
    }catch(PDOException $ex){
        Utilerias::guardarError("DatosInforme.actualizar "+$ex->getMessage());
        
        throw new Exception("Hubo un error al actualizar el informe");
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
    public function getCausas($tabla){
        $econexion=self::getInstance();
        $stmt = $econexion-> prepare("SELECT 100 as cad_idcatalogo, 'CAUSAS' as cad_nombreCatalogo,
ID_causa as cad_idopcion, cau_descripcion as cad_descripcionesp, cau_estatus as cad_otro
FROM $tabla;");
        
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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
            where lis_fechaactualizacion >:fechareq
            and lis_idrecolector =:recolector
            and lis_idindice=:indice";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
       // echo $stmt->debugDumpParams();
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
        $sSQL="
SELECT lid_idlistacompra as listaId, lid_idprodcompra as id , 
            lid_idproducto as productosId, 
            cp.pro_producto as productoNombre,
            cc.cad_descripcionesp as tamanio,
            lid_idtamano as tamanioId,
            lid_idempaque as empaquesId,
            cem.cad_descripcionesp  as empaque,
            lid_idtipoanalisis as analisisId,
            cta.cad_descripcionesp  as tipoAnalisis,
            lid_cantidad as cantidad, lid_tipo as tipoMuestra,
             ctp.cad_descripcionesp  as nombreTipoMuestra,
            lid_fechapermitida , lid_fecharestringida,
            cp.pro_categoria as categoriaid, ccp.cad_descripcionesp as categoria,
            pl.lis_idplanta as planta, pro_orden as lid_orden,lid_backup,
            lis_idcliente,
            cc.cad_otro as ordtam,
            cem.cad_otro as ordemp,
            cta.cad_otro as ordtipa,
            ctp.cad_otro as ordtipm ,lid_numtienbak 
            FROM $tabla
            inner join pr_listacompra pl on pl.lis_idlistacompra =lid_idlistacompra
            inner join ca_productos cp on cp.pro_id =lid_idproducto 
            inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =cp.pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =lid_idtamano and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =lid_idempaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =lid_idtipoanalisis and cta.cad_idcatalogo =7
             inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =lid_tipo and ctp.cad_idcatalogo =15
            where pl.lis_idrecolector =:recolector and pl.lis_fechacreacion>:fechareq
            and pl.lis_idindice=:indice;";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
     //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getActLisComprDetxRecol($idrecolector,$fecha,$indice,$tabla){
        $econexion=self::getInstance();
        //me faltan las siglas
        $sSQL="SELECT lid_idlistacompra as listaId, lid_idprodcompra as id,
            lid_idproducto as productosId,
            cp.pro_producto as productoNombre,
            cc.cad_descripcionesp as tamanio,
            lid_idtamano as tamanioId,
             lid_idempaque as empaquesId,
            cem.cad_descripcionesp  as empaque,
            lid_idtipoanalisis as analisisId,
            cta.cad_descripcionesp  as tipoAnalisis,
            lid_cantidad as cantidad, lid_tipo as tipoMuestra,
             ctp.cad_descripcionesp  as nombreTipoMuestra,
            lid_fechapermitida , lid_fecharestringida,
            cp.pro_categoria as categoriaid, ccp.cad_descripcionesp as categoria,
  pl.lis_idplanta as planta, lid_orden,lid_backup,lis_idcliente,
 cc.cad_otro as ordtam,
            cem.cad_otro as ordemp,
            cta.cad_otro as ordtipa,
            ctp.cad_otro as ordtipm ,lid_numtienbak 
            FROM $tabla
            inner join pr_listacompra pl on pl.lis_idlistacompra =lid_idlistacompra
            inner join ca_productos cp on cp.pro_id =lid_idproducto
            inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =cp.pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =lid_idtamano and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =lid_idempaque and cem.cad_idcatalogo =12
             inner join ca_catalogosdetalle cta on cta.cad_idopcion =lid_idtipoanalisis and cta.cad_idcatalogo =7
             inner join ca_catalogosdetalle ctp on ctp.cad_idopcion =lid_tipo and ctp.cad_idcatalogo =15
            where pl.lis_idrecolector =:recolector and pl.lis_fechaactualizacion>:fechareq
            and pl.lis_idindice=:indice";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
        $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
      //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getCodigosNoPer($fechaini,$fechafin,$prod,$tamanio,$empaque,$ana,$planta,$tabla){
        $econexion=self::getInstance();
            //me faltan las siglas
        $sSQL="SELECT ind_id, ind_informes_id, ind_productos_id, ind_tamanio_id, ind_empaque, 
	DATE_FORMAT(ind_caducidad,'%d-%m-%y')  as fec_caducidad, inf_plantasid

FROM $tabla
inner join informes on
	ind_informes_id = inf_id
	and inf_indice = ind_indice
	and ind_recolector = inf_usuario
inner join visitas v on
	v.vi_cverecolector = inf_usuario
	and inf_indice = v.vi_indice
	and inf_visitasIdlocal = v.vi_idlocal
where
ind_productos_id =:producto
and ind_tamanio_id =:tamanio
and ind_empaque =:empaque and ind_tipoanalisis=:tipoanalisis and inf_plantasid=:planta 
and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') <:fechafin
 and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') >=:fechaini
and (ind_estatus <> 2 and ind_estatus<>4)
/*and v.vi_createdat<:fechafin and v.vi_createdat >=:fechaini*/ group by ind_caducidad
order by ind_caducidad desc";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":fechaini", $fechaini,PDO::PARAM_STR);
        $stmt->bindParam(":fechafin", $fechafin,PDO::PARAM_STR);
        $stmt->bindParam(":tamanio", $tamanio,PDO::PARAM_STR);
        $stmt->bindParam(":empaque", $empaque,PDO::PARAM_INT);
        $stmt->bindParam(":producto", $prod,PDO::PARAM_INT);
        $stmt->bindParam(":tipoanalisis", $ana,PDO::PARAM_INT);
        $stmt->bindParam(":planta", $planta,PDO::PARAM_INT);
        
       
        $stmt-> execute();
//$stmt->debugDumpParams();
      //  echo "<br>--".$fechaini."--".$fechafin."--".$prod."--".$tamanio."--".$empaque."--".$ana."--".$planta;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function insertarUnegocio($datosModel, $tabla,$pdo) {
        try {
           //busco el nombre de la ciudad en ciudades de residencia
            $res=$this->vistaN4opcionModel($datosModel["ciudaduneg"],"ca_nivel4");
         //var_dump($res);
       //  die();
            $pais=$res["ciu_paisid"];
           $ciudad=$res["ciu_id"];
            
            $stmt = null;
            //procedimiento de insercion de  la cuenta
            $sSQL = "INSERT INTO ca_unegocios(une_descripcion, une_direccion,
 une_dir_referencia, une_cla_pais, une_cla_ciudad, une_estatus, une_coordenadasxy,
 une_puntocardinal, une_tipotienda, une_cadenacomercial,
une_fotofachada, une_facrecolector, une_facindice) 
VALUES (:nomuneg, :dirtien, :refer, :paisuneg, :ciudaduneg, :estatusuneg, :cxy,
 :puncaruneg,:tipouneg,:cadcomuneg,
:une_fotofachada, :une_facrecolector, :une_facindice)";
            $stmt = $pdo->prepare($sSQL);
            
            $stmt->bindParam(":nomuneg", $datosModel["nomuneg"], PDO::PARAM_STR);
            $stmt->bindParam(":dirtien", $datosModel["dirtien"], PDO::PARAM_STR);
            $stmt->bindParam(":refer", $datosModel["refer"], PDO::PARAM_STR);
            $stmt->bindParam(":paisuneg", $pais, PDO::PARAM_INT);
            $stmt->bindParam(":ciudaduneg", $ciudad, PDO::PARAM_INT);
            $stmt->bindParam(":cxy", $datosModel["cxy"], PDO::PARAM_STR);
            $stmt->bindParam(":puncaruneg", $datosModel["puncaruneg"], PDO::PARAM_INT);
            $stmt->bindParam(":cadcomuneg", $datosModel["cadcomuneg"], PDO::PARAM_INT);
            $stmt->bindParam(":estatusuneg", $datosModel["estatusuneg"], PDO::PARAM_INT);
            $stmt->bindParam(":tipouneg", $datosModel["tipouneg"], PDO::PARAM_INT);
            $stmt->bindParam(":une_fotofachada", $datosModel["une_fotofachada"], PDO::PARAM_INT);
            $stmt->bindParam(":une_facrecolector", $datosModel["une_facrecolector"], PDO::PARAM_INT);
            $stmt->bindParam(":une_facindice", $datosModel["une_facindice"], PDO::PARAM_STR);
            
            $res = $stmt->execute();
           
            
            //  echo $stmt->debugDumpParams();
            if($res)
            { $sql2="select max(une_id) from $tabla";
              $stmt=$pdo->prepare($sql2);
              $stmt->execute();
              $res2=$stmt->fetch();
            //  var_dump($res2);
            //  echo "<br>tienda nva";
              return $res2[0];
            }
          else 
              throw new Exception("error al insertar tienda");
            
        } catch (Exception $ex) {
            return "error";
        }
    }
    
    public function actualizarUnegocioEstatus($idtienda,$estatus, $tabla) {
        
        try {
            
            //procedimiento de insercion de  la cuenta
            
            $sSQL = "UPDATE ca_unegocios
 SET  une_estatus=:estatus WHERE une_id=:idt";
            
            $stmt = Conexion::conectar()->prepare($sSQL);
            
            $stmt->bindParam(":estatus", $estatus);
            $stmt->bindParam(":idt", $idtienda);
            $stmt->execute();
            
            return "success";
        } catch (Exception $ex) {
            
            return "error";
        }
    }
    
    public function actUnegEstatusEle($idtienda,$estatus, $tabla) {
        
        try {
            
            //procedimiento de insercion de  la cuenta
            
            $sSQL = "UPDATE ca_unegocios
 SET  une_estatuselec=:estatus WHERE une_id=:idt";
            
            $stmt = Conexion::conectar()->prepare($sSQL);
            
            $stmt->bindParam(":estatus", $estatus);
            $stmt->bindParam(":idt", $idtienda);
            $stmt->execute();
            
            return "success";
        } catch (Exception $ex) {
            
            return "error";
        }
    }
    public function actUnegEstatusPen($idtienda,$estatus, $tabla) {
        
        try {
            
            //procedimiento de insercion de  la cuenta
            
            $sSQL = "UPDATE ca_unegocios
 SET  une_estatuspen=:estatus WHERE une_id=:idt";
            
            $stmt = Conexion::conectar()->prepare($sSQL);
            
            $stmt->bindParam(":estatus", $estatus);
            $stmt->bindParam(":idt", $idtienda);
            $stmt->execute();
            
            return "success";
        } catch (Exception $ex) {
            
            return "error";
        }
    }
    
    
    
    public function getUltVisita($recolector, $indice,$tabla){
        $econexion=self::getInstance();
        $stmt = $econexion-> prepare("select max(vi_idlocal ) as maxid from $tabla 
        where vi_indice =:indice and vi_cverecolector =:recolector;");
        $stmt->bindParam(":recolector", $recolector,PDO::PARAM_INT);
       
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        $res= $stmt->fetch();
      //  var_dump($res);
        $ultimo=0;
        if($res)
        {$id=$res["maxid"];
        if($id==0||$id==null)
            $ultimo=0;
        else $ultimo=$id;
        }
        return $ultimo;
        
    }
    
    
    
    public function getUltInforme($recolector, $indice,$tabla,$planta){
        $econexion=self::getInstance();
        $stmt = $econexion-> prepare("select max(inf_id) as maxid, inf_consecutivo from $tabla
where inf_indice =:indice and inf_usuario =:recolector ;");
        $stmt->bindParam(":recolector", $recolector,PDO::PARAM_INT);
        
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        $res= $stmt->fetch();
       // $stmt->debugDumpParams();
        //var_dump($res);
        $ultimo=0;
        $cons=0;
        if($res)
        {$id=$res["maxid"];
        if($id==0||$id==null)
            $ultimo=0;
            else{ $ultimo=$id;
            //busco el consecutivo
            $stmt2 = $econexion-> prepare("select max(inf_consecutivo) as consec from $tabla
where inf_plantasid=:plantaid and inf_indice =:indice and inf_usuario =:recolector;");
         
            $stmt2->bindParam(":recolector", $recolector,PDO::PARAM_INT);
            $stmt2->bindParam(":plantaid", $planta,PDO::PARAM_INT);
            $stmt2->bindParam(":indice", $indice,PDO::PARAM_STR);
            $stmt2-> execute();
            $res2= $stmt2->fetch();
          
           
            if($res2)
            {$id=$res2["consec"];
            if($id==0||$id==null)
                $cons=0;
                else $cons=$id;
            }
            }
            
        }
        //busco el consecutivo $stmt = $econexion-> prepare("select max(inf_id) as maxid, inf_consecutivo from $tabla
       
        return $ultimo.",".$cons;
        
    }

      public function getUltConsecutivo($recolector, $indice,$tabla,$planta){
        $econexion=self::getInstance();
       
            //busco el consecutivo
            $stmt2 = $econexion-> prepare("select max(inf_consecutivo) as consec from $tabla
where inf_plantasid:plantaid and inf_indice =:indice and inf_usuario =:recolector;");
            $stmt2->bindParam(":plantaid", $planta,PDO::PARAM_INT);
            $stmt2->bindParam(":recolector", $recolector,PDO::PARAM_INT);
            
            $stmt2->bindParam(":indice", $indice,PDO::PARAM_STR);
            $stmt2-> execute();
            $res2= $stmt2->fetch();
          
           
            if($res2)
            {$id=$res2["consec"];
            if($id==0||$id==null)
                $cons=0;
                else $cons=$id;
            }
            
            
        
        //busco el consecutivo $stmt = $econexion-> prepare("select max(inf_id) as maxid, inf_consecutivo from $tabla
       
        return $cons;
        
    }
    
    public  function getSustitucion($tabla){
        $econexion=self::getInstance();
        $stmt =   $econexion-> prepare("Select   su_tipoempaque,
id_sustitucion,
su_producto,
su_tamaño as su_tamanio,
pro_cliente as clientesId,
pro_producto as nomproducto,
            cc.cad_descripcionesp as nomtamanio,
             cem.cad_descripcionesp  as nomempaque,
             pro_categoria as categoriasId, ccp.cad_descripcionesp as nomcategoria
from $tabla 
inner join ca_productos
on su_producto =pro_id
inner join ca_catalogosdetalle ccp on ccp.cad_idopcion =pro_categoria and ccp.cad_idcatalogo =5
            inner join ca_catalogosdetalle cc on cc.cad_idopcion =su_tamaño and cc.cad_idcatalogo =13
            inner join ca_catalogosdetalle cem on cem.cad_idopcion =su_tipoempaque and cem.cad_idcatalogo =12

");
        
        $stmt-> execute();
        //    echo $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public function getUltImagenDet($recolector, $indice,$tabla){
        $econexion=self::getInstance();
        $stmt = $econexion-> prepare("select max(imd_idlocal) as maxid from $tabla id 
where imd_indice =:indice and imd_usuario =:recolector ;");
        $stmt->bindParam(":recolector", $recolector,PDO::PARAM_INT);
        
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        $res= $stmt->fetch();
        $ultimo=0;
        if($res)
        {$id=$res["maxid"];
        if($id==0||$id==null)
            $ultimo=0;
            else $ultimo=$id;
        }
        return $ultimo;
        
    }
    
    public function getPlantaPen($siglas,$cliente){
        $econexion=self::getInstance();
        $stmt = $econexion-> prepare("select n5_nombre cad_descripcionesp,
n5_id cad_idopcion,
 n5_idn1 cad_idcatalogo
from ca_nivel6 inner join 
ca_nivel5 on n6_idn5=n5_id
where n6_idn1=:cliente
and n6_nombre=:siglas");
        $stmt->bindParam(":cliente", $cliente,PDO::PARAM_INT);
        
        $stmt->bindParam(":siglas", $siglas,PDO::PARAM_STR);
        $stmt-> execute();
    // $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        //  var_dump($res);
       
       
        
    }
    public function vistaN4opcionModel($idn4, $tabla){
        
        $stmt = Conexion::conectar()-> prepare("SELECT n4_idn3, n4_id, n4_nombre, n4_idn1, n4_idn2,
ciu_id,ciu_descripcionesp,ciu_descripcioning,ciu_paisid
FROM ca_nivel4
inner join ca_ciudadesresidencia on trim(n4_nombre) =trim(ciu_descripcionesp)
 WHERE  n4_id =:idn4");
        
        
        
        $stmt-> bindParam(":idn4", $idn4, PDO::PARAM_INT);
        
        
        
        $stmt-> execute();
        
    //    $stmt->debugDumpParams();
        
        return $stmt->fetch();
        
    }
    
    public function listaCatalogo($idcatalogo, $tabla){
        $stmt = Conexion::conectar()-> prepare("SELECT ca_idcatalogo as cad_idcatalogo,
ca_nombrecatalogo as cad_nombreCatalogo,
  `cad_idopcion`,
  `cad_descripcionesp`,
  `cad_descripcioning`,
  `cad_otro`
FROM $tabla inner join ca_catalogos on ca_catalogos.ca_idcatalogo=cad_idcatalogo
where ca_catalogosdetalle.cad_idcatalogo=:id");
        
        $stmt->bindParam(":id", $idcatalogo, PDO::PARAM_INT);
        
        $stmt-> execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
    }
    
    public  function getInformexid($INDICE,$CVEUSUARIO,$id,$tabla){
        
        
        $sSQL= "SELECT inf_visitasIdlocal visitasId, inf_id id,
 inf_consecutivo consecutivo, 
  inf_comentarios comentarios,
inf_estatus estatus,
inf_plantasid plantasId,
 inf_ticket_compra ticket_compra, inf_condiciones_traslado condiciones_traslado,
inf_causa_nocompra causa_nocompra
FROM $tabla
where inf_indice=:indice and inf_usuario=:cverecolector and inf_id=:id ";
        
        $stmt=DatosInforme::getInstance()->prepare($sSQL);
        $stmt->bindParam(":indice", $INDICE, PDO::PARAM_STR);
        $stmt->bindParam(":id",  $id, PDO::PARAM_INT);
        
        $stmt->bindParam(":cverecolector",  $CVEUSUARIO, PDO::PARAM_INT);
        
        $stmt-> execute();
        //  $stmt->debugDumpParams();
        return $stmt->fetch(PDO::FETCH_ASSOC); //para que solo devuelva los nombres de columnas
        
        
    }
    
    public function getCiudadesAsigxRec($idrecolector,$indice,$tabla){
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
            where 
             lis_idrecolector =:recolector
             and lis_idindice=:indice group by cn2.n4_nombre ";
        $stmt = $econexion-> prepare($sSQL);
        $stmt->bindParam(":recolector", $idrecolector,PDO::PARAM_INT);
     //   $stmt->bindParam(":fechareq", $fecha,PDO::PARAM_STR);
        $stmt->bindParam(":indice", $indice,PDO::PARAM_STR);
        $stmt-> execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

     public function eliminauneghab($datosModel,$tabla){
            try{      
              
              $sSQL= "DELETE FROM $tabla WHERE une_id=:idt and une_idindice=:indice";
              $stmt=Conexion::conectar()->prepare($sSQL);
              
              $stmt->bindParam(":idt", $datosModel["idt"],PDO::PARAM_INT);
              $stmt->bindParam(":indice", $datosModel["indice"], PDO::PARAM_STR);

              $stmt-> execute();
           //   $stmt->debugDumpParams();
            }catch(PDOException $ex){
              throw new Exception("Hubo un error al eliminar");
            }
            
    }
    
    public function vistaSupInformeDetalleModel($datosModel, $tabla){
        
        $stmt = Conexion::conectar()-> prepare("SELECT informes.inf_id, informes.inf_plantasid,
 informes.inf_indice, informes.inf_usuario, ca_recolectores.rec_nombre,
 informes.inf_plantasid, n5_nombre, n5_idn1, n1_nombre, informes.inf_consecutivo,inf_comentarios, inf_ticket_compra,
inf_visitasIdlocal
FROM informes inner join ca_recolectores on inf_usuario=rec_id
inner join ca_nivel5 on n5_id=inf_plantasid
 inner join ca_nivel1 on n1_id=n5_idn1
inner join visitas v on v.vi_idlocal =inf_visitasIdlocal and v.vi_indice =inf_indice
 and v.vi_cverecolector =inf_usuario 
where inf_id=:idinf and n5_idn1=:cli and
 inf_indice=:idmes and inf_usuario=:idrec;");
        
        $stmt->bindParam(":idinf", $datosModel["idinf"], PDO::PARAM_INT);
        $stmt->bindParam(":idmes", $datosModel["idmes"], PDO::PARAM_STR);
        $stmt->bindParam(":idrec", $datosModel["idrec"], PDO::PARAM_INT);
        $stmt->bindParam(":cli", $datosModel["cli"], PDO::PARAM_INT);
        $stmt-> execute();
       // $stmt->debugDumpParams();
        return $stmt->fetchall();
        
    }
    
    
}