{{ csrf_field() }}
<div id="error_list" class="alert alert-danger" hidden>
</div>
<div class="form-group">
    <label>{{trans('contacts.name')}}*</label>
    <input name="name" class="form-control" value="{{isset($contact->name) ? $contact->name : ''}}" required>
</div>
<div class="form-group">
    <label>{{trans('contacts.street')}} / {{trans('contacts.street_nr')}}</label>
    <div class="row">
        <div class="col-md-8">
            <input name="street" class="form-control" value="{{isset($contact->street) ? $contact->street : ''}}">
        </div>
        <div class="col-md-4">
            <input name="street_nr" class="form-control" value="{{isset($contact->street_nr) ? $contact->street_nr : ''}}">
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{trans('contacts.zip_code')}} / {{trans('contacts.city')}}</label>
    <div class="row">
        <div class="col-md-4">
            <input name="zip_code" class="form-control" value="{{isset($contact->zip_code) ? $contact->zip_code : ''}}">
        </div>
        <div class="col-md-8">
            <input name="city" class="form-control" value="{{isset($contact->city) ? $contact->city : ''}}">
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{trans('contacts.tel')}}</label>
    <input name="tel" class="form-control"  value="{{isset($contact->tel) ? $contact->tel : ''}}">
</div>
<div class="form-group">
    <label>{{trans('contacts.fax')}}</label>
    <input name="fax" class="form-control"  value="{{isset($contact->fax) ? $contact->fax : ''}}">
</div>
<div class="form-group">
    <label>{{trans('contacts.email')}}</label>
    <input type="email" name="email" class="form-control"  value="{{isset($contact->email) ? $contact->email : ''}}">
</div>
<div class="form-group">
    <label>{{trans('contacts.internet')}}</label>
    <input name="internet" class="form-control"  value="{{isset($contact->internet) ? $contact->internet : ''}}">
</div>