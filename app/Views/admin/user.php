<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <table id="userdata" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id_user</th>
                <th>username</th>
                <th>nama depan</th>
                <th>nama belakang</th>
                <th>email</th>
                <th>telp.</th>
                <th>saldo.</th>
                <th>Status.</th>
            </tr>
        </thead>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>