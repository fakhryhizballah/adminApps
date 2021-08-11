const ws = new WebSocket("ws://apptes.spairum.my.id:3003");
// const ws = new WebSocket("ws://10.8.0.7:3003");
ws.addEventListener("open", function open() {
    console.log("Terhubung");
    console.log("nama anda <?= $akun['nama']; ?>");
});
console.log("ready!");

ws.addEventListener('message', function incoming(data) {
    console.log(data);
    var vaule = data.data
    var obj = JSON.parse(vaule)
        //     // document.getElementById("data").innerText = vaule
        // if (obj.user == "<?= $akun['id_user']; ?>") {
        //     if (obj.Status == "Megisi") {
        //         document.getElementById("data").innerText = " Mulai megisi"
        //         document.getElementById("btn_isi").disabled = true;
        //     } else if (obj.Status == "Selesai") {
        //         document.getElementById("data").innerText = " Selesai"
        //         window.location.href = "https://app.spairum.my.id";
        //     } else {
        //         document.getElementById("data").innerText = obj.Status * 10 + "  mL"
        //     }
        // }

});