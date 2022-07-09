function detail(id) {
  $.ajax({
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    url: "/AjaxUser/detailLokasi/",
    success: function (data) {
      // console.log(data[0]['id']);
      var lokasi = data.lokasi;
      let foto = data.foto;
      console.log(foto);

      //   var tesElement = document.getElementById("tes");
      var fotoElement = document.getElementById("foto");

      function createDivNode(item, index) {
        var div = document.createElement("div");
        var img = document.createElement("img");
        console.log(index);
        index == 0
          ? (div.className = "carousel-item active")
          : (div.className = "carousel-item");
        // div.className = "carousel-item";
        div.appendChild(img);
        img.className = "d-block w-100";
        img.src = item["foto"];
        return div;
      }

      foto.forEach((div, index) => {
        fotoElement.appendChild(createDivNode(div, index));
      });

      document.getElementById("id_lokasi").value = lokasi.id_lokasi;
      document.getElementById("nama").value = lokasi.nama;
      document.getElementById("jenis").value = lokasi.jenis;
      document.getElementById("geo").value = lokasi.geo;
      document.getElementById("gmaps").value = lokasi.gmaps;
      document.getElementById("keterangan").value = lokasi.keterangan;
      $("#detailModal").modal("show");
      $("#detailModal").on("hidden.bs.modal", function () {
        console.log("close Modal");
        var element = document.getElementById("foto");
        while (element.hasChildNodes()) {
          element.removeChild(element.firstChild);
        }
        // scanner.stop();
      });
    },
  });
}
