<?php
require_once "../controladores/proyectogerente.controlador.php";
require_once "../modelos/proyectosgerente.modelo.php";


class AjaxProyectosGerente{
public $id;

  public function ajaxEditar(){

    $item = "id";
    $valor = $this->id;

    $respuesta = ControladorProyectosGerente::ctrMostrarProyectosGerente($item,$valor);

    echo json_encode($respuesta);

  }



}//final de la classe


if(isset($_POST["id"])){

  $categoria = new AjaxProyectosGerente();
  $categoria -> id = $_POST["id"];
  $categoria -> ajaxEditar();
}


 