<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{trans('layout.title')}}</title>
    <link rel="icon" href="{{asset('../resources/images/logo/logo20x20.png')}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('../resources/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../resources/bower_components/bootstrap-social/bootstrap-social.css')}}" rel="stylesheet">
    <link href="{{asset('../resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('../resources/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('../resources/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('../resources/assets/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('../resources/bower_components/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('../resources/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('../resources/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!-- jQuery -->
    <script src="{{asset('../resources/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('../resources/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('../resources/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('../resources/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('../resources/dist/js/sb-admin-2.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{asset('../resources/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('../resources/bower_components/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('../resources/bower_components/datatables-responsive/js/dataTables.responsive.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#usersTable').dataTable( {
                "language": {
                    "url": "{{asset('../resources/lang/de/dataTables.lang')}}"
                }
            } );
        });
    </script>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div id="wrapper">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
