<?php

class test_item extends test_toba
{

	function get_descripcion()
	{
		return "Comportamiento b�sico del �tem";
	}	

	function sentencias_restauracion()
	{
		$sentencias[] = "DELETE FROM apex_usuario_grupo_acc_item WHERE proyecto='toba_testing' AND item='/pruebas_item/item_sin_permisos'";
		return $sentencias;
	}
	
	function test_consulta_grupos_acceso()
	{
		//Un item sin permisos no debe tener grupo de acceso
		$item = constructor_toba::get_info(array('proyecto' => 'toba_testing', 
												'componente' => '/pruebas_item/item_sin_permisos'), 
											'item');
		$this->AssertEqual(count($item->grupos_acceso()), 0);
		
		//Item con dos grupos permitidos
		$item = constructor_toba::get_info(array('proyecto' => 'toba_testing', 
												'componente' => '/pruebas_item/item_con_dos_grupos'), 
											'item');		
		$this->AssertEqual(count($item->grupos_acceso()), 2, 'La cantidad de grupos debe ser 2 (%s)');
		$this->AssertTrue($item->grupo_tiene_permiso('admin'), 'Admin tiene derechos sobre el item');
		$this->AssertTrue($item->grupo_tiene_permiso('documentacion'), 'Documentaci�n tiene derechos sobre el item');		
	}
	
	function test_otorgar_permiso()
	{
		//Se carga un item sin permisos
		$item = constructor_toba::get_info(array('proyecto' => 'toba_testing', 
												'componente' => '/pruebas_item/item_sin_permisos'), 
											'item');
											
		//Se le asigna permisos al documentador en el proyecto de testing
		$item->otorgar_permiso('documentacion');
		
		//Se vuelve a cargar debe tener permisos de documentador
		$item = constructor_toba::get_info(array('proyecto' => 'toba_testing', 
												'componente' => '/pruebas_item/item_sin_permisos'), 
											'item');
		$this->AssertEqual(count($item->grupos_acceso()), 1, 'Debe haber s�lo 1 grupo (%s)');
		$this->AssertTrue($item->grupo_tiene_permiso('documentacion'), 'Documentacion tiene derechos sobre el item');
	}


}


?>