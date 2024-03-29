@extends('dashboard.layouts.main')
@section('title',__('Dashboard'))
@section('subheader_title','Dashboard')
@section('Home','kt-menu__item--active')
@section('js')
    <script src="{{asset('vendors/general/chart.js/dist/Chart.bundle.js')}}"
            type="text/javascript"></script>
    <script>
        "use strict";

        // Class definition
        var KTDashboard = function () {
            // Activities Charts.
            // Based on Chartjs plugin - http://www.chartjs.org/
            var activitiesChart = function () {
                if ($('#kt_chart_activities').length == 0) {
                    return;
                }

                var ctx = document.getElementById("kt_chart_activities").getContext("2d");

                var gradient = ctx.createLinearGradient(0, 0, 0, 240);
                gradient.addColorStop(0, Chart.helpers.color('#e14c86').alpha(1).rgbString());
                gradient.addColorStop(1, Chart.helpers.color('#e14c86').alpha(0.3).rgbString());

                var config = {
                    type: 'line',
                    data: {
                        labels: [@foreach($customers as $customer) "{{getMonthName($customer->month)}}", @endforeach],
                        datasets: [{
                            label: "Number Customer Registered",
                            backgroundColor: Chart.helpers.color('#e14c86').alpha(1).rgbString(),  //gradient
                            borderColor: '#e13a58',

                            pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                            pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                            pointHoverBackgroundColor: KTApp.getStateColor('light'),
                            pointHoverBorderColor: Chart.helpers.color('#ffffff').alpha(0.1).rgbString(),

                            //fill: 'start',
                            data: [
                                @foreach($customers as $customer) "{{$customer->subtotal}}", @endforeach
                            ]
                        }]
                    },
                    options: {
                        title: {
                            display: false,
                        },
                        tooltips: {
                            mode: 'nearest',
                            intersect: false,
                            position: 'nearest',
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        legend: {
                            display: false
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                display: false,
                                gridLines: false,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Month'
                                }
                            }],
                            yAxes: [{
                                display: false,
                                gridLines: false,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        elements: {
                            line: {
                                tension: 0.0000001
                            },
                            point: {
                                radius: 4,
                                borderWidth: 12
                            }
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 10,
                                bottom: 0
                            }
                        }
                    }
                };

                var chart = new Chart(ctx, config);
            }

            // Earnings Sliders
            var earningsSlide = function () {
                var carousel1 = $('#kt_earnings_widget .kt-widget30__head .owl-carousel');
                var carousel2 = $('#kt_earnings_widget .kt-widget30__body .owl-carousel');

                carousel1.find('.carousel').each(function (index) {
                    $(this).attr('data-position', index);
                });

                carousel1.owlCarousel({
                    rtl: KTUtil.isRTL(),
                    center: true,
                    loop: true,
                    items: 2
                });

                carousel2.owlCarousel({
                    rtl: KTUtil.isRTL(),
                    items: 1,
                    animateIn: 'fadeIn(100)',
                    loop: true
                });

                $(document).on('click', '.carousel', function () {
                    var index = $(this).attr('data-position');
                    if (index) {
                        carousel1.trigger('to.owl.carousel', index);
                        carousel2.trigger('to.owl.carousel', index);
                    }
                });

                carousel1.on('changed.owl.carousel', function () {
                    var index = $(this).find('.owl-item.active.center').find('.carousel').attr('data-position');
                    if (index) {
                        carousel2.trigger('to.owl.carousel', index);
                    }
                });

                carousel2.on('changed.owl.carousel', function () {
                    var index = $(this).find('.owl-item.active.center').find('.carousel').attr('data-position');
                    if (index) {
                        carousel1.trigger('to.owl.carousel', index);
                    }
                });
            }

            return {
                // Init demos
                init: function () {
                    // init charts
                    activitiesChart();

                    // demo loading
                    var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
                    loading.show();

                    setTimeout(function () {
                        loading.hide();
                    }, 3000);
                }
            };
        }();

        // Class initialization on page load
        jQuery(document).ready(function () {
            KTDashboard.init();
        });
    </script>
@endsection
@section('content')

    <!--Begin::Section-->
    <div class="row">
        <div class="col-12">
            <!--begin:: Widgets/Activity-->
            <div
                class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            @lang('Registered Customers') {{date('Y')}}
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-widget17">
                        <div
                            class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides"
                            style="background-color: #fd397a">
                            <div class="kt-widget17__chart" style="height:320px;">
                                <canvas id="kt_chart_activities"></canvas>
                            </div>
                        </div>
                        {{--                        <div class="kt-widget17__stats">--}}
                        {{--                            <div class="kt-widget17__items">--}}
                        {{--                                <div class="kt-widget17__item">--}}
                        {{--                                    <span class="kt-widget17__icon">--}}
                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                             xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1"--}}
                        {{--                                             class="kt-svg-icon kt-svg-icon--brand">--}}
                        {{--                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                                <rect id="bound" x="0" y="0" width="24" height="24"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"--}}
                        {{--                                                    id="Combined-Shape" fill="#000000"/>--}}
                        {{--                                                <rect id="Rectangle-Copy-2" fill="#000000" opacity="0.3"--}}
                        {{--                                                      transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "--}}
                        {{--                                                      x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>--}}
                        {{--                                            </g>--}}
                        {{--                                        </svg>--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__subtitle">--}}
                        {{--                                        @lang('Payment Reminder') <span--}}
                        {{--                                            class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">@lang('This Month')</span>--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__desc">--}}
                        {{--                                        {{$reminderSents}} @lang('Reminder Sent')--}}
                        {{--                                    </span>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="kt-widget17__item">--}}
                        {{--                                    <span class="kt-widget17__icon">--}}
                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                             xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1"--}}
                        {{--                                             class="kt-svg-icon kt-svg-icon--success">--}}
                        {{--                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                                <polygon id="Bound" points="0 0 24 0 24 24 0 24"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"--}}
                        {{--                                                    id="Shape" fill="#000000" fill-rule="nonzero"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"--}}
                        {{--                                                    id="Path" fill="#000000" opacity="0.3"/>--}}
                        {{--                                            </g>--}}
                        {{--                                        </svg>--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__subtitle">--}}
                        {{--                                        Penjualan--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__desc">--}}
                        {{--                                        {{$purchases}} Unit Terjual--}}
                        {{--                                    </span>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="kt-widget17__items">--}}
                        {{--                                <div class="kt-widget17__item">--}}
                        {{--                                    <span class="kt-widget17__icon">--}}
                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                             xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1"--}}
                        {{--                                             class="kt-svg-icon kt-svg-icon--warning">--}}
                        {{--                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                                <rect id="bound" x="0" y="0" width="24" height="24"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"--}}
                        {{--                                                    id="Combined-Shape" fill="#000000" opacity="0.3"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"--}}
                        {{--                                                    id="Combined-Shape" fill="#000000"/>--}}
                        {{--                                            </g>--}}
                        {{--                                        </svg>--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__subtitle">--}}
                        {{--                                        Email Blast <span--}}
                        {{--                                            class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Bulan--}}
                        {{--                                            Ini</span>--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__desc">--}}
                        {{--                                        {{$marketingBlastEmails}} Email Blast Telah Dikirim--}}
                        {{--                                    </span>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="kt-widget17__item">--}}
                        {{--                                    <span class="kt-widget17__icon">--}}
                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                             xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1"--}}
                        {{--                                             class="kt-svg-icon kt-svg-icon--danger">--}}
                        {{--                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                                <rect id="bound" x="0" y="0" width="24" height="24"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"--}}
                        {{--                                                    id="Combined-Shape" fill="#000000" opacity="0.3"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"--}}
                        {{--                                                    id="Rectangle-102-Copy" fill="#000000"/>--}}
                        {{--                                            </g>--}}
                        {{--                                        </svg>--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__subtitle">--}}
                        {{--                                        Pembayaran--}}
                        {{--                                    </span>--}}
                        {{--                                    <span class="kt-widget17__desc">--}}
                        {{--                                        {{$customerPaids}} Cicilan Terbayar--}}
                        {{--                                    </span>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Activity-->
        </div>
    </div>

    <!--End::Section-->
    <!--Begin::Section-->
    {{--    <div class="row">--}}
    {{--        <div class="col-lg-6">--}}
    {{--            <!--begin:: Widgets/Support Tickets -->--}}
    {{--            <div class="kt-portlet kt-portlet--height-fluid">--}}
    {{--                <div class="kt-portlet__head">--}}
    {{--                    <div class="kt-portlet__head-label">--}}
    {{--                        <h3 class="kt-portlet__head-title">--}}
    {{--                            Pembayaran Cicilan Menunggak--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                    <div class="kt-portlet__head-toolbar">--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="kt-portlet__body">--}}
    {{--                    <div class="kt-widget3">--}}
    {{--                        @foreach($customerOverDues as $customerOverDue)--}}
    {{--                            <div class="kt-widget3__item">--}}
    {{--                                <div class="kt-widget3__header">--}}
    {{--                                    <div class="kt-widget3__info">--}}
    {{--                                        <a href="{{route('customer.show',['id'=>$customerOverDue->id])}}"--}}
    {{--                                           class="kt-widget3__username">--}}
    {{--                                            {{$customerOverDue->name}}--}}
    {{--                                        </a>--}}
    {{--                                    </div>--}}
    {{--                                    <span class="kt-widget3__status kt-font-danger">--}}
    {{--                                        {{formatCurrency($customerOverDue->subtotal)}}--}}
    {{--                                    </span>--}}
    {{--                                </div>--}}
    {{--                                <div class="kt-widget3__body">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <!--end:: Widgets/Support Tickets -->--}}
    {{--        </div>--}}
    {{--        <div class="col-lg-6">--}}
    {{--            <div class="kt-portlet kt-portlet--height-fluid">--}}
    {{--                <div class="kt-portlet__head">--}}
    {{--                    <div class="kt-portlet__head-label">--}}
    {{--                        <h3 class="kt-portlet__head-title">--}}
    {{--                            Pembayaran Terbaru--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                    <div class="kt-portlet__head-toolbar">--}}
    {{--                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab11_content" role="tab"--}}
    {{--                                   aria-selected="true">--}}
    {{--                                    Hari Ini--}}
    {{--                                </a>--}}
    {{--                            </li>--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link" data-toggle="tab" href="#kt_widget4_tab12_content" role="tab"--}}
    {{--                                   aria-selected="false">--}}
    {{--                                    Minggu Ini--}}
    {{--                                </a>--}}
    {{--                            </li>--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="kt-portlet__body">--}}
    {{--                    <div class="tab-content">--}}
    {{--                        <div class="tab-pane active" id="kt_widget4_tab11_content">--}}
    {{--                            <div class="kt-scroll ps ps--active-y" data-scroll="true" data-height="400"--}}
    {{--                                 style="height: 400px; overflow: hidden;">--}}
    {{--                                <div class="kt-list-timeline">--}}
    {{--                                    @foreach($customerPaidTodays as $customerPaidToday)--}}
    {{--                                        <div class="kt-list-timeline__items">--}}
    {{--                                            <div class="kt-list-timeline__item">--}}
    {{--                                                <span--}}
    {{--                                                    class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
    {{--                                                <span--}}
    {{--                                                    class="kt-list-timeline__text">{{$customerPaidToday->purchase->customer->name.' ('.$customerPaidToday->purchase->unit.')' }}</span>--}}
    {{--                                                <span--}}
    {{--                                                    class="kt-list-timeline__time">{{timeElapsedString($customerPaidToday->updated_at)}}</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    @endforeach--}}
    {{--                                </div>--}}
    {{--                                <div class="ps__rail-x" style="left: 0px; bottom: -1px;">--}}
    {{--                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>--}}
    {{--                                </div>--}}
    {{--                                <div class="ps__rail-y" style="top: 1px; height: 400px; right: 0px;">--}}
    {{--                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 284px;"></div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="tab-pane" id="kt_widget4_tab12_content">--}}
    {{--                            <div class="kt-scroll ps" data-scroll="true" data-height="400"--}}
    {{--                                 style="height: 400px; overflow: hidden;">--}}
    {{--                                <div class="kt-list-timeline">--}}
    {{--                                    <div class="kt-list-timeline__items">--}}
    {{--                                        @foreach($customerPaidThisWeeks as $customerPaidThisWeek)--}}
    {{--                                            <div class="kt-list-timeline__items">--}}
    {{--                                                <div class="kt-list-timeline__item">--}}
    {{--                                                    <span--}}
    {{--                                                        class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>--}}
    {{--                                                    <span--}}
    {{--                                                        class="kt-list-timeline__text">{{$customerPaidThisWeek->purchase->customer->name.' ('.$customerPaidThisWeek->purchase->unit.')'}}</span>--}}
    {{--                                                    <span--}}
    {{--                                                        class="kt-list-timeline__time">{{timeElapsedString($customerPaidThisWeek->updated_at)}}</span>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        @endforeach--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">--}}
    {{--                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>--}}
    {{--                                </div>--}}
    {{--                                <div class="ps__rail-y" style="top: 0px; right: 0px;">--}}
    {{--                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <!--End::Section-->

@endsection
