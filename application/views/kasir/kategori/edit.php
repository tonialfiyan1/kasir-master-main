<?php $this->load->view('kasir/template/head'); ?>
<?php $this->load->view('kasir/template/header'); ?>
<?php $this->load->view('kasir/template/menu'); ?>

        <main>
            <div class="container-fluid site-width">
                
                <?php $this->load->view('kasir/template/breadcrumbs'); ?>
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
                                            <?= form_open('kasir/kategori/edit/'.$data->id) ?>
                                                <div class="form-group">
                                                    <label for="inputAddress">Kategori Produk</label>
                                                    <input type="text" class="form-control" value="<?= $data->kategori; ?>" name="kategori" placeholder="Masukan kategori produk">
                                                    <?= form_error('kategori', '<small class="text-danger">', '</small>'); ?>
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

<?php $this->load->view('kasir/template/footer'); ?>