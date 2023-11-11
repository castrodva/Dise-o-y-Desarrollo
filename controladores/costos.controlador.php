<?php

class ControladorCostos{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearCostos(){

		if(isset($_POST["nuevoCosto"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCosto"])){

				$tabla = "costos";

				$datos = $_POST["nuevoCosto"];


								
				$presupuestoT = $_POST["presupuestoT"];

				$Proyectos = $_POST["tr"];


				$Viabilidad =  $presupuestoT - $datos;

				if($Viabilidad > 0){

					$res = "viable";


				}else{
					$res = "No Viable";
				}	
				

				$respuesta = ModeloCostos::mdlIngresarCostos($tabla, $datos,$Proyectos,$presupuestoT,$res);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El costo ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "costos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El costo no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "costos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarCostos($item, $valor){

		$tabla = "costos";

		$respuesta = ModeloCostos::mdlMostrarCostos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCostos(){

		if(isset($_POST["EditCosto"])){
				$tabla = "costos";
				$costo = $_POST["EditCosto"];
				$id = $_POST["id"];
				$presupuestoT = $_POST["selpresupuesto"];

				$Proyectos = $_POST["selProyectos"];


				$Viabilidad =  $presupuestoT - $costo;

				if($Viabilidad >= 0){

					$res = "viable";


				}else{
					$res = "No Viable";
				}


           		$respuesta = ModeloCostos::mdlEditarCostos($tabla, $costo, $id,$Proyectos,$presupuestoT,$res);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El costo ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "costos";

									}
								})

					</script>';

				}
		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCostos(){

		if(isset($_GET["idCosto"])){

			$tabla ="costos";
			$datos = $_GET["idCosto"];

			$respuesta = ModeloCostos::mdlBorrarCostos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El costo ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "costos";

									}
								})

					</script>';
			}
		}
		
	}
}
