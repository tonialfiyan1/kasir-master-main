<?php $this->load->view('kasir/template/head'); ?>
<?php $this->load->view('kasir/template/header'); ?>
<?php $this->load->view('kasir/template/menu'); ?>
        
        <main>
            <div class="container-fluid site-width">
                
                <?php $this->load->view('kasir/template/breadcrumbs'); ?>
                <div class="row">
                    <div class="col-12 mt-3">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">Data <?= $title ?></h4> 
                                <a href="<?= base_url('kasir/produk/tambah') ?>" class="btn btn-primary float-right">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Foto</th>
                                                <th>Kategori</th>
                                                <th>Nama Produk</th>
                                                <th>Merek</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div>
                        </div> 

                    </div>                  
                </div>
            </div>
        </main>
<?php $this->load->view('kasir/template/footer'); ?>
<script type="text/javascript">
    $(document).ready(function() { 
        (function(a) {
            a.CFInstall || (a.CFInstall = {
                check: function(a) {
                    window.console && console.warn && console.warn("Google Chrome Frame is being retired, so the CFInstall.check method no longer notifies the user; see http://blog.chromium.org/2013/06/retiring-chrome-frame.html for more information.");
                },
                _force: !1,
                _forceValue: !1,
                isAvailable: function() {
                    return !1;
                }
            });
        })(this.ChromeFrameInstallScope || this);
        $.ajaxSetup({
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        });
        var table = $('#mytable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            oLanguage: {
                sInfo: "Menampilkan data _START_ dari _END_ jumlah _TOTAL_ data",
                sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                sSearchPlaceholder: "Cari...",
                sLengthMenu: "Halaman :  _MENU_",
                sZeroRecords: "Data tidak ditemukan",
                sProcessing: "Sedang memuat",
                sInfoFiltered: "",
                sInfoEmpty: "Data tidak ditemukan",
            },
            "ajax": {
                url : "<?= base_url('kasir/produk/getData') ?>",
                type : 'POST',
            },
           "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    });
</script>
