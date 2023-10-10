<?php
class ControladorHito{
	/*=============================================
	MOSTRAR HITOS
	=============================================*/
	static public function ctrMostrarHito($item, $valor){
		$tabla = "hito";
		$respuesta = ModeloHito::mdlMostrarHito($tabla,$item,$valor);
		return $respuesta;
	}
}
?>