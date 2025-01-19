<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level=='anggota') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Peminjaman";
		$data['query']	   = $this->M_peminjaman->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('peminjaman/index', $data);
		$this->load->view('footer', $data);
	}
 
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "+ Data Peminjaman";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('peminjaman/tambah', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$id_anggota		= $_POST['id_anggota'];
			$id_petugas  = $id_user;
			if ($level=='admin') {
				$id_petugas  = Null;
			}
			$batas_pinjam   = $_POST['batas_pinjam'];
			$id_buku 	    = $_POST['id_buku'];
			$jml_pinjam       = $_POST['jml_pinjam'];

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
			redirect('peminjaman/tambah');
			}

				$data = array(
					'id_anggota' =>$id_anggota,
					'id_petugas' =>$id_petugas,
					'batas_pinjam' =>$batas_pinjam,
					'id_buku' =>$id_buku,
					'jml_pinjam' =>$jml_pinjam,
					'status' =>'dipinjam',
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
			redirect('peminjaman/tambah');
		}
	}

	public function detail($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Detail Data Peminjaman";
		$data['query']     = $this->M_peminjaman->get_id($id)->row();
		if ($data['query']->id_peminjaman=='') {
			redirect('404');
		}

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('peminjaman/detail', $data);
		$this->load->view('footer', $data);	
	}

	public function hapus($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		
		$data['query']     = $this->M_peminjaman->get_id($id)->row();
		if ($data['query']->id_peminjaman=='') {
			redirect('404');
		}
				
				$this->M_peminjaman->hapus($id);

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Sukses!</strong> Berhasil dihapus.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>			
					'
				);
			redirect('peminjaman');
	}

}