<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
		$this->load->model('ProdukModel');
		$this->load->model('KategoriModel');
		$this->load->model('PesananModel');
		$this->load->model('KwitansiModel');
        $this->load->library('MY_Form_validation');
		isKasir();
	}
	public function index()
	{
		$data = [
			'title' => 'Pesanan',
			'produk' => $this->ProdukModel->show()->result(),
			'kategori' => $this->KategoriModel->show()->result(),
		];

		$this->load->view('kasir/pesanan/index', $data);
	}
	public function getData($where = NULL)
	{
		$start = $this->input->post('start');
        $list = $this->PesananModel->get_datatables($start, $where);
        $data = array();

        foreach ($list as $getData) {
            $start++;
            $row = array();
            $row[] = $start;
            $row[] = $getData->produk;
            $row[] = '<input type="text" name"jumlah" class="form-control jumlah" data-id="'.$getData->id.'" data-kode="'.$getData->kode.'" value="'.$getData->jumlah.'" onkeypress="return hanyaAngka(event)">';
            $row[] = number_format($getData->harga,0,',','.');
            $row[] = number_format($getData->jumlah*$getData->harga,0,',','.');
            $row[] = '<a class="btn btn-danger btn-sm delete" data-id="'.$getData->id.'" href="#"><i class="icon-trash"></i></a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->PesananModel->count_all($where),
            "recordsFiltered" => $this->PesananModel->count_filtered($where),
            "data" => $data,
        );

        echo json_encode($output);
	}
	public function search()
	{
		$produk = $this->ProdukModel->edit(['kode' => $this->input->post('kode')]);
		$cek = $this->PesananModel->where(['pesanan.status' => 1, 'pesanan.id_produk' => $produk->id, 'pesanan.tgl_pesanan' => date('Y-m-d')])->row();
		if ($produk->stok < 1) {
			$result = [
				'fail' => 'Maaf stok tidak mencukupi'
			];

			echo json_encode($result);
		} else {
			if ($cek) {
				if ($cek->jumlah >= $produk->stok) {
					$result = [
						'fail' => 'Maaf stok tidak mencukupi'
					];

					echo json_encode($result);
				} else {

					$jumlah = $cek->jumlah + 1;
					$this->PesananModel->do_edit(['jumlah' => $jumlah], ['kode_pesanan' => $cek->kode_pesanan, 'pesanan.id_produk' => $produk->id]);

					$result = [
						'success' => 'Data hasil disimpan'
					];

					echo json_encode($result);	
				}
			} else {
				
				$getData = $this->PesananModel->whereGroup(['pesanan.status' => 0, 'pesanan.tgl_pesanan' => date('Y-m-d')], 'pesanan.kode_pesanan')->result();
				$count = count($getData) + 1;
				$kode =  'PSN-'.date('Y-m-d').$count;
				if ($produk) {
					$data = [
						'id' => $this->uuid->v4(),
						'id_produk' => $produk->id,
						'kode_pesanan' => $kode,
						'jumlah' => 1,
						'harga' => $produk->harga,
						'tgl_pesanan' => date('Y-m-d'),
						'created_at' => date("Y-m-d\TH:i:s"),
						'status' => 1
					];
					$this->PesananModel->insert($data);
					$result = [
						'success' => 'Data hasil disimpan'
					];
				} else {
					$result = [
						'fail' => 'Data gagal disimpan'
					];
				}

				echo json_encode($result);
			}	
		}
	}
	public function edit($id)
	{
		$produk = $this->ProdukModel->edit(['kode' => $this->input->post('kode')]);
		if ($produk->stok < $this->input->post('jumlah')) {
			$result = [
				'fail' => 'Maaf stok tidak mencukupi'
			];

			echo json_encode($result);
		} else {
			$this->PesananModel->do_edit(['jumlah' => $this->input->post('jumlah')], ['id' => $id]);
			$result = [
				'success' => 'Data hasil ditambah'
			];

			echo json_encode($result);
		}
	}
	public function category($id)
	{
		if ($id == 'all') {
			$category = $category = $this->ProdukModel->where(['kategori.id' => $id])->result();
		} else {
			$category = $this->ProdukModel->where(['kategori.id' => $id])->result();
		}
		
		echo json_encode($category);
	}
	public function allCategory()
	{
		$category = $this->ProdukModel->show()->result();
		
		echo json_encode($category);
	}
	public function print_kwitansi()
	{
		$pesanan =  $this->PesananModel->where(['pesanan.status' => 1, 'pesanan.tgl_pesanan' => date('Y-m-d')])->row();
		$getPesanan =  $this->PesananModel->where(['pesanan.status' => 1, 'pesanan.tgl_pesanan' => date('Y-m-d')])->result();
		
		// $this->cetak_struk();

		$this->db->trans_start();
		$this->db->trans_strict(FALSE); 

		foreach ($getPesanan as $value) {
			$stok = $value->stok - $value->jumlah;
		    $this->ProdukModel->do_edit(['stok' => $stok], ['id' => $value->id]);
		}
		$data = [
			'id' => $this->uuid->v4(),
			'kode_pesanan' => $pesanan->kode_pesanan,
			'bayar' => $this->input->post('bayar'),
			'kembalian' => $this->input->post('kembalian'),
			'tanggal' => date("Y-m-d\TH:i:s")
		];
		$this->PesananModel->do_edit(['status' => 0], ['kode_pesanan' => $pesanan->kode_pesanan]);
		$this->KwitansiModel->insert($data);
		$result = [
			'success' => 'Data hasil disimpan'
		];

		echo json_encode($result);
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		} 
		else {

		    $this->db->trans_commit();
		    return TRUE;
		}
	}
	public function cetak_struk()
	{
		$this->load->library("escpos");

		try {
				// Enter the device file for your USB printer here
			  	$connector = new Escpos\PrintConnectors\FilePrintConnector("/dev/usb/lp0");
				   
				/* Print a "Hello world" receipt" */
				$printer = new Escpos\Printer($connector);

				function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
		            // Mengatur lebar setiap kolom (dalam satuan karakter)
		            $lebar_kolom_1 = 12;
		            $lebar_kolom_2 = 8;
		            $lebar_kolom_3 = 8;
		            $lebar_kolom_4 = 9;

		            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
		            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
		            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
		            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
		            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

		            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
		            $kolom1Array = explode("\n", $kolom1);
		            $kolom2Array = explode("\n", $kolom2);
		            $kolom3Array = explode("\n", $kolom3);
		            $kolom4Array = explode("\n", $kolom4);

		            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
		            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

		            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
		            $hasilBaris = array();

		            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
		            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

		                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
		                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
		                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

		                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
		                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
		                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

		                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
		                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
		            }

		            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
		            return implode($hasilBaris, "\n") . "\n";
		        }

		        $printer->initialize();
		        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
		        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
		        $printer->text("Nama Toko\n");
		        $printer->text("\n");

		        // Data transaksi
		        $printer->initialize();
		        $printer->text("Kasir : Badar Wildanie\n");
		        $printer->text("Waktu : 13-10-2019 19:23:22\n");

		        // Membuat tabel
		        $printer->initialize(); // Reset bentuk/jenis teks
		        $printer->text("----------------------------------------\n");
		        $printer->text(buatBaris4Kolom("Barang", "qty", "Harga", "Subtotal"));
		        $printer->text("----------------------------------------\n");
		        $printer->text(buatBaris4Kolom("Makaroni 250gr", "2pcs", "15.000", "30.000"));
		        $printer->text(buatBaris4Kolom("Telur", "2pcs", "5.000", "10.000"));
		        $printer->text(buatBaris4Kolom("Tepung terigu", "1pcs", "8.200", "16.400"));
		        $printer->text("----------------------------------------\n");
		        $printer->text(buatBaris4Kolom('', '', "Total", "56.400"));
		        $printer->text("\n");

		         // Pesan penutup
		        $printer->initialize();
		        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
		        $printer->text("Terima kasih telah berbelanja\n");
		        $printer->text("http://badar-blog.blogspot.com\n");

		        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)

				$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}
	}
	public function delete($id)
	{
	    $this->PesananModel->delete(['id' => $id]);
	    $result = [
			'success' => 'Data hasil dihapus'
		];

		echo json_encode($result);
	}
}