<?php

	class Patrocinadores{
		private $nombre;
		private $tipoPatrocinador;
		private $lugarProcedencia;		
		private $correoElectronico;
		private $nombreContacto;
		private $telefonoContacto;		
		

		public function __construct(
					$nombre,
					$tipoPatrocinador,
					$lugarProcedencia,
					$correoElectronico,
					$nombreContacto,
					$telefonoContacto
			){
			$this->nombre=$nombre;
			$this->tipoPatrocinador=$tipoPatrocinador;
			$this->lugarProcedencia=$lugarProcedencia;
			$this->correoElectronico=$correoElectronico;
			$this->nombreContacto=$nombreContacto;
			$this->telefonoContacto=$telefonoContacto;
		
			
		}		

		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getTipoPatrocinador(){
			return $this->tipoPatrocinador;
		}
		public function setTipoPatrocinador($tipoPatrocinador){
			$this->tipoPatrocinador = $tipoPatrocinador;
		}
		public function getLugarProcedencia(){
			return $this->lugarProcedencia;
		}
		public function setLugarProcedencia($lugarProcedencia){
			$this->lugarProcedencia = $lugarProcedencia;
		}
		public function getCorreoElectronico(){
			return $this->correoElectronico;
		}
		public function setCorreoElectronico($correoElectronico){
			$this->correoElectronico = $correoElectronico;
		}
		public function getNombreContacto(){
			return $this->nombreContacto;
		}
		public function setNombreContacto($nombreContacto){
			$this->nombreContacto = $nombreContacto;
		}
		public function getTelefonoContacto(){
			return $this->telefonoContacto;
		}
		public function setTelefonoContacto($telefonoContacto){
			$this->telefonoContacto = $telefonoContacto;
		}
				
		}
		// function encender(){
		// 	echo "Encendiendo";
		// }
		// function apagar(){
		// 	echo "Apagando";
		// }
		// function explotar(){
		// 	echo "Explotando";
		// }
		// function procesar(){
		// 	echo "Procesando";
		// }

		public function __toString(){
			return 	$this->nombre.','.
					$this->tipoPatrocinador.','.
					$this->lugarProcedencia.','.
					$this->correoElectronico.','.
					$this->nombreContacto.','.					
					$this->telefonoContacto;
		}
	}
?>