@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('users.title')}}</h1>
        </div>
    </div>

    <a class="btn btn-primary btn-social" href="{{url('users/0/edit')}}">
        <i class="fa fa-plus"></i> {{trans('users.add_user')}}
    </a>
@stop