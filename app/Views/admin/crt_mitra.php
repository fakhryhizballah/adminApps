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
                            <h1 class="h4 text-gray-900 mb-4">Create Mitra</h1>
                        </div>

                        <form class="user" method="POST" action="">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="namapt" name="namapt" placeholder="Nama PT/CV" autofocus value="<?= old('namapt'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Admin" autofocus value="<?= old('nama'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= old('email'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="telp" name="telp" placeholder="No Telp" autofocus value="<?= old('telp'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat" value="<?= old('alamat'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="geo" name="geo" placeholder="Geo Koordinat" value="<?= old('geo'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="rek" name="rek" placeholder="No Rekening" value="<?= old('rek'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Create Mitra
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