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


/*
class Mobile {
	
	private $_wurflDir;
	private $_resourcesDir;
	private $_development;
	private $_wurflFile;
	private $_machMode;
	private $_allowReload;
	private $_persistenceDir;
	private $_cacheDir;
	private $wurflManager;
	
	public function __construct($wurflFile='wurfl.zip', $development=FALSE) {
		$this->_wurflDir 		= '/WURFL';
		$this->_resourcesDir 	= '/resources';
		$this->_development 	= FALSE;
		$this->_wurflFile 		= 'wurfl.zip';
		$this->_machMode 		= 'performance';
		$this->_allowReload		= TRUE;
		$this->_persistenceDir  = $this->_resourcesDir.'/storage/persistence';
		$this->_cacheDir		= $this->_resourcesDir.'/storage/cache';
		$this->wurflManager 	= NULL;
	}
	
	public function set_mach_performance() {
		$this->_machMode = 'performance';
	}
	
	public function set_mach_accuracy() {
		$this->_machMode = 'accuracy';
	}
	
	public function enable_allow_reload() {
		$this->_allowReload = TRUE;
	}
	
	public function disable_allow_reload() {
		$this->_allowReload = FALSE;
	}
	
	public function set_wurflDir ($wurflDir) {
		$this->_wurflDir = $wurflDir;
	}
	
	public function set_resourcesDir($resourcesDir) {
		$this->resourcesDir = $resourcesDir;
	}
	
	public function set_wurflFile($wurflFile) {
		$this->_wurflFile = $wurflFile;
	}
	
	public function set_development_mode() {
		$this->_development = TRUE;
	}
	
	public function set_persistenceDir($persistenceDir) {
		$this->_persistenceDir = $this->_resourcesDir.$persistenceDir;
	}
	
	public function set_cacheDir($cacheDir) {
		$this->_cacheDir = $this->_resourcesDir.$cacheDir;
	}
	
	public function init() {
		// if development mode enable error
		if ($this->_development) {
			ini_set('display_errors', 'on');
			error_reporting(E_ALL);
		}
		
		$wurflDir = dirname(__FILE__) . $this->_wurflDir;
		$resourcesDir = dirname(__FILE__) . $this->_resourcesDir;
		
		require_once $wurflDir.'/Application.php';
		
		$persistenceDir = $this->_persistenceDir;
		$cacheDir = $this->_cacheDir;
		
		// Create WURFL Configuration
		$wurflConfig = new WURFL_Configuration_InMemoryConfig();
		
		// Set location of the WURFL File
		$wurflConfig->wurflFile($resourcesDir.'/'.$this->_wurflFile);
		
		// Set the match mode for the API ('performance' or 'accuracy')
		$wurflConfig->matchMode($this->_machMode);
		
		// Automatically reload the WURFL data if it changes
		$wurflConfig->allowReload($this->_allowReload);
		
		// Setup WURFL Persistence
		$wurflConfig->persistence('file', array('dir' => $persistenceDir));
		
		// Setup Caching
		$wurflConfig->cache('file', array('dir' => $cacheDir, 'expiration' => 36000));
		
		// Create a WURFL Manager Factory from the WURFL Configuration
		$wurflManagerFactory = new WURFL_WURFLManagerFactory($wurflConfig);
		
		// Create a WURFL Manager
		/* @var $wurflManager WURFL_WURFLManager */
/*
		$this->wurflManager = $wurflManagerFactory->create();
	}
	
	public function getDeviceInfo() {
		$wurflInfo = $this->wurflManager->getWURFLInfo();
		
		// This line detects the visiting device by looking at its HTTP Request ($_SERVER)
		$requestingDevice = $this->wurflManager->getDeviceForHttpRequest($_SERVER);
				
		$info = array(
				'brand_name' 		=> $requestingDevice->getCapability('brand_name'),
				'model_name' 		=> $requestingDevice->getCapability('model_name'),
				'marketing_name' 	=> $requestingDevice->getCapability('marketing_name'),
				'resolution_width' 	=> $requestingDevice->getCapability('resolution_width'),
				'resolution_height' => $requestingDevice->getCapability('resolution_height')
			);
		
		return $info;
	}
}


/* End of file blog.php */
/* Location: ./application/libraries/mobile.php */