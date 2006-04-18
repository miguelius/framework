------------------------------------------------------------
--[1722]--  OBJETO - ci - Eventos 
------------------------------------------------------------
INSERT INTO apex_objeto (proyecto, objeto, anterior, reflexivo, clase_proyecto, clase, subclase, subclase_archivo, objeto_categoria_proyecto, objeto_categoria, nombre, titulo, colapsable, descripcion, fuente_datos_proyecto, fuente_datos, solicitud_registrar, solicitud_obj_obs_tipo, solicitud_obj_observacion, parametro_a, parametro_b, parametro_c, parametro_d, parametro_e, parametro_f, usuario, creacion) VALUES ('toba', '1722', NULL, NULL, 'toba', 'objeto_ei_formulario', 'eiform_eventos', 'admin/objetos_toba/ci/eiform_eventos.php', NULL, NULL, 'OBJETO - ci - Eventos', NULL, NULL, NULL, 'toba', 'instancia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2005-11-09 13:43:43');
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug) VALUES ('toba', '143', '1722', 'cancelar', '&Cancelar', '0', '0', '', 'abm-input', NULL, NULL, '1', '', '1', NULL, '0', NULL, 'cargado', NULL, NULL);
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug) VALUES ('toba', '144', '1722', 'aceptar', '&Aceptar', '1', '0', NULL, NULL, NULL, NULL, '1', NULL, '2', NULL, '0', NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_eventos (proyecto, evento_id, objeto, identificador, etiqueta, maneja_datos, sobre_fila, confirmacion, estilo, imagen_recurso_origen, imagen, en_botonera, ayuda, orden, ci_predep, implicito, display_datos_cargados, grupo, accion, accion_imphtml_debug) VALUES ('toba', '145', '1722', 'modificacion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '3', NULL, '1', NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ut_formulario (objeto_ut_formulario_proyecto, objeto_ut_formulario, tabla, titulo, ev_agregar, ev_agregar_etiq, ev_mod_modificar, ev_mod_modificar_etiq, ev_mod_eliminar, ev_mod_eliminar_etiq, ev_mod_limpiar, ev_mod_limpiar_etiq, ev_mod_clave, clase_proyecto, clase, auto_reset, ancho, ancho_etiqueta, campo_bl, scroll, filas, filas_agregar, filas_agregar_online, filas_undo, filas_ordenar, columna_orden, filas_numerar, ev_seleccion, alto, analisis_cambios) VALUES ('toba', '1722', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '500', '150px', NULL, NULL, NULL, '1', '1', NULL, '1', NULL, '1', '1', NULL, 'NO');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4374', 'ayuda', 'ef_editable_multilinea', 'ayuda', NULL, 'filas: 4;
columnas: 60;', '3', 'Ayuda', NULL, 'Texto orientativo a mostrar cuando se posiciona el mouse sobre el elemento grafico que dispara el evento.', NULL, NULL, '4', '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4375', 'confirmacion', 'ef_editable_multilinea', 'confirmacion', NULL, 'filas: 4;
columnas: 60;', '2', 'Confirmacion', NULL, 'Texto de confirmacion a mostrar antes de disparar el evento.', NULL, NULL, '4', NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4376', 'estilo', 'ef_editable', 'estilo', NULL, 'tamano: 40;', '1', 'Estilo', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4377', 'sobre_fila', 'ef_checkbox', 'sobre_fila', NULL, 'valor: 1;
valor_no_seteado: 0;', '4', 'A nivel de fila', NULL, 'Para aquellos objetos que manejan filas, el evento se incluye en cada una de estas.', NULL, '1', NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4378', 'maneja_datos', 'ef_checkbox', 'maneja_datos', NULL, 'valor: 1;
valor_no_seteado: 0;
estado: 1;', '5', 'Maneja datos', NULL, 'Si un evento maneja datos realiza validaciones de lo editado y generalmente acarrea estos datos como parametros del evento. En el caso de un CI, implica que no se va a procesar ningun EI que esta dentro del mismo.', NULL, '1', NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4379', 'grupo', 'ef_editable', 'grupo', NULL, 'tamano: 40;
maximo: 80;', '6', 'Grupos', NULL, 'Este identificador permite catalogar los eventos en grupos. Hay que ingresar la lista de grupos a los que el evento pertenece seperados por comas. Existen primitivas en los EI que permiten definir que grupo mostrar.', NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4380', 'pantallas', 'ef_multi_seleccion_lista', 'pantallas', NULL, 'dao: get_pantallas_posibles;
clave: identificador;
valor: nombre;
mostrar_utilidades: 1;', '7', 'Pantallas', NULL, 'Pantallas en las que se incluye el evento.', NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4578', 'accion', 'ef_combo_lista_c', 'accion', NULL, 'no_seteado: Ninguna;
lista: H,Impresion HTML;', '8', 'Accion predefinida', NULL, NULL, NULL, NULL, NULL, '0');
INSERT INTO apex_objeto_ei_formulario_ef (objeto_ei_formulario_proyecto, objeto_ei_formulario, objeto_ei_formulario_fila, identificador, elemento_formulario, columnas, obligatorio, inicializacion, orden, etiqueta, etiqueta_estilo, descripcion, colapsado, desactivado, estilo, total) VALUES ('toba', '1722', '4579', 'accion_imphtml_debug', 'ef_checkbox', 'accion_imphtml_debug', NULL, 'valor: 1;
valor_no_seteado: 0;', '9', 'Vista Previa', NULL, NULL, NULL, NULL, NULL, '0');
