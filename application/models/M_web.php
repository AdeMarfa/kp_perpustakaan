<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_web extends CI_Model {

	var $tabel = 'tbl_user';
	var $primary = 'id_user';

	public function cek_user($username,$password="")
	{
		if ($password!=""){
			$this->db->where('password',$password);
		}
		$data = $this->db->get_where($this->tabel, array('username'=>$username));
		return $data;
	}
	public function get_user($username_lama,$username_baru)
	{
		$data = $this->db->get_where($this->tabel, array('username!='=>$username_lama,'username'=>$username_baru));
		return $data;
	}

	public function get_anggota_user($id)
	{
				$this->db->join('tbl_anggota',"tbl_anggota.$this->primary=$this->tabel.$this->primary");
		$data = $this->db->get_where($this->tabel, array("$this->tabel.$this->primary"=>$id));
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
