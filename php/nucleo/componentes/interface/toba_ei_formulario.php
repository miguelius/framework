<?php
/**
 * Un formulario simple presenta una grilla de campos editables. 
 * A cada uno de estos campos se los denomina Elementos de Formulario (efs).
 * @todo Los EF deberian cargar su estado en el momento de obtener la interface, no en su creacion.
 * @package Componentes
 * @subpackage Eis
 * @jsdoc ei_formulario ei_formulario
 * @wiki Referencia/Objetos/ei_formulario
 */
class toba_ei_formulario extends toba_ei
{
	protected $_prefijo = 'form';	
	protected $_elemento_formulario;			// interno | array |	Rererencias	a los	ELEMENTOS de FORMULARIO
	protected $_nombre_formulario;			// interno | string | Nombre del	FORMULARIO en el cliente
	protected $_lista_ef = array();			// interno | array |	Lista	completa	de	a los	EF
	protected $_lista_ef_post = array();		// interno | array |	Lista	de	elementos que se reciben por POST
	protected $_lista_toba_ef_ocultos = array();
	protected $_nombre_ef_cli = array(); 	// interno | array | ID html de los elementos
	protected $_parametros_carga_efs;		// Par�metros que se utilizan para cargar opciones a los efs
	protected $_modelo_eventos;
	protected $_flag_out = false;			// indica si el formulario genero output
	protected $_evento_mod_estricto;			// Solo dispara la modificacion si se apreto el boton procesar
	protected $_rango_tabs;					// Rango de n�meros disponibles para asignar al taborder
	protected $_objeto_js;	
	protected $_ancho_etiqueta = '150px';
	protected $_ancho_etiqueta_temp;		//Ancho de la etiqueta anterior a un cambio de la misma
	protected $_efs_invalidos = array();
	protected $_info_formulario = array();
	protected $_info_formulario_ef = array();
	protected $_js_eliminar;
	protected $_js_agregar;
	protected $_lista_efs_servicio;
	protected $_clase_formateo = 'toba_formateo';
	protected $_detectar_cambios;			//La clase en javascript escucha si algun ef cambio y habilita/deshabilita el boton por defecto
	protected $_estilos = 'ei-base ei-form-base';
	
	protected $_eventos_ext = null;			// Eventos seteados desde afuera
	protected $_observadores;
	protected $_item_editor = '1000255';
	protected $_carga_opciones_ef;			//Encargado de cargar las opciones de los efs
	
	//Salida PDF
	protected $_pdf_letra_tabla = 8;
	protected $_pdf_tabla_ancho;
	protected $_pdf_tabla_opciones = array();

	function __construct($id)
	{
		parent::__construct($id);
		//Nombre de los botones de javascript
		$this->_js_eliminar = "eliminar_ei_{$this->_submit}";
		$this->_js_agregar = "agregar_ei_{$this->_submit}";
		$this->_evento_mod_estricto = true;
	}

	function destruir()
	{
		//Memorizo la lista de efs enviados
		$this->_memoria['lista_efs'] = $this->_lista_ef_post;
		parent::destruir();
	}
	
	function aplicar_restricciones_funcionales()
	{
		parent::aplicar_restricciones_funcionales();

		//-- Restricci�n funcional efs no-visibles y no-editables ------
		$no_visibles = toba::perfil_funcional()->get_rf_form_efs_no_visibles($this->_id[1]);
		$no_editables = toba::perfil_funcional()->get_rf_form_efs_no_editables($this->_id[1]);
		if (! empty($no_visibles) || ! empty($no_editables)) {
			for($a=0;$a<count($this->_info_formulario_ef);$a++) {
				$id_ef = $this->_info_formulario_ef[$a]['identificador'];
				//Existe el ef luego de la configuraci�n?
				if (isset($this->_elemento_formulario[$id_ef])) {
					$id_metadato = $this->_info_formulario_ef[$a]['objeto_ei_formulario_fila'];
					if (in_array($id_metadato, $no_editables)) {
						$this->ef($id_ef)->set_solo_lectura(true);
					}
					if (in_array($id_metadato, $no_visibles)) {
						$this->desactivar_efs(array($id_ef));
					}
				}
			}
		}
		//----------------

	}
	
	/**
	 * M�todo interno para iniciar el componente una vez construido
	 * @ignore 
	 */	
	function inicializar($parametros)
	{
		parent::inicializar($parametros);
		$this->_nombre_formulario =	$parametros["nombre_formulario"];
		if (isset($this->_info_formulario['ancho_etiqueta']) && $this->_info_formulario['ancho_etiqueta'] != '') {
			$this->_ancho_etiqueta = $this->_info_formulario['ancho_etiqueta'];
		}	
		//Creo el array de objetos EF (Elementos de Formulario) que conforman	el	ABM
		$this->crear_elementos_formulario();
		//Cargo IDs en el CLIENTE
		foreach ($this->_lista_ef_post as $ef) {
			$this->_nombre_ef_cli[$ef] = $this->_elemento_formulario[$ef]->get_id_form();
		}
		//Inicializacion de especifica de cada tipo de formulario
		$this->inicializar_especifico();
	}
	
	/**
	 * Crea los objetos efs asociados al formulario actual
	 * @ignore 
	 */
	protected function crear_elementos_formulario()
	{
		$this->_lista_ef = array();
		for($a=0;$a<count($this->_info_formulario_ef);$a++)
		{
			//-[1]- Armo las listas	que determinan	el	plan de accion	del ABM
			$id_ef = $this->_info_formulario_ef[$a]["identificador"];
			$this->_lista_ef[]	= $id_ef;
			switch ($this->_info_formulario_ef[$a]["elemento_formulario"]) {
				case	"ef_oculto":
				case	"ef_oculto_secuencia":
				case	"ef_oculto_proyecto":
				case	"ef_oculto_usuario":
					$this->_lista_toba_ef_ocultos[] = $id_ef;
					break;
				default:
					$this->_lista_ef_post[] = $id_ef;
			}
			//$parametros	= parsear_propiedades($this->_info_formulario_ef[$a]["inicializacion"], '_');
			$parametros = $this->_info_formulario_ef[$a];
			if (isset($parametros['carga_sql']) && !isset($parametros['carga_fuente'])) {
				$parametros['carga_fuente']=$this->_info['fuente'];
			}

			//Preparo el identificador	del dato	que maneja el EF.
			//Esta parametro puede ser	un	ARRAY	o un string: exiten EF complejos	que manejan	mas de una
			//Columna de la tabla a	la	que esta	asociada	el	ABM
			if(ereg(",",$this->_info_formulario_ef[$a]["columnas"])){
				 $dato =	explode(",",$this->_info_formulario_ef[$a]["columnas"]);
				for($d=0;$d<count($dato);$d++){//Elimino espacios en las	claves
					$dato[$d]=trim($dato[$d]);
				}
			}else{
				 $dato =	$this->_info_formulario_ef[$a]["columnas"];
			}
			//Nombre	del formulario.
			$id_ef = $this->_info_formulario_ef[$a]["identificador"];
			$this->_parametros_carga_efs[$id_ef] = $parametros;
			$clase_ef = 'toba_'.$this->_info_formulario_ef[$a]["elemento_formulario"];
			$this->_elemento_formulario[$id_ef] = new $clase_ef(
															$this, 
															$this->_nombre_formulario,
															$this->_info_formulario_ef[$a]["identificador"],
															$this->_info_formulario_ef[$a]["etiqueta"],
															addslashes($this->_info_formulario_ef[$a]["descripcion"]),
															$dato,
															array($this->_info_formulario_ef[$a]["obligatorio"], 
																$this->_info_formulario_ef[$a]["oculto_relaja_obligatorio"]),
															$parametros);
			$this->_elemento_formulario[$id_ef]->set_expandido(! $this->_info_formulario_ef[$a]['colapsado']);
			if (isset($this->_info_formulario_ef[$a]['etiqueta_estilo'])) {
				$this->_elemento_formulario[$id_ef]->set_estilo_etiqueta( $this->_info_formulario_ef[$a]['etiqueta_estilo'] );
			}
		}
		//--- Se registran las cascadas porque la validacion de efs puede hacer uso de la relacion maestro-esclavo
		$this->_carga_opciones_ef = new toba_carga_opciones_ef($this, $this->_elemento_formulario, $this->_parametros_carga_efs);
		$this->_carga_opciones_ef->registrar_cascadas();
	}
	
	/**
	 * @ignore 
	 */
	protected function inicializar_especifico()
	{
		$this->set_grupo_eventos_activo('no_cargado');
	}
	
	/**
	 * Cambia el ancho total del formulario
	 *	@param string $ancho Tama�o del formulario ej: '600px'
	 */
	function set_ancho($ancho)
	{
		$this->_info_formulario["ancho"] = $ancho;
	}
		

	/*
	*	Setea el tama�o minimo para la etiqueta del ef. El tama�o debe incluir la medida utilizada.
	*	@param string $ancho Tama�o de la etiqueta ej: '150px'
	*	@see restaurar_ancho_etiqueta
	*/
	function set_ancho_etiqueta($ancho)
	{
		$this->_ancho_etiqueta_temp = $this->_ancho_etiqueta;
		$this->_ancho_etiqueta = $ancho;
	}
	

	/**
	 * Restaura el valor previo a un cambio del ancho de la etiqueta
	 * @see set_ancho_etiqueta
	 */
	protected function restaurar_ancho_etiqueta()
	{
		$this->_ancho_etiqueta = $this->_ancho_etiqueta_temp;
	}
	
	/**
	 * Determina si todos los maestros de un ef esclavo poseen datos
	 * @return boolean
	 */
	function ef_tiene_maestros_seteados($id_ef)
	{
		return $this->_carga_opciones_ef->ef_tiene_maestros_seteados($id_ef);
	}	
	
	//-------------------------------------------------------------------------------
	//--------------------------------	EVENTOS  -----------------------------------
	//-------------------------------------------------------------------------------

	/**
	 * Acciones a realizar previo al disparo de los eventos
	 * @ignore 
	 */
	function pre_eventos()
	{
		//-- Resguarda la lista de efs para servicio
		$this->_lista_efs_servicio = $this->_lista_ef_post;
		$this->_lista_ef_post = $this->_memoria['lista_efs'];	
		if (isset($this->_memoria['efs'])) {
			foreach (array_keys($this->_memoria['efs']) as $id_ef) {
				if (isset($this->_memoria['efs'][$id_ef]['obligatorio'])) {
					$this->_elemento_formulario[$id_ef]->set_obligatorio($this->_memoria['efs'][$id_ef]['obligatorio']);
				}
				if (isset($this->_memoria['efs'][$id_ef]['desactivar_validacion'])) {
					$this->_elemento_formulario[$id_ef]->desactivar_validacion($this->_memoria['efs'][$id_ef]['desactivar_validacion']);
				}
			}
		}
	}

	/**
	 * Acciones a realizar posteriormente al disparo de eventos
	 * @ignore 
	 */
	function post_eventos()
	{
		if (isset($this->_memoria['efs'])) {
			//--- Restaura lo obligatorio
			foreach ($this->_info_formulario_ef as $def_ef) {
				$id_ef = $def_ef['identificador'];
				if (isset($this->_memoria['efs'][$id_ef])) {
					$this->_elemento_formulario[$id_ef]->set_obligatorio($def_ef['obligatorio']);
					if (isset($this->_memoria['efs'][$id_ef]['desactivar_validacion'])) {
						$this->_elemento_formulario[$id_ef]->desactivar_validacion(false);
					}				
				}
			}
			unset($this->_memoria['efs']);
		}
		$this->limpiar_interface();	
		//-- Restaura la lista de efs para servicio		
		$this->_lista_ef_post = $this->_lista_efs_servicio;
	}	
	
	/**
	 * @ignore 
	 */
	function disparar_eventos()
	{
		$this->_log->debug( $this->get_txt() . " disparar_eventos", 'toba');		
		$this->pre_eventos();
		foreach ($this->_lista_ef as $ef){
			$this->_elemento_formulario[$ef]->cargar_estado_post();
		}		
		$datos = $this->get_datos();
		$validado = false;
		//Veo si se devolvio algun evento!
		if (isset($_POST[$this->_submit]) && $_POST[$this->_submit]!="") {
			$evento = $_POST[$this->_submit];
			//La opcion seleccionada estaba entre las ofrecidas?
			if (isset($this->_memoria['eventos'][$evento])) {
				//Me fijo si el evento requiere validacion
				$maneja_datos = ($this->_memoria['eventos'][$evento] == apex_ei_evt_maneja_datos);
				if($maneja_datos) {
					if (! $validado) {
						$this->validar_estado();
						$validado = true;
					}
					$parametros = $datos;
				} else {
					$parametros = null;
				}
				//El evento es valido, lo reporto al contenedor
				$this->reportar_evento( $evento, $parametros );
			}
		}
		$this->post_eventos();
		$this->borrar_memoria_eventos_enviados();
	}

	/**
	 * Recorre todos los efs y valida sus valores actuales
	 * @throws toba_error_validacion En caso de que la validaci�n de alg�n ef falle
	 */
	function validar_estado()
	{
		//Valida el	estado de los ELEMENTOS	de	FORMULARIO
		foreach ($this->_lista_ef_post as $ef) {
			$validacion = $this->_elemento_formulario[$ef]->validar_estado();
			if ($validacion !== true) {
				$this->_efs_invalidos[$ef] = str_replace("'", '"', $validacion);
				$etiqueta = $this->_elemento_formulario[$ef]->get_etiqueta();
				throw new toba_error_validacion($etiqueta.': '.$validacion, $this->ef($ef));
			}
		}
	}


	
	//-------------------------------------------------------------------------------
	//-------------------------------	Manejos de EFS ------------------------------
	//-------------------------------------------------------------------------------

	/**
	 * Permite alternar entre mostrar la ayuda a los efs con un tooltip (predeterminado) o a trav�s de un texto visible inicialmente
	 * @param boolean $mostrar
	 */
	function set_expandir_descripcion($mostrar)
	{
		$this->_info_formulario['expandir_descripcion'] = $mostrar;
	}
	
	/**
	 * Detecta los cambios producidos en los distintos campos en el cliente, cambia los estilos de los mismos y habilita-deshabilita el bot�n por defecto
	 * en caso de que se hallan producido cambios
	 */
	function set_detectar_cambios($detectar = true)
	{
		$this->_detectar_cambios = $detectar;
	}
	
	
	/**
	 * Borra los datos actuales y resetea el estado de los efs
	 */
	function limpiar_interface()
	{
		foreach ($this->_lista_ef as $ef) {
			$this->_elemento_formulario[$ef]->resetear_estado();
		}
	}

	/**
	 * Retorna todos los ids de los efs
	 * @return array
	 */
	function get_nombres_ef()
	{
		return $this->_lista_ef_post;
	}

	/**
	 * Retorna la cantidad de efs
	 * @return integer
	 */
	function get_cantidad_efs()
	{
		return count($this->_lista_ef_post);
	}
	
	/**
	 * Retorna la lista de identificadores que no estan desactivados
	 * @return array
	 */
	protected function get_efs_activos()
	{
		$lista = array();
		foreach ($this->_lista_ef as $id_ef) {
			if (in_array($id_ef, $this->_lista_ef_post) || in_array($id_ef, $this->_lista_toba_ef_ocultos)) {
				$lista[] = $id_ef;
			}	
		}
		return $lista;
	}
	
	/**
	 * Retorna la referencia a un ef contenido
	 * @return toba_ef
	 */
	function ef($id) 
	{
		return $this->_elemento_formulario[$id];
	}
	
	/**
	 * Indica si existe un ef
	 * @return boolean
	 */
	function existe_ef($id)
	{
		return in_array($id, $this->get_efs_activos());
	}

	
	/**
	 * Permite o no la edici�n de un conjunto de efs de este formulario, pero sus valores se muestran al usuario
	 *
	 * @param array $efs Uno o mas efs, si es nulo se asume todos
	 * @param boolean $readonly Hacer solo_lectura? (true por defecto)
	 */
	function set_solo_lectura($efs=null, $readonly=true)
	{
		if(!isset($efs)){
			$efs = $this->_lista_ef_post;
		}
		if (! is_array($efs)) {
			$efs = array($efs);	
		}
		foreach ($efs as $ef) {
			if(isset($this->_elemento_formulario[$ef])){
				$this->_elemento_formulario[$ef]->set_solo_lectura($readonly);
			}else{
				throw new toba_error("El ef '$ef' no existe");
			}
		}
	}

	/**
	 * Establece que un conjunto de efs ser�n o no obligatorios
	 * Este estado perdura durante una interaccion
	 *
	 * @param array $efs Uno o mas efs, si es nulo se asume todos
	 * @param boolean $obligatorios Hacer obligatorio? (true por defecto)
	 */
	function set_efs_obligatorios($efs=null, $obligatorios=true) {
		if (!isset($efs)) {
			$efs = $this->_lista_ef_post;
		}
		if (! is_array($efs)) {
			$efs = array($efs);	
		}
		foreach ($efs as $ef) {
			if (isset($this->_elemento_formulario[$ef])) {
				$this->_elemento_formulario[$ef]->set_obligatorio($obligatorios);
				$this->_memoria['efs'][$ef]['obligatorio'] = $obligatorios;
			} else {
				throw new toba_error("El ef '$ef' no existe");
			}
		}
	}
	
	
	/**
	 * Desactiva la validaci�n particular de un ef tanto en php como en javascript
	 * Este estado perdura durante una interacci�n
	 */
	function desactivar_validacion_ef($ef) 
	{
		if (isset($this->_elemento_formulario[$ef])) {
			$this->_elemento_formulario[$ef]->desactivar_validacion(true);
			$this->_memoria['efs'][$ef]['desactivar_validacion'] = 1;		
		} else {
			throw new toba_error("El ef '$ef' no existe");			
		}
	}
	
	/**
	 * Establece que un conjunto de efs NO seran enviados al cliente durante una interacci�n
	 * Para hacer un ef solo_lectura ver {@link toba_ef::set_solo_lectura() set_solo_lectura del ef}
	 * @param array $efs Uno o mas efs, si es nulo se asume todos
	 */
	function desactivar_efs($efs=null)
	{
		if(!isset($efs)){
			$efs = $this->_lista_ef_post;
		}
		if (! is_array($efs)) {
			$efs = array($efs);
		}
		foreach ($efs as $ef) {
			$pos = array_search($ef, $this->_lista_ef_post);
			if ($pos !== false) {
				array_splice($this->_lista_ef_post, $pos, 1);
			} else {
				throw new toba_error("No se puede desactivar el ef '$ef' ya que no se encuentra en la lista de efs activos");
			}
		}
	}
	
	/**
	 * Consume un tabindex html del componente y lo retorna
	 * @return integer
	 */	
	function get_tab_index()
	{
		if (isset($this->_rango_tabs)) {
			return $this->_rango_tabs[0]++;
		}	
	}
	
	//-------------------------------------------------------------------------------
	//-------------------------	  MANEJO de DATOS	  -------------------------------
	//-------------------------------------------------------------------------------

	/**
	 * Recupera el estado actual del formulario. 
	 * @return array Asociativo de una dimension columna=>valor
	 */
	function get_datos()
	{
		$registro = array();
		foreach ($this->get_efs_activos() as $ef) {
			$dato	= $this->_elemento_formulario[$ef]->get_dato();
			$estado = $this->_elemento_formulario[$ef]->get_estado();
			if (is_array($dato)){	//El EF maneja	DATO COMPUESTO
				if ($this->_elemento_formulario[$ef]->es_estado_unico()) {
					if ((count($dato))!=(count($estado))) {//Error	de	consistencia interna	del EF
						throw new toba_error_def("Error de consistencia	interna en el EF etiquetado: ".
											$this->_elemento_formulario[$ef]->get_etiqueta().
											"\nRecibido: ".var_export($estado, true));
					}
					for($x=0;$x<count($dato);$x++){
						$registro[$dato[$x]] = $estado[$dato[$x]];
					}
				} else {
					//--- Es multi-estado y multi-dato!! Caso particular, no es posible normalizar el arreglo					
					$salida = array();
					$registro[$ef] = array();
					foreach ($estado as $sub_estado) {
						if (count($dato) != count($sub_estado)) {
							//Error	de	consistencia interna	del EF
							throw new toba_error_def("Error de consistencia	interna en el EF etiquetado: ".
												$this->_elemento_formulario[$ef]->get_etiqueta().
												"\nRecibido: ".var_export($sub_estado, true));
						}
						for ($x=0;$x<count($dato);$x++) {
							$salida[$dato[$x]] = $sub_estado[$dato[$x]];
						}
						$registro[$ef][] = $salida;						
					}
				}
			} else {
				$registro[$dato] = $estado;
			}
		}
		return $registro;
	}

	/**
	 * @ignore 
	 */
	function post_configurar()
	{
		parent::post_configurar();
		//---Registar esclavos en los maestro
		$this->_carga_opciones_ef->registrar_cascadas();		
	}
	
	/**
	 * Carga el formulario con un conjunto de datos
	 * El formulario asume que pasa a un estado interno 'cargado' con lo cual, 
	 * por defecto, va a mostrar los eventos de modificacion,cancelar y eliminar en lugar del alta
	 * que solo se muestra cuando el estado interno es 'no_cargado'
	 * @param array $datos Arreglo columna=>valor/es
	 * @param boolean $set_cargado Cambia el grupo activo al 'cargado', mostrando los botones de modificacion, eliminar y cancelar por defecto
	 */
	function set_datos($datos, $set_cargado=true)
	{
		if (isset($datos)){
			//ei_arbol($datos,"DATOS para llenar el EI_FORM");
			//Seteo los	EF	con el valor recuperado
			foreach ($this->_lista_ef as $ef) {	//Tengo que	recorrer	todos	los EF...
				$temp = null;
				$dato = $this->_elemento_formulario[$ef]->get_dato();
				if(is_array($dato)){	//El EF maneja	DATO COMPUESTO
					if ($this->_elemento_formulario[$ef]->es_estado_unico()) {
						$temp = null;
						for($x=0;$x<count($dato);$x++) {
							if(isset($datos[$dato[$x]])) {
								$temp[$dato[$x]] = $datos[$dato[$x]];
							}
						}
					} else {
						//--- Es multi-estado y multi-dato!! Caso particular, no es posible normalizar el arreglo
						$temp = $datos[$ef];
					}
				} else {					//El EF maneja	un	DATO SIMPLE
					if (isset($datos[$dato])){
						if (!is_array($datos[$dato]))
							$temp = $datos[$dato];
						elseif (is_array($datos[$dato])) { //ATENCION: Este es el caso para el multi-seleccion, hay que mejorarlo
							$temp = array();
							foreach ($datos[$dato] as $string) {
								$temp[] = $string;
							}
						}
					}
				}
				if(isset($temp)){
					$this->_elemento_formulario[$ef]->set_estado($temp);
				}
			}
			if ($set_cargado && $this->_grupo_eventos_activo != 'cargado') {
				$this->set_grupo_eventos_activo('cargado');
			}
		}
	}

	/**
	 * Carga el formulario con valores por defecto, generalmente para un alta
	 * @param array $datos Arreglo columna=>valor
	 */
	function set_datos_defecto($datos)
	{
		$this->set_datos($datos);
		if ($this->_grupo_eventos_activo == 'cargado') {
			$this->set_grupo_eventos_activo('no_cargado');
		}
	}
	
	
	//-------------------------------------------------------------------------------
	//------------------------------	  SALIDA	  -------------------------------
	//-------------------------------------------------------------------------------
	
	/**
	 * M�todo que se utiliza en la respuesta a los efs_captcha
	 * @todo Este esquema solo se banca un solo ef_captcha. Para poder bancarse mas habria que 
	 * pensar por ejemplo, pasarle al GET "id_ef + text-captcha" para identificar que texto se 
	 * quiere recuperar. De todas maneras para que mas de un captcha???.
	 */	
	function servicio__mostrar_captchas_efs()
	{
		require_once(toba_dir() . '/php/3ros/jpgraph/jpgraph_antispam.php');
		$texto = toba::memoria()->get_dato_sincronizado('texto-captcha');
		toba::logger()->info('Texto CAPTCHA: ' . $texto);
		$antispam = new AntiSpam($texto);
		$antispam->Stroke();
	}

	/**
	 * M�todo que se utiliza en la respuesta de las cascadas usando AJAX
	 */
	function servicio__cascadas_efs()
	{
		require_once(toba_dir() . '/php/3ros/JSON.php');				
		if (! isset($_GET['cascadas-ef']) || ! isset($_GET['cascadas-maestros'])) {
			throw new toba_error("Cascadas: Invocaci�n incorrecta");	
		}
		$id_ef = trim(toba::memoria()->get_parametro('cascadas-ef'));
		$fila_actual = trim(toba::memoria()->get_parametro('cascadas-fila'));
		$maestros = array();
		$cascadas_maestros = $this->_carga_opciones_ef->get_cascadas_maestros();
		$ids_maestros = $cascadas_maestros[$id_ef];
		foreach (explode('-|-', toba::memoria()->get_parametro('cascadas-maestros')) as $par) {
			if (trim($par) != '') {
				$param = explode("-;-", trim($par));
				if (count($param) != 2) {
					throw new toba_error("Cascadas: Cantidad incorrecta de parametros ($par).");						
				}
				$id_ef_maestro = $param[0];
				
				//--- Verifique que este entre los maestros y lo elimina de la lista
				if (!in_array($id_ef_maestro, $ids_maestros)) {
					throw new toba_error("Cascadas: El ef '$id_ef_maestro' no esta entre los maestros de '$id_ef'");
				}
				array_borrar_valor($ids_maestros, $id_ef_maestro);
				
				$campos = $this->_elemento_formulario[$id_ef_maestro]->get_dato();
				$valores = explode(apex_qs_separador, $param[1]);
				if (!is_array($campos)) {
					$maestros[$id_ef_maestro] = $param[1];
				} else {
					//--- Manejo de claves m�ltiples					
					if (count($valores) != count($campos)) {
						throw new excepction_toba("Cascadas: El ef $id_ef_maestro maneja distinta cantidad de datos que los campos pasados");
					}
					$valores_clave = array();
					for ($i=0; $i < count($campos) ; $i++) {
						$valores_clave[$campos[$i]] = $valores[$i];
					}
					$maestros[$id_ef_maestro] = $valores_clave;
				}
			}
		}
		//--- Recorro la lista de maestros para ver si falta alguno. Permite tener ocultos como maestros
		foreach ($ids_maestros as $id_ef_maestro) {
			if (isset($fila_actual)) {
				//-- Caso especial del ML, necesita ir a la fila actual y recargar su estado
				$this->ef($id_ef_maestro)->ir_a_fila($fila_actual);
				$this->ef($id_ef_maestro)->cargar_estado_post();
			}
			if (! $this->ef($id_ef_maestro)->tiene_estado()) {
				throw new toba_error("Cascadas: El ef maestro '$id_ef_maestro' no tiene estado cargado");
			}
			$maestros[$id_ef_maestro] = $this->ef($id_ef_maestro)->get_estado();
		}
		toba::logger()->debug("Cascadas '$id_ef', Estado de los maestros: ".var_export($maestros, true));		
		$valores = $this->_carga_opciones_ef->ejecutar_metodo_carga_ef($id_ef, $maestros);
		toba::logger()->debug("Cascadas '$id_ef', Respuesta: ".var_export($valores, true));				
		
		//--- Se arma la respuesta en formato JSON
		$json = new Services_JSON();
		echo $json->encode($valores);
	}
	
	function generar_html()
	{
		//Genero la interface
		echo "\n\n<!-- ***************** Inicio EI FORMULARIO (	".	$this->_id[1] ." )	***********	-->\n\n";
		//Campo de sincroniacion con JS
		echo toba_form::hidden($this->_submit, '');
		echo toba_form::hidden($this->_submit.'_implicito', '');
		$ancho = '';
		if (isset($this->_info_formulario["ancho"])) {
			$ancho = convertir_a_medida_tabla($this->_info_formulario["ancho"]);
		}
		echo "<table class='{$this->_estilos}' $ancho>";
		echo "<tr><td style='padding:0'>";
		echo $this->get_html_barra_editor();
		$this->generar_html_barra_sup(null, true,"ei-form-barra-sup");
		$this->generar_formulario();
		echo "</td></tr>\n";
		echo "</table>\n";
		$this->_flag_out = true;
	}

	/**
	 * @ignore 
	 */
	protected function generar_formulario()
	{
		//--- La carga de efs se realiza aqui para que sea contextual al servicio
		//--- ya que hay algunos que no lo necesitan (ej. cascadas)
		$this->_carga_opciones_ef->cargar();
		$this->_rango_tabs = toba_manejador_tabs::instancia()->reservar(250);		
				
		$ancho = ($this->_info_formulario['ancho'] != '') ? "width: {$this->_info_formulario['ancho']};" : '';
		$colapsado = (isset($this->_colapsado) && $this->_colapsado) ? "display:none;" : "";
	
		echo "<div class='ei-cuerpo ei-form-cuerpo' style='$ancho $colapsado' id='cuerpo_{$this->objeto_js}'>";
		$this->generar_layout();
		
		$hay_colapsado = false;
		foreach ($this->_lista_ef_post as $ef){
			if (! $this->_elemento_formulario[$ef]->esta_expandido()) {
				$hay_colapsado = true;
				break;
			}
		}		
		if ($hay_colapsado) {
			$img = toba_recurso::imagen_skin('expandir_vert.gif', false);
			$colapsado = "style='cursor: pointer; cursor: hand;' onclick=\"{$this->objeto_js}.cambiar_expansion();\" title='Mostrar / Ocultar'";
			echo "<div class='ei-form-fila ei-form-expansion'>";
			echo "<img id='{$this->objeto_js}_cambiar_expansion' src='$img' $colapsado>";
			echo "</div>";
		}
		$this->generar_botones();
		echo "</div>\n";
	}
	
	/**
	 * Genera el cuerpo del formulario conteniendo la lista de efs
	 * Por defecto el layout de esta lista es uno sobre otro, este m�todo se puede extender
	 * para incluir alg�n layout espec�fico
	 * @ventana Extender para cambiar el layout por defecto
	 */	
	protected function generar_layout()
	{
		foreach ($this->_lista_ef_post as $ef) {
			$this->generar_html_ef($ef);
		}		
	}

	/**
	 * Genera la etiqueta y el componente HTML de un ef
	 * @param string $ef Identificador del ef
	 * @param string $ancho_etiqueta Ancho de la etiqueta del ef. Si no se setea, usa la definida en el editor.
	 * Recordar inclu�r las medidas (px, %, etc.). 
	 */
	protected function generar_html_ef($ef, $ancho_etiqueta=null)
	{
		if (! in_array($ef, $this->_lista_ef_post)) {
			//Si el ef no se encuentra en la lista posibles, es probable que se alla quitado con una restriccion o una desactivacion manual
			return;
		}
		$clase = 'ei-form-fila';
		$estilo_nodo = "";
		$id_ef = $this->_elemento_formulario[$ef]->get_id_form();
		if (! $this->_elemento_formulario[$ef]->esta_expandido()) {
			$clase .= ' ei-form-fila-oculta';
			$estilo_nodo = "display:none";
		}
		if ($this->_info_formulario['resaltar_efs_con_estado'] && $this->_elemento_formulario[$ef]->seleccionado()) {
			$clase .= ' ei-form-fila-filtrada';
		}			
		echo "<div class='$clase' style='$estilo_nodo' id='nodo_$id_ef'>\n";		
		if ($this->_elemento_formulario[$ef]->tiene_etiqueta()) {
			$this->generar_etiqueta_ef($ef, $ancho_etiqueta);
			//--- El margin-left de 0 y el heigth de 1% es para evitar el 'bug de los 3px'  del IE
			$ancho = isset($ancho_etiqueta) ? $ancho_etiqueta : $this->_ancho_etiqueta;
			echo "<div id='cont_$id_ef' style='margin-left:$ancho;_margin-left:0;_height:1%;'>\n";
			$this->generar_input_ef($ef);
			echo "</div>";
			if (isset($this->_info_formulario['expandir_descripcion']) && $this->_info_formulario['expandir_descripcion']) {
				echo '<span class="ei-form-fila-desc">'.$this->_elemento_formulario[$ef]->get_descripcion().'</span>';
			}

		} else {		
			$this->generar_input_ef($ef);
		}
		echo "</div>\n";		
	}
	
	/**
	 * Genera la salida gr�fica de un ef particular
	 * @ventana Extender para agregar html antes o despues de un ef espec�fico
	 */
	protected function generar_input_ef($ef)
	{
		if (! in_array($ef, $this->_lista_ef_post)) {
			//Si el ef no se encuentra en la lista posibles, es probable que se alla quitado con una restriccion o una desactivacion manual
			return;
		}		
		echo $this->_elemento_formulario[$ef]->get_input();
	}

	
	/**
	 * General el html de la etiqueta de un ef especifico
	 * @param string $ef Id. del ef
	 * @param string $ancho_etiqueta Ancho de la etiqueta del ef. Si no se setea, usa la definida en el editor.
	 * Recordar inclu�r las medidas (px, %, etc.). 
	 */
	protected function generar_etiqueta_ef($ef, $ancho_etiqueta=null)
	{
		$estilo = $this->_elemento_formulario[$ef]->get_estilo_etiqueta();
		$marca ='';		
		if ($estilo == '') {
	        		if ($this->_elemento_formulario[$ef]->es_obligatorio()) {
	    	        		$estilo = 'ei-form-etiq-oblig';
				$marca = '(*)';
        			} else {
	            		$estilo = 'ei-form-etiq';
    	    		}
		}
		$desc='';
		if (!isset($this->_info_formulario['expandir_descripcion']) || ! $this->_info_formulario['expandir_descripcion']) {
			$desc = $this->_elemento_formulario[$ef]->get_descripcion();		
			if ($desc !=""){
				$desc = toba_parser_ayuda::parsear($desc);
				$desc = toba_recurso::imagen_toba("descripcion.gif",true,null,null,$desc);
			}
		}
		$id_ef = $this->_elemento_formulario[$ef]->get_id_form();					
		$editor = $this->generar_vinculo_editor($ef);
		$etiqueta = $this->_elemento_formulario[$ef]->get_etiqueta();
		//--- El _width es para evitar el 'bug de los 3px'  del IE
		$ancho = isset($ancho_etiqueta) ? $ancho_etiqueta : $this->_ancho_etiqueta;
		echo "<label style='_width:$ancho;' for='$id_ef' class='$estilo'>$editor $desc $etiqueta $marca</label>\n";
	}
	
	/**
	 * @ignore 
	 */
	protected function generar_vinculo_editor($id_ef)
	{
		if (toba_editor::modo_prueba()) {
			$param_editor = array( apex_hilo_qs_zona => implode(apex_qs_separador,$this->_id),
									'ef' => $id_ef );
			return toba_editor::get_vinculo_subcomponente($this->_item_editor, $param_editor);			
		}
		return null;
	}
		
	//-------------------------------------------------------------------------------
	//------------------------------ JAVASCRIPT  ------------------------------------
	//-------------------------------------------------------------------------------

	/**
	 * @ignore 
	 */
	protected function crear_objeto_js()
	{
		$identado = toba_js::instancia()->identado();
		$rango_tabs = "new Array({$this->_rango_tabs[0]}, {$this->_rango_tabs[1]})";
		$esclavos = toba_js::arreglo($this->_carga_opciones_ef->get_cascadas_esclavos(), true, false);
		$maestros = toba_js::arreglo($this->_carga_opciones_ef->get_cascadas_maestros(), true, false);		
		$id = toba_js::arreglo($this->_id, false);
		$invalidos = toba_js::arreglo($this->_efs_invalidos, true);
		echo $identado."window.{$this->objeto_js} = new ei_formulario($id, '{$this->objeto_js}', $rango_tabs, '{$this->_submit}', $maestros, $esclavos, $invalidos);\n";
		foreach ($this->_lista_ef_post as $ef) {
			echo $identado."{$this->objeto_js}.agregar_ef({$this->_elemento_formulario[$ef]->crear_objeto_js()}, '$ef');\n";
		}
		if ($this->_detectar_cambios) {
			foreach (array_keys($this->_eventos_usuario_utilizados) as $id_evento) {
				if ($this->evento($id_evento)->es_predeterminado()) {
					$excluidos = array();
					foreach ($this->_lista_ef_post as $ef) {
						if ($this->ef($ef)->es_solo_lectura()) {
							$excluidos[] = $ef;
						}
					}					
					$excluidos = toba_js::arreglo($excluidos);
					echo $identado."{$this->objeto_js}.set_procesar_cambios(true, '$id_evento', $excluidos);\n";					
				}
			}
		}
	}

	/**
	 * Retorna una referencia al ef en javascript
	 * @param string $id Id. del ef
	 * @return string
	 */
	function get_objeto_js_ef($id)
	{
		return "{$this->objeto_js}.ef('$id')";
	}
	
	/**
	 * @ignore 
	 */
	function get_consumo_javascript()
	{
		$consumo = parent::get_consumo_javascript();
		$consumo[] = 'componentes/ei_formulario';
		//Busco las	dependencias
		foreach ($this->_lista_ef_post	as	$ef){
			$temp	= $this->_elemento_formulario[$ef]->get_consumo_javascript();
			if(isset($temp)) $consumo = array_merge($consumo, $temp);
		}
		$consumo = array_unique($consumo);//Elimino los	duplicados
		return $consumo;
	}

	//---------------------------------------------------------------
	//----------------------  SALIDA Impresion  ---------------------
	//---------------------------------------------------------------
		
	function vista_impresion_html( $salida )
	{
		$this->_carga_opciones_ef->cargar();
		$formateo = new $this->_clase_formateo('impresion_html');		
		$salida->subtitulo( $this->get_titulo() );
		echo "<table class='{$this->_estilos}' width='{$this->_info_formulario['ancho']}'>";
		foreach ( $this->_lista_ef_post as $ef){
			
			if ($this->_info_formulario['no_imprimir_efs_sin_estado']) {
				//Los combos que no tienen valor establecido no se imprimen
				if( $this->_elemento_formulario[$ef] instanceof toba_ef_combo ) {
					if ( $this->_elemento_formulario[$ef]->es_estado_no_seleccionado()) {
						continue;	
					}
				}
				//Los editables vacios no se imprimen
				if( $this->_elemento_formulario[$ef] instanceof toba_ef_editable ) {
					if (strlen(trim($this->_elemento_formulario[$ef]->get_estado()) == '')) {
						continue;	
					}
				}			
			}				
			
			echo "<tr><td class='ei-form-etiq'>\n";
			echo $this->_elemento_formulario[$ef]->get_etiqueta();
			echo "</td><td class='ei-form-valor'>\n";
			//Hay que formatear?
			if(isset($this->_info_formulario_ef[$ef]["formateo"])){
               	$funcion = "formato_" . $this->_info_formulario_ef[$ef]["formateo"];
               	$valor_real = $this->_elemento_formulario[$ef]->get_estado();
               	$valor = $formateo->$funcion($valor_real);
            }else{
		        $valor = $this->_elemento_formulario[$ef]->get_descripcion_estado('impresion_html');
		    }	
			echo $valor;
			echo "</td></tr>\n";
		}
		echo "</table>\n";
	}
	
	
	//---------------------------------------------------------------
	//----------------------  SALIDA PDF  ---------------------------
	//---------------------------------------------------------------
	
	/**
	 * Permite setear el ancho del formulario.
	 * @param unknown_type $ancho Es posible pasarle valores enteros o porcentajes (por ejemplo 85%).
	 */
	function set_pdf_tabla_ancho($ancho)
	{
		$this->_pdf_tabla_ancho = $ancho;
	}
	
	/**
	 * Permite setear el tama�o de la tabla que representa el formulario.
	 * @param integer $tamanio Tama�o de la letra.
	 */
	function set_pdf_letra_tabla($tamanio)
	{
		$this->_pdf_letra_tabla = $tamanio;
	}
	
	/**
	 * Permite setear el estilo que llevara la tabla en la salida pdf.
	 * @param array $opciones Arreglo asociativo con las opciones para la tabla de salida.
	 * @see toba_vista_pdf::tabla, ezpdf::ezTable
	 */
	function set_pdf_tabla_opciones($opciones)
	{
		$this->_pdf_tabla_opciones = $opciones;
	}
	
	function vista_pdf( $salida )
	{
		$this->_carga_opciones_ef->cargar();
		$formateo = new $this->_clase_formateo('pdf');
		$datos = array();
		$a['datos_tabla'] = array();
		foreach ( $this->_lista_ef_post as $ef ){
			if ($this->_elemento_formulario[$ef]->tiene_estado()) {
				$etiqueta = $this->_elemento_formulario[$ef]->get_etiqueta();
				//Hay que formatear? Le meto pa'delante...
            	if(isset($this->_info_formulario_ef[$ef]["formateo"])){
                	$funcion = "formato_" . $this->_info_formulario_ef[$ef]["formateo"];
                	$valor_real = $this->_elemento_formulario[$ef]->get_estado();
                	$valor = $formateo->$funcion($valor_real);
            	}else{
		            $valor = $this->_elemento_formulario[$ef]->get_descripcion_estado('pdf');
		        }	
				$datos['datos_tabla'][] = array('clave' => $etiqueta, 'valor'=>$valor);
			}
		}
		//-- Genera la tabla
        $ancho = null;
        if (strpos($this->_pdf_tabla_ancho, '%') !== false) {
        	$ancho = $salida->get_ancho(str_replace('%', '', $this->_pdf_tabla_ancho));	
        } elseif (isset($this->_pdf_tabla_ancho)) {
        		$ancho = $this->_pdf_tabla_ancho;
        }
        $opciones = $this->_pdf_tabla_opciones;
        if (isset($ancho)) {
        	$opciones['width'] = $ancho;		
        }        
		$datos['titulo_tabla'] = $this->get_titulo();
		$salida->tabla($datos, false, $this->_pdf_letra_tabla, $opciones);
	}

	//---------------------------------------------------------------
	//----------------------  SALIDA EXCEL --------------------------
	//---------------------------------------------------------------
		
	function vista_excel(toba_vista_excel $salida)
	{
		$this->_carga_opciones_ef->cargar();
		$formateo = new $this->_clase_formateo('excel');
		$datos = array();
		foreach ( $this->_lista_ef_post as $ef ){
			$opciones = array();
			$etiqueta = $this->_elemento_formulario[$ef]->get_etiqueta();
			//Hay que formatear?
			$estilo = array();
            if(isset($this->_info_formulario_ef[$ef]["formateo"])){
                $funcion = "formato_" . $this->_info_formulario_ef[$ef]["formateo"];
                $valor_real = $this->_elemento_formulario[$ef]->get_estado();
                list($valor, $estilo) = $formateo->$funcion($valor_real);
            }else{
	            list($valor, $estilo) = $this->_elemento_formulario[$ef]->get_descripcion_estado('excel');
	        }	
			if (isset($estilo)) {
				$opciones['valor']['estilo'] = $estilo;
			}	
			$opciones['etiqueta']['estilo']['font']['bold'] = true;
			$opciones['etiqueta']['ancho'] = 'auto';
			$opciones['valor']['ancho'] = 'auto';
			$datos = array(array('etiqueta' => $etiqueta, 'valor' => $valor));
			$salida->tabla($datos, array(), $opciones);
		}		
	}
	
	//---------------------------------------------------------------
	//----------------------  API BASICA ----------------------------
	//---------------------------------------------------------------

	/**
	 * Cambia la forma en que se le da formato a un ef en las salidas pdf, excel y html
	 * @param string $id_ef
	 * @param string $funcion Nombre de la funci�n de formateo, sin el prefijo 'formato_'
	 * @param string $clase Nombre de la clase que contiene la funcion, por defecto toba_formateo
	 */
	function set_formateo_ef($id_ef, $funcion, $clase=null)
	{
		$this->_info_formulario_ef[$id_ef]["formateo"] = $funcion;
		if (isset($clase)) {
			$this->_clase_formateo = $clase;
		}
	}
	
}
?>