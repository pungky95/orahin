<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">@yield('subheader_title')</h3>
        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="{{route('home')}}" class="kt-subheader__breadcrumbs-home"><i
                        class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
        @yield('breadcrumb')
        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
        {{--                        <span class="kt-subheader__separator kt-subheader__separator--v"></span>--}}
        {{--                        <span class="kt-subheader__desc">#XRS-45670</span>--}}
        {{--                        <a href="#" class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">--}}
        {{--                            Add New--}}
        {{--                        </a>--}}
        <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
            <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
            <span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span><i class="flaticon2-search-1"></i></span>
									</span>
        </div>
    </div>
    <div class="kt-subheader__toolbar">
        @yield('content_action')
    </div>
</div>
