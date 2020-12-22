<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white" id="example">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">ID Akun</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Nama PT / CV</th>
                <th scope="col">No Telp</th>
                <th scope="col">Jumlah Trip</th>
                <th scope="col">Jumlah Liter</th>
                <th scope="col">Point</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($driver as $drv) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $drv['id_driver']; ?></td>
                    <td><?= $drv['nama']; ?></td>
                    <td><?= $drv['email']; ?></td>
                    <td><?= $drv['cv']; ?></td>
                    <td><?= $drv['telp']; ?></td>
                    <td><?= $drv['Trip']; ?></td>
                    <td><?= $drv['liter']; ?></td>
                    <td><?= $drv['poin']; ?></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>