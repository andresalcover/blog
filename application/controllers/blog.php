<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Class: Blog
 * Type: Controller
 * Version: 1.0
 * File: blog.php
 * Description: Blog frontend controller
 */
class Blog extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('mobile');
		
		$mobile = new Mobile();
		
		$mobile->init();
		//$mobile->init("Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Safari/535.19");
		
		// check if current device is a mobile device so get mobile info
		$this->data['mobile_info'] = array();
		if ($mobile->is_mobile_device()) {
			$this->data['mobile_info']['brand'] 		= $mobile->getDeviceBrand();
			$this->data['mobile_info']['manufacturer'] 	= $mobile->getDeviceManufacturer();
			$this->data['mobile_info']['model'] 		= $mobile->getDeviceModel();
		}
		
		$this->load->model('frontend/model_blog');
	}

	public function index()
	{
		$this->data['heading_title'] 	= 'Bienvenido al Blog para prueba kitmaker';
		$this->data['message'] 			= $this->session->userdata('message');
		$this->data['add_post_button'] 	= anchor('blog/new_post', '<i class="icon-plus-sign icon-white"></i> A&ntilde;adir Post', 'class="btn btn-warning"');
		
		$this->session->unset_userdata('message');
		$results = $this->model_blog->get_posts();
		
		$this->data['posts'] = array();
		
		foreach ($results as $row) {
			$this->data['posts'][] = array(
				'author' 			=> $row->author,
				'title'				=> $row->title,
				'post_intro'		=> htmlentities($row->post_intro),
				'creation_date' 	=> $row->creation_date,
				'read_more_link'	=> anchor('blog/article?id='.$row->id_post, '<i class="icon-eye-open icon-white"></i> Leer m&aacute;s', 'class="btn btn-info"') 
			);
		}
		
		// render view
		$this->load->view('frontend/header',array('title'=>'Blog para prueba kitmaker', 'base_url'=>base_url()));
		$this->load->view('frontend/blog', $this->data);
		$this->load->view('frontend/footer', array('base_url'=>base_url(), 'mobile_info'=>$this->data['mobile_info']));
	}
	
	public function article() {
		$id_post = (int)$this->input->get('id',TRUE);
		
		if (!$id_post) {
			redirect('error/not_found');
		}

		$post_info = $this->model_blog->get_post($id_post); 
		
		if ($post_info) {
			$this->data['title'] 	= $post_info['title'];
			$this->data['author'] 	= $post_info['author'];
			$this->data['detail'] 	= html_entity_decode($post_info['detail']);
		}
		$this->data['post'] = $this->model_blog->get_post($id_post);
		$this->data['back_url'] = base_url();
		
		// render view
		$this->load->view('frontend/header',array('title'=>'Blog para prueba kitmaker', 'base_url'=>base_url()));
		if ($this->data['post']) {
			$this->load->view('frontend/post_detail',$this->data);
		} else {
			$this->load->view('frontend/no_post');
		}
		$this->load->view('frontend/footer', array('base_url'=>base_url(), 'mobile_info'=>$this->data['mobile_info']));
	}
	
	public function new_post() {
		$this->data['author'] 	= $this->input->post('author','');
		$this->data['title'] 	= $this->input->post('title', '');
		$this->data['detail'] 	= $this->input->post('detail','');
		
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->validate()) {
			if ($this->add_post()) {
				redirect('/blog/success_post');
			}
		}
		
		$this->data['heading_title'] 	= "Nuevo Post";
		$this->data['base_url'] 		= base_url();		
		$this->data['message']			= $this->session->userdata('message');
		$this->session->unset_userdata('message');
		
		if (isset($this->data['errors'])) {
			foreach ($this->data['errors'] as $error_name => $error ) {
				$this->data[$error_name] = $error;
			}
		}
		
		// render view
		$this->load->view('frontend/header',array('title'=>'Blog para prueba kitmaker', 'base_url'=>base_url()));
		$this->load->view('frontend/new_post',$this->data);
		$this->load->view('frontend/footer', array('base_url'=>base_url(), 'mobile_info'=>$this->data['mobile_info']));
	}
	
	private function add_post() {
		$data = array();
		$data['author'] 	= $this->data['author'];
		$data['title'] 		= $this->data['title'];
		$data['post_intro'] = (strlen($this->data['detail'])<300)?$this->data['detail']:strstr($this->data['detail'],0,299);
		$data['detail'] 	= $this->data['detail'];
		return $this->model_blog->add($data);
	}
	
	public function success_post() {
		$this->data['redirect_url'] = base_url();
		$this->load->view('frontend/header',array('title'=>'Post a&ntilde;adido', 'base_url'=>base_url()));
		$this->load->view('frontend/success_post',$this->data);
		$this->load->view('frontend/footer', array('base_url'=>base_url()));
	}

	private function validate() {
		if (!isset($this->data['author']) || empty($this->data['author'])) {
			$this->data['errors']['error_author'] = 'Necesita indicar el nombre del autor!';
		}	
		
		if (!isset($this->data['title']) || empty($this->data['title'])) {
			$this->data['errors']['error_title'] = 'Necesita indicar un t&iacute;tulo!';
		}
		if (!isset($this->data['detail']) || empty($this->data['detail'])) {
			$this->data['errors']['error_detail'] = 'Necesita introducir un texto para el post!';
		}
		
		if (isset($this->data['errors'])) {
			$this->session->set_userdata(array('message'=>'Se han encontrado errores'));			
			return FALSE;
		}
		else 
			return TRUE;
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */