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
                    <tr>
                        <td>{{$fundingProgramme->category_id}}</td>
                        <td>{{$fundingProgramme->name}}</td>
                        <td>{{$fundingProgramme->organisation}}</td>
                        <td>@if ($fundingProgramme->target_what) @foreach($fundingProgramme->target_what as $cost) {{$cost}} <br/>@endforeach @endif</td>
                        <td>{{$fundingProgramme->link}}</td>
                        <td>
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
                    <div class="modal fade" id="deleteFundingProgrammeModal{{$fundingProgramme->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('funding_programmes.deleteFundingProgrammeModal.title')}}</h4>
                                </div>
                                <div class="modal-body">
                                    {{trans('funding_programmes.deleteFundingProgrammeModal.body', ['name' => $fundingProgramme->name])}}
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-primary"
                                       href="{{url('funding_programmes/'.$fundingProgramme->id.'/delete')}}"
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