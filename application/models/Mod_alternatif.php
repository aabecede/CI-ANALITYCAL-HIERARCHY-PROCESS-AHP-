<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_alternatif extends CI_Model {

	var $table = 'alternatif';
	var $table2 = 'hasil_alternatif';

	function get_group(){

		$this->db->select('alternatif.*');
		$this->db->from('alternatif');
		$this->db->join('hasil_alternatif', '(hasil_alternatif.alternatif1 = alternatif.id or hasil_alternatif.alternatif2 = alternatif.id)');
		$this->db->group_by('alternatif.id');
		return $this->db->get()->result();

	}

	function get_alter_nilai($id, $tahun){

		$query = $this->db->get_where('nilai_awal',array('id_alternatif' => $id, 'periode' => $tahun ))->row();
		return $query;
	}

	function get_nilai_alternatif(){

		$this->db->select('alternatif.nama, nilai_awal.nilai');
		$this->db->from('alternatif');
		$this->db->join('hasil_alternatif', '(hasil_alternatif.alternatif1 = alternatif.id or hasil_alternatif.alternatif2 = alternatif.id)');
		$this->db->join('nilai_awal', 'nilai_awal.id_alternatif = alternatif.id');
		$this->db->group_by('alternatif.id');

		$query = $this->db->get()->result();
		return $query;

	}


	function get_id($id) // cek validation for insert / update date if therea a same name in a row
	{
		$query = $this->db->get_where($this->table, 'id ="'.$id.'"')->row();

		return $query;
	}

	function get_nilai($id){
		$this->db->select('nilai_awal.id, alternatif.nama, nilai_detail.nilai, kriteria.nama as naker');
		$this->db->from('alternatif');
		$this->db->join('nilai_awal', 'alternatif.id = nilai_awal.id_alternatif');
		$this->db->join('nilai_detail', 'nilai_awal.id = nilai_detail.id_nilai_awal');
		$this->db->join('kriteria', 'kriteria.id = nilai_detail.id_kriteria');
		$this->db->where('nilai_awal.id="'.$id.'"');
		$query = $this->db->get()->result();

		#$query = $this->db->get_where('nilai_awal, nilai_detail', 'nilai_detail.id_nilai_awal = nilai_awal.id')->row();
		return $query;
		#var_dump($id);

	}

	function get_nama($id){
		$this->db->select('id, nama');
		$this->db->from($this->table);
		$query = $this->db->get()->row();
		return $query;
	}

	function update_nilai_detail($nilai, $id, $id_krit){

		$this->db->set('nilai', $nilai);
		$this->db->where('id_nilai_awal', $id);
		$this->db->where('id_kriteria', $id_krit);
		$query = $this->db->update('nilai_detail');

		return $query;

	}

	function update_nilai($total, $id, $ket){
		$this->db->set('nilai', $total);
		$this->db->set('keterangan', $ket);
		$this->db->where('id', $id);
		$query = $this->db->update('nilai_awal');
		return $query;
	}

	function search_nik($nik){
		$this->db->like('NIK', $nik, 'both');
		$this->db->orde_by('NIK', 'asc');
		$this->db->limit(10);
		return $this->db->get($this->table)->result();
	}

	

}

/* End of file Alternatif.php */
/* Location: ./application/models/Alternatif.php */