<?php

class toba_mc_comp__1532
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1532,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'objeto_datos_relacion',
    'subclase' => NULL,
    'subclase_archivo' => NULL,
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'OBJETO - DATOS relacion',
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
    'creacion' => '2005-08-28 03:39:13',
    'clase_editor_proyecto' => 'toba_editor',
    'clase_editor_item' => '/admin/objetos_toba/editores/db_tablas',
    'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_relacion.php',
    'clase_vinculos' => NULL,
    'clase_editor' => '/admin/objetos_toba/editores/db_tablas',
    'clase_icono' => 'objetos/datos_relacion.gif',
    'clase_descripcion_corta' => 'datos_relacion',
    'clase_instanciador_proyecto' => NULL,
    'clase_instanciador_item' => NULL,
    'objeto_existe_ayuda' => NULL,
    'ap_clase' => 'ap_relacion_objeto',
    'ap_archivo' => 'db/ap_relacion_objeto.php',
    'cant_dependencias' => '4',
  ),
  '_info_estructura' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1532,
    'debug' => 0,
    'ap' => 3,
    'ap_clase' => 'ap_relacion_objeto',
    'ap_archivo' => 'db/ap_relacion_objeto.php',
  ),
  '_info_relaciones' => 
  array (
    0 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1532,
      'asoc_id' => 4,
      'padre_proyecto' => 'toba',
      'padre_objeto' => 1501,
      'padre_id' => 'base',
      'padre_clave' => 'proyecto,objeto',
      'hijo_proyecto' => 'toba',
      'hijo_objeto' => 1525,
      'hijo_id' => 'prop_basicas',
      'hijo_clave' => 'proyecto,objeto',
      'cascada' => 0,
      'orden' => '1',
    ),
    1 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1532,
      'asoc_id' => 5,
      'padre_proyecto' => 'toba',
      'padre_objeto' => 1525,
      'padre_id' => 'prop_basicas',
      'padre_clave' => 'proyecto,objeto',
      'hijo_proyecto' => 'toba',
      'hijo_objeto' => 1526,
      'hijo_id' => 'relaciones',
      'hijo_clave' => 'proyecto,objeto',
      'cascada' => 0,
      'orden' => '3',
    ),
    2 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1532,
      'asoc_id' => 6,
      'padre_proyecto' => 'toba',
      'padre_objeto' => 1501,
      'padre_id' => 'base',
      'padre_clave' => 'proyecto,objeto',
      'hijo_proyecto' => 'toba',
      'hijo_objeto' => 1502,
      'hijo_id' => 'dependencias',
      'hijo_clave' => 'proyecto,objeto_consumidor',
      'cascada' => 0,
      'orden' => '2',
    ),
  ),
  '_info_dependencias' => 
  array (
    0 => 
    array (
      'identificador' => 'base',
      'proyecto' => 'toba_editor',
      'objeto' => 1501,
      'clase' => 'objeto_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
    1 => 
    array (
      'identificador' => 'dependencias',
      'proyecto' => 'toba_editor',
      'objeto' => 1502,
      'clase' => 'objeto_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
    2 => 
    array (
      'identificador' => 'prop_basicas',
      'proyecto' => 'toba_editor',
      'objeto' => 1525,
      'clase' => 'objeto_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
    3 => 
    array (
      'identificador' => 'relaciones',
      'proyecto' => 'toba_editor',
      'objeto' => 1526,
      'clase' => 'objeto_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => 'odt_dr_asociac',
      'subclase_archivo' => 'db/odt_dr_asociac.php',
      'fuente' => 'instancia',
      'parametros_a' => NULL,
      'parametros_b' => NULL,
    ),
  ),
);
	}

}

?>