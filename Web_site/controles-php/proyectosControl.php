<?php
	
	$caso = $_POST['caso'];
	$codigoProyecto = $_POST['codigo'];
	include_once("../class/class_conexion.php");
	include_once("../class/clase_Proyectos.php");
	include_once("../class/clase_Tareas.php");
	include_once("../class/clase_Material.php");
	$miConexion = new Conexion();
	$proyecto = new Proyecto();
	$JSONLine = "";


	switch ($caso) {
		//consultar todos los proyectos
		case '1':
			$todosLosProyectos = "SELECT codProyecto, nombreProyecto, estado FROM tblproyectos A inner join tblestados B on a."
									."codEstado = b.codEstado";

			$resultado = $miConexion->ejecutarInstruccion($todosLosProyectos);
			while ($fila = $miConexion->obtenerFila($resultado)){
				$proyecto->setCodProyecto($fila['codProyecto']);
				$proyecto->setNombreProyecto($fila['nombreProyecto']);
				$proyecto->setEstado($fila['estado']);

				$JSONLine = $JSONLine.$proyecto->toJSON()."-";
			}

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();

			echo rtrim($JSONLine,"-");
			break;
		
		case '2':
			//consultar todos los datos de un proyecto
			$dataProyecto = 
				"Select A.codProyecto, A.nombreProyecto, A.fechaInicio, A.fechafinal, A.lugar, A.descripcion, A.beneficiario,"
			    ."B.estado, A.costoEstimado, "
			    ."C.nombreUsuario, "
			    ."D.tipoProyecto "
			."FROM tblProyectos A "
			."inner join tblestados B on A.codEstado = B.codEstado "
			."inner join tblusuarios C on A.codUsuario = C.codUsuario "
			."inner join tiposproyectos D on A.codTipoProyecto = D.codTiposProyecto"
			." where A.codProyecto = ".$codigoProyecto;

			$resultado = $miConexion->ejecutarInstruccion($dataProyecto);
			if ($resultado) { 
				$fila = $miConexion->obtenerFila($resultado);
				$proyecto->setCodProyecto($fila['codProyecto']);
				$proyecto->setNombreProyecto($fila['nombreProyecto']);
				$proyecto->setEstado($fila['estado']);
				$proyecto->setFechaInicio($fila['fechaInicio']);
				$proyecto->setFechaFinal($fila['fechafinal']);
				$proyecto->setLugar($fila['lugar']);
				$proyecto->setDescripcion($fila['descripcion']);
				$proyecto->setCostoEstimado($fila['costoEstimado']);
				$proyecto->setResponsable($fila['nombreUsuario']);

				$JSONLine = $JSONLine.$proyecto->toJSON()."-";
				
				echo rtrim($JSONLine,"-");

			}else {
				echo "Error en la consulta: ".$dataProyecto;
			}

			$miConexion->cerrarConexion();

			break;

		case '3':
			//consulta de todas las tareas de este proyecto:
			$sqltareas ="SELECT codTarea, nombreTarea, descripcion, prioridad, fechaInicio, fechaEntrega  FROM tbltareas WHERE codProyecto = ".$codigoProyecto;
			$tarea = new Tarea();
			$resultado = $miConexion->ejecutarInstruccion($sqltareas);
			$cant = $miConexion->cantidadRegistros($resultado);
			if ($cant>0) {
				while ($fila = $miConexion->obtenerFila($resultado)){
						$tarea->construir(
										$fila['codTarea'],
										$fila['nombreTarea'],
										$fila['descripcion'],
										$fila['prioridad'],
										$fila['fechaInicio'],
										$fila['fechaEntrega']	
										);

					$JSONLine = $JSONLine.$tarea->toJSON()."*";
					
				}
				if ($cant==1) {
					echo $JSONLine;
				}else
					echo rtrim($JSONLine,"*");
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();

			/*if ($resultado) {
				$fila = $miConexion->obtenerFila($resultado);
				if ($miConexion->cantidadRegistros($resultado)>0) {
					$tarea = new Tarea();
					$tarea->construir(
									$fila['codTarea'],
									$fila['nombreTarea'],
									$fila['descripcion'],
									$fila['prioridad'],
									$fila['fechaInicio'],
									$fila['fechaEntrega']	
									);

					$JSONLine = $JSONLine.$tarea->toJSON()."*";
					if ($miConexion->cantidadRegistros($resultado)==1) {
						echo $JSONLine;
					}else
						echo rtrim($JSONLine,"*");
				}else 
					echo "null";
				
			}else
				echo "Error en la consulta: ".$sqltareas;

			$miConexion->cerrarConexion();*/
			break;

		
		case '4':
			//consultas de todos los materiales de un proyecto 
			$sqlMateriales = "SELECT codMaterial, proveedor, material, cant, precio, total FROM tblmateriales WHERE codProyecto = ".$codigoProyecto;
			$material = new Material();
			$resultado = $miConexion->ejecutarInstruccion($sqlMateriales);
			$cant = $miConexion->cantidadRegistros($resultado);
			if ($cant>0) {
				while ($fila = $miConexion->obtenerFila($resultado)){
						$material->construir(
										$fila['codMaterial'],
										$fila['proveedor'],
										$fila['material'],
										$fila['cant'],
										$fila['precio'],
										$fila['total']	
										);

					$JSONLine = $JSONLine.$material->toJSON()."*";
					
				}
				if ($cant==1) {
					echo $JSONLine;
				}else
					echo rtrim($JSONLine,"*");
			}else
				echo "null";

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();
			break;


		default:
			# code...
			break;
	}

	 

	

?>