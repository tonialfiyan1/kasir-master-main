<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('ProdukModel');
		$this->load->model('KategoriModel');
		$this->load->model('PesananModel');
		$this->load->model('KwitansiModel');
		isKasir();
	}
    public function penjualan()
    {
        $data = [
            'title' => 'Laporan Penjualan',
            'produk' => $this->ProdukModel->show()->result(),
            'kategori' => $this->KategoriModel->show()->result(),
        ];

        $this->load->view('kasir/laporan_penjualan/index', $data);
    }
    public function penjualan_produk()
    {
        $data = [
            'title' => 'Laporan Penjualan Produk',
            'produk' => $this->ProdukModel->show()->result(),
            'kategori' => $this->KategoriModel->show()->result(),
        ];

        $this->load->view('kasir/laporan_penjualan_produk/index', $data);
    }
    public function transaksi()
    {
        $data = [
            'title' => 'Laporan Transaksi',
            'produk' => $this->ProdukModel->show()->result(),
            'kategori' => $this->KategoriModel->show()->result(),
        ];

        $this->load->view('kasir/laporan_transaksi/index', $data);
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
            $row[] = do_formal_date($terjual->tgl_pesanan);
            $row[] = $getData->kategori;
            $row[] = $getData->produk;
            $row[] = $terjual->jumlah;
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