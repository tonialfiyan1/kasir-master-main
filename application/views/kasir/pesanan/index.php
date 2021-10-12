<?php $this->load->view('kasir/template/head'); ?>
<?php $this->load->view('kasir/template/header'); ?>
<?php $this->load->view('kasir/template/menu'); ?>
    <main>
        <div class="container-fluid site-width">
            
            <?php $this->load->view('kasir/template/breadcrumbs'); ?>
            <div class="row">
                <div class="col-8 mt-3">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="myAlert"></div>
                    <div class="card">
                        <div class="card-body d-md-flex text-center">
                            <i class="h6 icon-magnifier ml-2 mt-2"></i>
                            <input style="font-size : 15px" type="text" id="search" class="form-control border-0 rounded bg-search pl-5" placeholder="Gunakan Kode Barcode Disini ....">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="col-12">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-sm-row justify-content-center ">
                                    <a class="nav-link body-color h6 mb-0 category" id="inList" data-toggle="tab" href="#" > 
                                        Semua Kategori
                                    </a>
                                    <?php foreach ($kategori as $value): ?>
                                    <li class="nav-item">
                                        <a class="nav-link body-color h6 mb-0 category" data-id="<?= $value->id ?>" data-toggle="tab" href="#" > 
                                            <?= $value->kategori ?> 
                                        </a>
                                    </li>
                                    <?php endforeach ?>
                                </ul> 
                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="row" id="products">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                </div> 
                <div class="col-4 mt-3">
                    <div class="card">
                        <div class="card-body border border-top-0 border-right-0 border-left-0">
                            <h4 class="f-weight-500 mb-3">Detail Pesanan</h4>
                            <div class="table-responsive">
                                <table  id="mytable" class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" style="text-align:right">Total:</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table> 
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body border border-top-0 border-right-0 border-left-0">
                            <h5> Note :</h5>
                            <form method="post" id="print">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th colspan="3"><h5>Total</h5></th>
                                            <th colspan="2" id="total"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3"><h5>Bayar</h5></th>
                                            <th colspan="2"><input type="text" id="rupiah" required="" class="form-control form-control-lg pay" name="bayar"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3"><h5> Kembalian</h5></th>
                                            <th colspan="2"><input type="text" id="kembalian" required="" readonly="" class="form-control form-control-lg" name="kembalian"></th>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div><hr> 
                            <div class="float-left w-100 text-center text-sm-left mb-3">
                                <button type="submit" class="btn btn-lg btn-block btn-info"><b>Simpan & Cetak</b></button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>                  
        </div>
    </main>
<?php $this->load->view('kasir/template/footer'); ?>
<script type="text/javascript">
    
    function convertToRupiah(angka)
    {
        var rupiah = '';        
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }
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
            "paging": false,
            "bInfo" : false,
            "ajax": {
                url : "<?= base_url('kasir/pesanan/getData') ?>",
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
                    .column( 4 )  //kolom yang ingin di total
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                // Update footer
                // api.column( 3 ) artinya di kolom mana data total akan di tampilkan
                $( api.column( 4 ).footer() ).html(
                    convertToRupiah(pageTotal)
                );
                $('#total').html(`<h5>`+convertToRupiah(pageTotal)+`</h5>`);
                $('.pay').keyup(function(event) {
                    var bayar = $(this).val().replace(/[^0-9]/g,'');
                    var kembalian = bayar - total;

                    $('#kembalian').val(convertToRupiah(kembalian));
                });
            }
        });
    });
</script>
<script type="text/javascript">

    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    /* Fungsi formatRupiah */
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
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#search").focus();
        var timeout;
        var delay = 400;

        $('#search').on('keyup change', function(event) {
            event.preventDefault();
            var key = $(this).val();
            if(timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
               
               $.ajax({
                    url: '<?= base_url('kasir/pesanan/search') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { kode: key },
                    success: function(response)
                    {
                        if (response.success) {
                            $("#search").focus();
                            $('#search').val('');
                            $("#mytable").DataTable().ajax.reload();
                        }else{
                            $("#search").focus();
                            $(".myAlert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ response.fail+''),window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},5e3)
                        }
                    }
                });

            }, delay);
        });

        $('body').on('keyup', '.jumlah', function(event) {
            event.preventDefault();
                var id = $(this).data("id");
                var jumlah = $(this).val();
                var kode = $(this).data('kode');
            if(timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(function() {
               
                if (jumlah == 0) {
                    $.ajax({
                        url: '<?= base_url('kasir/pesanan/delete/') ?>'+id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response)
                        {
                            if (response.success) {
                                $("#search").focus();
                                $("#mytable").DataTable().ajax.reload();
                            }else{
                                $("#search").focus();
                            }
                        }
                    }); 
                }else{
                    $.ajax({
                        url: '<?= base_url('kasir/pesanan/edit/') ?>'+id,
                        type: 'POST',
                        dataType: 'json',
                        data: { jumlah: jumlah, kode:kode },
                        success: function(response)
                        {
                            if (response.success) {
                                $("#search").focus();
                                $('#search').val('');
                                $("#mytable").DataTable().ajax.reload();
                            }else{
                                $("#search").focus();
                                $("#mytable").DataTable().ajax.reload();
                                $(".myAlert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ response.fail+''),window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},5e3)
                            }
                        }
                    });
                }

            }, 700);
        });

        $('#print').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('kasir/pesanan/print_kwitansi') ?>",
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: (response) => {
                    if (response.success) {
                        $("#search").focus();
                        $('#search').val('');
                        $('#print').trigger("reset");
                        $("#mytable").DataTable().ajax.reload();
                    }else{
                        $("#search").focus();

                        $(".myAlert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ response.fail+''),window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},5e3)
                    }
                }                
            });
        });  

        $('body').on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            swal({
                title: "Ingin menghapus?",
                text: "Klik Ok dan anda akan menghapus data ini.",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-info',
                confirmButtonClass: 'btn-danger',
            },
            function(){
                $.ajax({
                    url: '<?= base_url('kasir/pesanan/delete/') ?>'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response)
                    {
                        if (response.success) {
                            $("#search").focus();
                            $("#mytable").DataTable().ajax.reload();
                        }else{
                            $("#search").focus();
                        }
                    }
                });                
            });
        });

        $('body').on('click', '.addProduct', function (e) {
            e.preventDefault();
            var kode = $(this).data("kode");
            $.ajax({
                url: '<?= base_url('kasir/pesanan/search') ?>',
                type: 'POST',
                dataType: 'json',
                data: { kode: kode },
                success: function(response)
                {
                    if (response.success) {
                        $("#search").focus();
                        $('#search').val('');
                        $("#mytable").DataTable().ajax.reload();
                    }else{
                        $("#search").focus();

                        $(".myAlert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ response.fail+''),window.setTimeout(function(){$(".alert").fadeTo(500,0).slideUp(500,function(){$(this).remove()})},5e3)
                    }
                }
            });
        });

        $.ajax({
            url: '<?= base_url('kasir/pesanan/allCategory/') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response)
            {
                if (response) {
                    $('#inList').addClass('active');
                    var html = '';
                    for(i = 0; i < response.length; i++){
                        html += `<a href="#" class="addProduct" data-kode="`+response[i].kode+`">
                                        <div class="col-md-6 col-lg-3 mb-4">
                                            <div class="position-relative">
                                                <img src="<?= base_url('assets/images/produk/') ?>`+response[i].foto_produk+`" alt="" class="img-fluid">
                                            </div>
                                            <div class="pt-3">
                                                <p class="mb-2"><a href="#" class="font-weight-bold text-primary addProduct" data-kode="`+response[i].kode+`">`+response[i].produk+`</a></p>
                                                <div class="clearfix">
                                                    <div class="d-inline-block text-danger">`+convertToRupiah(response[i].harga)+`</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>`;
                        $('#products').html(html);
                    }
                }else{
                    $("#search").focus();
                }
            }
        });
        
        $('body').on('click', '#inList', function (e) { 
            e.preventDefault();
            $.ajax({
                url: '<?= base_url('kasir/pesanan/allCategory/') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                    if (response) {
                        $('#inList').addClass('active');
                        var html = '';
                        for(i = 0; i < response.length; i++){
                            html += `<a href="#" class="addProduct" data-kode="`+response[i].kode+`">
                                            <div class="col-md-6 col-lg-3 mb-4">
                                                <div class="position-relative">
                                                    <img src="<?= base_url('assets/images/produk/') ?>`+response[i].foto_produk+`" alt="" class="img-fluid">
                                                </div>
                                                <div class="pt-3">
                                                    <p class="mb-2"><a href="#" class="font-weight-bold text-primary addProduct" data-kode="`+response[i].kode+`">`+response[i].produk+`</a></p>
                                                    <div class="clearfix">
                                                        <div class="d-inline-block text-danger">`+convertToRupiah(response[i].harga)+`</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>`;
                            $('#products').html(html);
                        }
                    }else{
                        $("#search").focus();
                    }
                }
            });
        });
        $('body').on('click', '.category', function (e) {
            e.preventDefault();
            $('#inList').removeClass('active');
            var category = $(this).data("id");
            $.ajax({
                url: '<?= base_url('kasir/pesanan/category/') ?>'+category,
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                    if (response) {
                        $("#search").focus();
                        $('.addProduct').remove();
                        var html = '';
                        for(i = 0; i < response.length; i++){
                            html += `<a href="#" class="addProduct" data-kode="`+response[i].kode+`">
                                            <div class="col-md-6 col-lg-3 mb-4">
                                                <div class="position-relative">
                                                    <img src="<?= base_url('assets/images/produk/') ?>`+response[i].foto_produk+`" alt="" class="img-fluid">
                                                </div>
                                                <div class="pt-3">
                                                    <p class="mb-2"><a href="#" class="font-weight-bold text-primary addProduct" data-kode="`+response[i].kode+`">`+response[i].produk+`</a></p>
                                                    <div class="clearfix">
                                                        <div class="d-inline-block text-danger">`+convertToRupiah(response[i].harga)+`</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>`;
                            $('#products').html(html);
                        }
                    }else{
                        $("#search").focus();
                    }
                }
            });
        });       
    });
</script>