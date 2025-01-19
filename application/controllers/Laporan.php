<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level=='anggota') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Laporan";
		$data['query']	   = $this->M_anggota->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('laporan/index', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btncetak'])) {
			$lap = $_POST['lap'];
			$tgl1 = $_POST['tgl1'];
			$tgl2 = $_POST['tgl2'];

			redirect("laporan/cetak/$lap/$tgl1/$tgl2");
		}
	}

	public function cetak($lap='',$tgl1='',$tgl2='')
	{
		if ($lap=='' OR $tgl1=='' OR $tgl2=='') {
			redirect('404');
		}

		$data['judul_lap'] = "Laporan ".ucwords($lap);

		$tgl_1 = date('Y-m-d',strtotime($tgl1)); 
		$tgl_2 = date('Y-m-d',strtotime($tgl2)); 
		if ($lap=='petugas') {
			$sql = $this->M_laporan->get_petugas($tgl_1,$tgl_2);
		}elseif ($lap=='anggota') {
			$sql = $this->M_laporan->get_anggota($tgl_1,$tgl_2);
		}elseif ($lap=='buku') {
			$sql = $this->M_laporan->get_buku($tgl_1,$tgl_2);
		}elseif ($lap=='peminjaman') {
			$sql = $this->M_laporan->get_peminjaman($tgl_1,$tgl_2);
		}elseif ($lap=='pengembalian') {
			$sql = $this->M_laporan->get_pengembalian($tgl_1,$tgl_2);
		}

		$data['sql'] = $sql;
		$this->load->view("laporan/header",$data);
		$this->load->view("laporan/cetak_$lap",$data);
	}
}