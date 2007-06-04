<?php

class toba_mc_comp__1531
{
	static function get_metadatos()
	{
		return array (
  '_info' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1531,
    'anterior' => NULL,
    'reflexivo' => NULL,
    'clase_proyecto' => 'toba',
    'clase' => 'toba_datos_relacion',
    'subclase' => 'odr_ei_cuadro',
    'subclase_archivo' => 'db/odr_ei_cuadro.php',
    'objeto_categoria_proyecto' => NULL,
    'objeto_categoria' => NULL,
    'nombre' => 'OBJETO - EI cuadro',
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
    'creacion' => '2005-08-28 03:33:09',
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
    'cant_dependencias' => '6',
  ),
  '_info_estructura' => 
  array (
    'proyecto' => 'toba_editor',
    'objeto' => 1531,
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
      'objeto' => 1531,
      'asoc_id' => 1,
      'padre_proyecto' => 'toba_editor',
      'padre_objeto' => 1501,
      'padre_id' => 'base',
      'padre_clave' => 'proyecto,objeto',
      'hijo_proyecto' => 'toba_editor',
      'hijo_objeto' => 1523,
      'hijo_id' => 'prop_basicas',
      'hijo_clave' => 'objeto_cuadro_proyecto,objeto_cuadro',
      'cascada' => 0,
      'orden' => '1',
    ),
    1 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1531,
      'asoc_id' => 2,
      'padre_proyecto' => 'toba_editor',
      'padre_objeto' => 1523,
      'padre_id' => 'prop_basicas',
      'padre_clave' => 'objeto_cuadro_proyecto,objeto_cuadro',
      'hijo_proyecto' => 'toba_editor',
      'hijo_objeto' => 1524,
      'hijo_id' => 'columnas',
      'hijo_clave' => 'objeto_cuadro_proyecto,objeto_cuadro',
      'cascada' => 0,
      'orden' => '2',
    ),
    2 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1531,
      'asoc_id' => 3,
      'padre_proyecto' => 'toba_editor',
      'padre_objeto' => 1501,
      'padre_id' => 'base',
      'padre_clave' => 'proyecto,objeto',
      'hijo_proyecto' => 'toba_editor',
      'hijo_objeto' => 1505,
      'hijo_id' => 'eventos',
      'hijo_clave' => 'proyecto,objeto',
      'cascada' => 0,
      'orden' => '3',
    ),
    3 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1531,
      'asoc_id' => 5,
      'padre_proyecto' => 'toba_editor',
      'padre_objeto' => 1523,
      'padre_id' => 'prop_basicas',
      'padre_clave' => 'objeto_cuadro_proyecto,objeto_cuadro',
      'hijo_proyecto' => 'toba_editor',
      'hijo_objeto' => 1612,
      'hijo_id' => 'cortes',
      'hijo_clave' => 'objeto_cuadro_proyecto,objeto_cuadro',
      'cascada' => NULL,
      'orden' => '4',
    ),
    4 => 
    array (
      'proyecto' => 'toba_editor',
      'objeto' => 1531,
      'asoc_id' => 10000003,
      'padre_proyecto' => 'toba_editor',
      'padre_objeto' => 1505,
      'padre_id' => 'eventos',
      'padre_clave' => 'proyecto,evento_id',
      'hijo_proyecto' => 'toba_editor',
      'hijo_objeto' => 10000033,
      'hijo_id' => 'puntos_control',
      'hijo_clave' => 'proyecto,evento_id',
      'cascada' => NULL,
      'orden' => '5',
    ),
  ),
  '_info_dependencias' => 
  array (
    0 => 
    array (
      'identificador' => 'base',
      'proyecto' => 'toba_editor',
      'objeto' => 1501,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => '1',
      'parametros_b' => '1',
    ),
    1 => 
    array (
      'identificador' => 'columnas',
      'proyecto' => 'toba_editor',
      'objeto' => 1524,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => 'odt_cuadro_columnas',
      'subclase_archivo' => 'db/odt_cuadro_columnas.php',
      'fuente' => 'instancia',
      'parametros_a' => '1',
      'parametros_b' => '0',
    ),
    2 => 
    array (
      'identificador' => 'cortes',
      'proyecto' => 'toba_editor',
      'objeto' => 1612,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => '0',
      'parametros_b' => '0',
    ),
    3 => 
    array (
      'identificador' => 'eventos',
      'proyecto' => 'toba_editor',
      'objeto' => 1505,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => 'odt_eventos',
      'subclase_archivo' => 'db/odt_eventos.php',
      'fuente' => 'instancia',
      'parametros_a' => '0',
      'parametros_b' => '0',
    ),
    4 => 
    array (
      'identificador' => 'prop_basicas',
      'proyecto' => 'toba_editor',
      'objeto' => 1523,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => '1',
      'parametros_b' => '1',
    ),
    5 => 
    array (
      'identificador' => 'puntos_control',
      'proyecto' => 'toba_editor',
      'objeto' => 10000033,
      'clase' => 'toba_datos_tabla',
      'clase_archivo' => 'nucleo/componentes/persistencia/toba_datos_tabla.php',
      'subclase' => NULL,
      'subclase_archivo' => NULL,
      'fuente' => 'instancia',
      'parametros_a' => '',
      'parametros_b' => '',
    ),
  ),
);
	}

}

?>