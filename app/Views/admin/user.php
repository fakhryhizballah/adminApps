<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <table id="userdata" class="display" style="width:100%">
        <thead>
            <tr>
                <th>id_user</th>
                <th>nama</th>
                <th>email</th>
                <th>telp.</th>
            </tr>
        </thead>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>