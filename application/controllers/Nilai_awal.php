<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_awal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_alternatif');
	}

	function update_nilai_awal(){
		$data = $this->input->post();

		$id = $this->input->post('id_alternatif');

		$nilai = $this->input->post('nilai');
		$total = 0;
		
		foreach ($nilai as $key => $value) {
			$idket = $key + 1;
			$query = $this->Mod_alternatif->update_nilai_detail($value, $id, $idket);
			$total += $value;

		}

		$total = $total / count($nilai);

		if($total > 0 && $total <= 40){
			$keterangan = 'Kurang';
		}elseif($total > 50 && $total <= 60){
			$keterangan = 'Buruk';
		}elseif ($total > 60 && $total <= 70) {
			$keterangan = 'Cukup Buruk';
		}elseif ($total > 70 && $total <= 80) {
			$keterangan = 'Cukup Baik';
		}elseif($total > 80  && $total <= 90){
			$keterangan = 'Baik';
		}else{
			$keterangan = 'Sangat Baik';
		}

		$query2 = $this->Mod_alternatif->update_nilai($total, $id, $keterangan);

		#var_dump($query);

		if($query2 == true){

			$this->session->set_flashdata('msg', '<script>alert("Berhasil Update")</script>');
			redirect('alternatif/Nilai_awal','refresh');

		}



	}

}

/* End of file Nilai_awal.php */
/* Location: ./application/controllers/Nilai_awal.php */