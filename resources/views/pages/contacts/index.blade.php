@extends('layouts.nav')
@section('page_content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <div class="row">
                    <div class="col-md-8 col-lg-7">
                        {{trans('contacts.title')}}
                        @if (Entrust::can('create-funding-programmes'))
                        <a class="btn btn-primary btn-social pull-right-md" href="{{url('contacts/0/edit')}}">
                            <i class="fa fa-plus"></i> {{trans('contacts.add_contact')}}
                        </a>
                        @endif
                    </div>
                </div>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-lg-7">
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
            <table id="contactsTable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{trans('contacts.name')}}</th>
                    <th>{{trans('contacts.address')}}</th>
                    <th>{{trans('contacts.contact')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->name}}</td>
                        <td>
                            @if ($contact->street || $contact->street_nr) {{$contact->street}} {{$contact->street_nr}} <br/> @endif
                            @if ($contact->zip_code || $contact->city) {{$contact->zip_code}} {{$contact->city}} @endif
                        </td>
                        <td>
                            @if ($contact->tel) {{trans('contacts.tel')}}: {{$contact->tel}} <br/> @endif
                            @if ($contact->fax) {{trans('contacts.fax')}}: {{$contact->fax}} <br/> @endif
                            @if ($contact->email) {{trans('contacts.email')}}: {{$contact->email}} <br/> @endif
                            @if ($contact->internet) {{trans('contacts.internet')}}: {{$contact->internet}} @endif
                        </td>
                        <td>
                            @if (Entrust::can('create-funding-programmes'))
                            <a class="btn btn-default" title="{{trans('layout.buttons.edit')}}"
                               href="{{url('contacts/'.$contact->id.'/edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                            @endif
                            @if (Entrust::can('delete-funding-programmes'))
                            <button class="btn btn-default" title="{{trans('layout.buttons.delete')}}"
                                    data-toggle="modal" data-target="#deleteContactModal{{$contact->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteContactModal{{$contact->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('contacts.deleteContactModal.title')}}</h4>
                                </div>
                                <div class="modal-body">
                                    {{trans('contacts.deleteContactModal.body', ['name' => $contact->name])}}
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-primary"
                                       href="{{url('contacts/'.$contact->id.'/delete')}}"
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#contactsTable').dataTable( {
                "language": {
                    "url": "{{asset('../resources/lang/de/dataTables.lang')}}"
                }
            } );
        });
    </script>
@stop