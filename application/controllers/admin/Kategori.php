<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('KategoriModel');
        $this->load->library('MY_Form_validation');
		isAdmin();
	}
	public function index()
	{
		$data = [
			'title' => 'Kategori Produk'
		];

		$this->load->view('admin/kategori/index', $data);
	}

	public function getData($where = 1)
	{		
		$start = $this->input->post('start');
        $list = $this->KategoriModel->get_datatables($start, $where);
        $data = array();

        foreach ($list as $getData) {
            $start++;
            $row = array();
            $row[] = $start;
            $row[] = $getData->kategori;
            $row[] = '<a href="'.base_url('admin/kategori/edit/'.$getData->id).'" class="btn btn-info">Edit</a>
            		<a class="btn btn-danger deleteData" href="'.base_url('admin/kategori/hapus/'.$getData->id).'">Hapus</a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->KategoriModel->count_all($where),
            "recordsFiltered" => $this->KategoriModel->count_filtered($where),
            "data" => $data,
        );

        echo json_encode($output);
	}

    public function tambah()
    {
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required|min_length[1]|is_unique[kategori.kategori]');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Kategori'
            ];

            $this->load->view('admin/kategori/tambah', $data);
            
        } else {
            $data = [
                'id' => $this->uuid->v4(),
                'kategori' => ucwords($this->input->post('kategori')),
                'active' => 1
            ];
            $this->KategoriModel->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil ditambahkan. </div>');

            redirect('admin/kategori');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required|min_length[1]|edit_unique[kategori.kategori.'.$id.']');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Kategori',
                'data' => $this->KategoriModel->edit(['id' => $id], 'fail')
            ];

            $this->load->view('admin/kategori/edit', $data);
            
        } else {
            $data = [
                'kategori' => ucwords($this->input->post('kategori')),
            ];
            $this->KategoriModel->do_edit($data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil diedit. </div>');

            redirect('admin/kategori');
        }
    }
    public function hapus($id)
    {
        $oldFile = $this->KategoriModel->edit(['id' => $id]);
        unlink('assets/images/user/'.$oldFile->foto);
        $this->KategoriModel->delete(['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil dihapus. </div>');

        redirect('admin/kategori');
    }
}
