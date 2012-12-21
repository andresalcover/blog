<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Class: Page_private
 * Type: Custom Controller
 * Version 1.0
 * Description: Custon controller with implements data variable 
 * 				for easy working with inner class variables.
 */
class MY_Controller extends CI_Controller {
	
	// variable for data
	protected $data;
	
	function __construct() {
		parent::__construct();
		$this->data = array();
	}
}


/*
 * Class: Page_private
 * Type: Custom Controller
 * Version 1.0
 * File: MY_Controller.php
 * Description: Custom controller base class for private page access
 */

class Page_private extends MY_Controller {
	public function __construct() {
		parent::__construct();

		// variable for saving current user location
		$caller = $this->uri->uri_string();

		// check if user is logged_in
		if (!($this->session->userdata('logged_in'))) {
			$this->session->set_userdata(array('from'=>$caller));
			redirect ('login');
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */