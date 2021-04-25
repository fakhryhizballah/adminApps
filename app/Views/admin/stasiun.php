<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white  " id="example">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">ID Mesin</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Lat</th>
                <th scope="col">Lng</th>
                <th scope="col">Status</th>
                <th scope="col">Isi</th>
                <th scope="col">Indikator</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Buka stasiun</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($stasiun as $st) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $st['id_mesin']; ?></td>
                    <td><?= $st['lokasi']; ?></td>
                    <td><?= $st['lat']; ?></td>
                    <td><?= $st['lng']; ?></td>
                    <td><?= $st['status']; ?></td>
                    <td><?= $st['isi']; ?></td>
                    <td><?= $st['indikator']; ?></td>
                    <td><?= $st['ket']; ?></td>
                    <td> <button type="button" class="btn btn-info btn-circle" onclick="pos('<?= $st['id_mesin']; ?>')"><i class="fas fa-recycle"></i></button></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<script>
    function pos(id) {
        $.ajax({
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            // url: "<?php echo site_url('/Controls/OpenDor'); ?>",
            url: "/ControlS/OpenDor",

        })

        let timerInterval
        Swal.fire({
            title: 'Pintu telah terbuka',
            html: 'Pintu akan tetutup otomatis dalam <b></b> milliseconds.',
            timer: 6000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                            b.textContent = Swal.getTimerLeft()
                        }
                    }
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('Pintu Telah terkunci')
            }
        })
        // alert(id);
    }
</script>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>