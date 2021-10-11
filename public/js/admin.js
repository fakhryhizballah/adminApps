$(document).ready(function() {
    $('#tabel').DataTable({
        // "scrollY": 200,
        "scrollX": true,
        "scrollY": '50vh',
        "scrollCollapse": true,
        "paging": false,
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }]
    });
    $('#stasiun').DataTable({
        "scrollY": 200,
        "scrollX": true,
    });
    $('#voucher').DataTable({
        "scrollX": true,
        "scrollY": "50vh",
        "scrollCollapse": true,
        "pageLength": 20
    });


    $('#userdata').DataTable({
        "ajax": "/AjaxUser/GetTotalUser/",
        columns: [{ data: 'id_user' },
            { data: 'nama' },
            { data: 'email' },
            { data: 'telp' },
            { data: 'debit' },
            { data: 'status' },
        ],
        "scrollX": true,
        "scrollY": "50vh",
        "scrollCollapse": true,
        "lengthMenu": [10, 30, 50, 100, 50, 50],
        "pageLength": 50
    });

    For()
});

function cekStatus(id_data) {
    console.log(id_data);
    // console.log("id_data");
    $.ajax({
        type: "post",
        data: {
            id: id_data
        },
        dataType: "json",
        // url: "<?php echo site_url('/Controls/rssi'); ?>",
        url: "/ControlS/rssi",
    })

}

function cek(id) {
    $.ajax({
        type: "post",
        data: {
            id: id
        },
        dataType: "json",
        success: function(data) {
            // console.log(data[0]['id']);
            console.log(data);
            // document.getElementById("data").innerHTML = data[0]['id'];
            let code = "";
            data.forEach(myFunction);

            document.getElementById("histori").innerHTML = code;

            function myFunction(item, index) {
                code += " Status " + item['des'] + " pada " + " : " + item['created_at'] + "<br>" + "<hr>";
            }
            $('.modal-title').text("Log " + data[0].id_mesin);
            $('#modal-log').modal('show');

        },
        url: "/ControlS/log/",
    })
}




function pos(id) {
    $.ajax({
        type: "post",
        data: {
            id: id
        },
        dataType: "json",
        // url: "<?php echo site_url('/Controls/OpenDor'); ?>",
        url: "/ControlS/OpenDor",
    })

    let timerInterval
    Swal.fire({
            title: 'Pintu telah terbuka',
            html: 'Pintu akan tetutup otomatis dalam <b></b> milliseconds.',
            timer: 6000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                            b.textContent = Swal.getTimerLeft()
                        }
                    }
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('Pintu Telah terkunci')
            }
        })
        // alert(id);
}