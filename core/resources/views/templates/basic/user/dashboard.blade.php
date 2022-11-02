@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--19 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-newspaper"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['total_news']}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Total News')</span>
                    </div>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="fa fa-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['pending_news']}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Pending News')</span>
                    </div>
                    <a href="{{ route('admin.news.pending') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow" >
                <div class="icon">
                    <i class="la la-check-circle"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['approved_news']}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Approved News')</span>
                    </div>

                    <a href="{{ route('admin.news.approved') }}" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--6 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="la la-times-circle"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$widget['rejected_news']}}</span>
                    </div>
                    <div class="desciption">
                        <span>@lang('Rejected News')</span>
                    </div>

                    <a href="#" class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <h6 class="mb-3">@lang('Latest News')</h6>
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Date')</th>
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
                                        <a href="{{ route('user.news.edit', [$singleNews, slug($singleNews->title)]) }}"
                                           class="icon-btn"><i class="la la-pen"></i></a>
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
        </div>
    </div>
@endsection
