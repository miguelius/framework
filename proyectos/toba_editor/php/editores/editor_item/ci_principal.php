<?php
require_once('nucleo/componentes/interface/toba_ci.php'); 
require_once('modelo/consultas/dao_permisos.php');
require_once('admin_util.php');
//----------------------------------------------------------------

class ci_principal extends toba_ci
{
	protected $cambio_item = false;
	protected $id_item;
	private $elemento_eliminado = false;
	protected $id_temporal = "<span style='white-space:nowrap'>A asignar</span>";
	private $refrescar = false;
	
	function ini()
	{
		$zona = toba::zona();
		if ($zona->cargada()) {
			list($proyecto, $item) = $zona->get_editable();
		}
		//Se notifica un item y un proyecto	
		if (isset($item) && isset($proyecto)) {
			//Se determina si es un nuevo item
			$es_nuevo = (!isset($this->id_item) || 
						($this->id_item['proyecto'] != $proyecto || $this->id_item['item'] != $item));
			if ($es_nuevo) {
				$this->set_item( array('proyecto'=>$proyecto, 'item'=>$item) );
				$this->cambio_item = true;
			}
		}
	}
	
	function mantener_estado_sesion()
	{
		$propiedades = parent::mantener_estado_sesion();
		$propiedades[] = "id_item";
		return $propiedades;
	}	

	function get_entidad()
	//Acceso al DATOS_RELACION
	{
		if ($this->cambio_item){
			toba::logger()->debug($this->get_txt() . '*** se cargo el item: ' . $this->id_item);
			$this->dependencia('datos')->cargar( $this->id_item);
		}
		return $this->dependencia('datos');
	}	

	function set_item($id)
	{
		$this->id_item = $id;
	}
	
	function conf()
	{
		if(! $this->get_entidad()->esta_cargado()){
			$this->pantalla()->eliminar_evento('eliminar');
		}
	}	
	

	//-------------------------------------------------------------------
	//--- PROPIEDADES BASICAS
	//-------------------------------------------------------------------

	function conf__prop_basicas()
	{
		//Ver si el padre viene por post
		$padre_i = toba::hilo()->obtener_parametro('padre_i');
		$padre_p = toba::hilo()->obtener_parametro('padre_p');

		//¿Es un item nuevo?
		if (isset($padre_p) && isset($padre_i)) {
			//Se resetea el dbt para que no recuerde datos anteriores
			unset($this->id_item);
			$this->get_entidad()->resetear();
			//Para el caso del alta el id es asignado automáticamente 
			$datos = array('item' => $this->id_temporal);
			$datos['padre'] = $padre_i;
			$datos['padre_proyecto'] = $padre_p;

		} else {
			$datos = $this->get_entidad()->tabla("base")->get();
		}
	
		//Transfiere los campos accion, buffer y patron a uno comportamiento
		if (isset($datos['actividad_accion']) && $datos['actividad_accion'] != '') {
			$datos['comportamiento'] = 'accion';
		}
		if (isset($datos['actividad_buffer']) && $datos['actividad_buffer'] != 0) {
			$datos['comportamiento'] = 'buffer';
		}
		if (isset($datos['actividad_patron']) && $datos['actividad_patron'] != 'especifico') {
			$datos['comportamiento'] = 'patron';
		}
		return $datos;
	}

	function evt__prop_basicas__modificacion($registro)
	{
		//El campo comportamiento incide en el buffer, patron y accion
		if ($registro['solicitud_tipo'] == 'browser') {		
			switch ($registro['comportamiento']) {
				case 'accion':
					$registro['actividad_buffer'] = 0;
					$registro['actividad_patron'] = 'especifico';
					break;
				case 'buffer':
					$registro['actividad_accion'] = '';
					$registro['actividad_patron'] = 'especifico';				
					break;
				case 'patron':
					$registro['actividad_buffer'] = 0;
					$registro['actividad_accion'] = '';
					break;								
			}
		}
		unset($registro['comportamiento']);
		$this->get_entidad()->tabla("base")->set($registro);
	}
	
	//----------------------------------------------------------
	//-- OBJETOS -----------------------------------------------
	//----------------------------------------------------------
	function conf__objetos()
	{
		$objetos = $this->get_entidad()->tabla('objetos')->get_filas(null, true);
		//Si no hay objetos tratar de inducir las clases dependientes del patron
		if (count($objetos) == 0) {
 			$basicas =$this->get_entidad()->tabla("base")->get();
 			//Es patron?
 			if (isset($basicas['actividad_patron']) && $basicas['actividad_patron'] != 'especifico') {
 				//Este es el lugar para cargar los objetos del tipo deseado
				//$objetos[] = array('clase' => 'toba,toba_ci', apex_ei_analisis_fila => 'A');
 			}
			
		}
		return $objetos;
	}
	
	function evt__objetos__modificacion($objetos)
	{
		$this->get_entidad()->tabla('objetos')->procesar_filas($objetos);
	}
	
	//----------------------------------------------------------
	//-- PERMISOS -------------------------------------------------
	//----------------------------------------------------------
	
	/*
	*	Toma los permisos actuales, les agrega los grupos faltantes y les pone descripcion
	*/
	function conf__permisos()
	{
		$asignados = $this->get_entidad()->tabla('permisos')->get_filas();
		if (!$asignados)
			$asignados = array();
		$grupos = dao_permisos::get_grupos_acceso(toba_editor::get_proyecto_cargado());
		$datos = array();
		foreach ($grupos as $grupo) {
			//El grupo esta asignado al item?
			$esta_asignado = false;	
			foreach ($asignados as $asignado) {
				//Si esta asignado ponerle el nombre del grupo y chequear el checkbox
				if ($asignado['usuario_grupo_acc'] == $grupo['usuario_grupo_acc']) {
					$grupo['tiene_permiso'] = 1;
					$grupo['item'] = $this->id_item['item'];
					$esta_asignado = true;
				}
			}
			//Si no esta asignado poner el item y deschequear el checkbox
			if (!$esta_asignado) {
				$grupo['tiene_permiso'] = 0;
				$grupo['item'] = $this->id_item['item'];
			}
			$datos[] = $grupo;
		}
		return $datos;
	}
	
	function evt__permisos__modificacion($grupos)
	{
		$dbr = $this->get_entidad()->tabla('permisos');
		$asignados = $dbr->get_filas(array(), true);
		if (!$asignados)
			$asignados = array();		
//		ei_arbol($asignados, 'asignados');
//		ei_arbol($grupos, 'nuevos');
		foreach ($grupos as $grupo)
		{
			$estaba_asignado = false;
			foreach ($asignados as $id => $asignado) {
				//¿Estaba asignado anteriormente?
				if ($asignado['usuario_grupo_acc'] == $grupo['usuario_grupo_acc']) {
					$estaba_asignado = true;
					if (! $grupo['tiene_permiso']) {
						//Si estaba asignado, y fue deseleccionado entonces borrar
						$dbr->eliminar_fila($id);
					}
				}
			}
			//Si no estaba asignado y ahora se asigna, agregarlo
			if (!$estaba_asignado && $grupo['tiene_permiso']) {
				unset($grupo['tiene_permiso']);
				unset($grupo['nombre']);
				$dbr->nueva_fila($grupo);
			}
		}
	}
	
	// *******************************************************************
	// *******************  PROCESAMIENTO  *******************************
	// *******************************************************************

	function evt__procesar()
	{
		//Seteo los datos asociados al uso de este editor
		$this->get_entidad()->tabla('base')->set_fila_columna_valor(0,"proyecto",toba_editor::get_proyecto_cargado() );
		//Sincronizo el DBT
		$this->get_entidad()->sincronizar();	
		if (! isset($this->id_item)) {		//Si el item es nuevo
			$this->redireccionar_a_objeto_creado();		
		}
	}

	function evt__eliminar()
	{
		$this->get_entidad()->eliminar();
		toba::notificacion()->agregar("El item ha sido eliminado","info");
		toba::zona()->resetear();
		admin_util::refrescar_editor_item();
	}
	
	function redireccionar_a_objeto_creado()
	{
		$datos = $this->get_entidad()->tabla("base")->get();
		$clave = array( 'proyecto' => $datos['proyecto'],
						'componente' => $datos['item'] );
		$elem_item = toba_constructor::get_info($clave, 'item');
		$vinculo = $elem_item->vinculo_editor();
		admin_util::refrescar_editor_item();
		echo toba_js::abrir();
		echo "window.location.href='$vinculo'\n";
		echo toba_js::cerrar();
	}		
	// *******************************************************************	


}

?>
