@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row">
                    <div class="col-md-8 col-lg-7">
                        @if (Entrust::can('create-categories'))
                        <a class="btn btn-primary btn-social pull-right" href="{{url('categories/0/edit')}}">
                            <i class="fa fa-plus"></i> {{trans('categories.add_category')}}
                        </a>
                        @endif
                        {{trans('categories.title')}}
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
                    <th>{{trans('categories.name')}}</th>
                    <th>{{trans('categories.parent')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->getParent()->name}}</td>
                        <td>
                            @if (Entrust::can('create-categories'))
                            <a class="btn btn-default" title="{{trans('layout.buttons.edit')}}"
                               href="{{url('categories/'.$category->id.'/edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            @endif
                            @if (Entrust::can('delete-categories'))
                            <button class="btn btn-default" title="{{trans('layout.buttons.delete')}}"
                                    data-toggle="modal" data-target="#deleteCategoryModal{{$category->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteCategoryModal{{$category->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('categories.deleteCategoryModal.title')}}</h4>
                                </div>
                                <div class="modal-body">
                                    {{trans('categories.deleteCategoryModal.body', ['name' => $category->name])}}
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-primary"
                                       href="{{url('categories/'.$category->id.'/delete')}}"
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
@stop