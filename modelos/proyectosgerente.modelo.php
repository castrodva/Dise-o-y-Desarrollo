<?php

require_once "conexion.php";

class ModeloProyectosGerente{

	/*=============================================
	MOSTRAR Proyectos
	=============================================*/

	static public function mdlMostrarProyectosGererente($tabla,$item){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarProyectosGerente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria=:id_categoria, id_cliente=:id_cliente, presupuesto=:presupuesto, plazo=:plazo, id_hito=:id_hito, horas=:horas, numero=:numero, ubicacion=:ubicacion, cedula=:cedula, empleado=:empleado, tareas=:tareas WHERE id = :id");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
		$stmt->bindParam(":presupuesto", $datos["presupuesto"], PDO::PARAM_INT);
		$stmt->bindParam(":plazo", $datos["plazo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_hito", $datos["id_hito"], PDO::PARAM_INT);
		$stmt->bindParam(":tareas", $datos["tareas"], PDO::PARAM_INT);
		$stmt->bindParam(":empleado", $datos["empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":horas", $datos["horas"], PDO::PARAM_INT);
		$stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_INT);
		$stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
}
?>