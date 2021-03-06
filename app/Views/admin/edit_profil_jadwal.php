<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $page_data['title']; ?></h1>
    </div>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="my-breadcrumb">
                <li class="m-0 font-weight-bold text-primary"><a href="<?= base_url(); ?>/admin/profil_jadwal"><?= $page_data['sub_title']; ?></a></li>
                <li class="m-0 font-weight-bold">/</li>
                <li class="m-0 font-weight-bold">Edit Profil</li>
            </ul>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('success') !== null) : ?>
                <div class="row">
                    <div class="alert alert-success ml-2" role="alert">
                        <span class="fa fa-check"></span>
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url(); ?>/admin/edit_profil_jadwal">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $profil_jadwal['id']; ?>">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Profil</label>
                    <div class="col-sm-5">
                        <input value="<?= (old('nama_profil')) ? old('nama_profil') : $profil_jadwal['nama_profil']; ?>" name="nama_profil" type="text" class="form-control <?= ($validation->hasError('nama_profil')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('nama_profil'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Jam Masuk</label>
                    <div class="col-sm-3">
                        <input value="<?= (old('jam_masuk')) ? old('jam_masuk') : $profil_jadwal['jam_masuk']; ?>" name="jam_masuk" type="time" class="form-control <?= ($validation->hasError('jam_masuk')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('jam_masuk'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Jam Pulang</label>
                    <div class="col-sm-3">
                        <input value="<?= (old('jam_pulang')) ? old('jam_pulang') : $profil_jadwal['jam_pulang']; ?>" name="jam_pulang" type="time" class="form-control <?= ($validation->hasError('jam_pulang')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('jam_pulang'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Durasi</label>
                    <div class="col-sm-2">
                        <input value="<?= (old('durasi')) ? old('durasi') : $profil_jadwal['durasi']; ?>" name="durasi" type="number" class="form-control <?= ($validation->hasError('durasi')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('durasi'); ?>
                        </div>
                    </div>
                    <label class="col-sm-1 col-form-label">Menit</label>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <?php
                        $default = (old('default')) ? old('default') : $profil_jadwal['default'];
                        ?>
                        <input name="default" type="checkbox" class="custom-control-input" id="customCheck" <?= ($default == 'on' || $default == 1) ? 'checked' : ''; ?>>
                        <label class="custom-control-label" style="line-height: 27px;" for="customCheck">Set sebagai profil jadwal default.</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <input type="submit" class="btn btn-primary" value="Simpan Perubahan">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>