@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start all-sections
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="all-sections pt-20 pb-60">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="main-content news-category-content-area">
                        <div class="news-banner-area">
                            <div class="news-banner-wrapper">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-12 mb-30">
                                        <div class="news-video-area">
                                            <div class="live-news-blog">
                                                <iframe width="100%" height="400px" src="{{ $general->live_news_link }}" frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 ps-0 mb-30">
                    <div class="news-video-content-wrapper">
                        @lang('Live Stream') <i class="las la-angle-double-right"></i>
                        <h2 class="title">{{ __(@$general->live_news_title) }}</h2>
                        <p>{{ __(@$general->live_news_description) }}</p>
                    </div>
                </div>
            </div>
            <div class="news-blog-area pt-4 mt-30">
                <div class="row justify-content-center mb-30-none">

                    @forelse($videos as $video)
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="news-blog-item">
                                <div class="live-news-blog">
                                    <iframe width="100%" height="190px" src="{{ $video->video_link }}" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                    {{ $videos->links() }}
                </div>

            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End all-section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
