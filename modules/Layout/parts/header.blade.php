<?php
$checkNotify = \Modules\Core\Models\NotificationPush::query();
if(is_admin()){
    $checkNotify->where(function($query){
        $query->where('data', 'LIKE', '%"for_admin":1%');
        $query->orWhere('notifiable_id', Auth::id());
    });
}else{
    $checkNotify->where('data', 'LIKE', '%"for_admin":0%');
    $checkNotify->where('notifiable_id', Auth::id());
}
$notifications = $checkNotify->orderBy('created_at', 'desc')->limit(5)->get();
$countUnread = $checkNotify->where('read_at', null)->count();
?>



<div class="bravo_header">
    <div class="{{$container_class ?? 'container'}}">
        <div class="content">
            <div class="header-left">


                <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
                    <img src="/uploads/demo/logo7.svg" alt="{{setting_item("site_title")}}" height="50px">
                </a>
                <div class="bravo-menu">
                    <?php generate_menu('primary') ?>
                </div>

            </div>

            <div class="header-right">


{{--                <div id="link-block" style="background-color: rgb(255, 255, 255); padding: 1rem; width: 80%; transform: translate(-50%, 0px); left: 50%; border: none; box-shadow: none; top: 20%;">--}}
{{--                    <a href="http://newsafar.uz" class="search-link active" style="color: rgb(30, 171, 174); filter: invert(49%) sepia(60%) saturate(539%) hue-rotate(132deg) brightness(102%) contrast(92%);">--}}
{{--                        <img src="http://newsafar.uz/icon/noun_guide.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Путеводитель</span>--}}
{{--                    </a>--}}
{{--                    <a href="http://newsafar.uz/hotel-main" class="search-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/bed.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Гостиницы</span>--}}
{{--                    </a>--}}
{{--                    <a href="http://newsafar.uz/tour-main" class="search-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/street-sign.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Туры</span>--}}
{{--                    </a>--}}
{{--                    <a href="http://newsafar.uz/gid-main" class="search-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/tour-guide1.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Гиды</span>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="search-link disabled-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/skoro1.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Скоро</span>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="search-link disabled-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/Контур 9350.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Скоро</span>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="search-link disabled-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/Сгруппировать 3321.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Скоро</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="search-link disabled-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/train-icon.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Скоро</span>--}}
{{--                    </a>--}}

{{--                    <a href="#" class="search-link disabled-link" style="color: rgb(255, 255, 255); filter: invert(45%) sepia(14%) saturate(528%) hue-rotate(215deg) brightness(100%) contrast(0%);">--}}
{{--                        <img src="http://newsafar.uz/icon/Сгруппировать 3323.svg" alt="" style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">--}}
{{--                        <span style="color: rgb(117, 111, 134); filter: invert(47%) sepia(15%) saturate(485%) hue-rotate(215deg) brightness(90%) contrast(84%);">Скоро</span>--}}
{{--                    </a>--}}

{{--                </div>--}}


                <div class="topbar-right">
                    <ul class="topbar-items">
                        @include('Core::frontend.currency-switcher')
                        @include('Language::frontend.switcher')
                        @if(!Auth::id())
                            <li class="login-item">
                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                            </li>
                            <li class="signup-item">
                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                            </li>
                        @else
                            <li class="dropdown-notifications dropdown p-0">
                                <a href="#" data-toggle="dropdown" class="is_login">
                                    <i class="fa fa-bell mr-2"></i>
                                    <span class="badge badge-danger notification-icon">{{$countUnread}}</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu overflow-auto notify-items dropdown-container dropdown-menu-right dropdown-large">
                                    <div class="dropdown-toolbar">
                                        <div class="dropdown-toolbar-actions">
                                            <a href="#" class="markAllAsRead">{{__('Mark all as read')}}</a>
                                        </div>
                                        <h3 class="dropdown-toolbar-title">{{__('Notifications')}} (<span class="notif-count">{{$countUnread}}</span>)</h3>
                                    </div>
                                    <ul class="dropdown-list-items p-0">
                                        @if(count($notifications)> 0)
                                            @foreach($notifications as $oneNotification)
                                                @php
                                                    $active = $class = '';
                                                    $data = json_decode($oneNotification['data']);

                                                    $idNotification = @$data->id;
                                                    $forAdmin = @$data->for_admin;
                                                    $usingData = @$data->notification;

                                                    $services = @$usingData->type;
                                                    $idServices = @$usingData->id;
                                                    $title = @$usingData->message;
                                                    $name = @$usingData->name;
                                                    $avatar = @$usingData->avatar;
                                                    $link = @$usingData->link;

                                                    if(empty($oneNotification->read_at)){
                                                        $class = 'markAsRead';
                                                        $active = 'active';
                                                    }
                                                @endphp
                                                <li class="notification {{$active}}">
                                                    <a class="{{$class}} p-0" data-id="{{$idNotification}}" href="{{$link}}">
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <div class="media-object">
                                                                    @if($avatar)
                                                                        <img class="image-responsive" src="{{$avatar}}" alt="{{$name}}">
                                                                    @else
                                                                        <span class="avatar-text">{{ucfirst($name[0])}}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                {!! $title !!}
                                                                <div class="notification-meta">
                                                                    <small class="timestamp">{{format_interval($oneNotification->created_at)}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="dropdown-footer text-center">
                                        <a href="{{route('core.notification.loadNotify')}}">{{__('View More')}}</a>
                                    </div>
                                </ul>
                            </li>
                            <li class="login-item dropdown">
                                <a href="#" data-toggle="dropdown" class="login">{{__("Hi, :name",['name'=>Auth::user()->getDisplayName()])}}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-user text-left">
                                    @if(empty( setting_item('wallet_module_disable') ))
                                        <li class="credit_amount">
                                            <a href="{{route('user.wallet')}}"><i class="fa fa-money"></i> {{__("Credit: :amount",['amount'=>auth()->user()->balance])}}</a>
                                        </li>
                                    @endif
                                    @if(is_vendor())
                                        <li class="menu-hr"><a href="{{route('vendor.dashboard')}}" class="menu-hr"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                                    @endif
                                    <li class="@if(is_vendor()) menu-hr @endif">
                                        <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                                    </li>
                                    @if(setting_item('inbox_enable'))
                                        <li class="menu-hr">
                                            <a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}
                                                @if($count = auth()->user()->unseen_message_count)
                                                    <span class="badge badge-danger">{{$count}}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endif
                                    <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                                    @if(is_admin())
                                        <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                                    @endif
                                    <li class="menu-hr">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                    </li>
                                </ul>
                                <form id="logout-form-topbar" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
                @if(!empty($header_right_menu))
                    <ul class="topbar-items">
                        @include('Core::frontend.currency-switcher')
                        @include('Language::frontend.switcher')
                        @if(!Auth::id())
                            <li class="login-item">
                                <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                            </li>
                            <li class="signup-item">
                                <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                            </li>
                        @else
                            <li class="login-item dropdown">
                                <a href="#" data-toggle="dropdown" class="is_login">
                                    @if($avatar_url = Auth::user()->getAvatarUrl())
                                        <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                                    @else
                                        <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                                    @endif
                                    {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu text-left">

                                    @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                                        <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                                    @endif
                                    <li class="@if(Auth::user()->hasPermissionTo('dashboard_vendor_access')) menu-hr @endif">
                                        <a href="{{route('user.profile.index')}}"><i class="icon ion-md-construct"></i> {{__("My profile")}}</a>
                                    </li>
                                    @if(setting_item('inbox_enable'))
                                    <li class="menu-hr"><a href="{{route('user.chat')}}"><i class="fa fa-comments"></i> {{__("Messages")}}</a></li>
                                    @endif
                                    <li class="menu-hr"><a href="{{route('user.booking_history')}}"><i class="fa fa-clock-o"></i> {{__("Booking History")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.change_password')}}"><i class="fa fa-lock"></i> {{__("Change password")}}</a></li>
                                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                                        <li class="menu-hr"><a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a></li>
                                    @endif
                                    <li class="menu-hr">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{__('Logout')}}</a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                @endif

                <button class="bravo-more-menu">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>

    </div>
    <div class="bravo-menu-mobile" style="display:none;">
        <div class="user-profile">
            <div class="b-close"><i class="icofont-scroll-left"></i></div>
            <div class="avatar"></div>
            <ul>






                @if(!Auth::id())
                    <li>
                        <a href="#login" data-toggle="modal" data-target="#login" class="login">{{__('Login')}}</a>
                    </li>
                    <li>
                        <a href="#register" data-toggle="modal" data-target="#register" class="signup">{{__('Sign Up')}}</a>
                    </li>
                @else
                    <li>
                        <a href="{{route('user.profile.index')}}">
                            <i class="icofont-user-suited"></i> {{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}
                        </a>
                    </li>
                    @if(Auth::user()->hasPermissionTo('dashboard_vendor_access'))
                        <li><a href="{{route('vendor.dashboard')}}"><i class="icon ion-md-analytics"></i> {{__("Vendor Dashboard")}}</a></li>
                    @endif
                    @if(Auth::user()->hasPermissionTo('dashboard_access'))
                        <li>
                            <a href="{{url('/admin')}}"><i class="icon ion-ios-ribbon"></i> {{__("Admin Dashboard")}}</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('user.profile.index')}}">
                            <i class="icon ion-md-construct"></i> {{__("My profile")}}
                        </a>
                    </li>
                    <li>
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class="fa fa-sign-out"></i> {{__('Logout')}}
                        </a>
                        <form id="logout-form-mobile" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                @endif
            </ul>
            <ul class="multi-lang">
                @include('Core::frontend.currency-switcher')
            </ul>
            <ul class="multi-lang">
                @include('Language::frontend.switcher')
            </ul>
        </div>
        <div class="g-menu">
            <?php generate_menu('primary') ?>
        </div>
    </div>
</div>
