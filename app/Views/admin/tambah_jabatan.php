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
            <h6 class="m-0 font-weight-bold text-primary"><?= $page_data['sub_title']; ?></h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url(); ?>/admin/tambah_jabatan">
                <?= csrf_field() ?>

                <?php if (session()->getFlashdata('success') !== null) : ?>
                    <div class="row">
                        <div class="alert alert-success ml-2" role="alert">
                            <span class="fa fa-check"></span>
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-5">
                        <input value="<?= old('nama_jabatan'); ?>" name="nama_jabatan" type="text" class="form-control <?= ($validation->hasError('nama_jabatan')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('nama_jabatan'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Singkat</label>
                    <div class="col-sm-5">
                        <input value="<?= old('nama_singkat'); ?>" name="nama_singkat" type="text" class="form-control <?= ($validation->hasError('nama_singkat')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('nama_singkat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Jumlah Maksimal Karyawan</label>
                    <div class="col-sm-5">
                        <input value="<?= old('jml_karyawan'); ?>" name="jml_karyawan" type="number" min="0" class="form-control <?= ($validation->hasError('jml_karyawan')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('jml_karyawan'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-5">
                        <input type="submit" class="btn btn-primary" value="Tambah Jabatan">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>