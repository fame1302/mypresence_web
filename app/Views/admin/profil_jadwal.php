<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $page_data['title']; ?></h1>
        <a href="<?= base_url(); ?>/admin/tambah_profil_jadwal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Profil</a>
    </div>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="my-breadcrumb">
                <li class="m-0 font-weight-bold text-primary"><?= $page_data['sub_title']; ?></li>
            </ul>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error') !== null) : ?>
                <div class="row">
                    <div class="alert alert-danger ml-2" role="alert">
                        <span class="fa fa-times"></span>
                        <?= ' ' . session()->getFlashdata('error'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success') !== null) : ?>
                <div class="row">
                    <div class="alert alert-success ml-2" role="alert">
                        <span class="fa fa-check"></span>
                        <?= ' ' . session()->getFlashdata('success'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Profil</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Durasi Kehadiran</th>
                            <th>Default</th>
                            <th>aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($profil_jabatan as $key) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $key['nama_profil']; ?></td>
                                <td><?= $key['jam_masuk']; ?></td>
                                <td><?= $key['jam_pulang']; ?></td>
                                <td><?= $key['durasi']; ?> Menit</td>
                                <td>
                                    <?php if ($key['default'] == 1) : ?>
                                        <span class="badge badge-pill badge-primary"> <span class="fa fa-check mr-2"></span>Default</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url(); ?>/admin/edit_profil_jadwal/<?= $key['id']; ?>" class="btn btn-warning mb-2">Edit</a>

                                    <form action="<?= base_url(); ?>/admin/profil_jadwal/<?= $key['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" onclick="return confirm('apa anda yakin?');" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>