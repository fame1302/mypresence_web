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
      <form method="post" action="<?= base_url(); ?>/admin/tambah_karyawan" enctype="multipart/form-data">
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

          <label for="" class="col-sm-2 col-form-label">Nama Lengkap</label>
          <div class="col-sm-5">
            <input value="<?= old('nama'); ?>" name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>">
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
                <input type="radio" name="jk" value="l" checked="checked">
                Laki - laki
              </label>
              <label class="col-sm-5">
                <input type="radio" name="jk" value="p">
                Perempuan
              </label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-5">
            <textarea name="alamat" cols="30" rows="3" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>"><?= old('alamat'); ?></textarea>
            <div class="invalid-feedback">
              <?= $validation->showError('alamat'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="level" class="col-sm-2 col-form-label">Jabatan</label>
          <div class="col-sm-3">
            <select name="jabatan" class="form-control ">
              <?php foreach ($list_jabatan as $jabatan) : ?>
                <option value="<?= $jabatan['id']; ?>" <?= (old('jabatan') == $jabatan['id']) ? 'selected' : ''; ?>><?= $jabatan['nama_jabatan']; ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="level" class="col-sm-2 col-form-label">Foto</label>
          <div class="col-sm-5">
            <img id="preview-foto" src="<?= base_url(); ?>/img/user_profile/test.jpg" style="display:none" class="img-thumbnail col-sm-5 mb-3" alt="">
            <div class="custom-file">
              <input onchange="imgPreview()" type="file" name="foto" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="input-foto">
              <div class="invalid-feedback">
                <?= $validation->showError('foto'); ?>
              </div>
              <label id="label-foto" class="custom-file-label " for="customFile">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-5">
            <input value="<?= old('username'); ?>" name="username" type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
              <?= $validation->showError('username'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-5">
            <input value="<?= old('email'); ?>" name="email" type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
              <?= $validation->showError('email'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-5">
            <input name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?> " id="inputPassword">
            <div class="invalid-feedback">
              <?= $validation->showError('password'); ?>
            </div>
            <span class="fa fa-eye pass-eye" id="pass-eye"></span>
            <input type="checkbox" class="pass-eye check" name="pass-check">
          </div>
        </div>
        <div class="form-group row">
          <label for="konfirmasi" class="col-sm-2 col-form-label ">Confirm Password</label>
          <div class="col-sm-5">
            <input name="konfirmasi" type="password" class="form-control  <?= ($validation->hasError('konfirmasi')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
              <?= $validation->showError('konfirmasi'); ?>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="level" class="col-sm-2 col-form-label">Level</label>
          <div class="col-sm-3">
            <select name="level" class="form-control ">
              <option value="0">User</option>
              <option value="1">Admin</option>
            </select>
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