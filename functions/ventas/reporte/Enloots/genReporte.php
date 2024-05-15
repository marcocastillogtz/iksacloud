<?php
    if (isset($_GET['order']) && isset($_GET['user'])) {
        genReport();
    } else {
        echo json_encode(array(
            'error' => array(
                'code' => 400,
                'message' => 'Sin parametros :(ssss',
            ),
        ));
    }

    function genReport(){
        $id = $_GET['order'];
        $user = $_GET['user'];
        
        $VAR_HOST = '192.168.0.38';
        $VAR_USER = 'Marco';
        $VAR_PASSWORD = 'Cbsu_it2024!';
        $VAR_DATABASE = 'iksasocket';

        require '../../../phpjasperxml/PHPJasperXML.inc.php';
        require '../../../phpjasperxml/sample/setting.php';

        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->arrayParameter = array("ID_PEDIDO" => $id, "Observacion" => $user);
        $PHPJasperXML->load_xml_file("../../../Reportes/Ventas/scanloot.jrxml");

        $PHPJasperXML->debugsql = false;
        $PHPJasperXML->transferDBtoArray($VAR_HOST,$VAR_USER,$VAR_PASSWORD,$VAR_DATABASE);
        $PHPJasperXML->outpage('I');

    }
    /* ok
    
        SELECT CLIENTE.ID_CLIENTE,CLIENTE.NOMBRE_COMPLETO,CONCAT_WS(' ',USUARIO.NOMBRE,USUARIO.APELLIDO_P,USUARIO.APELLIDO_M) AS NOMBRE,DETALLE_PEDIDO.CLAVE,DETALLE_PEDIDO.DESCRIPCION,
        CASE
            WHEN DETALLE_PEDIDO.PIEZA > 0 AND DETALLE_PEDIDO.PAQUETE >0 THEN ((CAST(ALMACEN.CANTIDAD AS SIGNED)*CAST(DETALLE_PEDIDO.PAQUETE AS SIGNED))+CAST(DETALLE_PEDIDO.PIEZA AS SIGNED))
            WHEN DETALLE_PEDIDO.PIEZA > 0 THEN DETALLE_PEDIDO.PIEZA ELSE (CAST(ALMACEN.CANTIDAD AS SIGNED)*CAST(DETALLE_PEDIDO.PAQUETE AS SIGNED))
        END AS PIEZAS,
        CASE
            WHEN DETALLE_PEDIDO.PIEZA > 0 AND DETALLE_PEDIDO.PAQUETE >0 THEN (((CAST(ALMACEN.CANTIDAD AS SIGNED)*CAST(detalle_pedido.paquete_sl AS SIGNED))+CAST(DETALLE_PEDIDO.PIEZA AS SIGNED))-(CAST(DETALLE_PEDIDO.PIEZA AS SIGNED)-CAST(DETALLE_PEDIDO.pieza_sl AS SIGNED)))
            WHEN DETALLE_PEDIDO.PIEZA > 0 THEN (DETALLE_PEDIDO.pieza_sl) ELSE (CAST(ALMACEN.CANTIDAD AS SIGNED)*CAST(detalle_pedido.paquete_sl AS SIGNED))
        END AS PIEZA_SL,

        (((CAST(ALMACEN.CANTIDAD AS SIGNED)*CAST(DETALLE_PEDIDO.PAQUETE AS SIGNED))+CAST(DETALLE_PEDIDO.PIEZA AS SIGNED))-(((CAST(ALMACEN.CANTIDAD AS SIGNED)*CAST(detalle_pedido.paquete_sl AS SIGNED))+CAST(DETALLE_PEDIDO.PIEZA AS SIGNED))-(CAST(DETALLE_PEDIDO.PIEZA AS SIGNED)-CAST(DETALLE_PEDIDO.PIEZA_SL AS SIGNED))))
        AS SURTIDO,

        CASE
        WHEN (CAST(DETALLE_PEDIDO.PIEZA AS SIGNED)-CAST(DETALLE_PEDIDO.PIEZA_SL AS SIGNED)) = 0 THEN 'No hubo existencias'
        WHEN (CAST(DETALLE_PEDIDO.PIEZA AS SIGNED)-CAST(DETALLE_PEDIDO.PIEZA_SL AS SIGNED)) > 0 THEN ''
        END AS MENSAJE,
        PEDIDO.FOLIO,
        PEDIDO.OBSERVACION,
        PEDIDO.METODO_ENVIO,
        PEDIDO.FECHA
        FROM PEDIDO
        INNER JOIN DETALLE_PEDIDO ON PEDIDO.ID = DETALLE_PEDIDO.ID_DETALLE
        INNER JOIN CLIENTE ON PEDIDO.CLIENTE = CLIENTE.ID_CLIENTE
        INNER JOIN USUARIO ON PEDIDO.VENDEDOR = USUARIO.id
        INNER JOIN ALMACEN ON DETALLE_PEDIDO.CLAVE = ALMACEN.CLAVE
        WHERE DETALLE_PEDIDO.ID_DETALLE = 43 ORDER BY SURTIDO ASC;
    */