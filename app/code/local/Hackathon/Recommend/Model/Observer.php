<?php 
class Hackathon_Recommend_Model_Observer
{
    public function orderCustomerProduct(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $customer_id = $order->getCustomerId();
        if($customer_id){
            $items = $order->getAllItems();

            foreach ($items as $item){
                $product_id = $item->getProductId();

            }
        }
    }


    public function viewCustomerProduct(Varien_Event_Observer $observer)
    {

        function is_in_array($array, $key, $key_value){
            $within_array = 'no';
            foreach( $array as $k=>$v ){
                if( is_array($v) ){
                    $within_array = is_in_array($v, $key, $key_value);
                    if( $within_array == 'yes' ){
                        break;
                    }
                } else {
                    if( $v == $key_value && $k == $key ){
                        $within_array = 'yes';
                        break;
                    }
                }
            }
            return $within_array;
        }

        $response = array();
        $results = array();
        $arr = array();
        $user = '';
        $product_id = $observer->getEvent()->getProduct()->getId();
        $customer_id = Mage::getSingleton('customer/session')->getCustomerId();

        $baseDir = Mage::getBaseDir();
        $varDir = $baseDir.DS.'recommended'.DS.'results.json';

        $file = file_get_contents($varDir);
        $data = json_decode($file, true);

        if($customer_id){
            $arr = array(
                "user" => $customer_id,
                "item" => $product_id
            );
            $user = $customer_id;
        } else {
            $vistitorId = Mage::getModel('core/session')->getVisitorId();
            $arr = array(
                "user" => $vistitorId,
                "item" => $product_id
            );
            $user = $vistitorId;
        }

        $data = array_filter($data);

        $users = is_in_array($data, 'user', $user);
        $items = is_in_array($data, 'item', $product_id);

        if(count($data) > 0 && $users =='yes' && $items =='no'){

            array_push($data,$arr);
            $response = $data;

        }
        else if(count($data) > 0 && $users =='yes' && $items =='yes'){

            $response = $data;
        }
        else{

            $response = $arr;

        }

        $fp = fopen($varDir, 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);

    }
}