<?php

class toba_mc_item__5000003
{
	static function get_metadatos()
	{
		return array (
  'basica' => 
  array (
    'item_proyecto' => 'toba_referencia',
    'item' => '5000003',
    'item_nombre' => 'Control en runtime',
    'item_descripcion' => NULL,
    'item_act_buffer_proyecto' => 'toba',
    'item_act_buffer' => 0,
    'item_act_patron_proyecto' => 'toba',
    'item_act_patron' => 'CI',
    'item_act_accion_script' => '',
    'item_solic_tipo' => 'web',
    'item_solic_registrar' => 0,
    'item_solic_obs_tipo_proyecto' => NULL,
    'item_solic_obs_tipo' => NULL,
    'item_solic_observacion' => NULL,
    'item_solic_cronometrar' => 0,
    'item_parametro_a' => NULL,
    'item_parametro_b' => NULL,
    'item_parametro_c' => NULL,
    'item_imagen_recurso_origen' => NULL,
    'item_imagen' => NULL,
    'tipo_pagina_clase' => 'tp_referencia',
    'tipo_pagina_archivo' => 'tp_referencia.php',
    'item_include_arriba' => NULL,
    'item_include_abajo' => NULL,
    'item_zona_proyecto' => NULL,
    'item_zona' => NULL,
    'item_zona_archivo' => NULL,
    'zona_cons_archivo' => NULL,
    'zona_cons_clase' => NULL,
    'zona_cons_metodo' => NULL,
    'item_publico' => 0,
    'item_existe_ayuda' => NULL,
    'carpeta' => 0,
    'menu' => 1,
    'orden' => '0',
    'publico' => 0,
    'redirecciona' => 0,
    'crono' => 0,
    'solicitud_tipo' => 'web',
    'item_padre' => '/mensajes/vinculos',
    'cant_dependencias' => '1',
    'cant_items_hijos' => '0',
  ),
  'objetos' => 
  array (
    0 => 
    array (
      'objeto_proyecto' => 'toba_referencia',
      'objeto' => 5000001,
      'objeto_nombre' => 'origen',
      'objeto_subclase' => 'ci_origen',
      'objeto_subclase_archivo' => 'componentes/eventos/vinculos/ci_origen.php',
      'orden' => 0,
      'clase_proyecto' => 'toba',
      'clase' => 'objeto_ci',
      'clase_archivo' => 'nucleo/componentes/interface/toba_ci.php',
      'fuente_proyecto' => NULL,
      'fuente' => NULL,
      'fuente_motor' => NULL,
      'fuente_host' => NULL,
      'fuente_usuario' => NULL,
      'fuente_clave' => NULL,
      'fuente_base' => NULL,
    ),
  ),
);
	}

}

class toba_mc_comp__5000001
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_referencia',
    'objeto' => 5000001,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_ci',
    'subclase' => 'ci_origen',
    'subclase_archivo' => 'componentes/eventos/vinculos/ci_origen.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'origen',
    'titulo' => 'CI',
    'colapsable' => 0,
    'descripcion' => NULL,
    'fuente_proyecto' => NULL,
    'fuente' => NULL,
    'solicitud_registrar' => NULL,
    'solicitud_obj_obs_tipo' => NULL,
    'solicitud_obj_observacion' => NULL,
    'parametro_a' => NULL,
    'parametro_b' => NULL,
    'parametro_c' => NULL,
    'parametro_d' => NULL,
    'parametro_e' => NULL,
    'parametro_f' => NULL,
    'usuario' => NULL,
    'creacion' => '2006-04-18 17:31:27',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/ci',
    'clase_archivo' => 'nucleo/componentes/interface/toba_ci.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/ci',
    'clase_icono' => 'objetos/multi_etapa.gif',
    'clase_descripcion_corta' => 'ci',
    'clase_instanciador_proyecto' => 'toba_editor',
    'clase_instanciador_item' => '1642',
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => NULL,
    'ap_archivo' => NULL,
    'cant_dependencias' => '1',
  ),
  '_info_eventos' => 
  array (
    0 => 
    array (
      'identificador' => 'abrir_en_popup',
      'etiqueta' => 'Abrir en Popup (redefindo en JS)',
      'maneja_datos' => 0,
      'sobre_fila' => NULL,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'doc.gif',
      'en_botonera' => 1,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => 0,
      'defecto' => 0,
      'grupo' => NULL,
      'accion' => 'V',
      'accion_imphtml_debug' => 0,
      'accion_vinculo_carpeta' => '/mensajes/vinculos',
      'accion_vinculo_item' => '3310',
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => 1,
      'accion_vinculo_popup_param' => 'width: 400px, height: 500px, scrollbars: 1, resizable: 1',
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
    1 => 
    array (
      'identificador' => 'abrir_en_ventana',
      'etiqueta' => 'Abrir Item aca  (redefinido en PHP)',
      'maneja_datos' => 0,
      'sobre_fila' => NULL,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'doc.gif',
      'en_botonera' => 1,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => 0,
      'defecto' => 0,
      'grupo' => NULL,
      'accion' => 'V',
      'accion_imphtml_debug' => 0,
      'accion_vinculo_carpeta' => '/mensajes/vinculos',
      'accion_vinculo_item' => '5000005',
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => 0,
      'accion_vinculo_popup_param' => NULL,
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
  ),
  '_info_puntos_control' => 
  array (
  ),
  '_info_ci' => 
  array (
    'ev_procesar_etiq' => NULL,
    'ev_cancelar_etiq' => NULL,
    'objetos' => NULL,
    'ancho' => '500px',
    'alto' => '300px',
    'posicion_botonera' => 'abajo',
    'tipo_navegacion' => NULL,
    'con_toc' => 0,
  ),
  '_info_ci_me_pantalla' => 
  array (
    0 => 
    array (
      'pantalla' => 5000001,
      'identificador' => 'origen',
      'etiqueta' => 'origen',
      'descripcion' => 'En esta pantalla hay pruebas de distintos tipos de vinculos. Los que estan abajo estan directamente asociados al CI, los demas en el ei_cuadro.',
      'tip' => NULL,
      'imagen_recurso_origen' => NULL,
      'imagen' => NULL,
      'objetos' => 'cuadro',
      'eventos' => 'abrir_en_popup,abrir_en_ventana',
      'orden' => 1,
      'subclase' => NULL,
      'subclase_archivo' => NULL,
    ),
  ),
  '_info_dependencias' => 
  array (
    0 => 
    array (
      'identificador' => 'cuadro',
      'proyecto' => 'toba_referencia',
      'objeto' => 5000004,
      'clase' => 'objeto_ei_cuadro',
      'clase_archivo' => 'nucleo/componentes/interface/toba_ei_cuadro.php',
      'subclase' => 'cuadro_origen',
      'subclase_archivo' => 'componentes/eventos/vinculos/cuadro_origen.php',
      'fuente' => NULL,
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
  ),
);
	}

}

class toba_mc_comp__5000004
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_referencia',
    'objeto' => 5000004,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_ei_cuadro',
    'subclase' => 'cuadro_origen',
    'subclase_archivo' => 'componentes/eventos/vinculos/cuadro_origen.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'vinculos',
    'titulo' => 'Cuadro',
    'colapsable' => 0,
    'descripcion' => NULL,
    'fuente_proyecto' => NULL,
    'fuente' => NULL,
    'solicitud_registrar' => NULL,
    'solicitud_obj_obs_tipo' => NULL,
    'solicitud_obj_observacion' => NULL,
    'parametro_a' => NULL,
    'parametro_b' => NULL,
    'parametro_c' => NULL,
    'parametro_d' => NULL,
    'parametro_e' => NULL,
    'parametro_f' => NULL,
    'usuario' => NULL,
    'creacion' => '2006-04-19 04:15:20',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/ei_cuadro',
    'clase_archivo' => 'nucleo/componentes/interface/toba_ei_cuadro.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/ei_cuadro',
    'clase_icono' => 'objetos/cuadro_array.gif',
    'clase_descripcion_corta' => 'ei_cuadro',
    'clase_instanciador_proyecto' => 'toba_editor',
    'clase_instanciador_item' => '1843',
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => NULL,
    'ap_archivo' => NULL,
    'cant_dependencias' => '0',
  ),
  '_info_eventos' => 
  array (
    0 => 
    array (
      'identificador' => 'en_fila_redefinido',
      'etiqueta' => 'Vinculo redefinido en PHP',
      'maneja_datos' => NULL,
      'sobre_fila' => 1,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => NULL,
      'imagen' => NULL,
      'en_botonera' => 0,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => NULL,
      'grupo' => NULL,
      'accion' => 'V',
      'accion_imphtml_debug' => NULL,
      'accion_vinculo_carpeta' => '/mensajes/vinculos',
      'accion_vinculo_item' => '3310',
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => 1,
      'accion_vinculo_popup_param' => 'width: 400px, height: 500px, scrollbars: 1, resizable: 1',
      'accion_vinculo_celda' => 'popup',
      'accion_vinculo_target' => NULL,
    ),
    1 => 
    array (
      'identificador' => 'en_fila_normal',
      'etiqueta' => 'Vinculo NORMAL',
      'maneja_datos' => NULL,
      'sobre_fila' => 1,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => NULL,
      'imagen' => NULL,
      'en_botonera' => 0,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => NULL,
      'grupo' => NULL,
      'accion' => 'V',
      'accion_imphtml_debug' => NULL,
      'accion_vinculo_carpeta' => '/mensajes/vinculos',
      'accion_vinculo_item' => '3310',
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => 1,
      'accion_vinculo_popup_param' => 'width: 400px, height: 500px, scrollbars: 1, resizable: 1',
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
    2 => 
    array (
      'identificador' => 'en_botonera',
      'etiqueta' => 'Vinculo redefinido en PHP y JS',
      'maneja_datos' => NULL,
      'sobre_fila' => 0,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => NULL,
      'imagen' => NULL,
      'en_botonera' => 1,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => NULL,
      'grupo' => NULL,
      'accion' => 'V',
      'accion_imphtml_debug' => NULL,
      'accion_vinculo_carpeta' => '/mensajes/vinculos',
      'accion_vinculo_item' => '3310',
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => 1,
      'accion_vinculo_popup_param' => 'width: 400px, height: 500px, scrollbars: 1, resizable: 1',
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
  ),
  '_info_puntos_control' => 
  array (
  ),
  '_info_cuadro' => 
  array (
    'titulo' => NULL,
    'subtitulo' => NULL,
    'sql' => NULL,
    'columnas_clave' => 'id, id2',
    'clave_datos_tabla' => 0,
    'archivos_callbacks' => NULL,
    'ancho' => '100%',
    'ordenar' => 0,
    'exportar_xls' => 0,
    'exportar_pdf' => NULL,
    'paginar' => 0,
    'tamano_pagina' => NULL,
    'tipo_paginado' => NULL,
    'scroll' => 0,
    'alto' => NULL,
    'eof_invisible' => 0,
    'eof_customizado' => NULL,
    'pdf_respetar_paginacion' => NULL,
    'pdf_propiedades' => NULL,
    'asociacion_columnas' => NULL,
    'dao_nucleo_proyecto' => NULL,
    'dao_clase' => NULL,
    'dao_metodo' => NULL,
    'dao_parametros' => NULL,
    'dao_archivo' => '',
    'cc_modo' => 't',
    'cc_modo_anidado_colap' => 0,
    'cc_modo_anidado_totcol' => NULL,
    'cc_modo_anidado_totcua' => NULL,
  ),
  '_info_cuadro_columna' => 
  array (
    0 => 
    array (
      'orden' => '1',
      'titulo' => 'id',
      'estilo_titulo' => 'ei-cuadro-col-tit',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'clave' => 'id',
      'formateo' => NULL,
      'vinculo_indice' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
      'total_cc' => NULL,
    ),
    1 => 
    array (
      'orden' => '2',
      'titulo' => 'id2',
      'estilo_titulo' => NULL,
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'clave' => 'id2',
      'formateo' => NULL,
      'vinculo_indice' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
      'total_cc' => NULL,
    ),
    2 => 
    array (
      'orden' => '3',
      'titulo' => 'Descripcion',
      'estilo_titulo' => 'ei-cuadro-col-tit',
      'estilo' => 'col-tex-p1',
      'ancho' => NULL,
      'clave' => 'descripcion',
      'formateo' => NULL,
      'vinculo_indice' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
      'total_cc' => NULL,
    ),
  ),
  '_info_cuadro_cortes' => 
  array (
  ),
);
	}

}

?>