<?php


class ControladorPresupuestosGerente{
	/*=============================================
	MOSTRAR Presupuesto
	=============================================*/
	static public function ctrMostrarPresupuestosGerente($item,$valor){
		$tabla = "presupuesto_gerente";
		$respuesta = ModeloPresupuestoGerente::mdlMostrarPresupuestoGererente($tabla, $item,$valor);

		return $respuesta;
	}

    /*=============================================
    CREAR Presupuesto
    =============================================*/
    public function ctrCrearPresupuestoGerente(){

       if (isset($_POST['nuevoCategoria'])) {
    // Obtener los datos del formulario
        $categoria = $_POST['nuevoCategoria'];
        $cliente = $_POST['nuevoCliente'];
        $cedula = $_POST['nuevoCedula'];
        $presupuesto = $_POST['nuevoPresupuesto'];
        $seguros = $_POST['nuevoSeguro'];
        $materiales = $_POST['nuevoCostoMateriales'];
        $maquinaria = $_POST['nuevoMaquinaria'];
        $permisos = $_POST['nuevoCostoPermisos'];
        $contingencia = $_POST['nuevoPresupuestoCont'];
        $costoTotal = $presupuesto + $seguros + $materiales + $maquinaria + $permisos +$contingencia;

        // Guardar los datos en la tabla "presupuesto_gerente"
            try {
                $stmt = Conexion::conectar()->prepare("INSERT INTO `presupuesto_gerente`(`codigo`, `categoria`, `cliente`, `cedula`, `presupuesto`, `seguros`, `materiales`, `maquinaria`, `permisos`, `contingencia`, `costoTotal`) VALUES (null, '$categoria', '$cliente','$cedula','$presupuesto','$seguros','$materiales','$maquinaria','$permisos','$contingencia','$costoTotal')");

                 
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
						
							window.location = "presupuestogerente";
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
						
							window.location = "presupuestogerente";
						}
					});
				
				</script>';
                }

            } catch (PDOException $ex) {
            // Manejo de excepciones en caso de error en la consulta
                echo "Error en la consulta: " . $ex->getMessage();
            }

    }


}//fin Crear Nuevo Presupuesto


  

 /*=============================================
    BORRAR Presupuesto
    =============================================*/
    static public function ctrEliminarPresupuesto(){
        if(isset($_GET["idPresupuesto"])){
            $tabla ="presupuesto_gerente";
            $datos = $_GET["idPresupuesto"];
            $respuesta = ModeloPresupuestoGerente::mdlEliminarPresupuesto($tabla, $datos);
            if($respuesta == "ok"){
                echo'<script>
                swal({
                    type: "success",
                    title: "El Presupuesto ha sido borrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                                if (result.value) {
                                window.location = "presupuestogerente";
                                }
                            })
                </script>';
            }       
        }
    }//fin Eliminar Presupuesto



/*=============================================
    Editar Presupuesto
    =============================================*/

public function ctrEditarPresupuestoGerente()
    {

       if (isset($_POST["nuevoPresupuesto"])) {
          
        if (preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoPresupuesto"])

         ) {
            $tabla = "presupuesto_gerente";
            
            $codigo = $_POST["id"];
            $presupuesto = $_POST["nuevoPresupuesto"];
            $seguros = $_POST['nuevoSeguro'];
            $materiales = $_POST['nuevoCostoMateriales'];
            $maquinaria = $_POST['nuevoMaquinaria'];
            $permisos = $_POST['nuevoCostoPermisos'];
            $contingencia = $_POST['nuevoPresupuestoCont'];
            $costoTotal = $presupuesto + $seguros + $materiales + $maquinaria + $permisos +$contingencia;
           

                // $costoTotal = $presupuesto + $seguros + $materiales + $maquinaria + $permisos +$contingencia;
                               //"costoTotal" => $costoTotal);

                               $modeloPresupuesto = new ModeloPresupuestoGerente(); // Crea una instancia del modelo
                               $respuesta = $modeloPresupuesto->mdlEditarPresupuesto($tabla, $codigo, $presupuesto, $seguros, $materiales, $maquinaria, $permisos, $contingencia, $costoTotal);
                               

                if($respuesta == "ok"){

                    echo'<script>

                    swal({
                          type: "success",
                          title: "El Presupuesto ha sido editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "presupuestogerente";

                                    }
                                })

                    </script>';

                }


        }else{

              echo'<script>

                    swal({
                          type: "error",
                          title: "¡El Presupuesto No puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {

                            window.location = "presupuestogerente";

                            }
                        })

                </script>';
       

        }
    

    }



       
    }//Fin Editar Presupuesto

}//fin del Controlador  

?>