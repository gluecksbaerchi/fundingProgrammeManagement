@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if ($category->name == '')
                    {{trans('categories.title_new')}}
                @else
                    {{trans('categories.title_edit')}}
                @endif
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-5">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="post" action="{{url('categories/'.($category->id?$category->id:0).'/edit')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>{{trans('categories.name')}}</label>
                    <input name="name" class="form-control" value="{{$category->name}}" required>
                </div>
                @if (!$category->hasChildren())
                <div class="form-group">
                    <label>{{trans('categories.parent')}}</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">{{trans('categories.no_parent')}}</option>
                        @foreach ($parentCategories as $parentCategory)
                            <option value="{{$parentCategory->id}}"
                                    @if ($category->parent_id == $parentCategory->id)
                                    selected
                                    @endif
                            >{{$parentCategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">{{trans('layout.buttons.save')}}</button>
                    <a class="btn btn-default" href="{{url('categories')}}">{{trans('layout.buttons.cancel')}}</a>
                </div>
            </form>
        </div>
    </div>
@stop