<?php

class toba_modelo_catalogo
{
	private $instalacion;				// Instalacion
	private $instancia;					// Array de instancias existentes en la instalacion
	static private $singleton;

	private function __construct(){}
	
	/**
	*	Devuelve una referencia a la INSTALACION
	*/
	function get_instalacion( $manejador_interface = null )
	{
		if ( ! isset( $this->instalacion ) ) {
			$this->instalacion = new toba_modelo_instalacion();
			if (! isset($manejador_interface)) {
				$manejador_interface = new toba_mock_proceso_gui();
			}
			$this->instalacion->set_manejador_interface( $manejador_interface );
		}
		return $this->instalacion;
	}

	/**
	*	Devuelve una referencia a un INSTANCIA.
	*/
	function get_instancia( $id_instancia, $manejador_interface=null)
	{
		if ( ! isset ( $this->instancia[ $id_instancia ] ) ) {
			$instalacion = $this->get_instalacion( $manejador_interface );
			$this->instancia[ $id_instancia ] = new toba_modelo_instancia( $instalacion, $id_instancia );
			if (! isset($manejador_interface)) {
				$manejador_interface = new toba_mock_proceso_gui();
			}
			$this->instancia[ $id_instancia ]->set_manejador_interface( $manejador_interface );
		}
		return $this->instancia[ $id_instancia ];
	}
	
	/**
	*	Devuelve una referencia a un PROYECTO
	*/
	function get_proyecto( $id_instancia, $id_proyecto, $manejador_interface=null )
	{
		$instancia = $this->get_instancia( $id_instancia, $manejador_interface );
		$archivo_proy = $instancia->get_path_proyecto($id_proyecto)."/php/toba_modelo/$id_proyecto.php";
		if (file_exists($archivo_proy)) {
			require_once($archivo_proy);
			$proyecto = new $id_proyecto( $instancia, $id_proyecto );
		} else {
			$proyecto = new toba_modelo_proyecto( $instancia, $id_proyecto );
		}
		if (! isset($manejador_interface)) {
			$manejador_interface = new toba_mock_proceso_gui();
		}		
		$proyecto->set_manejador_interface( $manejador_interface );
		return $proyecto;
	}

	/**
	*	Devuelve una referencia al NUCLEO
	*/
	function get_nucleo( $manejador_interface=null )
	{
		$nucleo = new toba_modelo_nucleo();
		if (! isset($manejador_interface)) {
			$manejador_interface = new toba_mock_proceso_gui();
		}		
		$nucleo->set_manejador_interface( $manejador_interface );
		return $nucleo;
	}

	/**
	*	Singleton
	*/
	static function instanciacion()
	{
		if (!isset(self::$singleton)) {
			self::$singleton = new toba_modelo_catalogo();	
		}
		return self::$singleton;	
	}	
}
?>