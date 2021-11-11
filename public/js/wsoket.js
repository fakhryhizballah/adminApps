// const ws = new WebSocket("wss://socket.spairum.my.id:3001");
const ws = new WebSocket("wss://10.8.0.3:3001");
ws.addEventListener("open", function open() {
    console.log("Terhubung");
    // console.log("nama anda <?= $akun['nama']; ?>");
    ws.send("Admin Terhubung");
    keepAlive();
});
console.log("ready!");

ws.addEventListener('message', function incoming(data) {
    console.log(data);
    var vaule = data.data
    var obj = JSON.parse(vaule)
        // console.log("data", obj.Sinyal);
    var idstaus = ("data", obj.Sinyal);
    console.log(obj.RSSI);
    console.log(idstaus);
    document.getElementById(idstaus).innerText = obj.RSSI;

});
var timerID = 0;

function keepAlive() {
    var timeout = 20000;
    if (ws.readyState == ws.OPEN) {
        ws.send('');
    }
    timerId = setTimeout(keepAlive, timeout);
}

function cancelKeepAlive() {
    if (timerId) {
        clearTimeout(timerId);
    }
}
ws.onclose = function(event) {
    if (event.wasClean) {
        console.log('Connection closed');
        // document.body.innerHTML += "<p>Connection closed</p>";
    } else {
        console.log('Connection failure');
        // document.body.innerHTML += "<p>Connection failure</p>";
    }
    console.log('Code: ' + event.code + ' Reason: ' + event.reason);
    // document.body.innerHTML += "<p>Code: " + event.code + " Reason: " + event.reason + "</p>";
    cancelKeepAlive();
};
ws.onerror = function(error) {
    console.log("Error: " + error.message);
    // document.body.innerHTML += "<p>Error: " + event.message + "</p>";
    cancelKeepAlive();
};