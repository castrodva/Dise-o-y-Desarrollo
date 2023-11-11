<?php

require_once "conexion.php";

class ModeloCostos{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarCostos($tabla, $datos,$Proyectos,$presupuestoT,$res){

		$stmt = Conexion::conectar()->prepare("INSERT INTO `costos`(`id`, `Costo`,`IdProyect`,`Presupuesto`,`Viabilidad`) VALUES (null,'$datos','$Proyectos','$presupuestoT','$res')");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR COSTO
	=============================================*/

	static public function mdlMostrarCostos($tabla, $item, $valor){

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
	EDITAR COSTO
	=============================================*/

	static public function mdlEditarCostos($tabla, $costo, $id,$Proyectos,$presupuestoT,$res){


        $stmt = Conexion::conectar()->prepare("UPDATE `costos` SET Costo = '$costo',IdProyect = '$Proyectos',Presupuesto = '$presupuestoT',Viabilidad = '$res' WHERE id = '$id'");


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR COSTO
	=============================================*/

	static public function mdlBorrarCostos($tabla, $datos){

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

}

