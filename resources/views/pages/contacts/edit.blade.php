@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if ($contact->name == '')
                    {{trans('contacts.title_new')}}
                @else
                    {{trans('contacts.title_edit')}}
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
            <form role="form" method="post" action="{{url('contacts/'.($contact->id?$contact->id:0).'/edit')}}">
                @include('pages.contacts.form')
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">{{trans('layout.buttons.save')}}</button>
                    <a class="btn btn-default" href="{{url('contacts')}}">{{trans('layout.buttons.cancel')}}</a>
                </div>
            </form>
        </div>
    </div>
@stop