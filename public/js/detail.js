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
      //   let link = "";
      //   foto.forEach(getFoto);

      // function getFoto(item, index) {
      //     link += item['foto'];
      //     document.getElementById("tes").innerHTML = "<img class='d-block w-100' src='item['foto']' alt='First slide'></img>";
      // }

      //   const getimg = document.querySelectorAll(".foto");

      //   var tesElement = document.getElementById("tes");
      var fotoElement = document.getElementById("foto");

      //   function createImageNode(item, index) {
      //     var img = document.createElement("img");
      //     img.src = item["foto"];
      //     return img;
      //   }

      function createDivNode(item, index) {
        var div = document.createElement("div");
        div.className = "carousel-item";
        div.innerHTML =
          "<img class='d-block w-100' src='" + item["foto"] + "'>";
        return div;
      }

      foto.forEach((div) => {
        fotoElement.appendChild(createDivNode(div));
        // fotoElement.appendChild(createImageNode(img));
      });

      console.log(fotoElement);

      //   foto.forEach((img) => {
      //     fotoElement.appendChild(createImageNode(img));
      //   });

      //   document.getElementById("foto").innerHTML = link;
      document.getElementById("nama").innerHTML = lokasi.nama;
      document.getElementById("jenis").innerHTML = lokasi.jenis;
      document.getElementById("geo").innerHTML = lokasi.geo;
      document.getElementById("gmaps").innerHTML = lokasi.gmaps;
      document.getElementById("keterangan").innerHTML = lokasi.keterangan;

      $("#detailModal").modal("show");
    },
  });
}
