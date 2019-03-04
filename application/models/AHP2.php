<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AHP2 extends CI_Model {

	public function	perbandingan_alternatif($data, $nilai){


		foreach ($this->db->get('kriteria')->result() as $nilai_kriteria => $kriteria) {
			foreach ($nilai as $key_nilai => $value_nilai) {
				if($kriteria->id == $value_nilai->kriteria){
						//---------------------------------------//
						foreach ($data as $key => $value) {
							foreach ($nilai as $keys => $values) {
								
								if($value->id == $values->alternatif2 and $kriteria->id == $values->kriteria){

									$arr_bobot[$kriteria->id][$key][] = $values->bobot;
								}//end if
							}
						}
						//---------------------------------------//						
						//---------------------------------------//

					/*	$this->pre($arr_bobot);
						die;*/
						
							foreach ($data as $key => $value) {
								foreach ($data as $keys => $values) {
									#if($arr_bobot[$kriteria->nama][$keys][$key] == true){
										$val = 1;
										if($key  == $keys){
											$val = 1;
										}elseif($key > $keys){
											$val = $arr_bobot[$kriteria->id][$key][$keys];
										}else{
											$val = 1 / $arr_bobot[$kriteria->id][$keys][$key];
											#$val = '1 /'.$arr_bobot[$kriteria->id][$keys][$key];
										}

										$arr_result[$kriteria->id][$keys][$key] = round($val,4);
										#$arr_result[$kriteria->id][$keys][$key] = $val;
									/*}else{

										$arr_result[$kriteria->nama][$key][$keys] = round(0,4);

									}//end if*/

								}
							}	
						
							
						
						//---------------------------------------//
						//---------------------------------------//
						foreach ($arr_result[$kriteria->id] as $key => $value) {
							$arr_total[$kriteria->id][$key] = 0;
							foreach ($arr_result[$kriteria->id][$key] as $keys => $values) {
								
								$arr_total[$kriteria->id][$key] += round($arr_result[$kriteria->id][$keys][$key],4);

							}
						}
										
								

						//---------------------------------------//
					}		
				}
			}

			return array('hasil' => $arr_result, 'bobot'=> $arr_bobot, 'total_bawah' => $arr_total);
			
	
	
		//return $arr_total;
		
	}

	public function normalisasi_prioritas($data, $nilai, $hasil){


		foreach ($this->db->get('kriteria')->result() as $key => $kriteria) {
			foreach ($nilai as $key_nilai => $value_nilai) {
				if($value_nilai->kriteria == $kriteria->id){
			
			$normalisasi[$kriteria->id] = array();
			$arr_jumlah[$kriteria->id] = array();
			$arr_total[$kriteria->id] = array();
			$arr_prio[$kriteria->id] = array();

			$jumlah_arr[$kriteria->id] = count($hasil['hasil'][$kriteria->id]);
			
			foreach ($hasil['hasil'][$kriteria->id] as $key => $value) {

				$jumlah[$kriteria->id] = 0;
				$priorotas[$kriteria->id] = 0;

				
				

				foreach ($hasil['hasil'][$kriteria->id][$key] as $keys => $values) {

					$normalisasi[$kriteria->id][$key][$keys] = round($hasil['hasil'][$kriteria->id][$key][$keys] / $hasil['total_bawah'][$kriteria->id][$keys],4);
					$jumlah[$kriteria->id] += round($normalisasi[$kriteria->id][$key][$keys],4);

				}

				$priorotas[$kriteria->id] = $jumlah[$kriteria->id] / $jumlah_arr[$kriteria->id];

				$arr_prio[$kriteria->id][] = round($priorotas[$kriteria->id],4);
				$arr_jumlah[$kriteria->id][] = $jumlah[$kriteria->id];
			}

				

			//getting total overall

			foreach ($normalisasi[$kriteria->id] as $key => $value) {

				$total[$kriteria->id] = 0;

				foreach ($normalisasi[$kriteria->id][$key] as $keys => $values) {
					
					$total[$kriteria->id] = $normalisasi[$kriteria->id][$keys][$key] + $total[$kriteria->id];

				}
				$arr_total[$kriteria->id][] = round($total[$kriteria->id],2);
			}

						

				}
			}


		}
		return array(
						'hasil' => $normalisasi,
						'jumlah' => $arr_jumlah,
						'prioritas' => $arr_prio,
						'total' => $arr_total,
						'bobot' => $hasil['hasil'],
					);
		//return $arr_total;

		
	}

	public function	perbandingan_kriteria($data, $kriteria){

		

		#$arr_bobot[] = array();
		$arr_result[] = array();
		foreach ($kriteria as $key => $value) {
			foreach ($data as $keys => $values) {
				
				if($value->id == $values->kriteria2){
					$arr_bobot[$key][] = $values->bobot;
				}

			}
		}

		

		//<!------------------------------------------------!>
		//---------------------------------------//
		foreach ($kriteria as $key_k => $value) {
			foreach ($kriteria as $key_k2 => $values) {
				$val = 1;
				if($key_k  == $key_k2){
					$val = 1;
				}elseif($key_k > $key_k2){
					//$val = @$arr_bobot[$key][$keys-($key + 1)];
					$val = 1 / $arr_bobot[$key_k][$key_k2];
				}else{
					$val =  $arr_bobot[$key_k2][$key_k];#1 / $arr_bobot[$keys - $key][$key];
				}

					$arr_result[$key_k][$key_k2] = round($val,4);

			}
		}

					
		//---------------------------------------//
		//---------------------------------------//
		foreach ($arr_result as $key => $value) {
				
				$arr_total[$key] = 0;

			foreach ($arr_result[$key] as $keys => $values) {
				
				$arr_total[$key] += round($arr_result[$keys][$key],4);

			}
		}
						//---------------------------------------//		

		

		
		return array('bobot' => $arr_bobot, 'hasil'=> $arr_result, 'total_bawah' => $arr_total);
		
	}

	function normalisasi_kriteria($hasil, $data, $kriteria){

			$normalisasi = array();
			$arr_jumlah = array();
			$arr_total = array();
			$arr_prio = array();

			$jumlah_arr = count($hasil['hasil']);
			
			foreach ($hasil['hasil'] as $key => $value) {

				$jumlah = 0;
				$priorotas = 0;

				
				

				foreach ($hasil['hasil'][$key] as $keys => $values) {

					$normalisasi[$key][$keys] = round($hasil['hasil'][$key][$keys] / $hasil['total_bawah'][$keys],4);
					$jumlah += round($normalisasi[$key][$keys],4);

				}

				$priorotas = $jumlah / $jumlah_arr;

				$arr_prio[] = round($priorotas,4);
				$arr_jumlah[] = $jumlah;
			}

			//getting CM
			
			$arr_cm = array();
			foreach ($hasil['hasil'] as $key => $value) {
				$cm = 0;
				foreach ($hasil['hasil'][$key] as $keys => $values) {
					
					$cm += $values * $arr_prio[$keys];
					//$arr_cm[] = $values.'*'.$arr_prio[$keys];

				}

				$arr_cm[] = $cm;
			}

			foreach ($arr_prio as $key => $value) {
				
				$arr_cm[$key] = round($arr_cm[$key]/$value,4);
			}


			//getting total overall

			foreach ($normalisasi as $key => $value) {

				$total = 0;

				foreach ($normalisasi[$key] as $keys => $values) {
					
					$total = $normalisasi[$keys][$key] + $total;

				}
				$arr_total[] = round($total,2);
			}

			return array(
				'hasil' => $normalisasi,
				'jumlah' => $arr_jumlah,
				'prioritas' => $arr_prio,
				'total' => $arr_total,
				'bobot' => $hasil['hasil'],
				'vector' => $arr_cm,
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

		$jumlah_cm = 0;
		foreach ($hasil['vector'] as $key => $value) {
			$jumlah_cm += $value;
		}

		$jumlah_cm = $jumlah_cm / $jumlah;



		//$ci = round(($total_ratio - $jumlah) / ($jumlah - 1),4);
		$ci = round(($jumlah_cm - $jumlah) / ($jumlah - 1),4);
		
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
			'lamdamax' => $jumlah_cm,
			'ci' => $ci,
			'cr' => $cr,
		);
	}

	function ranking($alternatif, $prio_kriteria, $prio_alternatif){



		foreach ($alternatif as $key => $value) {
			
			foreach ($prio_kriteria as $keys => $values) {
				
				if($value->id == $values->alternatif){

					$arr_result[$key][] = round($values->prioritas,4);
				}

			}

		}

		/*$this->pre(array(
			'alternatif' => $alternatif,
			'prioritas_kriteria' => $prio_kriteria,
			#'prioritas_alternatif' => $prio_alternatif,
			'result' => $arr_result,
		));
		die;*/


		$arr_kali[] = array();
		
		foreach ($prio_alternatif as $key => $value) {

			foreach ($arr_result as $keys => $values) {
				
				$arr_kali[$key][$keys] = round($value->prioritas * $arr_result[$keys][$key],4);
				//$arr_kali[$key][$keys] = $value->prioritas.'*'.$arr_result[$keys][$key];

			}
		}



		foreach ($arr_kali as $key => $value) {
			$jumlah[$key] = 0;
			$coba[] = array();
			foreach ($arr_kali[$key] as $keys => $values) {
				
				@$jumlah[$keys] += round($arr_kali[$key][$keys],4);
				//$coba[$key][$keys] = $arr_kali[$keys][$key];
			}
		}
	
		//return $coba;
		return $jumlah;

	}

	function pre($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
	

}

/* End of file AHP2.php */
/* Location: ./application/models/AHP2.php */