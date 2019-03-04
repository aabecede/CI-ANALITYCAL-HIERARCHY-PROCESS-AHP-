<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contoh extends CI_Controller {

	public function index()
	{
		$inputan = 5;
		$data = array('barang1','barang2','barang3');
		$perhitungan = array('5','4','3');

		$function = $this->show_barang($data, $perhitungan);

		echo "inputan : $inputan<br>";

		echo str_replace(['],[','[[',']]'],'<br>',json_encode($function)); echo '<hr>';
	}

	function show_barang($data, $perhitungan, $inputan){
		
		return array('data' => $data, 'perhitungan' => $perhitungan);
	}

}

/* End of file Contoh.php */
/* Location: ./application/controllers/Contoh.php */