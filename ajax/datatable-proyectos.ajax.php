<?php
require_once "../controladores/proyectos.controlador.php";
require_once "../modelos/proyectos.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
class TablaProyectos {
    /*=============================================
    MOSTRAR LA TABLA DE ProyectoS
    =============================================*/
    public function mostrarTablaProyectos() {
        $item = null;
        $valor = null;
        $orden = "id";
        $Proyectos = ControladorProyectos::ctrMostrarProyectos($item, $valor, $orden);
        if (count($Proyectos) == 0) {
            echo '{"data": []}';
            return;
        }
        $datosJson = '{
		  "data": [';
        for ($i = 0;$i < count($Proyectos);$i++) {
            /*=============================================
            TRAEMOS LA IMAGEN
            =============================================*/
            $imagen = "<img src='" . $Proyectos[$i]["imagen"] . "' width='40px'>";
            /*=============================================
            TRAEMOS LA CATEGORÍA
            =============================================*/
            $item = "id";
            $valor = $Proyectos[$i]["id_categoria"];
            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
            /*=============================================
            STOCK
            =============================================*/
            if ($Proyectos[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>" . $Proyectos[$i]["stock"] . "</button>";
            } else if ($Proyectos[$i]["stock"] > 11 && $Proyectos[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>" . $Proyectos[$i]["stock"] . "</button>";
            } else {
                $stock = "<button class='btn btn-success'>" . $Proyectos[$i]["stock"] . "</button>";
            }
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
            if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProyecto' idProyecto='" . $Proyectos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProyecto'><i class='fa fa-pencil'></i></button></div>";
            } else {
                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProyecto' idProyecto='" . $Proyectos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProyecto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProyecto' idProyecto='" . $Proyectos[$i]["id"] . "' codigo='" . $Proyectos[$i]["codigo"] . "' imagen='" . $Proyectos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";
            }
            $datosJson.= '[
			      "' . ($i + 1) . '",
			      "' . $imagen . '",
			      "' . $Proyectos[$i]["codigo"] . '",
			      "' . $Proyectos[$i]["descripcion"] . '",
			      "' . $categorias["categoria"] . '",
			      "' . $stock . '",
			      "' . $Proyectos[$i]["precio_compra"] . '",
			      "' . $Proyectos[$i]["precio_venta"] . '",
			      "' . $Proyectos[$i]["fecha"] . '",
			      "' . $botones . '"
			    ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson.= '] 

		 }';
        echo $datosJson;
    }
}




/*=============================================
ACTIVAR TABLA DE ProyectoS
=============================================*/
$activarProyectos = new TablaProyectos();
$activarProyectos->mostrarTablaProyectos();
