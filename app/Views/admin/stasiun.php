<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white" id="tab">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Lokasi</th>
                <th scope="col">ID Mesin</th>
                <th scope="col">RSSI</th>
                <!-- <th scope="col">Status</th> -->
                <th scope="col">Isi</th>
                <!-- <th scope="col">Indikator</th> -->
                <th scope="col">Keterangan</th>
                <th scope="col">LOG</th>
                <th scope="col">Buka stasiun</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($stasiun as $st) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><a href="<?= $st['link']; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-street-view" aria-hidden="true"></i> <?= $st['lokasi']; ?></a></td>
                    <td><?= $st['id_mesin']; ?></td>
                    <td id="<?= $st['id_mesin']; ?>">Offline</td>
                    <!-- <td><?= $st['status']; ?></td> -->
                    <td><?= $st['isi']; ?></td>
                    <!-- <td><?= $st['indikator']; ?></td> -->
                    <td><?= $st['ket']; ?></td>
                    <td> <button type="button" class="btn btn-success btn-circle" onclick="cek('<?= $st['id_mesin']; ?>')"><i class="fas fa-history" aria-hidden="true"></i></button></td>
                    <td> <button type="button" class="btn btn-danger btn-circle" onclick="pos('<?= $st['id_mesin']; ?>')"><i class="fas fa-recycle"></i></button></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- /.container-fluid -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade" id="modal-log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<script src="/js/wsoket.js"></script>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>