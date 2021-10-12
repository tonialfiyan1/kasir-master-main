<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('ProdukModel');
		$this->load->model('KategoriModel');
		$this->load->helper('security');
		$this->load->library('MY_Form_validation');
		isAdmin();
	}
	public function index()
	{
		$data = [
			'title' => 'Produk'
		];

		$this->load->view('admin/produk/index', $data);
	}

	public function getData($where = 1)
	{		
		$start = $this->input->post('start');
        $list = $this->ProdukModel->get_datatables($start, $where);
        $data = array();

        foreach ($list as $getData) {
            $start++;
            $row = array();
            $row[] = $start;
            $row[] = $getData->kode;
            $row[] = '<img src="'.base_url('assets/images/produk/'.$getData->foto_produk).'" alt="" class="img-fluid ml-0 mt-2" width="40">';
            $row[] = $getData->kategori;
            $row[] = $getData->produk;
            $row[] = $getData->merek;
            $row[] = "Rp " . number_format($getData->harga,0,',','.');
            $row[] = $getData->stok;
            $row[] = $getData->satuan;
            $row[] = '<a href="'.base_url('admin/produk/edit/'.$getData->id).'" class="btn btn-info">Edit</a>
            		<a class="btn btn-danger deleteData" href="'.base_url('admin/produk/hapus/'.$getData->id).'">Hapus</a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ProdukModel->count_all($where),
            "recordsFiltered" => $this->ProdukModel->count_filtered($where),
            "data" => $data,
        );

        echo json_encode($output);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('kode', 'kode', 'trim|required|min_length[1]|is_unique[produk.kode]');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('produk', 'produk', 'trim|required');
		$this->form_validation->set_rules('merek', 'merek', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Tambah Produk',
				'kategori' => $this->KategoriModel->show()->result()
			];

			$this->load->view('admin/produk/tambah', $data);
			
		} else {
			$upload_image = $_FILES['foto_produk']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/images/produk/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_produk')) {
                    $image = $this->upload->data('file_name');
                    $data = [
                    	'id' => $this->uuid->v4(),
						'id_kategori' => $this->input->post('id_kategori'),
						'kode' => $this->input->post('kode'),
						'produk' => ucwords($this->input->post('produk')),
						'merek' => ucwords($this->input->post('merek')),
						'foto_produk' => $image,
						'harga' => preg_replace("/[^0-9]/", "", $this->input->post('harga')),
						'stok' => $this->input->post('stok'),
						'satuan' => $this->input->post('satuan'),
						'active' => 1
					];

					$this->ProdukModel->insert($data);
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil ditambahkan. </div>');

					redirect('admin/produk');
                } else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Maaf ukuran file harus dibawah 2 MB dan ekstensi gif, jpg, png, jpeg! </div>');
					redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
            	$data = [
                	'id' => $this->uuid->v4(),
					'id_kategori' => $this->input->post('id_kategori'),
					'kode' => $this->input->post('kode'),
					'produk' => ucwords($this->input->post('produk')),
					'merek' => ucwords($this->input->post('merek')),
					'foto_produk' => 'default',
					'harga' => preg_replace("/[^0-9]/", "", $this->input->post('harga')),
					'stok' => $this->input->post('stok'),
					'satuan' => $this->input->post('satuan'),
					'active' => 1
				];
				$this->ProdukModel->insert($data);
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil ditambahkan. </div>');

				redirect('admin/produk');
            }
		}
	}
	public function edit($id)
	{
		$this->form_validation->set_rules('kode', 'kode', 'trim|required|min_length[1]|edit_unique[produk.kode.'.$id.']');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('produk', 'produk', 'trim|required');
		$this->form_validation->set_rules('merek', 'merek', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Edit Produk',
				'data' => $this->ProdukModel->edit(['produk.id' => $id], 'fail'),
				'kategori' => $this->KategoriModel->show()->result()
			];

			$this->load->view('admin/produk/edit', $data);
			
		} else {
			$upload_image = $_FILES['foto_produk']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/images/produk/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_produk')) {
                    $image = $this->upload->data('file_name');
                    $data = [
						'id_kategori' => $this->input->post('id_kategori'),
						'kode' => $this->input->post('kode'),
						'produk' => ucwords($this->input->post('produk')),
						'merek' => ucwords($this->input->post('merek')),
						'foto_produk' => $image,
						'harga' => preg_replace("/[^0-9]/", "", $this->input->post('harga')),
						'stok' => $this->input->post('stok'),
						'satuan' => $this->input->post('satuan'),
					];

					$this->ProdukModel->do_edit($data, ['id' => $id]);
					$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil diedit. </div>');

					redirect('admin/produk');
                } else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Maaf ukuran file harus dibawah 2 MB dan ekstensi gif, jpg, png, jpeg! </div>');
					redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
            	$data = [
					'id_kategori' => $this->input->post('id_kategori'),
					'kode' => $this->input->post('kode'),
					'produk' => ucwords($this->input->post('produk')),
					'merek' => ucwords($this->input->post('merek')),
					'harga' => preg_replace("/[^0-9]/", "", $this->input->post('harga')),
					'stok' => $this->input->post('stok'),
					'satuan' => $this->input->post('satuan'),
				];
				$this->ProdukModel->do_edit($data, ['id' => $id]);
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil diedit. </div>');

				redirect('admin/produk');
            }
		}
	}

	public function hapus($id)
	{
		$oldFile = $this->ProdukModel->edit(['id' => $id]);
		unlink('assets/images/user/'.$oldFile->foto);
	    $this->ProdukModel->delete(['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Data berhasil dihapus. </div>');

		redirect('admin/produk');
	}
}
