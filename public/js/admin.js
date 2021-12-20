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
    select: true,
    columns: [{ data: 'id_user' },
    { data: 'nama' },
    { data: 'nama_depan' },
    { data: 'nama_belakang' },
    { data: 'email' },
    { data: 'telp' },
    { data: 'debit' },
    { data: 'status' },
    ],
    "scrollX": true,
    "scrollY": "50vh",
    "scrollCollapse": true,
    "lengthMenu": [10, 30, 50, 100, 50, 50],
    "pageLength": 50,

});
