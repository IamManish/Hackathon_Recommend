<?php
$installer = $this;
$installer->startSetup();
$installer->run("
CREATE VIEW overcart.product_recommendations AS 
SELECT p1.entity_id AS product_id, COUNT(oc2.product_id) AS rank, p2.*
FROM overcart.sales_flat_order_item AS oc1 
JOIN overcart.sales_flat_order_item AS oc2 ON oc1.order_id=oc2.order_id
JOIN overcart.catalog_product_flat_1 AS p2 ON p2.entity_id = oc2.product_id
JOIN overcart.catalog_product_flat_1 AS p1 ON oc1.product_id=p1.entity_id
  WHERE oc1.product_id=p1.entity_id AND oc2.product_id != p1.entity_id
	GROUP BY oc2.product_id ORDER BY rank DESC;
");

$installer->endSetup();
 ?>
