<?php
class ControladorEmpleado{
	/*=============================================
	MOSTRAR Empleado
	=============================================*/
	static public function ctrMostrarEmpleados($item, $valor){
		$tabla = "empleados";
		$respuesta = ModeloEmpleado::mdlMostrarEmpleados($tabla,$item,$valor);
		return $respuesta;
	}
}
?>