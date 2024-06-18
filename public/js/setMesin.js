$('#mesin').DataTable({
    "ajax": "/AjaxUser/getconfigmesin/",
    select: true,
    columns: [
        { data: 'id' },
        { data: 'new_id' },
        { data: 'nama', },
        { data: 'faktor' },
        { data: 'harga' },
    ],
    columnDefs: [
        {
            targets: 2,
            render: function (data, type, row) {
                return '<input type="text" class="form-control" onchange="update(' + row.id + ')" id="nama' + row.id + '" value="' + data + '" > '
            }
        },
        {
            targets: 3,
            render: function (data, type, row) {
                return '<input type="text" class="form-control" onchange="update(' + row.id + ')" id="faktor' + row.id + '" value="' + data + '" > '
            }
        },
        {
            targets: 4,
            render: function (data, type, row) {
                return '<input type="text" class="form-control" onchange="update(' + row.id + ')" id="harga' + row.id + '" value="' + data + '" > '
            }
        },
    ],
    "scrollX": true,
    // "scrollY": "200px",
    // "scrollCollapse": true,
    // "scrollY": "50vh",
    // "scrollCollapse": true,
    // "lengthMenu": [10, 30, 50, 100, 50, 50],
    // "pageLength": 50,
});
function update(id) {
    var nama = document.getElementById(`nama${id}`).value;
    var faktor = document.getElementById(`faktor${id}`).value;
    var harga = document.getElementById(`harga${id}`).value;
    let data = {
        id: id,
        nama: nama,
        faktor: faktor,
        harga: harga
    }
    console.log(data);
    $.ajax({
        url: '/AjaxUser/updateMesin',
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: data.messages
            })
        }
    });
}
