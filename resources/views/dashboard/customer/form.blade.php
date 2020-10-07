@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            new KTAvatar("photo_profile");
        });
    </script>
@endsection
@include('dashboard.layouts.error')
<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Photo Profile</label>
            <div class="col-lg-9 col-xl-6">
                <div class="kt-avatar kt-avatar--outline" id="photo_profile">
                    <div class="kt-avatar__holder"
                         style="background-image: url({{isset($customer->photo_profile) ? $customer->photo_profile : asset('media/users/100_1.jpg')}});"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                           data-original-title="Upload new Photo Profile">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="photo_profile" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="Photo Profile"
                          data-original-title="Cancel upload new Photo Profile">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
        </div>
        {!! $errors->first('photo_profile', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name"
                   name="name"
                   placeholder="@lang('John')"
                   value="{{isset($customer->name) ? $customer->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="phone_number">@lang('Phone Number')</label>
            <input type="phone_number" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : ''}}"
                   id="phone_number"
                   name="phone_number"
                   placeholder="@lang('+62812843...')"
                   value="{{isset($customer->phone_number) ? $customer->phone_number : old('phone_number')}}">
            {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="email">@lang('Email')</label>
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email"
                   name="email"
                   placeholder="@lang('john@email.com')"
                   value="{{isset($customer->email) ? $customer->email : old('email')}}">
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="gender">@lang('Gender')</label>
            <select class="form-control kt-select2 {{ $errors->has('gender') ? 'is-invalid' : ''}}"
                    name="gender" id="gender">
                <option
                    value="Male" {{isset($customer->gender) && $customer->gender == 'Male' || old('gender') == 'Male' ? 'selected' : '' }}>
                    Male
                </option>
                <option value="Female">Female</option>
            </select>
            {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
