<?php

class toba_mc_comp__1310
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_referencia',
    'objeto' => 1310,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'toba_ei_cuadro',
    'subclase' => 'extension_cuadro',
    'subclase_archivo' => 'componentes/ei_filtro - ei_cuadro/extension_cuadro.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'Ejemplo de ei_cuadro',
    'titulo' => 'T�tulo del cuadro',
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
    'creacion' => '2005-06-06 15:43:31',
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
      'identificador' => 'seleccion',
      'etiqueta' => NULL,
      'maneja_datos' => 0,
      'sobre_fila' => 1,
      'confirmacion' => '',
      'estilo' => NULL,
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'doc.gif',
      'en_botonera' => 0,
      'ayuda' => 'Seleccionar la fila',
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => NULL,
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
    1 => 
    array (
      'identificador' => 'baja',
      'etiqueta' => NULL,
      'maneja_datos' => 0,
      'sobre_fila' => 1,
      'confirmacion' => '�Est� seguro que desea ELIMINAR la fila?',
      'estilo' => 'estilo-evento-cuadro',
      'imagen_recurso_origen' => 'apex',
      'imagen' => 'borrar.gif',
      'en_botonera' => 0,
      'ayuda' => 'Borra el contenido de la fila actual',
      'ci_predep' => NULL,
      'implicito' => NULL,
      'defecto' => NULL,
      'grupo' => NULL,
      'accion' => NULL,
      'accion_imphtml_debug' => NULL,
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
  '_info_cuadro' => 
  array (
    'titulo' => 'ei_cuadro',
    'subtitulo' => NULL,
    'sql' => NULL,
    'columnas_clave' => 'fecha',
    'clave_datos_tabla' => 0,
    'archivos_callbacks' => NULL,
    'ancho' => '400px',
    'ordenar' => 1,
    'exportar_xls' => 0,
    'exportar_pdf' => NULL,
    'paginar' => 0,
    'tamano_pagina' => 3,
    'tipo_paginado' => 'P',
    'scroll' => 0,
    'alto' => NULL,
    'eof_invisible' => 0,
    'eof_customizado' => 'Este mensaje se muestra cuando no hay ning�n dato cargado.',
    'pdf_respetar_paginacion' => NULL,
    'pdf_propiedades' => NULL,
    'asociacion_columnas' => NULL,
    'dao_nucleo_proyecto' => 'toba_referencia',
    'dao_clase' => 'dao_importes',
    'dao_metodo' => 'get_importes',
    'dao_parametros' => NULL,
    'dao_archivo' => '',
    'cc_modo' => NULL,
    'cc_modo_anidado_colap' => NULL,
    'cc_modo_anidado_totcol' => NULL,
    'cc_modo_anidado_totcua' => NULL,
  ),
  '_info_cuadro_columna' => 
  array (
    0 => 
    array (
      'orden' => '1',
      'titulo' => 'Fecha',
      'estilo_titulo' => 'ei-cuadro-col-tit',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'clave' => 'fecha',
      'formateo' => 'fecha',
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
      'vinculo_indice' => NULL,
      'usar_vinculo' => NULL,
      'vinculo_carpeta' => NULL,
      'vinculo_item' => NULL,
      'total_cc' => NULL,
      'vinculo_target' => NULL,
      'vinculo_celda' => NULL,
      'vinculo_popup' => NULL,
      'vinculo_popup_param' => NULL,
    ),
    1 => 
    array (
      'orden' => '2',
      'titulo' => 'Importe',
      'estilo_titulo' => NULL,
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'clave' => 'importe',
      'formateo' => 'moneda',
      'no_ordenar' => 0,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => 1,
      'vinculo_indice' => NULL,
      'usar_vinculo' => NULL,
      'vinculo_carpeta' => NULL,
      'vinculo_item' => NULL,
      'total_cc' => NULL,
      'vinculo_target' => NULL,
      'vinculo_celda' => NULL,
      'vinculo_popup' => NULL,
      'vinculo_popup_param' => NULL,
    ),
  ),
  '_info_cuadro_cortes' => 
  array (
  ),
);
	}

}

?>