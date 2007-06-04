<?php

class toba_mc_item__1000104
{
	static function get_metadatos()
	{
		return array (
  'basica' => 
  array (
    'item_proyecto' => 'toba_editor',
    'item' => '1000104',
    'item_nombre' => 'Ordenar Items',
    'item_descripcion' => NULL,
    'item_act_buffer_proyecto' => NULL,
    'item_act_buffer' => NULL,
    'item_act_patron_proyecto' => NULL,
    'item_act_patron' => NULL,
    'item_act_accion_script' => NULL,
    'item_solic_tipo' => 'web',
    'item_solic_registrar' => 0,
    'item_solic_obs_tipo_proyecto' => NULL,
    'item_solic_obs_tipo' => NULL,
    'item_solic_observacion' => NULL,
    'item_solic_cronometrar' => NULL,
    'item_parametro_a' => NULL,
    'item_parametro_b' => NULL,
    'item_parametro_c' => NULL,
    'item_imagen_recurso_origen' => 'apex',
    'item_imagen' => 'ordenar.gif',
    'tipo_pagina_clase' => 'toba_tp_basico_titulo',
    'tipo_pagina_archivo' => '',
    'item_include_arriba' => NULL,
    'item_include_abajo' => NULL,
    'item_zona_proyecto' => 'toba_editor',
    'item_zona' => 'zona_carpeta',
    'item_zona_archivo' => 'zona/zona_carpeta.php',
    'zona_cons_archivo' => NULL,
    'zona_cons_clase' => NULL,
    'zona_cons_metodo' => NULL,
    'item_publico' => 0,
    'item_existe_ayuda' => NULL,
    'carpeta' => 0,
    'menu' => 0,
    'orden' => '3',
    'publico' => 0,
    'redirecciona' => 0,
    'crono' => NULL,
    'solicitud_tipo' => 'web',
    'item_padre' => '/items',
    'cant_dependencias' => '1',
    'cant_items_hijos' => '0',
  ),
  'objetos' => 
  array (
    0 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1000243,
      'objeto_nombre' => 'Ordenar Items',
      'objeto_subclase' => 'ci_orden_items',
      'objeto_subclase_archivo' => 'editores/editor_item/ci_orden_items.php',
      'orden' => 0,
      'clase_proyecto' => 'toba',
      'clase' => 'toba_ci',
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

class toba_mc_comp__1000243
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1000243,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'toba_ci',
    'subclase' => 'ci_orden_items',
    'subclase_archivo' => 'editores/editor_item/ci_orden_items.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'Ordenar Items',
    'titulo' => NULL,
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
    'creacion' => '2007-04-18 09:55:04',
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
    'cant_dependencias' => '2',
  ),
  '_info_eventos' => 
  array (
    0 => 
    array (
      'identificador' => 'procesar',
      'etiqueta' => '&Guardar',
      'maneja_datos' => 1,
      'sobre_fila' => NULL,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'guardar.gif',
      'en_botonera' => 1,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => 0,
      'defecto' => 1,
      'grupo' => NULL,
      'accion' => NULL,
      'accion_imphtml_debug' => 0,
      'accion_vinculo_carpeta' => NULL,
      'accion_vinculo_item' => NULL,
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
    'ancho' => '400px',
    'alto' => NULL,
    'posicion_botonera' => 'abajo',
    'tipo_navegacion' => NULL,
    'con_toc' => 0,
  ),
  '_info_ci_me_pantalla' => 
  array (
    0 => 
    array (
      'pantalla' => 1000144,
      'identificador' => 'pant_inicial',
      'etiqueta' => 'Pantalla Inicial',
      'descripcion' => 'Se puede determinar que items de esta carpeta se muestran en el men� del sistema, tambi�n es posible determinar el orden en el cual lo hacen.',
      'tip' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => NULL,
      'objetos' => 'items',
      'eventos' => 'procesar',
      'orden' => 1,
      'subclase' => NULL,
      'subclase_archivo' => NULL,
    ),
  ),
  '_info_dependencias' => 
  array (
    0 => 
    array (
      'identificador' => 'datos',
      'proyecto' => 'toba_editor',
      'objeto' => 1553,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
    1 => 
    array (
      'identificador' => 'items',
      'proyecto' => 'toba_editor',
      'objeto' => 1000244,
      'clase' => 'toba_ei_formulario_ml',
      'clase_archivo' => 'nucleo/componentes/interface/toba_ei_formulario_ml.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
  ),
);
	}

}

class toba_mc_comp__1553
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1553,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'toba_datos_tabla',
    'subclase' => NULL,
    'subclase_archivo' => NULL,
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'ITEM - BASE',
    'titulo' => NULL,
    'colapsable' => NULL,
    'descripcion' => NULL,
    'fuente_proyecto' => 'toba_editor',
    'fuente' => 'instancia',
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
    'creacion' => '2005-09-06 16:20:26',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/db_registros',
    'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/db_registros',
    'clase_icono' => 'objetos/datos_tabla.gif',
    'clase_descripcion_corta' => 'datos_tabla',
    'clase_instanciador_proyecto' => NULL,
    'clase_instanciador_item' => NULL,
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => NULL,
    'ap_archivo' => NULL,
    'cant_dependencias' => '0',
  ),
  '_info_estructura' => 
  array (
    'tabla' => 'apex_item',
    'alias' => NULL,
    'min_registros' => NULL,
    'max_registros' => NULL,
    'ap' => 1,
    'ap_sub_clase' => NULL,
    'ap_sub_clase_archivo' => NULL,
    'ap_modificar_claves' => 0,
    'ap_clase' => 'ap_tabla_db_s',
    'ap_clase_archivo' => 'nucleo/componentes/persistencia/toba_ap_tabla_db_s.php',
  ),
  '_info_columnas' => 
  array (
    0 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 229,
      'columna' => 'proyecto',
      'tipo' => 'C',
      'pk' => 1,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    1 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 230,
      'columna' => 'item',
      'tipo' => 'C',
      'pk' => 1,
      'secuencia' => 'apex_item_seq',
      'largo' => 60,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    2 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 231,
      'columna' => 'padre_id',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    3 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 232,
      'columna' => 'padre_proyecto',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    4 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 233,
      'columna' => 'padre',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 60,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    5 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 234,
      'columna' => 'carpeta',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    6 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 235,
      'columna' => 'nivel_acceso',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    7 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 236,
      'columna' => 'solicitud_tipo',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 20,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    8 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 237,
      'columna' => 'pagina_tipo_proyecto',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    9 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 238,
      'columna' => 'pagina_tipo',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 20,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    10 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 239,
      'columna' => 'nombre',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 80,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    11 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 240,
      'columna' => 'descripcion',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 255,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    12 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 241,
      'columna' => 'actividad_buffer_proyecto',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    13 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 242,
      'columna' => 'actividad_buffer',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    14 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 243,
      'columna' => 'actividad_patron_proyecto',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    15 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 244,
      'columna' => 'actividad_patron',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 20,
      'no_nulo' => NULL,
      'no_nulo_db' => 1,
      'externa' => 0,
    ),
    16 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 245,
      'columna' => 'actividad_accion',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 80,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    17 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 246,
      'columna' => 'menu',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    18 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 247,
      'columna' => 'orden',
      'tipo' => 'N',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    19 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 248,
      'columna' => 'solicitud_registrar',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    20 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 249,
      'columna' => 'solicitud_obs_tipo_proyecto',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    21 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 250,
      'columna' => 'solicitud_obs_tipo',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 20,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    22 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 251,
      'columna' => 'solicitud_observacion',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 90,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    23 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 252,
      'columna' => 'solicitud_registrar_cron',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    24 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 253,
      'columna' => 'prueba_directorios',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    25 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 254,
      'columna' => 'zona_proyecto',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 15,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    26 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 255,
      'columna' => 'zona',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 20,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    27 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 256,
      'columna' => 'zona_orden',
      'tipo' => 'N',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    28 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 257,
      'columna' => 'zona_listar',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    29 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 258,
      'columna' => 'imagen_recurso_origen',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 10,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    30 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 259,
      'columna' => 'imagen',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 60,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    31 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 260,
      'columna' => 'parametro_a',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 100,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    32 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 261,
      'columna' => 'parametro_b',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 100,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    33 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 262,
      'columna' => 'parametro_c',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 100,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    34 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 263,
      'columna' => 'publico',
      'tipo' => 'E',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    35 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 264,
      'columna' => 'usuario',
      'tipo' => 'C',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => 20,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    36 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 265,
      'columna' => 'creacion',
      'tipo' => 'T',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
    37 => 
    array (
      'objeto_proyecto' => 'toba_editor',
      'objeto' => 1553,
      'col_id' => 460,
      'columna' => 'redirecciona',
      'tipo' => 'N',
      'pk' => 0,
      'secuencia' => NULL,
      'largo' => NULL,
      'no_nulo' => NULL,
      'no_nulo_db' => 0,
      'externa' => 0,
    ),
  ),
  '_info_externas' => 
  array (
  ),
  '_info_externas_col' => 
  array (
  ),
  '_info_valores_unicos' => 
  array (
  ),
);
	}

}

class toba_mc_comp__1000244
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1000244,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'toba_ei_formulario_ml',
    'subclase' => NULL,
    'subclase_archivo' => NULL,
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'Ordenar Items - pant_inicial - items',
    'titulo' => NULL,
    'colapsable' => 0,
    'descripcion' => NULL,
    'fuente_proyecto' => 'toba_editor',
    'fuente' => 'instancia',
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
    'creacion' => '2007-04-18 09:56:07',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/ei_formulario_ml',
    'clase_archivo' => 'nucleo/componentes/interface/toba_ei_formulario_ml.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/ei_formulario_ml',
    'clase_icono' => 'objetos/ut_formulario_ml.gif',
    'clase_descripcion_corta' => 'ei_formulario_ml',
    'clase_instanciador_proyecto' => 'toba_editor',
    'clase_instanciador_item' => '1842',
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => NULL,
    'ap_archivo' => NULL,
    'cant_dependencias' => '0',
  ),
  '_info_eventos' => 
  array (
    0 => 
    array (
      'identificador' => 'modificacion',
      'etiqueta' => '&Modificacion',
      'maneja_datos' => 1,
      'sobre_fila' => 0,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => NULL,
      'en_botonera' => 0,
      'ayuda' => NULL,
      'ci_predep' => NULL,
      'implicito' => 1,
      'defecto' => 0,
      'grupo' => NULL,
      'accion' => NULL,
      'accion_imphtml_debug' => NULL,
      'accion_vinculo_carpeta' => NULL,
      'accion_vinculo_item' => NULL,
      'accion_vinculo_objeto' => NULL,
      'accion_vinculo_popup' => NULL,
      'accion_vinculo_popup_param' => NULL,
      'accion_vinculo_celda' => NULL,
      'accion_vinculo_target' => NULL,
    ),
  ),
  '_info_puntos_control' => 
  array (
  ),
  '_info_formulario' => 
  array (
    'auto_reset' => NULL,
    'scroll' => 0,
    'ancho' => '400px',
    'alto' => NULL,
    'filas' => NULL,
    'filas_agregar' => 0,
    'filas_agregar_online' => 1,
    'filas_ordenar' => 1,
    'filas_numerar' => 1,
    'columna_orden' => 'orden',
    'analisis_cambios' => 'LINEA',
  ),
  '_info_formulario_ef' => 
  array (
    0 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1000244,
      'objeto_ei_formulario_fila' => 1000349,
      'identificador' => 'imagen',
      'elemento_formulario' => 'ef_fijo',
      'columnas' => 'imagen',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '1',
      'etiqueta' => NULL,
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => NULL,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => NULL,
    ),
    1 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1000244,
      'objeto_ei_formulario_fila' => 1000347,
      'identificador' => 'nombre',
      'elemento_formulario' => 'ef_fijo',
      'columnas' => 'nombre',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '2',
      'etiqueta' => 'Items',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => 0,
      'desactivado' => 0,
      'estilo' => NULL,
      'total' => 0,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => 0,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => 0,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => NULL,
    ),
    2 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1000244,
      'objeto_ei_formulario_fila' => 1000348,
      'identificador' => 'menu',
      'elemento_formulario' => 'ef_checkbox',
      'columnas' => 'menu',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '3',
      'etiqueta' => 'En men�',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => NULL,
      'desactivado' => NULL,
      'estilo' => NULL,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => NULL,
      'carga_metodo' => NULL,
      'carga_clase' => NULL,
      'carga_include' => NULL,
      'carga_col_clave' => NULL,
      'carga_col_desc' => NULL,
      'carga_sql' => NULL,
      'carga_fuente' => NULL,
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => NULL,
      'carga_no_seteado' => NULL,
      'edit_tamano' => NULL,
      'edit_maximo' => NULL,
      'edit_mascara' => NULL,
      'edit_unidad' => NULL,
      'edit_rango' => NULL,
      'edit_filas' => NULL,
      'edit_columnas' => NULL,
      'edit_wrap' => NULL,
      'edit_resaltar' => NULL,
      'edit_ajustable' => NULL,
      'edit_confirmar_clave' => NULL,
      'popup_item' => NULL,
      'popup_proyecto' => NULL,
      'popup_editable' => NULL,
      'popup_ventana' => NULL,
      'popup_carga_desc_metodo' => NULL,
      'popup_carga_desc_clase' => NULL,
      'popup_carga_desc_include' => NULL,
      'fieldset_fin' => NULL,
      'check_valor_si' => NULL,
      'check_valor_no' => NULL,
      'check_desc_si' => NULL,
      'check_desc_no' => NULL,
      'fijo_sin_estado' => NULL,
      'editor_ancho' => NULL,
      'editor_alto' => NULL,
      'editor_botonera' => NULL,
      'selec_cant_minima' => NULL,
      'selec_cant_maxima' => NULL,
      'selec_utilidades' => NULL,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => NULL,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
      'columna_estilo' => NULL,
    ),
  ),
);
	}

}

?>