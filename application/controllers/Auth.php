<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('UserModel');
	}
	public function ifLogin(){
		if ($this->session->userdata('id')) {
			if ($this->session->userdata('role') == 'Kasir') {
				return redirect('kasir/dashboard');
			}elseif ($this->session->userdata('role') == 'Admin') {
				return redirect('admin/dashboard');
			}
		}
	}
	public function index()
	{
		$this->ifLogin();
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[3]|max_length[30]');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Halaman Login',
			];

			$this->load->view('login', $data);
		} else {
			$data = [
				'username' => $this->input->post('username'),
				'password' => decrypt_url($this->input->post('password'))
			];
			$cek = $this->UserModel->where($data)->row();
			if ($cek) {
				$result = [
					'id' => $cek->id,
					'role' 	=> $cek->role,
				];
				
				if ($cek->role == 'Kasir') {
					$this->session->set_userdata($result);
					return redirect('kasir/dashboard');
				}elseif ($cek->role == 'Admin') {
					$this->session->set_userdata($result);
					return redirect('admin/dashboard');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Maaf Login gagal, Silakan anda periksa kembali! </div>');
				redirect('auth');	
			}
		}
	}
	public function logout(){
		
        $this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu telah berhasil logout!</div>');
		redirect('auth');
	}
}