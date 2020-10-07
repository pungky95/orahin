@section('js')
    <script>
        $(document).ready(function () {
            new KTAvatar("image");
        });
    </script>
@endsection
@include('dashboard.layouts.error')
<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">Image</label>
            <div class="col-lg-9 col-xl-6">
                <div class="kt-avatar kt-avatar--outline" id="image">
                    <div class="kt-avatar__holder"
                         style="background-image: url({{isset($category->image) ? $category->image : asset('media/users/100_1.jpg')}});"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="Image"
                           data-original-title="Upload">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="image" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="Image"
                          data-original-title="Cancel upload">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
        </div>
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name"
                   placeholder="@lang('Category name')" value="{{isset($category) ? $category->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
