<?php

class Hackathon_Recommend_Model_Mysql4_Recommend extends Mage_Core_Model_Mysql4_Abstract
{
	public function _construct()
    {
        $this->_init('recommend/recommend', 'product_id');
    }
}
