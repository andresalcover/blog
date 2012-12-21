<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	
	public function get_user_by_id($id) {
		$sql = "SELECT id, name, password FROM users WHERE id=".$id;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			
			return $row;
		}
		else
			return FALSE;		
	}
	
	public function get_user_by_name($name) {
		$sql = "SELECT id, name, password FROM users WHERE name='".$name."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			
			return $row;
		}
		else
			return FALSE;
	}
}
/* End of file edit.php */
/* Location: ./application/models/article/edit.php */