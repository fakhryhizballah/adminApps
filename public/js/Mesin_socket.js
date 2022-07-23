// const socket = io("http://localhost:3000");
// const socket = io("https://socket.spairum.my.id:3000", {
//     withCredentials: true,
//     extraHeaders: {
//         "my-custom-header": "abcd"
//     }
// });

const url = document.getElementById("socket");
const socket = io(url.value, {
    // withCredentials: true,
    withCredentials: false,
    extraHeaders: {
        "my-custom-header": "abcd"
    }
});

socket.on("connect", () => {
    console.log(socket.id); // x8WIv7-mJelg7on_ALbx
    // socket.emit("hello", "world");
});
// client-side


socket.on("mesin/status", (data) => {
    // console.log(data);
    // var vaule = data.Sinyal
    var obj = JSON.parse(data)
    // console.log("data", obj.Sinyal);
    var idstaus = ("data", obj.clientid);
    // console.log(obj.RSSI);
    // console.log(idstaus);
    document.getElementById("isi" + idstaus).innerText = obj.vaule;
    document.getElementById(idstaus).innerText = obj.RSSI;
});

socket.on("mesin/status/offline", (data) => {
    console.log(data);
    document.getElementById(data).innerText = 'Recently Offline';
});

setInterval(intervalFunc, 5000);

function intervalFunc() {
    console.log('Refresh');
    $.ajax({
        type: "POST",
        data: {
            topic: "mesin/status/ping",
            // payload: data
        },
        dataType: "json",
        url: "/ControlS/postmqtt",
    })

}