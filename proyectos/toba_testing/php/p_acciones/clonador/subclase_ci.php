<?php 
//--------------------------------------------------------------------
class subclase_ci extends objeto_ci
{
	function extender_objeto_js()
	{
	}

	function mantener_estado_sesion()
	{
		$propiedades = parent::mantener_estado_sesion();
		//$propiedades[] = 'propiedad_a_persistir';
		return $propiedades;
	}

	//---- Eventos CI -------------------------------------------------------

	function evt__procesar()
	{
	}

	function evt__cancelar()
	{
	}

	//-------------------------------------------------------------------
	//--- DEPENDENCIAS
	//-------------------------------------------------------------------

	//---- cuadro -------------------------------------------------------

	function evt__cuadro__seleccion($seleccion)
	{
	}

	function evt__cuadro__carga()
	{
	}

	//---- form1 -------------------------------------------------------

	function evt__form1__modificacion($datos)
	{
	}

	function evt__form1__carga()
	{
	}


}

?>