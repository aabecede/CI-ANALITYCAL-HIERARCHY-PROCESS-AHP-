<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

	public function alternatif(){

		return $this->db->get('alternatif')->result();

	}

	public function kriteria()
	{
			//return $this->db->limit(3,0)->get('kriteria')->result();
		return $this->db->get('kriteria')->result();
	}	

}

/* End of file Crud.php */
/* Location: ./application/models/Crud.php */