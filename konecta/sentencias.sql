SELECT p.nombre, SUM(c.cantidad) as cantidad
    FROM producto p JOIN compra c ON c.id_producto = p.id_producto
    GROUP BY p.id_producto
    ORDER BY SUM(c.cantidad) DESC LIMIT 1;

SELECT nombre, SUM(stock) as stock
    FROM producto
    GROUP BY id_producto
    ORDER BY SUM(stock) DESC LIMIT 1;