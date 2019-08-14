<?php
 class Kvh_Wishlistnotification_Helper_Data extends Mage_Core_Helper_Data
{
    	
		public function sendMail($productId)
    	{   
			 $email=Mage::getStoreConfig('wishlist/notification/adminemails');
			  $this->sendEmail(array(
            'email' => $email,
			'product_id'=>$productId
        ));
		
		}
	
		

	public function sendEmail($data)
    {
        if (is_array($data)) {
            $data = new Varien_Object($data);
        } 
		 
		
		$customer = Mage::getSingleton('customer/session')->getCustomer();
		 
		 
        $template = Mage::getStoreConfig('wishlist/notification/email_template');
         
        $identity = Mage::getStoreConfig('wishlist/email/email_identity');
        
		 
		 $product = Mage::getModel('catalog/product')->load($data->getProductId()); 
		 
		 $date=date("M d, Y"); 
		
		 $wishlistblock = Mage::app()->getLayout()->createBlock('core/template')->setData('product',$product)->setTemplate('wishlistnotification/default.phtml')->toHtml();
		 	  
		 
         Mage::getModel('core/email_template')
				->addBcc($data->getEmail())
            	->sendTransactional($template, $identity, $data->getEmail(),"", array(
                        'customer'      => $customer,                        
                         'date' =>$date,
                        'items'       => $wishlistblock,
                    )); 
	  	
		 
		} 
		
		
}
