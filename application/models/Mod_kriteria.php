<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_kriteria extends CI_Model {

	var $table = 'kriteria';

	function get_nama($nama){ //cek validation

		$query = $this->db->get_where($this->table, 'nama = "'.$nama.'"')->row();
		#$query = $this->db->get();
		return $query;

	}

	function get_kriteria(){
		return $this->db->get($this->table)->result();
	}
	

}

/* End of file Mod_kriteria.php */
/* Location: ./application/models/Mod_kriteria.php */