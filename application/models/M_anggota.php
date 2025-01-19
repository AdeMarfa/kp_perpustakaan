<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends CI_Model {

	var $tabel = 'tbl_anggota';
	var $primary = 'id_anggota';
	var $order_by = 'id_anggota';

	public function get_all()
	{
				$this->db->order_by($this->order_by,'DESC');
		$data = $this->db->get($this->tabel);
		return $data;
	}
	public function get_id($id)
	{
				$this->db->join('tbl_user',"tbl_user.id_user=tbl_anggota.id_user");
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
