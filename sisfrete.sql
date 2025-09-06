# First challenge
SELECT 
    c.id AS customer_id,
    c.name AS customer_name,
    COUNT(o.id) AS total_orders,
    SUM(o.price) AS total_revenue
FROM customers c
JOIN orders o ON o.customer_id = c.id
WHERE o.created_at >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
GROUP BY c.id, c.name
ORDER BY total_revenue DESC;

# Melhorias: Indexar a coluna created_at para melhorar a velocidade de consulta, e caso for uma tabela com muitos registros e muito usada, iria cachear o resultado de consultas.

#Second Challenge
WITH ranked_products AS (
    SELECT 
        pt.id AS category_id,
        pt.name AS category_name,
        p.id AS product_id,
        p.name AS product_name,
        SUM(op.amount) AS total_sold,
        ROW_NUMBER() OVER (PARTITION BY pt.id ORDER BY SUM(op.amount) DESC) AS rn
    FROM order_product op
    JOIN products p ON p.id = op.product_id
    JOIN product_product_type ppt ON ppt.product_id = p.id
    JOIN product_types pt ON pt.id = ppt.product_type_id
    GROUP BY pt.id, pt.name, p.id, p.name
)
SELECT *
FROM ranked_products
WHERE rn = 1
ORDER BY category_name;

# Melhorias: Indexar os joins order_product.product_id, product_product_type.product_id, e product_product_type.product_type_id para acelerar a velocidade e também como no exemplo anterior usar a estratégia de cache. 
