<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level!='admin') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Petugas";
		$data['query']	   = $this->M_petugas->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('petugas/index', $data);
		$this->load->view('footer', $data);
	}
 
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "+ Tambah Data Petugas";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('petugas/tambah', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$nama_petugas = $_POST['nama_petugas'];
			$jk 		  = $_POST['jk'];
			$no_hp 		  = $_POST['no_hp'];
			$username     = $_POST['username'];
			$password     = $_POST['password'];


			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');
		
			$cek_data = $this->M_web->cek_user($username);
			if ($cek_data->num_rows()==0) {
				$data = array(
					'username' =>$username,
					'password' =>$password,
					'level' =>'petugas',
					'tgl_daftar' =>$tgl
				);
				
				$this->M_web->simpan($data);

				$data2 = array(
					'nama_petugas' =>$nama_petugas,
					'jk' =>$jk,
					'no_hp' =>$no_hp,
					'id_user' =>$this->db->insert_id()
				);
				
				$this->M_petugas->simpan($data2);

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
			}else {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Gagal!</strong> Username <b>'.$username.'</b> sudah ada.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>	
					'
				);
			}
			redirect('petugas/tambah');
		}
	}



	public function edit($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Edit Data Petugas";
		$data['query']     = $this->M_petugas->get_id($id)->row();
		if ($data['query']->id_petugas=='') {
			redirect('404');
		}

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('petugas/edit', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$nama_petugas = $_POST['nama_petugas'];
			$jk 		  = $_POST['jk'];
			$no_hp 		  = $_POST['no_hp'];
			$username     = $_POST['username'];
			$password     = $_POST['password'];
		
			if ($password=='') {
				$password = $data['query']->password;
			}
			$id_user = $data['query']->id_user;
			$username_lama = $data['query']->username;
			$cek_data = $this->M_web->get_user($username_lama,$username);
			if ($cek_data->num_rows()==0) {
				$data = array(
					'username' =>$username,
					'password' =>$password
				);
				
				$this->M_web->update($data,$id_user);

				$data2 = array(
					'nama_petugas' =>$nama_petugas,
					'jk' =>$jk,
					'no_hp' =>$no_hp
				);
				
				$this->M_petugas->update($data2,$id);

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
			}else {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Gagal!</strong> Username <b>'.$username.'</b> sudah ada.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>	
					'
				);
			}
			redirect('petugas/edit/'.$id);
		}
	}

	public function hapus($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Hapus Data Petugas";
		$data['query']     = $this->M_petugas->get_id($id)->row();
		if ($data['query']->id_petugas=='') {
			redirect('404');
		}
				
				$this->M_petugas->hapus($id);
				$this->M_web->hapus($data['query']->id_user);

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
			redirect('petugas');
	}

}