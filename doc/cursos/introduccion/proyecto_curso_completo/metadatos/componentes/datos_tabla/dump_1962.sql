------------------------------------------------------------
--[1962]--  sedes_incEdificios 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('curso', '1962', NULL, NULL, 'toba', 'objeto_datos_tabla', NULL, NULL, NULL, NULL, 'sedes_incEdificios', NULL, NULL, NULL, 'curso', 'curso', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2007-05-16 16:11:54');
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, ap, ap_clase, ap_archivo, tabla, alias, modificar_claves) VALUES ('curso', '1962', NULL, NULL, '1', NULL, NULL, 'soe_edificios', NULL, '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '584', 'edificio', 'E', '1', 'soe_edificios_edificio_seq', '-1', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '585', 'institucion', 'E', '0', '', '-1', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '586', 'sede', 'E', '0', '', '-1', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '587', 'nombre', 'C', '0', '', '255', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '588', 'calle', 'C', '0', '', '50', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '589', 'numero', 'C', '0', '', '5', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '590', 'piso', 'C', '0', '', '3', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('curso', '1962', '591', 'depto', 'C', '0', '', '30', NULL, '0', '0');