<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AHP extends CI_Model {

	public function	perbandingan_alternatif($data, $hasil){

		$arr_result[] = array();
		
		
		for ($i=0; $i < sizeof($data) ; $i++) { 
			$total = 0;
			for ($j=0; $j < sizeof($data) ; $j++) { 
				$val = 1;
				if($i  == $j){
					$val = 1;
				}elseif($i < $j){
					$val = $hasil['bobot'][$i][$j];
				}else{
					$val = 1 / $hasil['bobot'][$j][$i];
				}

				$arr_result[$i][$j] = round($val,4);
				
			}

		}

		//getting total overall
		
		
		foreach ($arr_result as $key => $value) {
			$arr_total[$key] = 0;
			foreach ($arr_result[$key] as $keys => $values) {
				
				$arr_total[$key] += round($arr_result[$keys][$key],4);

			}
		}

		//return array($data, $hasil);
		return array('hasil' => $arr_result, 'total' => $arr_total, 'bobot'=> $hasil['bobot']);

	}

	public function normalisasi_prioritas($data, $hasil){

		$normalisasi[] = array();
		$arr_jumlah = array();
		$arr_total = array();
		$arr_prio = array();

		$jumlah_arr = count($hasil['hasil']);
		
		foreach ($hasil['hasil'] as $key => $value) {

			$jumlah = 0;
			$priorotas = 0;

			
			

			foreach ($hasil['hasil'][$key] as $keys => $values) {

				$normalisasi[$key][$keys] = round($hasil['hasil'][$key][$keys] / $hasil['total'][$keys],4);
				$jumlah += round($normalisasi[$key][$keys],4);

			}

			$priorotas = $jumlah / $jumlah_arr;

			$arr_prio[] = round($priorotas,4);
			$arr_jumlah[] = $jumlah;
		}


		//getting total overall

		foreach ($normalisasi as $key => $value) {

			$total = 0;

			foreach ($normalisasi[$key] as $keys => $values) {
				
				$total = $normalisasi[$keys][$key] + $total;

			}
			$arr_total[] = round($total,2);
		}

		//return $arr_total;

		return array(
			'hasil' => $normalisasi,
			'jumlah' => $arr_jumlah,
			'prioritas' => $arr_prio,
			'total' => $arr_total,
			'bobot' => $hasil['hasil'],
		);
	}

	function konsisten($data, $hasil){

/*		$total_jumlah = 0;
		foreach ($hasil['jumlah'] as $key => $value) {
			
			$total_jumlah += $hasil['jumlah'][$key];

		}

		return $total_jumlah;*/
		$arr_result[] = array();
		$arr_total = array();
		$jumlah = sizeof($hasil['bobot']);
			
		foreach ($hasil['bobot'] as $key => $value) {

				$total = 0;

			foreach ($hasil['bobot'][$key] as $keys => $values) {
			
				//$arr_result[$key][$keys] = $hasil['perbandingan'][$key][$keys].'+'.$hasil['prioritas'][$keys];
				$arr_result[$key][$keys] = round($hasil['bobot'][$key][$keys]*$hasil['prioritas'][$keys],4);
				$total += round($arr_result[$key][$keys],4);
			}
			
				$arr_total[] = round($total,4);

				//$total = round($total / $hasil['prioritas'][$key],3);
		}

		
		$arr_ratio = array();
		$total_ratio = 0;

		foreach ($arr_total as $key => $value) {
		
			$total_ratio += $value;
		}

		$ci = round(($total_ratio - $jumlah) / ($jumlah - 1),4);
		
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

		$cr = round($ci / $bagi,4);

		return array('hasil'=> $arr_result, 
			'total' => $arr_total, 
			//'ratio' => $arr_ratio, 
			//'total_ratio' => $total_ratio,
			'lamda' => $total_ratio,
			'ci' => $ci,
			'cr' => $cr,
		);
	}

}

/* End of file AHP.php */
/* Location: ./application/models/AHP.php */