<?

class php_244
{
	static function get_metadatos()
	{
		return array (
  'info' => 
  array (
    'proyecto' => 'toba',
    'objeto' => '244',
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_cuadro',
    'subclase' => NULL,
    'subclase_archivo' => NULL,
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'DATOS - Listado de TABLAS',
    'titulo' => 'Tablas existentes',
    'colapsable' => NULL,
    'descripcion' => 'Tablas existentes en el sistema',
    'fuente_proyecto' => 'toba',
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
    'creacion' => '2004-03-07 19:36:47',
    'clase_editor_proyecto' => 'toba',
    'clase_editor_item' => '/admin/objetos/editores/cuadro',
    'clase_archivo' => 'nucleo/browser/clases/objeto_cuadro.php',
    'clase_vinculos' => '1',
    'clase_editor' => '/admin/objetos/editores/cuadro',
    'clase_icono' => 'objetos/cuadro.gif',
    'clase_descripcion_corta' => 'CUADRO',
    'clase_instanciador_proyecto' => 'toba',
    'clase_instanciador_item' => '/admin/objetos/instanciadores/cuadro',
    'objeto_existe_ayuda' => NULL,
  ),
  'info_cuadro' => 
  array (
    'titulo' => 'Tablas existentes',
    'subtitulo' => NULL,
    'sql' => 'SELECT   proyecto,
tabla,
script,
orden,
version,
historica,
dump
FROM %f% apex_mod_datos_tabla
%w%
ORDER BY orden;',
    'columnas_clave' => 'proyecto, tabla',
    'archivos_callbacks' => 'cc',
    'ancho' => '600',
    'ordenar' => '1',
    'exportar_xls' => '1',
    'exportar_pdf' => '1',
    'paginar' => '1',
    'tamano_pagina' => '35',
    'eof_invisible' => NULL,
    'eof_customizado' => NULL,
    'pdf_respetar_paginacion' => NULL,
    'pdf_propiedades' => 'fontSize: 10;
width: 400;',
    'asociacion_columnas' => NULL,
  ),
  'info_cuadro_columna' => 
  array (
    0 => 
    array (
      'orden' => '0',
      'titulo' => 'orden',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'orden',
      'valor_sql_formato' => NULL,
      'valor_fijo' => NULL,
      'valor_proceso' => NULL,
      'valor_proceso_parametros' => NULL,
      'vinculo_indice' => NULL,
      'par_dimension_proyecto' => NULL,
      'par_dimension' => NULL,
      'par_tabla' => NULL,
      'par_columna' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
    ),
    1 => 
    array (
      'orden' => '1',
      'titulo' => 'Proyecto',
      'estilo' => 'col-tex-p1',
      'ancho' => NULL,
      'valor_sql' => 'proyecto',
      'valor_sql_formato' => NULL,
      'valor_fijo' => NULL,
      'valor_proceso' => NULL,
      'valor_proceso_parametros' => NULL,
      'vinculo_indice' => NULL,
      'par_dimension_proyecto' => NULL,
      'par_dimension' => NULL,
      'par_tabla' => NULL,
      'par_columna' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
    ),
    2 => 
    array (
      'orden' => '2',
      'titulo' => 'Tabla',
      'estilo' => 'col-tex-p2',
      'ancho' => NULL,
      'valor_sql' => 'tabla',
      'valor_sql_formato' => NULL,
      'valor_fijo' => NULL,
      'valor_proceso' => NULL,
      'valor_proceso_parametros' => NULL,
      'vinculo_indice' => NULL,
      'par_dimension_proyecto' => NULL,
      'par_dimension' => NULL,
      'par_tabla' => NULL,
      'par_columna' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
    ),
    3 => 
    array (
      'orden' => '3',
      'titulo' => 'Archivo SQL',
      'estilo' => 'col-tex-p1',
      'ancho' => NULL,
      'valor_sql' => 'script',
      'valor_sql_formato' => NULL,
      'valor_fijo' => NULL,
      'valor_proceso' => NULL,
      'valor_proceso_parametros' => NULL,
      'vinculo_indice' => NULL,
      'par_dimension_proyecto' => NULL,
      'par_dimension' => NULL,
      'par_tabla' => NULL,
      'par_columna' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
    ),
    4 => 
    array (
      'orden' => '5',
      'titulo' => 'Ed',
      'estilo' => 'col-tex-p3',
      'ancho' => NULL,
      'valor_sql' => NULL,
      'valor_sql_formato' => NULL,
      'valor_fijo' => 'Hola!',
      'valor_proceso' => NULL,
      'valor_proceso_parametros' => NULL,
      'vinculo_indice' => 'columna',
      'par_dimension_proyecto' => NULL,
      'par_dimension' => NULL,
      'par_tabla' => NULL,
      'par_columna' => NULL,
      'no_ordenar' => NULL,
      'mostrar_xls' => NULL,
      'mostrar_pdf' => NULL,
      'pdf_propiedades' => NULL,
      'total' => NULL,
    ),
  ),
);
	}

}
?>