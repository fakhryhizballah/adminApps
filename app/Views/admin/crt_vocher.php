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
                            <h1 class="h4 text-gray-900 mb-4">Buat Vocher</h1>
                        </div>
                        <form class="user" method="POST" action="Admin/addvocher">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user  <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id=" nominal" name="nominal" placeholder="Nominal mL" autofocus value="<?= old('nominal'); ?>">
                                <div class="invalid-feedback"></div>
                                <div><?= $validation->getError('nominal'); ?></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Buat Kode Vocer
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