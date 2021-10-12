<?php $this->load->view('admin/template/head'); ?>
<?php $this->load->view('admin/template/header'); ?>
<?php $this->load->view('admin/template/menu'); ?>

        <main>
            <div class="container-fluid site-width">
                
                <?php $this->load->view('admin/template/breadcrumbs'); ?>
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header">                               
                                <h6 class="card-title">Form Input</h6>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <?= form_open('admin/produk/edit/'.$data->id, array('enctype' => 'multipart/form-data')) ?>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputAddress">Kode Produk</label>
                                                        <input type="text" class="form-control" value="<?= $data->kode; ?>" name="kode" placeholder="Masukan kode barcode disini">
                                                        <?= form_error('kode', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Kategori Produk</label>
                                                        <select class="form-control rounded" name="id_kategori">
                                                            <option>-- Pilih Kategori Produk --</option>
                                                            <?php foreach ($kategori as $value): ?>
                                                                <option <?= $data->id_kategori == $value->id ? 'selected' : ''; ?> value="<?= $value->id ?>"><?= $value->kategori ?></option>
                                                                
                                                            <?php endforeach ?>
                                                        </select>
                                                        <?= form_error('id_kategori', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputAddress2">Nama Produk</label>
                                                        <input type="text" value="<?= $data->produk; ?>" class="form-control" name="produk" placeholder="Nama Produk">
                                                        <?= form_error('produk', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputAddress2">Merek Produk</label>
                                                        <input type="text" value="<?= $data->merek; ?>" class="form-control" name="merek" placeholder="Nama merek produk">
                                                        <?= form_error('merek', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Foto Produk</label>
                                                        <input type="file" class="form-control rounded" name="foto_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4">Harga</label>
                                                        <input type="text" value="<?= $data->harga; ?>" name="harga" id="rupiah" class="form-control" name="text" placeholder="Masukan harga">
                                                        <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Stok</label>
                                                        <input type="text" value="<?= $data->stok; ?>" onkeypress="return hanyaAngka(event)" class="form-control rounded" name="stok" placeholder="Masukan stok">
                                                        <?= form_error('stok', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4">Satuan</label>
                                                        <input type="satuan" class="form-control" value="<?= $data->satuan; ?>"  name="satuan" placeholder="Masukan Satuan">
                                                        <?= form_error('satuan', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <hr>

                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            <?= form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

<?php $this->load->view('admin/template/footer'); ?>
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

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>