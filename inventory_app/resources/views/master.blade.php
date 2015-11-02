<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="author" content="migueltapia.it@gmail.com">
    <link rel="icon" href="/favicon.ico">

    <title>@yield('title')</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('head')
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Inventory Processing</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('settings.size_matrix.index') }}">Size Matix</a></li>
                <li><a href="{{ route('settings.price_rule.index') }}">Price Calculator</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ url('settings/vendor') }}">Vendors</a></li>
                <li><a href="{{ url('settings/category') }}">Categories</a></li>
                <li><a href="{{ url('settings/department') }}">Departments</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">user<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/auth/logout') }}">Account Info</a></li>
                <li><a href="{{ url('/auth/logout') }}">Change Password</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-1 sidebar">
          <ul class="nav nav-sidebar">
            <li @if ($page == "dashboard") class="active" @endif><a href="{{ url('dashboard') }}">Dashboard</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li @if ($page == "invoice.index") class="active" @endif><a href="{{ route('invoice.index') }}">Invoices</a></li>
            <li @if ($page == "invoice.create") class="active" @endif><a href="{{ route('invoice.create') }}">New Invoice</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li @if ($page == "delivered.index") class="active" @endif><a href="{{ route('delivered.index') }}">Delivered</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li @if ($page == "detail.index") class="active" @endif><a href="{{ route('detail.index') }}">Details</a></li>
            <li @if ($page == "quantity.index") class="active" @endif><a href="{{ route('quantity.index') }}">Quantity</a></li>
          </ul>        
          <ul class="nav nav-sidebar">
            <li @if ($page == "export.index") class="active" @endif><a href="{{ route('export.index') }}">Export</a></li>
          </ul>
        </div>
        <!-- <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Dashboard<span class="sr-only">(current)</span></a></li>
            <li><a href="#">Export</a></li>
            <li><a href="#">Create Invoice</a></li>
            <li><a href="#">View Open Invoices</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><p class="text-right"><h4><strong>Pre-defined Selections</strong></h4></p></li>
            <li><a href="">Department</a></li>
            <li><a href="">Category</a></li>
            <li><a href="">Vendor</a></li>
            <li><a href="">Size Matrix</a></li>
          </ul>
        </div> -->

        <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-11 col-lg-offset-1 main">
          @yield('content')
        </div>
      </div>
    </div>
        
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    @yield('js')
  </body>
</html>