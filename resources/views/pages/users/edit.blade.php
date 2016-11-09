@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if ($user->name == '')
                    {{trans('users.title_new')}}
                @else
                    {{trans('users.title_edit')}}
                @endif
            </h1>
        </div>
    </div>
    <div class="row">
    <div class="col-md-5">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" method="post" action="{{url('users/'.($user->id?$user->id:0).'/edit')}}">
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
            <div class="form-group">
                <label>{{trans('users.role')}}</label>
                <select name="role" class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{$role}}"
                                @if ($userRole == $role)
                                    selected
                                @endif
                        >{{trans('auth.roles.'.$role)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary">{{trans('layout.buttons.save')}}</button>
                <a class="btn btn-default" href="{{url('users')}}">{{trans('layout.buttons.cancel')}}</a>
            </div>
        </form>
    </div>
</div>
@stop