------------------------------------------------------------
--[1000177]--  Uso del ef_popup 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba_referencia', '1000177', NULL, NULL, 'toba', 'objeto_ci', 'ci_principal', 'componentes/efs/ef_popup/ci_principal.php', NULL, NULL, 'Uso del ef_popup', NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006-09-01 09:56:05');
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, defecto, display_datos_cargados, grupo, accion, accion_imphtml_debug, accion_vinculo_carpeta, accion_vinculo_item, accion_vinculo_objeto, accion_vinculo_popup, accion_vinculo_popup_param, accion_vinculo_target, accion_vinculo_celda) VALUES ('toba_referencia', '1000197', '1000177', 'refrescar', '&Refrescar', '1', NULL, NULL, NULL, 'apex', 'refrescar.png', '1', NULL, '1', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('toba_referencia', '1000066', '1000177', '1000175', 'form', NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_dependencias (proyecto, dep_id, objeto_consumidor, objeto_proveedor, identificador, parametros_a, parametros_b, parametros_c, inicializar, orden) VALUES ('toba_referencia', '862', '1000177', '1916', 'form_cascada', NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_mt_me (objeto_mt_me_proyecto, objeto_mt_me, ev_procesar_etiq, ev_cancelar_etiq, ancho, alto, posicion_botonera, tipo_navegacion, con_toc, incremental, debug_eventos, activacion_procesar, activacion_cancelar, ev_procesar, ev_cancelar, objetos, post_procesar, metodo_despachador, metodo_opciones) VALUES ('toba_referencia', '1000177', NULL, NULL, NULL, NULL, 'abajo', 'tab_h', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ci_pantalla (objeto_ci_proyecto, objeto_ci, pantalla, identificador, orden, etiqueta, descripcion, tip, imagen_recurso_origen, imagen, objetos, eventos, subclase, subclase_archivo) VALUES ('toba_referencia', '1000177', '1000040', 'formulario', '1', 'Simple', NULL, NULL, 'apex', NULL, 'form', 'refrescar', NULL, NULL);
INSERT INTO apex_objeto_ci_pantalla (objeto_ci_proyecto, objeto_ci, pantalla, identificador, orden, etiqueta, descripcion, tip, imagen_recurso_origen, imagen, objetos, eventos, subclase, subclase_archivo) VALUES ('toba_referencia', '1000177', '1000143', 'cascada', '2', 'En Cascada', NULL, NULL, 'apex', NULL, 'form_cascada', '', NULL, NULL);
