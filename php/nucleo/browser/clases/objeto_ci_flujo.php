<?php
require_once("objeto_ci_me.php");	//Ancestro de todos los OE
/*

	Por ahora no pueden procesar ni cancelar

*/
class objeto_ci_flujo extends objeto_ci_me
{
	private $metodo_etapa;

	function __construct($id)
	{
		parent::objeto_ci_me($id);
		if ( !($this->metodo_etapa = $this->info_ci['metodo_despachador'])){
			throw new excepcion_toba("Es necesario definir el metodo del CN que define la etapa ACTIVA");
		}
	}
	//-------------------------------------------------------------------------------

	function evaluar_etapa_actual()
	{
		$this->etapa_actual = null;
		$metodo = $this->metodo_etapa;
		if( $etapa = $this->cn->$metodo() ){
			if(isset($this->indice_etapas[$etapa])){
				$this->etapa_actual = $etapa;
				$this->log->debug("CI-Flujo: Etapa actual: " . $this->etapa_actual);
			}else{
				throw new excepcion_toba("No es posible recuperar la etapa ACTIVA");
			}
		}else{
			throw new excepcion_toba("No es posible recuperar la etapa ACTIVA");
		}
		$this->memoria["etapa"] = $this->etapa_actual;
	}
	//-------------------------------------------------------------------------------

	function procesar()
	{
		$this->determinar_modelo_opciones();
		// -[0]- Cancelar la operacion?
		if( $this->operacion_cancelada() ){
			$this->cancelar_operacion();
		}
		try 
		{
			//-[1]- Procesamiento de la <<< SALIDA de la etapa PREVIA >>>
			if(isset($this->memoria["etapa"])){
				$this->etapa_previa = $this->memoria["etapa"];
				$this->cargar_dependencias_previas();
				$this->disparar_salida();
			}

			//-[2]- Procesamiento de la <<< OPERACION >>>
			if($this->controlar_activacion()){ //Procesar el Marco transaccional
				//$this->cargar_dependencias_inactivas();
				$this->procesar_operacion();
			}

			//-[3]- Procesamiento de la <<< ENTRADA a etapa ACTUAL >>>
			$this->evaluar_etapa_actual();
			$this->cargar_dependencias_actuales();
			$this->disparar_entrada();

		} catch(excepcion_toba $e) 
		{
			$this->cargar_etapa_anterior();
			echo ei_mensaje($e->getMessage(), 'error');
		}
	}
	//-------------------------------------------------------------------------------

	function obtener_interface()
/*
 	@@acceso: interno
	@@desc: Genera la INTERFACE de la transaccion.
*/
	{
		//-[2]- Genero la SALIDA
		$ancho = isset($this->info_ci["ancho"]) ? $this->info_ci["ancho"] : "10%";
		echo "<table width='$ancho' class='tabla-0'>\n";
		//Tabs
		//Interface de la etapa correspondiente
		echo "<tr><td class='celda-vacia'>";
		//Las hijas cambian la forma de mostrar la interface para una etapa?
		$interface_especifica = "obtener_interface_" . $this->etapa_actual;
		if(method_exists($this, $interface_especifica)){
			$this->$interface_especifica();
		}else{
			$this->interface_estandar();
		}
		echo "</td></tr>\n";
		echo "</table>\n";
	}
}
?>
