@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start marque
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="marque-section">
        <div class="container">
            <div class="top-news-ticker clearfix">
                <div class="title">
                    @lang("Latest News")
                </div>
                <div class="top-news-ticker-runner">
                    @foreach($latestNews as $item)
                        <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}" class="text-decoration-underline">{{ shortDescription(@$item->title, 50) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End marque
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start all-sections
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="all-sections pt-20 pb-60">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-6 col-lg-5 mb-30">
                    <div class="main-content">
                        @if($last_news)
                        <div class="news-banner-area">
                            <div class="news-banner-slider">
                                <div class="swiper-button-prev">
                                    <i class="fas fa-angle-left"></i>
                                </div>
                                <div class="swiper-button-next">
                                    <i class="fas fa-angle-right"></i>
                                </div>
                                <div class="swiper-wrapper">
                                    @forelse($latest_news_banner as $item)
                                        <div class="swiper-slide">
                                            <div class="news-banner-thumb">
                                                <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img
                                                        src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                        alt="news-banner"></a>
                                            </div>
                                            <div class="news-banner-content">
                                                <h2 class="title"><a
                                                        href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 100) }}</a>
                                                </h2>
                                                <p>{{ shortDescription(@$item->short_description, 300) }}</p>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="small-news-area">
                            <div class="row justify-content-center mb-30-none">

                                @forelse($trendings as $item)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                        <div class="small-news-item">
                                            <div class="small-news-thumb">
                                                <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img
                                                        src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                        alt="news-banner"></a>
                                            </div>
                                            <div class="small-news-content">
                                                <h4 class="title"><a
                                                        href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 100) }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                        @if($last_must_read)
                        <div class="news-banner-bottom-thumb mt-30">
                            <div class="news-banner-thumb">
                                <a href="{{ route('news.details', [$last_must_read->id, slug($last_must_read->title)]) }}"><img
                                        src="{{ getImage(imagePath()['news']['path'].'/'.$last_must_read->image, imagePath()['news']['size']) }}"
                                        alt="news-banner"></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="sidebar custom-sidebar">
                        <div class="news-tab mb-30">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="latest-tab" data-bs-toggle="tab"
                                            data-bs-target="#latest" type="button"
                                            role="tab" aria-controls="latest"
                                            aria-selected="true">@lang('Latest')</button>
                                    <button class="nav-link" id="read-tab" data-bs-toggle="tab" data-bs-target="#read"
                                            type="button"
                                            role="tab" aria-controls="read"
                                            aria-selected="false">@lang('Must Read')</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="latest" role="tabpanel"
                                     aria-labelledby="latest-tab">
                                    <div class="widget">
                                        <ul class="small-news-list">

                                            @forelse($latest_news as $item)
                                                <li class="small-single-news">
                                                    <div class="thumb">
                                                        <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img
                                                                src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                                alt="item"></a>
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="title"><a
                                                                href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a>
                                                        </h5>
                                                    </div>
                                                </li>
                                            @empty
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                                    <div class="widget">
                                        <ul class="small-news-list">

                                            @forelse($must_reads as $item)
                                                <li class="small-single-news">
                                                    <div class="thumb">
                                                        <img
                                                            src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                            alt="item">
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="title"><a
                                                                href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a>
                                                        </h5>
                                                    </div>
                                                </li>
                                            @empty
                                            @endforelse

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget mb-30">
                            <h3 class="widget-title">@lang('News Live')</h3>
                            <div class="live-thumb">
                                <iframe width="100%" height="200px" src="{{ $general->live_news_link }}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        @if($last_trending)
                        <div class="widget">
                            <h3 class="widget-title">@lang('Trending')</h3>
                            <div class="trending-item">
                                <div class="trending-thumb">
                                    <a href="{{ route('news.details', [$last_trending->id, slug($last_trending->title)]) }}"><img
                                            src="{{ getImage(imagePath()['news']['path'].'/'.$last_trending->image, imagePath()['news']['size']) }}"
                                            alt="news-banner"></a>
                                </div>
                                <div class="trending-content">
                                    <h4 class="title"><a
                                            href="{{ route('news.details', [$last_trending->id, slug($last_trending->title)]) }}">{{ shortDescription(@$last_trending->title, 100) }}</a>
                                    </h4>
                                    <p>{{ shortDescription(@$last_trending->short_description, 300) }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                    <aside class="aside-bar">
                        <div class="aside-inner">
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
                            <div class="widget">
                                <h3 class="widget-title">@lang('Archive')</h3>
                                <div id="datepicker"></div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            <div class="add-section ptb-30">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="add-thumb">
                            @php
                                echo advertisements('980x90')
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <div class="news-blog-area">
                <div class="row justify-content-center mb-30-none">

                   @forelse($first_four_categories as $cat)
                        @php
                            $cat_first_news = $cat->news()->latest()->first();
                        @endphp
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="news-blog-item">
                                <div class="news-blog-header">
                                    <span class="sub-title"><a
                                            href="{{ route('category.details', [$cat->id, slug($cat->name)]) }}">{{ __(@$cat->name) }} <i
                                                class="las la-angle-double-right"></i></a></span>
                                </div>
                                <div class="news-blog-thumb">
                                    <a href="{{ route('news.details', [$cat_first_news->id, slug($cat_first_news->title)]) }}"><img
                                            src="{{ getImage(imagePath()['news']['path'].'/'.$cat_first_news->image, imagePath()['news']['size']) }}"
                                            alt="news-blog"></a>
                                </div>
                                <div class="news-blog-content">
                                    <h3 class="title"><a
                                            href="{{ route('news.details', [$cat_first_news->id, slug($cat_first_news->title)]) }}">{{ __(@$cat_first_news->title) }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>

            <div class="live-news-blog-area">
                <div class="live-news-blog-wrapper">
                    <div class="section-header white">
                        <h3 class="section-title"><a href="{{ route('videos') }}">@lang('Video') <i
                                    class="las la-angle-double-right"></i></a></h3>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-6 mb-20-none">
                            <div class="live-news-blog">
                                <iframe width="100%" height="405px" src="{{ $general->live_news_link }}" frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 mb-20-none">
                            <div class="row justify-content-center">

                                @forelse($four_videos as $video)
                                    <div class="col-sm-6 mb-20">
                                        <div class="live-news-blog">
                                            <iframe width="100%" height="190px" src="{{ $video->video_link }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="news-blog-area news-small-blog-area">
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-9 col-lg-8 col-md-8 mb-30">
                        <div class="news-blog-wrapper">
                            <div class="row justify-content-center mb-30-none">

                                @forelse($trending_news as $item)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                                        <div class="news-blog-item">
                                            <div class="news-blog-thumb">
                                                <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img
                                                        src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                        alt="news-blog"></a>
                                            </div>
                                            <div class="news-blog-content">
                                                <h3 class="title"><a
                                                        href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                        <div class="sidebar custom-sidebar">
                            <div class="news-tab mb-30">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="more-tab" data-bs-toggle="tab"
                                                data-bs-target="#more"
                                                type="button" role="tab" aria-controls="more"
                                                aria-selected="true">@lang('More')</button>
                                        <button class="nav-link" id="popular-tab" data-bs-toggle="tab"
                                                data-bs-target="#popular" type="button"
                                                role="tab" aria-controls="popular"
                                                aria-selected="false">@lang('Most Popular')</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="more" role="tabpanel"
                                         aria-labelledby="more-tab">
                                        <div class="widget">
                                            <ul class="small-news-list">
                                                @forelse($more_trending_news as $item)
                                                    <li class="small-single-news"><a
                                                            href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 62) }}</a>
                                                    </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="popular" role="tabpanel"
                                         aria-labelledby="popular-tab">
                                        <div class="widget">
                                            <ul class="small-news-list">
                                                @forelse($most_popular as $item)
                                                    <li class="small-single-news"><a
                                                            href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 62) }}</a>
                                                    </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="photo-news-blog-area">
                <div class="section-header">
                    <h3 class="section-title"><a href="{{ route('photos') }}">@lang('Photos') <i
                                class="las la-angle-double-right"></i></a></h3>
                </div>
                <div class="row justify-content-center">
                    @if(@$photos[0])
                    <div class="col-xl-6 col-lg-6 mb-20-none">
                        <div class="photo-news-blog">
                            <a href="{{ route('news.details', [$photos[0]->id, slug($photos[0]->title)]) }}">
                                <img
                                    src="{{ getImage(imagePath()['news']['path'].'/'.$photos[0]->image, imagePath()['news']['size']) }}"
                                    alt="news-banner">
                                <h3 class="photo-news-title">{{ shortDescription(@$photos[0]->title, 100) }}</h3>
                                <span class="photo-badge"><i class="las la-photo-video"></i></span>
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="col-xl-6 col-lg-6 mb-20-none">
                        <div class="small-photo-news-blog">
                            <div class="row justify-content-center">
                                @if(@$photos[1])
                                <div class="col-sm-6 mb-20">
                                    <div class="photo-news-blog">
                                        <a href="{{ route('news.details', [$photos[1]->id, slug($photos[1]->title)]) }}">
                                            <img
                                                src="{{ getImage(imagePath()['news']['path'].'/'.$photos[1]->image, imagePath()['news']['size']) }}"
                                                alt="news-banner">
                                            <h3 class="photo-news-title">{{ shortDescription(@$photos[1]->title, 50) }}</h3>
                                            <span class="photo-badge"><i class="las la-photo-video"></i></span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if(@$photos[2])
                                <div class="col-sm-6 mb-20">
                                    <div class="photo-news-blog">
                                        <a href="{{ route('news.details', [$photos[2]->id, slug($photos[2]->title)]) }}">
                                            <img
                                                src="{{ getImage(imagePath()['news']['path'].'/'.$photos[2]->image, imagePath()['news']['size']) }}"
                                                alt="news-banner">
                                            <h3 class="photo-news-title">{{ shortDescription(@$photos[2]->title, 50) }}</h3>
                                            <span class="photo-badge"><i class="las la-photo-video"></i></span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if(@$photos[3])
                                <div class="col-sm-6 mb-20">
                                    <div class="photo-news-blog">
                                        <a href="{{ route('news.details', [$photos[3]->id, slug($photos[3]->title)]) }}">
                                            <img
                                                src="{{ getImage(imagePath()['news']['path'].'/'.$photos[3]->image, imagePath()['news']['size']) }}"
                                                alt="news-banner">
                                            <h3 class="photo-news-title">{{ shortDescription(@$photos[3]->title, 50) }}</h3>
                                            <span class="photo-badge"><i class="las la-photo-video"></i></span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if(@$photos[4])
                                <div class="col-sm-6 mb-20">
                                    <div class="photo-news-blog">
                                        <a href="{{ route('news.details', [$photos[4]->id, slug($photos[4]->title)]) }}">
                                            <img
                                                src="{{ getImage(imagePath()['news']['path'].'/'.$photos[4]->image, imagePath()['news']['size']) }}"
                                                alt="news-banner">
                                            <h3 class="photo-news-title">{{ shortDescription(@$photos[4]->title, 50) }}</h3>
                                            <span class="photo-badge"><i class="las la-photo-video"></i></span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news-category-area pb-30">
                @if(@$categories[0])
                <div class="section-header">
                    <h3 class="section-title"><a
                            href="{{ route('category.details', [$categories[0]->id, slug($categories[0]->name)]) }}">{{ __(@$categories[0]->name) }}
                            <i class="las la-angle-double-right"></i></a></h3>
                </div>

                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 mb-30">
                        <aside class="aside-bar">
                            <div class="aside-inner">
                                <div class="add-item mb-30">
                                    @php
                                        echo advertisements('300x250')
                                    @endphp
                                </div>
                                <div class="add-item">
                                    @php
                                        echo advertisements('300x250')
                                    @endphp
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 mb-30">
                        <div class="main-content">
                            @php
                                $first_cat_news = $categories[0]->news()->orderBy('id', 'desc')->first();
                            @endphp
                            <div class="news-banner-area">
                                <div class="news-banner-thumb">
                                    <a href="{{ route('news.details', [$first_cat_news->id, slug($first_cat_news->title)]) }}"><img
                                            src="{{ getImage(imagePath()['news']['path'].'/'.$first_cat_news->image, imagePath()['news']['size']) }}"
                                            alt="news-banner"></a>
                                </div>
                                <div class="news-banner-content news-banner-content--style">
                                    <h2 class="title"><a
                                            href="{{ route('news.details', [$first_cat_news->id, slug($first_cat_news->title)]) }}">{{ shortDescription(@$first_cat_news->title, 300) }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 mb-30">
                        <div class="sidebar custom-sidebar p-0 border-0">
                            <div class="widget">
                                <div class="widget-category-item news-small-blog-area mt-0 pt-0">
                                    @php
                                        $first_cat_2nd_news = $categories[0]->news()->orderBy('id', 'desc')->skip(1)->first();
                                    @endphp

                                    @if(@$first_cat_2nd_news)
                                        <div class="widget-category-thumb">
                                            <a href="{{ route('news.details', [$first_cat_2nd_news->id, slug($first_cat_2nd_news->title)]) }}"><img
                                                    src="{{ getImage(imagePath()['news']['path'].'/'.$first_cat_2nd_news->image, imagePath()['news']['size']) }}"
                                                    alt="news-banner"></a>
                                        </div>
                                        <div class="widget-category-content pt-10">
                                            <ul class="small-news-list">
                                                @php
                                                    $first_cat_6_news = $categories[0]->news()->orderBy('id', 'desc')->skip(2)->take(6)->get(['id', 'title']);
                                                @endphp
                                                @forelse($first_cat_6_news as $item)
                                                    <li class="small-single-news"><a
                                                            href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 62) }}</a>
                                                    </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if(@$categories[1])
            <div class="news-blog-area news-small-blog-area">
                <div class="section-header">
                    <h3 class="section-title"><a
                            href="{{ route('category.details', [$categories[1]->id, slug($categories[1]->name)]) }}">{{ __(@$categories[1]->name) }}
                            <i class="las la-angle-double-right"></i></a></h3>
                </div>
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-9 col-lg-8 col-md-8 mb-30">
                        <div class="news-blog-wrapper">
                            <div class="row justify-content-center mb-30-none">
                                @php
                                    $second_cat_8_news = $categories[1]->news()->orderBy('id', 'desc')->skip(1)->take(8)->get(['id', 'title', 'image']);
                                @endphp
                                @forelse($second_cat_8_news as $item)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                                        <div class="news-blog-item">
                                            <div class="news-blog-thumb">
                                                <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img
                                                        src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                        alt="news-blog"></a>
                                            </div>
                                            <div class="news-blog-content">
                                                <h3 class="title"><a
                                                        href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ shortDescription(@$item->title, 50) }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mb-30">
                        <div class="sidebar custom-sidebar">
                            <div class="widget">
                                @php
                                    $second_cat_1st_news = $categories[1]->news()->orderBy('id', 'desc')->first();
                                @endphp
                                <div class="widget-category-item news-small-blog-area mt-0 pt-0">
                                    <div class="widget-category-thumb">
                                        <a href="{{ route('news.details', [$second_cat_1st_news->id, slug($second_cat_1st_news->title)]) }}"><img
                                                src="{{ getImage(imagePath()['news']['path'].'/'.$second_cat_1st_news->image, imagePath()['news']['size']) }}"
                                                alt="news-banner"></a>
                                    </div>
                                    <div class="widget-category-content widget-category-content--style pt-10">
                                        <h4 class="title"><a
                                                href="{{ route('news.details', [$second_cat_1st_news->id, slug($second_cat_1st_news->title)]) }}">{{ shortDescription(@$second_cat_1st_news->title, 50) }}</a>
                                        </h4>
                                        <p>{{ shortDescription(@$second_cat_1st_news->short_description, 200) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(@$categories[2])
            <div class="news-category-area pb-30">
                <div class="section-header">
                    <h3 class="section-title"><a
                            href="{{ route('category.details', [$categories[2]->id, slug($categories[2]->name)]) }}">{{ __(@$categories[2]->name) }}
                            <i class="las la-angle-double-right"></i></a></h3>
                </div>
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-8 col-lg-6 col-md-6 mb-30">
                        <div class="main-content">
                            @php
                                $third_cat_1st_news = $categories[2]->news()->orderBy('id', 'desc')->first();
                            @endphp
                            <div class="news-banner-area">
                                <div class="news-banner-thumb">
                                    <a href="{{ route('news.details', [$third_cat_1st_news->id, slug($third_cat_1st_news->title)]) }}"><img
                                            src="{{ getImage(imagePath()['news']['path'].'/'.$third_cat_1st_news->image, imagePath()['news']['size']) }}"
                                            alt="news-banner"></a>
                                </div>
                                <div class="news-banner-content">
                                    <h2 class="title"><a
                                            href="{{ route('news.details', [$third_cat_1st_news->id, slug($third_cat_1st_news->title)]) }}">{{ __(@$third_cat_1st_news->title) }}</a>
                                    </h2>
                                    <p>{{ shortDescription(@$third_cat_1st_news->short_description, 500) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="sidebar custom-sidebar">
                            <div class="widget">
                                <ul class="small-news-list">
                                    @php
                                        $third_cat_4_news = $categories[2]->news()->orderBy('id', 'desc')->skip(1)->take(4)->get(['id', 'title', 'image']);
                                    @endphp

                                    @forelse($third_cat_4_news as $item)
                                        <li class="small-single-news">
                                            <div class="thumb">
                                                <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img
                                                        src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}"
                                                        alt="item"></a>
                                            </div>
                                            <div class="content">
                                                <h5 class="title"><a
                                                        href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a>
                                                </h5>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="add-section ptb-30">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="add-thumb">
                            @php
                                echo advertisements('980x90')
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            @if($after_four_categories)
            <div class="news-blog-area news-small-blog-area">
                <div class="row justify-content-center mb-30-none">

                    @forelse($after_four_categories->take(6) as $cat)
                        @php
                            $cat_first_news = $cat->news()->latest()->first();
                        @endphp
                        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="news-blog-item">
                                <div class="news-blog-header">
                                    <span class="sub-title"><a href="{{ route('category.details', [$cat->id, slug($cat->name)]) }}">{{ __(@$cat->name) }} <i class="las la-angle-double-right"></i></a></span>
                                </div>
                                <div class="news-blog-thumb">
                                    <a href="{{ route('news.details', [$cat_first_news->id, slug($cat_first_news->title)]) }}"><img src="{{ getImage(imagePath()['news']['path'].'/'.$cat_first_news->image, imagePath()['news']['size']) }}" alt="news-blog"></a>
                                </div>
                                <div class="news-blog-content">
                                    <h3 class="title"><a href="{{ route('news.details', [$cat_first_news->id, slug($cat_first_news->title)]) }}">{{ __(@$cat_first_news->title) }}</a></h3>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
            @endif
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End all-section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
@push('script')
    <script>
        //date
        $(function () {
            $("#datepicker").datepicker({
                onSelect: function(dateText, inst) {
                    window.location = "archive/" + dateText;
                },
                dateFormat: "dd-mm-yy"

            });
        });

        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    </script>
@endpush
