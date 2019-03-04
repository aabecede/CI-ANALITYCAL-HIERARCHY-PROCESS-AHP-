<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_admin extends CI_Model {

	var $table = 'pengguna';

	function get_user(){

		return $this->db->get_where($this->table, 'role != "admin"')->result();

	}

	function add_user($data){
		return $this->db->insert($this->table, $data);
	}

	function cek_user($nama){
		$this->db->select('username');
		$this->db->from($this->table);
		$this->db->like('username', $nama, 'none');
		$query = $this->db->get()->row();
		return $query;
	}

	function get_where_user($id){ //use for parsing data to 
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row();
		#return $this->db->get_where($this->table, 'id', $id)->row();

	}

	function del_user($id){
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	function cek_user_notlike($nama, $id){
		$this->db->select('username');
		$this->db->where('id not in (select id from pengguna where id = '.$id.') and username like "%'.$nama.'%"');
		$query = $this->db->get($this->table)->row();
		return $query;
		
		#return $this->db->get()->row();
	}

	function up_user($data, $id){
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

}

/* End of file Admin.php */
/* Location: ./application/models/Admin.php */