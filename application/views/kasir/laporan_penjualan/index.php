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
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6" style="text-align:right">Total:</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
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
        function convertToRupiah(angka)
        {
            var rupiah = '';        
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }
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
                url : "<?= base_url('kasir/laporan/getData') ?>",
                type : 'POST',
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$Rp. ]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 6 )  //kolom yang ingin di total
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Update footer
                // api.column( 3 ) artinya di kolom mana data total akan di tampilkan
                $( api.column( 6 ).footer() ).html(
                    convertToRupiah(pageTotal)
                );
            }
        });
    });
</script>
<script type="text/javascript">

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

