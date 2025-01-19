<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level=='anggota') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Data Pengembalian";
		$data['query']	   = $this->M_pengembalian->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('pengembalian/index', $data);
		$this->load->view('footer', $data);
	}
 
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "+ Data Pengembalian";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('pengembalian/tambah', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$id_anggota		= $_POST['id_anggota'];
			$id_petugas  = $id_user;
			if ($level=='admin') {
				$id_petugas  = Null;
			}
			$keterangan       = $_POST['keterangan'];
			$tgl_pinjam       = $this->M_peminjaman->get_id($id_anggota)->row()->tgl_pinjam;

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');

				$data = array(
					'id_peminjaman' =>$id_anggota,
					'id_petugas' =>$id_petugas,
					'tgl_pinjam' =>$tgl_pinjam,
					'keterangan' =>$keterangan,
					'tgl_kembali' =>$tgl
				);
				
				$this->M_pengembalian->simpan($data);

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
			redirect('pengembalian');
		}
	}

	public function detail($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Detail Data Pengembalian";
		$data['query']     = $this->M_pengembalian->get_id($id)->row();
		if ($data['query']->id_pengembalian=='') {
			redirect('404');
		}

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('pengembalian/detail', $data);
		$this->load->view('footer', $data);	
	}

	public function hapus($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		
		$data['query']     = $this->M_pengembalian->get_id($id)->row();
		if ($data['query']->id_pengembalian=='') {
			redirect('404');
		}
				
				$this->M_pengembalian->hapus($id);

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
			redirect('pengembalian');
	}

}