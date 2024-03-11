SELECT
    cliente.ID_CLIENTE,
    cliente.NOMBRE_COMPLETO,
    cliente.CLASIFICACION,
    pedido.ID,
    SUM(detalle_pedido.MONTO) AS IMPORTE,
    (
        SELECT
            CASE
                WHEN SUM(detalle_pedido.MONTO) IS NULL THEN 0
                ELSE SUM(detalle_pedido.MONTO)
            END
        FROM
            detalle_pedido
        WHERE
            DETALLE_PEDIDO.AGREGADOS > 0
            AND detalle_pedido.ID_DETALLE = 4
    ) AS IMPORTE_FACTURADO,
        
    (
        SELECT
            CONCAT(bitacora.FECHA, ' ', BITACORA.HORA)
        FROM
            BITACORA
        WHERE
            bitacora.DESCRIPCION LIKE '%AUTORIZADO%'
            AND bitacora.PEDIDO = 3
        LIMIT
            1
    ) AS PEDIDO_AUTORIZADO,
    (
        SELECT
            surtir_pedido.hora_inicio
        FROM
            SURTIR_PEDIDO
        WHERE
            surtir_pedido.id_pedido = 3
    ) AS INICIO_SURTIDO,
    (
        SELECT
            surtir_pedido.hora_final
        FROM
            SURTIR_PEDIDO
        WHERE
            surtir_pedido.id_pedido = 3
    ) AS FIN_SURTIDO,
    (
        SELECT
            CONCAT(bitacora.FECHA, '   ', BITACORA.HORA)
        FROM
            BITACORA
        WHERE
            bitacora.DESCRIPCION LIKE '%CHECADO%'
            AND bitacora.PEDIDO = 3
    ) AS PEDIDO_CHECADO,
    (
        SELECT
            CONCAT(bitacora.FECHA, ' ', BITACORA.HORA)
        FROM
            BITACORA
        WHERE
            bitacora.DESCRIPCION LIKE '%DESCARGADO Y FACTURADO%'
            AND bitacora.PEDIDO = 3
    ) AS PEDIDO_FACTURADO
FROM
    cliente
    INNER JOIN PEDIDO ON CLIENTE.ID_CLIENTE = pedido.CLIENTE
    INNER JOIN DETALLE_PEDIDO ON pedido.ID = detalle_pedido.ID_DETAn SUM(detalle_pedido.monto) IS NULL then 0
    ELSE SUM(detalle_pedido.monto)
)
FROM
    cliente
    INNER JOIN pedido ON cliente.id_cliente = pedido.cliente
    INNER JOIN detalle_pedido ON pedido.id = detalle_pedido.id_detalle;