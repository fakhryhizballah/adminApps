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
    <?php
    // for ($i = 0; $i < 25; $i++) {
    //     echo (rand(1000, 9999));
    //     echo "<br>";
    // }

    ?>

    <form action="/admin/addidbotol" method="post">
        <?= csrf_field(); ?>

        <input type="text" id='jumlah' name='jumlah'>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>

    </form>

    <?php foreach ($idbotol as $u) : ?>

        <?= $u['id']; ?>
        <?= $u['id_botol']; ?>
        <?= $u['created_at']; ?>

        <br>

    <?php endforeach; ?>


</body>

</html>