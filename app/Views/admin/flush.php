<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('css'); ?>

<!-- Untuk button toggle flush -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20px;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20px;
    }
</style>

<?= $this->endSection('css'); ?>

<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white" id="tabel" style="width:100%">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Status</th>
                <th scope="col">New ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Faktor</th>
                <th scope="col">Harga</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($flush as $fl) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios"></td>
                    <td><?= $fl['new_id']; ?></td>
                    <td><?= $fl['nama']; ?></td>
                    <td><?= $fl['faktor']; ?></td>
                    <td><?= $fl['harga']; ?></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>


<!-- Modal -->
<!-- <div class="modal fade" id="modal-log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <p id="histori"></p>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
<!-- </div>
        </div>
    </div>
</div>
<script src="/js/wsoket.js"></script> -->
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>

<?= $this->section('script'); ?>

<!-- Untuk button toggle flush -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<?= $this->endSection('script'); ?>