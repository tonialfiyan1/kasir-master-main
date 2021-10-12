<div class="sidebar">
            <div class="site-width">

                <!-- START: Menu-->
                <ul id="side-menu" class="sidebar-menu">
                    <li class="dropdown"><a href="#"><i class="icon-doc mr-1"></i> Katalog</a>                  
                        <ul>
                            <li class="<?= $this->uri->segment(2) == 'produk' ? 'active' : ''; ?>"><a href="<?= base_url('admin/produk') ?>"><i class="icon-bag"></i> Produk</a></li>
                            <li class="<?= $this->uri->segment(2) == 'kategori' ? 'active' : ''; ?>"><a href="<?= base_url('admin/kategori') ?>"><i class="icon-tag"></i> Kategori Produk</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><i class="icon-book-open mr-1"></i> Laporan</a>                  
                        <ul>
                            <li class="<?= $this->uri->segment(2) == 'penjualan' ? 'active' : ''; ?>"><a href="<?= base_url('admin/laporan/penjualan') ?>"><i class="icon-credit-card"></i> Penjualan</a></li>
                            <li class="<?= $this->uri->segment(2) == 'penjualan_produk' ? 'active' : ''; ?>"><a href="<?= base_url('admin/laporan/penjualan_produk') ?>"><i class="icon-event"></i> Penjualan Produk</a></li>
                            <li class="<?= $this->uri->segment(2) == 'transaksi' ? 'active' : ''; ?>"><a href="<?= base_url('admin/laporan/transaksi') ?>"><i class="icon-pencil"></i> Transaksi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><i class="icon-folder mr-1"></i> Data Master</a>                  
                        <ul>
                            <li class="<?= $this->uri->segment(2) == 'pengguna' ? 'active' : ''; ?>"><a href="<?= base_url('admin/pengguna') ?>"><i class="icon-people"></i> Pengguna</a></li>
                        </ul>
                    </li>
                </ul>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                    <li class="breadcrumb-item"><a href="#">Application</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div>
        </div>