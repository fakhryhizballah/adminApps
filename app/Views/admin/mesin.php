<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('css'); ?>

<!-- Untuk button toggle flush -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<?= $this->endSection('css'); ?>

<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white hover row-border" id="mesin">
        <thead class="thead-light">
            <tr style="text-align: center;">
                <th scope="col">id</th>
                <th scope="col">Id Mesin</th>
                <th scope="col">Nama Air</th>
                <!-- <th scope="col">Status</th> -->
                <!-- <th scope="col">Indikator</th> -->
                <th scope="col">kalibarsi</th>
                <th scope="col">harga/100Ml</th>

            </tr>
        </thead>

    </table>
</div>



<input type="hidden" id="socket" value="<?= $socket; ?>">

<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>

<?= $this->section('script'); ?>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script async src="/js/setMesin.js"></script>

<?= $this->endSection('script'); ?>