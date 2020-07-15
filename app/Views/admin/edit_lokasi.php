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
                <li class="m-0 font-weight-bold text-primary"><a href="/admin/lokasi"><?= $page_data['sub_title']; ?></a></li>
                <li class="m-0 font-weight-bold">/</li>
                <li class="m-0 font-weight-bold">Edit Lokasi</li>
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
            <form method="post" action="<?= base_url(); ?>/admin/edit_lokasi">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $lokasi['id']; ?>">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Lokasi</label>
                    <div class="col-sm-5">
                        <input value="<?= (old('nama_lokasi')) ? old('nama_lokasi') : $lokasi['nama_lokasi']; ?>" name="nama_lokasi" type="text" class="form-control <?= ($validation->hasError('nama_lokasi')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->showError('nama_lokasi'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                        <textarea name="alamat" cols="30" rows="3" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"><?= (old('alamat')) ? old('alamat') : $lokasi['alamat']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->showError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Koordinat</label>
                    <div id="map-container" style="height:300px" class="col-sm-4  mx-4">
                    </div>
                    <pre id="coordinates" class="coordinates"></pre>
                    <div class="col-sm-3">
                        <label for="" class="col-form-label d-block">Latitude :</label>
                        <input value="<?= (old('lat')) ? old('lat') : $lokasi['lat']; ?>" id="latitude" type="text" class="form-control <?= ($validation->hasError('lat')) ? 'is-invalid' : ''; ?>" name="lat" readonly>
                        <div class="invalid-feedback">
                            <?= $validation->showError('lat'); ?>
                        </div>
                        <label for="" class="col-form-label d-block">Longitude :</label>
                        <input value="<?= (old('long')) ? old('long') : $lokasi['long']; ?>" id="longitude" type="text" class="form-control <?= ($validation->hasError('long')) ? 'is-invalid' : ''; ?>" name="long" readonly>
                        <div class="invalid-feedback">
                            <?= $validation->showError('long'); ?>
                        </div>
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