<?php $this->load->view('tenaga-pendidik/template/head'); ?>
<?php $this->load->view('tenaga-pendidik/template/header'); ?>
<?php $this->load->view('tenaga-pendidik/template/menu'); ?>  
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Form User</h5>
        <?= $this->session->flashdata('message'); ?>
        <?= form_open('tenaga-pendidik/user/edit/'.$data->id_user, array('enctype' => 'multipart/form-data')); ?>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">NIDN</label>
                <div class="col-sm-10">
                    <input name="nidn" id="exampleEmail" placeholder="NIDN" type="text"  value="<?= $data->nidn; ?>" class="form-control">
                    <?= form_error('nidn', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input name="nama" id="exampleEmail" placeholder="Nama" type="text"  value="<?= $data->nama; ?>" class="form-control">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleText" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat" id="exampleText" class="form-control" placeholder="Masukan alamat"><?= $data->alamat; ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Telp</label>
                <div class="col-sm-10">
                    <input name="telp" placeholder="Telp" type="text"  value="<?= $data->telp; ?>" class="form-control">
                    <?= form_error('telp', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input name="username" placeholder="Masukan username" type="text"  value="<?= $data->username; ?>" class="form-control">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleFile" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-5">
                    <input name="foto" id="exampleFile" type="file" class="form-control-file">
                    <small class="form-text text-muted">Anda dapat mengunggah file foto dengan ekstensi gif|jpg|png|jpeg dan maksimal ukuran file 2 Mb.
                    </small>
                </div>
                <div class="col-sm-5">
                    <div class="avatar avatar-image  avatar-lg">
                        <img src="<?= base_url('assets/images/user/'.$data->foto) ?>">
                    </div>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleSelect" class="col-sm-2 col-form-label">Bagian</label>
                <div class="col-sm-10">
                    <select name="bagian" id="exampleSelect" class="form-control">
                        <option <?= $data->bagian == 'Hukum Perdata' ? 'selected' : ''; ?> value="Hukum Perdata">Hukum Perdata</option>
                        <option <?= $data->bagian == 'Hukum Pidana' ? 'selected' : ''; ?> value="Hukum Pidana">Hukum Pidana</option>
                        <option <?= $data->bagian == 'HTN/HAN' ? 'selected' : ''; ?> value="HTN/HAN">HTN/HAN</option>
                        <option <?= $data->bagian == 'Pegawai' ? 'selected' : ''; ?> value="Pegawai">Pegawai</option>
                    </select>
                </div>
                <?= form_error('bagian', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleSelect" class="col-sm-2 col-form-label">Posisi</label>
                <div class="col-sm-10">
                    <select name="posisi" id="exampleSelect" class="form-control">
                        <option <?= $data->posisi == 'Dosen Pembimbing' ? 'selected' : ''; ?> value="Dosen Pembimbing">Dosen Pembimbing</option>
                        <option <?= $data->posisi == 'Dosen Penguji' ? 'selected' : ''; ?> value="Dosen Penguji">Dosen Penguji</option>
                        <option <?= $data->posisi == 'Tenaga Pendidik' ? 'selected' : ''; ?> value="Tenaga Pendidik">Tenaga Pendidik</option>
                        <option <?= $data->posisi == 'Kaprogdi' ? 'selected' : ''; ?> value="Kaprogdi">Kaprogdi</option>
                    </select>
                </div>
                <?= form_error('posisi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="position-relative row form-check">
                <div class="divider"></div>
                <div class="clearfix">
                    <a href="<?= base_url('tenaga-pendidik/user') ?>" id="prev-btn" class="btn-shadow float-left btn-wide btn-pill btn btn-outline-secondary">Kembali</a>
                    <button type="submit" id="next-btn" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-info">Simpan</button>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>
<?php $this->load->view('tenaga-pendidik/template/footer'); ?> 