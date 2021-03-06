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
                            <label>{{trans('funding_programmes.category')}}*</label>
                            <select name="category_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    @if ($category->parent_id == null)
                                        <option value="{{$category->id}}"
                                                @if ($fundingProgramme->category_id == $category->id)
                                                    selected
                                                @endif
                                                style="font-weight: bold"
                                        >{{$category->name}}</option>
                                        @foreach ($category->children as $childCategory)
                                            <option value="{{$childCategory->id}}"
                                                    @if ($fundingProgramme->category_id == $childCategory->id)
                                                        selected
                                                    @endif
                                            >- {{$childCategory->name}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.name')}}*</label>
                            <input name="name" class="form-control" value="{{$fundingProgramme->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.organisation')}}*</label>
                            <input name="organisation" class="form-control" value="{{$fundingProgramme->organisation}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.target_what')}}</label>
                            <select multiple name="target_what[]" class="form-control selectpicker" title="{{trans('funding_programmes.select')}}">
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
                                <div class="col-xs-5">
                                    <input name="runtime_from" class="form-control datepicker"
                                           @if ($fundingProgramme->runtime_from)
                                            value="{{date('d.m.Y', strtotime($fundingProgramme->runtime_from))}}"
                                           @endif>
                                </div>
                                <div class="col-xs-2" style="text-align: center;">
                                    -
                                </div>
                                <div class="col-xs-5">
                                    <input name="runtime_to" class="form-control datepicker"
                                           @if ($fundingProgramme->runtime_to)
                                            value="{{date('d.m.Y', strtotime($fundingProgramme->runtime_to))}}"
                                           @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{trans('funding_programmes.contact')}}</label><br/>
                            <button type="button" class="btn btn-social btn-sm btn-default" data-toggle="modal" data-target="#contactModal">
                                <i class="fa fa-address-book-o"></i>
                                {{trans('layout.buttons.choose')}}
                            </button>
                            <input id="contactId" name="contact_id" @if ($fundingProgramme->contact) value="{{$fundingProgramme->contact->id}}" @endif hidden/>
                            <div id="selectedContact" style="margin-top: 5px;">
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
                                        {{trans('contacts.email')}}: {{$fundingProgramme->contact->email}}<br/>
                                    @endif
                                    @if ($fundingProgramme->contact->internet)
                                        {{trans('contacts.internet')}}: {{$fundingProgramme->contact->internet}}
                                    @endif
                                @endif
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

    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="newContactBtn" type="button" class="btn btn-sm btn-primary pull-right"
                            onclick="openContactForm()">{{trans('funding_programmes.contactModal.new_contact_btn')}}</button>
                    <button id="existingContactsBtn" type="button" class="btn btn-sm btn-primary pull-right hidden"
                            onclick="openContactList()">{{trans('funding_programmes.contactModal.contact_list_btn')}}</button>
                    <h4 class="modal-title">{{trans('funding_programmes.contactModal.title')}}</h4>
                </div>
                <div class="modal-body">
                    <div id="existingContacts" style="max-height: 500px; overflow-y: scroll">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                @if (count($contacts) == 0)
                                    {{trans('funding_programmes.no_contact')}}
                                @endif
                                @foreach($contacts as $currentContact)
                                    <tr>
                                        <td>
                                            {{$currentContact->name}}<br/>
                                            @if ($currentContact->street || $currentContact->street_nr){{$currentContact->street}} {{$currentContact->street_nr}}<br/> @endif
                                            @if ($currentContact->zip_code != '' || $currentContact->city != '') {{$currentContact->zip_code}} {{$currentContact->city}}<br/> @endif
                                            @if ($currentContact->tel != ''){{trans('contacts.tel')}} {{$currentContact->tel}}<br/> @endif
                                            @if ($currentContact->fax != ''){{trans('contacts.fax')}} {{$currentContact->fax}}<br/> @endif
                                            @if ($currentContact->email != ''){{trans('contacts.email')}}: {{$currentContact->email}}<br/> @endif
                                            @if ($currentContact->internet != ''){{trans('contacts.internet')}}: {{$currentContact->internet}}<br/> @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-default pull-right"
                                                onclick="takeContact({{$currentContact}})">
                                                {{trans('layout.buttons.take')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="newContact" hidden>
                        <form id="contactForm" method="post" action="{{url('contacts/0/edit')}}">
                            @include('pages.contacts.form')
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="saveNewContactBtn" type="button" class="btn btn-primary hidden"
                        onclick="submitNewContact()">
                        {{trans('layout.buttons.save')}}
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('layout.buttons.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        autosize($('textarea'));

        $('.datepicker').datepicker({
            format: 'dd.mm.yyyy'
        });

        var openContactForm = function () {
            $('#existingContacts').hide();
            $('#existingContactsBtn').removeClass('hidden');
            $('#saveNewContactBtn').removeClass('hidden');
            $('#newContact').show();
            $('#newContactBtn').addClass('hidden');
        };
        var openContactList = function () {
            $('#existingContacts').show();
            $('#existingContactsBtn').addClass('hidden');
            $('#saveNewContactBtn').addClass('hidden');
            $('#newContact').hide();
            $('#newContactBtn').removeClass('hidden');
        };
        var submitNewContact = function () {
            var form = $('#contactForm');
            $('#error_list').html('').hide();
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(contact) {
                    var contact = jQuery.parseJSON(contact);
                    setContactToView(contact);
                    $('#contactModal').modal('toggle');
                },
                error: function (error) {
                    var errors = $.map($.parseJSON(error.responseText), function(el) { return el });
                    var errorList = '<ul>';
                    errors.forEach(function (err) {
                        errorList += '<li>'+err+'</li>';
                    });
                    errorList += '</ul>';
                    $('#error_list').html(errorList).show();
                    $('#contactModal').scrollTop(0);
                }
            });
        };
        var takeContact = function (contact) {
            setContactToView(contact);
            $('#contactModal').modal('toggle');
        };
        function setContactToView(contact) {
            $('#contactId').val(contact.id);
            var html = contact.name + '<br/>';
            if (contact.street || contact.street_nr) {
                html += contact.street + ' ' + contact.street_nr + '<br/>';
            }
            if (contact.zip_code || contact.city) {
                html += contact.zip_code + ' ' + contact.city + '<br/>';
            }
            if (contact.tel) {
                html += '{{trans('contacts.tel')}} '+ contact.tel+'<br/>';
            }
            if (contact.fax) {
                html += '{{trans('contacts.fax')}} '+ contact.fax+'<br/>';
            }
            if (contact.email) {
                html += '{{trans('contacts.email')}}: '+ contact.email+'<br/>';
            }
            if (contact.internet) {
                html += '{{trans('contacts.internet')}}: '+ contact.internet;
            }
            $('#selectedContact').html(html);
        }
    </script>
@stop