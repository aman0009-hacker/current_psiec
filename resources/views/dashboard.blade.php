<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/login-signup/admin_logo_img.png')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title> Dashboard</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- sctylesheet -->
  <link rel="stylesheet" href="./dist/css/index.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
  integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{asset('js/dashboard.js')}}"></script>

  <style>
   
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4">
      <!-- Brand Logo -->
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panels mt-4 mb-4 d-flex justify-content-center align-items-center">
          <div class="image">
            <img src="dist/img/admin/logo-psiec.png" class="img-fluid" alt="User Image">
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="./index.html" class="nav-link active">
                <img src="./dist/img/admin/dashboard.png" class="img-fluid nav-icon">
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <img src="./dist/img/admin/order.png" class="img-fluid nav-icon">
                <p>
                  Orders
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <img src="./dist/img/admin/plants.png" class="img-fluid nav-icon">
                <p>
                  Plants
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="./dist/img/admin/products.png" class="img-fluid nav-icon">
                <p>
                  Products
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <img src="./dist/img/admin/coal.png" class="img-fluid nav-icon">
                    <p>Coal</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <img src="./dist/img/admin/steel.png" class="img-fluid nav-icon">
                    <p>Steel</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="./dist/img/admin/orders.png" class="img-fluid nav-icon">
                <p>
                  Orders
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ChartJS</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <img src="./dist/img/admin/buyer.png" class="img-fluid nav-icon">
                <p>
                  Buyer
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>General</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <!-- <i class="nav-icon fas fa-edit"></i> -->
                <img src="./dist/img/admin/invoice.png" class="img-fluid nav-icon">
                <p>
                  Invoice
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <!-- <i class="nav-icon fas fa-table"></i> -->
                <img src="./dist/img/admin/setting.png" class="img-fluid nav-icon">
                <p>
                  Setting
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <div class="row">
                    <div class="col-md-6 sales">
                      <p>Total Sales</p>
                      <h3>₹ 52,85,984</h3>
                    </div>
                    <div class="col-md-6 compare">
                      <p>Compared to March 2022</p>
                      <p class="progress">28.8% <span><img src="./dist/img/admin/march-arrow.png"
                            class="img-fluid"></span></p>
                    </div>
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
                    <div class="col-md-6 sales">
                      <p>Order value</p>
                      <h3>₹ 2,65,864</h3>
                    </div>
                    <div class="col-md-6 compare">
                      <p>Compared to March 2022</p>
                      <p class="progress">28.8% <span><img src="./dist/img/admin/order-value-arrow.png"
                            class="img-fluid"></span></p>
                    </div>
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
                    <div class="col-md-6 sales">
                      <p>Total orders</p>
                      <h3>685</h3>
                    </div>
                    <div class="col-md-6 compare">
                      <p>Compared to March 2022</p>
                      <p class="progress">27.2%<span><img src="./dist/img/admin/march-arrow.png"
                            class="img-fluid"></span></p>
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
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
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
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer footer">
      <strong> &copy; 2023 <a href=""> Punjab Small Industries & Export Corporation </a> | </strong>
      All rights reserved.
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
	axisY :{

		suffix: "mn"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 1",
		dataPoints: [
			{ label: "Ep. 1", y: 2.22 },
			{ label: "Ep. 2", y: 2.20 },
			{ label: "Ep. 3", y: 2.44 },
			{ label: "Ep. 4", y: 2.45 },
			{ label: "Ep. 5", y: 2.58 },
			{ label: "Ep. 6", y: 2.44 },
			{ label: "Ep. 7", y: 2.40 },
			{ label: "Ep. 8", y: 2.72 },
			{ label: "Ep. 9", y: 2.66 },
			{ label: "Ep. 10", y: 3.04 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		visible: false,
		yValueFormatString: "##.00mn",
		name: "Season 2",
		dataPoints: [
			{ label: "Ep. 1", y: 3.86 },
			{ label: "Ep. 2", y: 3.76 },
			{ label: "Ep. 3", y: 3.77 },
			{ label: "Ep. 4", y: 3.65 },
			{ label: "Ep. 5", y: 3.90 },
			{ label: "Ep. 6", y: 3.88 },
			{ label: "Ep. 7", y: 3.69 },
			{ label: "Ep. 8", y: 3.86 },
			{ label: "Ep. 9", y: 3.38 },
			{ label: "Ep. 10", y: 4.20 }
		]
	},
	{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 3",
		dataPoints: [
			{ label: "Ep. 1", y: 4.37 },
			{ label: "Ep. 2", y: 4.27 },
			{ label: "Ep. 3", y: 4.72 },
			{ label: "Ep. 4", y: 4.87 },
			{ label: "Ep. 5", y: 5.35 },
			{ label: "Ep. 6", y: 5.50 },
			{ label: "Ep. 7", y: 4.84 },
			{ label: "Ep. 8", y: 4.13 },
			{ label: "Ep. 9", y: 5.22 },
			{ label: "Ep. 10", y: 5.39 }
		]
	},
	{
		type: "spline",
      	visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 4",
		dataPoints: [
			{ label: "Ep. 1", y: 6.64 },
			{ label: "Ep. 2", y: 6.31 },
			{ label: "Ep. 3", y: 6.59 },
			{ label: "Ep. 4", y: 6.95 },
			{ label: "Ep. 5", y: 7.16 },
			{ label: "Ep. 6", y: 6.40 },
			{ label: "Ep. 7", y: 7.20 },
			{ label: "Ep. 8", y: 7.17 },
			{ label: "Ep. 9", y: 6.95 },
			{ label: "Ep. 10", y: 7.09 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 5",
		dataPoints: [
			{ label: "Ep. 1", y: 8 },
			{ label: "Ep. 2", y: 6.81 },
			{ label: "Ep. 3", y: 6.71 },
			{ label: "Ep. 4", y: 6.82 },
			{ label: "Ep. 5", y: 6.56 },
			{ label: "Ep. 6", y: 6.24 },
			{ label: "Ep. 7", y: 5.40 },
			{ label: "Ep. 8", y: 7.01 },
			{ label: "Ep. 9", y: 7.14 },
			{ label: "Ep. 10", y: 8.11 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 6",
		dataPoints: [
			{ label: "Ep. 1", y: 7.94 },
			{ label: "Ep. 2", y: 7.29 },
			{ label: "Ep. 3", y: 7.28 },
			{ label: "Ep. 4", y: 7.82 },
			{ label: "Ep. 5", y: 7.89 },
			{ label: "Ep. 6", y: 6.71 },
			{ label: "Ep. 7", y: 7.80 },
			{ label: "Ep. 8", y: 7.60 },
			{ label: "Ep. 9", y: 7.66 },
			{ label: "Ep. 10", y: 8.89 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 7",
		dataPoints: [
			{ label: "Ep. 1", y: 10.11 },
			{ label: "Ep. 2", y: 9.27 },
			{ label: "Ep. 3", y: 9.25 },
			{ label: "Ep. 4", y: 10.17 },
			{ label: "Ep. 5", y: 10.72 },
			{ label: "Ep. 6", y: 10.24 },
			{ label: "Ep. 7", y: 12.07 }
		]
	},
          {
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 8",
		dataPoints: [
			{ label: "Ep. 1", y: 11.76 },
			{ label: "Ep. 2", y: 10.29 },
			{ label: "Ep. 3", y: 12.02 },
			{ label: "Ep. 4", y: 11.80 },
			{ label: "Ep. 5", y: 12.48 },
			{ label: "Ep. 6", y: 13.61 }
		]
	}]
});
chart.render();
function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
var chart = new CanvasJS.Chart("chartsaleContainer", {
	axisY :{

		suffix: "mn"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 1",
		dataPoints: [
			{ label: "Ep. 1", y: 2.22 },
			{ label: "Ep. 2", y: 2.20 },
			{ label: "Ep. 3", y: 2.44 },
			{ label: "Ep. 4", y: 2.45 },
			{ label: "Ep. 5", y: 2.58 },
			{ label: "Ep. 6", y: 2.44 },
			{ label: "Ep. 7", y: 2.40 },
			{ label: "Ep. 8", y: 2.72 },
			{ label: "Ep. 9", y: 2.66 },
			{ label: "Ep. 10", y: 3.04 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		visible: false,
		yValueFormatString: "##.00mn",
		name: "Season 2",
		dataPoints: [
			{ label: "Ep. 1", y: 3.86 },
			{ label: "Ep. 2", y: 3.76 },
			{ label: "Ep. 3", y: 3.77 },
			{ label: "Ep. 4", y: 3.65 },
			{ label: "Ep. 5", y: 3.90 },
			{ label: "Ep. 6", y: 3.88 },
			{ label: "Ep. 7", y: 3.69 },
			{ label: "Ep. 8", y: 3.86 },
			{ label: "Ep. 9", y: 3.38 },
			{ label: "Ep. 10", y: 4.20 }
		]
	},
	{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 3",
		dataPoints: [
			{ label: "Ep. 1", y: 4.37 },
			{ label: "Ep. 2", y: 4.27 },
			{ label: "Ep. 3", y: 4.72 },
			{ label: "Ep. 4", y: 4.87 },
			{ label: "Ep. 5", y: 5.35 },
			{ label: "Ep. 6", y: 5.50 },
			{ label: "Ep. 7", y: 4.84 },
			{ label: "Ep. 8", y: 4.13 },
			{ label: "Ep. 9", y: 5.22 },
			{ label: "Ep. 10", y: 5.39 }
		]
	},
	{
		type: "spline",
      	visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 4",
		dataPoints: [
			{ label: "Ep. 1", y: 6.64 },
			{ label: "Ep. 2", y: 6.31 },
			{ label: "Ep. 3", y: 6.59 },
			{ label: "Ep. 4", y: 6.95 },
			{ label: "Ep. 5", y: 7.16 },
			{ label: "Ep. 6", y: 6.40 },
			{ label: "Ep. 7", y: 7.20 },
			{ label: "Ep. 8", y: 7.17 },
			{ label: "Ep. 9", y: 6.95 },
			{ label: "Ep. 10", y: 7.09 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 5",
		dataPoints: [
			{ label: "Ep. 1", y: 8 },
			{ label: "Ep. 2", y: 6.81 },
			{ label: "Ep. 3", y: 6.71 },
			{ label: "Ep. 4", y: 6.82 },
			{ label: "Ep. 5", y: 6.56 },
			{ label: "Ep. 6", y: 6.24 },
			{ label: "Ep. 7", y: 5.40 },
			{ label: "Ep. 8", y: 7.01 },
			{ label: "Ep. 9", y: 7.14 },
			{ label: "Ep. 10", y: 8.11 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 6",
		dataPoints: [
			{ label: "Ep. 1", y: 7.94 },
			{ label: "Ep. 2", y: 7.29 },
			{ label: "Ep. 3", y: 7.28 },
			{ label: "Ep. 4", y: 7.82 },
			{ label: "Ep. 5", y: 7.89 },
			{ label: "Ep. 6", y: 6.71 },
			{ label: "Ep. 7", y: 7.80 },
			{ label: "Ep. 8", y: 7.60 },
			{ label: "Ep. 9", y: 7.66 },
			{ label: "Ep. 10", y: 8.89 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 7",
		dataPoints: [
			{ label: "Ep. 1", y: 10.11 },
			{ label: "Ep. 2", y: 9.27 },
			{ label: "Ep. 3", y: 9.25 },
			{ label: "Ep. 4", y: 10.17 },
			{ label: "Ep. 5", y: 10.72 },
			{ label: "Ep. 6", y: 10.24 },
			{ label: "Ep. 7", y: 12.07 }
		]
	},
          {
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 8",
		dataPoints: [
			{ label: "Ep. 1", y: 11.76 },
			{ label: "Ep. 2", y: 10.29 },
			{ label: "Ep. 3", y: 12.02 },
			{ label: "Ep. 4", y: 11.80 },
			{ label: "Ep. 5", y: 12.48 },
			{ label: "Ep. 6", y: 13.61 }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
var data = [
    {
        "originator": "Punjab",
        "balance": 38.6,
        "fake" : 400.21
    },
    {
        "originator": "Madhya Pardesh",
        "balance": 22.5,
        "fake" : 322.99
    },
    {
        "originator": "Maharasthra",
        "balance": 30.8,
         "fake" : 642
    },
    {
        "originator": "others",
        "balance": 8.1,
        "fake" : 200
    }
];
function type (d) {
			d.balance = +d.balance;
			return d;
}

function swapRealData (data) {

			for (i = 0; i < data.length; i++) {
				data[i].fake = data[i].balance;
			}

			return data;
}
data = data.slice(0, 9);
			var width = 450,
				height = 300,
				radius = Math.min(width, height) / 2,
				that = this,
				w = 200,
				h = 50,
				colorObj = [];
			var color = d3.scale.category20();
			var arc = d3.svg.arc().outerRadius(radius - 10).innerRadius(radius - 70);
			var pie = d3.layout.pie().sort(d3.descending).value(function (d) {
				return d.fake;
			});
			var svg = d3.select("body").select(".viz-portfolio-total-value").append("svg").attr("width", width).attr("height", height).append("g").attr("transform", "translate(" + 150 + "," + height / 2 + ")");
			var g = svg.selectAll(".arc").data(pie(data)).enter().append("g").attr("class", "arc");
			g.append("path").attr("d", arc).style("fill", function (d) {
				return color(d.data.originator);
			}).each(function (d) {
				this._current = d;
			}); // store the initial values;
			var legend = svg.append("g").attr("class", "legend").attr("height", 100).attr("width", 180).attr('transform', 'translate(25,-100)');
			var legendRect = legend.selectAll('rect').data(data);
			legendRect.enter().append("rect").attr("x", w - 65).attr("width", 10).attr("height", 10);
			legendRect.attr("y", function (d, i) {
				return i * 20;
			}).style("fill", function (d) {
				return color(d.originator);
			});
			var legendText = legend.selectAll('text').data(data);
			legendText.enter().append("text").attr("x", w - 52);
			legendText.attr("y", function (d, i) {

				return i * 20 + 9;

			}).text(function (d) {

				var formatted_name;

				formatted_name = d.originator;

				return formatted_name + '.  ' + ' - $' + d.balance;
			});
			window.setTimeout(redrawChart, 500);
			function arcTween(a) {
				var i = d3.interpolate(this._current, a);
				this._current = i(0);
				return function (t) {
					return arc(i(t));
				};
			}
			function redrawChart() {
				//Convert "fake" value to real value then animate updated chart 
				that.swapRealData(data);
				svg.selectAll("path").data(pie(data)).transition().duration(2000).attrTween("d", arcTween);
				svg.selectAll(".arc").data(pie(data));
				//Delay 
				window.setTimeout(function () {
					g.append("text").attr("transform", function (d) {
						return "translate(" + arc.centroid(d) + ")";
				});
				}, 1800);
			}
}
  </script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->
  <!-- daterangepicker -->
  <!-- <script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script> -->
  <!-- Tempusdominus Bootstrap 4 -->
  <!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
  <!-- Summernote -->
  <!-- <script src="plugins/summernote/summernote-bs4.min.js"></script> -->
  <!-- overlayScrollbars -->
  <!-- <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!--  For Charts -->
  <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
  <script src="cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://d3js.org/d3.v3.min.js"></script>
</body>

</html>