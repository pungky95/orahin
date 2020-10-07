@section('css')
    <link href="{{asset('vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('js')
    <script src="{{asset('vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
    <script>
        const activeDate = () => {
            const start = moment().add(1, 'days');

            $('#active_date').daterangepicker({
                buttonClasses: ' btn',
                applyClass: 'btn-primary',
                cancelClass: 'btn-secondary',
                @if($formMode =='create')
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
        }
        const description = function () {
            $('#description').summernote({
                height: 150,
                placeholder: 'Bulletin description...'
            });
        };
        const timePeriodSelect = async () => {
            const data = [
                {
                    id: 'Day',
                    text: "@lang('Day')"
                },
                {
                    id: 'Week',
                    text: "@lang('Week')"
                },
                {
                    id: 'Month',
                    text: "@lang('Month')"
                }
            ];
            const $timePeriodSelect = $('#time_period');
            await $timePeriodSelect.select2({
                placeholder: 'Select time period',
                width: '100%',
                data: data,
            });
                @if(isset($bulletin) || old('time_period'))
            const result = {
                    id: '{{isset($bulletin) ? $bulletin->time_period : old('time_period')}}',
                    text: '{{isset($bulletin) ? __($bulletin->time_period) : __(old('time_period'))}}'
                };
            const option = new Option(result.text, result.id, true, true);
            await $timePeriodSelect.val(result.id).trigger('change');
            @endif
        }
        const companySelect = async () => {
            const $companySelect = $("#company_id");
            await $companySelect.select2({
                placeholder: 'Select company',
                width: '100%',
                ajax: {
                    url: "{{route('select2.company')}}",
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
            @if(isset($bulletin) || old('company_id'))
                await $.ajax({
                type: 'GET',
                url: '{{route('select2.company')}}',
                data: {
                    selected_company: '{{isset($bulletin) ? $bulletin->company->id : old('company_id')}}'
                }
            }).then(function (result) {
                const option = new Option(result.text, result.id, true, true);
                $companySelect.append(option).trigger('change');
                $companySelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: result
                    }
                });
            });
            @endisset
        };
        $(document).ready(function () {
            description();
            companySelect();
            timePeriodSelect();
            activeDate();
        });
    </script>
@endsection
@include('dashboard.layouts.error')
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="company_id">@lang('Company')</label>
            <select class="form-control kt-select2 {{ $errors->has('company_id') ? 'is-invalid' : ''}}"
                    name="company_id" id="company_id">
            </select>
            {!! $errors->first('company_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="job_name">@lang('Job Name')</label>
            <input type="text" class="form-control {{ $errors->has('job_name') ? 'is-invalid' : ''}}" id="job_name"
                   name="job_name"
                   placeholder="@lang('Job Name')" value="{{isset($bulletin) ? $bulletin->job_name : old('job_name')}}">
            {!! $errors->first('job_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group validated">
            <label class="form-control-label" for="job_name">@lang('Active Date')</label>
            <div class='input-group pull-right' id='active_date'>
                <input value="{{isset($bulletin) ? $bulletin->active_date : old('active_date')}}" type="text" class="
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
            <label class="form-control-label" for="salary">@lang('Salary')</label>
            <input type="text" class="form-control price {{ $errors->has('salary') ? 'is-invalid' : ''}}" id="salary"
                   name="salary"
                   placeholder="@lang('Salary')"
                   value="{{isset($bulletin) ? $bulletin->salary : old('salary')}}">
            {!! $errors->first('salary', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label class="form-control-label" for="time_period">@lang('Time Period')</label>
            <select class="form-control kt-select2 {{ $errors->has('company_id') ? 'is-invalid' : ''}}"
                    name="time_period" id="time_period">
            </select>
            {!! $errors->first('time_period', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12">Content</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea name="description"
                          id="description">{!! isset($bulletin) ? $bulletin->description : old('description') !!}</textarea>
                {!! $errors->first('description', '<div class="form-control-feedback">:message</div>') !!}
            </div>
        </div>
    </div>
</div>
