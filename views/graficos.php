    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ChartJS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Volumen de agua</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->

            <!-- /.card -->

            <!-- PIE CHART -->

            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Volumen de agua 02z</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->

            <!-- /.card -->

            <!-- STACKED BAR CHART -->

            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
      $(document).ready(function() {

        $.ajax({
          url: "ajax/procesos.ajax.php",
          method: "GET",
          success: function(respuesta) {
            var data = JSON.parse(respuesta);
            var periodos = [];
            var volumen = [];
            for (let index = 0; index < data.length; index++) {
              periodos.push(data[index][1]);
              volumen.push(data[index][0]);
            }
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
              labels: periodos,
              datasets: [{
                  label: 'Digital Goods',
                  backgroundColor: 'rgba(60,141,188,0.9)',
                  borderColor: 'rgba(60,141,188,0.8)',
                  pointRadius: false,
                  pointColor: '#3b8bba',
                  pointStrokeColor: 'rgba(60,141,188,1)',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: volumen
                },
                /*             {
                              label: 'Electronics',
                              backgroundColor: 'rgba(210, 214, 222, 1)',
                              borderColor: 'rgba(210, 214, 222, 1)',
                              pointRadius: false,
                              pointColor: 'rgba(210, 214, 222, 1)',
                              pointStrokeColor: '#c1c7d1',
                              pointHighlightFill: '#fff',
                              pointHighlightStroke: 'rgba(220,220,220,1)',
                              data: [65, 59, 80, 81, 56, 55, 40]
                            }, */
              ]
            }
            var areaChartOptions = {
              maintainAspectRatio: false,
              responsive: true,
              events: false,
              tooltips:{
                enabled:false
              },
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  ticks:{
                    fontColor: 'black'
                  },
                  gridLines: {
                    display: false,
                    color: 'black',
                    drawBorder:false
                  }
                }],
                yAxes: [{
                  ticks:{
                    stepSize: 1,
                    fontColor: 'black',
                  },
                  gridLines: {
                    display: true,
                    color: '#7DCEA0',
                    drawBorder: false
                  }
                }]
              },
              animation:{
                duration: 1,
                onComplete: function(){
                  var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
                  ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                  ctx.fillStyle = "black";
                  ctx.textAlign = 'center';
                  ctx.textBaseline = 'botton';

                  this.data.datasets.forEach(function (dataset, i){
                    var meta =chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function(bar, index){
                      var data = dataset.data[index];
                      ctx.fillText(data, bar._model.x, bar._model.y -5);
                    });
                  });
                } 
              }
            }

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
              type: 'line',
              data: areaChartData,
              options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
              type: 'line',
              data: lineChartData,
              options: lineChartOptions
            })
          }

        });

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        /* var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
         var donutData = {
           labels: [
             'Chrome',
             'IE',
             'FireFox',
             'Safari',
             'Opera',
             'Navigator',
           ],
           datasets: [{
             data: [700, 500, 400, 600, 300, 100],
             backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
           }]
         }
         var donutOptions = {
           maintainAspectRatio: false,
           responsive: true,
         }
         //Create pie or douhnut chart
         // You can switch between pie and douhnut using the method below.
         new Chart(donutChartCanvas, {
           type: 'doughnut',
           data: donutData,
           options: donutOptions
         })

         //-------------
         //- PIE CHART -
         //-------------
         // Get context with jQuery - using jQuery's .get() method.
         var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
         var pieData = donutData;
         var pieOptions = {
           maintainAspectRatio: false,
           responsive: true,
         }
         //Create pie or douhnut chart
         // You can switch between pie and douhnut using the method below.
         new Chart(pieChartCanvas, {
           type: 'pie',
           data: pieData,
           options: pieOptions
         })

         //-------------
         //- BAR CHART -
         //-------------
         var barChartCanvas = $('#barChart').get(0).getContext('2d')
         var barChartData = $.extend(true, {}, areaChartData)
         var temp0 = areaChartData.datasets[0]
         var temp1 = areaChartData.datasets[1]
         barChartData.datasets[0] = temp1
         barChartData.datasets[1] = temp0

         var barChartOptions = {
           responsive: true,
           maintainAspectRatio: false,
           datasetFill: false
         }

         new Chart(barChartCanvas, {
           type: 'bar',
           data: barChartData,
           options: barChartOptions
         })

         //---------------------
         //- STACKED BAR CHART -
         //---------------------
         var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
         var stackedBarChartData = $.extend(true, {}, barChartData)

         var stackedBarChartOptions = {
           responsive: true,
           maintainAspectRatio: false,
           scales: {
             xAxes: [{
               stacked: true,
             }],
             yAxes: [{
               stacked: true
             }]
           }
         }

         new Chart(stackedBarChartCanvas, {
           type: 'bar',
           data: stackedBarChartData,
           options: stackedBarChartOptions
         })*/
      })
    </script>