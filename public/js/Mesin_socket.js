// const socket = io("http://localhost:3000");
const socket = io("http://socket.spairum.my.id:3000");
socket.on("connect", () => {
    console.log(socket.id); // x8WIv7-mJelg7on_ALbx
    // socket.emit("hello", "world");
});
socket.on("pesan", (arg) => {
    console.log(arg); // world
});
socket.on("Sinyal/mesin", (data) => {
    console.log(data);
    // var vaule = data.Sinyal
    var obj = JSON.parse(data)
    // console.log("data", obj.Sinyal);
    var idstaus = ("data", obj.Sinyal);
    console.log(obj.RSSI);
    console.log(idstaus);
    document.getElementById(idstaus).innerText = obj.RSSI;
});
socket.on("mersure/mesin", (data) => {
    console.log(data);
    // var vaule = data.Sinyal
    var obj = JSON.parse(data)
    var id_mesin = (obj.id_mesin);
    var id = ("isi".id_mesin);
    console.log(obj.vaule);
    console.log("isi" + id_mesin);
    document.getElementById("isi" + id_mesin).innerText = obj.vaule;
});
socket.on("Offline/mesin", (data) => {
    console.log(data);
    document.getElementById(data).innerText = 'Recently Offline';
});