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
                            <h1 class="h4 text-gray-900 mb-4">Create Stasiun</h1>
                        </div>

                        <form class="user" method="POST" action="Admin/addstasiun">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lokasi" autofocus value="<?= old('nama'); ?>">
                                <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="lat" name="lat" placeholder=" Latitude" value="<?= old('lat'); ?>">
                                <div class="invalid-feedback"><?= $validation->getError('lat'); ?></div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="lng" name="lng" placeholder="longitude" value="<?= old('lng'); ?>">
                                    <div class="invalid-feedback"><?= $validation->getError('lng'); ?></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="link" name="link" placeholder="link Maps" autofocus value="<?= old('link'); ?>">
                                    <div class="invalid-feedback"><?= $validation->getError('link'); ?></div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Create Stasiun
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