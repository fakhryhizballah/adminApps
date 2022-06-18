<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white" id="tabel">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">ID Lokasi</th>
                <th scope="col">ID Stasiun</th>
                <th scope="col">Nama</th>
                <!-- <th scope="col">Status</th> -->
                <th scope="col">Jenis</th>
                <!-- <th scope="col">Indikator</th> -->
                <th scope="col">Geo</th>
                <th scope="col">Link maps</th>
                <th scope="col">Keterangan</th>

            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($lokasi as $lk) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $lk['id_lokasi']; ?></td>
                    <td><?= $lk['id_stasiun']; ?></td>
                    <td><?= $lk['nama']; ?></td>
                    <td><?= $lk['jenis']; ?></td>
                    <td><?= $lk['geo']; ?></td>
                    <td><?= $lk['gmaps']; ?></td>
                    <td><?= $lk['keterangan']; ?></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<input type="hidden" id="socket" value="<?= $socket; ?>">

<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>

<?= $this->section('script'); ?>

<script async src="/js/Mesin_socket.js"></script>
<!-- <script async src="/js/wsoket.js"></script> -->
<script async src="/js/logStasiun.js"></script>

<?= $this->endSection('script'); ?>