<?php

require_once "../controladores/Proyectos.controlador.php";
require_once "../modelos/Proyectos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProyectos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProyecto(){

  	$item = "id_categoria";
  	$valor = $this->idCategoria;

  	$respuesta = ControladorProyectos::ctrMostrarProyectos($item, $valor);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR Proyecto
  =============================================*/ 

  public $idProyecto;

  public function ajaxEditarProyecto(){

    $item = "id";
    $valor = $this->idProyecto;

    $respuesta = ControladorProyectos::ctrMostrarProyectos($item, $valor);

    echo json_encode($respuesta);

  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["idCategoria"])){

	$codigoProyecto = new AjaxProyectos();
	$codigoProyecto -> idCategoria = $_POST["idCategoria"];
	$codigoProyecto -> ajaxCrearCodigoProyecto();

}
/*=============================================
EDITAR Proyecto
=============================================*/ 

if(isset($_POST["idProyecto"])){

  $editarProyecto = new AjaxProyectos();
  $editarProyecto -> idProyecto = $_POST["idProyecto"];
  $editarProyecto -> ajaxEditarProyecto();

}





