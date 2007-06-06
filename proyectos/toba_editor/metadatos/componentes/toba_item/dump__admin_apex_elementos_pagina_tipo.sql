------------------------------------------------------------
--[/admin/apex/elementos/pagina_tipo]--  Tipo de PAGINA 
------------------------------------------------------------

------------------------------------------------------------
-- apex_item
------------------------------------------------------------

--- INICIO Grupo de desarrollo 0
INSERT INTO apex_item (item_id, proyecto, item, padre_id, padre_proyecto, padre, carpeta, nivel_acceso, solicitud_tipo, pagina_tipo_proyecto, pagina_tipo, actividad_buffer_proyecto, actividad_buffer, actividad_patron_proyecto, actividad_patron, nombre, descripcion, actividad_accion, menu, orden, solicitud_registrar, solicitud_obs_tipo_proyecto, solicitud_obs_tipo, solicitud_observacion, solicitud_registrar_cron, prueba_directorios, zona_proyecto, zona, zona_orden, zona_listar, imagen_recurso_origen, imagen, parametro_a, parametro_b, parametro_c, publico, redirecciona, usuario, creacion) VALUES (
	'182', --item_id
	'toba_editor', --proyecto
	'/admin/apex/elementos/pagina_tipo', --item
	'177', --padre_id
	'toba_editor', --padre_proyecto
	'/configuracion', --padre
	'0', --carpeta
	'0', --nivel_acceso
	'web', --solicitud_tipo
	'toba', --pagina_tipo_proyecto
	'titulo', --pagina_tipo
	'toba', --actividad_buffer_proyecto
	'0', --actividad_buffer
	'toba', --actividad_patron_proyecto
	'abms_cuadro_proyecto', --actividad_patron
	'Tipo de PAGINA', --nombre
	'Los [wiki:Referencia/TipoPagina tipos de p�gina] determinan la salida anterior y posterior a las pantallas de una operaci�n. Cada [wiki:Referencia/Item �tem] tiene un tipo de p�gina asociado.', --descripcion
	'', --actividad_accion
	'1', --menu
	'10', --orden
	'0', --solicitud_registrar
	NULL, --solicitud_obs_tipo_proyecto
	NULL, --solicitud_obs_tipo
	NULL, --solicitud_observacion
	'0', --solicitud_registrar_cron
	NULL, --prueba_directorios
	NULL, --zona_proyecto
	NULL, --zona
	NULL, --zona_orden
	'0', --zona_listar
	'proyecto', --imagen_recurso_origen
	'tipo_pagina.gif', --imagen
	NULL, --parametro_a
	NULL, --parametro_b
	NULL, --parametro_c
	'0', --publico
	'0', --redirecciona
	NULL, --usuario
	'2004-04-12 14:52:51'  --creacion
);
--- FIN Grupo de desarrollo 0

------------------------------------------------------------
-- apex_item_objeto
------------------------------------------------------------
INSERT INTO apex_item_objeto (item_id, proyecto, item, objeto, orden, inicializar) VALUES (
	NULL, --item_id
	'toba_editor', --proyecto
	'/admin/apex/elementos/pagina_tipo', --item
	'1835', --objeto
	'0', --orden
	NULL  --inicializar
);