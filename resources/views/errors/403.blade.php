@extends('layouts.nav')
@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        403 Forbidden</h2>
                    <div class="error-details">
                        {{trans('layout.error_details_403')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop