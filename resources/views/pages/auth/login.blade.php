@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('auth.sign_in')}}</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" method="POST" action="login">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{trans('auth.name')}}" name="name" type="text"
                                           @if(isset(session('_old_input')['name']))
                                            value="{{ session('_old_input')['name'] }}"
                                           @else
                                            autofocus
                                           @endif>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="{{trans('auth.password')}}" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{-- stay logged in after session expired --}}
                                        <input name="remember" type="checkbox" value="Remember Me">{{trans('auth.remember_me')}}
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">{{trans('auth.login')}}</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop