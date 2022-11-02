@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start all-sections
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="all-sections pt-20 pb-60">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-9 col-lg-8 mb-30">
                    <div class="main-content news-details-content">
                        <div class="news-banner-area">
                            <h1 class="title mb-2">{{ __(@$news->title) }}</h1>
                            <span class="mb-30">@lang('Date'): {{@$news->created_at->format('Y-m-d')}}</span>

                            <div class="news-banner-wrapper">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-12 mb-30">
                                        <div class="news-banner-thumb">
                                            <img src="{{ getImage(imagePath()['news']['path'].'/'.$news->image, imagePath()['news']['size']) }}" alt="news-banner">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="news-banner-content">
                                @php echo @$news->description @endphp

                                <div class="mt-4 text-center">
                                    <ul class="social-share">
                                        <li><a href="http://www.facebook.com/sharer.php?u={{urlencode(url()->current())}}&p[title]={{Str::slug($news->title)}}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="http://twitter.com/share?text={{Str::slug($news->title)}}&url={{urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="http://pinterest.com/pin/create/button/?url={{urlencode(url()->current()) }}&description={{Str::slug($news->title)}}"><i class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(url()->current()) }}&title={{Str::slug($news->title)}}"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                                <div class="mt-4">
                                    @php
                                        echo advertisements('980x90')
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="news-tab-area mt-30">
                            <div class="section-header section-header--style">
                                <h3 class="section-title">@lang('Leave Your Comments')</h3>
                            </div>
                            <div class="news-tab mb-30 text-center">
                                <div class="fb-comments" data-href="{{ route('news.details',[$news->id,slug($news->title)]) }}" data-numposts="5"></div>
                            </div>
                        </div>
                        <div class="news-blog-area news-small-blog-area">
                            <div class="news-blog-wrapper">
                                <div class="section-header section-header--style">
                                    <h3 class="section-title">@lang('Trending News')</h3>
                                </div>
                                <div class="row justify-content-center mb-30-none">

                                    @forelse($trending_news as $item)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                                            <div class="news-blog-item">
                                                <div class="news-blog-thumb">
                                                    <img src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}" alt="news-blog">
                                                </div>
                                                <div class="news-blog-content">
                                                    <h3 class="title"><a href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <aside class="aside-bar">
                        <div class="aside-inner">
                            <div class="widget mb-30">
                                <h3 class="widget-title widget-title--style">@lang('Top News')</h3>
                                <div class="widget-category-item news-small-blog-area mt-0 pt-0">
                                    <div class="widget-category-content">
                                        <ul class="small-news-list">
                                            @forelse($top_news as $item)
                                                <li class="small-single-news"><a href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 100) }}</a></li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="add-item mb-30">
                                @php
                                    echo advertisements('300x250')
                                @endphp
                            </div>
                            <div class="add-item mb-30">
                                @php
                                    echo advertisements('300x250')
                                @endphp
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="news-blog-area news-small-blog-area">
                <div class="section-header section-header--style">
                    <h3 class="section-title">@lang('Latest News')</h3>
                </div>
                <div class="row justify-content-center mb-30-none">

                    @forelse($latest_news as $item)
                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="news-blog-item">
                                <div class="news-blog-thumb">
                                    <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}" alt="news-blog"></a>
                                </div>
                                <div class="news-blog-content">
                                    <h3 class="title"><a href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a></h3>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End all-section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection

@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush

@push('style')
<style>
    .social-share li{
        display: inline-block;
    }
    .social-share li a{
            width: 35px;
            height: 35px;
            line-height: 35px;
            display: inline-block;
            text-align: center;
            border: 1px solid #e5e5e5;
            border-radius: 50%;
            color: black;
            font-size: 12px;
            transition: all 0.3s;
    }
    .social-share li a:hover, .social-share li a.active {
        background-color: #00A8FF;
        color:#fff;
    }
</style>
@endpush
@push('shareImage')
    {{--<!-- Google / Search Engine Tags -->--}}
    <meta itemprop="name" content="{{ __(@$news->title) }}">
    <meta itemprop="image" content="{{ getImage(imagePath()['news']['path'].'/'.$news->image, imagePath()['news']['size']) }}">

    {{--<!-- Facebook Meta Tags -->--}}
    <meta property="og:image" content="{{ getImage(imagePath()['news']['path'].'/'.$news->image, imagePath()['news']['size']) }}"/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ __(@$news->title) }}">
    <meta property="og:image:type" content="{{ getImage(imagePath()['news']['path'].'/'.$news->image, imagePath()['news']['size']) }}" />
    @php $social_image_size = explode('x', imagePath()['news']['size']) @endphp
    <meta property="og:image:width" content="{{ $social_image_size[0] }}" />
    <meta property="og:image:height" content="{{ $social_image_size[1] }}" />
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('style')
<style>
    .widget-title--style{
        border-top: none;
    }
</style>
@endpush
