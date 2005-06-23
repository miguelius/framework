<?
//Generacion: 23-06-2005 16:53:52
//Fuente de datos: 'comechingones'
require_once('nucleo/persistencia/db_registros_s.php');

class dbr_test_db_registros_01 extends db_registros_s
//db_registros especifico de la tabla 'test_db_registros_01'
{
	function __construct($id, $fuente, $tope_registros=0, $utilizar_transaccion=false, $memoria_autonoma=false)
	{
		$definicion['tabla']='test_db_registros_01';
		$definicion['clave'][0]='id';
		$definicion['no_nulo'][0]='id';
		$definicion['no_nulo'][1]='nombre';
		$definicion['columna'][0]='nombre';
		$definicion['columna'][1]='descripcion';
		parent::__construct($id, $definicion, $fuente, $tope_registros, $utilizar_transaccion, $memoria_autonoma);
	}	
	
	function cargar_datos_clave($id)
	{
		$where[] = "id = '$id'";
		$this->cargar_datos($where);
	}
}
?>