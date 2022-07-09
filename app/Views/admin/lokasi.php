<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white" id="tabel">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Action</th>
                <th scope="col">Nama</th>
                <!-- <th scope="col">Status</th> -->
                <!-- <th scope="col">Indikator</th> -->
                <th scope="col">Keterangan</th>

            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($lokasi as $lk) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                        <a class="btn btn-secondary btn-sm btn-circle" onclick="detail('<?= $lk['id_lokasi']; ?>')">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <!-- <a href="/admlokasi/edit" class="btn btn-warning">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a> -->
                    </td>
                    <td><?= $lk['nama']; ?></td>
                    <td><?= $lk['keterangan']; ?></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <!-- <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
                    </ol>
                    <div class="carousel-inner" id="foto">
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="container">
                    <form class="user" method="POST" action="admin/editlokasi">
                        <?= csrf_field(); ?>
                        <br>
                        <div class="form-group" hidden>
                            <label for="id_lokasi">ID Lokasi</label>
                            <input readonly type="text" class="form-control form-control-user  <?= ($validation->hasError('id_lokasi')) ? 'is-invalid' : ''; ?>" id="id_lokasi" name="id_lokasi" autofocus>
                            <div class="invalid-feedback"></div>
                            <div><?= $validation->getError('id_lokasi'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lokasi</label>
                            <input required type="text" class="form-control form-control-user  <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus>
                            <div class="invalid-feedback"></div>
                            <div><?= $validation->getError('nama'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <input required type="text" class="form-control form-control-user  <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" id="jenis" name="jenis" autofocus>
                            <div class="invalid-feedback"></div>
                            <div><?= $validation->getError('jenis'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="geo">Geo</label>
                            <input required type="text" class="form-control form-control-user  <?= ($validation->hasError('geo')) ? 'is-invalid' : ''; ?>" id="geo" name="geo" autofocus>
                            <div class="invalid-feedback"></div>
                            <div><?= $validation->getError('geo'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="gmaps">Link Maps</label>
                            <input required type="text" class="form-control form-control-user  <?= ($validation->hasError('gmaps')) ? 'is-invalid' : ''; ?>" id="gmaps" name="gmaps" autofocus>
                            <div class="invalid-feedback"></div>
                            <div><?= $validation->getError('gmaps'); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input required type="text" class="form-control form-control-user  <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" id="keterangan" name="keterangan" autofocus>
                            <div class="invalid-feedback"></div>
                            <div><?= $validation->getError('keterangan'); ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Update Data
                        </button>
                    </form>
                    <!-- <table class="table table-no-bordered no-margin">
                        <tbody>
                            <tr>
                                <th>Nama Lokasi</th>
                                <td><input type="text" class="form-control form-control-user" id="nama"></td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td><input type="text" class="form-control form-control-user" id="jenis"></span></td>
                            </tr>
                            <tr>
                                <th>Geo</th>
                                <td><span id="geo"></span></td>
                            </tr>
                            <tr>
                                <th>Link Maps</th>
                                <td><span id="gmaps"></span></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><span id="keterangan"></span></td>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
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
<script async src="/js/detail.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#detail', function() {
            var id_lokasi = $(this).data('id');
            var nama = $(this).data('nama');
            var jenis = $(this).data('jenis');
            var geo = $(this).data('geo');
            var gmaps = $(this).data('gmaps');
            var keterangan = $(this).data('keterangan');
            $('#id_lokasi').text(id_lokasi);
            $('#nama').text(nama);
            $('#jenis').text(jenis);
            $('#geo').text(geo);
            $('#gmaps').text(gmaps);
            $('#keterangan').text(keterangan);
        })
    })
</script>

<?= $this->endSection('script'); ?>