<?php

class Hackathon_Recommend_Model_Recommend extends Mage_Core_Model_Abstract
{
	public function _construct() 
	{
		parent::_construct();       
		$this->_init('recommend/recommend');
	}
}
