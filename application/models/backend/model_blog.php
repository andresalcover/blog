<?php
class model_blog extends CI_Model {
	
	public function get_posts() {
		$results = $this->db->query("SELECT * FROM post ORDER BY id_post ASC")->result();
		
		$data=array();
		
		foreach ($results as $row) {
			 $data[]= $row;
		}
		
		return $data;
	}

	public function get_post($id_post) {
		$results = $this->db->query(
				"SELECT p.title, p.author, p.creation_date, pd.detail FROM post_detail as pd LEFT JOIN " .
				"post as p ON pd.id_post = p.id_post AND p.id_post='" . (int)$id_post . "' AND p.enabled=1")->row_array();
				
		return $results;
	}
	
	public function update_post($id_post, $status) {
		if ($status) {
			$query = "UPDATE post SET status='1', enabled='1' WHERE id_post='" . (int)$id_post ."'";
		} else {
			$query = "UPDATE post SET status='2', enabled='0' WHERE id_post='" . (int)$id_post ."'";
		}
		
		$this->db->query($query);
	}
}