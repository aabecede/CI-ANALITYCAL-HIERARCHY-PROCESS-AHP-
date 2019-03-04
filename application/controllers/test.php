<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

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
		if($this->session->userdata('stat'!= 'login') or $this->session->userdata('ha') != 'atasan'){
			redirect('login','refresh');
		}else{
			$this->load->model('crud');
			$this->load->model('AHP');
			$this->load->model('AHP2');
		}
		//Do your magic her
	}

	public function index()
	{
		$data = array(

			'data' => $this->crud->alternatif(),
			'bobot' => $this->bobot,
			'kriteria' => $this->crud->kriteria(),
		);

		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';

		$this->load->view('test/inputan', $data);
	}

	public function kriteria()
	{
		$data = array(
			'input' => $this->input->post(),
			'alke' => $this->crud->kriteria(),
		);

		$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $data['input']);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$data['ahp'] = $ahp;
		$ahp = $this->AHP->normalisasi_prioritas($data['alke'], $ahp);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$data['ahp2'] = $ahp;
		$ahp = $this->AHP->konsisten($data['alke'], $ahp);

		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		//$this->load->view('test/hasil',$data);
	}

	//perhitunga

	function perbandingan_kriteria(){
		//$input = $this->input->post();
		//$alternatif = $this->crud->alternatif();
		
		
			//echo str_replace(['],[','[[',']]'],'<br>',json_encode($inputan['alternatif1'][1][2])); echo '<hr>';

		$data = array(
			'data' => $this->input->post(),
			'alke' => $this->crud->alternatif(),
		//	'input' => $this->input->post('kriteria'),
		);

		#$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $data['data']);
		//$this->pre($ahp);
		//$this->pre($ahp);
		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';

		$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $data['data']);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$data['ahp'] = $ahp;
		$ahp = $this->AHP->normalisasi_prioritas($data['alke'], $ahp);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$data['ahp2'] = $ahp;

		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$this->load->view('test/hasil',$data);
	}

	//function pe


	//CRUD

	function ins_nilai_kriteria(){
		$input = $this->input->post();
		$inputan = array(
			'kriteria' => $this->input->post('kriteria'),
			'alternatif1' => $this->input->post('alternatif1'),
			'bobot' => $this->input->post('bobot'),
			'alternatif2' => $this->input->post('alternatif2'),
		);
		$cc = count($inputan['alternatif1']);
		#$this->pre($inputan);

		for ($i=0; $i <= $cc ; $i++) { 
			
			for ($j=$i+1; $j <= $cc ; $j++) { 

				$cek = $this->db->query('select * from hasil_kriteria where kriteria = ? and alternatif1 = ? and alternatif2 = ? and baris = ? and kolom = ?',array($inputan['kriteria'], $inputan['alternatif1'][$i][$j], $inputan['alternatif2'][$i][$j], $i, $j))->row();
				if($cek == true){
					$query = $this->db->query('update hasil_kriteria set bobot = ?  where kriteria = ? and alternatif1 =? and alternatif2 = ? and baris = ? and kolom = ?',array($inputan['bobot'][$i][$j], $inputan['kriteria'], $inputan['alternatif1'][$i][$j], $inputan['alternatif2'][$i][$j], $i, $j));
				}else{
					$query = $this->db->query('insert into hasil_kriteria values("'.$inputan['kriteria'].'","'.$inputan['alternatif1'][$i][$j].'","'.$inputan['bobot'][$i][$j].'","'.$inputan['alternatif2'][$i][$j].'","'.$i.'","'.$j.'")');	
				}
				
				

			}

		}
		#$query = $this->db->query

		if($query == true){
			echo '<script>alert("Berhasil");</script>';
			redirect('test/perbandingan_kriteria','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}
	}

	function ins_kriteria(){

		$inputan = $this->input->post();

		$query = $this->db->insert('kriteria', $inputan);

		if($query == true){
			echo '<script>alert("Sukses Tambah data")</script>';
			redirect('test/kriteria','refresh');
		}else{
			echo '<script>alert("Error")</script>';
			redirect('test/kriteria','refresh');
		}

	}

	function del_kriteria($id){
		
		//$query = $this->db->query('delete kriteria where id = ?',array($id));
		$query = $this->db->query('delete from kriteria where id = ?',array($id));


		if($query == true){
			echo '<script>alert("Sukses Delete data")</script>';
			redirect('test/kriteria','refresh');
		}else{
			echo '<script>alert("Error")</script>';
			redirect('test/kriteria','refresh');
		}

	}

	function up_kriteria($id){
		echo $id;
	}

	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file test.php */
/* Location: ./application/controllers/test.php */