@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start all-sections
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="all-sections pt-20 pb-60">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-9 col-lg-8 mb-30">
                    <div class="main-content news-category-content-area">
                        <div class="news-banner-area">
                            <div class="news-banner-wrapper">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-12 mb-30">
                                        <div class="news-gallery-area">
                                            <div class="section-header white">
                                                <h3 class="section-title">@lang('Photo Gallery')</h3>
                                            </div>
                                            <div class="news-gallery-slider">
                                                <div class="swiper-wrapper">

                                                    @forelse($photos as $photo)
                                                        <div class="swiper-slide">
                                                            <div class="news-gallery-banner">
                                                                <a href="{{ route('news.details', [$photo->id, slug($photo->title)]) }}"><img src="{{ getImage(imagePath()['news']['path'].'/'.$photo->image, imagePath()['news']['size']) }}" alt="news-banner"></a>
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse

                                                </div>
                                            </div>
                                            <div thumbsSlider="" class="news-gallery-small-slider mt-20">
                                                <div class="swiper-wrapper">

                                                    @forelse($photos as $photo)
                                                        <div class="swiper-slide">
                                                            <div class="news-gallery-small-banner">
                                                                <a href="#0"><img src="{{ getImage(imagePath()['news']['path'].'/'.$photo->image, imagePath()['news']['size']) }}" alt="news-banner"></a>
                                                            </div>
                                                        </div>
                                                    @empty
                                                    @endforelse

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30">
                    <aside class="aside-bar">
                        <div class="aside-inner">
                            <div class="add-item">
                                @php
                                    echo advertisements('300x600')
                                @endphp
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
                                echo advertisements('980x120')
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <div class="news-blog-area pt-4 mt-30">
                <div class="row justify-content-center mb-30-none">

                    @forelse($photos as $photo)
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="news-blog-item">
                                <div class="news-blog-thumb">
                                    <a href="{{ route('news.details', [$photo->id, slug($photo->title)]) }}">
                                        <img src="{{ getImage(imagePath()['news']['path'].'/'.$photo->image, imagePath()['news']['size']) }}" alt="news-blog">
                                        <span class="photo-badge"><i class="las la-photo-video"></i></span>
                                    </a>
                                </div>
                                <div class="news-blog-content">
                                    <h3 class="title"><a href="{{ route('news.details', [$photo->id, slug($photo->title)]) }}">{{ __(@$photo->title) }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                    {{ $photos->links() }}
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End all-section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection

@push('script')
    <script>
        var swiper = new Swiper(".news-gallery-small-slider", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".news-gallery-slider", {
            loop: true,
            spaceBetween: 0,
            effect: 'fade',
            navigation: {
                nextEl: '.slider-next',
                prevEl: '.slider-prev',
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endpush
