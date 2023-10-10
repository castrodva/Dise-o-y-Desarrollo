<?php
class ControladorProyectos{
	/*=============================================
	MOSTRAR ProyectoS
	=============================================*/
	static public function ctrMostrarProyectos($item, $valor, $orden){
		$tabla = "Proyectos";
		$respuesta = ModeloProyectos::mdlMostrarProyectos($tabla, $item, $valor, $orden);
		return $respuesta;
	}
	/*=============================================
	CREAR Proyecto
	=============================================*/
	static public function ctrCrearProyecto(){
		if(isset($_POST["nuevaDescripcion"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/
			   	$ruta = "vistas/img/Proyectos/default/anonymous.png";
			   	if(isset($_FILES["nuevaImagen"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$directorio = "vistas/img/Proyectos/".$_POST["nuevoCodigo"];
					mkdir($directorio, 0755);
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/Proyectos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if($_FILES["nuevaImagen"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/Proyectos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}
				$tabla = "Proyectos";
				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"],
							   "imagen" => $ruta);
				$respuesta = ModeloProyectos::mdlIngresarProyecto($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
						swal({
							  type: "success",
							  title: "El Proyecto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {
										window.location = "Proyectos";
										}
									})
						</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El Proyecto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "Proyectos";
							}
						})
			  	</script>';
			}
		}
	}
	/*=============================================
	EDITAR Proyecto
	=============================================*/
	static public function ctrEditarProyecto(){
		if(isset($_POST["editarDescripcion"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/
			   	$ruta = $_POST["imagenActual"];
			   	if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){
					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$directorio = "vistas/img/Proyectos/".$_POST["editarCodigo"];
					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/
					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/Proyectos/default/anonymous.png"){
						unlink($_POST["imagenActual"]);
					}else{
						mkdir($directorio, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/
					if($_FILES["editarImagen"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/Proyectos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
					}
					if($_FILES["editarImagen"]["type"] == "image/png"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/Proyectos/".$_POST["editarCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
					}
				}
				$tabla = "Proyectos";
				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   "imagen" => $ruta);
				$respuesta = ModeloProyectos::mdlEditarProyecto($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
						swal({
							  type: "success",
							  title: "El Proyecto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {
										window.location = "Proyectos";
										}
									})
						</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El Proyecto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "Proyectos";
							}
						})
			  	</script>';
			}
		}
	}
	/*=============================================
	BORRAR Proyecto
	=============================================*/
	static public function ctrEliminarProyecto(){
		if(isset($_GET["idProyecto"])){
			$tabla ="Proyectos";
			$datos = $_GET["idProyecto"];
			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/Proyectos/default/anonymous.png"){
				unlink($_GET["imagen"]);
				rmdir('vistas/img/Proyectos/'.$_GET["codigo"]);
			}
			$respuesta = ModeloProyectos::mdlEliminarProyecto($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El Proyecto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								window.location = "Proyectos";
								}
							})
				</script>';
			}		
		}
	}
	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/
	static public function ctrMostrarSumaVentas(){
		$tabla = "Proyectos";
		$respuesta = ModeloProyectos::mdlMostrarSumaVentas($tabla);
		return $respuesta;
	}
}