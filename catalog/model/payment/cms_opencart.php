<?php 
/*
*************************************************************************************
Please Do not edit or add any code in this file without permission.

opencart version 1.5.5.1			Cms Version 1.0.0


Module Version. Cms-1.0.0   			Module release: August 16/2017
**************************************************************************************
 */

class ModelPaymentCmsOpencart extends Model {

  	public function getMethod($address, $total) {

		$this->load->language('payment/cms_opencart');		

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('cms_opencart_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
			
		if ($this->config->get('cms_opencart_total') > $total) {

			$status = false;

		} elseif (!$this->config->get('cms_opencart_geo_zone_id')) {

			$status = true;

		} elseif ($query->num_rows) {

			$status = true;

		} else {

			$status = false;

		}	
		$licensekey=$this->config->get('cms_opencart_license_key');
		
		$status = TRUE;

        $image_name =$this->config->get('userfile');
        $image_path = "admin/view/image/payment/$image_name";
		$method_data = array();

		if ($status) {
      		$method_data = array( 

        		'code'       => 'cms_opencart',
        		'title'      => "<div class= 'heading'><div class='cms_opencart'><span >".$this->config->get('cms_opencart_title')."</span> <span > &nbsp; &nbsp;[ ".$this->config->get('cms_opencart_description')." ] </span></div></div>",
				'sort_order' => $this->config->get('cms_opencart_sort_order'),

      		);
    	}
    	return $method_data;

  	}
	
}
?>