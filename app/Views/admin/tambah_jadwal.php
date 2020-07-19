<form method="post" action="<?= base_url(); ?>/admin/save_jadwal">
    <?= csrf_field() ?>
    <?php if (session()->getFlashdata('success') !== null) : ?>
        <div class="row">
            <div class="alert alert-success ml-2" role="alert">
                <span class="fa fa-check"></span>
                <?= session()->getFlashdata('success'); ?>
            </div>
        </div>
    <?php endif; ?>
    <input type="hidden" name="url" value="<?= $url; ?>">
    <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Profil Jadwal</label>
        <select name="profil" class="form-control">
            <?php foreach ($profil as $key) : ?>
                <?php if ($jadwal == null) {
                    $jrule = ($key['default'] == 1) ? 'selected' : '';
                } else {
                    $jrule = ($jadwal['id_profil'] == $key['id']) ? 'selected' : '';
                } ?>
                <option value="<?= $key['id']; ?>" <?= $jrule ?>><?= $key['nama_profil'] . " (" . substr($key['jam_masuk'], 0, 5) . "-" . substr($key['jam_pulang'], 0, 5) . ")"; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Lokasi</label>
        <select name="lokasi" class="form-control">
            <?php foreach ($lokasi as $key) : ?>
                <?php if ($jadwal == null) {
                    $lrule = ($key['default'] == 1) ? 'selected' : '';
                } else {
                    $lrule = ($jadwal['id_lokasi'] == $key['id']) ? 'selected' : '';
                } ?>
                <option value="<?= $key['id']; ?>" <?= $lrule ?>><?= $key['nama_lokasi']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group row">
        <div class="col-sm-5">
            <input type="submit" class="btn btn-primary" value="Simpan Jadwal">
        </div>
    </div>
</form>