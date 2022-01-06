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
            <div style="display: inline-block;  text-align: center; border:2px solid black; border-radius: 5%; margin: 5px 5px 5px">
                <div style="margin: 5px 5px 5px">
                    <span id="qrcode<?= $id['id_botol']; ?>"></span>
                    <p style="display:inline-block; margin:0 auto 0; font-size:13px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                        <span>id: </span> <?= $id['id_botol']; ?>
                    </p>
                </div>
            </div>
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


</body>

</html>