@section('css')
    <link href="{{asset('vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('js')
    <script src="{{asset('vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
    <script>
        const activeDate = () => {
            const start = moment().add(1, 'days');

            $('#active_date').daterangepicker({
                buttonClasses: ' btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary',
                @if($formMode == 'create')
                minDate: start,
                @endif
                ranges: {
                    '1 Week': [moment().add(1, 'days'), moment().add(7, 'days')],
                    '2 Week': [moment().add(1, 'days'), moment().add(14, 'days')],
                    '1 Month': [moment().add(1, 'days'), moment().add(30, 'days')],
                }
            }, function (start, end, label) {
                $('#active_date .form-control').val(start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
            });
        };
        const description = function () {
            $('#description').summernote({
                height: 150,
                placeholder: 'Bulletin description...'
            });
        };
        $(document).ready(function () {
            description();
            activeDate();
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
                         style="background-image: url({{isset($banner->image) ? $banner->image : asset('media/users/100_1.jpg')}});"></div>
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
        {!! $errors->first('logo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name"
                   name="name"
                   placeholder="@lang('Name')" value="{{isset($banner->name) ? $banner->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Active Date')</label>
            <div class='input-group pull-right' id='active_date'>
                <input value="{{isset($banner->active_date) ? $banner->active_date : old('active_date')}}" type="text"
                       class="
                       form-control"
                       name="active_date" readonly placeholder="Define active date"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                </div>
            </div>
            {!! $errors->first('active_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="link">@lang('Link')</label>
            <input type="text" class="form-control {{ $errors->has('link') ? 'is-invalid' : ''}}" id="link"
                   name="link"
                   placeholder="@lang('Link')"
                   value="{{isset($banner->link) ? $banner->link : old('link')}}">
            {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12">Content</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea name="description"
                          id="description">{!! isset($banner->description) ? $banner->description : old('description') !!}</textarea>
                {!! $errors->first('description', '<div class="form-control-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
</div>
