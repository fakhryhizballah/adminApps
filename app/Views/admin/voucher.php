<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white display nowrap" id="voucher">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Kode Voucher</th>
                <th scope="col">Nominal</th>
                <th scope="col">Dibuat</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($vocher as $row) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $row['kvoucher']; ?></td>
                    <td><?= $row['nominal']; ?></td>
                    <td><?= $row['created_at']; ?></td>
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