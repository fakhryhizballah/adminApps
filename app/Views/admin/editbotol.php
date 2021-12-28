<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<form action="/updatebotol/<?= $botol["id"]; ?>" method="post">
    <?= csrf_field(); ?>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">ID Botol</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="id_botol" name="id_botol" value="<?= $botol['id_botol']; ?>" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">ID User</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $botol['id_user']; ?>" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Botol</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_botol" name="nama_botol" value="<?= $botol['nama_botol']; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Botol</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="jenis_botol" name="jenis_botol" value="<?= $botol['jenis_botol']; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Ukuran Botol</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="ukuran_botol" name="ukuran_botol" value="<?= $botol['ukuran_botol']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Ubah Data</button>
        </div>
    </div>
</form>


</body>

</html>