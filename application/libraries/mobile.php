<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Class: Mobile
 * Type: Library
 * Version: 1.0
 * File: mobile.php
 * Description: class for mobile detection
 * Uses wurfl-dbapi
*/


require_once(str_replace(SYSDIR.'/', '', BASEPATH).'wurfl-dbapi/TeraWurfl.php');

class Mobile {

	private $_wurflObj;
	private $_is_wireless;
	private $_is_smarttv;
	private $_is_tablet;
	private $_is_phone;
	private $_is_mobile_device;
	
	private $_deviceinfo;
	
	public function __construct() {
		// instantiate a new TeraWurfl object
		$this->_wurflObj = new TeraWurfl();
	}

	public function init($user_agent='') {
		// Get the capabilities of the current client.
		if (empty($user_agent))
			$this->_wurflObj->getDeviceCapabilitiesFromRequest();
		else
			$this->_wurflObj->getDeviceCapabilitiesFromAgent($user_agent);
			
		
		$this->_is_wireless = $this->_wurflObj->getDeviceCapability('is_wireless_device');
		$this->_is_smarttv = $this->_wurflObj->getDeviceCapability('is_smarttv');
		$this->_is_tablet = $this->_wurflObj->getDeviceCapability('is_tablet');
		$this->_is_phone = $this->_wurflObj->getDeviceCapability('can_assign_phone_number');
		$this->_is_mobile_device = ($this->_is_wireless || $this->_is_tablet);
		
		$this->_deviceinfo = $this->_wurflObj->capabilities['product_info'];
	}
	
	public function is_wireless() 		{return $this->_is_wireless;}
	public function is_smart_tv () 		{return $this->_is_smarttv;}
	public function is_tablet() 		{return $this->_is_tablet;}
	public function is_phone() 			{return $this->_is_phone;}
	public function is_mobile_device() 	{return $this->_is_mobile_device;}
	
	public function getDeviceBrand() {
		return $this->_deviceinfo['brand_name'];
	}
	
	public function getDeviceManufacturer() {
		return $this->_deviceinfo['manufacturer_name'];
	}
	
	public function getDeviceModel() {
		return $this->_deviceinfo['model_name'];
	}
}
/* End of file blog.php */
/* Location: ./application/libraries/mobile.php */