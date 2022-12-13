<?php
class DatosPermisos
{
    public static function vistaPermisosMenu($gpo) {
        $sqq= "SELECT cnfg_permisos.cpe_grupo,
				  cnfg_permisos.cpe_claveopcion,
				  cnfg_permisos.cpe_insertar,
				  cnfg_menu.men_nombreopcion,
				  cnfg_permisos.cpe_modificar,
				  cnfg_permisos.cpe_borrar
			 FROM cnfg_permisos
	   Inner Join cnfg_menu
	           ON cnfg_permisos.cpe_claveopcion = cnfg_menu.men_claveopcion
			WHERE cpe_grupo=:op2";
        $stmt = Conexion::conectar()->prepare($sqq);
        $stmt->bindParam(":op2", $gpo,PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public static function vistaPermisosMenuxId($gpo,$opcion) {
        $query_rev="SELECT
cnfg_permisos.cpe_grupo,
cnfg_permisos.cpe_claveopcion,
cnfg_menu.men_claveopcion,
cnfg_menu.men_nombreopcion,
cnfg_menu.men_imagenopcion,
cnfg_menu.men_nivelopcion,
cnfg_menu.men_claseopcion,
cnfg_menu.men_nivel,
cnfg_menu.men_superopcion
FROM
cnfg_permisos
Inner Join cnfg_menu ON cnfg_permisos.cpe_claveopcion = cnfg_menu.men_claveopcion
WHERE
cnfg_permisos.cpe_grupo =  :ncli AND
    
cnfg_permisos.cpe_claveopcion=:opcion";
        $stmt = Conexion::conectar()->prepare($query_rev);
        $stmt->bindParam(":ncli", $gpo,PDO::PARAM_STR);
        $stmt->bindParam(":opcion", $opcion,PDO::PARAM_STR);
        
        $stmt->execute();
      
        
        
        return $stmt->fetchAll();
    }
  
    
    public static function vistaPermisos( $tabla) {
        $sqq= "SELECT
  `cpe_grupo`,
  `cpe_claveopcion`,
  `cpe_insertar`,
  `cpe_modificar`,
  `cpe_borrar`
FROM ".$tabla;
        $stmt = Conexion::conectar()->prepare($sqq);
        
        $stmt->execute();
        
        
        
        return $stmt->fetchAll();
    }
    public static function eliminarPermisos($grupo,$opcion,$tabla) {
        $sqq= "DELETE
FROM ".$tabla."
WHERE `cpe_grupo` = :grupo
    AND `cpe_claveopcion` = :claveopcion";
        $stmt = Conexion::conectar()->prepare($sqq);
        try{
            $stmt->bindParam(":grupo", $grupo);
            $stmt->bindParam(":claveopcion", $opcion);
          
       $stmt->execute();
           //throw new Exception("Error al eliminar permiso");
        }catch(PDOException $es){
            throw new Exception("Error al eliminar permiso");
        }
    }
    
     public static function insertarPermisos( $grupo,$opcion,$borrar,$modificar,$insertar,$tabla) {
        $sqq= "INSERT INTO ".$tabla."
            (`cpe_grupo`,
             `cpe_claveopcion`,
             `cpe_insertar`,
             `cpe_modificar`,
             `cpe_borrar`)
VALUES (:grupo,
        :claveopcion,
        :insertar,
        :modificar,
        :borrar);";
        $stmt = Conexion::conectar()->prepare($sqq);
        try{
            $stmt->bindParam(":grupo", $grupo);
            $stmt->bindParam(":claveopcion", $opcion);
            $stmt->bindParam(":borrar", $borrar);
            $stmt->bindParam(":modificar", $modificar);
            $stmt->bindParam(":insertar", $insertar);
          if(!$stmt->execute())
              throw new Exception("Error al insertar permiso");
          //  $stmt->debugDumpParams();
        }catch(PDOException $es){
            throw new Exception("Error al insertar permiso");
        }
    }
    
    public static function getMenuxNivel( $nivel,$tabla) {
        $sqq= "SELECT * FROM ".$tabla." where men_nivel= ".$nivel;
        $stmt = Conexion::conectar()->prepare($sqq);
        
        $stmt->execute();
        
        
        
        return $stmt->fetchAll();
    }
    
    public static function getMenuxSuperopcion( $menu,$tabla) {
        $query2 = "SELECT
cnfg_menu.men_claveopcion,
cnfg_menu.men_nombreopcion,
cnfg_menu.men_imagenopcion,
cnfg_menu.men_nivelopcion,
cnfg_menu.men_claseopcion,
cnfg_menu.men_nivel,
cnfg_menu.men_superopcion
FROM
".$tabla."
where men_superopcion='".$menu."'";
        $stmt = Conexion::conectar()->prepare($query2);
        
        $stmt->execute();
        
        
       // $stmt->debugDumpParams();
      
        return $stmt->fetchAll();
    }
    
     public static function getPermisosxGrupoOp( $grupo,$op,$tabla) {
         $sql_ver="SELECT cnfg_permisos.cpe_grupo, cnfg_permisos.cpe_claveopcion FROM ".$tabla."
                            where cnfg_permisos.cpe_grupo=:grupo and cnfg_permisos.cpe_claveopcion=:op";
         
         $stmt = Conexion::conectar()->prepare($sql_ver);
        $stmt->bindParam(":grupo", $grupo);
        $stmt->bindParam(":op", $op);
        $stmt->execute();
        
        
        
        return $stmt->fetchAll();
    }
    
    public function getPermisosxgrupo($grupo){
    	$sql="select * from cnfg_menu
        inner join cnfg_permisos on cnfg_menu.men_claveopcion=cnfg_permisos.cpe_claveopcion
where cnfg_permisos.cpe_grupo=:grupous and men_nivel=1";
    	if($grupo=="muh"||$grupo=="mui")
    		$sql.=" order by men_orden";
    	else 
    		$sql.=" order by cnfg_menu.men_claveopcion;";
    	
    	
    	$con=Conexion::conectar();
    	$stmt=$con->prepare($sql);
    	$stmt->bindParam("grupous", $grupo, PDO::PARAM_STR);
    	$stmt->execute();
    //	$stmt->debugDumpParams();
    	$res=$stmt->fetchAll();
    	$con=null;
    	return $res;
    	
    }
    
    public function getSubmenusxgrupo($grupo,$superopcion){
    	$sql_com = "SELECT
*
FROM
cnfg_permisos
Inner Join cnfg_menu ON cnfg_permisos.cpe_claveopcion = cnfg_menu.men_claveopcion
where
cnfg_permisos.cpe_grupo=:grupous and cnfg_menu.men_superopcion=:superopcion
";
    	
    	if($grupo=="muh"||$grupo=="mui")
    		$sql_com.=" order by men_orden";
    		else
    			$sql_com.=" order by men_orden asc;";
    	
    	$con=Conexion::conectar();
    	$stmt=$con->prepare($sql_com);
    	$stmt->bindParam("grupous", $grupo, PDO::PARAM_STR);
    	$stmt->bindParam("superopcion", $superopcion, PDO::PARAM_STR);
    	$stmt->execute();
    //	$stmt->debugDumpParams();
    	$res=$stmt->fetchAll();
    	$con=null;
    	return $res;
    	
    }
    
     public function getSubmenusxop($superopcion){
     	$sql2 = "SELECT * FROM cnfg_menu where men_superopcion=:op;";
     	
    	
    	
    	
    	$con=Conexion::conectar();
    	$stmt=$con->prepare($sql2);
    	
    	$stmt->bindParam("op", $superopcion, PDO::PARAM_STR);
    	$stmt->execute();
    	$res=$stmt->fetchAll();
    	$con=null;
    	return $res;
    	
    }
    
}


