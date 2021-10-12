<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terjual extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('KwitansiModel');
		$this->load->model('PesananModel');
		isKasir();
	}
	public function index()
	{
		$data = [
			'title' => 'Pesanan Terjual'
		];

		$this->load->view('kasir/penjualan/index', $data);
	}	
	public function getData($where = NULL)
	{		
		$start = $this->input->post('start');
        $list = $this->KwitansiModel->get_datatables($start, ['pesanan.status' => 0, 'pesanan.tgl_pesanan' => date('Y-m-d')]);
        $data = array();

        foreach ($list as $getData) {
        	$terjual = $this->PesananModel->whereSum(['pesanan.id_produk' => $getData->id_produk])->row();
            $start++;
            $row = array();
            $row[] = $start;
            $row[] = $getData->kategori;
            $row[] = $getData->merek;
            $row[] = $getData->produk;
            $row[] = $terjual->jumlah;
            $row[] = $getData->satuan;
            $row[] = "Rp " . number_format($terjual->harga,0,',','.');
            $row[] = "Rp " . number_format($terjual->harga * $terjual->jumlah,0,',','.');

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->KwitansiModel->count_all($where),
            "recordsFiltered" => $this->KwitansiModel->count_filtered($where),
            "data" => $data,
        );

        echo json_encode($output);
	}
}