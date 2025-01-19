<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	
	public function index()
	{
		$data['judul_web'] = "Selamat Datang di Aplikasi Perpustakaan Online MTSN 2 Mempawah";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('beranda', $data);
		$this->load->view('footer', $data);
	}
 
	public function login()
	{
		$id_user = $this->session->userdata('id_user');
		if (isset($id_user)) {
			redirect('web');
		}

		$data['judul_web'] = "Form Login";

		$this->load->view('header', $data);
		$this->load->view('navbar', $data);
		$this->load->view('menu_left', $data);
		$this->load->view('login', $data);
		$this->load->view('footer', $data);

		if (isset($_POST['btnlogin'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$cek_data = $this->M_web->cek_user($username,$password);
			if ($cek_data->num_rows()!=0) {
				$level = $cek_data->row()->level;

				$this->session->set_userdata('username',$username);
				$this->session->set_userdata('id_user',$cek_data->row()->id_user);
				$this->session->set_userdata('level',$level);

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Sukses!</strong> Berhasil Login sebagai '.$level.'.
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
					<strong>Gagal!</strong> Username atau Password Salah.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>	
					'
				);
			}
			redirect('web/login');
		}
	}


	public function logout()
	{
		if ($this->session->has_userdata('username') AND $this->session->has_userdata('id_user')){
			$this->session->sess_destroy();
		}
		redirect('web');
	}
}
