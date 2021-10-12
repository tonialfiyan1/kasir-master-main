<?php $this->load->view('tenaga-pendidik/template/head'); ?>
<?php $this->load->view('tenaga-pendidik/template/header'); ?>
<?php $this->load->view('tenaga-pendidik/template/menu'); ?>    
    <div class="card">
        <div class="card-body">
            <h4>Data User</h4>
            <a href="<?= base_url('tenaga-pendidik/user/tambah') ?>" class="btn-shadow btn btn-info"><i class="fa fa-plus fa-w-20"></i> Tambah User</a>
            <div class="m-t-25">
                <?= $this->session->flashdata('message'); ?>
                <table id="data-table" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Foto</th>
                            <th>Email</th>
                            <th>Posisi</th>
                            <th>Bagian</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 1; foreach ($data as $value): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $value->nidn ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->alamat ?></td>
                                <td><?= $value->telp ?></td>
                                <td>
                                <div class="avatar avatar-image">
                                    <img src="<?= base_url('assets/images/user/'.$value->foto) ?>">
                                </div></td>
                                <td><?= $value->username ?></td>
                                <td><div class="badge badge-pill badge-danger"><?= $value->posisi ?></div></td>
                                <td><div class="badge badge-pill badge-danger"><?= $value->bagian ?></div></td>
                                <td>
                                    <a href="<?= base_url('tenaga-pendidik/user/edit/'.$value->id_user); ?>" class="btn btn-info">Edit</a>
                                    <a href="<?= base_url('tenaga-pendidik/user/hapus/'.$value->id_user); ?>" onclick="return confirm('Yakin ingin menghapus data ini?');" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>                                    
                        <?php $no ++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $this->load->view('tenaga-pendidik/template/footer'); ?>