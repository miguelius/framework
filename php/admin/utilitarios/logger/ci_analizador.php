<?php
require_once('nucleo/browser/clases/objeto_ci.php'); 
require_once('modelo/lib/analizador_logger.php');
//--------------------------------------------------------------------

class ci_analizador extends objeto_ci
{
	protected $opciones;
	protected $seleccion;
	protected $archivo;
	protected $cambiar_pantalla = false;
	protected $analizador;
	
	function mantener_estado_sesion()
	{
		$estado = parent::mantener_estado_sesion();
		$estado[] = 'opciones';
		$estado[] = 'seleccion';
		return $estado;	
	}
	
	protected function get_pantalla_inicial()
	{
		if (isset($this->seleccion)) {
			return "visor";
		}
		return parent::get_pantalla_inicial();		
	}	
	
	function get_pantalla_actual()
	{
		if ($this->cambiar_pantalla) {
			return "visor";	
		}
		return parent::get_pantalla_actual();
	}
	
	/**
	 * @todo Se desactiva el logger porque no corre como proyecto toba sino como el de la aplicacion
	 * 		Cuando el admin sea un proyecto hay que sacar la desactivación
	 */
	function evt__inicializar()
	{
		toba::get_logger()->desactivar();	
		if (!isset($this->opciones)) {
			$this->opciones['proyecto'] = toba::get_hilo()->obtener_proyecto();	
			$this->opciones['fuente'] = 'fs';
			$this->seleccion = 'ultima';
		}
		$this->cargar_analizador();
	}
	
	function evt__pre_cargar_datos_dependencias()
	{
		$this->cargar_analizador();
	}
	
	function cargar_analizador()
	{
		if (isset($this->opciones)) {
			$this->archivo = $this->get_logger()->directorio_logs()."/sistema.log";		
			$this->analizador = new analizador_logger_fs($this->archivo);
		}
	}
	
	function obtener_html_dependencias()
	{
		parent::obtener_html_dependencias();
?>
		<style type="text/css">
		.cuerpo, .ci-cuerpo {
			margin-top: 0px;
			margin-bottom: 0px;
		}
		.admin-logger-opciones {
			border:1px solid black; 
			text-align: left;
			list-style-type: none;
			padding: 4px;
			margin: 0; 
			background-color:white;
		}		
		.admin-logger-proyecto {
			font-size: 20px;
			font-weight: bold;
			float: right;
		}
		.admin-logger-selec {
			font-size:14px;
			display: block;
		}
		.admin-logger-normal {
			padding-left: 10px;
		}
		.admin-logger-seccion {
			padding-top: 5px;
			padding-bottom: 5px;
			font-weight: bold;
		}
		pre {
			margin: 0;
			padding:0;
			margin-left:20px;
		}
		</style>
<?php
		if ($this->debe_mostrar_visor()) {
			if ($this->opciones['fuente'] == 'db') {
				$this->obtener_html_db();
			} elseif ($this->opciones['fuente'] == 'fs') {
				$this->obtener_html_fs();
			}
		}
	}
	
	protected function debe_mostrar_visor()
	{
		if ($this->get_pantalla_actual() == 'visor' && isset($this->seleccion)) {
			if (isset($this->opciones['proyecto']) && isset($this->opciones['fuente'])) {
				return true;
			}
		}
		return false;
	}
	
	function servicio__ejecutar()
	{
		$res = $this->analizador->obtener_pedido($this->seleccion);
		$encabezado = $this->obtener_html_encabezado($res);
		list($detalle, $cant_por_nivel) = $this->obtener_html_detalles($res);
		$anterior_mod = toba::get_hilo()->obtener_parametro('mtime');
		$ultima_mod = filemtime($this->archivo);
		if ($anterior_mod != $ultima_mod) {
			echo $ultima_mod;		
			echo "<--toba-->";			
			echo $encabezado;
			echo "<--toba-->";		
			echo $detalle;
			echo "<--toba-->";
			echo js::arreglo($cant_por_nivel, true);
		}
	}
	
	function extender_objeto_js() 
	{
		if (!$this->debe_mostrar_visor() || !file_exists($this->archivo)) {
			return;	
		}
		$niveles = toba::get_logger()->get_niveles();		
		$parametros = array();
//		$vinculo = toba::get_vinculador()->crear_autovinculo($parametros, array('servicio' => 'ejecutar'));
?>
			var ultima_mod ='<?=filemtime($this->archivo)?>';
			var niveles = <?=js::arreglo($niveles)?>;
			var niveles_actuales = {length: 0};
			var refresco_automatico = true;
			var consultando = false;

			<?=$this->objeto_js?>.evt__refrescar = function() {
				var callback =
				{
				  success: this.respuesta_refresco ,
				  failure: toba.error_comunicacion,
				  scope: this
				}
				var parametros = {'mtime': ultima_mod};
				var vinculo = vinculador.crear_autovinculo('ejecutar', parametros);
				conexion.asyncRequest('GET', vinculo, callback, null);
				return false;
			}
			
			<?=$this->objeto_js?>.respuesta_refresco = function(resp)
			{
				try {
					var partes = toba.analizar_respuesta_servicio(resp);
					//Se actualizo el logger?
					if (partes.length > 0) {
						toba.inicio_aguardar();
						ultima_mod = partes[0];
						document.getElementById('logger_encabezados').innerHTML = partes[1];
						document.getElementById('logger_detalle').innerHTML = partes[2];
						var cant = eval('(' + partes[3] + ')');
						refrescar_cantidad_niveles(cant);
						refrescar_detalle();
						setTimeout("toba.fin_aguardar()", 200);
					}
				} catch (e) {
					//alert(e);
				}
				consultando = false;				
			}
			
			function mostrar_nivel(nivel)
			{
				var li_nivel = document.getElementById('nivel_' + nivel);
				if (! niveles_actuales[nivel]) {
					niveles_actuales[nivel] = true;
					niveles_actuales.length++;
				} else {
					delete(niveles_actuales[nivel]);
					niveles_actuales.length--;
				}
				refrescar_niveles();
				refrescar_detalle();
			}
	
			function refrescar_niveles()
			{
				var mostrar_todos = (niveles_actuales.length == 0);			
				for (var i=0; i< niveles.length; i++) {
					var nivel_min = niveles[i].toLowerCase();
					var li_nivel = document.getElementById('nivel_' + niveles[i]);
					var src_actual = li_nivel.childNodes[0].childNodes[0].src;
					var diff = (mostrar_todos || niveles_actuales[niveles[i]]) ? '' : '_des';
					var src_nuevo = toba_alias + '/img/logger/' + nivel_min + diff + '.png';
					if (src_actual != src_nuevo) {
						li_nivel.childNodes[0].childNodes[0].src = src_nuevo;
					}
				}
			}
			
			function refrescar_detalle()
			{
				var mostrar_todos = (niveles_actuales.length == 0);
				var detalle = document.getElementById('logger_detalle');
				for (var i=0; i < detalle.childNodes.length; i++) {
					var nodo = detalle.childNodes[i];
					var nivel = nodo.attributes['nivel'].value;
					var debe_mostrar = (mostrar_todos || niveles_actuales[nivel]);
					if (debe_mostrar && nodo.style.display == 'none') {
						nodo.style.display = '';
					}
					if (!debe_mostrar && nodo.style.display == '') {
						nodo.style.display = 'none';	
					}
				}
			}			
			
			function refrescar_cantidad_niveles(cantidades)
			{
				for (var nivel in cantidades) {
					var cant = (cantidades[nivel] > 0) ? '[' + cantidades[nivel] + ']' : '';
					document.getElementById('nivel_cant_' + nivel).innerHTML = cant;
				}
			}
			
			function set_refresco_automatico(activar)
			{
				refresco_automatico = activar;
				document.getElementById('div_lapso').style.display = (activar) ? "" :"none";
			}
			
			function chequear_refresco()
			{
				if (refresco_automatico && !consultando) {
					consultando = true;
					toba.set_aguardar(false);
					<?=$this->objeto_js?>.evt__refrescar();
				}
				timer_refresco();
			}
			
			function timer_refresco()
			{
				var lapso = parseFloat(document.getElementById('refresco_lapso').value);
				var lapso = (lapso>0) ? lapso : 2000;
				setTimeout("chequear_refresco()", lapso);
			}
			set_refresco_automatico(document.getElementById('refresco_automatico').checked);
			timer_refresco();
<?php
	}
	
	function obtener_html_fs()
	{
		if (!file_exists($this->archivo)) {
			echo ei_mensaje("No hay logs registrados para el proyecto ".
							"<strong>{$this->opciones['proyecto']}</strong>");
			return;
		}			
		$niveles = toba::get_logger()->get_niveles();
		$niveles = array_reverse($niveles);		
		
		$res = $this->analizador->obtener_pedido($this->seleccion);
		$encabezado = $this->analizador->analizar_encabezado($res);
		
		//--- Opciones
		$selec = ($this->seleccion == 'ultima') ? "Última solicitud" : "Solicitud {$this->seleccion}";
		echo "<div>";
		echo "<span class='admin-logger-proyecto' title='{$this->archivo}'>";
		echo ucfirst($this->opciones['proyecto']);
		echo "<span class='admin-logger-selec'>$selec</span></span>";
		$check = form::checkbox("con_encabezados", 0, 1, "ef-checkbox", " onclick=\"toggle_nodo(document.getElementById('logger_encabezados'))\"");
		echo "<label>$check Ver Encabezados</label><br>";

		$check = form::checkbox("refresco_automatico", 0, 1, "ef-checkbox", " onclick=\"set_refresco_automatico(this.checked);\"");
		$edit = form::text("refresco_lapso", 2000, false, 6, 6);
		echo "<label>$check Refresco Automático</label> <span id='div_lapso'>".$edit."ms</span><br>";
		echo "</div><hr style='clear:both'>";		
		
		echo "<div style='clear:both;width:100%;height:100%;overflow:auto;'>\n";
		list($detalle, $cant_por_nivel) = $this->obtener_html_detalles($res);

		//--- Encabezado 
		echo "<ul id='logger_encabezados' style='display:none;list-style-type: none;padding: 0;margin: 0'>";		
		echo $this->obtener_html_encabezado($res);
		echo "</ul>";

		//---- Niveles
		echo "<div style='clear:both;float:right;margin-left:10px;text-align:center;'>";
		echo "<strong>Niveles</strong>";
		echo "<ul class='admin-logger-opciones'>";
		foreach ($niveles as $nivel) {
			$img = recurso::imagen_apl('logger/'.strtolower($nivel).'.png', true, null, null, "Filtrar el nivel: $nivel");
			$cant = ($cant_por_nivel[$nivel] != 0) ? "[{$cant_por_nivel[$nivel]}]" : "";
			echo "<li id='nivel_$nivel'><a href='#' onclick='mostrar_nivel(\"$nivel\")'>$img</a> ";
			echo "<span id='nivel_cant_$nivel'>$cant</span></li>\n";	
		}
		echo "</ul>";
		echo "</div>";
/*****	MOCKUP de la eleccion de un proyecto especifico		
 		echo recurso::imagen_apl('logger/ver_texto.png', true, 16, 16, "Ver el texto original del log");* 
		echo "<div style='clear:both;float:right;margin-left:10px;text-align:center;'><br>";		
		echo "<strong>Proyectos</strong>";
		echo "<ul id='logger_proyectos' class='admin-logger-opciones'>";
		echo "<li>".form::multi_select("opciones_proyectos", array(), array('referencia','toba'), 2)."</li>";
		echo "</ul>";		
		echo "</div>";*/
		
		//--- Detalles
		echo "<ol id='logger_detalle' style='list-style-type:none;padding:0;margin:0;margin-top:10px;'>";		
		echo $detalle;
		echo "</ol>\n";
		
		echo "</div>";
	}
	
	function obtener_html_encabezado($res)
	{
		$encabezado = $this->analizador->analizar_encabezado($res);
		$enc = "";
		//--- Encabezado		
		foreach ($encabezado as $clave => $valor) {
			$enc .= "<li><strong>".ucfirst($clave)."</strong>: $valor</li>\n";
		}
		$enc .= "<li><hr></li>";
		return $enc;
	}
	
	function obtener_html_detalles($res)
	{
		$niveles = toba::get_logger()->get_niveles();
		$cuerpo = $this->analizador->analizar_cuerpo($res);
		$cant_por_nivel = array();
		foreach ($niveles as $nivel) {
			$cant_por_nivel[$nivel] = 0;
		}
		$detalle = '';
		foreach ($cuerpo as $linea) {
			//Los mensajes de la solicitudes son especiales..
			if (substr($linea['mensaje'], 0,10) == "[SECCION] ") {
				$linea['mensaje'] = substr($linea['mensaje'], 10);
				$img ='';
				$clase = "admin-logger-seccion";
			} else {
				$img = recurso::imagen_apl('logger/'.strtolower($linea['nivel']).'.png', true, null, null);
				$clase = "admin-logger-normal";	
			}
			$detalle .= "<li class='$clase' nivel='{$linea['nivel']}' proyecto='{$linea['proyecto']}'>";
			$detalle .= "$img ";
			$detalle .= $this->txt2html($linea['mensaje']);
			$detalle .= "</li>";	
			$cant_por_nivel[$linea['nivel']]++;
		}
		return array($detalle, $cant_por_nivel);
	}
	
	function txt2html($txt)	
	{
		$txt = trim($txt);
		
		//Los saltos (\n) dentro del mensaje se considera que viene un dump de algo
		$salto = strpos($txt, "\n", 0);
		if ($salto !== false) {
			$txt = substr($txt,0,$salto)."<pre>".substr($txt, $salto)."</pre>";
		}
		return $txt;
	}	
	
	function get_logger()
	{
		return logger::instancia($this->opciones['proyecto']);
	}
	
	
	//---- Eventos CI -------------------------------------------------------
	
	function evt__refrescar()
	{
	}
	
	function evt__borrar()
	{
		$this->get_logger()->borrar_archivos_logs();	
	}
	
	//---- Eventos Filtro -------------------------------------------------------
	
	function evt__filtro__filtrar($opciones)
	{
		$this->opciones = $opciones;		
		$this->opciones['fuente'] = 'fs';
	}
	
	function evt__filtro__cancelar()
	{
		unset($this->opciones);	
	}
	
	function evt__filtro__carga()
	{
		if (isset($this->opciones)) {
			return $this->opciones;	
		}
	}
	
	//---- Eventos Cuadro -------------------------------------------------------
	
	function evt__pedidos__carga()
	{
		$logs = $this->analizador->get_logs_archivo();
		$logs = array_reverse($logs);		
		$pedidos = array();
		$numero = count($logs);
		foreach ($logs as $log) {
			$log = trim($log);
			$basicos = $this->analizador->analizar_encabezado($log);
			$basicos['numero'] = $numero;
			$pedidos[] = $basicos; 
			$numero--;
		}
		return $pedidos;
	}
	
	function evt__pedidos__seleccion($id)
	{
		$this->seleccion = $id['numero'];
		$this->cambiar_pantalla = true;
	}
	
	function evt__pedidos__ultima()
	{
		$this->seleccion = 'ultima';
		$this->cambiar_pantalla = true;
	}
		
}

?>