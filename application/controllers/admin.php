<?php
/*
 * Class: Admin
 * Type: Controller
 * Version 1.0
 * File: admin.php
 * Description: Backend admin controller
 */
class Admin extends Page_private {
	
	public function __construct() {
		parent::__construct();
		$this->data['button_logout'] = anchor('login/logout', '<i class="icon-share-alt icon-white"></i> Cerrar Sesi&oacute;n', 'class="btn btn-danger pull-right"');
		
		// load model
		$this->load->model('backend/model_blog');
	}
	
	function index() {
		$this->data['heading_title'] = "Gesti&oacute;n de Posts";
		
		$results = $this->model_blog->get_posts();
		
		foreach ($results as $row) {
			// generate action_link
			if (!$row->enabled) {
				$action_link = anchor('admin/enable_post?id='.$row->id_post, '<i class="icon-ok icon-white"></i> Permitir', 'class="btn btn-success"');
			} else {
				$action_link = anchor('admin/disable_post?id='.$row->id_post, '<i class=" icon-ban-circle icon-white"></i> Bloquear', 'class="btn btn-danger"');
			}
			
			// generate status label
			// status: 0 - pending, 1 - approved, 2 - discouraged
			switch ($row->status) {
				case 1: 
					$status = '<span class="label label-success">Aprobado</span>';
					break;
				case 2:  
					$status = '<span class="label label-important">Desaprobado</span>';
					break;
				case 0:
				default: 
					$status = '<span class="label">Pendiente de revisi&oacute;n</span>';
			}
			
			$this->data['posts'][] = array(
				'author' => $row->author,
				'title'	=> $row->title,
				'status' => $status,
				'creation_date' => $row->creation_date,
				'action' => $action_link 
			);
					
		}
		
		$this->data ['message'] = $this->session->userdata('message');
		$this->session->unset_userdata('message');

		$title = 'Dashboard';
		// render view
		$this->load->view('backend/header',array('title'=>$title, 'base_url'=>base_url(), 'button_logout'=>$this->data['button_logout']));
		$this->load->view('backend/dashboard', $this->data);
		$this->load->view('backend/footer', array('base_url'=>base_url()));
	}
	
	function enable_post() {
		$id_post = $this->input->get('id', TRUE);
		
		$this->model_blog->update_post($id_post, TRUE);
		$this->session->set_userdata('message', 'El post ha sido habilitado correctamente!.');
		redirect('admin');
	}
	function disable_post() {
		$id_post = $this->input->get('id', TRUE);
	
		$this->model_blog->update_post($id_post, FALSE);
		$this->session->set_userdata('message', 'El post ha sido bloqueado correctamente!.');
		redirect('admin');
	}
	
} 

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */