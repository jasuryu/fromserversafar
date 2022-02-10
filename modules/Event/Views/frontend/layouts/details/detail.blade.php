<?php
/**
 * @var $translation \Modules\Event\Models\EventTranslation
 * @var $row \Modules\Event\Models\Event
 */
?>
<div class="g-header">
    <div class="left">
        <h1>{!! clean($translation->title) !!}</h1>
        @if($translation->address)
            <p class="address"><i class="fa fa-map-marker"></i>
                {{$translation->address}}
            </p>
        @endif
    </div>
    <div class="right">
        @if($row->getReviewEnable())
            @if($review_score)
                <div class="review-score">
                    <div class="head">
                        <div class="left">
                            <span class="head-rating">{{$review_score['score_text']}}</span>
                            <span class="text-rating">{{__("from :number reviews",['number'=>$review_score['total_review']])}}</span>
                        </div>
                        <div class="score">
                            {{$review_score['score_total']}}<span>/5</span>
                        </div>
                    </div>
                    <div class="foot">
                        {{__(":number% of guests recommend",['number'=>$row->recommend_percent])}}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>



<div class="row">
@if($translation->content)
    <div class="g-overview col-md-8 flex-row">
        <h3>{{__("Description")}}</h3>
        <div class="description">
        <img src="{{$row->getBannerImageUrlAttribute('full')}}" style=" width: 15em; height: 10em !important; margin: 10px; margin-left: 0px;margin-top: 0px;" class="float-left thumb">
{{--        @if($row->banner_image_id)--}}
{{--            <div class="bravo_banner flex" style=" width: 15em; height: 10em !important; background-image: url('{{$row->getBannerImageUrlAttribute('full')}}')">--}}
{{--                <div class="container ">--}}
{{--                    <div class="bravo_gallery flex-row flex-column">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
            <?php echo $translation->content ?>
        </div>

    </div>
@endif
@if($row->map_lat && $row->map_lng)
    <div class="g-location col-md-4" >
        <h3>{{__("Location")}}   </h3>
        <a href="https://maps.google.com/maps?q={{$row->map_lat .' ,'. $row->map_lng}}&z=16" >Открыть на карте</a>
{{--        https://maps.google.com/maps?q=40.538871215242544,70.95225692818664&z=16--}}
        <div class="location-map" >
            <div id="map_content" style="height: 200px"></div>
        </div>
    </div>
@endif
</div>
@include('Event::frontend.layouts.details.attributes')
@if($translation->faqs)
<div class="g-faq">
    <h3> {{__("FAQs")}} </h3>
    @foreach($translation->faqs as $item)
        <div class="item">
            <div class="header">
                <i class="field-icon icofont-support-faq"></i>
                <h5>{{$item['title']}}</h5>
                <span class="arrow"><i class="fa fa-angle-down"></i></span>
            </div>
            <div class="body">
                {{$item['content']}}
            </div>
        </div>
    @endforeach
</div>
@endif
{{--<div class="bravo-hr"></div>--}}
{{--@includeIf("Hotel::frontend.layouts.details.hotel-surrounding")--}}
{{--<div class="bravo-hr"></div>--}}

