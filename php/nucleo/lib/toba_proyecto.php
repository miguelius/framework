<?php
require_once('toba_proyecto_db.php');
require_once('toba_instancia.php');

/**
 * Brinda servicios de información sobre el proyecto actualmente cargado en el framework:
 *  - Información del archivo de configuración proyecto.ini, cacheandolo en la memoria
 *  - Información de la definición básica en el editor (e.i. los metadatos)
 * 
 * @package Centrales
 */
class toba_proyecto
{
	static private $instancia;
	static private $id_proyecto;
	private $memoria;								//Referencia al segmento de $_SESSION asignado
	private $id;
	private $indice_items_accesibles = array();
	const prefijo_punto_acceso = 'apex_pa_';

	static function get_id()
	{
		if (! isset(self::$id_proyecto)) {
			$item = toba_memoria::get_item_solicitado_original();
			//-- El proyecto viene por url
			if (isset($item) && isset($item[0])) {
				self::$id_proyecto = $item[0];
			} else {
				//--- Si no viene por url, se toma la constante
				if(! defined('apex_pa_proyecto') ){
					throw new toba_error("Es necesario definir la constante 'apex_pa_proyecto'");
				} 
				self::$id_proyecto = apex_pa_proyecto;
			}
		}
		return self::$id_proyecto;
	}

	/**
	 * @return toba_proyecto
	 */
	static function instancia($id_proyecto=null, $recargar=false)
	{
		if (! isset($id_proyecto)) {
			$id_proyecto = self::get_id();
		}
		if (!isset(self::$instancia[$id_proyecto]) || $recargar) {
			toba::logger()->debug("Creando instancia: $id_proyecto");
			self::$instancia[$id_proyecto] = new toba_proyecto($id_proyecto, $recargar);	
		}
		return self::$instancia[$id_proyecto];
	}

	static function eliminar_instancia()
	{
		self::$instancia[self::get_id()] = null;
	}
	
	private function __construct($proyecto, $recargar=false)
	{
		toba_proyecto_db::set_db( toba::instancia()->get_db() );//Las consultas salen de la instancia actual
		$this->id = $proyecto;
		$this->memoria =& toba::manejador_sesiones()->segmento_info_proyecto($proyecto);
		if (!$this->memoria || $recargar) {
			$this->memoria = self::cargar_info_basica();
			toba::logger()->debug('Inicialización de TOBA_PROYECTO: ' . $this->id,'toba');
		}
	}

	/**
	 * Retorna el valor de un parámetro generico del proyecto (ej. descripcion) cacheado en la memoria
	 * @return toba_error si el parametro no se encuentra definido, sino el valor del parámetro
	 */
	function get_parametro($id)
	{
		if( defined( self::prefijo_punto_acceso . $id ) ){
			return constant(self::prefijo_punto_acceso . $id);
		} elseif (isset($this->memoria[$id])) {
			return $this->memoria[$id];
		} else {
			if( array_key_exists($id,$this->memoria)) {
				return null;
			}else{
				throw new toba_error("INFO_PROYECTO: El parametro '$id' no se encuentra definido.");
			}
		}	
	}

	/**
	 * Cachea en la memoria un par clave-valor del proyecto actual
	 */
	function set_parametro($id, $valor)
	{
		$this->memoria[$id] = $valor;
	}

	//----------------------------------------------------------------
	// DATOS
	//----------------------------------------------------------------	

	/**
	 * Retorna la base de datos de la instancia a la que pertenece este proyecto
	 * @return toba_db
	 */
		
	function cargar_info_basica($proyecto=null)
	{
		$proyecto = isset($proyecto) ? $proyecto : $this->id;
		$rs = toba_proyecto_db::cargar_info_basica($proyecto);
		if (!$rs) {
			throw new toba_error("El proyecto '".$this->id."' no se encuentra cargado en la instancia ".toba_instancia::get_id());	
		}
		return $rs;
	}

	function es_multiproyecto()
	{
		return $this->get_parametro('listar_multiproyecto');
	}

	/**
	 * Retorna el path base absoluto del proyecto
	 */
	function get_path()
	{
		return toba::instancia()->get_path_proyecto($this->id);
	}

	/**
	 * Retorna el path absoluto de la carpeta 'php' del proyecto
	 */
	function get_path_php()
	{
		return $this->get_path() . '/php';
	}

	/**
	 * Retorna el path base absoluto del directorio temporal no-navegable del proyecto
	 * (mi_proyecto/temp);
	 */
	function get_path_temp()
	{
		$dir = $this->get_path() . '/temp';
		if (!file_exists($dir)) {
			mkdir($dir, 0700);
		}
		return $dir;
	}	
	
	/**
	 * Retorna path y URL de la carpeta navegable del proyecto actual
	 * (mi_proyecto/www);
	 * @return array con claves 'path' (en el sist.arch.) y 'url' (URL navegable)
	 */
	function get_www($archivo="")
	{
		$path_real = $this->get_path() . "/www/" . $archivo;
		$path_browser = toba_recurso::url_proyecto();
		if ($archivo != "") {
		 	$path_browser .= "/" . $archivo;
		}
		return array(	"path" => $path_real,
						"url" => $path_browser);
	}
	
	/**
	 * Retorna el path y url del directorio temporal navegable del proyecto (mi_proyecto/www/temp);
	 * En caso de no existir, crea el directorio
	 * Si se pasa un path relativo como parámetro retorna el path absoluto del archivo en el directorio temporal
	 * @return array con claves 'path' (en el sist.arch.) y 'url' (URL navegable)
	 */
	function get_www_temp($archivo='')
	{
		if (!file_exists($this->get_path() . "/www/temp")) {
			mkdir($this->get_path() . "/www/temp", 0700);
		}
		if ($archivo != '') {
			return $this->get_www('temp/'. $archivo);
		} else {
			return $this->get_www('temp');
		}
	}
	
	//--------------  Carga dinamica de COMPONENTES --------------

	static function get_definicion_dependencia($objeto, $proyecto=null)
	{
		$proyecto = isset($proyecto) ? $proyecto : self::get_id() ;
		//Busco la definicion del componente
		require_once('nucleo/componentes/definicion/componente.php');
		$sql = componente_toba::get_vista_extendida($proyecto, $objeto);
		$rs = toba_proyecto_db::get_db()->consultar_fila($sql['info']['sql']);
		return $rs;
	}

	//------------------------  FUENTES  -------------------------

	static function get_info_fuente_datos($id_fuente, $proyecto=null)
	{
		if (! isset($proyecto)) $proyecto = self::get_id();
		$rs = toba_proyecto_db::get_info_fuente_datos($proyecto, $id_fuente);
		if (empty($rs)) {
			throw new toba_error("No se puede encontrar la fuente '$id_fuente' en el proyecto '$proyecto'");	
		}
		return $rs;
	}
	
	//------------------------  Grupos de acceso & ITEMS  -------------------------

	/**
	 * Retorna la lista de items a los que puede acceder el usuario
	 *
	 * @param unknown_type $solo_primer_nivel
	 * @param string $proyecto Por defecto el actual
	 * @param string $grupo_acceso Por defecto el del usuario actual
	 * @return array RecordSet contienendo información de los items
	 */
	static function get_items_menu($proyecto=null, $grupo_acceso=null)
	{
		if (!isset($proyecto)) $proyecto = self::get_id();
		if (!isset($grupo_acceso)) $grupo_acceso = toba::manejador_sesiones()->get_grupo_acceso();
		$rs = toba_proyecto_db::get_items_menu($proyecto, $grupo_acceso);
		return $rs;
	}	

	/**
	 * Valida que un grupo de acceso tenga acceso a un item
	 */
	function puede_grupo_acceder_item($proyecto, $item)
	{
		$grupo_acceso = toba::manejador_sesiones()->get_grupo_acceso();	
		//Recupero los items y los formateo en un indice consultable
		if(!isset($this->indice_items_accesibles[$grupo_acceso])) {
			$this->indice_items_accesibles[$grupo_acceso] = array();
			$rs = toba_proyecto_db::get_items_accesibles(self::get_id(), $grupo_acceso);
			foreach( $rs as $accesible ) {
				$this->indice_items_accesibles[$grupo_acceso][$accesible['proyecto'].'-'.$accesible['item']] = 1;
			}
		}
		return isset($this->indice_items_accesibles[$grupo_acceso][$proyecto.'-'.$item]);
	}

	/**
	*	Devuelve la lista de items de la zona a los que puede acceder el grupo actual
	*/
	static function get_items_zona($zona, $grupo_acceso)
	{
		$rs = toba_proyecto_db::get_items_zona(self::get_id(), $grupo_acceso, $zona);	
		return $rs;
	}

	function get_grupo_acceso_usuario_anonimo()
	{
		//$grupos = explode(',',$this->get_parametro('usuario_anonimo_grupos_acc'));
		//$grupos = array_map('trim',$grupos);
		//return $grupos;
		return $this->get_parametro('usuario_anonimo_grupos_acc');
	}

	//------------------------  Permisos  -------------------------
	
	/**
	 * Retorna la lista de permisos globales (tambien llamados particulares) de un grupo de acceso en el proyecto actual
	 */
	static function get_lista_permisos($grupo)
	{
		$rs = toba_proyecto_db::get_lista_permisos(self::get_id(), $grupo);
		return $rs;
	}
	
	/**
	 * Retorna la descripción asociada a un permiso global particular del proy. actual
	 */
	static function get_descripcion_permiso($permiso)
	{
		$rs = toba_proyecto_db::get_descripcion_permiso(self::get_id(), $permiso);
		return $rs;
	}

	//------------------------  MENSAJES  -------------------------

	static function get_mensaje_toba($indice)
	{
		$rs = toba_proyecto_db::get_mensaje_toba($indice);	
		return $rs;
	}
	
	static function get_mensaje_proyecto($indice)
	{
		$rs = toba_proyecto_db::get_mensaje_proyecto(self::get_id(), $indice);	
		return $rs;
	}

	static function get_mensaje_objeto($objeto, $indice)
	{
		$rs = toba_proyecto_db::get_mensaje_objeto(self::get_id(), $objeto, $indice);	
		return $rs;
	}
}
?>