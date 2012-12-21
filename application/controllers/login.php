<?php
/*
 * Class: Admin
 * Type: Controller
 * Version 1.0
 * File: admin.php
 * Description: Backend admin controller
 */
class Login extends MY_Controller {
	
	function index() {
		if ($this->session->userdata('logged_in')) {
			redirect('admin');
		}
		else {
			$this->data['base_url'] = base_url();
			if ($this->check_user()) {
				$from = $this->session->userdata('from');
				if ($from)
					redirect($from);
				else
					redirect('admin');
			}
		}
		$this->load->view('backend/login', $this->data);
	}
	
	public function logout()
	{
		// delete cookie remeber and destroy session
		delete_cookie('ufn');
		$this->session->sess_destroy();
		redirect('login/login');
	}
	
	public function check_user()
	{
		$result = FALSE;
	
		$this->load->model('backend/model_user');
	
	
		// form submit?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// validate user post (username and password)
			$this->data['user'] = $this->input->post('user');
			$this->data['password'] = $this->input->post('password');
			
			if (empty($this->data['user']) || empty($this->data['password'])) {
				$this->data['message'] = 'Datos incorrectos';
				$result = FALSE;
			} else if ( ($user_info = $this->model_user->get_user_by_name($this->data['user'])) == FALSE) {
				$this->data['message'] = 'Nombre usuario incorrecto';
				$result = FALSE;
			} else if ($user_info->password != md5($this->data['password']) ) {
				$this->data['message'] = 'Password incorrecto';
				$result = FALSE;
			} else {
				$result = TRUE;
				$this->session->set_userdata(array('user_id'=>$user_info->id, 'logged_in'=>TRUE));
	
				if ($this->input->post('remember')) {
					$user_coockie = array (
							'name'=>'ufn',
							'value' =>$user_info->id,
							'expire' =>'100000'
					);
					set_cookie($user_coockie);
				}
			}
		} else if ( ($user_id = get_cookie('ufn')) != FALSE ) {
			// user info in cookie? (remember me used)
			if ( ($user_info = $this->model_user->get_user_by_id($user_id)) == FALSE) {
				$result = FALSE;
			} else {
				$result = TRUE;
	
				$this->session->set_userdata(array('user_id'=>$user_info->id, 'logged_in'=>TRUE));
					
				if ($this->input->post('remember')) {
					$user_coockie = array (
							'name'=>'ufn',
							'value' =>$user_info->id,
							'expire' =>'100000'
					);
					set_cookie($user_coockie);
				}
			}
		}
		return $result;
	}	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */