<?
require_once('migracion_toba.php');
require_once('nucleo/lib/parseo.php');

class migracion_0_10_0 extends migracion_toba
{

	//--------------------------------------------------------------
	//-------------------------- PROYECTO --------------------------
	//--------------------------------------------------------------
	
	/**
	 * La estructura interna para separar los par�metros de los ef cambia as� es posible contener
	 * los caracteres ';' y ':' entre ellos.
	 */
	function proyecto__parametros_efs()
	{
		$sql = "
			SELECT 
				objeto_ei_formulario_proyecto,
				objeto_ei_formulario,
				objeto_ei_formulario_fila,
				inicializacion
			FROM
				apex_objeto_ei_formulario_ef
			WHERE 
				objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'
		";
		$rs = $this->elemento->get_db()->consultar($sql);
		foreach ($rs as $ef) {
			$param = parsear_propiedades($ef['inicializacion'], '');
			if (is_array($param)) {
				$prop = addslashes(empaquetar_propiedades($param,'_'));
				$sql = "
					UPDATE apex_objeto_ei_formulario_ef SET inicializacion = '$prop'
					WHERE
							objeto_ei_formulario_proyecto = '{$ef['objeto_ei_formulario_proyecto']}' 
						AND	objeto_ei_formulario = '{$ef['objeto_ei_formulario']}'  
						AND objeto_ei_formulario_fila = '{$ef['objeto_ei_formulario_fila']}'
					";
				$rs = $this->elemento->get_db()->ejecutar($sql);
			}
		}		
	}
	
	/**
	 * Los parametros del combo lista cambiaron, para brindar mayor ortogonalidad a la definici�n
	 * Ahora los valores en la lista se separan siempre por coma y los clave-valor (si clave != valor) se separan por /
	 *
	 */
	function proyecto__parametros_combo_lista_c()
	{
		$sql = "
			SELECT 
				objeto_ei_formulario_proyecto,
				objeto_ei_formulario,
				objeto_ei_formulario_fila,
				inicializacion
			FROM
				apex_objeto_ei_formulario_ef
			WHERE 
				elemento_formulario = 'ef_combo_lista_c' AND
				objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'
		";
		$rs = $this->elemento->get_db()->consultar($sql);
		foreach ($rs as $ef) {
			$param = parsear_propiedades($ef['inicializacion'],'_');
			if (isset($param['lista'])) {
				$lista = str_replace("/", "^", $param['lista']);
				$lista = str_replace("," ,"/", $lista);
				$param['lista'] = str_replace("^", ",", $lista);
				$prop = addslashes(empaquetar_propiedades($param,'_'));
				$sql = "
					UPDATE apex_objeto_ei_formulario_ef SET inicializacion = '$prop'
					WHERE
							objeto_ei_formulario_proyecto = '{$ef['objeto_ei_formulario_proyecto']}' 
						AND	objeto_ei_formulario = '{$ef['objeto_ei_formulario']}'  
						AND objeto_ei_formulario_fila = '{$ef['objeto_ei_formulario_fila']}'
					";
				$rs = $this->elemento->get_db()->ejecutar($sql);
			}
		}
	}
	
	/**
	 * El parametro 'valores' del multiseleccion pasa a llamarse 'lista' para unificarlo con los combos
	 */
	function proyecto__parametros_multiseleccion()
	{
		$sql = "
			SELECT 
				objeto_ei_formulario_proyecto,
				objeto_ei_formulario,
				objeto_ei_formulario_fila,
				inicializacion
			FROM
				apex_objeto_ei_formulario_ef
			WHERE 
					elemento_formulario IN ('ef_multi_seleccion', 'ef_multi_seleccion_lista', 'ef_multi_seleccion_check')
				AND objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'
		";
		$rs = $this->elemento->get_db()->consultar($sql);
		foreach ($rs as $ef) {
			$param = parsear_propiedades($ef['inicializacion'],'_');
			if (isset($param['valores'])) {
				$param['lista'] = $param['valores'];
				unset($param['valores']);
				$prop = addslashes(empaquetar_propiedades($param,'_'));
				$sql = "
					UPDATE apex_objeto_ei_formulario_ef SET inicializacion = '$prop'
					WHERE
							objeto_ei_formulario_proyecto = '{$ef['objeto_ei_formulario_proyecto']}' 
						AND	objeto_ei_formulario = '{$ef['objeto_ei_formulario']}'  
						AND objeto_ei_formulario_fila = '{$ef['objeto_ei_formulario_fila']}'
					";
				$rs = $this->elemento->get_db()->ejecutar($sql);
			}
		}
	}
	
	/**
	 * Los parametros de inicializacion de la ventana pasan de ser 3 e implicitos a n y explicitos,
	 * asi se pueden definir cualquiera y ademas pueden ser modificados como los parametros de los 
	 * eventos
	 */
	function proyecto__parametros_ef_popup()
	{
		$sql = "
			SELECT 
				objeto_ei_formulario_proyecto,
				objeto_ei_formulario,
				objeto_ei_formulario_fila,
				inicializacion
			FROM
				apex_objeto_ei_formulario_ef
			WHERE 
				elemento_formulario = 'ef_popup' AND
				objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'
		";
		$rs = $this->elemento->get_db()->consultar($sql);
		foreach ($rs as $ef) {
			$param = parsear_propiedades($ef['inicializacion'],'_');
			if (isset($param['ventana'])) {
				$ventana = explode(',', $param['ventana']);
				if (isset($ventana[0])) {
					$ventana[0] = "width: {$ventana[0]}";	
				}
				if (isset($ventana[1])) {
					$ventana[1] = "height: {$ventana[1]}";	
				}
				if (isset($ventana[2])) {
					$ventana[2] = "scroll: {$ventana[2]}";	
				}
				$param['ventana'] = implode(',', $ventana);
				$prop = addslashes(empaquetar_propiedades($param,'_'));
				$sql = "
					UPDATE apex_objeto_ei_formulario_ef SET inicializacion = '$prop'
					WHERE
							objeto_ei_formulario_proyecto = '{$ef['objeto_ei_formulario_proyecto']}' 
						AND	objeto_ei_formulario = '{$ef['objeto_ei_formulario']}'  
						AND objeto_ei_formulario_fila = '{$ef['objeto_ei_formulario_fila']}'
					";
				$rs = $this->elemento->get_db()->ejecutar($sql);
			}
		}		
	}
	
	/**
	 * Las clases de combo se unificaron en una unica
	 */
	function proyecto__arbol_herencia_efs()
	{
		$sql = "
			UPDATE 
				apex_objeto_ei_formulario_ef
			SET
				elemento_formulario = 'ef_combo'
			WHERE 
				objeto_ei_formulario_proyecto='{$this->elemento->get_id()}' AND
				elemento_formulario IN ('ef_combo_dao', 'ef_combo_db', 'ef_combo_db_proyecto', 
										'ef_combo_lista', 'ef_combo_lista_c')
		";		
		$rs = $this->elemento->get_db()->ejecutar($sql);		
	}
	
	/**
	 * El ef_editable_multilinea pasa a ser ef_editable_textarea
	 */
	function proyecto__ef_textarea()
	{
		$sql = "
			UPDATE 
				apex_objeto_ei_formulario_ef
			SET
				elemento_formulario = 'ef_editable_textarea'
			WHERE 
				objeto_ei_formulario_proyecto='{$this->elemento->get_id()}' AND
				elemento_formulario = 'ef_editable_multilinea'
		";		
		$rs = $this->elemento->get_db()->ejecutar($sql);		
	}
	
	/**
	 * El editable numero migra su parametro CIFRAS por TAMANO, que es en realidad lo que es!
	 */
	function proyecto__parametros_editable_numero()
	{
		$sql = "
			SELECT 
				objeto_ei_formulario_proyecto,
				objeto_ei_formulario,
				objeto_ei_formulario_fila,
				inicializacion
			FROM
				apex_objeto_ei_formulario_ef
			WHERE 
					elemento_formulario IN ('ef_editable_numero', 'ef_editable_numero_porcentaje', 'ef_editable_moneda')
				AND objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'
		";
		$rs = $this->elemento->get_db()->consultar($sql);
		foreach ($rs as $ef) {
			$param = parsear_propiedades($ef['inicializacion'],'_');
			if (isset($param['cifras'])) {
				$param['tamano'] = $param['cifras'];
				unset($param['cifras']);
				$prop = addslashes(empaquetar_propiedades($param,'_'));
				$sql = "
					UPDATE apex_objeto_ei_formulario_ef SET inicializacion = '$prop'
					WHERE
							objeto_ei_formulario_proyecto = '{$ef['objeto_ei_formulario_proyecto']}' 
						AND	objeto_ei_formulario = '{$ef['objeto_ei_formulario']}'  
						AND objeto_ei_formulario_fila = '{$ef['objeto_ei_formulario_fila']}'
					";
				$rs = $this->elemento->get_db()->ejecutar($sql);
			}
		}
	}

	function proyecto__normalizacion_parametros()
	{
		$correlacion = array(
			'estado' =>'estado_defecto',
			'predeterminado' => 'estado_defecto',
			'solo_lectura' => 'solo_lectura',
			'dao' =>'carga_metodo',
			'clase' =>'carga_clase',
			'include' =>'carga_include',
			'clave' =>'carga_col_clave',
			'valor' =>'carga_col_desc',
			'sql' =>'carga_sql',
			'fuente' =>'carga_fuente',
			'lista' =>'carga_lista',
			'dependencias' =>'carga_maestros',
			'cascada_relajada' =>'carga_cascada_relaj',
			'no_seteado' =>'carga_no_seteado',
			'tamano' =>'edit_tamano',
			'cifras' =>'edit_tamano',
			'maximo' =>'edit_maximo',
			'mascara' =>'edit_mascara',
			'unidad' =>'edit_unidad',
			'rango' =>'edit_rango',
			'filas' =>'edit_filas',
			'columnas' =>'edit_columnas',
			'wrap' =>'edit_wrap',
			'resaltar' =>'edit_resaltar',
			'ajustable' =>'edit_ajustable',
			'ventana' =>'popup_ventana',
			'editable' =>'popup_editable',
			'tipo' =>'fieldset_fin',
			'valor' =>'check_valor_si',
			'valor_no_seteado' =>'check_valor_no',
			'valor_info' =>'check_desc_si',
			'valor_info_no_seteado' =>'check_desc_no',
			'sin_datos' =>'fijo_con_estado',
			'ancho' =>'editor_ancho',
			'alto' =>'editor_alto',
			'botonera' =>'editor_botonera',
			'cant_minima'=>'selec_cant_minima',
			'cant_maxima'=>'selec_cant_maxima',
			'mostrar_utilidades'=>'selec_utilidades',
			'tamanio'=>'selec_tamano',
			//'item_destino' Migrar manualmente
		);
		
		$sql = "
			SELECT 
				objeto_ei_formulario_proyecto,
				objeto_ei_formulario,
				objeto_ei_formulario_fila,
				inicializacion
			FROM
				apex_objeto_ei_formulario_ef
			WHERE 
				objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'
		";
		$rs = $this->elemento->get_db()->consultar($sql);
		foreach ($rs as $ef) {
			$param = parsear_propiedades($ef['inicializacion'],'_');
			$nuevos = array();
			foreach ($param as $clave => $valor) {
				if (isset($correlacion[$clave])) {
					$nuevos[$correlacion[$clave]] = $valor;
				} elseif ($clave == 'item_destino') {
					$partes = explode(',', $valor);
					$p_item = $partes[0];
					if (count($partes)==2) {
						$p_proyecto = $destino[1];
					} else {
						$p_proyecto = $this->elemento->get_id();
					}
					$nuevos['popup_item'] = $p_item;
					$nuevos['popup_proyecto'] = $p_proyecto;
				} else  {
					echo "Warning: El parametro $clave no tiene correlacion en la migracion.\n";	
				}
			}
			if (! empty($nuevos)) {
				$sql = "
					UPDATE apex_objeto_ei_formulario_ef 
					SET 
						inicializacion = NULL,
				";
				foreach($nuevos as $id => $valor) {
					$valor = addslashes($valor);
					$sql .= "$id = '$valor', ";
				}
				$sql = substr($sql, 0, -2);
				$sql .="	WHERE
							objeto_ei_formulario_proyecto = '{$ef['objeto_ei_formulario_proyecto']}' 
						AND	objeto_ei_formulario = '{$ef['objeto_ei_formulario']}'  
						AND objeto_ei_formulario_fila = '{$ef['objeto_ei_formulario_fila']}'
					";
				//echo $sql."\n";
				$rs = $this->elemento->get_db()->ejecutar($sql);
			}
		}	
		
		
		
		//--- Pone las inicializaciones en NULL para no volver a migrarlas sin querer
		$sql =  "UPDATE apex_objeto_ei_formulario_ef SET inicializacion = NULL
					WHERE objeto_ei_formulario_proyecto='{$this->elemento->get_id()}'";
		$this->elemento->get_db()->ejecutar($sql);
	}

}
?>
