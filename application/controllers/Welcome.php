<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$bobot = array(array(3,3,5));
		$data = array('aab','dewi','ai');

		$this->show($bobot);

		$hasil = $this->perbandingan($data, $bobot);
		//echo str_replace(['],[','[[',']]'],'<br>',json_encode($hasil)); echo '<hr>';

		$hasil = $this->total($hasil);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($hasil)); echo '<hr>';

		$hasil = $this->nilai_kriteria($hasil);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($hasil)); echo '<hr>';

		$hasil = $this->matrik_baris($hasil);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($hasil)); echo '<hr>';

		$hasil = $this->ratio($hasil);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($hasil)); echo '<hr>';

		$hasil = $this->result($hasil);
		echo str_replace(['],[','[[',']]'],'<br>',json_encode($hasil)); echo '<hr>';
		//echo json_encode($hasil); echo '<hr>';
		#$this->load->view('welcome_message');
	}

	public function show($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}

	function perbandingan($data, $bobot){

		$result = array();
		$total = 0;
		$arr_total = array();
		for ($i=0; $i < sizeof($bobot) ; $i++) { 
			for ($j=0; $j < sizeof($bobot) ; $j++) { 
				
				$val = 1;
				if($i == $j){
					$val = 1;
				}elseif($i < $j){
					$val = round($bobot[$j - $i],4);
				}else{
					$val = round(1/$bobot[$i - $j ],4);#'1/'.$bobot[$j+1];#'1 / $bobot[$j]';
				}

				$result[$i][$j] = $val;
				
			}
			//$total += $result[$i][$j];
			$arr_total[] = $total;
		}

		return $result;

	}

	public function total($bobot){

		
		$result = array();
		foreach ($bobot as $key => $value) {

			/*$total[0] = 0;
			$total[1] = 0;
			$total[2] = 0;*/
			$total[$key] = 0;

			$result_kriteria = array();
			foreach ($bobot[$key] as $keys => $values) {
			//$total[0][] = $bobot[$keys][0].'+';	// for pembuktian
				/*$total[0] += round($bobot[$keys][0],4); //getting total overall from compared
				$total[1] += round($bobot[$keys][1],4);
				$total[2] += round($bobot[$keys][2],4);*/

				$total[$key] += round($bobot[$keys][$key],4);
				
				//$result_kriteria[0][$key][$keys] = round($values / $total[0],2);
				

			}

			
		}
		

		return array('bobot' => $bobot, 'total' =>$total);
	}

	function nilai_kriteria($data){

		$bobot = array();
		$hasil[] = array();
		
		$arr_total = array();
		$priorias = array();

		for ($i=0; $i < sizeof($data['bobot']) ; $i++) { 
			
			$total = 0;

			for ($j=0; $j < sizeof($data['bobot'][$i]) ; $j++) { 
				
				//$bobot[$i][$j] = $data['bobot'][$i][$j];

				$hasil[$i][$j]= round($data['bobot'][$i][$j]/$data['total'][$j],3);
				$total += round($hasil[$i][$j],3);

				
			}
				$priorias = round($total / count($data['bobot'][$i]),3);

				$arr_total[] = $total;
				$arr_prio[] = $priorias;
				
		}

		return array('n' => $hasil, 'jumlah' => $arr_total, 'priorias'=> $arr_prio, 'bobot'=> $data['bobot']);
	}

	function matrik_baris($data){

		$arr_result[] = array();
		
		$arr_total = array();
		for ($i=0; $i <sizeof($data['bobot']) ; $i++) { 

			$total = 0;

			for ($j=0; $j <sizeof($data['bobot'][$i]) ; $j++) { 
				
				$arr_result[$i][$j] = round($data['bobot'][$i][$j]*$data['priorias'][$j],3);
				$total += round($arr_result[$i][$j],3);
			}
			$arr_total[] = $total;
		}

		return array( 'hasil' => $arr_result, 'total_baris'=> $arr_total, 'total_prio' => $data['priorias']);
	}

	function ratio($hasil){

		$arr_total = array();
		//$total = 0;
		for ($i=0; $i < sizeof($hasil['total_prio']) ; $i++) { 
			
			$arr_total[] = $hasil['total_baris'][$i] + $hasil['total_prio'][$i];

		}

		return array('result'=>$arr_total, 'prioritas' => $hasil['total_prio'], 'baris' => $hasil['total_baris']);

	}

	function result($hasil){

		$total = 0;
		$lambda = 0;
		$ci = 0;
		$cr = 0;

		$jumlah = count($hasil['result']);

		for ($i=0; $i < sizeof($hasil['result']) ; $i++) { 
			$total += $hasil['result'][$i];
		}

		$lamda = round($total / $i,3);
		$ci = round(($lamda - $i) / $i,3);

		if($jumlah == 2){
			$bagi = 0;
		}elseif ($jumlah == 3) {
			$bagi = 0.58;
		}elseif ($jumlah == 4) {
			$bagi = 0.90;
		}elseif($jumlah == 5){
			$bagi = 1.12;
		}elseif($jumlah == 6){
			$bagi = 1.24;
		}elseif($jumlah == 7){
			$bagi = 1.32;
		}else{
			$bagi = 1.41;
		}

		$cr = round($ci / $bagi,3);

		return array('total' => $total, 'lamda'=> $lamda, 'CI' => $ci, 'CR'=> $cr);

	}

}
