<?php
class Hackathon_Recommend_Block_Recommend extends Mage_Core_Block_Template
{

    public function getRecommendedProduct()
    {
        $product_id = Mage::registry('current_product')->getId();
        /**
         * Get the resource model
         */
        $resource = Mage::getSingleton('core/resource');

        /**
         * Retrieve the read connection
         */
        $readConnection = $resource->getConnection('core_read');

        $query = 'SELECT * FROM ' . $resource->getTableName('product_recommendations').' WHERE product_id ='.$product_id;

        /**
         * Execute the query and store the results in $results
         */
        $results = $readConnection->fetchAll($query);
        return $results;
    }
}