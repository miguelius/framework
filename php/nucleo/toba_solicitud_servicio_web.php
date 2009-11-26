<?php

/**
 * 
 * @package Centrales
 */
class toba_solicitud_servicio_web extends toba_solicitud
{
	static function mostrar_servicios()
	{
		$id_proyecto = toba::proyecto()->get_id();
		echo "<h2>$id_proyecto - servicios web publicados</h2>";
		$items = toba_info_editores::get_items_servicios_web($id_proyecto);
		echo "<ul>";
		$url_base = $_SERVER['REQUEST_URI'];
		foreach ($items as $item) {
			$url_servicio = $url_base.'/'.$item['item'];
			$url_wsdl1 = $url_servicio.'?wsdl';
			$url_wsdl2 = $url_servicio.'?wsdl2';
			echo "<li><a href='$url_servicio'>{$item['item']}</a>: {$item['nombre']}. 
					<a href='$url_wsdl1'>wsdl 1.1</a> -  <a href='$url_wsdl2'>wsdl 2.0</a></li>";	
		}
		echo "</ul>";
	}
	
	
	function __construct($info)
	{	
		$this->info = $info;
		parent::__construct(toba::memoria()->get_item_solicitado(), toba::usuario()->get_id());		
	}	
	
	protected function validar_componente()
	{
		toba::logger()->seccion("Iniciando componente...", 'toba');
		if (count($this->info['objetos']) == 1) {
			$i = 0;
			foreach ($this->info['objetos'] as $objeto) {
				if ($objeto['clase'] != 'toba_servicio_web') {
					throw new toba_error_def("Necesita asociar a la operaci�n un componente de clase toba_servicio_web");					
				}
			}
		} else { 
			if (count($this->info['objetos']) == 0) {
				throw new toba_error_def("Necesita asociar a la operaci�n un componente toba_servicio_web");
			} else {
				throw new toba_error_def("Debe asociar a la operaci�n un �nico componente toba_servicio_web");
			}
	    }
	}	
	
	
	function procesar()
	{
		$this->validar_componente();
		
		//-- Pide los datos para construir el componente, WSF no soporta entregar objetos creados
		$clave = array();
		$clave['proyecto'] = $this->info['objetos'][0]['objeto_proyecto'];
		$clave['componente'] = $this->info['objetos'][0]['objeto'];
		list($tipo, $clase, $datos) = toba_constructor::get_runtime_clase_y_datos($clave, $this->info['objetos'][0]['clase'], false);
		$opciones_extension = call_user_func(array($clase, 'get_opciones'));
		
		$sufijo = 'op__';
		$metodos = array();
		$reflexion = new ReflectionClass($clase);
		foreach($reflexion->getMethods() as $metodo) {
			if (strpos($metodo->name, $sufijo) === 0) {
				$servicio = substr($metodo->name, strlen($sufijo));
				$metodos[$servicio] = '_'.$metodo->name;
			}	
		}
		$opciones = array();
		$opciones['serviceName'] = $this->info['basica']['item']; 
		$opciones['classes'][$clase]['operations'] = $metodos;
		if (isset($opciones_extension['actions'])) {
			//Pasa el actions procedural a uno orientado a objetos
			//$opciones['classes'][$clase]['actions'] = $opciones_extension['actions'];	
			//unset($opciones_extension['actions']);
		}
		$opciones = array_merge($opciones, $opciones_extension);
		toba::logger()->debug("Opciones del servidor: ".var_export($opciones, true), 'toba');
		$opciones['classes'][$clase]['args'] = array($datos);
		agregar_dir_include_path(toba_dir().'/php/3ros/wsf');
		$service = new WSService($opciones);
		$service->reply();
	}
	
}


?>