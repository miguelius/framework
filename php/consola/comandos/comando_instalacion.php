<?php
require_once('comando_toba.php');

class comando_instalacion extends comando_toba
{
	static function get_info()
	{
		return "Administracion de la INSTALACION";
	}

	function mostrar_observaciones()
	{
		$this->consola->mensaje("Directorio BASE: " . toba_dir() );
		$this->consola->enter();
	}

	function get_info_extra()
	{
		$salida = "Path: ".toba_dir();
		$salida .= "\nVersi�n: ".toba_modelo_instalacion::get_version_actual()->__toString();
		$instalacion = $this->get_instalacion();
		if ($instalacion->existe_info_basica()) {
			$grupo = $instalacion->get_id_grupo_desarrollo();
			if (isset($grupo)) {
				$salida .= "\nGrupo de desarrollo: ".$grupo;
			}
		}
		return $salida;
	}
	
	//-------------------------------------------------------------
	// Opciones
	//-------------------------------------------------------------
	
	/**
	 * Ejecuta una instalacion completa del framework para desarrollar un nuevo proyecto
	 * @gtk_icono instalacion.png
	 */
	function opcion__instalar()
	{
		$id_instancia = $this->get_entorno_id_instancia(true);		
		$nombre_toba = 'toba_'.toba_modelo_instalacion::get_version_actual()->get_release('_');
		$alias = '/'.'toba_'.toba_modelo_instalacion::get_version_actual()->get_release();
		$this->consola->titulo("Instalacion Toba ".toba_modelo_instalacion::get_version_actual()->__toString());

		//--- Verificar instalacion
		if (get_magic_quotes_gpc()) {
			$this->consola->mensaje("------------------------------------");
			throw new toba_error("ERROR: Necesita desactivar las 'magic_quotes_gpc' en el archivo php.ini (ver http://www.php.net/manual/es/security.magicquotes.disabling.php)");	
		}
		if (! extension_loaded('pdo')) {
			$this->consola->mensaje("------------------------------------");
			throw new toba_error("ERROR: Necesita activar la extension 'pdo' en el archivo php.ini");
		}
		if (! extension_loaded('pdo_pgsql')) {
			$this->consola->mensaje("------------------------------------");
			throw new toba_error("ERROR: Necesita activar la extension 'pdo_pgsql' en el archivo php.ini");
		}		
		$version_php = shell_exec('php -v');
		if ($version_php == '') {
			$this->consola->mensaje("------------------------------------");
			throw new toba_error("ERROR: El comando 'php' no se encuentra en el path actual del sistema");
		}

		//--- Borra la instalacion anterior??
		$forzar_instalacion = true;		
		if (toba_modelo_instalacion::existe_info_basica() ) {
			toba_modelo_instalacion::borrar_directorio();
		}
		//--- Crea la INSTALACION		
		if ($forzar_instalacion) {
			$id_desarrollo = $this->definir_id_grupo_desarrollo();
			toba_modelo_instalacion::crear($id_desarrollo, $alias );			
		}
		
		//--- Crea la definicion de bases
		$base = $nombre_toba;
		if (! $this->get_instalacion()->existe_base_datos_definida( $base ) ) {
			do {
				$profile = $this->consola->dialogo_ingresar_texto( 'Ubicaci�n del servidor Postgres (ej. localhost)', true);
				$usuario = $this->consola->dialogo_ingresar_texto( 'Usuario del servidor (ej. dba)', true);
				$clave = $this->consola->dialogo_ingresar_texto( 'Clave de conexi�n', false);
				$datos = array(
					'motor' => 'postgres7',
					'profile' => $profile,
					'usuario' => $usuario,
					'clave' => $clave,
					'base' => $base,
					'encoding' => 'LATIN1',
					'schema' => $id_instancia
				);
				$this->get_instalacion()->agregar_db( $base, $datos );
				//--- Intenta conectar al servidor
				$puede_conectar = $this->get_instalacion()->existe_base_datos($base, array('base' => 'template1'), true);
				if ($puede_conectar !== true) {
					$this->consola->mensaje("\nNo es posible conectar con el servidor, por favor reeingrese la informaci�n de conexi�n. Mensaje:");
					$this->consola->mensaje($puede_conectar."\n");
				}				
			} while ($puede_conectar !== true);
		}	

		//--- Si la base existe, pregunta por un nombre alternativo, por si no quiere pisarla
		if ($this->get_instalacion()->existe_base_datos($base, array(), false, $id_instancia)) {
			$nueva_base = $this->consola->dialogo_ingresar_texto("La base '$base' ya contiene un schema '$id_instancia', puede ingresar un nombre ".
																"de base distinto sino quiere sobrescribir los datos actuales: (ENTER sobrescribe la actual)", false);			
			if ($nueva_base != '') {																
				$datos['base'] = $nueva_base;
				$this->get_instalacion()->agregar_db( $base, $datos );
			}
		}
		
		$id_proyecto = '';
		/*if ($this->consola->dialogo_simple('Desea crear un nuevo proyecto durante la instalaci�n?', false)) {
			//--- Pregunta identificador del Proyecto
			$id_proyecto = $this->consola->dialogo_ingresar_texto( 'Identificador del proyecto a crear (no utilizar mayusculas o espacios, puede ser vacio si no se quiere crear)', false);
		} else {
			$this->consola->mensaje("Puede crearlo m�s adelante ejecutando el comando 'toba proyecto crear'");
		}*/

		//--- Si ingreso un proyecto y existe, lo borra
		if ($id_proyecto != '') {
			$existe_proyecto = toba_modelo_proyecto::existe($id_proyecto);
			if ($existe_proyecto && $forzar_instalacion) {
				toba_manejador_archivos::eliminar_directorio(  toba_dir() . "/proyectos/" . $id_proyecto );
				$existe_proyecto = false;
			}
		}
		
		//--- Crea la instancia
		$proyectos = toba_modelo_proyecto::get_lista();
		if (isset($proyectos['toba_testing'])) {
			//--- Elimina el proyecto toba_testing 
			unset($proyectos['toba_testing']);
		}
		toba_modelo_instancia::crear_instancia( $id_instancia, $base, $proyectos );
		
		//-- Carga la instancia
		$instancia = $this->get_instancia();
		if (!$instancia->existe_modelo() || $forzar_instalacion) {
			$instancia->cargar( true );
		}
		
		//--- Crea el proyecto
		if ($id_proyecto != '' && !$existe_proyecto ) {
			toba_modelo_proyecto::crear( $instancia, $id_proyecto, array() );
			$nuevo_proyecto = $this->get_proyecto($id_proyecto);			
		}
		
		//--- Vincula un usuario a todos los proyectos y se instala el proyecto
		$instancia->agregar_usuario( 'toba', 'Usuario Toba', 'toba');
		foreach( $instancia->get_lista_proyectos_vinculados() as $id_proyecto ) {
			$proyecto = $instancia->get_proyecto($id_proyecto);
			$grupo_acceso = $proyecto->get_grupo_acceso_admin();
			$proyecto->vincular_usuario('toba', array($grupo_acceso));
		}
		
		//--- Crea el login y exporta el proyecto
		if (isset($nuevo_proyecto)) {
			$nuevo_proyecto->actualizar_login();	
			$nuevo_proyecto->exportar();	
		}

		$instancia->exportar_local();
		
		//--- Crea los nuevos alias
		$instancia->crear_alias_proyectos();
		
		//--- Ejecuta instalaciones particulares de cada proyecto
		foreach( $instancia->get_lista_proyectos_vinculados() as $id_proyecto ) {
			$instancia->get_proyecto($id_proyecto)->instalar();
		}		

		//--- Mensajes finales
		$this->consola->titulo("Configuraciones Finales");
		$toba_conf = toba_modelo_instalacion::dir_base()."/toba.conf";
		if (toba_manejador_archivos::es_windows()) {		
			$toba_conf = toba_manejador_archivos::path_a_unix($toba_conf);
			$this->consola->mensaje("1) Agregue al archivo '\Apache2\conf\httpd.conf' la siguiente directiva: ");
			$this->consola->mensaje("");
			$this->consola->mensaje("     Include \"$toba_conf\"");;
		} else {
			$this->consola->mensaje("1) Ejecutar el siguiente comando como superusuario: ");
			$this->consola->mensaje("");			
			$this->consola->mensaje("     ln -s $toba_conf /etc/apache2/sites-enabled/$nombre_toba");
		}
		$this->consola->mensaje("");
		$url = $instancia->get_proyecto('toba_editor')->get_url();
		$this->consola->mensaje("Reinicie el servicio apache e ingrese al framework navegando hacia ");
		$this->consola->mensaje("");
		$this->consola->mensaje("     http://localhost$url");		
		$this->consola->mensaje("");
		
			
		$this->consola->mensaje("");

		$release = toba_modelo_instalacion::get_version_actual()->get_release();
		if (toba_manejador_archivos::es_windows()) {
			if (isset($_SERVER['USERPROFILE'])) {
				$path = $_SERVER['USERPROFILE'];
			} else {
				$path = toba_dir()."\\bin";
			}
			$path .= "\\entorno_toba_$release.bat";
			$bat = "@echo off\n";
			$bat .= "set toba_dir=".toba_dir()."\n";
			$bat .= "set toba_instancia=$id_instancia\n";
			$bat .= "set PATH=%PATH%;%toba_dir%/bin\n";
			$bat .= "echo Ejecute 'toba' para ver la lista de comandos disponibles.\n";
			file_put_contents($path, $bat);
			$this->consola->mensaje("2) Se genero el siguiente .bat:");
			$this->consola->mensaje("");
			$this->consola->mensaje("   $path");
			$this->consola->mensaje("");
			$this->consola->mensaje("Para usar los comandos toba ejecute el .bat desde una sesi�n de consola (cmd.exe)");
			
		} else {
			$path = toba_dir()."\\bin";
			$path .= "/entorno_toba_$release.sh";
			$bat .= "export toba_dir=".toba_dir()."\n";
			$bat .= "export toba_instancia=$id_instancia\n";
			$bat .= 'export PATH="$toba_dir/bin:$PATH'."\n";
			$bat .= "echo \"Ejecute 'toba' para ver la lista de comandos disponibles.\"\n";
			file_put_contents($path, $bat);
			chmod($path, 0755);
			$this->consola->mensaje("2) Se genero el siguiente ejecutable:");
			$this->consola->mensaje("");
			$this->consola->mensaje("   $path");
			$this->consola->mensaje("");
			$sh = basename($path);
			$this->consola->mensaje("Para usar los comandos toba ejecute antes el .sh precedido por un punto y espacio");
			
		}
		$this->consola->mensaje("");
		$this->consola->mensaje("3) Entre otras cosas puede crear un nuevo proyecto ejecutando el comando");
		$this->consola->mensaje("");
		$this->consola->mensaje("   toba proyecto crear");		
	}
	
	/**
	* Crea una instalaci�n b�sica.
	* @gtk_icono nucleo/agregar.gif
	*/
	function opcion__crear()
	{
		if( ! toba_modelo_instalacion::existe_info_basica() ) {
			$this->consola->titulo( "Configurando INSTALACION en: " . toba_modelo_instalacion::dir_base() );
			$id_grupo_desarrollo = self::definir_id_grupo_desarrollo();
			$alias = self::definir_alias_nucleo();
			toba_modelo_instalacion::crear( $id_grupo_desarrollo, $alias );
			$this->consola->enter();
			$this->consola->mensaje("La instalacion ha sido inicializada");
			$this->consola->mensaje("Para definir bases de datos, utilize el comando 'toba base registrar -d [nombre_base]'");
		} else {
			$this->consola->enter();
			$this->consola->mensaje( 'Ya existe una INSTALACION.' );
			$this->consola->enter();
		}
	}
	
	
	/**
	 * Muestra informaci�n de la instalaci�n.
	 * @gtk_icono info_chico.gif
	 * @gtk_no_mostrar 1
	 * @gtk_separador 1 
	 */
	function opcion__info()
	{
		print_r($_SERVER);
		if ( toba_modelo_instalacion::existe_info_basica() ) {
			$this->consola->enter();
			//VERSION
			$this->consola->lista(array(toba_modelo_instalacion::get_version_actual()->__toString()), "VERSION");
			// INSTANCIAS
			$instancias = toba_modelo_instancia::get_lista();
			if ( $instancias ) {
				$this->consola->lista( $instancias, 'INSTANCIAS' );
			} else {
				$this->consola->enter();
				$this->consola->mensaje( 'ATENCION: No existen INSTANCIAS definidas.');
			}
			// BASES
			$this->mostrar_bases_definidas();
			// ID de grupo de DESARROLLO
			$grupo = $this->get_instalacion()->get_id_grupo_desarrollo();
			if ( isset ( $grupo ) ) {
				$this->consola->lista( array( $grupo ), 'ID grupo desarrollo' );
			} else {
				$this->consola->enter();
				$this->consola->mensaje( 'ATENCION: No esta definido el ID del GRUPO de DESARROLLO.');
			}
			// PROYECTOS
			$proyectos = toba_modelo_proyecto::get_lista();
			if ( $proyectos ) {
				$lista_proyectos = array();
				foreach ($proyectos as $dir => $id) {
					$lista_proyectos[] = "$id ($dir)";
				}
				$this->consola->lista( $lista_proyectos, 'PROYECTOS (s�lo en la carpeta por defecto)' );
			} else {
				$this->consola->enter();
				$this->consola->mensaje( 'ATENCION: No existen PROYECTOS definidos.');
			}
		} else {
			$this->consola->enter();
			$this->consola->mensaje( 'La INSTALACION no ha sido inicializada.');
		}
	}
	
	/**
	* Crea una instancia
	* @consola_no_mostrar 1 
	* @gtk_icono instancia.gif 
	* @gtk_param_extra crear_instancia
	*/	
	function opcion__crear_instancia($datos)
	{
		//------ESTO ES UN ALIAS DE INSTANCIA::CREAR
		require_once('comando_instancia.php');
		$comando = new comando_instancia($this->consola);
		$comando->opcion__crear($datos);
	}
	
	/**
	 * Cambia los permisos de los archivo para que el usuario Apache cree directorios y pueda crear y leer carpetas navegables 
	 * @consola_parametros [-u usuario apache, se asume www-data] [-g grupo de usuarios, no se asume ninguno]
	 * @gtk_icono  password.png
	 */
	function opcion__cambiar_permisos()
	{
		$param = $this->get_parametros();
		$grupo = isset($param['-g']) ? $param['-g'] : 'null';
		$usuario = isset($param['-u']) ? $param['-u'] : 'www-data';
		$toba_dir = toba_dir();
		$this->consola->subtitulo('Cambiando permisos de archivos navegables');
		$comandos = array(
			array("chown $usuario $toba_dir/www -R", "Archivos navegables comunes:\n"),
			array("chmod o+w $toba_dir/www -R", ''),			
			array("chown $usuario $toba_dir/instalacion -R", "Archivos de configuraci�n:\n"),
			array("chmod o+w $toba_dir/instalacion -R", ''),			
			array("chown $usuario $toba_dir/temp -R", "Archivos temporales comunes:\n"),
			array("chmod o+w $toba_dir/temp", '')
		);
		foreach (toba_modelo_instalacion::get_lista_proyectos() as $proyecto) {
			$id_proyecto = basename($proyecto);
			$comandos[] = array("chown $usuario $proyecto/www -R", "Archivos navegables de $id_proyecto:\n");
			$comandos[] = array("chmod o+w $proyecto/www -R", '');
			$comandos[] = array("chown $usuario $proyecto/temp -R", "Archivos temporales de $id_proyecto:\n");
			$comandos[] = array("chmod o+w $proyecto/temp -R", '');
		}		
		foreach ($comandos as $comando) {
			$this->consola->mensaje($comando[1], false);
			$this->consola->mensaje("   ".$comando[0]. exec($comando[0]));
		}
		
		if (isset($grupo)) {
			$comando = "chgrp $grupo $toba_dir -R";
			$this->consola->subtitulo("\nCambiando permisos globales para el grupo $grupo");
			$this->consola->mensaje("   ".$comando. exec($comando));
			$comando = "chmod g+w $toba_dir -R";
			$this->consola->mensaje("   ".$comando. exec($comando));
		}
	}

	/**
	 * Elimina los logs locales de la instalacion, instancias y proyectos contenidos
	 */
	function opcion__eliminar_logs()
	{
		$this->get_instalacion()->eliminar_logs();
	}
	
	/**
	 * Cambia el n�mero de desarrollador y deja las instancias listas
	 */
	function opcion__cambiar_id_desarrollador()
	{
		$id_grupo_desarrollador = $this->definir_id_grupo_desarrollo();
		$this->get_instalacion()->set_id_desarrollador($id_grupo_desarrollador);		
	}
	

	/**
	 * Migra la instalaci�n de versi�n. 
	 * @consola_parametros Opcionales: [-d 'desde']  [-h 'hasta'] [-R 0|1].
	 * @gtk_icono convertir.png
	 */
	function opcion__migrar_toba()
	{
		$instalacion = $this->get_instalacion();
		//--- Parametros
		$param = $this->get_parametros();
		$desde = isset($param['-d']) ? new version_toba($param['-d']) : $instalacion->get_version_anterior();
		$hasta = isset($param['-h']) ? new version_toba($param['-h']) : $instalacion->get_version_actual();
		$recursivo = (!isset($param['-R']) || $param['-R'] == 1);
		//$verbose = (isset($param['-V']));

		if ($recursivo) {
			$texto_recursivo = ", sus instancias y proyectos";
		}
		$desde_texto = $desde->__toString();
		$hasta_texto = $hasta->__toString();
		$this->consola->titulo("Migraci�n de la instalaci�n actual".$texto_recursivo." desde la versi�n $desde_texto hacia la $hasta_texto.");

		$versiones = $desde->get_secuencia_migraciones($hasta);
		if (empty($versiones)) {
			$this->consola->mensaje("No es necesario ejecutar una migraci�n entre estas versiones");
			return ;
		} 
		
		//$this->consola->lista($versiones, "Migraciones disponibles");
		//$this->consola->dialogo_simple("");		
		$instalacion->migrar_rango_versiones($desde, $hasta, $recursivo);
	}		
	
	/**
	* Incluye en el archivo toba.conf las configuraciones de alias definidas en instalacion.ini e instancia.ini
	*/
	function opcion__publicar()
	{
		if (! $this->get_instalacion()->esta_publicado()) {
			$this->get_instalacion()->publicar();
			$this->consola->mensaje('OK. Debe reiniciar el servidor web para que los cambios tengan efecto');
		} else {
			throw new toba_error("La instalaci�n ya se encuentra publicada. Debe despublicarla primero");
		}
	}	
	
	/**
	* Quita del archivo toba.conf los alias de la instalacion y de los proyectos
	*/
	function opcion__despublicar()
	{
		if ($this->get_instalacion()->esta_publicado()) {
			$this->get_instalacion()->despublicar();
			$this->consola->mensaje('OK. Debe reiniciar el servidor web para que los cambios tengan efecto');
		} else {
			throw new toba_error("La instalaci�n no se encuentra actualmente publicada.");
		}
	}		
	
	//-------------------------------------------------------------
	// Interface
	//-------------------------------------------------------------

	/**
	*	Consulta al usuario el ID del grupo de desarrollo
	*/
	protected function definir_id_grupo_desarrollo()
	{
		do {
			$es_invalido = false;
			$id_desarrollo = $this->consola->dialogo_ingresar_texto('Ingrese el numero de desarrollador (por defecto 0)', false);
			$maximo = 2147;
			$mensaje = "Debe ser un numero entre 0 y 2147, mas info en http://desarrollos.siu.edu.ar/trac/toba/wiki/Referencia/CelulaDesarrollo";
			if ($id_desarrollo == '') {
				$id_desarrollo = 0;
			}
			if (! is_numeric($id_desarrollo)) {
				$es_invalido = true;
				$this->consola->mensaje($mensaje);
			}
			if ($id_desarrollo < 0 || $id_desarrollo > $maximo) {
				$es_invalido = true;
				$this->consola->mensaje($mensaje);
			}				
		} while ($es_invalido);
		$id_desarrollo = (int) $id_desarrollo;
		return $id_desarrollo;		
	}


	protected function definir_alias_nucleo()
	{
		$this->consola->enter();		
		$this->consola->subtitulo('Definir el nombre del ALIAS del n�cleo Toba');
		$this->consola->mensaje('Este alias se utiliza para consumir todo el contenido navegable de Toba');
		$this->consola->enter();
		$resultado = $this->consola->dialogo_ingresar_texto( 'Nombre del Alias (por defecto "toba")', false );
		if ( $resultado == '' ) {
			return '/toba';
		} else {
			return '/'.$resultado;	
		}
		
	}
	

	

}
?>
