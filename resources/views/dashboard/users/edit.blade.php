@extends('dashboard.layouts.app')
@section('title', trans('dashboard.user.edit user'))
@section('styles')
    <style>
        .img-uploaded img { width: 100px}
    </style>
@stop
@section('content')

    <!--content wrapper -->
    <div class="content-wrapper">
        <!--content header -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h1>
                    {{trans('dashboard.user.admins')}}
                </h1>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.home')}}">{{trans('dashboard.main.home')}}</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard.users.admins')}}">{{ trans('dashboard.user.admins') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('dashboard.main.Create') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.partials._alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <!-- form start -->
                            <form class="form-horizontal" method="post"
                                  action="{{ route('dashboard.users.update', $user) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-body">
                                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-2" for="name">{{trans('dashboard.user.Name')}}</label>
                                        <div class="col-md-10">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="name" class="form-control"
                                                       placeholder="{{trans('dashboard.user.Name')}}"
                                                       name="name" value="{{$user->name}}" autofocus/>
                                                @include('dashboard.partials._errors', ['input' => 'name'])
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-md-2" for="name">{{trans('dashboard.user.Email')}}</label>
                                        <div class="col-md-10">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="email" class="form-control"
                                                       placeholder="{{trans('dashboard.user.Email')}}"
                                                       name="email" value="{{ $user->email }}"/>
                                                @include('dashboard.partials._errors', ['input' => 'email'])
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="phone-mask">{{trans('dashboard.user.phone')}}</label>
                                        <div class="col-md-10">
                                            <div class="position-relative">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{--                                                        <span class="input-group-text" id="basic-addon1">+966</span>--}}
                                                    </div>
                                                    <input type="text" class="form-control phone-inputmask"
                                                           id="phone-mask"
                                                           placeholder="Enter Phone Number" name="phone"
                                                           value="{{ $user->phone }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                    <div class="form-group row {{ $errors->has('type') ? ' has-error' : '' }}">--}}
                                    {{--                                        <label class="col-md-2"--}}
                                    {{--                                               for="type">{{trans('dashboard.user.Select User Role')}}</label>--}}
                                    {{--                                        <div class="col-md-10">--}}
                                    {{--                                            <div class="position-relative has-icon-left">--}}
                                    {{--                                                <select class="custom-select" name="type">--}}
                                    {{--                                                    <option value="user"--}}
                                    {{--                                                            @if($user->type == 'user') selected @endif>{{ trans('dashboard.user.User') }}</option>--}}
                                    {{--                                                    <option value="admin"--}}
                                    {{--                                                            @if($user->type == 'admin') selected @endif>{{ trans('dashboard.user.admin') }}</option>--}}
                                    {{--                                                </select>--}}
                                    {{--                                                @include('dashboard.partials._errors', ['input' => 'type'])--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    <div class="form-group row {{ $errors->has('image') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="name">{{trans('dashboard.user.Image')}}</label>
                                        <div class="col-md-10">
                                            <div class="position-relative ">
                                                <input type="file" id="image" class="form-control image"
                                                       name="image"/>
                                                @include('dashboard.partials._errors', ['input' => 'image'])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-md-2" for="image"></label>
                                        <div class="col-md-10">
                                            <div class="position-relative multi-img-result d-flex align-items-center flex-wrap">
                                                <div class="img-uploaded uploaded-image m-1">
                                                    <img src="@if($user->image) {{ asset($user->image) }} @else {{ asset('assets/uploads/users/default.png') }} @endif" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row {{ $errors->has('status') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="status">{{trans('dashboard.user.Select User Status')}}</label>
                                        <div class="col-md-10">
                                            <div class="position-relative has-icon-left">
                                                <select class="custom-select" name="status">
                                                    <option value="active"
                                                            @if($user->status == 'active') selected @endif>{{ trans('dashboard.user.active') }}</option>
                                                    <option value="pending"
                                                            @if($user->status == 'pending') selected @endif>{{ trans('dashboard.user.pending') }}</option>
                                                    <option value="block"
                                                            @if($user->status == 'block') selected @endif>{{ trans('dashboard.user.block') }}</option>
                                                </select>
                                                @include('dashboard.partials._errors', ['input' => 'status'])
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        {{trans('dashboard.main.Edit')}}
                                    </button>
                                </div>
                            </form>
                            <!-- form end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/dashboard/assets/js/image-preview-2.js') }}"></script>
@endsection
