function cekStatus(id_data) {
  console.log(id_data);
  // console.log("id_data");
  $.ajax({
    type: "post",
    data: {
      id: id_data,
    },
    dataType: "json",
    // url: "<?php echo site_url('/Controls/rssi'); ?>",
    url: "/ControlS/rssi",
  });
}

function cek(id) {
  $.ajax({
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (data) {
      // console.log(data[0]['id']);
      console.log(data);
      // document.getElementById("data").innerHTML = data[0]['id'];
      let code = "";
      data.forEach(myFunction);

      document.getElementById("histori").innerHTML = code;

      function myFunction(item, index) {
        code +=
          " Status " +
          item["des"] +
          " pada " +
          " : " +
          item["created_at"] +
          "<br>" +
          "<hr>";
      }
      $(".modal-title").text("Log " + data[0].id_mesin);
      $("#modal-log").modal("show");
    },
    url: "/ControlS/log/",
  });
}

function refill(id) {
  $(".modal-title").text("Refill " + id);
  $("#id").val(id)
  $("#modal-refill").modal("show");
  refilLog(id);
}
function refilLog(id) {
  $("#refill_form")[0].reset();
  $.ajax({
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (data) {
      // console.log(data[0]['id']);
      console.log(data);
      // document.getElementById("data").innerHTML = data[0]['id'];
      try {
        let code = "";
      data.forEach(myFunction);

      document.getElementById("log-refill").innerHTML = code;

      function myFunction(item, index) {
        code +=
          " Merek air : " +
          item["merek"] +
          "<br>" +
          "di refill pada " +
          item["tgl"] +
          " dengan volume " +
          item["volume"] +
        "mL " +
        "<br>" +
          item["created_at"] +
          "<br>" +
          "<hr>";
      }
      } catch (error) {
        console.log('error');
      }
    },
    url: "/ControlS/refill/",
  });

}
$("#refill_form").submit(function (e) {

  e.preventDefault();
  $.ajax({
    url: "/ControlS/refillLog",
    type: "POST",
    data: $("#refill_form").serialize(),
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.error) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong!'
        })
      } else {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Your work has been saved',
          showConfirmButton: false,
          timer: 1500
        })
        refilLog($("#id").val());
        // $("#modal-refill").modal("hide");
      }
    },
    error: function () {
      alert("Form submission failed!");
    }
  });
  $("#refill_form")[0].reset();
});
function pos(id) {
  $.ajax({
    type: "post",
    data: {
      id: id,
    },
    dataType: "json",
    // url: "<?php echo site_url('/Controls/OpenDor'); ?>",
    url: "/ControlS/OpenDor",
  });

  let timerInterval;
  Swal.fire({
    title: "Pintu telah terbuka",
    html: "Pintu akan tetutup otomatis dalam <b></b> milliseconds.",
    timer: 6000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
      timerInterval = setInterval(() => {
        const content = Swal.getContent();
        if (content) {
          const b = content.querySelector("b");
          if (b) {
            b.textContent = Swal.getTimerLeft();
          }
        }
      }, 100);
    },
    willClose: () => {
      clearInterval(timerInterval);
    },
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
      console.log("Pintu Telah terkunci");
    }
  });
  // alert(id);
}
