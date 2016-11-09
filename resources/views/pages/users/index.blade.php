@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Benutzer</h1>
        </div>
    </div>

    <a class="btn btn-primary btn-social" href="{{url('users/edit/0')}}">
        <i class="fa fa-plus"></i> Benutzer hinzufügen
    </a>
@stop