@extends($activeTemplate .'layouts.auth')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/admin/images/1.jpg')}}">
            <div class="form-wrapper">
                <h5 class="logo-text mb-15">@lang('2FA Verification')</h5>
                <p>@lang('Current Time'):  {{\Carbon\Carbon::now()}}</p>

                <form action="{{route('user.go2fa.verify')}}" method="POST" class="cmn-form mt-30">
                    @csrf

                    <div class="form-group">
                        <label for="email">@lang('Verification Code')</label>
                        <input type="text" name="code" class="form-control b-radius--capsule" maxlength="7" id="code">
                        <i class="las la-code input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Submit') <i class="las la-sign-in-alt"></i></button>
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
