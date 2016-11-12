@extends('layouts.default')
@section('content')
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
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
                    @if (Entrust::ability('admin,employee,guest', 'view-funding-programmes'))
                    <li>
                        <a href="{{url('funding_programmes')}}"><i class="fa fa-tasks fa-fw"></i> Förderprogramme</a>
                    </li>
                    @endif
                    @if (Entrust::ability('admin,employee,guest', 'view-categories'))
                    <li>
                        <a href="{{url('categories')}}"><i class="fa fa-tags fa-fw"></i> Kategorien</a>
                    </li>
                    @endif
                    @if (Entrust::ability('admin', 'user-management'))
                    <li>
                        <a href="{{url('users')}}"><i class="fa fa-users fa-fw"></i> Benutzerverwaltung</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-wrapper" style="min-height: 923px;">
        @yield('page_content')
    </div>
@stop