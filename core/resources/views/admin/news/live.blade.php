@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="card col-md-12 p-0">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">@lang('Title') <code>**</code></label>
                            <input type="text" name="title" class="form-control" required value="{{ $general->live_news_title }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">@lang('Live Link') <code>**</code></label>
                            <input type="text" name="live_news_link" class="form-control" required value="{{ $general->live_news_link }}" placeholder="https://www.youtube.com/embed/g--C2srD_5I">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">@lang('News Short Description') <code>**</code></label>
                            <textarea name="description" class="form-control" required>{{ $general->live_news_description }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn--primary w-100">@lang('Save')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
