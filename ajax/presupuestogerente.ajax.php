<?php

require_once "../controladores/presupuestogerente.controlador.php";
require_once "../modelos/presupuestosgerente.modelo.php";


class AjaxPresupuestosGerente{


public $id;

  public function ajaxEditar(){

    $item = "codigo";
    $valor = $this->id;

    $respuesta = ControladorPresupuestosGerente::ctrMostrarPresupuestosGerente($item, $valor);

    echo json_encode($respuesta);

  }



}//final de la classe


if(isset($_POST["id"])){

  $categoria = new AjaxPresupuestosGerente();
  $categoria -> id = $_POST["id"];
  $categoria -> ajaxEditar();
}


 