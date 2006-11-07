<?
require_once("nucleo/componentes/interface/toba_ei_cuadro.php");

class extension_cuadro_full extends toba_ei_cuadro
{
	
	//----------------------------------------
	//--------- SUMARIZACIONES --------------
	//----------------------------------------
	
	/**
		Promedio de habitantes por localidad
	*/
	function sumarizar_cc__departamento__prom_hab_loc($filas)
	{
		$habitantes = 0;
		foreach($filas as $fila){
			$habitantes += $this->datos[$fila]['hab_total'];
		}
		$resultado = $habitantes / count($filas);
		return number_format($resultado,2,',','.');
	}

	/**
		Cantidad de Localidades
	*/
	function sumarizar_cc__zona__loc($filas)
	{
		return count($filas);
	}

	/**
		Habitantes por kilometro cuadrado
	*/
	function sumarizar_cc__zona__habkil($filas)
	{
		$habitantes = 0;
		$superficie = 0;
		foreach($filas as $fila){
			$habitantes += $this->datos[$fila]['hab_total'];
			$superficie += $this->datos[$fila]['superficie'];
		}
		$resultado = $habitantes / $superficie;
		return number_format($resultado,2,',','.');
	}
	
	//----------------------------------------
	//--------- ESTETICA CORTES --------------
	//----------------------------------------
	
	// ZONA

	function html_cabecera_cc_contenido__zona(&$nodo)
	{
		$zona = $nodo['descripcion']['zona'];
		$locs = count($nodo['filas']);
		$deps = count($nodo['hijos']);
		echo "<strong>Zona</strong>: $zona - 
			<strong>Departamentos</strong>: $deps - 
			<strong>Localidades</strong>: $locs";
	}
	
	function html_pie_cc_contenido__zona(&$nodo)
	{
		//Preparo una descripcion
		$zona = $nodo['descripcion']['zona'];
		$locs = count($nodo['filas']);
		$deps = count($nodo['hijos']);
		echo "La Zona <strong>$zona</strong> tiene <strong>$deps</strong>
				departamentos y <strong>$locs</strong> localidades.<br>";
		//Hago unos calculos
		$habitantes = 0;
		foreach($nodo['filas'] as $fila){
			$habitantes += $this->datos[$fila]['hab_total'];
		}
		$promedio = $habitantes / count($nodo['filas']);
		$resultado = number_format($promedio,2,',','.') ;
		echo "El promedio de habitantes por localidad es: <strong>$promedio</strong>.";
	}

	// DEPARTAMENTO

	function html_pie_cc_cabecera__departamento(&$nodo)
	{
		$hab = $nodo['acumulador']['hab_total'];
		$sup = $nodo['acumulador']['superficie'];
		$desc = $nodo['descripcion']['departamento'];
		return "Resumen: <strong>$desc</strong> (hab: $hab - sup: $sup)";
	}

	//----------------------------------------
}
?>