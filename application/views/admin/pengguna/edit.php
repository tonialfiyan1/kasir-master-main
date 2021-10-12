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
                                            <?= form_open('admin/pengguna/edit/'.$data->id, array('enctype' => 'multipart/form-data')) ?>
                                                <div class="form-group">
                                                    <label for="inputAddress2">Nama</label>
                                                    <input type="text" value="<?= $data->nama; ?>" class="form-control" name="nama" placeholder="Nama pengguna">
                                                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress">Alamat</label>
                                                    <input type="text" class="form-control" value="<?= $data->alamat; ?>" name="alamat" placeholder="Masukan Alamat">
                                                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Foto</label>
                                                        <input type="file" class="form-control rounded" name="foto">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4">No.Telp</label>
                                                        <input type="text" value="<?= $data->telp; ?>" name="telp" class="form-control" onkeypress="return hanyaAngka(event)" name="text" placeholder="Masukan No.Telp">
                                                        <?= form_error('telp', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Username</label>
                                                        <input type="text" value="<?= $data->username; ?>" class="form-control rounded" name="username" placeholder="Masukan Username">
                                                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4">Password</label>
                                                        <input type="text" value="<?= decrypt_url($data->password); ?>" class="form-control" name="password" placeholder="Password">
                                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4">Role</label>
                                                        <select class="form-control rounded" name="role">
                                                            <option>-- Pilih Role/Posisi --</option>
                                                            <option <?= $data->role == 'Kasir' ? 'selected' : ''; ?> value="Kasir">Kasir</option>
                                                            <option <?= $data->role == 'Admin' ? 'selected' : ''; ?> value="Admin">Admin</option>
                                                        </select>
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
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>