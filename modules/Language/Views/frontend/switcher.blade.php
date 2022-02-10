@php
    $languages = \Modules\Language\Models\Language::getActive();
    $locale = session('website_locale',app()->getLocale());
@endphp
{{--Multi Language--}}
@if(!empty($languages) && setting_item('site_enable_multi_lang'))

        @foreach($languages as $language)
            @if($locale == $language->locale)
                <a href="#" data-toggle="" class="is_login" style="color: #47bac2">

                    {{$language->name}}
                </a>
            @endif
        @endforeach


    @foreach($languages as $language)
        @if($locale != $language->locale)
                <span>/</span>
                <a href="{{get_lang_switcher_url($language->locale)}}" class="is_login" style="color: #47bac2">

                    {{$language->name}}
                </a>

        @endif
    @endforeach
    <span>⠀⠀⠀</span>
@endif
{{--End Multi language--}}
