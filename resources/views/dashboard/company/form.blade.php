@section('css')
    <link href="{{asset('vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('js')
    <script src="{{asset('vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        const description = function () {
            $('#description').summernote({
                height: 150,
                placeholder: 'Company description...'
            });
        }
        $(document).ready(function () {
            description();
            new KTAvatar("logo");
        });
    </script>
@endsection
@include('dashboard.layouts.error')
<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Logo</label>
            <div class="col-lg-9 col-xl-6">
                <div class="kt-avatar kt-avatar--outline" id="logo">
                    <div class="kt-avatar__holder"
                         style="background-image: url({{isset($company->logo) ? $company->logo : asset('media/users/100_1.jpg')}});"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                           data-original-title="Upload new Logo">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="logo" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="Logo"
                          data-original-title="Cancel upload new Logo">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
        </div>
        {!! $errors->first('logo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name"
                   placeholder="@lang('Company name')" value="{{isset($company) ? $company->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="website">@lang('Website')</label>
            <input type="text" class="form-control {{ $errors->has('website') ? 'is-invalid' : ''}}" id="website"
                   name="website"
                   placeholder="@lang('Company website')"
                   value="{{isset($company) ? $company->website : old('website')}}">
            {!! $errors->first('website', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12">Content</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea name="description"
                          id="description">{!! isset($company) ? $company->description : old('description') !!}</textarea>
                {!! $errors->first('description', '<div class="form-control-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
</div>
