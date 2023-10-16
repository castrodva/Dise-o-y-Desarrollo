<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/proyectos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/elementos.controlador.php";
require_once "controladores/catalogo.controlador.php";
require_once "controladores/hitos.controlador.php";
require_once "controladores/proyectogerente.controlador.php";
require_once "controladores/empleados.controlador.php";
require_once "controladores/tareas.controlador.php";
require_once "controladores/presupuestogerente.controlador.php";
require_once "controladores/costos.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/proyectos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/elementos.modelo.php";
require_once "modelos/catalogo.modelo.php";
require_once "modelos/hitos.modelo.php";
require_once "modelos/empleados.modelo.php";
require_once "modelos/tareas.modelo.php";
require_once "modelos/proyectosgerente.modelo.php";
require_once "modelos/presupuestosgerente.modelo.php";
require_once "modelos/costos.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();