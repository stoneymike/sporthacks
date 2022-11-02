<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->sitename(__($pageTitle)) }}</title>
    @include('partials.seo')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/fontawesome-all.min.css')}}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap.min.css')}}">
    <!-- ui css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/jquery-ui.css')}}">
    <!-- swipper css link -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/swiper.min.css')}}">
    <!-- line-awesome-icon css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/line-awesome.min.css')}}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/animate.css')}}">
    <!-- main style css link -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/style.css')}}">

    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color)}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
    @stack('style-lib')

    @stack('style')
</head>
<body>

@stack('fbComment')

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="preloader">
    <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320.041 506.2387">
        <path fill="#D1D3D4"
              d="M274.1353,144.6019c3.6118,6.2705,5.8447,13.333,5.8452,19.708v138.5635
        c5.5337,3.1953,10.5434,8.6777,14.1699,14.959l20.001-11.5469c3.6377,6.2891,5.8891,13.3828,5.8896,19.7832l-0.0405,124.1133
        c0.001,19.1289-13.4312,42.3935-29.9995,51.959c-7.7119,4.4531-14.7442,5.1533-20.0586,2.6992
        c-6.1035-2.8174-9.9414-9.793-9.9419-20.0196l0.0005-308.8964c-0.0005-6.3936-2.2466-13.4786-5.8779-19.7627L274.1353,144.6019z" />
        <path fill="#5982E2" d="M279.9805,302.8734c11.0679,6.3896,20.039,21.9306,20.04,34.709l-0.0195,124.1445
    c0.001,6.3769-4.4771,14.1318-10,17.3223c-5.5235,3.1875-9.999,0.6015-10.0005-5.7745L279.9805,302.8734z" />
        <path fill="#FFFFFF" d="M239.9609,141.2152c5.5303,3.1924,10.5367,8.6699,14.1622,14.9463c3.6313,6.2841,5.8774,13.3691,5.8779,19.7627
    l-0.0005,308.8964c0.0005,10.2266,3.8384,17.2022,9.9419,20.0196L20.001,360.6096C8.9546,354.2318-0.001,338.723,0.0005,325.9691
    L0,25.7459C-0.0015,12.9901,8.9541,7.8211,20.0005,14.1991L239.9609,141.2152z" />
        <path fill="#E6E7E8" d="M25.4805,1.4793c3.8398-2.1421,8.8027-2.1284,14.52,1.1729l219.9604,126.9487
    c5.5469,3.2022,10.5665,8.7022,14.1949,15.001l-20.0327,11.5596c-3.6255-6.2764-8.6319-11.7539-14.1622-14.9463L20.0005,14.1991
    c-5.48-3.1641-10.4458-3.4864-14.0581-1.4502L25.4805,1.4793z" />
        <path fill="#E6E7E8" d="M314.1514,306.3104c-3.6245-6.2676-8.6265-11.7363-14.1504-14.9258l-20-11.5469l-0.0205,23.0606
        c5.5337,3.1953,10.5434,8.6777,14.1699,14.959L314.1514,306.3104z" />
        <polygon class="image" points="140,195 220,241 220,341 140,295" />
        <line class="line line1" x1="40" y1="95" x2="220" y2="199" />
        <line class="line line2" x1="40" y1="141" x2="120" y2="187" />
        <line class="line line3" x1="40" y1="187" x2="120" y2="234" />
        <line class="line line4" x1="40" y1="234" x2="120" y2="280" />
        <line class="line line5" x1="40" y1="280" x2="220" y2="384" />
        <line class="line line6" x1="40" y1="326" x2="220" y2="430" />
    </svg>
</div>
<div class="w-100">
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Preloader
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Header
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @php
        $breaking_news_content = App\Models\Frontend::where('data_keys', 'breaking_news.element')->orderBy('id', 'Desc')->first();
    @endphp

    <div class="overlay"></div>
    <!-- Header -->
    <div class="breaking-news-area bg--base">
        <div class="container">
            <span class="breaking-news"><b> @if($breaking_news_content) @lang('Breaking News') @else @lang('Latest News') @endif : </b>

                @if($breaking_news_content)
                    <a href="{{ @$breaking_news_content->data_values->news_details_link }}" class="text-decoration-underline">
                        {{ shortDescription(@$breaking_news_content->data_values->heading, 100) }}
                    </a>
                @else
                    @if(request()->routeIs('home') && @$latestNews->first())
                        <a href="{{ route('news.details', [$latestNews->first()->id, slug($latestNews->first()->title)]) }}" class="text-decoration-underline">
                            {{ shortDescription(@$latestNews->first()->title, 100) }}
                        </a>
                    @endif
                @endif

            </span>
        </div>
    </div>
    <div class="sticky-header">
        <div class="header-middle bg--white">
            <div class="container">
                <div class="header-middle-area">
                    <div class="logo-area">
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="site-logo"></a>
                        </div>
                        <div class="news-date text--base">
                        <span>{{ date('l, F d, Y') }}</span>
                        </div>
                    </div>
                    <div class="header-promo">
                        @php
                            echo advertisements('728x90');
                        @endphp
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom bg--white">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo d-xl-none">
                        <a href="{{ route('home') }}">
                            <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="site-logo">
                        </a>
                    </div>
                    <div class="menu-area">
                        <div class="menu-close">
                            <i class="las la-times"></i>
                        </div>
                        <ul class="menu">
                            <li>
                                <a href="{{ route('home') }}">@lang('Home')</a>
                            </li>
                            @php
                                $categories = \App\Models\Category::active()->orderBy('serial')->whereHas('news', function ($q){
                                                    $q->active()->approved();
                                                });
                                $first10Categories = $categories->take(10)->get();

                                if($categories->count() <= 10){
                                    $otherCategories = [];
                                }else{
                                    $otherCategories = $categories->skip(10)->take($categories->count() - 10)->get();
                                }
                            @endphp
                            @forelse($first10Categories as $category)
                                <li><a href="{{ route('category.details', [$category->id, slug($category->name)]) }}">{{ $category->name }}</a></li>
                            @empty
                            @endforelse
                            @if(count($otherCategories) != 0)
                            <li>
                                <a href="#0">@lang('More')</a>
                                <ul class="submenu">
                                    @forelse($otherCategories as $category)
                                        <li><a href="{{ route('category.details', [$category->id, slug($category->name)]) }}">{{ $category->name }}</a></li>
                                    @empty
                                    @endforelse
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <form class="search-form" action="{{ route('search') }}">
                        <div class="d-flex align-items-center">
                            <div class="close-search">
                                <i class="las la-times"></i>
                            </div>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="@lang('Search Here')">
                                <button type="submit" class="btn--base cmn--btn"><i class="las la-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="search-bar">
                            <i class="las la-search"></i>
                        </div>
                        <div class="header-bar ms-md-3 me-3 d-xl-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header -->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Header
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Scroll-To-Top
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <a href="#" class="scrollToTop">
        <i class="las la-dot-circle"></i>
        <span>@lang('Top')</span>
    </a>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Scroll-To-Top
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    @if(!request()->routeIs('home'))
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start breadcrumb
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div class="breadcrumb-section">
            <div class="container">
                <div class="breadcrumb-area">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang($pageTitle)</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            End breadcrumb
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @endif


    @yield('content')
</div>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@php
    $footer_content = getContent('footer.content', true);
    $policy_pages = getContent('policy_pages.element');
    $social_icons = getContent('social_icon.element', false, null, true);

    $category_groups = App\Models\Category::active()
                                            ->orderBy('serial')
                                            ->whereHas('news', function ($q){
                                                $q->active()->approved();
                                            })
                                            ->take(8)
                                            ->get()
                                            ->chunk(4);
@endphp
<footer>
    <section class="footer-section pt-60">
        <div class="container">
            <div class="footer-top-area text-center">
                <div class="footer-logo">
                    <a href="{{ route('home') }}" class="site-logo"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="logo"></a>
                </div>
                <p>{{ __(@$footer_content->data_values->heading) }}</p>
            </div>
            <div class="footer-wrapper">
                <div class="footer-toggle"><span class="right-icon"></span><span class="title">@lang('Useful Links') </span></div>
                <div class="footer-bottom-area">
                    <div class="row mb-30-none">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                            <div class="footer-widget">
                                <h3 class="title">@lang('About Us')</h3>
                                <p>{{ __(@$footer_content->data_values->about) }}</p>
                            </div>
                        </div>
                        @forelse($category_groups as $categories)
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 mb-30">
                                <div class="footer-widget">
                                    <h3 class="title">@lang('Category')</h3>
                                    <ul class="footer-links">
                                        @forelse($categories as $category)
                                            <li><a href="{{ route('category.details', [$category->id, slug($category->name)]) }}">{{ __(@$category->name) }}</a></li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        @empty
                        @endforelse

                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 mb-30">
                            <div class="footer-widget">
                                <h3 class="title">@lang('Policies')</h3>
                                <ul class="footer-links">
                                    @forelse($policy_pages as $item)
                                        <li><a href="{{ route('policy.details', [$item->id, slug($item->data_values->title)]) }}">{{ __(@$item->data_values->title) }}</a></li>
                                    @empty
                                    @endforelse
                                    <li><a href="{{ route('contact') }}">@lang('Contact Us')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright-wrapper">
        <div class="container">
            <div class="copyright-area d-flex flex-wrap justify-content-between align-items-center">
                <div class="copyright">
                    <p>{{ __(@$footer_content->data_values->copyright) }}</p>
                </div>
                <div class="social-area">
                    <ul class="footer-social">
                        @foreach($social_icons as $item)
                            <li><a href="{{ @$item->data_values->url }}">@php echo @$item->data_values->social_icon @endphp</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

{{--Cookie--}}
@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp
@if(@$cookie->data_values->status && !session('cookie_accepted'))
    <section class="cookie-policy bg--dark">
        <div class="container">
           <div class="cookie-wrapper">
                <div class="cookie-cont text-white py-2">
                    <span>
                        @php echo str_limit(strip_tags(@$cookie->data_values->description), 170) @endphp
                    </span>
                    <a href="{{ @$cookie->data_values->link }}" class="text--base" target="_blank">@lang('Read more about cookies')</a>
                </div>
              <a href="#0" class="btn--base cookie-close btn-sm acceptPolicy py-2">@lang('Accept Policy')</a>
           </div>
        </div>
     </section>
@endif


<!-- jquery -->
<script src="{{asset($activeTemplateTrue.'js/jquery-3.6.0.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset($activeTemplateTrue.'js/bootstrap.bundle.min.js')}}"></script>
<!-- swipper js -->
<script src="{{asset($activeTemplateTrue.'js/swiper-bundle.min.js')}}"></script>
<!-- marquee js -->
<script src="{{asset($activeTemplateTrue.'js/jquery.marquee.min.js')}}"></script>
<!-- ui js -->
<script src="{{asset($activeTemplateTrue.'js/jquery-ui.js')}}"></script>
<!-- wow js file -->
<script src="{{asset($activeTemplateTrue.'js/wow.min.js')}}"></script>
<!-- main -->
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>

@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('partials.notify')


<script>
    (function ($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{route('home')}}/change/"+$(this).val() ;
        });

        //Cookie
        $(document).on('click', '.acceptPolicy', function () {
            $.ajax({
                url: "{{ route('cookie.accept') }}",
                method:'GET',
                success:function(data){
                    if (data.success){
                        $('.cookie-policy').addClass('d-none');
                        notify('success', data.success)
                    }
                },
            });
        });

        let navLink = $('.menu-area li a');
        let currentRoute = '{{ url()->current() }}';

        $.each(navLink, function(index, value) {
            if(value.href == currentRoute){
                $(value).addClass('active');
                $(value).closest('.menu-item-has-children').find('a').addClass('active');
            }
        });

    })(jQuery);
</script>

</body>
</html>
