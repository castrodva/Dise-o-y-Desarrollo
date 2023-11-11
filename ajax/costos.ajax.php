<?php
require_once "../controladores/costos.controlador.php";
require_once "../modelos/costos.modelo.php";


class AjaxCostos{
public $id;

  public function ajaxEditar(){

    $item = "id";
    $valor = $this->id;

    $respuesta = ControladorCostos::ctrMostrarCostos($item,$valor);

    echo json_encode($respuesta);

  }



}//final de la classe


if(isset($_POST["id"])){

  $categoria = new AjaxCostos();
  $categoria -> id = $_POST["id"];
  $categoria -> ajaxEditar();
}

