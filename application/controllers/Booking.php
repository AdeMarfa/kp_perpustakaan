<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level=='') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Booking";
		$data['query']	   = $this->M_booking->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('booking/index', $data);
		$this->load->view('footer', $data);
	}
 
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "+ Data Booking";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('booking/tambah', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$id_anggota		= $this->M_web->get_anggota_user($id_user)->row()->id_anggota;
			if ($level=='petugas') {
				$id_petugas  	= $id_user;
			}else {
				$id_petugas  	= Null;
			}
			$batas_pinjam   = $_POST['batas_pinjam'];
			$id_buku 	    = $_POST['id_buku'];
			$jml_pinjam     = $_POST['jml_pinjam'];

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');

			$stok_buku = $this->M_buku->get_id($id_buku)->row()->stok;
			$stok = $this->M_buku->cek_stok($id_buku);
			if ($stok_buku < $jml_pinjam) {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Gagal!</strong> Stok tidak mencukupi, Stok yang tersedia saat ini '.$stok.'.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>			
					'
				);
			redirect('booking/tambah');
			}

				$data = array(
					'id_anggota' =>$id_anggota,
					'id_petugas' =>$id_petugas,
					'batas_pinjam' =>$batas_pinjam,
					'id_buku' =>$id_buku,
					'jml_pinjam' =>$jml_pinjam,
					'status' =>'booking',
					'tgl_pinjam' =>$tgl
				);
				
				$this->M_peminjaman->simpan($data);

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Sukses!</strong> Berhasil disimpan.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>			
					'
				);
			redirect('booking/tambah');
		}
	}

	public function detail($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Detail Data Booking";
		$data['query']     = $this->M_booking->get_id($id)->row();
		if ($data['query']->id_peminjaman=='') {
			redirect('404');
		}

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('booking/detail', $data);
		$this->load->view('footer', $data);	
	}

	public function pinjam($id='')
	{
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if ($id=='') { redirect('404'); }
		$cek_data = $this->M_booking->get_id($id);
		if ($cek_data->num_rows()==0) { redirect('404'); }
		date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');
		if ($level=='admin') {
			$id_petugas = Null;
		}else {
			$id_petugas = $id_user;
		}
		$data = array(
			'id_petugas' =>$id_petugas,
			'status' =>'dipinjam',
			'tgl_pinjam' =>$tgl
		);
		
		$this->M_peminjaman->update($data, $id);
		$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Sukses!</strong> Berhasil dipinjam.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>			
					'
				);
		redirect('peminjaman');
	}
}