<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white" id="tabel">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">id_botol</th>
                <th scope="col">id_user</th>
                <th scope="col">nama_botol</th>
                <th scope="col">img</th>
                <!-- <th scope="col">Status</th> -->
                <th scope="col">jenis_botol</th>
                <!-- <th scope="col">Indikator</th> -->
                <th scope="col">ukuran_botol</th>
                <th scope="col">created_at</th>
                <th scope="col">Hapus</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($botol as $st) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $st['id_botol']; ?></td>
                    <td><?= $st['id_user']; ?></td>
                    <td><?= $st['nama_botol']; ?></td>
                    <td><?= $st['img']; ?></td>
                    <td><?= $st['jenis_botol']; ?></td>
                    <td><?= $st['ukuran_botol']; ?></td>
                    <td><?= $st['created_at']; ?></td>
                    <td>
                    <form action="/deletebotol/<?= $st['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">
                            Delete
                        </button>
                    </form>
                    </td>
                    <td>
                        <a class="nav-link" href="/editbotol/<?= $st['id']; ?>">
                            Edit
                        </a>
                    </td>
                    
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

<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>