$(document).ready(function () {
    console.log("ready!");
    getDateUser()
});
var ctx = document.getElementById("myUserChart");
var myUserChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Jumlah user',
            data: [],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            // tension: 0.1
        },]
    },
    options: {
        scales: {
            x: {
                beginAtZero: true
            },
        },
        // autoPadding: true
    },
}
);
function getDateUser() {
    $.ajax({
            type: "get",
            dataType: "json",
            url: "/AjaxUser/userdate",
            success: function(data) {
                // console.log(data);
                const arr = data;

                function foo(array) {
                    let a = [],
                        b = [],
                        arr = [...array], // clone array so we don't change the original when using .sort()
                        prev;

                    // arr.sort();
                    for (let element of arr) {
                        if (element !== prev) {
                            a.push(element);
                            b.push(1);
                        } else ++b[b.length - 1];
                        prev = element;
                    }

                    return [a, b];
                }

                const result = foo(arr);
                console.log('[' + result[0] + ']', '[' + result[1] + ']')
                myUserChart.data.datasets[0].data = result[1]
                myUserChart.data.labels = result[0]
                    // myChart.data.labels = data
                    // Update chart
                    // myUserChart.update();
            }
        })
        // console.log(arr)
}





// $(document).on('click', '#btn-add', function(e) {
//     var data = $("#time").serialize();
//     console.log(data);
// });