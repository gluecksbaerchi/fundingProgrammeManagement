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
                            <a class="btn btn-default pull-right" title="{{trans('layout.buttons.back')}}"
                               href="{{url('funding_programmes')}}">
                                <i class="fa fa-arrow-left"></i>
                            </a>
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
                @if ($fundingProgramme->category->getParent()->name)
                    <tr>
                        <td>
                            <div class="row">
                                <label class="col-md-5">{{trans('categories.parent')}}</label>
                                <div class="col-md-7">{{$fundingProgramme->category->getParent()->name}}</div>
                            </div>
                        </td>
                    </tr>
                @endif
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
                            <div class="col-md-7 pre-wrap">{{$fundingProgramme->target_what_description ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.target_who')}}</label>
                            <div class="col-md-7 pre-wrap">{{$fundingProgramme->target_who ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.funding_sum')}}</label>
                            <div class="col-md-7 pre-wrap">{{$fundingProgramme->funding_sum ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.application')}}</label>
                            <div class="col-md-7 pre-wrap">{{$fundingProgramme->application ?: '-'}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label class="col-md-5">{{trans('funding_programmes.link')}}</label>
                            <div class="col-md-7">
                                @if ($fundingProgramme->link)
                                    <a href="//{{$fundingProgramme->link}}" target="_blank">{{$fundingProgramme->link}}</a>
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
                            <label class="col-md-5">{{trans('funding_programmes.runtime')}}</label>
                            <div class="col-md-7">
                                {{trans('funding_programmes.from')}}
                                {{date('d.m.Y', strtotime($fundingProgramme->runtime_from)) ?: '-'}}
                                {{trans('funding_programmes.to')}}
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
                                        {{trans('contacts.tel')}} {{$fundingProgramme->contact->tel}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->fax)
                                        {{trans('contacts.fax')}} {{$fundingProgramme->contact->fax}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->email)
                                        {{trans('contacts.email')}}:
                                        <a href="mailto:{{$fundingProgramme->contact->email}}">{{$fundingProgramme->contact->email}}<br/></a>
                                    @endif
                                    @if ($fundingProgramme->contact->internet)
                                        {{trans('contacts.internet')}}:
                                        <a href="//{{$fundingProgramme->contact->internet}}" target="_blank">{{$fundingProgramme->contact->internet}}</a>
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
        <div class="col-md-2 col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{trans('funding_programmes.history')}}
                </div>
                <div class="panel-body" style="max-height: 565px; overflow-y: scroll">
                    @foreach ($fundingProgramme->history as $entry)
                    <div class="alert panel-default">
                        {{trans('funding_programmes.user')}}: {{$entry->user->name}} <br/>
                        {{trans('funding_programmes.date')}}: {{date('d.m.Y H:i', strtotime($entry->updated_at))}} <br/>
                        {{trans('funding_programmes.changes')}}:
                        @foreach ($entry->changes as $value)
                            @if (!$loop->first) / @endif {{trans('funding_programmes.'.$value)}}
                        @endforeach
                    </div>
                    @endforeach
                    <div class="alert panel-default">
                        {{trans('funding_programmes.user')}}: {{$fundingProgramme->user->name}} <br/>
                        {{trans('funding_programmes.date')}}: {{date('d.m.Y H:i', strtotime($fundingProgramme->created_at))}} <br/>
                        {{trans('funding_programmes.created')}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.funding_programmes.delete_modal')
@stop