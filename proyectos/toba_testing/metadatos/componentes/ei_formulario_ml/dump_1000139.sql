------------------------------------------------------------
--[1000139]--  Form ML prueba solo-lectura 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba_testing', '1000139', NULL, NULL, 'toba', 'objeto_ei_formulario_ml', 'form_ml_solo_lectura', 'p_acciones/efs/solo_lectura/form_ml_solo_lectura.php', NULL, NULL, 'Form ML prueba solo-lectura', NULL, NULL, NULL, 'toba_testing', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-06-20 10:56:33');
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param, accion_vinculo_target, accion_vinculo_celda) VALUES ('toba_testing', '1000149', '1000139', 'modificacion', '&Modificacion', '1', NULL, NULL, NULL, NULL, NULL, '0', NULL, '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param, accion_vinculo_target, accion_vinculo_celda) VALUES ('toba_testing', '1000148', '1000139', 'carga_defecto', 'Cargar con datos', '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, '2', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param, accion_vinculo_target, accion_vinculo_celda) VALUES ('toba_testing', '1000151', '1000139', 'readonly_server', 'solo_lectura en Server', '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, '3', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param, accion_vinculo_target, accion_vinculo_celda) VALUES ('toba_testing', '1000150', '1000139', 'readonly_cliente', 'solo_lectura en Cliente', '1', NULL, NULL, NULL, NULL, NULL, '1', NULL, '4', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('toba_testing', '1000139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '150px', NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 'NO');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000122', 'combo_dao', 'ef_combo', 'combo_dao', NULL, 'dao_:_ datos_combo_dao_;_
clave_:_ clave_;_
valor_:_ valor_;_
no_seteado_:_ --- Seleccione ---_;_', '1', 'Combo DAO', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000123', 'combo_db', 'ef_combo', 'combo_db', NULL, 'no_seteado_:_ ---Seleccione---_;_
sql_:_ SELECT 1,\'Uno\' UNION SELECT 2,\'Dos\' UNION SELECT 3,\'Tres\'_;_', '2', 'Combo DB', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000124', 'checkbox', 'ef_checkbox', 'checkbox', NULL, 'valor_:_ 1_;_
valor_no_seteado_:_ 0_;_
estado_:_ 0_;_', '3', 'Checkbox', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000125', 'editable', 'ef_editable', 'editable', NULL, '_;_', '5', 'Editable', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000126', 'fecha', 'ef_editable_fecha', 'fecha', NULL, '_;_', '4', 'Fecha', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000127', 'moneda', 'ef_editable_moneda', 'moneda', NULL, 'cifras_:_ 10_;_', '6', 'Moneda', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000128', 'multilinea', 'ef_editable_multilinea', 'multilinea', NULL, '_;_', '7', 'Multil�nea', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000129', 'numero', 'ef_editable_numero', 'numero', NULL, '_;_', '8', 'N�mero', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000130', 'porcentaje', 'ef_editable_numero_porcentaje', 'porcentaje', NULL, '_;_', '9', 'Porcentaje', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000131', 'multi_seleccion', 'ef_multi_seleccion_lista', 'multi_seleccion', NULL, 'dao_:_ datos_combo_dao_;_
clave_:_ clave_;_
valor_:_ valor_;_', '10', 'Multi-Selecci�n', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000132', 'popup', 'ef_popup', 'popup', NULL, 'item_destino_:_ 3273_;_', '12', 'Popup', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000133', 'upload', 'ef_upload', 'upload', NULL, '_;_', '13', 'Upload', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba_testing', '1000139', '1000134', 'multi_sel_check', 'ef_multi_seleccion_check', 'multi_sel_check', NULL, 'dao_:_ datos_combo_dao_;_
clave_:_ clave_;_
valor_:_ valor_;_
mostrar_utilidades_:_ 1_;_', '11', 'Multi-Selecci�n (check)', NULL, NULL, NULL, NULL, NULL, '0');
