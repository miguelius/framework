<?
class dao_editores
{
	//---------------------------------------------------
	//---------------- CLASES ---------------------------
	//---------------------------------------------------

	static function get_clases_validas()
	{
		return array(	'objeto_ci',
						'objeto_cn',
						'objeto_ei_cuadro',
						'objeto_ei_formulario',
						'objeto_ei_formulario_ml',
						'objeto_ei_filtro',
						'objeto_ei_arbol',
						'objeto_ei_calendario',
						'objeto_ei_archivos',
						'objeto_ei_esquema',						
						'objeto_datos_tabla',
						'objeto_datos_relacion' );
	}

	static function get_clases_validas_contenedor($contenedor=null)
	{
		//item, ci, ci_pantalla, datos_relacion
		if(!isset($contenedor)) return self::get_clases_validas();
		if($contenedor=="item") return array('objeto_ci', 'objeto_cn');
		if($contenedor=="datos_relacion") return array('objeto_datos_tabla');
		if($contenedor=="ci"){
			return array(	'objeto_ci',
							'objeto_ei_cuadro',
							'objeto_ei_formulario',
							'objeto_ei_formulario_ml',
							'objeto_ei_filtro',
							'objeto_ei_arbol',
							'objeto_ei_calendario',
							'objeto_ei_archivos',
							'objeto_ei_esquema',
							'objeto_datos_tabla',
							'objeto_datos_relacion' );
		}
		if($contenedor=="ci_pantalla"){
			return array(	'objeto_ci',
							'objeto_ei_cuadro',
							'objeto_ei_formulario',
							'objeto_ei_formulario_ml',
							'objeto_ei_filtro',
							'objeto_ei_arbol',
							'objeto_ei_calendario',
							'objeto_ei_archivos',
							'objeto_ei_esquema' );
		}
		//Por defecto devulevo todo
		return self::get_clases_validas();
	}
	
	static function get_clases_contenedoras()
	{
		return array(	
						array('proyecto' => 'toba', 'clase' =>'objeto_ci'),
						array('proyecto' => 'toba', 'clase' => 'objeto_datos_relacion')
					);
	}

	/*
		Las clases usan un ID concatenado para que las cascadas
		las soporten (actualmente pasan un parametro solo)
	*/
	static function get_lista_clases_toba($todas=false)
	{
		if ($todas)
			$sql_todas = "";
		else
			$sql_todas = "clase IN ('". implode("','",self::get_clases_validas() ) ."') AND";
			
		$sql = "SELECT 	proyecto || ',' || clase as clase, 
						clase as descripcion
				FROM apex_clase 
				WHERE 
					$sql_todas
					(proyecto = '". toba::get_hilo()->obtener_proyecto() ."' OR proyecto='toba')
				ORDER BY 2";
		return consultar_fuente($sql, "instancia");
	}	

	static function get_todas_clases_toba()
	{
		return self::get_lista_clases_toba(true);	
	}
	
	static function get_archivo_de_clase($proyecto, $clase)
	{
		$sql = "SELECT 	archivo
				FROM apex_clase 
				WHERE 	clase = '$clase'
				AND		proyecto = '$proyecto'";
		$temp = consultar_fuente($sql, "instancia");
		if(is_array($temp)){
			return $temp[0]['archivo'];
		}
	}
	
	static function get_clases_editores($contenedor=null)
	{
		$sql = "SELECT
					c.proyecto,
					c.clase,
					c.editor_proyecto,
					c.editor_item,
					c.icono,
					ct.clase_tipo,
					ct.descripcion_corta as clase_tipo_desc
				FROM 
					apex_clase c,
					apex_clase_tipo ct
				WHERE
					c.clase_tipo = ct.clase_tipo AND 
					c.clase IN ('". implode("','", self::get_clases_validas_contenedor($contenedor) ) ."')	AND
						--El proyecto es Toba o el actual
					(c.proyecto = '". toba::get_hilo()->obtener_proyecto() ."' OR c.proyecto = 'toba') AND
					c.editor_item IS NOT NULL
				ORDER BY ct.orden DESC";
		return consultar_fuente($sql, "instancia");	
	}
	
	static function get_clases_tipos()
	{
		$sql = "SELECT DISTINCT
					ct.clase_tipo,
					ct.descripcion_corta
				FROM 
					apex_clase c,
					apex_clase_tipo ct
				WHERE
					c.clase_tipo = ct.clase_tipo AND 
					c.clase IN ('". implode("','",self::get_clases_validas() ) ."')
				ORDER BY ct.clase_tipo";
		return consultar_fuente($sql, "instancia");
	}

	static function get_ci_editor_clase($proyecto, $clase)
	{
		$sql = "SELECT 
				 	o.proyecto,
					o.objeto
				FROM
					apex_clase c,
					apex_item_objeto io,
					apex_objeto o
				WHERE
					c.clase = '$clase' AND
					c.proyecto = '$proyecto' AND
					c.editor_item = io.item AND				-- Se busca el item editor
					c.editor_proyecto = io.proyecto AND
					io.objeto = o.objeto AND				-- Se busca el CI del item
					io.proyecto = o.proyecto AND
					o.clase = 'objeto_ci'";
		$res = consultar_fuente($sql, "instancia");
		return $res[0];
	}
	
	static function get_pantallas_de_ci($objeto)
	{
		$sql = "SELECT
					pantalla,
					identificador || ' - ' || COALESCE(etiqueta, '') as descripcion
				FROM
					apex_objeto_ci_pantalla
				WHERE
					objeto_ci_proyecto = '". toba::get_hilo()->obtener_proyecto() ."' AND
					objeto_ci = '$objeto'
		";
		return consultar_fuente($sql, "instancia");
	}

	static function get_clases_con_fuente_datos()
	{
		$clases = array();
		$clases[] = 'objeto_ei_formulario';
		$clases[] = 'objeto_ei_formulario_ml';
		$clases[] = 'objeto_ei_filtro';
		$clases[] = 'objeto_datos_tabla';
		$clases[] = 'objeto_datos_relacion';
		$clases[] = 'objeto_cn';
		return $clases;	
	}
	//-------------------------------------------------
	//---------------- ITEMS --------------------------
	//-------------------------------------------------

	/**
	*	Retorna la lista de todos los items del proyecto actual (no carpetas)
	*/
	static function get_lista_items()
	{
		$sql = "
			SELECT 
				proyecto, 
				item 						as id, 
				nombre						as descripcion
			FROM apex_item 
			WHERE 
				(carpeta <> '1' OR carpeta IS NULL) AND
				proyecto = '". toba::get_hilo()->obtener_proyecto() ."'
			ORDER BY nombre;
		";
		return consultar_fuente($sql, "instancia");
	}
	
	
	/**
	*	Retorna la lista de items en un formato adecuado para un combo
	*/
	static function get_items_para_combo()
	{
		require_once("modelo/lib/catalogo_items.php");
		$catalogador = new catalogo_items();
		$catalogador->cargar(array());	
		foreach($catalogador->items() as $item) {
			if (! $item->es_carpeta()) {
				$nivel = $item->get_nivel_prof() - 1;
				if($nivel >= 1){
					$inden = "&nbsp;" . str_repeat("&nbsp" . str_repeat("&nbsp;",8), $nivel -1) . "|__&nbsp;";
				}else{
					$inden = "";
				}
				$datos[] =  array('proyecto' => toba::get_hilo()->obtener_proyecto(),
									'id' => $item->get_id(), 
									'padre' => $item->get_id_padre(),
									'descripcion' => $inden . $item->get_nombre());
			}
		}
		return $datos;		
	}
		
	/**
	*	Retorna la lista de carpetas en un formato adecuado para un combo
	*/
	static function get_carpetas_posibles()
	{
		require_once("modelo/lib/catalogo_items.php");
		$catalogador = new catalogo_items(toba::get_hilo()->obtener_proyecto());
		$catalogador->cargar(array('solo_carpetas' => 1));		
		foreach($catalogador->items() as $carpeta) {
			$nivel = $carpeta->get_nivel_prof() - 1;
			if($nivel >= 0){
				$inden = "&nbsp;" . str_repeat("|" . str_repeat("&nbsp;",8), $nivel) . "|__&nbsp;";
			}else{
				$inden = "";
			}
			$datos[] =  array('proyecto' => toba::get_hilo()->obtener_proyecto(),
								'id' => $carpeta->get_id(), 
								'padre' => $carpeta->get_id(),		//Necesario para el macheo por agrupacion
								'nombre' => $inden . $carpeta->get_nombre());
		}
		return $datos;
	}	

	/**
	*	Retorna la lista de carpetas en un formato adecuado para un combo
	*/
	static function get_items_carpeta($carpeta)
	{
		$sql = "
			SELECT 
				item 						as id, 
				nombre						as descripcion
			FROM apex_item 
			WHERE 
				(carpeta <> '1' OR carpeta IS NULL) AND
				( (padre = '$carpeta') AND (padre_proyecto='". toba::get_hilo()->obtener_proyecto() ."') ) AND
				proyecto = '". toba::get_hilo()->obtener_proyecto() ."'
			ORDER BY nombre;
		";
		return consultar_fuente($sql, "instancia");		
	}

	//---------------------------------------------------
	//---------------- OBJETOS --------------------------
	//---------------------------------------------------

	static function get_lista_objetos_toba($clase)
	{
		$clase = explode(",",$clase);
		$sql = "SELECT 	proyecto, 
						objeto, 
						objeto							   as id,
						'[' || objeto || '] -- ' || nombre as descripcion
				FROM apex_objeto 
				WHERE 	clase = '{$clase[1]}'
				AND 	proyecto = '". toba::get_hilo()->obtener_proyecto() ."'
				ORDER BY nombre";
		return consultar_fuente($sql, "instancia");
	}
	
	static function get_info_dependencia($objeto_proyecto, $objeto)
	//Carga externa para un db_registros de dependencias
	{
		$sql = "SELECT 	o.clase || ' - ' || '[' || o.objeto || '] - ' || o.nombre as nombre_objeto,
						'[' || o.objeto || '] - ' || o.nombre as descripcion,
						o.clase_proyecto || ',' || o.clase as clase
				FROM 	apex_clase c, apex_objeto o
				WHERE 	o.clase = c.clase
				AND 	o.clase_proyecto = c.proyecto
				AND 	o.proyecto = '$objeto_proyecto'
				AND 	o.objeto = '$objeto'";
		return consultar_fuente($sql, "instancia");
	}

	/**
	*	Retorna el nombre de la clase del objeto
	*/
	static function get_clase_de_objeto($id)
	{
		$sql = "
			SELECT 
				o.clase
			FROM 
				apex_objeto o
			WHERE 
				(o.objeto = '{$id[1]}') AND 
				(o.proyecto = '{$id[0]}')
		";		
		$datos = consultar_fuente($sql, 'instancia');
		return $datos[0]['clase'];
	}
	
	//---------------------------------------------------
	//-- DATOS RELACION----------------------------------
	//---------------------------------------------------
	
	/**
	*	Retorna el id del objeto datos_relacion asociado a la clase
	*/
	static function get_dr_de_clase($clase)
	{
		$drs = array(
			'objeto_datos_relacion' 	=> array('toba', '1532'),
			'objeto_datos_tabla' 		=> array('toba', '1533'),
			'objeto_ei_arbol'			=> array('toba', '1537'),
			'objeto_ei_archivos'		=> array('toba', '1538'),
			'objeto_ei_calendario'		=> array('toba', '1539'),
			'objeto_ci' 				=> array('toba', '1507'),
			'objeto_ei_cuadro' 			=> array('toba', '1531'),
			'objeto_ei_filtro' 			=> array('toba', '1535'),
			'objeto_ei_formulario' 		=> array('toba', '1534'),
			'objeto_ei_formulario_ml' 	=> array('toba', '1536'),			
			'objeto_ei_arbol' 			=> array('toba', '1610'),	
			'objeto_cn'					=> array('toba', '1610'),
		);
		if (isset($drs[$clase])) {
			return $drs[$clase];			
		} else {
			throw new excepcion_toba("No hay definido un datos_relacion para la clase $clase");
		}
	}	
	
	//---------------------------------------------------
	//-- DATOS TABLA ------------------------------------
	//---------------------------------------------------

	static function get_lista_objetos_dt()
	//Listar objetos que son datos_tabla
	{
		$sql = "SELECT 	proyecto, 
						objeto, 
						'[' || objeto || '] -- ' || nombre as descripcion
				FROM apex_objeto 
				WHERE 	clase = 'objeto_datos_tabla'
				AND		clase_proyecto = 'toba'
				AND 	proyecto = '". toba::get_hilo()->obtener_proyecto() ."'
				ORDER BY 2";
		return consultar_fuente($sql, "instancia");
	}
	//---------------------------------------------------

	static function get_lista_dt_columnas($objeto)
	/*
		Lista las columnas de los DATOS_TABLA (supone que el objeto pasado como parametro lo es)
		Esta pregunta hay que hacercela a una clase de dominio (un datos_tabla)
	*/
	{
		$sql = "SELECT 		columna as 	clave,
							columna as 	descripcion,
							col_id  as	col_id
				FROM apex_objeto_db_registros_col 
				WHERE 	objeto = $objeto
				AND 	objeto_proyecto = '". toba::get_hilo()->obtener_proyecto() ."'
				ORDER BY 3";
		return consultar_fuente($sql, "instancia");
	}

	//-------------------------------------------------
	//---------------- ITEMS --------------------------
	//-------------------------------------------------

	function get_log_modificacion_componentes()
	{
		$sql = "	SELECT l.momento as momento,
						l.usuario as usuario,	
						'[' || coalesce(CAST(l.objeto as text), l.item) || '] ' || coalesce(o.nombre, i.nombre) as componente_nombre,
						l.objeto_proyecto as componente_proyecto,
						coalesce(CAST(l.objeto as text), l.item) as componente_id,
						coalesce(c.editor_proyecto,'toba') as editor_proyecto, 
						coalesce(c.editor_item,'/admin/items/editor_items') as editor_item,
						c.icono as icono_tipo_componente, 
						l.observacion as observacion
					FROM apex_log_objeto l
					LEFT OUTER JOIN 
						apex_objeto o INNER JOIN apex_clase c ON (o.clase = c.clase AND o.clase_proyecto = c.proyecto)
						ON (o.proyecto = l.objeto_proyecto AND o.objeto = l.objeto)
					LEFT OUTER JOIN
						apex_item i ON (l.item = i.item)
					WHERE objeto_proyecto = '". toba::get_hilo()->obtener_proyecto() ."'
					ORDER BY momento DESC;";	
		return consultar_fuente($sql, "instancia");
	}

}
?>