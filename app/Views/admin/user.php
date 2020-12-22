<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white display" id="example">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">ID User</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Debit</th>
                <th scope="col">Kredit</th>
                <th scope="col">Update at</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($user as $u) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $u['id_user']; ?></td>
                    <td><?= $u['nama']; ?></td>
                    <td><?= $u['email']; ?></td>
                    <td><?= $u['debit']; ?></td>
                    <td><?= $u['kredit']; ?></td>
                    <td><?= $u['updated_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>