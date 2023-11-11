<?php

require_once "conexion.php";

class ModeloPresupuestoGerente{

	/*=============================================
	MOSTRAR Proyectos
	=============================================*/

	static public function mdlMostrarPresupuestoGererente($tabla,$item,$valor){

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

	static public function mdlEliminarPresupuesto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codigo = :codigo");

		$stmt -> bindParam(":codigo", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	EDITAR USUARIO
	=============================================*/

	 public function mdlEditarPresupuesto($tabla,$codigo,$presupuesto,$seguros,$materiales,$maquinaria,$permisos,$contingencia,$costoTotal){

	
		$stmt = Conexion::conectar()->prepare("UPDATE `presupuesto_gerente` SET `presupuesto`='$presupuesto',`seguros`='$seguros',`materiales`='$materiales',`maquinaria`='$maquinaria',`permisos`='$permisos',`contingencia`='$contingencia',`costoTotal`='$costoTotal' WHERE `codigo`='$codigo'");



		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	}


?>