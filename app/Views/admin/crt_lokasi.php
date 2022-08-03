<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Tambah Lokasi</h1>
                        </div>
                        <form class="user" method="POST" action="admin/addlokasi">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user  <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Lokasi" autofocus value="<?= old('nama'); ?>">
                                <div class="invalid-feedback"></div>
                                <div><?= $validation->getError('nama'); ?></div>
                            </div>
                            <div class="form-group">
                                <select class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="jenis" name="jenis" placeholder="Jenis" value="<?= old('jenis'); ?>">
                                    <option disabled selected value="">Jenis Lokasi...</option>
                                    <option value="Tempat Sampah">Tempat Sampah</option>
                                    <option value="Bank Sampah">Bank Sampah</option>
                                </select>
                                <div class="invalid-feedback">
                                </div>
                                <div><?= $validation->getError('jenis'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user  <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="geo" name="geo" placeholder="Geo" value="<?= old('geo'); ?>">
                                <div class="invalid-feedback"></div>
                                <div><?= $validation->getError('geo'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user  <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="gmaps" name="gmaps" placeholder="Link Maps" value="<?= old('gmaps'); ?>">
                                <div class="invalid-feedback"></div>
                                <div><?= $validation->getError('gmaps'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user  <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" placeholder="Keterangan" value="<?= old('keterangan'); ?>">
                                <div class="invalid-feedback"></div>
                                <div><?= $validation->getError('keterangan'); ?></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Tambah Lokasi
                            </button>
                        </form>
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>