<?php
class ControladorTarea{
	/*=============================================
	MOSTRAR TAREAS
	=============================================*/
	static public function ctrMostrarTarea($item, $valor){
		$tabla = "tareas";
		$respuesta = ModeloTarea::mdlMostrarTareas($tabla,$item,$valor);
		return $respuesta;
	}
}
?>