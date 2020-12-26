$(document).ready(function() {
    $('#example').DataTable({
        "scrollY": 200,
        "scrollX": true,
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
        scrollY: '50vh',
        scrollCollapse: true,
        "scrollX": 200,
    
    });
});

