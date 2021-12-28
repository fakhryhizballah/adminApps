<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code Styling</title>
    <script type="text/javascript" src="/js/qrcode.js"></script>
</head>

<body>
    <div>
        <?php foreach ($botol as $id) : ?>
            <div id="qrcode<?= $id['id_botol']; ?>"></div>
            <p> <span>id: </span> <?= $id['id_botol']; ?></p>

        <?php endforeach; ?>
    </div>


    <script type="text/javascript">
        <?php foreach ($botol as $id) : ?>
            var qrcode<?= $id['id_botol']; ?> = new QRCode(document.getElementById("qrcode<?= $id['id_botol']; ?>"), {
                text: "<?= $id['id_botol']; ?>",
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        <?php endforeach; ?>
    </script>
    <?= $pager->links(); ?>


</body>

</html>