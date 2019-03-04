<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atasan extends CI_Controller {

	var $bobot = array(
		'1' => 'Sama Penting Dengan',
		'2' => 'Mendekati Sedikit Lebih Penting',
		'3' => 'Sedikit Lebih Penting',
		'4' => 'Mendekati Lebih Penting',
		'5' => 'Lebih Penting',
		'6' => 'Mendekati Lebih Penting',
		'7' => 'Sangat Penting',
		'8' => 'Mendekati Mutlak',
		'9' => 'Mutlak Sangat Penting',
	);

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('stat'))){
			redirect('login','refresh');
		}else{

		$this->load->model('crud');
		$this->load->model('AHP');
		$this->load->model('AHP2');
		}
		//Do your magic here
	}

	public function index()
	{
		$data = array(
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'nilai_preferensi' => $this->bobot,
			'kriteria' => $this->db->get('kriteria')->result(),
			'alternatif' => $this->db->get('alternatif')->result(),
			'url'=> 'background-image: url("../assets/images/back5.png");',
			'gambar' => 'background-image: url("../assets/images/bg.jpeg");',
		);
		//echo json_encode($data);
		$this->load->view('Header', $data);
		$this->load->view('index');
		#$this->load->view('Footer');
	}

}

/* End of file Atasan.php */
/* Location: ./application/controllers/Atasan.php */