<?php
class ControladorProyectosGerente{
	/*=============================================
	MOSTRAR ProyectoS
	=============================================*/
	static public function ctrMostrarProyectosGerente($item,$valor){
		$tabla = "proyecto_gerente";
		$respuesta = ModeloProyectosGerente::mdlMostrarProyectosGererente($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	CREAR PROYECTO GERENTE
	=============================================*/
	public function ctrCrearProyectoGerente()
    {
        if (isset($_POST['nuevoCategoria'])) {
            // Obtener los datos del formulario
            $categoria = $_POST['nuevoCategoria'];
            $cliente = $_POST['nuevoCliente'];
            $cedula = $_POST['nuevoCedula'];
            $presupuesto = $_POST['nuevoPresupuesto'];
            $plazo = $_POST['nuevoPlazo'];
            $hito = $_POST['nuevoHito'];
            $tarea = $_POST['nuevoTarea'];
            $empleado = $_POST['nuevoEmpleado'];
            $horas = $_POST['nuevoHoras'];
            $numero = $_POST['nuevoNumero'];
            $ubicacion = $_POST['nuevoUbicacion'];

            // Guardar los datos en la tabla "proyecto_gerente"
            try {
                $stmt = Conexion::conectar()->prepare("INSERT INTO proyecto_gerente (id_categoria, id_cliente, presupuesto, plazo, id_hito, horas, numero, ubicacion, cedula, empleado, tareas) VALUES (:id_categoria, :id_cliente, :presupuesto, :plazo, :id_hito, :horas, :numero, :ubicacion, :cedula, :empleado, :tareas)");
                $stmt->bindParam(":id_categoria", $categoria, PDO::PARAM_INT);
                $stmt->bindParam(":id_cliente", $cliente, PDO::PARAM_INT);
                $stmt->bindParam(":cedula", $cedula, PDO::PARAM_STR);
                $stmt->bindParam(":presupuesto", $presupuesto, PDO::PARAM_INT);
                $stmt->bindParam(":plazo", $plazo, PDO::PARAM_INT);
                $stmt->bindParam(":id_hito", $hito, PDO::PARAM_INT);
                $stmt->bindParam(":tareas", $tarea, PDO::PARAM_INT);
                $stmt->bindParam(":empleado", $empleado, PDO::PARAM_INT);
                $stmt->bindParam(":horas", $horas, PDO::PARAM_INT);
                $stmt->bindParam(":numero", $numero, PDO::PARAM_STR);
                $stmt->bindParam(":ubicacion", $ubicacion, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    // Proyecto guardado exitosamente
                     echo '<script>
					swal({
						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "proyectosgerente";
						}
					});
				
					</script>';
                } else {
                    // Ocurrió un error al guardar el proyecto
                    echo '<script>
					swal({
						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
						
							window.location = "proyectosgerente";
						}
					});
				
				</script>';
                }
            } catch (PDOException $ex) {
                // Manejo de excepciones en caso de error en la consulta
                echo "Error en la consulta: " . $ex->getMessage();
            }
        }
    }

    public function ctrEditarProyectoGerente()
    {
        if (isset($_POST['nuevoCategoria'])) {
            // Obtener los datos del formulario
            $id= $_POST["codigo"];
            $categoria = $_POST["nuevoCategoria"];
            $presupuesto = $_POST['nuevoPresupuesto'];
            $plazo = $_POST['nuevoPlazo'];
            $hito = $_POST['nuevoHito'];
            $tarea = $_POST['nuevoTarea'];
            $empleado = $_POST['nuevoEmpleado'];
            $horas = $_POST['nuevoHoras'];
            $numero = $_POST['nuevoNumero'];
            $ubicacion = $_POST['nuevoUbicacion'];

            // Se  envian los datos al Modelo"

            $respuesta = ModeloProyectosGerente::mdlEditarProyectosGerente($id,$categoria, $presupuesto,$plazo,$hito,$tarea,$empleado,$horas,$numero,$ubicacion);

                if($respuesta == "ok"){

                    echo'<script>

                    swal({
                          type: "success",
                          title: "El Proyecto ha sido Editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "proyectosgerente";

                                    }
                                })

                    </script>';

                }else{

                echo'<script>

                    swal({
                          type: "error",
                          title: "¡El Proyecto no puede ir vacía o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {

                            window.location = "costos";

                            }
                        })

                </script>';

            }
            
        }
    }
    /*=============================================
	BORRAR Proyecto
	=============================================*/
	static public function ctrEliminarProyecto(){
		if(isset($_GET["idProyecto"])){
			$tabla ="proyecto_gerente";
			$datos = $_GET["idProyecto"];
			$respuesta = ModeloProyectos::mdlEliminarProyecto($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
					type: "success",
					title: "El Proyecto ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {
								window.location = "proyectosgerente";
								}
							})
				</script>';
			}		
		}
	}

}


?>