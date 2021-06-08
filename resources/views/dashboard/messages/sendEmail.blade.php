@extends('dashboard.layouts.app')
@section('title', trans('dashboard.messages.SMS send'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.min.css">
@stop
@section('content')
    <!--content wrapper -->
    <div class="content-wrapper">
        <!--content header -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h1 class="content-header-title">{{trans('dashboard.main.messages')}}</h1>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.home')}}">{{trans('dashboard.main.home')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('dashboard.messages.SMS send')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of content header -->

        @include('dashboard.partials._alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <!-- form start -->
                            <form id="createUserForm" class="form-horizontal" method="post"
                                  action="{{ route('dashboard.message.sendEmail') }}">
                                @csrf
                                <input type="hidden" name="type" value="email">

                                <div class="form-body">
                                    <div class="form-body">
                                        <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="title">{{ trans('dashboard.messages.title')}}</label>
                                            <div class="col-md-10">
                                                <div><input type="text" id="title" class="form-control"
                                                            name="title" value="{{ old("title") }}"/>
                                                    @include('dashboard.partials._errors', ['input' => "title"])
                                                    <div class="form-control-position">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div
                                            class="form-group row {{ $errors->has('body') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="body">{{ trans('dashboard.messages.content') }}</label>
                                            <div class="col-md-10">
                                                <input id="body" type="hidden"
                                                       name="body"
                                                       value="{{ old("body") }}"/>
                                                <trix-editor input="body"></trix-editor>
                                                @include('dashboard.partials._errors', ['input' => "body"])
                                                <div class="form-control-position">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-body">
                                        <div
                                            class="form-group row {{ $errors->has('user_id') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="user_id">{{ trans('dashboard.messages.receiver')}}</label>
                                            <div class="col-md-10">
                                                <select class="custom-select select-user" name="receiver_id">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                    @include('dashboard.partials._errors', ['input' => "receiver_id"])
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        {{trans('dashboard.messages.send')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.min.js"></script>
    @if( app()->getLocale() == 'ar')
        <script src="{{ asset('assets/validation/messages_ar.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            $("#createUserForm").validate();
            $('.select-user').select2();
        });
    </script>
@endsection
