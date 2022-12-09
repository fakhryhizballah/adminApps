<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('css'); ?>

<!-- Untuk button toggle flush -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<?= $this->endSection('css'); ?>

<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <input type="checkbox" checked data-toggle="toggle">
    <table class="table table-striped table-bordered" id="level">
        <thead class="thead-light">
            <tr style="text-align: center;">
                <th scope="col">id User</th>
                <th scope="col">Nama</th>
                <th scope="col">admin</th>
                <th scope="col">admstasiun</th>
                <th scope="col">admuser</th>
                <th scope="col">admlokasi</th>
                <th scope="col">admsetmesin</th>
                <th scope="col">admflush</th>
                <th scope="col">admvoucher</th>
                <th scope="col">crtvoucher</th>
                <th scope="col">crtlokasi</th>
            </tr>
        </thead>
    </table>
</div>



<input type="hidden" id="socket" value="<?= $socket; ?>">

<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>

<?= $this->section('script'); ?>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script async src="/js/setLevel.js"></script>

<?= $this->endSection('script'); ?>