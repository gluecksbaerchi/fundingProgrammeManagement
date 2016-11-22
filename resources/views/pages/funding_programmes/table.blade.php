<table id="fundingProgrammesTable" class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>{{trans('funding_programmes.category')}}</th>
        <th>{{trans('funding_programmes.name')}}</th>
        <th>{{trans('funding_programmes.organisation')}}</th>
        <th>{{trans('funding_programmes.target_what')}}</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($fundingProgrammes as $fundingProgramme)
        <tr @if ($fundingProgramme->isOutdated()) style="background-color: #F2DEDE; color: #a94442;" @endif>
            <td>
                @if ($fundingProgramme->category->getParent()->name)
                    <span style="font-weight: bold; font-size: 10px;">{{$fundingProgramme->category->getParent()->name}}</span> <br/>
                @endif
                {{$fundingProgramme->category->name}}</td>
            <td>{{$fundingProgramme->name}}</td>
            <td>{{$fundingProgramme->organisation}}</td>
            <td>@if ($fundingProgramme->target_what) @foreach($fundingProgramme->target_what as $cost) {{$cost}} <br/>@endforeach @endif</td>
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