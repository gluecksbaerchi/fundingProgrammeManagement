@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        @if (Entrust::can('create-funding-programmes'))
                        <a class="btn btn-primary btn-social pull-right" href="{{url('funding_programmes/0/edit')}}">
                            <i class="fa fa-plus"></i> {{trans('funding_programmes.add_funding_programme')}}
                        </a>
                        @endif
                        {{trans('funding_programmes.title')}}
                    </div>
                </div>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-9">
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
                    <th>{{trans('funding_programmes.category')}}</th>
                    <th>{{trans('funding_programmes.name')}}</th>
                    <th>{{trans('funding_programmes.organisation')}}</th>
                    <th>{{trans('funding_programmes.target_what')}}</th>
                    <th>{{trans('funding_programmes.link')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($fundingProgrammes as $fundingProgramme)
                    <tr @if ($fundingProgramme->isOutdated()) style="background-color: #F2DEDE; color: #a94442;" @endif>
                        <td>{{$fundingProgramme->category->name}}</td>
                        <td>{{$fundingProgramme->name}}</td>
                        <td>{{$fundingProgramme->organisation}}</td>
                        <td>@if ($fundingProgramme->target_what) @foreach($fundingProgramme->target_what as $cost) {{$cost}} <br/>@endforeach @endif</td>
                        <td>{{$fundingProgramme->link}}</td>
                        <td>
                            @if (Entrust::can('view-funding-programmes'))
                                <a class="btn btn-default" title="{{trans('layout.buttons.view')}}"
                                   href="{{url('funding_programmes/'.$fundingProgramme->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                            @if (Entrust::can('create-funding-programmes'))
                            <a class="btn btn-default" title="{{trans('layout.buttons.edit')}}"
                               href="{{url('funding_programmes/'.$fundingProgramme->id.'/edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            @endif
                            @if (Entrust::can('delete-funding-programmes'))
                                <button class="btn btn-default" title="{{trans('layout.buttons.delete')}}"
                                        data-toggle="modal" data-target="#deleteFundingProgrammeModal{{$fundingProgramme->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @include('pages.funding_programmes.delete_modal')
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop