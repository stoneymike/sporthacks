@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Email-Phone')</th>
                                <th>@lang('Country')</th>
                                <th>@lang('Joined At')</th>
                                <th>@lang('News')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td data-label="@lang('User')">
                                    <span class="font-weight-bold">{{$user->fullname}}</span>
                                    <br>
                                    <span class="small">
                                    <a href="{{ route('admin.users.detail', $user->id) }}"><span>@</span>{{ $user->username }}</a>
                                    </span>
                                </td>


                                <td data-label="@lang('Email-Phone')">
                                    {{ $user->email }}<br>{{ $user->mobile }}
                                </td>
                                <td data-label="@lang('Country')">
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="{{ @$user->address->country }}">{{ $user->country_code }}</span>
                                </td>



                                <td data-label="@lang('Joined At')">
                                    {{ showDateTime($user->created_at) }} <br> {{ diffForHumans($user->created_at) }}
                                </td>


                                <td data-label="@lang('Balance')">
                                    <span class="font-weight-bold">

                                    {{ $user->news_count }}
                                    </span>
                                </td>



                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.users.detail', $user->id) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                                        <i class="las la-desktop text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($users) }}
                </div>
            </div>
        </div>
    </div>

{{-- ADD METHOD MODAL --}}
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Staff')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.add.staff') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="fname">@lang('First Name')</label>
                            <input type="text" name="fname" id="fname" class="form-control" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="lname">@lang('Last Name')</label>
                            <input type="text" name="lname" id="lname" class="form-control" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="email">@lang('Email')</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="username">@lang('Username')</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="mobile">@lang('Mobile')</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="country">@lang('Country')</label>
                            <select name="country_code" class="form-control">
                                @foreach($countries as $key => $country)
                                    <option value="{{ $key }}">{{ __($country->country) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="password">@lang('Password')</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="pass2">@lang('Confirm Password')</label>
                            <input type="password" name="password_confirmation" id="pass2" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div
@endsection

@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn--primary float-sm-right ml-lg-3 mb-3 text-white addNew">
        <i class="las la-plus"></i>
         @lang('Create Staff')
    </a>

    <form action="{{ route('admin.users.search', $scope ?? str_replace('admin.users.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Username or email')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush


@push('script')
    <script>
        (function ($) {
            "use strict";

            $('.addNew').on('click', function () {
                var modal = $('#addModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush