------------------------------------------------------------
--[1959]--  Tipos Unidades Academicas - datos 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('curso', '1959', NULL, NULL, 'toba', 'objeto_datos_tabla', NULL, NULL, NULL, NULL, 'Tipos Unidades Academicas - datos', NULL, NULL, NULL, 'curso', 'curso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-05-16 15:14:53');
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, ap, ap_clase, ap_archivo, tabla, alias, modificar_claves) VALUES ('curso', '1959', NULL, NULL, '1', NULL, NULL, 'soe_tiposua', NULL, '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1959', '580', 'tipoua', 'E', '1', 'soe_tiposua_tipoua_seq', '-1', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1959', '581', 'descripcion', 'C', '0', '', '50', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1959', '582', 'detalle', 'C', '0', '', '255', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1959', '583', 'estado', 'C', '0', '', '1', NULL, '1', '0');