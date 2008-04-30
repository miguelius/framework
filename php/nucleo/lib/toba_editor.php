<?php
/**
 * A travez de esta clase el nucleo se relaciona con el proyecto toba_editor
 * Esta es una clase muy particular, su contenido deberia repartirse entre modelo,
 * proyecto editor y nucleo. Por simplicidad se deja todo junto.
 * @package Varios
 * @ignore 
 */
class toba_editor
{
	private static $memoria;	// Bindeo a $_sesion

	static function get_id()
	{
		return 'toba_editor';	
	}

	/**
	*	_falta: Hacer un control de que el administrador esta en esa instancia
	*			(hoy en dia seria obligatorio)
	*/
	static function iniciar($instancia, $proyecto)
	{
		if(!isset($instancia) || !isset($proyecto)) {
			throw new toba_error('Editor: es necesario definir la instancia y proyecto a utilizar.');	
		}
		self::referenciar_memoria();
		self::$memoria['instancia'] = $instancia;
		self::$memoria['proyecto'] = $proyecto;
		//Busco el ID de la base donde reside la instancia
		$parametros_instancia = toba::instancia()->get_datos_instancia($instancia);
		self::$memoria['base'] = $parametros_instancia['base'];
		//Averiguo el punto de acceso del editor
		$punto_acceso = explode('?', $_SERVER['PHP_SELF']);	
		self::$memoria['punto_acceso'] = $punto_acceso[0];
	}
	
	static function referenciar_memoria()
	{
		self::$memoria =& toba::manejador_sesiones()->segmento_editor();
		if (toba::memoria()->get_parametro('skin') != '') {
			$skin = explode(apex_qs_separador, toba::memoria()->get_parametro('skin'));
			toba::proyecto()->set_parametro('estilo', $skin[0]);
			toba::proyecto()->set_parametro('estilo_proyecto', $skin[1]);
		}
		//Acceso a la informacion del modelo
		toba_contexto_info::set_proyecto( toba_editor::get_proyecto_cargado() );
		toba_contexto_info::set_db( toba_editor::get_base_activa() );
	}

	static function finalizar()
	{
		toba::manejador_sesiones()->borrar_segmento_editor();
	}

	
	/**
	*	Indica si el EDITOR de metadatos se encuentra encendido
	*/
	static function activado()
	{
		if (count(self::$memoria)>0) {
			return true;	
		}
		return false;
	}

	/**
	*	Indica si la ejecucion actual corresponde a la previsualizacion de un proyecto 
	*		lanzada desde el admin
	*/
	static function modo_prueba()
	{
		if (self::activado() && toba::manejador_sesiones()->existe_sesion_activa() ) {
			return self::$memoria['proyecto'] == toba_proyecto::get_id();
		}
		return false;
	}

	static function get_id_instancia_activa()
	{
		if (self::activado()) {
			return self::$memoria['instancia'];
		}
	}
	
	static function get_base_activa()
	{
		if (self::activado()) {
			return toba_dba::get_db(self::$memoria['base']);
		}
	}
	
	static function get_db_defecto()
	{
		$fuente = toba_info_editores::get_fuente_datos_defecto(toba_editor::get_proyecto_cargado());
		return toba::db($fuente, toba_editor::get_proyecto_cargado());
	}

	static function get_proyecto_cargado()
	{
		if (self::activado()) {
			return self::$memoria['proyecto'];
		}
	}
	
	static function set_proyecto_cargado($proyecto)
	{
		if (self::$memoria['proyecto'] != $proyecto ) {
			//Cambio el proyecto que se esta editando, elimino la sesion del anterior.
			self::limpiar_memoria_proyecto_cargado();
		}
		self::$memoria['proyecto'] = $proyecto;
		self::get_parametros_previsualizacion(true);
	}
		
	static function get_punto_acceso_editor()
	{
		if (self::activado()) {
			return self::$memoria['punto_acceso'];
		}
	}

	/**
	*	Indica si el ADMIN se esta editando a si mismo
	*/
	static function acceso_recursivo()
	{
		if (self::activado()) {
			return self::get_proyecto_cargado() == self::get_id();
		}
		return false;		
	}

	static function limpiar_memoria_proyecto_cargado()
	{
		if ( ! toba_editor::acceso_recursivo() ) {	//Si se esta editando el editor, no es necesario
			$proyecto = toba_editor::get_proyecto_cargado();
			if ( toba::manejador_sesiones()->existe_sesion_activa($proyecto) ) {
				$msg = 'El proyecto estaba en modo edicion y el usuario finalizo la sesion del editor.';
				toba::manejador_sesiones()->abortar_sesion_proyecto($proyecto, $msg);
			} elseif (toba::manejador_sesiones()->existe_proyecto_cargado($proyecto)) {
				//El proyecto puede estar cargado para mostrar un item publico, como la pantalla de login.
				toba::manejador_sesiones()->borrar_segmento_proyecto($proyecto);
			}
		}
	}

	//---------------------------------------------------------------------------
	//-- 
	//---------------------------------------------------------------------------

	/**
	*	Inicializa el contexto del proyecto en edicion.
	*		(Utilizado en el analisis de codigo y la simulacion)
	*/
	function iniciar_contexto_proyecto_cargado()
	{
		if(!self::acceso_recursivo()){
			//La subclase puede incluir archivos del proyecto
			$path_proyecto = toba::instancia()->get_path_proyecto(toba_editor::get_proyecto_cargado()) . '/php';
			agregar_dir_include_path($path_proyecto);
			$info = toba::proyecto()->cargar_info_basica(self::get_proyecto_cargado());
			if($info['contexto_ejecucion_subclase_archivo']&&$info['contexto_ejecucion_subclase_archivo']) {
				require_once($info['contexto_ejecucion_subclase_archivo']);
				$contexto = new $info['contexto_ejecucion_subclase']();
				$contexto->conf__inicial();
			}
		}
	}

	//---------------------------------------------------------------------------
	//-- Manejo de la configuracion de PREVISUALIZACION
	//-- ( La previsualizacion es la ejecucion de un proyecto desde el ADMIN)
	//---------------------------------------------------------------------------

	/**
	*	Alimenta a la clase que representa al editor en JS
	*/
	static function get_parametros_previsualizacion_js()
	{
		$param_prev = self::get_parametros_previsualizacion();
		$param_prev['proyecto'] = self::get_proyecto_cargado();
		return $param_prev;
	}

	static function get_grupos_acceso_previsualizacion()
	{
		$param_prev = self::get_parametros_previsualizacion();
		if(isset($param_prev['grupo_acceso'])) {
			$grupos = explode(',', $param_prev['grupo_acceso'] );
			$grupos = array_map('trim', $grupos);
			return $grupos;
		} else {
			throw new toba_error("No esta definido el parametro 'grupo de acceso' del editor.");	
		}
	}

	static function get_perfil_datos_previsualizacion()
	{
		$param_prev = self::get_parametros_previsualizacion();
		if(isset($param_prev['perfil_datos'])) {
			return $param_prev['perfil_datos'];
		}
	}
		
	/**
	 * Retorna la URL base del proyecto editado, basandose en la URL del PA (puede no ser la real..)
	 * @return unknown
	 */
	static function get_url_previsualizacion()
	{
		$pa = '';
		if (isset(self::$memoria['previsualizacion']['punto_acceso'])) {
			$pa = self::$memoria['previsualizacion']['punto_acceso'];
		}
		if (strpos($pa, '.php') !== false) {
			return dirname($pa);
		} else {
			return $pa;	
		}
	}
	

	/**
	*	Recuperar las propiedades y setearlas en la sesion
	*/
	static function get_parametros_previsualizacion($refrescar = false)
	{
		if ($refrescar || !isset(self::$memoria['previsualizacion'])) {
			$rs = self::get_parametros_previsualizacion_db();
			if ($rs) {
				self::$memoria['previsualizacion'] = $rs;
			} else {
				 self::$memoria['previsualizacion'] = null;
			}
		}
		return 	self::$memoria['previsualizacion'];
	}
	
	/**
	*	Establecer las propiedades desde el editor
	*/
	static function set_parametros_previsualizacion($datos)
	{
		if (!( array_key_exists('punto_acceso', $datos) && array_key_exists('grupo_acceso', $datos))) {
			throw new toba_error('Los parametros de previsualizacion son incorrectos.');	
		}
		self::$memoria['previsualizacion']['punto_acceso'] = $datos['punto_acceso'];
		self::$memoria['previsualizacion']['grupo_acceso'] = $datos['grupo_acceso'];
		self::$memoria['previsualizacion']['perfil_datos'] = $datos['perfil_datos'];
		if (self::get_id_instancia_activa() == toba::instancia()->get_id() ) {
			//Si estoy editando un proyecto en otra instancia, no tengo certeza de como guardar estos datos.
			self::set_parametros_previsualizacion_db($datos);
		}
	}

	static function get_parametros_previsualizacion_db()
	{
		$sql = "SELECT perfil_datos, grupo_acceso, punto_acceso 
				FROM apex_admin_param_previsualizazion
				WHERE proyecto = '" . self::get_proyecto_cargado() . "'
				AND usuario = '".toba::usuario()->get_id()."';";
		//Esto se accede solo desde el ADMIN
		$datos = toba::db()->consultar($sql);
		if ($datos) {
			return $datos[0];	
		}
		return null;
	}
	
	static function set_parametros_previsualizacion_db($datos)
	{
		$rs = self::get_parametros_previsualizacion_db();
		if (!$rs) {
			$sql = "INSERT INTO apex_admin_param_previsualizazion (perfil_datos, grupo_acceso, punto_acceso, proyecto, usuario) 
					VALUES ('{$datos['perfil_datos']}','{$datos['grupo_acceso']}', '{$datos['punto_acceso']}', 
							'" . self::get_proyecto_cargado() . "', '".toba::usuario()->get_id()."');";
		} else {
			$sql = "UPDATE apex_admin_param_previsualizazion
					SET grupo_acceso = '{$datos['grupo_acceso']}', 
						perfil_datos = '{$datos['perfil_datos']}', 
						punto_acceso = '{$datos['punto_acceso']}'
					WHERE proyecto = '" . self::get_proyecto_cargado() . "'
					AND usuario = '".toba::usuario()->get_id()."';";
		}
		//Esto se accede solo desde el ADMIN
		toba::db()->ejecutar($sql);
	}
	
	//---------------------------------------------------------------------------
	//-- Generacion de VINCULOS al editor (desde un proyecto PREVISUALIZADO)
	//---------------------------------------------------------------------------

	/**
	*	Generacion del invocador al editor.
	*/
	static function javascript_invocacion_editor()
	{
		echo toba_js::abrir();
		echo "	
			function toba_invocar_editor(frame, url) 
			{
				var encontrado = false;
				var rendido = false;
				var sujeto = window;
				//--- Trata de encontrar el frame de edicion
				while (! encontrado && ! rendido) {
					if (sujeto.top && sujeto.top.frame_control && sujeto.top.frame_control.editor) {
						encontrado = true;
						break;
					}
					if (sujeto.opener) {						//Previsuliazion comun
						sujeto = sujeto.opener;
					} else if (sujeto.top.opener) {				//Previsualizacion de algo con frames
						sujeto = sujeto.top.opener;
					} else if (sujeto.top.opener.opener) {		//Popup abierto desde la previsualizacion
						sujeto = sujeto.top.opener.opener;
					} else {
						//-- No hay mas padres, me rindo
						rendido = true;
					}
				}
				if (encontrado) {
					sujeto.top.frame_control.editor.abrir_editor(frame, url);
					sujeto.focus();
				} else {
					alert('No se puede encontrar un editor de toba abierto');
				}
			}
		";
		echo toba_js::cerrar();		
	}

	/*
	*	Zona de vinculos de los items
	*/
	static function generar_zona_vinculos_item( $item, $accion )
	{
		if (! self::acceso_recursivo()) {
			toba::solicitud()->set_cronometrar(true);
		}
		echo toba_js::abrir();
		echo "
			function editor_cambiar_vinculos() {
				var nodos = getElementsByClass('div-editor');
				var mostrar =false;
				for (var i=0; i< nodos.length; i++) {
					if (nodos[i].className.indexOf('editor-mostrar') == -1) {
						nodos[i].className += ' editor-mostrar';
						mostrar = true;
					} else {
						nodos[i].className = 'div-editor';
					}
				}

			}";
		echo "
			function capturar(e) 
			{
			   	var id = (window.event) ? event.keyCode : e.keyCode;
				if (id == 17) {
					editor_cambiar_vinculos();
				}
			}
			document.onkeyup = capturar
		";
		echo toba_js::cerrar();
		self::javascript_invocacion_editor();				
		$html_ayuda_editor = toba_recurso::ayuda(null, 'Presionando la tecla CTRL se pueden ver los enlaces hacia los editores de los distintos componentes de esta p�gina');
		$html_ayuda_cronometro = toba_recurso::ayuda(null, 'Ver los tiempos de ejecuci�n en la generaci�n de esta p�gina');
		$html_ayuda_logger = toba_recurso::ayuda(null, 'Visor de logs');
		$solicitud = toba::solicitud()->get_id();
		$link_cronometro = toba::vinculador()->get_url('toba_editor', '/basicos/cronometro', null, array('prefijo'=>toba_editor::get_punto_acceso_editor()));
		$link_logger = toba::vinculador()->get_url('toba_editor', '1000003', null, array('prefijo'=>toba_editor::get_punto_acceso_editor()));
		$estilo = toba::proyecto()->get_parametro('estilo');
		echo "<div id='editor_previsualizacion'>";
		echo "<img style='cursor:pointer;_cursor:hand;' title='Ocultar la barra'
				src='".toba_recurso::imagen_toba('nucleo/expandir_izq.gif', false)."' 
				onclick='toggle_nodo(\$(\"editor_previsualizacion_cont\"))'/>";		
		echo "<span id='editor_previsualizacion_cont'>";
		//Skin
		$skins = rs_convertir_asociativo(toba_info_editores::get_lista_skins(), array('estilo','proyecto'), 'descripcion');
		$js = "onchange=\"location.href = toba_prefijo_vinculo + '&skin=' + this.value\"";
		$defecto = toba::proyecto()->get_parametro('estilo').apex_qs_separador.toba::proyecto()->get_parametro('estilo_proyecto');
		echo toba_form::select('cambiar_skin', $defecto, $skins, 'ef-combo', $js);
		
				//Logger
		echo "<a href='$link_logger' target='logger' $html_ayuda_logger >".
				toba_recurso::imagen_toba('logger_22.png', true)."</a>\n";
				
				//Cronometro
		echo "<a href='$link_cronometro' target='cronometro' $html_ayuda_cronometro >\n".
				toba_recurso::imagen_toba('reloj.png', true)."</a>\n";
				
				//Edicion				
		echo	"<a href='javascript: editor_cambiar_vinculos()' $html_ayuda_editor >".
				toba_recurso::imagen_toba('edicion.png', true)."</a>\n";
				
		echo "</span>";				
		echo "</div>";
		
		
		echo "<div class='div-editor' style='position:absolute; top: 40px;'>";
		foreach(self::get_vinculos_item($item, $accion) as $vinculo) {
			if (! isset($vinculo['js'])) {
				echo "<a href='#' title='{$vinculo['tip']}' onclick=\"toba_invocar_editor('{$vinculo['frame']}','{$vinculo['url']}')\">";
			} else {
				echo "<a href='#' title='{$vinculo['tip']}' onclick=\"{$vinculo['js']}\">";
			}
			if (isset($vinculo['imagen_origen']) && $vinculo['imagen_origen'] == 'proyecto') {
				echo self::imagen_editor($vinculo['imagen'],true);
			} else {
				echo toba_recurso::imagen_toba($vinculo['imagen'],true);
			}
			echo "</a>\n";
		}
		echo "</div>";
	}

	/*
	*	Acceso a la edicion del componente
	*/
	static function generar_zona_vinculos_componente( $componente, $editor, $clase, $con_subclase )
	{
		$salida = "<span class='ei-base' style='height: 55px' >";
		if ($con_subclase) {
			$salida .= self::get_utileria_editor_abrir_php(array('componente'=>$componente[1], 'proyecto' => $componente[0]));
		}
		foreach(self::get_vinculos_componente($componente, $editor, $clase) as $vinculo) {
			$salida .= "<a href='#' onclick=\"toba_invocar_editor('{$vinculo['frame']}','{$vinculo['url']}')\">";
			if ($vinculo['imagen_recurso_origen'] == 'apex') {
				$salida .= toba_recurso::imagen_toba($vinculo['imagen'],true,null,null,$vinculo['etiqueta']);
			} else {
				$salida .= self::imagen_editor($vinculo['imagen'],true,null,null,$vinculo['etiqueta']);
			}
			$salida .= "</a>\n";
		}
		$salida .= "</span>";
		return $salida;
	}

	/*
	*	Vinculos a EFs y a COLUMNAS
	*/
	static function get_vinculo_subcomponente($item_editor, $parametros, $opciones=array(),$frame='frame_centro')
	{
		$imagen='objetos/editar.gif';
		if(!isset($opciones['celda_memoria'])) $opciones['celda_memoria'] = 'central';
		if(!isset($opciones['prefijo'])) $opciones['prefijo'] = self::get_punto_acceso_editor();
		if(!isset($opciones['validar'])) $opciones['validar'] = false;
		if(!isset($opciones['menu'])) $opciones['menu'] = true;
		$url = toba::vinculador()->get_url(self::get_id(),$item_editor,$parametros,$opciones);
		$html = "<a href='#' title='Editar' class='div-editor' onclick=\"toba_invocar_editor('$frame','$url')\">";
		$html .= toba_recurso::imagen_toba($imagen,true);
		$html .= '</a>';
		return $html;
	}

	static function get_vinculos_item( $item, $accion )
	{
		//Celda de memoria central
		//punto de acceso del admin

		$proyecto = self::get_proyecto_cargado();
		$vinculos = array();
		
		//Accion
		if ($accion != '') {
			$parametros[apex_hilo_qs_zona] = $proyecto . apex_qs_separador . $item;
			$opciones = array('servicio' => 'ejecutar', 'zona' => false, 'celda_memoria' => 'ajax', 'menu' => true);
			$vinculo = toba::vinculador()->get_url(toba_editor::get_id(), "1000058", $parametros, $opciones);
			$js = "toba.comunicar_vinculo('$vinculo')";
			$vinculo = array();			
			$vinculo['js'] = $js;
			$vinculo['frame'] = '';
			$vinculo['imagen'] = 'reflexion/abrir.gif';
			$vinculo['imagen_origen'] = 'proyecto';
			$vinculo['tip'] = 'Abrir el PHP del �tem en el escritorio';
			$vinculos[] = $vinculo;
		}

		//Etitor Item
		$opciones = array();
		$opciones['celda_memoria'] = 'central';
		$opciones['prefijo'] = self::get_punto_acceso_editor();
		$opciones['validar'] = false;
		$parametros = array(apex_hilo_qs_zona=> $proyecto . apex_qs_separador . $item);
		$vinculo = array();
		$vinculo['url'] = toba::vinculador()->get_url(self::get_id(),'/admin/items/editor_items',$parametros,$opciones);
		$vinculo['frame'] = 'frame_centro';
		$vinculo['imagen'] = 'objetos/editar.gif';
		$vinculo['tip'] = 'Ir al editor de la operaci�n.';
		$vinculos[] = $vinculo;

		//Catalogo Unificado
		$parametros = array("proyecto"=>$proyecto,"item"=>$item);
		$opciones = array();
		$opciones['celda_memoria'] = 'lateral';
		$opciones['prefijo'] = self::get_punto_acceso_editor();
		$vinculo = array();		
		$vinculo['url'] = toba::vinculador()->get_url(self::get_id(),'/admin/items/catalogo_unificado',$parametros,$opciones);
		$vinculo['frame'] = 'frame_lista';
		$vinculo['imagen'] = 'objetos/arbol.gif';
		$vinculo['tip'] = 'Ver composicion de la operaci�n.';
		$vinculos[] = $vinculo;

/*		//Consola JS
		//-- Link a la consola JS
		$vinculos[2]['url'] = toba::vinculador()->get_url(self::get_id(),'/admin/objetos/consola_js');
		$vinculos[2]['frame'] = 'frame_lista';
		$vinculos[2]['imagen'] = 'solic_consola.gif';
		$vinculos[2]['tip'] = 'Ir al editor de la operaci�n.';
*/
		return $vinculos;
	}

	static function get_vinculos_componente($componente,$editor,$clase) 
	{
		$vinculos = array();
		$opciones['celda_memoria'] = 'central';
		$opciones['menu'] = true;
		$opciones['prefijo'] = self::get_punto_acceso_editor();
		$opciones['validar'] = false;

		$vinculos = call_user_func(array('toba_datos_editores', 'get_pantallas_'.$clase));		
		foreach(array_keys($vinculos) as $id) {
			$parametros = array(apex_hilo_qs_zona => implode(apex_qs_separador,$componente),
								'etapa' => $vinculos[$id]['identificador']);
			$vinculos[$id]['url'] = toba::vinculador()->get_url(self::get_id(),$editor,$parametros,$opciones);
			$vinculos[$id]['frame'] = 'frame_centro';
		}
		return $vinculos;
	}

	static function get_vinculo_evento($componente, $editor, $evento)
	{
		$opciones['celda_memoria'] = 'central';
		$opciones['prefijo'] = self::get_punto_acceso_editor();
		$opciones['validar'] = false;
		$parametros = array(apex_hilo_qs_zona=>implode(apex_qs_separador,$componente), 'evento' => $evento);
		$url = toba::vinculador()->get_url(self::get_id(),$editor,$parametros,$opciones);
		$salida = "<span class='div-editor'>";		
		$salida .= "<a href='#' title='Editar propiedades del evento' onclick=\"toba_invocar_editor('frame_centro', '$url')\">";
		$salida .= toba_recurso::imagen_toba('objetos/editar.gif',true);
		$salida .= "</a>\n";
		$salida .= "</span>";		
		return $salida;
	}
	
	static function get_vinculo_pantalla($componente, $editor, $pantalla)
	{
		$opciones['celda_memoria'] = 'central';
		$opciones['prefijo'] = self::get_punto_acceso_editor();
		$opciones['validar'] = false;
		$parametros = array(apex_hilo_qs_zona=>implode(apex_qs_separador,$componente), 'pantalla' => $pantalla);
		$url = toba::vinculador()->get_url(self::get_id(),$editor,$parametros,$opciones);
		$salida = "<span class='div-editor' style='position:absolute'>";		
		$salida .= "<a href='#' title='Editar propiedades de la pantalla' onclick=\"toba_invocar_editor('frame_centro', '$url')\">";
		$salida .= toba_recurso::imagen_toba('objetos/editar.gif',true);
		$salida .= "</a>\n";
		$salida .= "</span>";		
		return $salida;		
	}
	
	static function get_utileria_editor_abrir_php($id_componente, $icono='reflexion/abrir.gif')
	{
		$parametros[apex_hilo_qs_zona] = $id_componente['proyecto'] . apex_qs_separador . $id_componente['componente'];
		$opciones = array('servicio' => 'ejecutar', 'zona' => false, 'celda_memoria' => 'ajax', 'menu' => true);
		$vinculo = toba::vinculador()->get_url(toba_editor::get_id(), "/admin/objetos/php", $parametros, $opciones);
		$js = "toba.comunicar_vinculo('$vinculo')";
		$ayuda = 'Abre la extensi�n PHP del componente en el editor del escritorio';
		return "<a href='#' title='$ayuda' onclick=\"$js\">".self::imagen_editor($icono, true)."</a>";
	}	
	
	static function imagen_editor($imagen,$html=false,$ancho=null, $alto=null,$tooltip=null,$mapa=null)
	{
		$src = toba_recurso::url_proyecto(self::get_id()) . "/img/" . $imagen;
		if ($html){
			return toba_recurso::imagen($src, $ancho, $alto, $tooltip, $mapa);
		}else{
			return $src;
		}
	}
	
	//--------------------------------------------------------------------------
	// Abrir una fuente de datos del proyecto editado
	//--------------------------------------------------------------------------
	
	function db_proyecto_cargado($id_fuente)
	{
		$fuente_datos = toba_admin_fuentes::instancia()->get_fuente( $id_fuente,
																	 toba_editor::get_proyecto_cargado() );
		return $fuente_datos->get_db();		
	}
	
}
?>