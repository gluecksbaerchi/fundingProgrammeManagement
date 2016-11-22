@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        {{trans('funding_programmes.title')}}
                        @if (Entrust::can('create-funding-programmes'))
                        <a class="btn btn-primary btn-social pull-right-md" href="{{url('funding_programmes/0/edit')}}">
                            <i class="fa fa-plus"></i> {{trans('funding_programmes.add_funding_programme')}}
                        </a>
                        @endif
                    </div>
                </div>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-9">
            @if (\Session::has('message'))
                <div id="message" class="alert alert-success">{{ \Session::get('message') }}</div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="filterForm" action="{{url('funding_programmes/filter')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('funding_programmes.category')}}</label>
                            <select name="category_id[]" multiple class="form-control selectpicker"
                                    title="{{trans('funding_programmes.select_filter')}}" onchange="filterFundingProgrammes()">
                                @foreach ($categories as $category)
                                    @if ($category->parent_id == null)
                                        <option value="{{$category->id}}"
                                                @if (session('category_filter') && in_array($category->id, session('category_filter'))) selected @endif
                                                style="font-weight: bold"
                                        >{{$category->name}}</option>
                                        @foreach ($category->children as $childCategory)
                                            <option value="{{$childCategory->id}}"
                                                    @if (session('category_filter') && in_array($childCategory->id, session('category_filter'))) selected @endif
                                            >- {{$childCategory->name}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('funding_programmes.target_what')}}</label>
                            <select multiple name="target_what[]" class="form-control selectpicker"
                                    title="{{trans('funding_programmes.select_filter')}}" onchange="filterFundingProgrammes()">
                                @foreach ($targetWhatOptions as $targetWhatOption)
                                    <option value="{{$targetWhatOption}}"
                                            @if (session('target_what_filter') && in_array($targetWhatOption, session('target_what_filter'))) selected @endif
                                    >{{$targetWhatOption}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <div id="tablePlaceholder"></div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            filterFundingProgrammes();
        });

        var filterFundingProgrammes = function () {
            var form = $('#filterForm');
            $.post(form.attr('action'), form.serialize(), function (result) {
                $('#tablePlaceholder').html(result);
                initTable();
            });
        };

        function initTable() {
            $('#fundingProgrammesTable').dataTable( {
                "language": {
                    "url": "{{asset('../resources/lang/de/dataTables.lang')}}"
                },
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Alle"]]
            } );
        }
    </script>
@stop