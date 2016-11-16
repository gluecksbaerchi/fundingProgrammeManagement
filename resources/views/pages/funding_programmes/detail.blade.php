@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row">
                    <div class="col-md-10 col-lg-8">
                        @if (Entrust::can('delete-funding-programmes'))
                            <button class="btn btn-default pull-right" title="{{trans('layout.buttons.delete')}}"
                                    data-toggle="modal" data-target="#deleteFundingProgrammeModal{{$fundingProgramme->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                        @endif
                        @if (Entrust::can('create-funding-programmes'))
                            <a class="btn btn-default pull-right" title="{{trans('layout.buttons.edit')}}"
                               href="{{url('funding_programmes/'.$fundingProgramme->id.'/edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        @endif
                        {{trans('funding_programmes.title_detail')}}
                    </div>
                </div>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-lg-8">
            <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.category')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->category->name}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.name')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->name}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.organisation')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->organisation ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.target_what')}}</label>
                            <div class="col-md-7">
                                @if ($fundingProgramme->target_what)
                                    @foreach($fundingProgramme->target_what as $cost)
                                        {{$cost}} <br/>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.target_what_description')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->target_what_description ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.target_who')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->target_who ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.funding_sum')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->funding_sum ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.application')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->application ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.link')}}</label>
                            <div class="col-md-7">{{$fundingProgramme->link ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.runtime')}}</label>
                            <div class="col-md-7">
                                {{trans('funding_programmes.runtime_from')}}
                                {{date('d.m.Y', strtotime($fundingProgramme->runtime_from)) ?: '-'}}
                                {{trans('funding_programmes.runtime_to')}}
                                {{date('d.m.Y', strtotime($fundingProgramme->runtime_to)) ?: '-'}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.contact')}}</label>
                            <div class="col-md-7">
                                @if ($fundingProgramme->contact)
                                    {{$fundingProgramme->contact->name}}<br/>
                                    @if ($fundingProgramme->contact->street || $fundingProgramme->contact->street_nr)
                                        {{$fundingProgramme->contact->street}} {{$fundingProgramme->contact->street_nr}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->zip_code || $fundingProgramme->contact->city)
                                        {{$fundingProgramme->contact->zip_code}} {{$fundingProgramme->contact->city}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->tel)
                                        {{trans('funding_programmes.contact_form.tel')}} {{$fundingProgramme->contact->tel}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->fax)
                                        {{trans('funding_programmes.contact_form.fax')}} {{$fundingProgramme->contact->fax}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->email)
                                        {{trans('funding_programmes.contact_form.email')}}: {{$fundingProgramme->contact->email}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->internet)
                                        {{trans('funding_programmes.contact_form.internet')}}: {{$fundingProgramme->contact->internet}}
                                    @endif
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    @include('pages.funding_programmes.delete_modal')
@stop