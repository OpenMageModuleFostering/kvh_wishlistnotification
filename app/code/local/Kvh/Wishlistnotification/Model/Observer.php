<?php
class Kvh_Wishlistnotification_Model_Observer 
{
		
		public function sendNotification(Varien_Event_Observer $observer)
		{  	 	
			 
			
			 $emailEnabled = Mage::getStoreConfig('wishlist/notification/notifyenable');
			 
			if(!$emailEnabled)
				return; 
				
			$productId = Mage::app()->getRequest()->getParam('product'); 
			
			if (!$productId) {
				return;
			} 	
			  	
			Mage::helper('wishlistnotification')->sendMail($productId);
			 
		}
}
?>