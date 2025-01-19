<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_petugas extends CI_Model {

	var $tabel = 'tbl_petugas';
	var $primary = 'id_petugas';
	var $order_by = 'id_petugas';

	public function get_all()
	{
				$this->db->order_by($this->order_by,'DESC');
		$data = $this->db->get($this->tabel);
		return $data;
	}
	public function get_id($id)
	{
				$this->db->join('tbl_user',"tbl_user.id_user=tbl_petugas.id_user");
		$data = $this->db->get_where($this->tabel, array($this->primary=>$id));
		return $data;
	}
	public function simpan($data)
	{
		return $this->db->insert($this->tabel, $data);
	}

	public function update($data,$id)
	{
		return $this->db->update($this->tabel, $data, array($this->primary=>$id));
	}

	public function hapus($id)
	{
		return $this->db->delete($this->tabel, array($this->primary=>$id));
	}
}
