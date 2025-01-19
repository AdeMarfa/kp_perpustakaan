<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_buku extends CI_Model {

	var $tabel = 'tbl_buku';
	var $primary = 'id_buku';
	var $order_by = 'id_buku';

	public function get_all()
	{
				$this->db->order_by($this->order_by,'DESC');
		$data = $this->db->get($this->tabel);
		return $data;
	}
	public function get_id($id)
	{
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
	public function cek_stok($id_buku,$stok_baru='')
	{
							 $this->db->join('tbl_peminjaman','tbl_peminjaman.id_peminjaman=tbl_pengembalian.id_peminjaman');
		                     $this->db->select_sum('jml_pinjam','total_pinjam');
		$data_pengembalian = $this->db->get_where('tbl_pengembalian',array('id_buku'=>$id_buku));
		$total_pengembalian = $data_pengembalian->row()->total_pinjam;

						 $this->db->select_sum('jml_pinjam','total_pinjam');
		$data_peminjam = $this->db->get_where('tbl_peminjaman',array('id_buku'=>$id_buku));
		$total_pinjam = $data_peminjam->row()->total_pinjam;

		$data_buku = $this->db->get_where('tbl_buku',array('id_buku'=>$id_buku));
		$stok = $data_buku->row()->stok;
		if ($stok_baru=='') {
			return $stok-$total_pinjam+$total_pengembalian;
		}else {
			$stok_x = $stok_baru + $total_pinjam;
			if ($stok == $stok_x) {
				return $stok+$total_pengembalian;
			}else {
				return $stok_x-$stok+$stok+$total_pengembalian;
			}
		}
		
	}
}
