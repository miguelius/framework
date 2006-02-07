<?php
require_once("componente.php");

class componente_mt extends componente_toba
{
	static function get_estructura()
	{
		$estructura = parent::get_estructura();
		$estructura[1]['tabla'] = 'apex_objeto_dependencias';
		$estructura[1]['registros'] = 'n';
		return $estructura;		
	}
	
	static function get_vista_extendida($proyecto, $componente=null)
	{
		$sql = parent::get_vista_extendida($proyecto, $componente);
		$sql['info_dependencias'] = parent::get_vista_dependencias($proyecto, $componente);
		return $sql;
	}

	static function get_path_clase_runtime()
	{
		return 'nucleo/componentes/runtime/transversales';
	}
}
?>