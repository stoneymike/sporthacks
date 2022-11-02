@extends($activeTemplate.'layouts.auth')

@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/admin/images/1.jpg')}}">
            <div class="form-wrapper">
                <h5 class="logo-text mb-15">@lang('Reset Password')</h5>

                <form action="{{ route('user.password.email') }}" method="POST" class="cmn-form mt-30">
                    @csrf

                    <div class="form-group">
                        <label for="email">@lang('Select One')</label>
                        <select class="form-control b-radius--capsule" name="type">
                            <option value="email">@lang('E-Mail Address')</option>
                            <option value="username">@lang('Username')</option>
                        </select>
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="email" class="my_value"></label>
                        <input type="text" class="form-control b-radius--capsule @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autofocus="off">
                        <i class="las la-envelope input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Send Password Code') <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>
            </div>
        </div><!-- login-area end -->
    </div>
@endsection
@push('script')
<script>

    (function($){
        "use strict";

        myVal();
        $('select[name=type]').on('change',function(){
            myVal();
        });
        function myVal(){
            $('.my_value').text($('select[name=type] :selected').text());
        }
    })(jQuery)
</script>
@endpush
