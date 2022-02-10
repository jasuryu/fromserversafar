@extends('layouts.app')
@section('head')
    <link href="{{ asset('dist/frontend/module/hotel/css/hotel.css?_ver='.config('app.version')) }}"  rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}"/>
@endsection
@section('content')
    <div class="bravo_detail_hotel">
        @include('Hotel::frontend.layouts.details.hotel-banner')
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-9">

                        @php $review_score = $row->review_data @endphp
                        @include('Hotel::frontend.layouts.details.hotel-detail')
                        @include('Hotel::frontend.layouts.details.hotel-review')
                    </div>
                    <div class="col-md-12 col-lg-3" >
{{--                        @include('Tour::frontend.layouts.details.vendor')--}}
                    <style>
                        .vl {

                            margin-top: -15px;
                            border-left: 3px solid #47bac2;
                            height: 30px;
                            background: #47bac2;
                        }
                    </style>
                    @if($row->map_lat && $row->map_lng)
                        <div class="g-location" style="margin-top: 15px">
                            <div class="location-title">
                                <div class="vl"></div>
                                <h3 class="heading" style="
    padding-left: 15px !important;
    padding-top: 5px !important;
    padding-bottom: 10px !important;
    border-bottom: 1px  solid #e2e2e2 !important;



    position: relative !important;
    font-size: 18px !important;
    color: #767085 !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    margin-bottom: 15px !important;
">{{__("Location")}}
                                </h3>

                            </div>

                            <div class="location-map">
                                <div id="map_content"></div>
                            </div>


                            @if($translation->address)
                                <div class="address">
                                <i class="icofont-location-arrow"></i>
                                {{$translation->address}}
                        </div>
                    @endif
                </div>

                @endif

                        @include('Hotel::frontend.layouts.details.hotel-related-list')
                        <div class="g-all-attribute is_pc">
                            @include('Hotel::frontend.layouts.details.hotel-attributes')
                        </div>
                        @include('Hotel::frontend.layouts.details.hotel-form-enquiry')
                    </div>
                </div>
            </div>

        </div>
        @include('Hotel::frontend.layouts.details.hotel-form-enquiry-mobile')
    </div>
@endsection

@section('footer')
    {!! App\Helpers\MapEngine::scripts() !!}
    <script>
        jQuery(function ($) {
            @if($row->map_lat && $row->map_lng)
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [{{$row->map_lat}}, {{$row->map_lng}}],
                zoom:{{$row->map_zoom ?? "8"}},
                ready: function (engineMap) {
                    engineMap.addMarker([{{$row->map_lat}}, {{$row->map_lng}}], {
                        icon_options: {
                            iconUrl:"{{get_file_url(setting_item("hotel_icon_marker_map"),'full') ?? url('images/icons/png/pin.png') }}"
                        }
                    });
                }
            });
            @endif
        })
    </script>
    <script>
        var bravo_booking_data = {!! json_encode($booking_data) !!}
        var bravo_booking_i18n = {
			no_date_select:'{{__('Please select Start and End date')}}',
            no_guest_select:'{{__('Please select at least one guest')}}',
            load_dates_url:'{{route('space.vendor.availability.loadDates')}}',
            name_required:'{{ __("Name is Required") }}',
            email_required:'{{ __("Email is Required") }}',
        };
    </script>
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/fotorama/fotorama.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/sticky/jquery.sticky.js") }}"></script>
    <script type="text/javascript" src="{{ asset('module/hotel/js/single-hotel.js?_ver='.config('app.version')) }}"></script>
@endsection
