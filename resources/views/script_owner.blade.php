

<script>
        
var ctx = document.getElementById({!! json_encode($ids)!!}).getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: {!!json_encode( $hari) !!},
    datasets: [{
      label: {!! json_encode($label)!!},
      data: {!! json_encode($data) !!},
      borderWidth: 2,
      backgroundColor: 'rgba(63,82,227,.8)',
      borderWidth: 0,
      borderColor: 'transparent',
      pointBorderWidth: 0,
      pointRadius: 3.5,
      pointBackgroundColor: 'transparent',
      pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: {!! json_encode($min)!!},
          callback: function(value, index, values) {
            return 'Rp. ' + value;
          }
        }
      }],
      xAxes: [{
        gridLines: {
          display: false,
          tickMarkLength: 15,
        }
      }]
    },
  }
});
    </script>