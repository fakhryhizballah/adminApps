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

                        <form class="user" method="POST" action="">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="id_mesin" name="id_mesin" placeholder="ID Mesin" autofocus value="<?= old('id_mesin'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lokasi" autofocus value="<?= old('nama'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="geo" name="geo" placeholder="Geo Koordinat" value="<?= old('geo'); ?>">
                                <div class="invalid-feedback"></div>
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