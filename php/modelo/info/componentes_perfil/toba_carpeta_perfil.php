<?php
/*
	* Javascript de seleccion en cascada
	* Inspeccionar los nodos para saber si alguno esta activado, si es asi tiene que grabarse tambien.

*/
class toba_carpeta_perfil extends toba_elemento_perfil 
{
	protected $icono = "nucleo/carpeta.gif";
	protected $carpeta = true;

	function permiso_activo()
	{
		foreach($this->hijos as $hijo) {
			if ($hijo->permiso_activo()) return true;
		}
		return false;
	}
	
	//------------------------------------------------
	//----------- Interface FORM
	
	function sincronizar()
	{
		foreach($this->hijos as $hijo) {
			$hijo->sincronizar();
		}
		if ($this->permiso_activo() ) {
			$this->acceso_actual = true;	
		} else {
			$this->acceso_actual = false;
		}
		parent::sincronizar();	
	}

	function set_grupo_acceso($acceso)
	{
		foreach($this->hijos as $hijo) {
			$hijo->set_grupo_acceso($acceso);
		}
		parent::set_grupo_acceso($acceso);
	}
	
	function cargar_estado_post($id){}
	
	function get_input($id)
	{
		$html = '';		
		$id_js = $this->id_js_arbol;
		$id_input = $id.'_carpeta';
		$escapador = toba::escaper();
		if ($this->comunicacion_elemento_input) {
			$img_marcar = toba_recurso::imagen_toba('aplicar.png', false);
			$html .= "<img src='". $escapador->escapeHtmlAttr($img_marcar)."' id='".$escapador->escapeHtmlAttr($id_input.'_img')."' onclick='". $escapador->escapeHtmlAttr($id_js).".marcar(\"". $escapador->escapeHtmlAttr($this->get_id())."\")' />";
		}
		$html .= "<input type='checkbox' value='1' id='". $escapador->escapeHtmlAttr($id_input)."' name='". $escapador->escapeHtmlAttr($id_input)."' onclick='". $escapador->escapeHtmlAttr($id_js).".marcar(\"". $escapador->escapeHtmlAttr($this->get_id())."\", this.value)' />";			
		return $html;
	}
	
}

?>