@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start all-sections
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="all-sections pt-20 pb-60">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="main-content news-category-content-area">
                        <div class="news-banner-area">
                            <div class="news-banner-wrapper">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-8 col-lg-8 mb-30">
                                        <div class="news-banner-thumb">
                                            <a href="{{ route('news.details', [$first_cat_news->id, slug($first_cat_news->title)]) }}"><img src="{{ getImage(imagePath()['news']['path'].'/'.$first_cat_news->image, imagePath()['news']['size']) }}" alt="news-banner"></a>
                                        </div>
                                        <div class="news-banner-content">
                                            <h2 class="title"><a href="{{ route('news.details', [$first_cat_news->id, slug($first_cat_news->title)]) }}">{{ shortDescription(@$first_cat_news->title, 200) }}</a></h2>
                                            @php echo shortDescription(@$first_cat_news->short_description, 500) @endphp
                                        </div>
                                        <div class="mt-4">
                                            @php
                                                echo advertisements('728x90');
                                            @endphp
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 mb-30">
                                        <div class="news-banner-top-content">
                                            <h4 class="title">@lang('Latest News')</h4>
                                            <div class="widget">
                                                <ul class="small-news-list">

                                                    @forelse($latest_news as $item)
                                                        <li class="small-single-news">
                                                            <div class="thumb">
                                                                <a href="{{ route('news.details', [$item->id, slug($item->title)]) }}"><img src="{{ getImage(imagePath()['news']['path'].'/'.$item->image, imagePath()['news']['size']) }}" alt="item"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h5 class="title"><a href="{{ route('news.details', [$item->id, slug($item->title)]) }}">{{ __(@$item->title) }}</a></h5>
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
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30">
                    <aside class="aside-bar">
                        <div class="aside-inner">
                            <div class="add-item mb-30">
                                @php
                                    echo advertisements('300x250');
                                @endphp
                            </div>
                            <div class="add-item mb-30">
                                @php
                                    echo advertisements('300x250');
                                @endphp
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <div class="news-blog-area pt-4">
                <div class="section-header section-header--style">
                    <h3 class="section-title">@lang('More News')</h3>
                </div>
                <div class="row justify-content-center mb-30-none post_data">
                    {{ csrf_field() }}
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
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();
            var catId = {{ $category->id }}

            load_data('', _token, catId);

            function load_data(id="", _token, catId){
                $.ajax({
                    url:"{{ route('load.more') }}",
                    method:"POST",
                    data:{id:id, _token:_token, catId:catId, remove: {{ $removeDuplicate }} },
                    success:function(data){

                        var output = '';

                        $.each(data.output, function( index, row ) {
                            output +=`
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-30">
                                        <div class="news-blog-item">
                                            <div class="news-blog-thumb">
                                                <a href="#">
                                                    <img src="${row.photo}" alt="news-blog">
                                                </a>
                                            </div>
                                            <div class="news-blog-content">
                                                <h3 class="title">
                                                    <a href="{{ route('home') }}/news/${row.id}/${convertToSlug(row.title)}">
                                                        ${row.title}
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                            last_id = row.id;
                        });

                        output +=`<div class='header-add mb-4 text-center add'>${data.add}</div>`;

                        if(data.next != 0){
                            output +=`
                                    <div class="section-header text-center">
                                        <button class="btn--base load_more_button" data-id="${last_id}">Load More</button>
                                    </div>
                                    `;
                        }

                        $('.load_more_button').remove();
                        $('.post_data').append(output);
                    }
                })
            }

            $(document).on('click', '.load_more_button', function(){
                var id = $(this).data('id');
                $('.load_more_button').html('<b>Loading...</b>');
                load_data(id, _token, catId);
            });

            function convertToSlug(Text){
                return Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
            }

        });
    </script>
@endpush

@push('style')
<style>
    .news-blog-area{
        border-top: none;
    }
</style>
@endpush

