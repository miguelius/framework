------------------------------------------------------------
--[1505]--  OBJETO - EI eventos 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('admin', '1505', NULL, NULL, 'toba', 'objeto_datos_tabla', 'odt_eventos', 'db/odt_eventos.php', NULL, NULL, 'OBJETO - EI eventos', NULL, NULL, NULL, 'admin', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-08-19 17:27:27');
INSERT INTO apex_objeto_db_registros (objeto_proyecto, objeto, max_registros, min_registros, ap, ap_clase, ap_archivo, tabla, alias, modificar_claves) VALUES ('admin', '1505', NULL, NULL, '1', NULL, NULL, 'apex_objeto_eventos', NULL, '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '87', 'proyecto', 'C', '1', NULL, '15', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '88', 'objeto', 'E', '0', NULL, NULL, NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '89', 'identificador', 'C', '0', NULL, '20', NULL, '1', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '90', 'etiqueta', 'C', '0', NULL, '60', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '91', 'maneja_datos', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '92', 'sobre_fila', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '93', 'confirmacion', 'C', '0', NULL, '60', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '94', 'estilo', 'C', '0', NULL, '40', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '95', 'imagen_recurso_origen', 'C', '0', NULL, '10', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '96', 'imagen', 'C', '0', NULL, '60', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '97', 'en_botonera', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '98', 'ayuda', 'C', '0', NULL, '60', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '99', 'orden', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '329', 'ci_predep', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '330', 'implicito', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '331', 'grupo', 'C', '0', NULL, '30', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '335', 'evento_id', 'E', '1', 'apex_objeto_eventos_seq', NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '423', 'display_datos_cargados', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '424', 'accion', 'C', '0', NULL, '1', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '425', 'accion_imphtml_debug', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '427', 'accion_vinculo_target', 'C', '0', NULL, '40', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '428', 'accion_vinculo_celda', 'C', '0', NULL, '40', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '1000050', 'defecto', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '5000001', 'accion_vinculo_carpeta', 'C', '0', NULL, '60', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '5000002', 'accion_vinculo_item', 'C', '0', NULL, '60', NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '5000003', 'accion_vinculo_objeto', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '5000004', 'accion_vinculo_popup', 'E', '0', NULL, NULL, NULL, '0', '0');
INSERT INTO apex_objeto_db_registros_col (objeto_proyecto, objeto, col_id, columna, tipo, pk, secuencia, largo, no_nulo, no_nulo_db, externa) VALUES ('admin', '1505', '5000005', 'accion_vinculo_popup_param', 'C', '0', NULL, '100', NULL, '0', '0');
