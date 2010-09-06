<?php

class toba_referencia_modelo extends toba_aplicacion_modelo_base 
{
	private $instalar_complemento_gis = false;
	
	function __construct()
	{
		$this->permitir_exportar_modelo = false;
		$this->schema_modelo = 'referencia';
	}
	
	function get_id_base()
	{
		$parametros = $this->get_instancia()->get_parametros_db();
		return $parametros['base'];
	}	
	
	function get_version_nueva()
	{
		return $this->get_instalacion()->get_version_actual();
	}

	function crear_modelo_gis()
	{
		$this->manejador_interface->enter();
		$this->manejador_interface->mensaje("Si lo desea puede incorporar datos GIS al modelo, es necesario tener instalado postGIS previamente en la base de datos.");
		$this->instalar_complemento_gis = $this->manejador_interface->dialogo_simple('Desea incorporar la estructura y los datos GIS?: ');
		return $this->instalar_complemento_gis;
	}
	
	function crear_estructura(toba_db $base)
	{
		$estructura = $this->proyecto->get_dir().'/sql/estructura.sql';
		if (file_exists($estructura)) {
			$this->manejador_interface->mensaje('Creando estructura', false);
			$this->manejador_interface->progreso_avanzar();
			$base->ejecutar_archivo($estructura);
			$this->manejador_interface->progreso_fin();
		}

		$estructura_gis = $this->proyecto->get_dir().'/sql/estructura_gis.sql';
		if (file_exists($estructura_gis) && $this->crear_modelo_gis()) {			
			//Modifico el esquema porque la libreria para gis no los soporta
			$base->set_schema(" public, pg_catalog");

			$this->manejador_interface->mensaje('Creando estructura GIS', false);
			$this->manejador_interface->progreso_avanzar();
			$base->ejecutar_archivo($estructura_gis);
			$this->manejador_interface->progreso_fin();
			//Vuelvo a colocar el schema como estaba antes
			$base->set_schema("{$this->schema_modelo}, public, pg_catalog");
		}
	}

	function cargar_datos(toba_db $base)
	{
		$locales =  $this->proyecto->get_dir().'/sql/datos_locales.sql';
		if (file_exists($locales)) {
			$this->manejador_interface->mensaje('Cargando datos locales', false);
			$this->manejador_interface->progreso_avanzar();
			$base->ejecutar_archivo($locales);
			$this->manejador_interface->progreso_fin();
		} else {
			$datos = $this->proyecto->get_dir().'/sql/datos_basicos.sql';
			if (file_exists($datos)) {
				$this->manejador_interface->mensaje('Cargando datos b�sicos', false);
				$base->ejecutar_archivo($datos);
				$this->manejador_interface->progreso_fin();
			}

			$datos_gis = $this->proyecto->get_dir().'/sql/datos_gis.sql';
			if (file_exists($datos_gis) && $this->instalar_complemento_gis) {
				$base->set_schema(" public, pg_catalog");
				$this->manejador_interface->mensaje('Cargando datos GIS', false);
				$base->ejecutar_archivo($datos_gis);
				$this->manejador_interface->progreso_fin();
			}
		}

	}
}

?>