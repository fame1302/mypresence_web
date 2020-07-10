<?= $this->extend('layout/dashboard'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $page_data['title']; ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Karyawan</a>
  </div>
  <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?= $page_data['sub_title']; ?></h6>
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
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($karyawan as $key) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td>
                  <img class="" style="width:100px" src="/img/user_profile/<?= $key['foto']; ?>" alt="">
                </td>
                <td><?= $key['nama']; ?></td>
                <td><?= ($key['jenis_kelamin'] == 'p') ? 'Perempuan' : 'Laki - laki'; ?></td>
                <td><?= $key['alamat']; ?></td>
                <td><?= $key['jabatan']; ?></td>
                <td>
                  <a href="" class="btn btn-warning">Edit</a>
                  <form action="/admin/karyawan/<?= $key['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?')">Delete</button>
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