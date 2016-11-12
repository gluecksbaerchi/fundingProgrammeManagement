@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if ($fundingProgramme->name == '')
                    {{trans('funding_programmes.title_new')}}
                @else
                    {{trans('funding_programmes.title_edit')}}
                @endif
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-lg-8">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="post" action="{{url('funding_programmes/'.($fundingProgramme->id?$fundingProgramme->id:0).'/edit')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('funding_programmes.category')}}</label>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if ($fundingProgramme->category_id == $category->id)
                                            selected
                                            @endif
                                    >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.name')}}</label>
                            <input name="name" class="form-control" value="{{$fundingProgramme->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.organisation')}}</label>
                            <input name="organisation" class="form-control" value="{{$fundingProgramme->organisation}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.target_what')}}</label>
                            <select multiple name="target_what[]" class="form-control">
                                @foreach ($targetWhatOptions as $targetWhatOption)
                                    <option value="{{$targetWhatOption}}"
                                            @if ( $fundingProgramme->target_what != null && in_array($targetWhatOption, $fundingProgramme->target_what))
                                            selected
                                            @endif
                                    >{{$targetWhatOption}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.target_what_description')}}</label>
                            <textarea name="target_what_description" class="form-control">{{$fundingProgramme->target_what_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.target_who')}}</label>
                            <textarea name="target_who" class="form-control">{{$fundingProgramme->target_who}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('funding_programmes.funding_sum')}}</label>
                            <textarea name="funding_sum" class="form-control">{{$fundingProgramme->funding_sum}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.application')}}</label>
                            <textarea name="application" class="form-control">{{$fundingProgramme->application}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.link')}}</label>
                            <input name="link" class="form-control" value="{{$fundingProgramme->link}}">
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.runtime')}}</label>
                            <div class="row">
                                <div class="col-md-2">
                                    {{trans('funding_programmes.runtime_from')}}
                                </div>
                                <div class="col-md-4">
                                    <input name="runtime_from" class="form-control datepicker"
                                           @if ($fundingProgramme->runtime_from) value="{{date('d.m.Y', strtotime($fundingProgramme->runtime_from))}}" @endif>
                                </div>
                                <div class="col-md-2">
                                    {{trans('funding_programmes.runtime_to')}}
                                </div>
                                <div class="col-md-4">
                                    <input name="runtime_to" class="form-control datepicker"
                                           @if ($fundingProgramme->runtime_to) value="{{date('d.m.Y', strtotime($fundingProgramme->runtime_to))}}" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">{{trans('layout.buttons.save')}}</button>
                            <a class="btn btn-default" href="{{url('funding_programmes')}}">{{trans('layout.buttons.cancel')}}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'dd.mm.yyyy'
        });
    </script>
@stop