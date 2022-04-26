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
   
   public function __construct(){
        $this->datosGeo=new DatosGeocercas();
    }
    
   
    public function getTiendas($pais,$ciudad, $cadenacomercial,$unedescripcion,$planta,$fechaini,$fechafin,$cliente){
        
       
       // $rs = $this->getUnegocioxFiltros($pais,$ciudad, $cadenacomercial,$unedescripcion);
        $rs=$this->getUnegocioxFiltros2($pais, $ciudad, $planta, $fechaini, $fechafin, $cliente) ;   
            
            //return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rs as $row) {
                
                $this->result[] = $row;
            }
        
    }
    
    public function getZonas($pais,$ciudad){
        
        
        $this->zonas = $this->datosGeo->vistaGeocercaModel($ciudad, "ca_geocercas");
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        
    }
    
   
    
    public function response($pais,$ciudad, $cadenacomercial,$unedescripcion,$planta,$fechaini,$fechafin,$cliente)
    {
     
        $this->getTiendas($pais,$ciudad, $cadenacomercial,$unedescripcion,$planta,$fechaini,$fechafin,$cliente);
        $this->getZonas($pais, $ciudad);
        //busco las geocercas
        
        return json_encode(array("tiendas"=>$this->result,
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
    
    public function getUnegocioxFiltros2($pais,$ciudad, $planta,$fechaini,$fechafin,$cliente){
        if($cliente==4&&isset($fechaini)&&$fechaini!=""&&isset($fechafin)&&$fechafin!="") {
                
            $sqlcol=" ,if(une_estatus=2,'rojo',if(une_estatus=1 and  str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') <:fechafin
 and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') >=:fechaini,'amarillo','verde' )) as color ";
            }else
            $sqlcol=",'verde' as color";
        
        $sql="select une_id,une_descripcion, une_direccion, une_dir_referencia, une_cla_pais, une_cla_ciudad,
 une_estatus, une_coordenadasxy, une_puntocardinal,
une_tipotienda, une_cadenacomercial, une_estatus ".$sqlcol."
 from ca_unegocios cu 
left join visitas on vi_tiendaid=cu.une_id ";
        if(isset($fechaini)&&$fechaini!=""&&isset($fechafin)&&$fechafin!="") {
            $sql.=" and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') <:fechafin
 and str_to_date(concat('01.',vi_indice ),'%d.%m.%Y') >=:fechaini";
            }
        
        $sql.=" left join informes i on i.inf_visitasIdlocal =vi_idlocal
and vi_cverecolector=i.inf_usuario  and vi_indice=i.inf_indice ";
        // agregando filtros
        if(isset($planta)&&$planta!="") {
            $sql.=" and inf_plantasid=:planta";
            
        }
        $sql.=" left join ca_nivel5 on n5_id=inf_plantasid
where  une_cla_ciudad=:ciudad ";
//and une_cla_pais=:pais";
        
        
 
        // agregando filtros
       $sql.="  group by une_id";
             //    echo $sql;
        $stmt = Conexion::conectar()-> prepare($sql." order by une_descripcion" );
        $stmt-> bindParam(":ciudad", $ciudad, PDO::PARAM_STR);
       // $stmt-> bindParam(":pais", $pais, PDO::PARAM_INT);
        
        if(isset($fechaini)&&$fechaini!=""&&isset($fechafin)&&$fechafin!="") {
            $stmt-> bindParam(":fechafin", $fechafin, PDO::PARAM_STR);
            $stmt-> bindParam(":fechaini", $fechaini, PDO::PARAM_STR);
        }
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
       //  echo $stmt->debugDumpParams();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            echo $stmt->debugDumpParams();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
