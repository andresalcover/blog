ScientiaMobile WURFL PHP API
http://www.scientiamobile.com/
http://wurfl.sourceforge.com/
==============================

LICENSE
This program is free software: you can redistribute it and/or modify it under
the terms of the GNU Affero General Public License as published by the Free
Software Foundation, either version 3 of the License, or (at your option) any
later version.

Please refer to the COPYING file distributed with this package for the
complete text of the applicable GNU Affero General Public License.

If you are not able to comply with the terms of the AGPL license, commercial
licenses are available from ScientiaMobile, Inc at http://www.ScientiaMobile.com/

Getting Started
=======================
1) Download a release archive from wurfl site and extract it to a directory 
   suitable for your application.

To start using the API you need to set some configuration options.


For the impatient ones
====================================
Please look sample of the configuration files in examples/demo/ directory.

$wurflDir = dirname(__FILE__) . '/../../../WURFL';
$resourcesDir = dirname(__FILE__) . '/../../resources';

require_once $wurflDir.'/Application.php';

$persistenceDir = $resourcesDir.'/storage/persistence';
$cacheDir = $resourcesDir.'/storage/cache';

// Create WURFL Configuration
$wurflConfig = new WURFL_Configuration_InMemoryConfig();

// Set location of the WURFL File
$wurflConfig->wurflFile($resourcesDir.'/wurfl.zip');

// Set the match mode for the API ('performance' or 'accuracy')
$wurflConfig->matchMode('performance');

// Setup WURFL Persistence
$wurflConfig->persistence('file', array('dir' => $persistenceDir));

// Setup Caching
$wurflConfig->cache('file', array('dir' => $cacheDir, 'expiration' => 36000));

// Create a WURFL Manager Factory from the WURFL Configuration
$wurflManagerFactory = new WURFL_WURFLManagerFactory($wurflConfig);

// Create a WURFL Manager
/* @var $wurflManager WURFL_WURFLManager */
$wurflManager = $wurflManagerFactory->create();

Now you can use some of the WURFLManager class methods;

$device = $wurflManager->getDeviceForHttpRequest($_SERVER);

$device->getCapability("is_wireless_device");


1) Create a configuration object

	a) set the paths to the location of the main wurfl file
		- you can use zip files if you have the zip extension enabled
	
	b) Configure the Persistance provider by specifying the provider and 
		and the extra parameters needed to initialize the provider:
		The API supports the following mechanisms
			- Memcache (http://uk2.php.net/memcache)	
			- APC (Alternative PHP Cache http://uk3.php.net/apc)
			- File
		
		remember that if you want to use the first 2 implementaions you need to 
		install and enable the corresponding extensions.
	
		  
	c) Configure the Cache provider by specifying the provider and 
		and the extra parameters needed to initialize the provider:
		The API supports the following caching mechanisms:
			- Memcache (http://uk2.php.net/memcache)	
			- APC (Alternative PHP Cache http://uk3.php.net/apc)
			- File
			- Null (no caching)
		
		remember that if you want to use the first 2 mechanisms you need to
		install and load the relative modules.
		Please refer to the links for further information how to install and enable 
		the modules.

    1.1 Standard Configuration
    ================================
    // Create WURFL Configuration
    $wurflConfig = new WURFL_Configuration_InMemoryConfig();
    // Set location of the WURFL File
    $wurflConfig->wurflFile($resourcesDir.'/wurfl.zip');
    // Set the match mode for the API ('performance' or 'accuracy')
    $wurflConfig->matchMode('performance');
    // Setup WURFL Persistence
    $wurflConfig->persistence('file', array('dir' => $persistenceDir));
    // Setup Caching
    $wurflConfig->cache('file', array('dir' => $cacheDir, 'expiration' => 36000));

    1.2 From XML Configuration File
    ====================================
    $wurflConfigFile = $resourcesDir.'/wurfl-config.xml';
    // Create WURFL Configuration from an XML config file
    $wurflConfig = new WURFL_Configuration_XmlConfig($wurflConfigFile);

2) Using the WURFL PHP API

    2.1 Getting the device
    ===========================

	You have Four methods for retrieving a device 
		a) getDeviceForRequest(WURFL_Request_GenericRequest $request)
			Where a WURFL_Request_GenericRequest is an object which encapsulates
			userAgent, ua-profile, support for xhtml of the device
		
		b) getDeviceForHttpRequest($_SERVER)
			Most of the time you will use this method, and the API will create the
			the WURFL_Request_GenericRequest object for you
			
		c) getDeviceForUserAgent(string $userAgent)
		    Used to query the API for a given User Agent string
			
	 	d) getDevice(string $deviceID)
		    Gets the device by its device ID (ex: apple_iphone_ver1)
		
		Usage example:
			$device = $wurflManager->getDeviceForHttpRequest($_SERVER);

    2.2 Getting the device properties and its capabiliites
    ===================================================

        - The properites Device ID and Fall Back Device ID are properties of the device:
            $deviceID = $device->id;
            $fallBack = $device->fallBack;

        - To get the value of a capability, use getCapabilityValue()
            $value = $device->getCapabilityValue("capability_name");
            $allCapabilities = $device->getAllCapabilities();
		

    2.3) Useful Methods
    ====================================
    - WURFL_WURFLManager has a bunch of utility methods like:
        - getListOfGroups()
            which returns an array of all group IDs found in the WURFL file.

			

WURFL Reloader
========================
WURFL now can update automaically the cache without any configuration, by checking the modification
time of the wurfl file.  To enable, set allow-reload to true in the config:
    Standard config example: $wurflConfig->allowReload(true);
    XML config example: <allow-reload>true</allow-reload>


If you have any questions, please take a look at the documentation on http://wurfl.sourceforge.net,
and/or the ScientiaMobile Support Forum at http://www.scientiamobile.com/forum

