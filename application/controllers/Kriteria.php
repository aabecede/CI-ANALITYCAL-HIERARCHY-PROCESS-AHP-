<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

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
			$this->load->model('Mod_kriteria');
			$this->load->model('Mod_alternatif');
		}
		//Do your magic here
	}

	public function index()
	{
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'nilai_preferensi' => $this->bobot,
			//tambahan
			'data' => $this->crud->alternatif(),
			'bobot' => $this->bobot,
			'kriteria' => $this->crud->kriteria(),
			'url'=> 'background-image: url("../assets/images/back5.png");',
		);

		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';
		$this->load->view('Header', $data);
		$this->load->view('kriteria/Nindex');
		$this->load->view('Footer');
	}

	public function analisa(){
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'nilai_preferensi' => $this->bobot,
			//tambahan
			'data' => $this->crud->alternatif(),
			'bobot' => $this->bobot,
			'kriteria' => $this->crud->kriteria(),
			'hasil_kriteria' => $this->db->get('hasil_kriteria')->result(),
			'url'=> 'background-image: url("../../assets/images/back5.png");',
		);

		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';
		$this->load->view('Header', $data);
		$this->load->view('kriteria/analisa');
		$this->load->view('Footer');
	}


	public function perbandingan_kriteria(){
		//$input = $this->input->post();
		//$alternatif = $this->crud->alternatif();
		
		
			//echo str_replace(['],[','[[',']]'],'<br>',json_encode($inputan['alternatif1'][1][2])); echo '<hr>';

		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			'nilai_preferensi' => $this->bobot,
			//tambahan
			'data' => $this->db->get('hasil_kriteria')->result(),
			//'data_id' => $this->db->group_by('kriteria')->get('hasil_kriteria')->result(),
			'alke' => $this->crud->alternatif(),
			'kriteria' => $this->db->get('kriteria')->result(),
			'url'=> 'background-image: url("../../assets/images/back5.png");',
		);

		$ahp = $this->AHP2->perbandingan_kriteria($data['data'], $data['kriteria']);
		$data['ahp1'] = $ahp;
		/*$this->pre($ahp);
		die;*/
		//$ahp = $this->AHP2->normalisasi_prioritas($data['alke'], $data['data'], $ahp);
		$ahp = $this->AHP2->normalisasi_kriteria($ahp, $data['data'], $data['kriteria']);
		$data['ahp2'] = $ahp;
		/*$this->pre($ahp);
		die;*/
		$ahp = $this->AHP2->konsisten($data['data'], $ahp);
		$data['ahp3'] = $ahp;
		/*$this->pre($ahp);
		die;*/
		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';

		/*$ahp = $this->AHP->perbandingan_alternatif($data['alke'], $data['input']);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$data['ahp'] = $ahp;
		$ahp = $this->AHP->normalisasi_prioritas($data['alke'], $ahp);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$data['ahp2'] = $ahp;

		echo str_replace(['],[','[[',']]'],'<br>',json_encode($ahp)); echo '<hr>';
		$this->load->view('test/hasil',$data);*/
		/*echo str_replace(['],[','[[',']]'],'<br>',json_encode($data)); echo '<hr>';*/
		$this->load->view('Header', $data, FALSE);
		$this->load->view('kriteria/Nilai_prio');
		$this->load->view('Footer');
	}

	public function hasil_perhitungan(){
		

			$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'alternatif' => $this->db->get('alternatif')->result(),
			'hasil_alternatif' => $this->Mod_alternatif->get_group(),
			'kriteria' => $this->db->get('kriteria')->result(),
			'nilai' => $this->db->get('prioritas_alternatif')->result(),
			'prioritas_kriteria' => $this->db->get('prioritas_kriteria')->result(),

			//get table
			'nama_alternatif' => $this->Mod_alternatif->get_group(),
			'nilai_awal' => $this->Mod_alternatif->get_nilai_alternatif(),
			'url'=> 'background-image: url("../../assets/images/back5.png");',
		);

		$ahp = $this->AHP2->ranking($data['alternatif'], $data['nilai'], $data['prioritas_kriteria']);
		$data['ahp'] = $ahp;

	/*	$this->pre($data);
		die;*/

		foreach ($data['nilai_awal'] as $key => $value) {
			$nilai_awal[$key] = $value->nilai;
		}

		#$this->pre($data['nilai_awal']);
		#die;

		arsort($nilai_awal);
		$nett = array();
		$rank = 1;

		foreach ($nilai_awal as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank_awal'] = $nett;

		

		arsort($ahp);
		$nett = array();
		$rank = 1;

		foreach ($ahp as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank'] = $nett;

		

		if(!empty($data['prioritas_kriteria']) and !empty($data['nilai']) and !empty($nilai_awal))	{

			$this->load->view('Header', $data, FALSE);
			$this->load->view('hasil/perangkingan');
			$this->load->view('Footer');

		}else{
			
			$this->session->set_flashdata('msg', '<script>alert("Data Perhitungan Belum Tersedia")</script>');
			redirect('alternatif/','refresh');		
		}

	}

	function ins_nilai_kriteria(){
		$input = $this->input->post();
		$inputan = array(
			
			'kriteria1' => $this->input->post('kriteria1'),
			'bobot' => $this->input->post('bobot'),
			'kriteria2' => $this->input->post('kriteria2'),
		);
		$cc = count($inputan['kriteria1']);

		/*$this->pre($inputan);
		die;*/

		for ($i=0; $i <= $cc ; $i++) { 
			
			for ($j=$i+1; $j <= $cc ; $j++) { 

				$cek = $this->db->query('select * from hasil_kriteria where kriteria1 = ? and kriteria2 = ?',array($inputan['kriteria1'][$i][$j], $inputan['kriteria2'][$i][$j]))->row();
				if($cek == true){
					$query = $this->db->query('update hasil_kriteria set bobot = ?  where kriteria1 =? and kriteria2 = ?',array($inputan['bobot'][$i][$j], $inputan['kriteria1'][$i][$j], $inputan['kriteria2'][$i][$j]));
				}else{
					$query = $this->db->query('insert into hasil_kriteria values("'.$inputan['kriteria1'][$i][$j].'","'.$inputan['bobot'][$i][$j].'","'.$inputan['kriteria2'][$i][$j].'")');	
				}
				
				

			}

		}
		#$query = $this->db->query

		if($query == true){
			echo '<script>alert("Berhasil");</script>';
			redirect('kriteria/perbandingan_kriteria','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		$this->pre($input);

		

	}

	function ins_prioritas(){
		$input = $this->input->post();

		$inputan = array(
			'kriteria' => $this->input->post('kriteria'),
			'alternatif' => $this->input->post('alternatif'),
			'prioritas' => $this->input->post('prioritas'),
		);

		$jumlah = count($input['kriteria']);

		for ($i=0; $i < $jumlah ; $i++) { 
			
			$cek = $this->db->query('select * from prioritas_kriteria where kriteria = ? and alternatif = ?',array($inputan['kriteria'][$i], $input['alternatif'][$i]))->row();

			if($cek == true){
				$query = $this->db->query('update prioritas_kriteria set prioritas = ? where kriteria = ? and alternatif = ?',array($input['prioritas'][$i], $input['kriteria'][$i], $input['alternatif'][$i]));
			}else{
				$query = $this->db->query('insert into prioritas_kriteria values ("", "'.$input['kriteria'][$i].'", "'.$input['alternatif'][$i].'", "'.$input['prioritas'][$i].'")');
			}

		}
		

		if($query == true){
			echo '<script>alert("Prioritas Tersimpan");</script>';
			redirect('kriteria/perbandingan_kriteria','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		#$this->pre($input);
	}

	function save_prioritas(){
		$input = $this->input->post();

		/*$this->pre($input);
		die;*/

		foreach ($input['kriteria'] as $key => $value) {
			
			$cek = $this->db->query('select * from prioritas_kriteria where kriteria = ? and periode = ?',array($input['kriteria'][$key], $input['periode']))->row();

			if($cek != null){

				$query = $this->db->query('update prioritas_kriteria set prioritas = ? where kriteria = ? and periode = ?',array($input['prioritas'][$key] ,$input['kriteria'][$key], $input['periode']));

			}else{
				$query = $this->db->query('insert into prioritas_kriteria(kriteria, prioritas, periode) values("'.$input['kriteria'][$key].'","'.$input['prioritas'][$key].'", "'.$input['periode'].'")');
			}
		}

		if($query == true){
			echo '<script>alert("Prioritas Tersimpan");</script>';
			redirect('kriteria/analisa','refresh');
		}else{
			echo '<script>alert("Gagal");</script>';
		}

		//$this->pre($input);

	}



	public function ins_kriteria()
	{
		$input = $this->input->post();
		$nama = $this->input->post('nama');

		$cek = $this->Mod_kriteria->get_nama($nama); //cek is name is already exist ?

		if(empty($cek)){

			$query = $this->db->insert('kriteria', $input);
			if($query == true){
					$this->session->set_flashdata('msg', 
	                '<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>Success Adding Data</h4>
					</div>');
			
				redirect('kriteria','refresh');
			}else{
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Oppss !</h4>
				False in Progress.
				</div>');
			redirect('kriteria','refresh');
			}
			$this->pre($query);

		}else{

			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Oppss !</h4>
				Kriteria is already in.
				</div>');
			redirect('kriteria','refresh');

		}
	}

	public function del_kriteria($id)
	{
		$query = $this->db->delete('kriteria', 'id = '.$id.'');
		if($query == true){
			echo '<script>alert("Berhasil Delete")</script>';
			redirect('kriteria','refresh');
		}else{
			echo '<script>alert("Fakse")</script>';
		}
		$this->pre($query);
	}

	public function edit()
	{
		$id =  $this->input->post('rowid');

		$query = $this->db->get_where('kriteria', array('id' => $id))->row();

		echo "<form action='".site_url('kriteria/update')."' method='post' enctype='multipart/form-data'>
				<div class='col-lg-6'>
					<input type='hidden' name='id' value='$id'>
					<label>Nama Kriteria</label>
					<input type='text' name='nama' class='form-control' value='$query->nama'>
					<input type='submit' class='btn btn-dark'>
				</div>
			 </form>";

		#echo json_encode($query);
		#$cek = $this->db->get_where('kriteria', array('id' => $id))->row();
		#$this->pre($cek);
	}
	function update(){
		$table = 'kriteria';
		$data = $this->input->post();
		$nama = $data['nama'];

		$cek = $this->Mod_kriteria->get_nama($nama); // cek is name already in ?

		if(empty($cek)){
			$query = $this->db->update($table, $data, array('id' => $data['id']));
			if($query == true){
					$this->session->set_flashdata('msg', 
                '<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Success Update</h4>
				</div>');

			redirect('kriteria','refresh');

			}else{

					$this->session->set_flashdata('msg', 
	                '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>Oppss !</h4>
					Galat Process.
					</div>');
				redirect('kriteria','refresh');

			}

		}else{
				$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>Oppss !</h4>
				Kriteria is already in.
				</div>');
			redirect('kriteria','refresh');
		}

	}

	function print_doc(){
		$data = array(
			//bawaan
			'role' => $this->session->userdata('ha'),
			'nama' => $this->session->userdata('nama'),
			//tambahan
			'alternatif' => $this->db->get('alternatif')->result(),
			'hasil_alternatif' => $this->Mod_alternatif->get_group(),
			'kriteria' => $this->db->get('kriteria')->result(),
			'nilai' => $this->db->get('prioritas_alternatif')->result(),
			'prioritas_kriteria' => $this->db->get('prioritas_kriteria')->result(),

			//get table
			'nama_alternatif' => $this->Mod_alternatif->get_group(),
			'nilai_awal' => $this->Mod_alternatif->get_nilai_alternatif(),
			'url'=> 'background-image: url("../../assets/images/back5.png");',
		);

		$ahp = $this->AHP2->ranking($data['alternatif'], $data['nilai'], $data['prioritas_kriteria']);
		$data['ahp'] = $ahp;

		#$this->pre($ahp);
		#die;

		foreach ($data['nilai_awal'] as $key => $value) {
			$nilai_awal[$key] = $value->nilai;
		}

		#$this->pre($data['nilai_awal']);
		#die;

		arsort($nilai_awal);
		$nett = array();
		$rank = 1;

		foreach ($nilai_awal as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank_awal'] = $nett;

		

		arsort($ahp);
		$nett = array();
		$rank = 1;

		foreach ($ahp as $key => $value) {
			$nett[$key] = $rank;
			$rank++;
		}

		$data['rank'] = $nett;
		#$this->pre($data);
		$this->load->view('Header', $data);
		$this->load->view('Hasil/Print');
		$this->load->view('Footer');

	}


	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

}

/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */