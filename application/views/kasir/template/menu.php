<div class="sidebar">
    <div class="site-width">

        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="#"><i class="icon-screen-desktop mr-1"></i> Kasir</a>                  
                <ul>
                    <li class="<?= $this->uri->segment(2) == 'pesanan' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/pesanan') ?>"><i class="icon-calculator"></i> Pesanan</a></li>
                    <li class="<?= $this->uri->segment(2) == 'terjual' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/terjual') ?>"><i class="icon-briefcase"></i> Terjual Hari Ini</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#"><i class="icon-doc mr-1"></i> Katalog</a>                  
                <ul>
                    <li class="<?= $this->uri->segment(2) == 'produk' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/produk') ?>"><i class="icon-bag"></i> Produk</a></li>
                    <li class="<?= $this->uri->segment(2) == 'kategori' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/kategori') ?>"><i class="icon-tag"></i> Kategori Produk</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#"><i class="icon-book-open mr-1"></i> Laporan</a>                  
                <ul>
                    <li class="<?= $this->uri->segment(3) == 'penjualan' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/laporan/penjualan') ?>"><i class="icon-credit-card"></i> Penjualan</a></li>
                    <li class="<?= $this->uri->segment(3) == 'penjualan_produk' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/laporan/penjualan_produk') ?>"><i class="icon-event"></i> Penjualan Produk</a></li>
                    <li class="<?= $this->uri->segment(3) == 'transaksi' ? 'active' : ''; ?>"><a href="<?= base_url('kasir/laporan/transaksi') ?>"><i class="icon-pencil"></i> Transaksi</a></li>
                </ul>
            </li>
        </ul>
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
        </ol>
    </div>
</div>