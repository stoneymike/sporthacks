@extends($activeTemplate.'layouts.auth')
@section('content')
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/admin/images/1.jpg')}}">
            <div class="form-wrapper">
                <h4 class="logo-text mb-15">@lang('Welcome to') <strong>{{__($general->sitename)}}</strong></h4>
                <p>{{__($pageTitle)}}</p>

                <form action="{{ route('user.register') }}" method="POST" class="cmn-form mt-30">
                    @csrf

                    <div class="form-group">
                        <label for="firstname">@lang('First Name')</label>
                        <input type="text" name="firstname" class="form-control b-radius--capsule" id="firstname" value="{{ old('firstname') }}" placeholder="@lang('Enter your first name')">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="lastname">@lang('Last Name')</label>
                        <input type="text" name="lastname" class="form-control b-radius--capsule" id="lastname" placeholder="@lang('Enter your last name')">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="country">{{ __('Country') }}</label>
                        <select name="country" id="country" class="form-control b-radius--capsule">
                            @foreach($countries as $key => $country)
                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                            @endforeach
                        </select>
                        <i class="las la-globe input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="mobile">{{ __('Mobile') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text mobile-code"></span>
                                <input type="hidden" name="mobile_code">
                                <input type="hidden" name="country_code">
                            </div>
                            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control checkUser" placeholder="@lang('Your Phone Number')">
                        </div>
                        <i class="las la-phone input-icon"></i>
                        <small class="text-danger mobileExist"></small>
                    </div>

                    <div class="form-group">
                        <label for="username">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control checkUser b-radius--capsule" placeholder="@lang('Enter your username')" name="username" value="{{ old('username') }}" required>
                        <i class="las la-user input-icon"></i>
                        <small class="text-danger usernameExist"></small>
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('E-Mail Address')</label>
                        <input id="email" type="email" class="form-control checkUser b-radius--capsule" placeholder="@lang('Enter your email')" name="email" value="{{ old('email') }}" required>
                        <i class="las la-at input-icon"></i>
                    </div>

                    <div class="form-group hover-input-popup">
                        <label for="password">@lang('Password')</label>
                        <input id="password" type="password" class="form-control b-radius--capsule" placeholder="@lang('Enter your password')" name="password" required>
                        <i class="las la-lock input-icon"></i>
                        @if($general->secure_password)
                            <div class="input-popup">
                                <p class="error lower">@lang('1 small letter minimum')</p>
                                <p class="error capital">@lang('1 capital letter minimum')</p>
                                <p class="error number">@lang('1 number minimum')</p>
                                <p class="error special">@lang('1 special character minimum')</p>
                                <p class="error minimum">@lang('6 character password')</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">@lang('Confirm Password')</label>
                        <input id="password-confirm" type="password" class="form-control b-radius--capsule" placeholder="@lang('Re-type password')" name="password_confirmation" required autocomplete="new-password">
                        <i class="las la-lock input-icon"></i>
                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <a href="{{route('user.login')}}" class="text-muted text--small"><i class="las la-lock"></i>@lang('Already Have an account?')</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Register') <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>
            </div>
        </div><!-- login-area end -->
    </div>


<div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center">@lang('You already have an account please Sign in ')</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
        <a href="{{ route('user.login') }}" class="btn btn-primary">@lang('Login')</a>
      </div>
    </div>
  </div>
</div>
@endsection
@push('style')
<style>
    .country-code .input-group-prepend .input-group-text{
        background: #fff !important;
    }
    .country-code select{
        border: none;
    }
    .country-code select:focus{
        border: none;
        outline: none;
    }
    .hover-input-popup {
        position: relative;
    }
    .hover-input-popup:hover .input-popup {
        opacity: 1;
        visibility: visible;
    }
    .input-popup {
        position: absolute;
        bottom: 69%;
        left: 50%;
        width: 280px;
        background-color: #1a1a1a;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }
    .input-popup::after {
        position: absolute;
        content: '';
        bottom: -19px;
        left: 50%;
        margin-left: -5px;
        border-width: 10px 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #1a1a1a transparent;
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    .input-popup p {
        padding-left: 20px;
        position: relative;
    }
    .input-popup p::before {
        position: absolute;
        content: '';
        font-family: 'Line Awesome Free';
        font-weight: 900;
        left: 0;
        top: 4px;
        line-height: 1;
        font-size: 18px;
    }
    .input-popup p.error {
        text-decoration: line-through;
    }
    .input-popup p.error::before {
        content: "\f057";
        color: #ea5455;
    }
    .input-popup p.success::before {
        content: "\f058";
        color: #28c76f;
    }
</style>
@endpush
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
      "use strict";

        (function ($) {
            @if($mobile_code)
            $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function(){
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            @if($general->secure_password)
                $('input[name=password]').on('input',function(){
                    secure_password($(this));
                });
            @endif

            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {mobile:mobile,_token:token}
                }
                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }
                $.post(url,data,function(response) {
                  if (response['data'] && response['type'] == 'email') {
                    $('#existModalCenter').modal('show');
                  }else if(response['data'] != null){
                    $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                  }else{
                    $(`.${response['type']}Exist`).text('');
                  }
                });
            });

        })(jQuery);

    </script>
@endpush
