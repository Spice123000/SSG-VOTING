  <div class="card shadow p-3"> 
    <div class="d-flex justify-content-between">
      <h4>Bar Chart / <span class="text-muted">Votes / Department</span></h4>
      <a href="?page=chart" class="btn btn-info">Go to Chart</a>
    </div>
      <hr>
    <div id="deptBarChart"></div>
  </div>

  <script src="../js/apexchart.js"></script>

  <script>
          var options = {
            series: [{
            name: '1st year',
            data: [44, 55, 41, 67, 22, 43]
          }, {
            name: '2nd year',
            data: [79, 53, 63, 55, 56, 43]
          }, {
            name: '3rd year',
            data: [52, 53, 95, 43, 75, 83]
          }, {
            name: '4th year',
            data: [87, 64, 99, 75, 45, 42]
          }],
            chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
              show: true
            },
            zoom: {
              enabled: true
            }
          },
          responsive: [{
            breakpoint: 480,
            options: {
              legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
              }
            }
          }],
          plotOptions: {
            bar: {
              horizontal: false,
              borderRadius: 10,
              dataLabels: {
                total: {
                  enabled: true,
                  style: {
                    fontSize: '13px',
                    fontWeight: 900
                  }
                }
              }
            },
          },
          xaxis: {
            type: 'Department',
            categories: ['Education', 'Engineering', 'Computer Studies', 'Busines Administration',
              'Criminal Justice', 'Hospitality Management'
            ],
          },
          legend: {
            position: 'right',
            offsetY: 100
          },
          fill: {
            opacity: 1
          }
          };

          var chart = new ApexCharts(document.querySelector("#deptBarChart"), options);
          chart.render();
        
        
	</script>
