<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('login');
		$this->session->sess_destroy();
	}

	function proses(){
		
		
		$where = array(
			'username' => $this->input->post('username'), 
			'password' => md5($this->input->post('password')),
		);

		$cek = $this->m_login->cek_login('pengguna',$where)->num_rows(); //cheking proses when there an exist id
		$query = $this->m_login->cek_login('pengguna',$where)->row();
		//getting some data from table login

		#proses cheking while data is already exist
		if($cek > 0) // is data avaible ?
		{
			if($query->role == 'atasan'){
				$data_session = array(
					'nama' => $query->nama_lengkap,
					'stat' => 'login',
					'ha' => $query->role,
				);
				$this->session->set_userdata($data_session);
				redirect('atasan/','refresh');
			}else{
				$data_session = array(
					'nama' => $query->nama_lengkap,
					'stat' => 'login',
					'ha' => $query->role,
				);
				$this->session->set_userdata($data_session);
				redirect('admin','refresh');
			}
		}else{
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Ooops... ! ! USER INVALID</h4>
				</div>');
			redirect('login','refresh',$data);
		}

	}

	function logout(){
		$this->session->sess_destroy();
		$data = array( 
			'alert' => $this->session->flashdata('Berhasil Logout')
		);
		redirect('login','refresh',$data);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */