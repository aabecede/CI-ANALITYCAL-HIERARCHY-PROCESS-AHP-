<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('stat'))){
			redirect('login','refresh');
		}else{

		$this->load->model('crud');
		$this->load->model('AHP');
		$this->load->model('AHP2');
		$this->load->model('Mod_admin');
		}
		//Do your magic here
	}

	public function index()
	{
		$data = array(
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'kriteria' => $this->db->get('kriteria')->result(),
			'alternatif' => $this->db->get('alternatif')->result(),
			'url'=> 'background-image: url("../assets/images/back5.png");',
			//table
			'user' => $this->Mod_admin->get_user(),
		);
		//echo json_encode($data);
		$this->load->view('Header', $data);
		$this->load->view('adm/index');
		$this->load->view('Footer');
	}

	function add_user(){
		$query = $this->input->post();

		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'role' => $this->input->post('role'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'com_pas' => $this->input->post('password'),
		);


		$cek = $this->Mod_admin->cek_user($data['username']);
		
		
		if(empty($cek)){
			
			$query = $this->Mod_admin->add_user($data);

			if($query == true){
				$this->session->set_flashdata('msg', '<script>alert("Berhasil Menambah Data")</script>');
				redirect('Admin','refresh');
			}else{
				$this->session->set_flashdata('msg', '<script>alert("GALAT")</script>');
				redirect('Admin','refresh');
			}
			
		}else{
			$this->session->set_flashdata('msg', '<script>alert("USERNAME SUDAH ADA")</script>');
			redirect('Admin','refresh');
		}


	}

	function edit_user($id){
		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'com_pas' => $this->input->post('password'),
		);
		$nama = $this->input->post('username');

		$cek = $this->Mod_admin->cek_user_notlike($nama, $id);

		if(!empty($cek)){
			$this->session->set_flashdata('msg', '<script>alert("USERNAME TELAH TERPAKAI !")</script>');
			redirect('admin','refresh');
		}else{
			$query = $this->Mod_admin->up_user($data, $id);

			if($query == true){
				
				$this->session->set_flashdata('msg', '<script>alert("BERHASIL UPDATE")</script>');
				redirect('admin','refresh');	

			}else{
				
				$this->session->set_flashdata('msg', '<script>alert("GALAT")</script>');
				#redirect('admin','refresh');
				var_dump($query);

			}

			
		}

	}

	function del($id){
		$cek = $this->Mod_admin->del_user($id);

		if(!empty($cek)){
			$this->session->set_flashdata('msg', '<script>alert("Berhasil Delete")</script>');
			redirect('Admin','refresh');
		}else{
			$this->session->set_flashdata('msg', '<script>alert("ID hasnt followed")</script>');
			redirect('Admin','refresh');
		}
	}

	function get_edit(){ //get value edit to modal
		$id = $this->input->post('rowid');

		$data['data'] = $this->Mod_admin->get_where_user($id);
		$this->load->view('Modal/EditUser', $data);

	} 


}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */