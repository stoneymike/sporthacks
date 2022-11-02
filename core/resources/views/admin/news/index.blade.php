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
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Staff')</th>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Views')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Admin Check')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($news as $singleNews)
                                <tr>
                                    <td data-label="@lang('date')">
                                        {{ $singleNews->created_at->format('M d , Y') }}
                                    </td>
                                    <td data-label="@lang('User')">
                                        @if($singleNews->user_id != 0)
                                            <span class="font-weight-bold">{{ $singleNews->user->fullname }}</span>
                                            <br>
                                            <span class="small"> <a href="{{ route('admin.users.detail', $singleNews->user_id) }}"><span>@</span>{{ $singleNews->user->username }}</a> </span>
                                        @else
                                            @lang('N/A')
                                        @endif
                                    </td>
                                    <td data-label="@lang('Category')">
                                        <span class="badge badge--primary">{{ $singleNews->category->name }}</span>
                                    </td>
                                    <td data-label="@lang('Title')">
                                        {{__(shortDescription($singleNews->title,80))}}
                                    </td>

                                    <td data-label="@lang('Views')">
                                        {{ $singleNews->views }}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($singleNews->status)
                                            <span class="badge badge--success">
                                                    @lang('Active')
                                                </span>
                                        @else
                                            <span class="badge badge--danger">
                                                    @lang('Deactive')
                                                </span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Admin Check')">
                                        @if ($singleNews->admin_check == 0)
                                            <span class="badge badge--warning">
                                                    @lang('Pending')
                                                </span>
                                        @elseif($singleNews->admin_check == 1)
                                            <span class="badge badge--success">
                                                    @lang('Approved')
                                                </span>
                                        @else
                                            <span class="badge badge--danger">
                                                    @lang('Rejected')
                                                </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="icon-btn {{ $singleNews->admin_check == 0 ? 'btn--warning' : ($singleNews->admin_check == 1 ? 'btn--danger' : 'btn--success') }} mr-1 approveOrReject" data-original-title="{{ $singleNews->admin_check == 0 ? 'Approve/Reject' : ($singleNews->admin_check == 1 ? 'Reject' : 'Approve') }}" data-toggle="tooltip" data-url="{{ route('admin.news.admin.check', $singleNews->id) }}">
                                            @if($singleNews->admin_check == 0)
                                                <i class="la la-spinner"></i>
                                            @elseif($singleNews->admin_check == 1)
                                                <i class="la la-times"></i>
                                            @else
                                                <i class="la la-check"></i>
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" class="icon-btn {{ $singleNews->status ? 'btn--danger' : 'btn--success' }} mr-1 statusBtn" data-original-title="@lang('Status')" data-toggle="tooltip" data-url="{{ route('admin.news.status', $singleNews->id) }}">
                                            <i class="la la-eye{{ $singleNews->status ? '-slash' : null }}"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', [$singleNews, slug($singleNews->title)]) }}"
                                           class="icon-btn"><i class="la la-pen"></i></a>
                                        <a href="" class="icon-btn btn--danger delete"
                                           data-url="{{ route('admin.news.delete', $singleNews) }}"><i
                                                class="la la-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">
                                        @lang('No News Found')
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($news->hasPages())
                <div class="card-footer">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deletenews">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Delete News')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you sure to delete news ?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Delete')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Status MODAL --}}
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('Update Status')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <p class="text-muted">@lang('Are you sure to change status?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--danger deleteButton">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Approve MODAL --}}
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('Mark as approve or reject!')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <p class="text-muted">@lang('Are you sure to approve or reject?')</p>
                    </div>

                    <input type="hidden" name="approve" class="approveInput">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn--warning"><i class="las la-ban"></i>@lang('Reject')</button>
                        <button type="submit" class="btn btn--success approveButton"><i class="las la-check"></i>@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')

<a href="{{ route('admin.news.create') }}" class="btn btn--primary float-sm-right ml-lg-3 mb-3 text-white"> <i
    class="las la-plus"></i> @lang('Create News')</a>

        <form action="{{ route('admin.news.filter.date') }}" method="GET"
              class="form-inline float-sm-right bg--white mr-0 mr-xl-2 mr-lg-0">
            <div class="input-group has_append ">
                <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en"
                       class="datepicker-here form-control" data-position='bottom right' placeholder="@lang('Min Date - Max date')"
                       autocomplete="off" value="{{ @$dateSearch }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="float-sm-right mr-0 mr-xl-2 mr-lg-0">
            <div class="form-group">
                <select name="category" id="category" class="form-control categorySelect">
                    <option value="" selected>@lang('Filter By Category')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                data-url="{{ route('admin.news.filter.search', [$category->id, slug($category->name)]) }}" @if (request()->routeIs('admin.news.filter.search')) {{ $categoryId == $category->id ? 'selected' : '' }} @endif>
                            {{ __($category->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
@endpush

@push('script')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
    <script>
        "use strict";
        // date picker
        $('.datepicker-here').datepicker();
        $('.datepicker-here').val(new Date()) selectDate(new Date($('.datepicker-here').val()));
    </script>
@endpush

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.delete').on('click', function(event) {
                event.preventDefault();
                const modal = $('#deletenews');
                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show');
            })

            //Status
            $('.statusBtn').on('click', function () {
                var modal = $('#statusModal');
                var url = $(this).data('url');

                modal.find('form').attr('action', url);
                modal.modal('show');
            });

            //Approve
            $('.approveOrReject').on('click', function () {
                var modal = $('#approveModal');
                var url = $(this).data('url');

                modal.find('form').attr('action', url);
                modal.modal('show');
            });
            $('.approveButton').on('click', function () {
                $('.approveInput').val(1);
            });

            //Filter category
            $(".categorySelect").on("change", function() {
                if ($(this).val() == '') {
                    return false;
                }
                window.location.href = $('.categorySelect option:selected').data('url');
            });
        })
    </script>

@endpush
