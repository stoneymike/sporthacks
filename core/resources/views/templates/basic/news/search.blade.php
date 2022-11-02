@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start all-sections
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="all-sections pt-20 pb-60">
        <div class="container">
            <div class="pt-4">
                <div class="row justify-content-center mb-30-none">

                    @forelse($search as $item)
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                            <div class="news-blog-item">
                                <div class="news-blog-thumb">
                                    <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}" alt="news-blog"></a>
                                </div>
                                <div class="news-blog-content">
                                    <h3 class="title"><a href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">
                            <div class="no-data-img">
                                <img src="{{asset($activeTemplateTrue.'images/no-data.png')}}" alt="images">
                            </div>
                            <h3>No result found</h3>
                        </div>
                    @endforelse

                    {{ $search->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End all-section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
