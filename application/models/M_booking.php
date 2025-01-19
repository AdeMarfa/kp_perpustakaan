<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_booking extends CI_Model {

	var $tabel = 'tbl_peminjaman';
	var $primary = 'id_peminjaman';
	var $order_by = 'id_peminjaman';

	public function get_all()
	{
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id_user');

				$this->db->join('tbl_buku',"tbl_buku.id_buku=$this->tabel.id_buku");
				$this->db->join('tbl_anggota',"tbl_anggota.id_anggota=$this->tabel.id_anggota");
				$this->db->where("$this->tabel.status",'booking');
				$this->db->order_by($this->order_by,'DESC');
		$data = $this->db->get($this->tabel);
		return $data;
	}
	public function get_id($id)
	{
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id_user');

				$this->db->join('tbl_buku',"tbl_buku.id_buku=$this->tabel.id_buku");
				$this->db->join('tbl_anggota',"tbl_anggota.id_anggota=$this->tabel.id_anggota");
				$this->db->where('status','booking');
		$data = $this->db->get_where($this->tabel, array($this->primary=>$id));
		return $data;
	}
	
}
