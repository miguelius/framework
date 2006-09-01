<?php
require_once("zona_editor.php");

class zona_proyecto extends zona_editor
{

	function cargar_info($editable=null)
	//Carga el EDITABLE que se va a manejar dentro de la ZONA
	{
		$sql = 	"	SELECT	*
					FROM	apex_proyecto
					WHERE	proyecto='{$this->editable_id[0]}'";
		$rs =& $db["instancia"][apex_db_con]->Execute($sql);
		if(!$rs){
			throw new toba_error("ZONA-PROYECTO: NO se pudo cargar el editable ".$this->editable_id[0].",".$this->editable_id[1]." - [SQL]  $sql - [ERROR] " . $db["instancia"][apex_db_con]->ErrorMsg() );
			return false;
		}elseif($rs->EOF){
			echo ei_mensaje("ZONA-PROYECTO: El editable solicitado no existe","info");
			return false;
		}else{
			$this->editable_info = current($rs->getArray());
			//ei_arbol($this->editable_info,"EDITABLE");
			$this->editable_id = array( $this->editable_id[0]);
			$this->editable_cargado = true;
			return true;
		}	
	}

	function obtener_html_barra_info()
	//Muestra la seccion INFORMATIVA (izquierda) de la barra
	{
		echo "	<td width='250' class='barra-item-id'>";
		echo "&nbsp;".$this->editable_id[0]."&nbsp;";
//		echo "&nbsp;".$this->editable_id[1]."&nbsp;";
//		echo "&nbsp;".$this->editable_id[1]."@".$this->editable_id[0]."&nbsp;";
		echo "</td>";
		echo "<td width='60%' class='barra-item-tit'>&nbsp;".$this->editable_info['proyecto']."</td>";
	}	

	function obtener_html_barra_inferior()	
	{
		//echo "BARRA inferior<br>"	;	
	}
}
?>