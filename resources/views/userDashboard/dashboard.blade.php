@extends('userDashboard.maindashboard')

@section('content')

<style>
 .popular{
    position: absolute;
    top: 30px;
    left: 50%;
    font-size: 13px;
    font-weight: 700;
    transform: translateX(-50%);
 }
 #curve_chart rect,#donut_single rect {
    fill: transparent!important;
}
.sale1
{
  position: relative;
}
.sale1 h3 {
    position: absolute;
    font-size: 11px!important;
    top: 1px;
    left: 40px;
} 
#donut_single text:nth-child(2)
{
  display: none!important;
}
.amount_total {
    font-size: 13px!important;
    position: absolute;
    top: 81px;
    left: 50%;
    transform: translateX(-50%);
    background: #f1f3f4;
}  
.donut_single svg g:nth-child(3)
{
  display: none!important;
}
#curve_chart #google-visualization-errors-0 span,#chart_div #google-visualization-errors-all-3 span
{
  display: none!important
}.sale1 h5 {
    position: absolute!important;
    top: 50%!important;
    transform: translate(-50%,-50%)!important;
    left: 50%!important;
    color: #000!important;
    font-size: 12px!important;
    font-weight: 600!important;
}
#chart_div svg rect[x="0"]
{
  fill:transparent!important;
}


#donut_single div[dir="ltr"]
{
  width:100%!important;
}
#donut_single svg
{
  display: block!important;
  margin:auto!important;
}
/ end  /
</style>


      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <div class="row">
                <div class="col-md-12 sales sale1">
                  {{-- <p>Total Purchase</p> --}}
                  @if(count($order)==false)
                  <h3>Total purchase </h3>
                  <h5>No data</h5>
                  @else
                 
                    
                      <h3>Total purchase : {{count($order)}}</h3>
                    
                    @endif
                  
                  <div id="curve_chart"style="width:100%"></div>
                </div>
                  {{-- <div class="col-md-6 compare">
                    <p>Compared to March 2022</p>
                    <p class="progress">28.8% <span><img src="./dist/img/admin/march-arrow.png"
                          class="img-fluid"></span></p>
                  </div> --}}
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <div class="row">
                <div class="col-md-12 sales position-relative">
                  {{-- <p>Total Cost</p> --}}
                 <span style="visibility:hidden"class="position-absolute top-0">{{$items=0}} </span>   
                  <div id="donut_single"style="width:100% ; height: 200px;"></div>
                                
                   @foreach($order as $item)
                       <span style="visibility: hidden"class="position-absolute top-0"> {{$items+=$item->amount}}</span>
                  @endforeach
                  @if($items === 0)
                  <h3 class="amount_total">No data</h3>
                  @else
                  <h3 class="amount_total">{{$items}}</h3>
                  @endif
                </div>
                {{-- <div class="col-md-6 compare">
                  <p>Compared to March 2022</p>
                  <p class="progress">28.8% <span><img src="./dist/img/admin/order-value-arrow.png"
                        class="img-fluid"></span></p>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <div class="row">
                <div class="col-md-12 sales sale1">
                  {{-- <p>Total delivery</p> --}}

                  
                  @if($perday_trim=="")
                  
                    <h3>Orders per day</h3>
                    <h5>No data</h5>
                  
                  @endif
                  <div id="chart_div" style="width: 100%;"></div>
                </div>
                <div class="col-md-6 compare">
                  {{-- <p>Compared to March 2022</p>
                  <p class="progress">27.2%<span><img src="./dist/img/admin/march-arrow.png"
                        class="img-fluid"></span></p> --}}
                </div>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"style="background-color:#f2f2f2">
              <h3 class="card-title total-users">
                Latest Orders
              </h3>
          </div>
          <div class="card-body">
            <table style="width:100%;text-align:center"class="position-relative table table-striped">
             <tr>
              <th>#</th>
              <th style="width:24%">Category</th>
              <th>Amount</th>
              <th>Transaction Date</th>
              <th>Order Date</th>
              
              <th>Payment Status</th>
              <th>Payment Mode</th>
             </tr>
             <span class="position:absolute;top:0"style="visibility:hidden">{{$num=1}}</span>
             <span class="position:absolute;top:0"style="visibility:hidden">{{$categories_relation=""}}</span>
             @foreach ($order as $value)
             @foreach ($value->orderItems as $main )
             <span  class="position:absolute;top:0"style="visibility:hidden">{{$categories_relation.=$main->category_name.','}}</span>
             @endforeach
               <tr>
                 <td>{{$num}}</td>
                 <td>{{rtrim($categories_relation,",")}}</td>
                 <td> {{$value->amount}}</td>
                 <td> {{ \Carbon\Carbon::parse($value->transaction_date)->format('d F Y')}} </td>
                 <td> {{ \Carbon\Carbon::parse($value->created_at)->format('d F Y')}}</td>
                 <td> {{$value->payment_status}}</td>
                 <td> {{$value->payment_node}}</td>
                 <span class="position:absolute;top:0"style="visibility:hidden"> {{$num++}}</span>
                </tr>
                @endforeach
        

            </table>
          </div>
        </div>
        <!-- Left col -->
        {{-- {{-- {{-- <section class="col-lg-7 connectedSortable"> 
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title total-users">
                Total Users
              </h3>
              <h3 class="card-title total-project">
                Total Projects
              </h3>
              <h3 class="card-title status">
                Operating Status
              </h3>
              <h3 class="card-title status">
                <span> | </span>
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="tab">
                      Current Week
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="tab">Previous week</a>
                  </li>
                  <li>
                    <a class="nav-link" href="" data-toggle="tab">
                      <img src="./dist/img/admin/DotsThree.png" class="img-fluid" alt="no-image">
                    </a>
                  </li>
                </ul>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- DIRECT CHAT -->
          <div class="card direct-chat">
            <div class="card-header">
              <h3 class="card-title">Overall Sale</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Conversations are loaded here -->
              <div class="card-content">
                <div class="row">
                  <div class="col-md-12">
                    <div id="chartsaleContainer" style="height: 370px; width: 100%;"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!--/.direct-chat -->
          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map card -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">
                Traffic by Location
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="viz-portfolio-total-value"></div>
                </div>
              </div>
            </div>
            <!-- /.card-body-->
          </div>
          <!-- /.card -->
          <!-- solid sales graph -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">
                Product Categories
              </h3>
            </div>
            <div class="card-body">
              <div class="product-listing">
                <ul>
                  <li>
                    <div>Rectangle pipe</div>
                    <div>21.3%</div>
                  </li>
                  <li>
                    <div>Steel flat bar</div>
                    <div>17.8%</div>
                  </li>
                  <li>
                    <div>Steel round bar</div>
                    <div>11.6%</div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- Calendar -->
        <!-- right col --> --}}

        </div>

      </div>
      <div class="row">
        <div class="col-lg-6"style="overflow:hidden">
          
          <div class="regions_data"style="position:relative">

            <div id="regions_div" style="width:100%; height: 500px"></div>
              <span class="popular">Popularity in country</span> 
          
          </div>
        </div>
        <div class="col-lg-6">
          <div id="piechart" style="width: 100%; height: 500px;"></div>
        </div>
        <div class="col-lg-6">
          <div id="chart10" style="width:100%"></div>
        </div>
      </div>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
  
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
          
            // ['Work',     1],
            // ['Eat',      2],
            // ['Commute',  2],
            // ['Watch TV', 2],
            // ['Sleep',    7],
            <?php echo $chartrim ?>
          ]);
  
          var options = {
            title: 'Total amount of per month order',
            is3D: true,
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
          chart.draw(data, options);
        }


        google.charts.load('current', {
        'packages':['geochart'],
        });
        google.charts.setOnLoadCallback(drawRegionsMap);
  
         function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
          ['india', 1000],
      
        ]);

        var options = {
          title:"Our popularity in country",
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
        }
       
      </script>


      <script type="text/javascript">
      
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['month', 'Purchase'],
          <?php echo $order_trim ?>

        ]);

        var options = {
         
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }






        </script>


        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);

      function drawCharts() {

        var data = google.visualization.arrayToDataTable([
          ['Effort', 'Amount given'],
          <?php echo $total_amount ?>
        ]);

        var options = {
          title:'Total amount',
          pieHole: 0.8,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
        chart.draw(data, options);
      }
          
          </script>




            <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Date', 'Amount'],
            <?php echo $perday_trim ?>
          ]);

            var numberFormatter = new google.visualization.NumberFormat({
        pattern: 'Amount(#) ,##' // Format amount as two decimal places
      });

      numberFormatter.format(data, 1);

            var options = {
              title: 'Per day order',
              hAxis: {title: 'Date', },
              vAxis: {title: 'Amount'},
              legend: 'none',
              tooltip: { isHtml: true }
              
            }

          var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

          chart.draw(data, options);
        }
      </script>
            

  

@endsection