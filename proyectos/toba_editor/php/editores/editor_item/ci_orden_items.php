<?php 

class ci_orden_items extends toba_ci
{
	
	function ini__operacion()
	{
		$zona = toba::zona();
		if (! $zona->cargada()) {
			throw new toba_error('La zona de carpetas no fue cargada');
		}
		list($proyecto, $item) = $zona->get_editable();
		$this->dep('datos')->cargar(array('padre' => $item, 'padre_proyecto' => $proyecto));
	}
	
	function evt__items__modificacion($datos)
	{
		foreach( array_keys($datos) as $id) {
			unset($datos[$id]['imagen']);
			unset($datos[$id]['imagen_recurso_origen']);
			unset($datos[$id]['nombre']);
		}
		$this->dep('datos')->procesar_filas($datos);
	}

	function conf__items($ml)
	{
		$filas = $this->dep('datos')->get_filas();
		foreach($filas as $id => $fila) {
			if ($fila['carpeta']) {
				$img = toba_recurso::imagen_toba('nucleo/carpeta.gif', true);
			} else {
				$img = toba_recurso::imagen_proyecto('item.gif', true);
			}
			if ($fila['imagen'] != '') {
				$url = admin_util::url_imagen_de_origen($fila['imagen'], $fila['imagen_recurso_origen']);
				$img = "<img src='$url' />";
			}
			$filas[$id]['imagen'] = "<div style='text-align:right'>$img</div>";
			if ($fila['item'] == '__raiz__') {
				unset($filas[$id]);	
			}
		}
		$ml->set_datos($filas);
	}
	
	function evt__procesar()
	{
		$this->dep('datos')->sincronizar();
	}	
}

?>