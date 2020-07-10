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
            <h6 class="m-0 font-weight-bold text-primary d-inline"><?= $page_data['sub_title']; ?></h6>
            <h6 class="d-inline"> / Tambah Detail</h6>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url(); ?>/admin/tambah_karyawan">
                <?= csrf_field() ?>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-5">
                        <input value="<?= old('nama'); ?>" name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="">
                        <div class="invalid-feedback">
                            <?= $validation->showError('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-5 mt-2">
                        <div class="radio">
                            <label class="col-sm-5">
                                <input type="radio" name="jk" id="inputjk" value="l" checked="checked">
                                Laki - laki
                            </label>
                            <label class="col-sm-5">
                                <input type="radio" name="jk" id="inputjk" value="p">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                        <textarea value="<?= old('alamat'); ?>" name="alamat" id="" cols="30" rows="3" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->showError('alamat'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="level" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-3">
                        <select name="jabatan" id="" class="form-control ">
                            <?php foreach ($list_jabatan as $jabatan) : ?>
                                <option value="<?= $jabatan['id']; ?>"><?= $jabatan['nama_jabatan']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="level" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputFotoUser" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label input-foto-user-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <input type="submit" class="btn btn-primary" value="Tambah User">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>