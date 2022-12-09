$(document).ready(function () {
    $('#level').DataTable({
        ajax: {
            url: './Ajaxuser/userlevel',
            type: 'POST',

            // dataSrc: 'data',
        },
        columns: [
            { data: 'id_akun' },
            { data: 'nama' },
            { data: 'admin' },
            { data: 'admstasiun' },
            { data: 'admuser' },
            { data: 'admlokasi' },
            { data: 'admsetmesin' },
            { data: 'admflush' },
            { data: 'admvoucher' },
            { data: 'crtvoucher' },
            { data: 'crtlokasi' },
        ],
        columnDefs: [
            {
                targets: 2,
                render: function (data, type, row) {

                    if (row.admin == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admin(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admin(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 3,
                render: function (data, type, row) {

                    if (row.admstasiun == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admstasiun(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admstasiun(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 4,
                render: function (data, type, row) {

                    if (row.admuser == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admuser(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admuser(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 5,
                render: function (data, type, row) {

                    if (row.admlokasi == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admlokasi(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admlokasi(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 6,
                render: function (data, type, row) {

                    if (row.admsetmesin == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admsetmesin(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admsetmesin(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 7,
                render: function (data, type, row) {

                    if (row.admflush == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admflush(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admflush(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 8,
                render: function (data, type, row) {

                    if (row.admvoucher == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admvoucher(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="admvoucher(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 9,
                render: function (data, type, row) {

                    if (row.crtvoucher == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="crtvoucher(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="crtvoucher(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },
            {
                targets: 10,
                render: function (data, type, row) {

                    if (row.crtlokasi == 'true') {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="crtlokasi(' + row.id_akun + ')" type="checkbox"  checked>'
                            + '</div>');
                    } else {
                        return ('<div class="form-check form-switch">' +
                            '<input class="form-check-input" id="crtlokasi(' + row.id_akun + ')" type="checkbox" >'
                            + '</div>');
                    }
                },
            },

        ],
        scrollX: true,

    });
});
$("#level tbody").on("change", "input", function () {
    var data = tb_list.row($(this).parents("tr")).data();
    console.log(data);
    var id = $(this).attr("id");
    var cek = $(this).is(":checked");
    var status;
    if (cek == true) {
        status = 'true';
    } else {
        status = 'false';
    }
    // $.ajax({
    //     type: "POST",
    //     url: "<?= base_url('admin/update_akses') ?>",
    //     data: {
    //         id: id,
    //         status: status,
    //     },
    //     dataType: "JSON",
    //     success: function (response) {
    //         console.log(response);
    //     }
    // });
});
// function admin(id) {
//     var adm = document.getElementById(`admin${id}`);
//     if (adm.checked == true) {
//         adm.checked = false;
//         adm.value = 'false';
//     } else {
//         adm.checked = true;
//         adm.value = 'true';
//     }
//     console.log(adm.value);
// }
// function admstasiun(id)
// function admuser(id)
// function admlokasi(id)
// function admsetmesin(id)
// function admflush(id)
// function admvoucher(id)
// function crtvoucher(id)
// function crtlokasi(id)
// function update(id) {
//     var nama = document.getElementById(`nama${id}`).value;
//     var faktor = document.getElementById(`faktor${id}`).value;
//     var harga = document.getElementById(`harga${id}`).value;
//     let data = {
//         id: id,
//         nama: nama,
//         faktor: faktor,
//         harga: harga
//     }
//     console.log(data);
//     $.ajax({
//         url: '/ajaxuser/updateMesin',
//         type: 'POST',
//         data: data,
//         dataType: 'json',
//         success: function (data) {
//             console.log(data);
//             const Toast = Swal.mixin({
//                 toast: true,
//                 position: 'top-end',
//                 showConfirmButton: false,
//                 timer: 3000,
//                 timerProgressBar: true,
//                 didOpen: (toast) => {
//                     toast.addEventListener('mouseenter', Swal.stopTimer)
//                     toast.addEventListener('mouseleave', Swal.resumeTimer)
//                 }
//             })

//             Toast.fire({
//                 icon: 'success',
//                 title: data.messages
//             })
//         }
//     });
// }