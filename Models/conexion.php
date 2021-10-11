<?php


class Conexion {

  	public function conectar(){

		
	//	$link = new PDO("mysql:host=localhost;dbname=muesmerc_inspeccionpostmix;charset=UTF8", "muesmerc_adminpost", "AdminPostmix18:)");

	//	$link = new PDO("mysql:host=localhost;dbname=comprasdata", "root", "");
	//	return $link;


try {
        $link = new PDO("mysql:host=localhost;dbname=muesmerc_comprasdata;charset=UTF8", "muesmerc_admincom", "adMues21%%_");
        return $link;
        print "Conexión exitosa!";
        }
        catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage();
        
        throw new MyDBException($Exception->getMessage()); echo "¡Error!: ";
        //die();
        }



	}

    public static function ejecutarQuery($sql, $listParam) {
 try {

            $stmt = Conexion::conectar()->prepare($sql);

            foreach ($listParam as $key => $param) {
   if ($param == null)
                    $stmt->bindValue(":" . $key, NULL, PDO::PARAM_NULL);
                else
                    $stmt->bindValue(":" . $key, $param, PDO::PARAM_STR);
            }

            $stmt->execute();

            // $stmt->debugDumpParams();



            $respuesta = $stmt->fetchAll();

            if ($stmt->errorInfo()[1] != null) {

                //var_dump($stmt->errorInfo());

                throw new Exception("Error al ejecutar consulta en la bd");
            }

            return $respuesta;
        } catch (PDOException $e) {

            throw new Exception("Error al ejecutar consulta en la bd");
        }
    }

    public function ejecutarInsert($sql, $listParam) {



        try {



            $stmt = Conexion::conectar()->prepare($sql);

            foreach ($listParam as $key => $param) {
     if ($param == null)
                    $stmt->bindValue(":" . $key, NULL, PDO::PARAM_NULL);
                else
                    $stmt->bindValue(":" . $key, $param, PDO::PARAM_STR);
            }

            if (!$stmt->execute()) {

                //echo var_dump($stmt->errorInfo());
                //  $stmt->debugDumpParams();

                throw new Exception("Error al insertar/actualizar");
            }
        } catch (PDOException $e) {



            throw new Exception("Error al ejecutar insert en la bd " . $e);
        }
    }

    public function ejecutarQuerysp($sql) {

        try {

            $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute();
 $respuesta = $stmt->fetchAll();

            //   $stmt->debugDumpParams();

            if ($stmt->errorInfo()[1] != null) {



                throw new Exception("Error al ejecutar consulta en la bd" . $stmt->errorInfo()[2]);
            }

            return $respuesta;
        } catch (Exception $e) {
            error_log("Error en ejecutarQuerysp ".$e->getMessage());
            echo $e->getMessage();
            throw new Exception("Hubo un error al ejecutar la consulta");
        }
    }

}




?>