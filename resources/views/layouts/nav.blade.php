@extends('layouts.default')
@section('content')
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            {{--<a class="navbar-brand" href="funding_programmes" style="padding-top: 0px;">--}}
                {{--<img src="../resources/images/logo/logo.png" style="height: 50px; width: 160px;">--}}
            </a><a class="navbar-brand" href="{{url('funding_programmes')}}">
                Förderdatenbank
            </a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{url('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{url('users')}}"><i class="fa fa-users fa-fw"></i> Benutzerverwaltung</a>
                    </li>
                    <li>
                        <a href="{{url('funding_programmes')}}"><i class="fa fa-tasks fa-fw"></i> Förderprogramme</a>
                    </li>
                    <li>
                        <a href="{{url('categories')}}"><i class="fa fa-tags fa-fw"></i> Kategorien</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-wrapper">
        @yield('page_content')
    </div>
@stop