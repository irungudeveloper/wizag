<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <title>WiZag Project</title>
  </head>
  <body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="bg-dark">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Dashboard Menu
                    </a>
                </li>
                @can('admin')
                <li>
                    <a href=" {{ route('company.create') }} ">Create New Company</a>
                </li>
                <li>
                    <a href=" {{ route('employee.create') }} ">Create New Employee</a>
                </li>
                <li>
                    <a href=" {{ route('company.index') }} ">Manage Company Records</a>
                </li>
                <li>
                    <a href=" {{ route('employee.index') }} ">Manage Employee Records</a>
                </li>
                @endcan

                <li>
                    <a href="#">Logout</a>
                </li>
    
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        @yield('content')
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          <div class="card-header">
                            @can('admin')
                              <h4 class="h4">Administrator Panel</h4>
                            @endcan
                            @can('employee')
                            <h4 class="h4">Kanye West Quote</h4>
                            @endcan
                          </div>
                          <div class="card-body">
                            @can('admin')
                              <p class="display-5">Welcome to the dashboard</p>
                            @endcan
                            @can('employee')
                              <p class="display-5">Kanye west quote</p>
                            @endcan
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
