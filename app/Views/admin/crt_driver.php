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
                            <h1 class="h4 text-gray-900 mb-4">Create Driver</h1>
                        </div>

                        <form class="user" method="POST" action="">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="id_driver" name="id_driver" placeholder="ID Driver" autofocus value="<?= old('id_driver'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" autofocus value="<?= old('nama'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= old('email'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group user-form">
                                <select class="form-control level" id="level" name="level">
                                    <option selected>Pilih PT/CV</option>
                                    <option value="1">PT</option>
                                    <option value="2">CV</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="telp" name="telp" placeholder="No Telp" autofocus value="<?= old('telp'); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="" name="" placeholder="Input Foto" value="<?= old(''); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="" name="" placeholder="Input KTP" value="<?= old(''); ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Create Driver
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