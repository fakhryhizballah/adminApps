<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-striped bg-white" id="tabel" style="width: 100%;">
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
                <th scope="col">Log Refill</th>
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
                    <td onclick="cekStatus('<?= $st['id_mesin']; ?>')" id="<?= $st['id_mesin']; ?>">Offline</td>
                    <!-- <td><?= $st['status']; ?></td> -->
                    <td id="isi<?= $st['id_mesin']; ?>"><?= $st['isi']; ?></td>
                    <!-- <td><?= $st['indikator']; ?></td> -->
                    <td><?= $st['ket']; ?></td>
                    <td> <button type="button" class="btn btn-success btn-circle" onclick="cek('<?= $st['id_mesin']; ?>')"><i class="fas fa-history" aria-hidden="true"></i></button></td>
                    <td> <button type="button" class="btn btn-info btn-circle" onclick="refill('<?= $st['id_mesin']; ?>')"><i class="fas fa-tint" aria-hidden="true"></i></button></td>
                    <td> <button type="button" class="btn btn-danger btn-circle" onclick="pos('<?= $st['id_mesin']; ?>')"><i class="fas fa-recycle"></i></button></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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

<!-- Modal Refill -->
<div class="modal fade" id="modal-refill" tabindex="-1" role="dialog" aria-labelledby="refillModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refillModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
                    <form class="user" id="refill_form" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="tgl" class="form-label">Tanggal Refill</label>
                                    <input type="datetime-local" name="tgl" id="tgl" class="form-control form-control-user" placeholder="Tanggal Refill" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control form-control-user" placeholder="Harga" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="merek" class="form-label">Merek</label>
                                    <input type="text" name="merek" id="merek" class="form-control form-control-user" placeholder="Merek" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="volume" class="form-label">Volume(mL)</label>
                                    <input type="number" name="volume" id="volume" class="form-control form-control-user" placeholder="Volume" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="terpakai" class="form-label">Terpakai(mL)</label>
                            <input type="text" name="terpakai" id="terpakai" class="form-control form-control-user" placeholder="Terpakai">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-user btn-block uploadBtn">Tambah</button>
                        </div>
                    </form>
                </div>
                <br>
                <ul class="list-group">
                    <li class="list-group-item">
                        <p id="log-refill"></p>
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

<input type="hidden" id="socket" value="<?= $socket; ?>">

<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>

<?= $this->section('script'); ?>
<script async src="/js/Mesin_socket.js"></script>
<!-- <script async src="/js/wsoket.js"></script> -->
<script async src="/js/logStasiun.js"></script>


<?= $this->endSection('script'); ?>