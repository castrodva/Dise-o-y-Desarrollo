<?php

class ControladorCatalogo{


    static public function ctrMostrarCatalogo($item, $valor){

		$tabla = "catalogo";

		$respuesta = ModeloCatalogo::mdlMostrarCatalogo($tabla, $item, $valor);

		return $respuesta;

	}
}


?>