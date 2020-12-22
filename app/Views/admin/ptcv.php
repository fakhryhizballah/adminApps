<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Nama PT / CV</th>
                <th scope="col">Total Air Galon yang Sudah Diantar</th>
                <th scope="col">Total Air Galon yang Belum Dibayar</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <tr>
                <th scope="row">1</th>
                <td>Aqua</td>
                <td>200 Liter</td>
                <td>100 Liter</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Pasqua</td>
                <td>300 Liter</td>
                <td>200 Liter</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Club</td>
                <td>400 Liter</td>
                <td>300 Liter</td>
            </tr>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>