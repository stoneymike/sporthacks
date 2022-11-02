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
                            <h1 class="title text-center">{{ __(@$policy->data_values->title) }}</h1>
                            <div class="news-banner-content">
                                @php echo @$policy->data_values->details @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End all-section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
