------------------------------------------------------------
--[1965]--  sedes_incSedes 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('curso', '1965', NULL, NULL, 'toba', 'objeto_datos_relacion', NULL, NULL, NULL, NULL, 'sedes_incSedes', NULL, NULL, NULL, 'curso', 'curso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-05-16 16:11:54');
INSERT INTO apex_objeto_datos_rel (proyecto, objeto, debug, clave, ap, ap_clase, ap_archivo, sinc_susp_constraints, sinc_orden_automatico) VALUES ('curso', '1965', '0', NULL, '2', NULL, NULL, '0', '1');
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES ('curso', '1965', '30', NULL, 'curso', '1963', 'sede', 'institucion,sede', 'curso', '1962', 'edificios', 'institucion,sede', NULL, '1');
INSERT INTO apex_objeto_datos_rel_asoc (proyecto, objeto, asoc_id, identificador, padre_proyecto, padre_objeto, padre_id, padre_clave, hijo_proyecto, hijo_objeto, hijo_id, hijo_clave, cascada, orden) VALUES ('curso', '1965', '31', NULL, 'curso', '1963', 'sede', 'institucion,sede', 'curso', '1964', 'uas', 'institucion,sede', NULL, '2');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('curso', '905', '1965', '1962', 'edificios', '0', '0', NULL, NULL, '2');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('curso', '906', '1965', '1963', 'sede', '1', '1', NULL, NULL, '1');
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('curso', '907', '1965', '1964', 'uas', '0', '0', NULL, NULL, '3');