<?
require_once("objeto_ei.php");						//Ancestro de todos los OE
require_once("nucleo/lib/manejador_archivos.php");

class objeto_ei_esquema extends objeto_ei
{
	protected $alto;
	protected $ancho;
	protected $contenido;				// Instrucciones GraphViz
	protected $archivo_generado;		// Archivo generado por las instrucciones
	
	function __construct($id)
	{
		parent::__construct($id);
		$this->objeto_js = "objeto_esquema_{$this->id[1]}";	
		$this->submit = "ei_esquema".$this->id[1];	
		$this->alto = isset($this->info_esquema['alto']) ?  $this->info_esquema['alto'] : null;
		$this->ancho = isset($this->info_esquema['ancho']) ?  $this->info_esquema['ancho'] : null;
	}

	function cargar_datos($datos)
	{
		if (isset($datos)) {
			$this->contenido = $datos;	
		}
	}
	
	function obtener_html($cabecera=true)
	{
		echo "<table class='objeto-base' id='{$this->objeto_js}_cont'>";
		echo "<tr><td>";
		$this->barra_superior(null, true,"objeto-ei-barra-superior");
		echo "</td></tr>\n";
		echo "<tr><td><div id='cuerpo_{$this->objeto_js}'>";
		//Campo de sincronizacion con JS
		echo form::hidden($this->submit, '');
		if (isset($this->contenido)) {
			//Se arma el archivo .dot
			toba::get_logger()->debug($this->get_txt() . " [ Diagrama ]:\n$this->contenido");
			$this->generar_esquema($this->contenido, $this->info_esquema['formato'], 
									$this->info_esquema['dirigido'], $this->ancho,
									$this->alto);
		}
		echo "<div class='ei-base'>\n";
		$this->obtener_botones();
		echo "</div>\n";		
		echo "</div></td></tr>\n";
		echo "</table>\n";
	}
	
	static function generar_esquema($contenido, $formato, $es_dirigido=true, $ancho=null, $alto=null)
	{
	    $tipo_salida = null;
		switch ($formato) {
			case 'png':
				$tipo_salida = "image/png";
			case 'gif':
				$tipo_salida = "image/gif";
			break;
			case 'svg':
				$tipo_salida = "image/svg+xml";				
			break;
		}    	    
		$archivo_generado = self::generar_archivo($contenido, $formato, $es_dirigido);
		$parametros = array("archivo" => $archivo_generado, 'tipo_salida' => urlencode($tipo_salida));
		//Vinculo a un item que hace el passthru y borra el archivo
		$url = toba::get_vinculador()->obtener_vinculo_a_item("toba","3068", $parametros,
																false, false, false,
																"", null, null, 'temp');
		self::generar_sentencia_incrustacion($url, $formato, $ancho, $alto);
	}

	static protected function generar_sentencia_incrustacion($url, $formato, $ancho=null, $alto=null)
	{
		$ancho = isset($ancho) ? "width='$ancho'" : "";
		$alto = isset($alto) ? "height='$alto'" : "";
		switch ($formato) {
			case 'png':
			case 'gif':
				echo "<img src='$url' $ancho $alto border='0'>";				
			break;
			case 'svg':
				js::cargar_consumos_globales(array("utilidades/svglib"));
				echo js::abrir();
				echo "//aviso_instalacion_svg()";
				echo js::cerrar();				
				echo "<embed src='$url' type='image/svg+xml' $ancho $alto palette='foreground' pluginspage='http://www.adobe.com/svg/viewer/install/auto'>\n";
				echo "</embed>"; 
			break;
		}
	}
	
	static protected function generar_archivo($contenido, $formato, $es_dirigido = true)
	{
		$nombre_archivo = mt_rand() . '.' . $formato;
		$dir_temp = toba::get_hilo()->obtener_path_temp();
		$grafico = manejador_archivos::path_a_unix( $dir_temp . "/" . mt_rand() . '.dot' );
		$salida = manejador_archivos::path_a_unix( $dir_temp . "/" . $nombre_archivo );
		
		file_put_contents($grafico, $contenido);
		
		$comando  = ($es_dirigido) ? "dot" : "neato";
		$llamada = $comando . " -T". $formato . " -o$salida $grafico";
		
		//Se analiza la salida
		$salida = array();
		$status = 0;
		exec($llamada . " 2>&1 ", $salida, $status);
		if ($status !== 0) {
			if ($status == 1) {
				echo "Para poder visualizar el esquema debe instalar
					<a href='http://www.graphviz.org/Download.php' target='_blank'>GraphViz</a> y reiniciar el servidor web.";
			}
			unlink($grafico);
			throw new excepcion_toba(implode("\n", $salida));
		}
		
		//Se elimina el archivo .dot
		unlink($grafico);
		return $nombre_archivo;
	}	
}
//################################################################################
?>
