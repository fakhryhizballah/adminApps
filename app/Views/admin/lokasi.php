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
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" id="foto">
                        <!-- <div class="carousel-item active">
                        </div> -->
                        <!-- <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Third slide">
                        </div> -->
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

                <table class="table table-no-bordered no-margin">
                    <tbody>
                        <tr>
                            <th>Nama Lokasi</th>
                            <td><span id="nama"></span></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td><span id="jenis"></span></td>
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
                </table>
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