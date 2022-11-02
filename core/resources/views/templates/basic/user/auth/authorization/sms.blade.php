@extends($activeTemplate .'layouts.auth')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/admin/images/1.jpg')}}">
            <div class="form-wrapper">
                <h5 class="logo-text mb-15">@lang('Please Verify Your Mobile to Get Access')</h5>
                <p>@lang('Your Mobile Number'):  <strong>{{auth()->user()->mobile}}</strong></p>

                <form action="{{route('user.verify.sms')}}" method="POST" class="cmn-form mt-30">
                    @csrf

                    <div class="form-group">
                        <label for="email">@lang('Verification Code')</label>
                        <input type="text" name="sms_verified_code" class="form-control b-radius--capsule" maxlength="7" id="code">
                        <i class="las la-code input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Submit') <i class="las la-sign-in-alt"></i></button>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <p>@lang('If you don\'t get any code'), <a href="{{route('user.send.verify.code')}}?type=phone" class="forget-pass"> @lang('Try again')</a></p>
                        @if ($errors->has('resend'))
                            <br/>
                            <small class="text-danger">{{ $errors->first('resend') }}</small>
                        @endif
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
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          $(this).val(function (index, value) {
             value = value.substr(0,7);
              return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
          });
      });
    })(jQuery)
</script>
@endpush
