<?php

class toba_catalogo_asistentes
{
	/**
	*	Carga un asistente a partir de un molde de generacion
	* 	@return toba_asistente
	*/
	static function cargar_por_molde($id_molde_proyecto, $id_molde)
	{
		$tipo_molde = self::get_asistente_molde($id_molde_proyecto, $id_molde);
		$datos = toba_cargador::instancia()->get_metadatos_extendidos( array('proyecto'=>$id_molde_proyecto, 
																'componente' => $id_molde),
																$tipo_molde );
		$clase = $datos['molde']['clase'];
		return new $clase($datos);
	}
	
	static function get_asistente_molde($id_molde_proyecto, $id_molde)
	{	
		$sql = "SELECT 	t.clase 			as asistente 
				FROM 	apex_molde_operacion o,
						apex_molde_operacion_tipo t
				WHERE 	o.operacion_tipo = t.operacion_tipo
				AND		proyecto = '$id_molde_proyecto'
				AND		molde = '$id_molde';";
		$temp = consultar_fuente($sql);
		if($temp) {
			return $temp[0]['asistente'];
		} else {
			throw new toba_error('El molde solicitado no existe.');	
		}
	}

	static function get_ci_molde($id_molde_proyecto, $id_molde)
	{	
		$sql = "SELECT 	t.ci 				as ci
				FROM 	apex_molde_operacion o,
						apex_molde_operacion_tipo t
				WHERE 	o.operacion_tipo = t.operacion_tipo
				AND		proyecto = '$id_molde_proyecto'
				AND		molde = '$id_molde';";
		$temp = consultar_fuente($sql);
		if($temp) {
			return $temp[0]['ci'];
		} else {
			throw new toba_error('El molde solicitado no existe.');	
		}
	}

	//------------------------------------------------
	//---- Consultas
	//------------------------------------------------

	static function get_lista_tipo_dato()
	{
		$sql = 'SELECT 
					*
				FROM apex_molde_operacion_tipo_dato
				ORDER BY descripcion_corta
		';		
		return consultar_fuente($sql);
	}
	
	/**
	 * Dada una tabla retorna los valores por defecto de una fila de un abm
	 */
	static function get_lista_filas_tabla($tabla)
	{
		$nuevas = toba_editor::get_db_defecto()->get_definicion_columnas($tabla);		
		$tipo_datos = rs_convertir_asociativo_matriz(self::get_lista_tipo_dato(), array('dt_tipo_dato'));
		$salida = array();
		foreach ($nuevas as $nueva) {
			$fila = array();			
			if (! isset($nueva['fk_tabla'])) {	
				$tipo = isset($tipo_datos[$nueva['tipo']]) ? $nueva['tipo'] : 'C';
				$fila['asistente_tipo_dato'] = $tipo_datos[$tipo]['tipo_dato'];
				$fila['cuadro_estilo'] = $tipo_datos[$tipo]['cuadro_estilo'];
				$fila['cuadro_formato'] = $tipo_datos[$tipo]['cuadro_formato'];
				$fila['en_cuadro'] = ($tipo_datos[$tipo]['cuadro_estilo'] !== '');
			} else {
				//--- Es una referencia
				$fila['asistente_tipo_dato'] = '1000008';
				$fila['cuadro_estilo'] = 1;
				$fila['cuadro_formato'] = 1;
				$fila['en_cuadro'] = 1;
				
				$datos_carga_sql = self::get_opciones_sql_campo_externo($nueva);
				$fila['ef_carga_col_clave'] = $datos_carga_sql['clave'];
				$fila['ef_carga_col_desc'] = $datos_carga_sql['descripcion'];
				$fila['ef_carga_tabla'] = $datos_carga_sql['tabla'];
				$fila['ef_carga_sql'] = $datos_carga_sql['sql'];
			}
			$fila['dt_pk'] = $nueva['pk'];
			$fila['dt_largo'] = $nueva['longitud'];			
			$fila['dt_secuencia'] = $nueva['secuencia'];
			$fila['columna'] = $nueva['nombre'];
			$fila['etiqueta'] = ucwords(str_replace(array('_', '_'), ' ', $nueva['nombre']));
			$fila['en_filtro'] = 0;
			$fila['en_form'] = 1;			
			if ($nueva['secuencia'] != '') {
				$fila['en_form'] = 0;
				$fila['en_cuadro'] = 0;
			}
		
			if ($nueva['pk']) {
				$fila['orden'] = 1;
			}
			if ($nueva['pk'] && $fila['en_form']) {
				$nueva['ef_desactivar_modificacion'] = 1;
			}
			$salida[] = $fila;
		}
		return $salida;
	}
	
	/**
	 * Determina la sql,clave y desc de un campo externo de una tabla
	 * Remonta N-niveles de indireccion de FKs
	 */
	static protected function get_opciones_sql_campo_externo($campo)
	{
		//--- Busca cual es el campo descripcion de la tabla destino
		while (isset($campo['fk_tabla'])) {
			$tabla = $campo['fk_tabla'];
			$clave = $campo['fk_campo'];
			$descripcion = $campo['fk_campo'];
			//-- Busca cual es el campo descripci�n m�s 'acorde' en la tabla actual
			$campos_tabla_externa = toba_editor::get_db_defecto()->get_definicion_columnas($tabla);
			$encontrado = false;			
			foreach ($campos_tabla_externa as $campo_tabla_ext) {
				//---Detecta cual es la clave para seguir ejecutando el script
				if ($campo_tabla_ext['nombre'] == $clave) {
					$campo = $campo_tabla_ext;
				}
				if (! $encontrado && !$campo_tabla_ext['pk'] && $campo_tabla_ext['tipo'] == 'C') {
					$descripcion = $campo_tabla_ext['nombre'];
					$encontrado = true;
				}
			}
			$sql = "SELECT $clave, $descripcion FROM $tabla";
		}
		return array('sql'=>$sql, 'tabla'=>$tabla, 'clave'=>$clave, 'descripcion'=>$descripcion);
	}

	
}
?>