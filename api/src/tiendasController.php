<?php
//require_once '../../Models/conexion.php';
//require '../../Models/crud_unegocios.php';


require "../../Models/crud_geocercas.php";
//para devolver los catalogos en json
class TiendasController{
    
//para poner los catalogos que devuelvo
    
   private $result;
   private $datosGeo;
   private $zonas;
   private $datosInf;
   
   public function __construct(){
        $this->datosGeo=new DatosGeocercas();
        
    }
    
   
    public function getTiendas($pais,$ciudad, $cadenacomercial,$tipo,$planta,$fechaini,$fechafin,$cliente){
        
       
       // $rs = $this->getUnegocioxFiltros($pais,$ciudad, $cadenacomercial,$unedescripcion);
      //calculo fecha 3 meses y el fin
      $auxfec=explode(".",$fechafin);
    
      $rs=$this->getUnegocioxFiltros2($pais, $ciudad, $planta, $fechaini, $fechafin,$fechafin, $cliente,$cadenacomercial,$tipo) ;   
            
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
           // echo "watt";
      $estpe=$estpen=$estele=3;
            foreach ($rs as $row) {
                $estpe=$estpen=$estele=3;
                //busco para cada cliente si ya se visitó
               $resp= $this->getInformexcliente($row["une_id"], $fechafin, 4);
               if($resp!=null)
                    $estpe=$resp["color"];
               $row["estpep"]=$estpe;
               $resp= $this->getInformexcliente($row["une_id"], $fechafin, 5);
               if($resp!=null)
                   $estpen=$resp["color"];
               $row["estpen"]=$estpen;
                   $resp= $this->getInformexcliente($row["une_id"], $fechafin, 6);
               if($resp!=null)
                    $estele=$resp["color"];
               $row["estele"]=$estele;
               
                $this->result[] = $row;
            }
        
    }
    //LLEGA EL ID DE LA CIUDAD de la estructura de regiones etc
    public function getZonas($pais,$ciudad){
        
        
        $this->zonas = $this->datosGeo->vistaGeocercaModelxnombre($ciudad, "ca_geocercas");
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        
    }
    
   
    
    public function response($pais,$ciudad, $cadenacomercial,$unedescripcion,$planta,$fechaini,$fechafin,$cliente)
    {
        if(isset($planta)&&$planta!="") 
             $this->getTiendas($pais,$ciudad, $cadenacomercial,$unedescripcion,$planta,$fechaini,$fechafin,$cliente);
        $this->getZonas($pais, $ciudad);
        //busco las geocercas
        
        return json_encode(array("tiendas"=>$this->result,
                                "geocercas"=>$this->zonas
        ));
    }
    
    public function responseGeo($recolector,$indice)
    {
        $this->zonas=array();
       //busco las ciudades de ese indice
        $this->datosInf=new DatosInforme();
       $result= $this->datosInf->getCiudadesAsigxRec($recolector, $indice, "pr_listacompra");
       foreach ($result as $row){
           $ciudadnombre=$row["ciudadNombre"];
    
           $this->zonas= array_merge($this->zonas,$this->datosGeo->vistaGeocercaModelxnombreRes($ciudadnombre, "ca_geocercas"));
            //busco las geocercas
       }
            return json_encode(array("tiendas"=>null,
                "geocercas"=>$this->zonas
            ));
    }
    public function getUnegocioxFiltros($pais,$ciudad, $cadenacomercial,$unedescripcion){
        
        $sql="SELECT une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad,
 une_estatus, une_coordenadasxy, une_puntocardinal,
une_tipotienda, une_cadenacomercial FROM ca_unegocios WHERE 1=1 ";
        
        // agregando filtros
        if(isset($pais)&&$pais!="") {
            $sql.=" and ca_unegocios.une_cla_pais=:pais";
            
        }
        // agregando filtros
        if(isset($unedescripcion)&&$unedescripcion!="") {
            $sql.=" and ca_unegocios.une_descripcion like :descripcion";
            
        }
        
        // agregando filtros
        if(isset($cadenacomercial)&&$cadenacomercial!="") {
            $sql.=" and ca_unegocios.une_cadenacomercial=:cadena";
            
        }
        if(isset($ciudad)){
            
            if($ciudad!="") {
                $sql.=" and ca_unegocios.une_cla_ciudad=:ciudad";
                
            }
        }
        $stmt = Conexion::conectar()-> prepare($sql." order by une_descripcion" );
        if(isset($unedescripcion)&&$unedescripcion!="") {
            $stmt-> bindValue(":descripcion", "%".$unedescripcion."%", PDO::PARAM_STR);
            
        }
        
        if(isset($ciudad)){
            
            if($ciudad!="") {
                
                $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
            }
        }
        if(isset($cadenacomercial)){
            
            if($cadenacomercial!="") {
                
                $stmt-> bindParam(":cadena", $cadenacomercial, PDO::PARAM_STR);
            }
        }
        if(isset($pais)){
            
            if($pais!="") {
                
                $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
            }
        }
        
        $stmt->execute();
        // echo $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUnegocioxFiltros2($pais,$ciudad, $planta,$fechaini,$fechafin,$tremini,$cliente, $cadenacomercial,$tipo){
        //las fechas vienen aumentadas en 1 mes
        //busco el nombre de la ciudad
       // $sql1="select "
     //   $stmt = Conexion::conectar()-> prepare($sql." order by une_descripcion" );
     //   $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
        // $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
      //  echo $pais."--".$ciudad."--".$planta."--".$fechaini."--".$fechafin."--".$tremini."--".$cliente;
        //if($cliente==4&&isset($fechafin)&&$fechafin!="") {
     /*   if(isset($fechafin)&&$fechafin!="") {
               
            $sqlcol=" ,if(une_estatus=2,'rojo',if(une_idindice is not null,'verde',if(une_estatus=1 and  str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') < DATE_ADD(:fechafin, interval 1 month)
 and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') >= DATE_ADD(:fechafin, interval -3 month),'amarillo','verde' ))) as color ";
            }else
            $sqlcol=",'verde' as color";*/
        
        $sql="select cu.une_id,une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad,
 une_estatus, une_coordenadasxy, une_puntocardinal,
str_to_date(concat('01.', vi_indice ),'%d.%m.%Y') as fec,
	
	DATE_ADD(:fechaini, interval 1 month) fini,
DATE_ADD(:fechafin, interval 1 month) ffin,
	DATE_ADD(:fechafin, interval -3 month) 3m,
une_tipotienda, une_cadenacomercial, une_estatus
 from ca_unegocios cu 
	inner join ca_ciudadesresidencia cc on cc.ciu_id =cu.une_cla_ciudad 
		inner join ca_nivel5 cn on :planta=cn.n5_id 
	inner join ca_nivel4 cn2 on cn.n5_idn4 =cn2.n4_id 
and trim(ciu_descripcionesp) =trim(cn2.n4_nombre) 
left join visitas on vi_tiendaid=cu.une_id ";
        if(isset($fechaini)&&$fechaini!=""&&isset($fechafin)&&$fechafin!="") {
            $sql.=" and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') < DATE_ADD(:fechafin, interval 1 month)
 and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') >= DATE_ADD(:fechaini, interval 1 month) ";
            }
        
        $sql.=" left join informes i on i.inf_visitasIdlocal =vi_idlocal
and vi_cverecolector=i.inf_usuario  and vi_indice=i.inf_indice ";
        // agregando filtros
        if(isset($planta)&&$planta!="") {
            $sql.=" and inf_plantasid=:planta";
            
        }
        // agregando filtros
        if(isset($tipo)&&$tipo!=0) {
            $sql.=" and vi_tipotienda=:tipo";
            
        }
        
        // agregando filtros
        if(isset($cadenacomercial)&&$cadenacomercial!=0) {
            $sql.=" and vi_cadenacomercial=:cadena";
            
        }
      //   $sql.=" left join ca_unegocioshabilitada cuh on cuh.une_id=cu.une_id and  str_to_date(concat('01.',une_idindice ),'%d.%m.%Y')=:fechafin";
     
       // $sql.=" left join ca_nivel5 on n5_id=inf_plantasid
//where  une_cla_ciudad=:ciudad ";
//and une_cla_pais=:pais";
        // agregando filtros
       $sql.=" and une_estatusgen=1 
  group by cu.une_id";
   //              echo $sql;
        $stmt = Conexion::conectar()-> prepare($sql." order by une_descripcion" );
     //   $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
       // $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
        
        if(isset($fechaini)&&$fechaini!=""&&isset($fechafin)&&$fechafin!="") {
            $stmt-> bindParam(":fechafin", $fechafin, PDO::PARAM_STR);
            $stmt-> bindParam(":fechaini", $fechaini, PDO::PARAM_STR);
            
        }
        if($cliente==4){
       //     $stmt-> bindParam(":tremini", $tremini, PDO::PARAM_STR);
        }
       /* if(isset($unedescripcion)&&$unedescripcion!="") {
            $stmt-> bindValue(":descripcion", "%".$unedescripcion."%", PDO::PARAM_STR);
            
        }*/
        
       if(isset($planta)){
            
            if($planta!="") {
                
                $stmt-> bindParam(":planta", $planta, PDO::PARAM_STR);
            }
        }
        if(isset($tipo)){
            
            if($tipo!="0") {
                
                $stmt-> bindParam(":tipo", $tipo, PDO::PARAM_STR);
            }
        }
        if(isset($cadenacomercial)){
            
            if($cadenacomercial!="0") {
                
                $stmt-> bindParam(":cadena", $cadenacomercial, PDO::PARAM_STR);
            }
        }
        /*
        if(isset($pais)){
            
            if($pais!="") {
                
                $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
            }
        }
        */
    //     $stmt-> bindParam(":indice", $indice, PDO::PARAM_STR);
        $stmt->execute();
      //  $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getInformexcliente($uneid,$fechafin,$cliente){
    
           
            $sql="select ";
            if($cliente==4)
                $sqlcolor="
if(une_estatus=2,'1',if(une_idindice is not null,'3','2')) as color ";
            if($cliente==5)
                $sqlcolor="
if(une_estatuspen=2,'1',if(une_idindice is not null,'3','2')) as color ";
            if($cliente==6)
                $sqlcolor="
if(une_estatuselec=2,'1',if(une_idindice is not null,'3','2')) as color ";
      $sql=$sql.$sqlcolor."    from
	ca_unegocios cu
inner join visitas on
	vi_tiendaid = cu.une_id
	and str_to_date(concat('01.', vi_indice ),
	'%d.%m.%Y') < DATE_ADD(:fechafin, interval 1 month)
	and str_to_date(concat('01.', vi_indice ),
	'%d.%m.%Y') >= DATE_ADD(:fechafin, interval -3 month)
inner join informes i on
	i.inf_visitasIdlocal = vi_idlocal
	and vi_cverecolector = i.inf_usuario
	and vi_indice = i.inf_indice
	left join ca_nivel5 on n5_id=inf_plantasid
left join sup_validacion on val_rec_id=i.inf_usuario and i.inf_indice=val_indice and val_inf_id=inf_id
 and val_estatus=3 and 
val_etapa=2
left join ca_unegocioshabilitada cuh on
	cuh.une_id = cu.une_id ";
      
      $sqlhab=" and une_idcliente=:cliente ";
	$sql=$sql.$sqlhab." and str_to_date(concat('01.', une_idindice ),
	'%d.%m.%Y')= :fechafin
where cu.une_id=:uneid
and n5_idn1=:cliente";
            //              echo $sql;
            $stmt = (new Conexion())->conectar()-> prepare($sql." order by vi_createdat desc limit 1" );
               $stmt-> bindParam(":uneid", $uneid, PDO::PARAM_INT);
             $stmt-> bindParam(":cliente", $cliente, PDO::PARAM_INT);
            
           
                $stmt-> bindParam(":fechafin", $fechafin, PDO::PARAM_STR);
              
                
            
          
            /* if(isset($unedescripcion)&&$unedescripcion!="") {
             $stmt-> bindValue(":descripcion", "%".$unedescripcion."%", PDO::PARAM_STR);
             
             }*/
            
           
            /* if(isset($cadenacomercial)){
            
            if($cadenacomercial!="") {
            
            $stmt-> bindParam(":cadena", $cadenacomercial, PDO::PARAM_STR);
            }
            }
            if(isset($pais)){
            
            if($pais!="") {
            
            $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
            }
            }
            */
            //     $stmt-> bindParam(":indice", $indice, PDO::PARAM_STR);
            $stmt->execute();
        // $stmt->debugDumpParams();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUnegocioxFiltrosAma($pais,$ciudad, $planta,$fechaini,$fechafin,$cliente){
            $sqlcol=" ,'amarillo' as color ";
       
            
            $sql="select une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad,
 une_estatus, une_coordenadasxy, une_puntocardinal,
une_tipotienda, une_cadenacomercial, une_estatus ".$sqlcol."
 from ca_unegocios cu
left join visitas on vi_tiendaid=cu.une_id
inner join informes i on i.inf_visitasIdlocal =vi_idlocal
and vi_cverecolector=i.inf_usuario  and vi_indice=i.inf_indice
inner join ca_nivel5 on n5_id=inf_plantasid
where  une_cla_ciudad=:ciudad and une_cla_pais=:pais";
            
            // agregando filtros
            if(isset($planta)&&$planta!="") {
                $sql.=" and inf_plantasid=:planta";
                
            }
            
            // agregando filtros
            if(isset($fechaini)&&$fechaini!=""&&isset($fechafin)&&$fechafin!="") {
                $sql.=" and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') <:fechafin
 and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') >=:fechaini";
                    
            }
            // agregando filtros
            $sql.="  group by une_id";
            //    echo $sql;
            $stmt = Conexion::conectar()-> prepare($sql." order by une_descripcion" );
            $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
            $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
            $stmt-> bindParam(":fechafin", $fechafin, PDO::PARAM_STR);
            $stmt-> bindParam(":fechaini", $fechaini, PDO::PARAM_STR);
            
            /* if(isset($unedescripcion)&&$unedescripcion!="") {
             $stmt-> bindValue(":descripcion", "%".$unedescripcion."%", PDO::PARAM_STR);
             
             }*/
            
            if(isset($planta)){
                
                if($planta!="") {
                    
                    $stmt-> bindParam(":planta", $planta, PDO::PARAM_STR);
                }
            }
            /* if(isset($cadenacomercial)){
            
            if($cadenacomercial!="") {
            
            $stmt-> bindParam(":cadena", $cadenacomercial, PDO::PARAM_STR);
            }
            }
            if(isset($pais)){
            
            if($pais!="") {
            
            $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
            }
            }
            */
            $stmt->execute();
           // echo $stmt->debugDumpParams();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function cancelarTienda($uneid, $tabla){
        try{
        
            $sql="UPDATE $tabla
    SET  une_estatusgen=2
    WHERE une_id=:uneid; ";
                        //              echo $sql;
             $stmt = (new Conexion())->conectar()-> prepare($sql );
             $stmt-> bindParam(":uneid", $uneid, PDO::PARAM_INT);
                            
             $stmt->execute();
       
        }catch(PDOException $ex){
            Utilerias::guardarError("cancelarTienda "+$ex->getMessage());
            
            throw new Exception("Hubo un error al insertar el informe");
        }
    }
    
    
    public function getResult(){
        return $this->result;
    }
}
