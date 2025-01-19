<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {


	public function get_petugas($tgl1,$tgl2)
	{
		$data = $this->db->query("SELECT * FROM tbl_petugas 
										  INNER JOIN tbl_user ON tbl_user.id_user=tbl_petugas.id_user
										  WHERE (tbl_user.tgl_daftar BETWEEN '$tgl1' AND '$tgl2')");
		return $data;
	}
	public function get_anggota($tgl1,$tgl2)
	{
		$data = $this->db->query("SELECT * FROM tbl_anggota 
										  INNER JOIN tbl_user ON tbl_user.id_user=tbl_anggota.id_user
										  WHERE (tbl_user.tgl_daftar BETWEEN '$tgl1' AND '$tgl2')");
		return $data;
	}
	public function get_buku($tgl1,$tgl2)
	{
		$data = $this->db->query("SELECT * FROM tbl_buku 
										  WHERE (tahun BETWEEN '$tgl1' AND '$tgl2')");
		return $data;
	}
	public function get_peminjaman($tgl1,$tgl2)
	{
		$data = $this->db->query("SELECT * FROM tbl_peminjaman 
										  INNER JOIN tbl_anggota ON tbl_anggota.id_anggota=tbl_peminjaman.id_anggota
										  INNER JOIN tbl_buku ON tbl_buku.id_buku=tbl_peminjaman.id_buku
										  WHERE (tgl_pinjam BETWEEN '$tgl1' AND '$tgl2')");
		return $data;
	}
	public function get_pengembalian($tgl1,$tgl2)
	{
		$tgl2 = date('Y-m-d H:i:s', strtotime('+1 days',strtotime($tgl2)));
		$data = $this->db->query("SELECT * FROM tbl_pengembalian 
										  INNER JOIN tbl_peminjaman ON tbl_peminjaman.id_peminjaman=tbl_pengembalian.id_peminjaman
										  INNER JOIN tbl_anggota ON tbl_anggota.id_anggota=tbl_peminjaman.id_anggota
										  INNER JOIN tbl_buku ON tbl_buku.id_buku=tbl_peminjaman.id_buku
										  WHERE (tgl_kembali BETWEEN '$tgl1' AND '$tgl2')");
		return $data;
	}
}
