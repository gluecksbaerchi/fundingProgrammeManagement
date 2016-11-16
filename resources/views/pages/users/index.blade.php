@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row">
                    <div class="col-md-8 col-lg-7">
                        <a class="btn btn-primary btn-social pull-right" href="{{url('users/0/edit')}}">
                            <i class="fa fa-plus"></i> {{trans('users.add_user')}}
                        </a>
                        {{trans('users.title')}}
                    </div>
                </div>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-7">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table id="usersTable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{trans('users.username')}}</th>
                    <th>{{trans('users.role')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{trans('auth.roles.'.$user->getRole()->name)}}</td>
                        <td>
                            @if ($user->id != \Auth::user()->id)
                            <a class="btn btn-default" title="{{trans('layout.buttons.edit')}}"
                                href="{{url('users/'.$user->id.'/edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button class="btn btn-default" title="{{trans('layout.buttons.delete')}}"
                                    data-toggle="modal" data-target="#deleteUserModal{{$user->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            @else
                                <a class="btn btn-default" title="{{trans('layout.buttons.edit')}}"
                                   href="{{url('profile')}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('users.deleteUserModal.title')}}</h4>
                                </div>
                                <div class="modal-body">
                                    {{trans('users.deleteUserModal.body', ['name' => $user->name])}}
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-primary"
                                       href="{{url('users/'.$user->id.'/delete')}}"
                                    >{{trans('layout.buttons.delete')}}</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('layout.buttons.cancel')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#usersTable').dataTable( {
                "language": {
                    "url": "{{asset('../resources/lang/de/dataTables.lang')}}"
                }
            } );
        });
    </script>
@stop