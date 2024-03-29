<?php

class DatosPantalla {
    public function getPantalla($numpantalla,$tabla){
        
        $stmt = Conexion::conectar()-> prepare("  SELECT pa_numpantalla, pa_foto1,
 pa_seccion, pa_preguntaseccion
FROM $tabla
where pa_numpantalla=:num");
        
        $stmt->bindParam(":num", $numpantalla, PDO::PARAM_INT);
        
        $stmt-> execute();
        
        
        return $stmt->fetch();
    }
    
    
}

