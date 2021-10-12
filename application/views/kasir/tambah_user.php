<?php $this->load->view('tenaga-pendidik/template/head'); ?>
<?php $this->load->view('tenaga-pendidik/template/header'); ?>
<?php $this->load->view('tenaga-pendidik/template/menu'); ?>  
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Form User</h5>
        <?= $this->session->flashdata('message'); ?>
        <?= form_open('tenaga-pendidik/user/tambah', array('enctype' => 'multipart/form-data')); ?>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">NIDN</label>
                <div class="col-sm-10">
                    <input name="nidn" id="exampleEmail" placeholder="NIDN" type="text"  value="<?= set_value('nidn'); ?>" class="form-control">
                    <?= form_error('nidn', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input name="nama" id="exampleEmail" placeholder="Nama" type="text"  value="<?= set_value('nama'); ?>" class="form-control">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleText" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat" id="exampleText" class="form-control" placeholder="Masukan alamat"><?= set_value('alamat'); ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Telp</label>
                <div class="col-sm-10">
                    <input name="telp" placeholder="Telp" type="text"  value="<?= set_value('telp'); ?>" class="form-control">
                    <?= form_error('telp', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input name="username" placeholder="Masukan username" type="text"  value="<?= set_value('username'); ?>" class="form-control">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="examplePassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input name="password" placeholder="Masukan password" type="password" class="form-control">
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleFile" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input name="foto" id="exampleFile" type="file" class="form-control-file">
                    <small class="form-text text-muted">Anda dapat mengunggah file foto dengan ekstensi gif|jpg|png|jpeg dan maksimal ukuran file 2 Mb.
                    </small>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleEmail" class="col-sm-2 col-form-label">Bagian</label>
                <div class="col-sm-10">
                    <select name="bagian" id="exampleEmail" class="form-control">
                        <option value="">-- Pilih Bagian --</option>
                        <option value="Hukum Perdata">Hukum Perdata</option>
                        <option value="Hukum Pidana">Hukum Pidana</option>
                        <option value="HTN/HAN">HTN/HAN</option>
                        <option value="Pegawai">Pegawai</option>
                    </select>
                    <?= form_error('bagian', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <div class="position-relative row form-group">
                <label for="exampleSelect" class="col-sm-2 col-form-label">Posisi</label>
                <div class="col-sm-10">
                    <select name="posisi" id="exampleSelect" class="form-control">
                        <option value="Dosen Pembimbing">Dosen Pembimbing</option>
                        <option value="Dosen Penguji">Dosen Penguji</option>
                        <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                        <option value="Kaprogdi">Kaprogdi</option>
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