<?php
	
	$caso = $_POST['caso'];
	$codigo = $_POST['codigo'];
	include_once("../class/class_conexion.php");
	include_once("../class/clase_Proyectos.php");
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
			$dataProyecto = 
				"Select A.codProyecto, A.nombreProyecto, A.fechaInicio, A.fechafinal, A.lugar, A.descripcion, A.beneficiario,"
			    ."B.estado, A.costoEstimado, "
			    ."C.nombreUsuario, "
			    ."D.tipoProyecto "
			."FROM tblProyectos A "
			."inner join tblestados B on A.codEstado = B.codEstado "
			."inner join tblusuarios C on A.codUsuario = C.codUsuario "
			."inner join tiposproyectos D on A.codTipoProyecto = D.codTiposProyecto"
			."where A.codProyecto = ".$codigo."";

			$resultado = $miConexion->ejecutarInstruccion($dataProyecto);
			while ($fila = $miConexion->obtenerFila($resultado)){
				$proyecto->setCodProyecto($fila['codProyecto']);
				$proyecto->setNombreProyecto($fila['nombreProyecto']);
				//$proyecto->setEstado($fila['estado']);
				$proyecto->setFechaInicio($fila['fechaInicio']);
				$proyecto->setFechaFinal($fila['fechafinal']);
				$proyecto->setLugar($fila['lugar']);
				$proyecto->setDescripcion($fila['descripcion']);

				$JSONLine = $JSONLine.$proyecto->toJSON()."-";
			}

			$miConexion->liberarResultado($resultado);
			$miConexion->cerrarConexion();

			echo rtrim($JSONLine,"-");
			break;

		default:
			# code...
			break;
	}

	 

	

?>