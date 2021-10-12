<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('UserModel');
		$this->load->helper('security');
		$this->load->library('MY_Form_validation');
		isAdmin();
	}
	public function index()
	{
		$data = [
			'title' => 'Pengguna'
		];
		$this->load->view('admin/pengguna/index', $data);
	}

	public function getPengguna($where = 1)
	{		
		$start = $this->input->post('start');
        $list = $this->UserModel->get_datatables($start, $where);
        $data = array();

        foreach ($list as $getData) {
            $start++;
            $row = array();
            $row[] = $start;
            $row[] = '<img src="'.base_url('assets/images/user/'.$getData->foto).'" alt="" class="img-fluid ml-0 mt-2" width="40">';
            $row[] = $getData->nama;
            $row[] = $getData->alamat;
            $row[] = $getData->telp;
            $row[] = $getData->username;
            $row[] = '<a href="'.base_url('admin/pengguna/edit/'.$getData->id).'" class="btn btn-info">Edit</a>
            		<a class="btn btn-danger deleteData" href="'.base_url('admin/pengguna/hapus/'.$getData->id).'">Hapus</a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->UserModel->count_all($where),
            "recordsFiltered" => $this->UserModel->count_filtered($where),
            "data" => $data,
        );

        echo json_encode($output);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required|numeric');
		$this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('role', 'role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Tambah Pengguna'
			];

			$this->load->view('admin/pengguna/tambah', $data);
			
		} else {
			$upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/images/user/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $image = $this->upload->data('file_name');
                    $data = [
                    	'id' => $this->uuid->v4(),
						'nama' => ucwords($this->input->post('nama')),
						'alamat' => $this->input->post('alamat'),
						'telp' => $this->input->post('telp'),
						'foto' => $image,
						'username' => $this->input->post('username'),
						'password' => encrypt_url($this->input->post('password')),
						'role' => $this->input->post('role'),
						'active' => 1
					];

					$this->UserModel->insert($data);
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil ditambahkan. </div>');

					redirect('admin/pengguna');
                } else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Maaf ukuran file harus dibawah 2 MB dan ekstensi gif, jpg, png, jpeg! </div>');
					redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
            	$data = [
	                'id' => $this->uuid->v4(),
					'nama' => ucwords($this->input->post('nama')),
					'alamat' => $this->input->post('alamat'),
					'telp' => $this->input->post('telp'),
					'foto' => 'default.png',
					'username' => $this->input->post('username'),
					'password' => encrypt_url($this->input->post('password')),
					'role' => $this->input->post('role'),
					'active' => 1
				];
				$this->UserModel->insert($data);
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil ditambahkan. </div>');

				redirect('admin/pengguna');
            }
		}
	}
	public function edit($id)
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
		$this->form_validation->set_rules('telp', 'telp', 'trim|required|numeric');
		$this->form_validation->set_rules('username', 'username', 'trim|required|edit_unique[user.username.'.$id.']');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('role', 'role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Edit Pengguna',
				'data' => $this->UserModel->edit(['id' => $id], 'fail')
			];

			$this->load->view('admin/pengguna/edit', $data);
			
		} else {
			$upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/images/user/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                	$oldFile = $this->UserModel->edit(['id' => $id]);
                	unlink('assets/images/user/'.$oldFile->foto);
                    $image = $this->upload->data('file_name');
                    $data = [
						'nama' => ucwords($this->input->post('nama')),
						'alamat' => $this->input->post('alamat'),
						'telp' => $this->input->post('telp'),
						'foto' => $image,
						'username' => $this->input->post('username'),
						'password' => encrypt_url($this->input->post('password')),
						'role' => $this->input->post('role'),
					];
					$this->UserModel->do_edit($data, ['id' => $id]);
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil diedit. </div>');

					redirect('admin/pengguna');
                } else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Maaf ukuran file harus dibawah 2 MB dan ekstensi gif, jpg, png, jpeg! </div>');
					redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
            	$data = [
					'nama' => ucwords($this->input->post('nama')),
					'alamat' => $this->input->post('alamat'),
					'telp' => $this->input->post('telp'),
					'username' => $this->input->post('username'),
					'password' => encrypt_url($this->input->post('password')),
					'role' => $this->input->post('role'),
				];
				$this->UserModel->do_edit($data, ['id' => $id]);
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil diedit. </div>');

				redirect('admin/pengguna');
            }
		}
	}
	public function hapus($id)
	{
		$oldFile = $this->UserModel->edit(['id' => $id]);
		unlink('assets/images/user/'.$oldFile->foto);
	    $this->UserModel->delete(['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil dihapus. </div>');

		redirect('admin/pengguna');
	}
}
