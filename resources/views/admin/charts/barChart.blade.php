<!DOCTYPE html>
<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');

    * {
      font-family: 'Poppins', sans-serif;
    }

  </style>
</head>

<body>
  <!--Div that will hold the pie chart-->
  <form>
    @csrf
    <div id="chart"></div>
  </form>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(function() {
      $.ajax({
        url: '/chartApproveStatus',
        type: 'POST',
        dataType: 'JSON',
        success: function(response) {
          const data = response.data;
          const error = response.data.length;
          const graph = document.getElementById('chart');
          if (error === 0) {
            graph.style.display = 'none';
          } else {
            graph.style.display = 'block';
            var options = {
              series: data,
              chart: {
                width: '100%',
                type: 'pie',
                toolbar: {
                  show: true
                }
              },
              labels: ['New', 'Approved', 'Rejected'],
              legend: {
                position: 'bottom'
              },
              responsive: [{
                breakpoint: 480,
                options: {
                  chart: {
                    width: '100%'
                  }
                }
              }]
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
          }
        }
      })
    });
  </script>
</body>

</html>
