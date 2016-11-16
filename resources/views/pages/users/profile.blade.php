@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{trans('users.title_edit_profile')}}
            </h1>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6 col-lg-5">
        @if (\Session::has('message'))
            <div class="alert alert-success">{{ \Session::get('message') }}</div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>{{trans('users.username')}}</label>
                <input name="name" class="form-control" value="{{$user->name}}" required>
            </div>
            <div class="form-group">
                <label>{{trans('users.password')}}</label>
                <input name="password" type="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{trans('users.password2')}}</label>
                <input name="password_confirmation" type="password" class="form-control" required>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">{{trans('layout.buttons.save')}}</button>
            </div>
        </form>
    </div>
</div>
@stop