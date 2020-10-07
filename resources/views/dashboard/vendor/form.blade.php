@section('css')
    <link href="{{asset('vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('js')
    <script src="{{asset('vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        const description = function () {
            $('#description').summernote({
                height: 150,
                placeholder: 'Bulletin description...'
            });
        };
        const customerSelect = async () => {
            const customerSelect = $('#customer_uid').select2({
                placeholder: 'Select Customer',
                width: '100%',
                ajax: {
                    url: "{{route('select2.customer')}}",
                    type: "GET",
                    dataType: "json",
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
            @if(isset($vendor->customer) || old('customer_uid'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.customer')}}',
                data: {
                    selected_customer: '{{isset( $vendor->customer->uid) ? $vendor->customer->uid : old('customer_uid')}}'
                }
            }).then(function (result) {
                const option = new Option(result.text, result.id, true, true);
                customerSelect.append(option).trigger('change');
                customerSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endif
        };
        const inputSelect2Address = async () => {
            const citySelect = $('#city_id').select2({
                placeholder: 'Select City',
                width: '100%'
            });
            const districtSelect = $('#district_id').select2({
                placeholder: 'Select District',
                width: '100%'
            });
            const villageSelect = $('#village_id').select2({
                placeholder: 'Select Village',
                width: '100%'
            });
            const provinceSelect = await $('#province_id').select2({
                placeholder: 'Select Province',
                width: '100%',
                ajax: {
                    url: "{{route('select2.province')}}",
                    type: "GET",
                    dataType: "json",
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
            }).on("select2:select", function (e) {
                const provinceId = e.params.data.id;
                citySelect.val(null).trigger('change');
                districtSelect.val(null).trigger('change');
                villageSelect.val(null).trigger('change');
                citySelect.select2({
                    placeholder: 'Select City',
                    width: '100%',
                    ajax: {
                        url: "{{route('select2.city')}}",
                        type: "GET",
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                province_id: provinceId,
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
            });
            await citySelect.on("select2:select", function (e) {
                const cityId = e.params.data.id;
                districtSelect.val(null).trigger('change');
                villageSelect.val(null).trigger('change');
                districtSelect.select2({
                    placeholder: 'Select District',
                    width: '100%',
                    ajax: {
                        url: "{{route('select2.district')}}",
                        type: "GET",
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                city_id: cityId,
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
            });
            await districtSelect.on("select2:select", function (e) {
                const districtId = e.params.data.id;
                villageSelect.val(null).trigger('change');
                villageSelect.select2({
                    placeholder: 'Select Village',
                    width: '100%',
                    ajax: {
                        url: "{{route('select2.village')}}",
                        type: "GET",
                        dataType: "json",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                district_id: districtId,
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
            });

            @if(isset($vendor) || old('province_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.province')}}',
                data: {
                    selected_province: '{{isset($vendor->address->province->id) ? $vendor->address->province->id : old('province_id')}}'
                }
            }).then(function (result) {
                const option = new Option(result.text, result.id, true, true);
                provinceSelect.append(option).trigger('change');
                provinceSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endif

                @if(isset($vendor) || old('city_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.city')}}',
                data: {
                    selected_city: '{{isset($vendor->address->city->id) ? $vendor->address->city->id : old('city_id')}}'
                }
            }).then(function (result) {
                const option = new Option(result.text, result.id, true, true);
                citySelect.append(option).trigger('change');
                citySelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endif

                @if(isset($vendor) || old('district_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.district')}}',
                data: {
                    selected_district: '{{isset($vendor->address->district->id) ? $vendor->address->district->id : old('district_id')}}'
                }
            }).then(function (result) {
                const option = new Option(result.text, result.id, true, true);
                districtSelect.append(option).trigger('change');
                districtSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endif

                @if(isset($vendor) || old('village_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.village')}}',
                data: {
                    selected_village: '{{isset($vendor->address->village->id) ? $vendor->address->village->id : old('village_id')}}'
                }
            }).then(function (result) {
                const option = new Option(result.text, result.id, true, true);
                villageSelect.append(option).trigger('change');
                villageSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endif
        };
        $(document).ready(function () {
            inputSelect2Address();
            description();
            customerSelect();
            new KTAvatar("id_card");
            new KTAvatar("id_card_with_customer");
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
                         style="background-image: url({{isset($vendor->logo) ? $vendor->logo : asset('media/users/100_1.jpg')}});"></div>
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
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">ID Card With Customer</label>
            <div class="col-lg-9 col-xl-6">
                <div class="kt-avatar kt-avatar--outline" id="id_card_with_customer">
                    <div class="kt-avatar__holder"
                         style="background-image: url({{isset($vendor->id_card_with_customer) ? $vendor->id_card_with_customer : asset('media/users/100_1.jpg')}});"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="ID Card With Customer"
                           data-original-title="Upload ID Card With Customer">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="id_card_with_customer" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                          data-original-title="Cancel upload ID Card With Customer">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
        </div>
        {!! $errors->first('id_card_with_customer', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label class="col-xl-3 col-lg-3 col-form-label">ID Card</label>
            <div class="col-lg-9 col-xl-6">
                <div class="kt-avatar kt-avatar--outline" id="id_card">
                    <div class="kt-avatar__holder"
                         style="background-image: url({{isset($vendor->id_card) ? $vendor->id_card : asset('media/users/100_1.jpg')}});"></div>
                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="ID Card"
                           data-original-title="Upload ID Card">
                        <i class="fa fa-pen"></i>
                        <input type="file" name="id_card" accept=".png, .jpg, .jpeg">
                    </label>
                    <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                          data-original-title="Cancel upload ID Card">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
            </div>
        </div>
        {!! $errors->first('id_card', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="national_identity_number">@lang('National Identity Number')</label>
            <input type="text" class="form-control {{ $errors->has('national_identity_number') ? 'is-invalid' : ''}}"
                   id="national_identity_number"
                   name="national_identity_number"
                   placeholder="@lang('National Identity Number')"
                   value="{{isset($vendor->national_identity_number) ? $vendor->national_identity_number : old('national_identity_number')}}">
            {!! $errors->first('national_identity_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="customer_uid">@lang('Customer')</label>
            <select class="form-control kt-select2 {{ $errors->has('customer_uid') ? 'is-invalid' : ''}}"
                    name="customer_uid" id="customer_uid">
            </select>
            {!! $errors->first('customer_uid', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name"
                   name="name"
                   placeholder="@lang('Vendor name')"
                   value="{{isset($vendor->name) ? $vendor->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="phone">@lang('Phone')</label>
            <input type="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : ''}}" id="email"
                   name="phone"
                   placeholder="@lang('+6281.....')"
                   value="{{isset($vendor->phone) ? $vendor->phone : old('phone')}}">
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12">Description</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea name="description"
                          id="description">{!! isset($vendor->description) ? $vendor->description : old('description') !!}</textarea>
                {!! $errors->first('description', '<div class="form-control-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="latitude">Latitude</label>
            <input type="text" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : ''}}" id="latitude"
                   name="latitude"
                   placeholder="Latitude"
                   value="{{isset($vendor) && $vendor->address()->exists() ? $vendor->address->latitude : old('latitude')}}">
            {!! $errors->first('latitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="longitude">Longitude</label>
            <input type="text" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : ''}}" id="latitude"
                   name="longitude"
                   placeholder="Longitude"
                   value="{{isset($vendor) && $vendor->address()->exists() ? $vendor->address->longitude : old('longitude')}}">
            {!! $errors->first('longitude', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="province_id">@lang('Province')</label>
            <select class="form-control kt-select2 {{ $errors->has('province_id') ? 'is-invalid' : ''}}"
                    name="province_id" id="province_id">
            </select>
            {!! $errors->first('province_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="city_id">@lang('City')</label>
            <select class="form-control kt-select2 {{ $errors->has('city_id') ? 'is-invalid' : ''}}"
                    name="city_id" id="city_id">
            </select>
            {!! $errors->first('city_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="district_id">@lang('District')</label>
            <select class="form-control kt-select2 {{ $errors->has('district_id') ? 'is-invalid' : ''}}"
                    name="district_id" id="district_id">
            </select>
            {!! $errors->first('district_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="village_id">@lang('Village')</label>
            <select class="form-control kt-select2 {{ $errors->has('village_id') ? 'is-invalid' : ''}}"
                    name="village_id" id="village_id">
            </select>
            {!! $errors->first('village_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group validated">
            <label class="form-control-label" for="street">@lang('Address')</label>
            <textarea
                class="form-control {{ $errors->has('street') ? 'is-invalid' : ''}}"
                name="street"
                placeholder="@lang('Street')"
                rows="5">{{ isset($vendor) && $vendor->address()->exists() ? $vendor->address->street : old('street')}}</textarea>
            {!! $errors->first('street', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
