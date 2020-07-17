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
            <div class="row mx-0">
                <div class="row col-sm-6">
                    <form action="/admin/jadwal" method="get" class="row col-sm-12 d-inline">
                        <select name="bl" id="" class="form-control col-sm-4 d-inline mr-1">
                            <?php foreach ($bulan as $key) : ?>
                                <option value="<?= $key->getMonth(); ?>" <?= ($key->getMonth() == $now->getMonth()) ? 'selected' : ''; ?>><?= $key->toLocalizedString('MMMM') ?></option>
                            <?php endforeach ?>
                        </select>
                        <select name="th" class="form-control col-sm-4 d-inline mr-1">
                            <option value="2020">2020</option>
                        </select>
                        <button type="submit" class="btn btn-info col-sm-3 d-inline mr-1">Submit</button>
                    </form>
                </div>
                <!-- <form action="/admin/generate_jadwal" method="post" class="d-inline">
                    <button type="submit" class="btn btn-primary col-sm-3 d-inline">Generate Default</button>
                </form> -->
            </div>
            <div class="row mt-3">
                <div class="col-sm-8">

                    <div class="calendar-header">
                        <div class="item">
                            <h5>Minggu</h5>
                        </div>
                        <div class="item">
                            <h5>Senin</h5>

                        </div>
                        <div class="item">
                            <h5>Selasa</h5>

                        </div>
                        <div class="item">
                            <h5>Rabu</h5>

                        </div>
                        <div class="item">
                            <h5>Kamis</h5>

                        </div>
                        <div class="item">
                            <h5>Jum'at</h5>

                        </div>
                        <div class="item">
                            <h5>Sabtu</h5>

                        </div>
                    </div>
                    <div class="calendar-date">
                        <?php for ($i = 0; $i < $tgl[0]['index'] - 1; $i++) { ?>
                            <div class="item-e"></div>
                        <?php } ?>
                        <?php foreach ($tgl as $key) : ?>
                            <div id="tgl" onclick="seeDetail(this)" class="item-tgl item <?= ($key['index'] == 7 || $key['index'] == 1) ? 'alert-danger' : ''; ?>">
                                <?php setlocale(LC_ALL, 'id-ID', 'id_ID'); ?>
                                <input type="hidden" name="date" value="<?= strftime("%A, %d %B %Y", strtotime($key['date'])); ?>">
                                <input type="hidden" name="jam_masuk" value="<?= $key['jadwal']['jam_masuk']; ?>">
                                <input type="hidden" name="jam_pulang" value="<?= $key['jadwal']['jam_pulang']; ?>">
                                <input type="hidden" name="lokasi" value="<?= $key['jadwal']['lokasi']; ?>">
                                <span class="ml-2">
                                    <?= $key['tanggal']; ?>
                                </span>
                                <?php if ($key['jadwal']['jam_masuk'] != null) : ?>
                                    <span class="fa fa-calendar-check mx-2"></span>
                                <?php endif; ?>

                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" id="jadwal-detail" style="width: 18rem;display:none">
                        <div class="card-header">
                            Jadwal
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="date-detail">-</li>
                            <li class="list-group-item" id="jam-container">
                                <span class="detail-label">Jam Masuk :</span>
                                <h5 id="jam-masuk">-</h5>
                                <span class="detail-label">Jam Pulang :</span>
                                <h5 id="jam-pulang">-</h5>
                            </li>
                            <li class="list-group-item lok" id="lokasi-container">
                                <span class="detail-label">Lokasi :</span>
                                <h5 id="lokasi">-</h5>

                            </li>
                            <li id="jadwal-alert" class="list-group-item alert alert-danger mb-0">
                                <span class="fa fa-calendar-times mr-1"></span>
                                <span><small>Tidak ada jadwal untuk tanggal ini.</small></span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>