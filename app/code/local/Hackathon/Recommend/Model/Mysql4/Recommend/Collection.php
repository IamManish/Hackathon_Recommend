<?php

class Hackathon_Recommend_Model_Mysql4_Recommend_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	public function _construct()
    {
	    parent::_construct();
	    $this->_init('recommend/recommend');
	}
}
