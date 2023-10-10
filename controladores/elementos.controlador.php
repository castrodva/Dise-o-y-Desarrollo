<?php

class ControladorElementos{


    static public function ctrMostrarElementos($item, $valor){

		$tabla = "Elementos";

		$respuesta = ModeloElementos::mdlMostrarElementos($tabla, $item, $valor);

		return $respuesta;

	}
}


?>