<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	function __construct() {
		parent::__construct();
		$level = $this->session->userdata('level');
		if ($level!='admin') {
			redirect('404');
		}
	}
	public function index()
	{
		$data['judul_web'] = "Data Anggota";
		$data['query']	   = $this->M_anggota->get_all();

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('anggota/index', $data);
		$this->load->view('footer', $data);
	}
 
	public function tambah()
	{
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "+ Data Anggota";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('anggota/tambah', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$nis 		  = $_POST['nis'];
			$nama_anggota = $_POST['nama_anggota'];
			$jk 		  = $_POST['jk'];
			$no_hp 		  = $_POST['no_hp'];
			$alamat 	  = $_POST['alamat'];
			$username     = $_POST['username'];
			$password     = $_POST['password'];


			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');
			
			$cek_nis = $this->db->get_where('tbl_anggota',array('nis'=>$nis));
			if ($cek_nis->num_rows()!=0) {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Gagal!</strong> Username <b>'.$nis.'</b> sudah ada.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>	
					'
				);
				redirect('anggota/tambah');
			}

			$cek_data = $this->M_web->cek_user($username);
			if ($cek_data->num_rows()==0) {
				$data = array(
					'username' =>$username,
					'password' =>$password,
					'level' =>'anggota',
					'tgl_daftar' =>$tgl
				);
				
				$this->M_web->simpan($data);

				$data2 = array(
					'nis' =>$nis,
					'nama_anggota' =>$nama_anggota,
					'jk' =>$jk,
					'no_hp' =>$no_hp,
					'alamat' =>$alamat,
					'id_user' =>$this->db->insert_id()
				);
				
				$this->M_anggota->simpan($data2);

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
			redirect('anggota/tambah');
		}
	}



	public function edit($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Edit Data Anggota";
		$data['query']     = $this->M_anggota->get_id($id)->row();
		if ($data['query']->id_anggota=='') {
			redirect('404');
		}

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('anggota/edit', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnsimpan'])) {
			$nis 		  = $_POST['nis'];
			$nama_anggota = $_POST['nama_anggota'];
			$jk 		  = $_POST['jk'];
			$no_hp 		  = $_POST['no_hp'];
			$alamat 	  = $_POST['alamat'];
			$username     = $_POST['username'];
			$password     = $_POST['password'];
			
			$nis_lama = $this->M_anggota->get_id($id)->row()->nis;
			$cek_nis = $this->db->get_where('tbl_anggota',array('nis'=>$nis,'nis!='=>$nis_lama));
			if ($cek_nis->num_rows()!=0) {
				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Gagal!</strong> Username <b>'.$nis.'</b> sudah ada.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>	
					'
				);
				redirect('anggota/edit/'.$id);
			}
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
					'nis' =>$nis,
					'nama_anggota' =>$nama_anggota,
					'jk' =>$jk,
					'no_hp' =>$no_hp,
					'alamat' =>$alamat
				);
				
				$this->M_anggota->update($data2,$id);

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
			redirect('anggota/edit/'.$id);
		}
	}

	public function hapus($id='')
	{
		if ($id=='') {redirect('404');}
		$id_user = $this->session->userdata('id_user');
		if (!isset($id_user)) {
			redirect('web');
		}

		
		$data['query']     = $this->M_anggota->get_id($id)->row();
		if ($data['query']->id_anggota=='') {
			redirect('404');
		}
				
				$this->M_anggota->hapus($id);
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
			redirect('anggota');
	}

}