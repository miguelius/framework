<?php

class toba_mc_comp__1850
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1850,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'toba_ei_formulario',
    'subclase' => 'eiform_proyecto_conflogin',
    'subclase_archivo' => 'configuracion/eiform_proyecto_conflogin.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'Parametros Basicos - carga - form',
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
    'creacion' => '2006-08-07 17:20:35',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/ei_formulario',
    'clase_archivo' => 'nucleo/componentes/interface/toba_ei_formulario.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/ei_formulario',
    'clase_icono' => 'objetos/ut_formulario.gif',
    'clase_descripcion_corta' => 'ei_formulario',
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
      'sobre_fila' => NULL,
      'confirmacion' => NULL,
      'estilo' => NULL,
      'imagen_recurso_origen' => NULL,
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
    'ancho' => NULL,
    'ancho_etiqueta' => '200px',
  ),
  '_info_formulario_ef' => 
  array (
    0 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4665,
      'identificador' => 'requiere_validacion',
      'elemento_formulario' => 'ef_checkbox',
      'columnas' => 'requiere_validacion',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '1',
      'etiqueta' => 'Requiere autentificaci�n',
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
      'check_valor_si' => '1',
      'check_valor_no' => '0',
      'check_desc_si' => 'S�',
      'check_desc_no' => 'No',
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
    ),
    1 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4666,
      'identificador' => 'usuario_anonimo',
      'elemento_formulario' => 'ef_editable',
      'columnas' => 'usuario_anonimo',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '2',
      'etiqueta' => 'ID Usuario an�nimo',
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
    ),
    2 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4775,
      'identificador' => 'usuario_anonimo_desc',
      'elemento_formulario' => 'ef_editable',
      'columnas' => 'usuario_anonimo_desc',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '3',
      'etiqueta' => 'Nombre usuario an�nimo',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => 0,
      'desactivado' => 0,
      'estilo' => NULL,
      'total' => NULL,
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
      'edit_tamano' => 40,
      'edit_maximo' => 60,
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
    ),
    3 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4776,
      'identificador' => 'usuario_anonimo_grupos_acc',
      'elemento_formulario' => 'ef_multi_seleccion_lista',
      'columnas' => 'usuario_anonimo_grupos_acc',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '4',
      'etiqueta' => 'Grupo de Acceso an�nimo',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => 0,
      'desactivado' => 0,
      'estilo' => NULL,
      'total' => NULL,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => 0,
      'carga_metodo' => 'get_grupos_acceso',
      'carga_clase' => 'toba_info_permisos',
      'carga_include' => 'modelo/info/toba_info_permisos.php',
      'carga_col_clave' => 'usuario_grupo_acc',
      'carga_col_desc' => 'nombre',
      'carga_sql' => NULL,
      'carga_fuente' => 'instancia',
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => 0,
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
      'selec_utilidades' => 0,
      'selec_tamano' => NULL,
      'selec_ancho' => NULL,
      'selec_serializar' => 1,
      'selec_cant_columnas' => NULL,
      'upload_extensiones' => NULL,
    ),
    4 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4669,
      'identificador' => 'validacion_debug',
      'elemento_formulario' => 'ef_checkbox',
      'columnas' => 'validacion_debug',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '5',
      'etiqueta' => 'Autentificaci�n debug',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Simplifica el logueo al sistema durante el desarrollo.',
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
      'check_valor_si' => '1',
      'check_valor_no' => '0',
      'check_desc_si' => 'S�',
      'check_desc_no' => 'No',
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
    ),
    5 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4667,
      'identificador' => 'validacion_intentos',
      'elemento_formulario' => 'ef_editable_numero',
      'columnas' => 'validacion_intentos',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '6',
      'etiqueta' => 'Autentificaci�n intentos',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Intentos de login antes de bloquear la IP (Este parametro funciona en conjunto con el siguiente)',
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
    ),
    6 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4668,
      'identificador' => 'validacion_intentos_min',
      'elemento_formulario' => 'ef_editable_numero',
      'columnas' => 'validacion_intentos_min',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '7',
      'etiqueta' => 'Autentificaci�n tiempo intent.',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Ventana temporal en la cual se considera al conjunto de intentos como invalidos. (Este parametro funciona en conjunto con el precedente)',
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
      'edit_unidad' => 'minutos',
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
    ),
    7 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4670,
      'identificador' => 'sesion_tiempo_no_interac_min',
      'elemento_formulario' => 'ef_editable_numero',
      'columnas' => 'sesion_tiempo_no_interac_min',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '8',
      'etiqueta' => 'Sesi�n - Tope no interaccion',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Tiempo de no interaccion cliente/servidor maximo. Si se supera esta ventana se elimina la sesion.',
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
      'edit_unidad' => 'minutos',
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
    ),
    8 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4671,
      'identificador' => 'sesion_tiempo_maximo_min',
      'elemento_formulario' => 'ef_editable_numero',
      'columnas' => 'sesion_tiempo_maximo_min',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '9',
      'etiqueta' => 'Sesi�n - Duracion m�xima',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Tiempo m�ximo que puede durar una sesi�n teniendo o no interacci�n el usuario. Generalmente este l�mite no es un requisito.',
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
      'edit_unidad' => 'minutos',
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
    ),
    9 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 1000247,
      'identificador' => 'sep_item_login',
      'elemento_formulario' => 'ef_barra_divisora',
      'columnas' => 'sep_item_login',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '10',
      'etiqueta' => 'Operaci�n de autentificaci�n',
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
    ),
    10 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4717,
      'identificador' => 'carpeta_pre_sesion',
      'elemento_formulario' => 'ef_combo',
      'columnas' => 'carpeta_pre_sesion',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '11',
      'etiqueta' => 'Carpeta',
      'etiqueta_estilo' => NULL,
      'descripcion' => NULL,
      'colapsado' => 0,
      'desactivado' => 0,
      'estilo' => NULL,
      'total' => 0,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => 0,
      'carga_metodo' => 'get_carpetas_posibles',
      'carga_clase' => 'toba_info_editores',
      'carga_include' => 'modelo/info/toba_info_editores.php',
      'carga_col_clave' => 'id',
      'carga_col_desc' => 'nombre',
      'carga_sql' => NULL,
      'carga_fuente' => 'instancia',
      'carga_lista' => NULL,
      'carga_maestros' => NULL,
      'carga_cascada_relaj' => 0,
      'carga_no_seteado' => '-- SELECCIONAR --',
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
    ),
    11 => 
    array (
      'objeto_ei_formulario_proyecto' => 'toba_editor',
      'objeto_ei_formulario' => 1850,
      'objeto_ei_formulario_fila' => 4681,
      'identificador' => 'item_pre_sesion',
      'elemento_formulario' => 'ef_combo',
      'columnas' => 'item_pre_sesion',
      'obligatorio' => 0,
      'oculto_relaja_obligatorio' => 0,
      'orden' => '12',
      'etiqueta' => 'Item de autentificaci�n',
      'etiqueta_estilo' => NULL,
      'descripcion' => 'Item a mostrar cuando todavia no existe una sesion (Este item debe ser PUBLICO).',
      'colapsado' => 0,
      'desactivado' => 0,
      'estilo' => NULL,
      'total' => 0,
      'inicializacion' => NULL,
      'estado_defecto' => NULL,
      'solo_lectura' => 0,
      'carga_metodo' => 'get_items_carpeta',
      'carga_clase' => 'toba_info_editores',
      'carga_include' => 'modelo/info/toba_info_editores.php',
      'carga_col_clave' => 'id',
      'carga_col_desc' => 'descripcion',
      'carga_sql' => NULL,
      'carga_fuente' => 'instancia',
      'carga_lista' => NULL,
      'carga_maestros' => 'carpeta_pre_sesion',
      'carga_cascada_relaj' => 0,
      'carga_no_seteado' => '-- SELECCIONAR --',
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
    ),
  ),
);
	}

}

?>