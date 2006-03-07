<?

class php_448
{
	static function get_metadatos()
	{
		return array (
  'info' => 
  array (
    'proyecto' => 'toba',
    'objeto' => '448',
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_cuadro_reg',
    'subclase' => NULL,
    'subclase_archivo' => NULL,
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'AUDITORIA - Solicitudes WDDX - Detalle',
    'titulo' => 'Solicitudes WDDX',
    'colapsable' => NULL,
    'descripcion' => NULL,
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
    'creacion' => '2004-06-30 15:30:42',
    'clase_editor_proyecto' => 'toba',
    'clase_editor_item' => '/admin/objetos/editores/cuadro_reg',
    'clase_archivo' => 'nucleo/browser/clases/objeto_cuadro_reg.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos/editores/cuadro_reg',
    'clase_icono' => 'objetos/cuadro2.gif',
    'clase_descripcion_corta' => 'objeto_cuadro_reg',
    'clase_instanciador_proyecto' => 'toba',
    'clase_instanciador_item' => '/admin/objetos/instanciadores/cuadro_reg',
    'objeto_existe_ayuda' => NULL,
  ),
  'info_cuadro' => 
  array (
    'titulo' => 'Solicitudes WDDX',
    'subtitulo' => NULL,
    'sql' => 'SELECT s.solicitud as solicitud,
s.item as item,
s.momento as momento,
s.tiempo_respuesta as tiempo,
sw.usuario as usuario,
sw.ip as ip,
sw.instancia as instancia,
sw.instancia_usuario as instancia_usuario,
sw.paquete as paquete,

(SELECT COUNT(*) FROM apex_solicitud_observacion sso WHERE sso.solicitud = s.solicitud %w%) as observacion,

(SELECT COUNT(*) FROM apex_solicitud_cronometro soc WHERE soc.solicitud = s.solicitud  %w%) as cronometro,

(SELECT COUNT(*) FROM apex_solicitud_obj_observacion soo WHERE soo.solicitud = s.solicitud  %w%) as observacion_obj

FROM apex_solicitud_wddx as sw, apex_solicitud s 
WHERE s.solicitud = sw.solicitud_wddx
%w%',
    'columnas_clave' => 'solicitud',
    'archivos_callbacks' => NULL,
    'ancho' => '80%',
    'ordenar' => NULL,
    'exportar_xls' => NULL,
    'exportar_pdf' => NULL,
    'paginar' => NULL,
    'tamano_pagina' => NULL,
    'eof_invisible' => NULL,
    'eof_customizado' => NULL,
    'pdf_respetar_paginacion' => NULL,
    'pdf_propiedades' => NULL,
    'asociacion_columnas' => 'solicitud',
  ),
  'info_cuadro_columna' => 
  array (
    0 => 
    array (
      'orden' => '0',
      'titulo' => 'Solicitud',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'solicitud',
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
      'titulo' => 'Item',
      'estilo' => 'col-tex-p1',
      'ancho' => NULL,
      'valor_sql' => 'item',
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
      'titulo' => 'Momento',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'momento',
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
      'titulo' => 'Tiempo',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'tiempo',
      'valor_sql_formato' => 'tiempo',
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
      'orden' => '4',
      'titulo' => 'Usuario',
      'estilo' => 'col-tex-p1',
      'ancho' => NULL,
      'valor_sql' => 'usuario',
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
    5 => 
    array (
      'orden' => '5',
      'titulo' => 'IP',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'ip',
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
    6 => 
    array (
      'orden' => '6',
      'titulo' => 'Inst.',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'instancia',
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
    7 => 
    array (
      'orden' => '7',
      'titulo' => 'Inst. Usu.',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'instancia_usuario',
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
    8 => 
    array (
      'orden' => '8',
      'titulo' => 'Paquete',
      'estilo' => 'col-num-p1',
      'ancho' => NULL,
      'valor_sql' => 'paquete',
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
  ),
);
	}

}
?>