<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_blog extends CI_Model {

	public function get_posts() {
		$results = $this->db->query("SELECT * FROM post WHERE enabled='1'")->result();
		
		$data=array();
		
		foreach ($results as $row) {
			 $data[]= $row;
		}
		
		return $data;
	}

	public function get_post($id_post) {
		$results = $this->db->query(
				"SELECT p.title, p.author, p.creation_date, pd.detail FROM post_detail as pd LEFT JOIN " .
				"post as p ON pd.id_post = p.id_post WHERE p.id_post='" . (int)$id_post . "' AND p.enabled=1")->row_array();
				
		return $results;
	}

	public function add($data) {
		$query = "INSERT into post (author, title, post_intro, creation_date, status, enabled) VALUES (" .
				$this->db->escape($data['author']) . ", " . 
				$this->db->escape($data['title']). ", " .
				$this->db->escape(htmlentities($data['post_intro'])) . ", " .
				"NOW(), 0, 0" . 
				")";
		
		$this->db->query($query);
		$id_post = $this->db->insert_id();
		
		$query = "INSERT into post_detail (id_post, detail) VALUES (" . 
				"'" . (int)$id_post . "', " . 
				$this->db->escape(htmlentities($data['detail'])) . ")";
		
		$this->db->query($query);
		
		// return affectred rows to see if all's ok
		return $this->db->affected_rows();
				
	}
}