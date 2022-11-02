@extends($activeTemplate.'layouts.frontend')

@section('content')
    @php
        $contact_us_content = getContent('contact_us.content', true);
    @endphp
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Map
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="map-section">
        <div class="h-100 w-100 map-area">
            <iframe src = "https://maps.google.com/maps?q={{ @$contact_us_content->data_values->latitude }},{{ @$contact_us_content->data_values->longitude }}&hl=es;z=14&amp;output=embed"></iframe>
        </div>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Map
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Contact
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="contact-section pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-9">
                    <div class="contact-wrapper">
                        <div class="row m-0">
                            <div class="col-xl-8 col-lg-12 p-0">
                                <div class="contact-form-area">
                                    <h3 class="title">{{ __(@$contact_us_content->data_values->title_1) }}</h3>
                                    <p>{{ __(@$contact_us_content->data_values->short_details_1) }}</p>
                                    <form class="contact-form" method="post" action="">
                                        @csrf

                                        <div class="row justify-content-center mb-10-none">
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input name="name" type="text" placeholder="@lang('Your Name')" class="form--control" value="{{ old('name') }}" required>
                                            </div>
                                            <div class="col-lg-6 col-md-6 form-group">
                                                <input name="email" type="text" placeholder="@lang('Enter E-Mail Address')" class="form--control" value="{{ old('name') }}" required>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form--control" value="{{old('subject')}}" required>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <textarea name="message" wrap="off" placeholder="@lang('Write your message')" class="form-control">{{old('message')}}</textarea>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <button type="submit" class="submit-btn mt-20">@lang('Send Message')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 p-0">
                                <div class="contact-info-item-area">
                                    <div class="contact-info-item-inner mb-30-none">
                                        <div class="contact-info-header mb-30">
                                            <h3 class="header-title">{{ __(@$contact_us_content->data_values->title_2) }}</h3>
                                            <p>{{ __(@$contact_us_content->data_values->short_details_2) }}</p>
                                        </div>
                                        <div class="contact-info-item d-flex flex-wrap align-items-center mb-40">
                                            <div class="contact-info-icon">
                                                <i class="fas fa fa-map-marker-alt"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h3 class="title">@lang('Address')</h3>
                                                <p>{{ __(@$contact_us_content->data_values->address) }}</p>
                                            </div>
                                        </div>
                                        <div class="contact-info-item d-flex flex-wrap align-items-center mb-40">
                                            <div class="contact-info-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h3 class="title">@lang('Email Address')</h3>
                                                <p>{{ __(@$contact_us_content->data_values->email) }}</p>
                                            </div>
                                        </div>
                                        <div class="contact-info-item d-flex flex-wrap align-items-center mb-40">
                                            <div class="contact-info-icon">
                                                <i class="fas fa-phone-alt"></i>
                                            </div>
                                            <div class="contact-info-content">
                                                <h3 class="title">@lang('Phone Number')</h3>
                                                <p>{{ __(@$contact_us_content->data_values->phone) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Contact
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
