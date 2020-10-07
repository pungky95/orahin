@section('js')
    <script>
        const roleSelect = async () => {
            const $roleSelect = $("#role_id");
            await $roleSelect.select2({
                placeholder: 'Select role',
                width: '100%',
                ajax: {
                    url: '{{route('select2.role')}}',
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
            @if(isset($user) || old('role_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.role')}}',
                data: {
                    selected_role: '{{isset($user) ? $user->roles->first()->id : old('role_id')}}'
                }
            }).then(function (result) {
                var option = new Option(result.text, result.id, true, true);
                $roleSelect.append(option).trigger('change');
                $roleSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endisset
        };
        $(document).ready(function () {
            roleSelect();
        });
    </script>
@endsection
@include('dashboard.layouts.error')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="role_id">@lang('Role')</label>
            <select class="form-control kt-select2 {{ $errors->has('role_id') ? 'is-invalid' : ''}}"
                    name="role_id" id="role_id">
            </select>
            {!! $errors->first('role_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="name">@lang('Name')</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name"
                   placeholder="@lang('User name')" value="{{isset($user) ? $user->name : old('name')}}">
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="email">@lang('Email')</label>
            <input type="type" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="email"
                   name="email"
                   placeholder="@lang('Email')" value="{{isset($user) ? $user->email : old('email')}}">
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

</div>
