<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level!='admin') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Buku";
		$data['query']	   = $this->M_buku->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('buku/index', $data);
		$this->load->view('footer', $data);
	}
 
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "+ Data Buku";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('buku/tambah', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$judul 		= $_POST['judul'];
			$pengarang  = $_POST['pengarang'];
			$penerbit   = $_POST['penerbit'];
			$tahun 	    = $_POST['tahun'];
			$stok       = $_POST['stok'];


			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');

				$data = array(
					'judul' =>$judul,
					'pengarang' =>$pengarang,
					'penerbit' =>$penerbit,
					'tahun' =>$tahun,
					'stok' =>$stok
				);
				
				$this->M_buku->simpan($data);

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
			redirect('buku/tambah');
		}
	}

	public function edit($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Edit Data Buku";
		$data['query']     = $this->M_buku->get_id($id)->row();
		if ($data['query']->id_buku=='') {
			redirect('404');
		}

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('buku/edit', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$judul 		= $_POST['judul'];
			$pengarang  = $_POST['pengarang'];
			$penerbit   = $_POST['penerbit'];
			$tahun 	    = $_POST['tahun'];
			$stok       = $_POST['stok'];

			$stok = $this->M_buku->cek_stok($id,$stok);
			

				$data = array(
					'judul' =>$judul,
					'pengarang' =>$pengarang,
					'penerbit' =>$penerbit,
					'tahun' =>$tahun,
					'stok' =>$stok
				);
				$this->M_buku->update($data,$id);

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
			redirect('buku/edit/'.$id);
		}
	}

	public function hapus($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		
		$data['query']     = $this->M_buku->get_id($id)->row();
		if ($data['query']->id_buku=='') {
			redirect('404');
		}
				
				$this->M_buku->hapus($id);

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
			redirect('buku');
	}

}