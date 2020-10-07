@section('js')
    <script>
        const categorySelect = async () => {
            const $categorySelect = $('#category_id');
            await $categorySelect.select2({
                placeholder: 'Select category',
                width: '100%',
                ajax: {
                    url: '{{route('select2.category')}}',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response.results,
                            pagination: response.pagination
                        };
                    },
                    cache: true
                }
            });
            @if(isset($subcategory) || old('category_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.category')}}',
                data: {
                    selected_category: '{{isset($subcategory) ? $subcategory->category->id : old('category_id')}}'
                }
            }).then(function (result) {
                var option = new Option(result.text, result.id, true, true);
                $categorySelect.append(option).trigger('change');
                $categorySelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endisset
        };
        $(document).ready(function () {
            categorySelect();
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
                         style="background-image: url({{isset($subcategory->image) ? $subcategory->image : asset('media/users/100_1.jpg')}});"></div>
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
        <div class="form-group">
            <label class="form-control-label" for="category_id">@lang('Category')</label>
            <select class="form-control kt-select2 {{ $errors->has('category_id') ? 'is-invalid' : ''}}"
                    name="category_id" id="category_id">
            </select>
            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name"
                   placeholder="@lang('Subcategory name')"
                   value="{{isset($subcategory) ? $subcategory->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>

