@extends($activeTemplate.'layouts.auth')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/admin/images/1.jpg')}}">
            <div class="form-wrapper">

                <form action="{{ route('user.password.verify.code') }}" method="POST" class="cmn-form mt-30">
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-group">
                        <label for="email">@lang('Verification Code')</label>
                        <input type="text" name="code" id="code" class="form-control b-radius--capsule">
                        <i class="las la-code input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Verify Code') <i class="las la-sign-in-alt"></i></button>
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
