@extends('dashboard.layouts.app')
@section('title', trans('dashboard.settings.General Settings'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.min.css">
    <style>
        .img-uploaded img,.img-uploaded-2 img { width: 100px}
    </style>
@stop
@section('content')

    <!--content wrapper -->
    <div class="content-wrapper">
        <!--content header -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h1>{{  trans('dashboard.main.Settings') }}</h1>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.home')}}">{{trans('dashboard.main.home')}}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('dashboard.home')}}">{{trans('dashboard.main.Settings')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ trans('dashboard.settings.Edit Settings') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.partials._alert')
        @include('dashboard.partials._all_errors')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <!-- form start -->
                            <form class="form-horizontal" method="post" action="{{ route('dashboard.settings.update') }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @foreach(config('app.languages') as $key => $language)
                                    <div class="form-body">
                                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="name">{{ trans('dashboard.main.Name In '.$language)}}</label>
                                            <div class="col-md-10">
                                                <div><input type="text" id="name" class="form-control"
                                                            name="settings[{{$key}}_name]"
                                                            value="@if(isset($settings[$key.'_name'])) {{ $settings[$key.'_name'] }} @endif"/>
                                                    @include('dashboard.partials._errors', ['input' => 'name'])
                                                    <div class="form-control-position">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-2" for="name">{{trans('dashboard.main.email')}}</label>
                                    <div class="col-md-10">
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="email" class="form-control"
                                                   name="settings[email]" value="@if(isset($settings['email'])) {{$settings['email']}} @endif"/>
                                            @include('dashboard.partials._errors', ['input' => 'email'])
                                            <div class="form-control-position">
                                                <i class="ft-mail"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @foreach(config('app.languages') as $key => $language)
                                    <div class="form-body">
                                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="{{$key}}.description">{{ trans('dashboard.settings.Site Description ' . $language) }}</label>
                                            <div class="col-md-10">
                                                <input id="settings[{{$key}}_description]" type="hidden"
                                                       name="settings[{{$key}}_description]"
                                                       value="@if(isset($settings[$key.'_description'])) {{$settings[$key.'_description']}} @endif">
                                                <trix-editor input="settings[{{$key}}_description]"></trix-editor>
                                                @include('dashboard.partials._errors', ['input' => 'description'])
                                                <div class="form-control-position">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach(config('app.languages') as $key => $language)
                                    <div class="form-body">
                                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="{{$key}}.about">{{ trans('dashboard.settings.Site About ' . $language) }}</label>
                                            <div class="col-md-10">
                                                <input id="settings[{{$key}}_about]" type="hidden"
                                                       name="settings[{{$key}}_about]"
                                                       value="@if(isset($settings[$key.'_about'])) {{$settings[$key.'_about']}} @endif">
                                                <trix-editor input="settings[{{$key}}_about]"></trix-editor>
                                                @include('dashboard.partials._errors', ['input' => 'about'])
                                                <div class="form-control-position">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach(config('app.languages') as $key => $language)
                                    <div class="form-body">
                                        <div class="form-group row {{ $errors->has('policies') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="settings[{{$key}}_policies]">{{ trans('dashboard.settings.Site Policies ' . $language) }}</label>
                                            <div class="col-md-10">
                                                <input id="settings[{{$key}}_policies]" type="hidden" name="settings[{{$key}}_policies]"
                                                       value="@if(isset($settings[$key.'_policies'])) {{$settings[$key.'_policies']}} @endif">
                                                <trix-editor input="settings[{{$key}}_policies]"></trix-editor>
                                                @include('dashboard.partials._errors', ['input' => 'policies'])
                                                <div class="form-control-position"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach(config('app.languages') as $key => $language)
                                    <div class="form-body">
                                        <div class="form-group row {{ $errors->has('_welcome_message') ? ' has-error' : '' }}">
                                            <label class="col-md-2"
                                                   for="settings[{{$key}}_welcome_message]">{{ trans('dashboard.settings.Welcome Message ' . $language) }}</label>
                                            <div class="col-md-10">
                                                <input id="settings[{{$key}}_welcome_message]" type="hidden" name="settings[{{$key}}_welcome_message]"
                                                       value="@if(isset($settings[$key.'_welcome_message'])) {{$settings[$key.'_welcome_message']}} @endif">
                                                <trix-editor input="settings[{{$key}}_welcome_message]"></trix-editor>
                                                @include('dashboard.partials._errors', ['input' => '_welcome_message'])
                                                <div class="form-control-position"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="form-group row {{ $errors->has('logo') ? ' has-error' : '' }}">
                                    <label class="col-md-2" for="logo">{{trans('dashboard.settings.Site Logo')}}</label>
                                    <div class="col-md-10">
                                        <div class="position-relative has-icon-left">
                                            <input id="image" type="file" class="form-control image img-input"
                                                   name="settings[logo]"/>
                                            @include('dashboard.partials._errors', ['input' => 'settings[logo]'])
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <div class="position-relative multi-img-result d-flex align-items-center flex-wrap">
                                            <div class="img-uploaded uploaded-image m-1">
                                                <img src="@if(isset($settings['logo']) ){{ asset('assets/uploads/settings/' .$settings['logo']) }} @endif"
                                                     width="100"   alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('favicon') ? ' has-error' : '' }}">
                                    <label class="col-md-2"
                                           for="favicon">{{trans('dashboard.settings.Website Fav Icon')}}</label>
                                    <div class="col-md-10">
                                        <div class="position-relative ">
                                            <input type="file" id="image2" class="form-control image img-input"
                                                   name="settings[favicon]"/>
                                            @include('dashboard.partials._errors', ['input' => 'settings[favicon]'])
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <div class="position-relative multi-img-result-2 d-flex align-items-center flex-wrap">
                                            <div class="img-uploaded-2 uploaded-image-2 m-1">
                                                <img src="@if(isset($settings['logo']) ){{ asset('assets/uploads/settings/' . $settings['favicon']) }} @endif"
                                                     width="100"   alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="form-group row {{ $errors->has('work_time_from') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="work_time_from">{{ trans('dashboard.settings.Work Time From')}}</label>
                                        <div class="col-md-10">
                                            <select class="custom-select select-user" name="settings[work_time_from]">
                                                @if(isset($settings['work_time_from']))
                                                    {!! getTimes($settings['work_time_from']) !!}
                                                @else
                                                    {!! getTimes() !!}
                                                @endif
                                                @include('dashboard.partials._errors', ['input' => "work_time_from"])
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="form-group row {{ $errors->has('work_time_to') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="work_time_to">{{ trans('dashboard.settings.Work Time To')}}</label>
                                        <div class="col-md-10">
                                            <select class="custom-select select-user" name="settings[work_time_to]">
                                                @if(isset($settings['work_time_to']))
                                                    {!! getTimes($settings['work_time_to']) !!}
                                                @else
                                                    {!! getTimes() !!}
                                                @endif
                                                @include('dashboard.partials._errors', ['input' => "work_time_to"])
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="form-group row {{ $errors->has('work_day_from') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="work_day_from">{{ trans('dashboard.settings.Work Day From')}}</label>
                                        <div class="col-md-10">
                                            <select class="custom-select select-user" name="settings[work_day_from]">
                                                @if(isset($settings['work_day_from']))
                                                    {!! getDaysOfWeek($settings['work_day_from']) !!}
                                                @else
                                                    {!! getDaysOfWeek() !!}
                                                @endif
                                                @include('dashboard.partials._errors', ['input' => "work_day_from"])
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="form-group row {{ $errors->has('work_day_to') ? ' has-error' : '' }}">
                                        <label class="col-md-2"
                                               for="work_day_to">{{ trans('dashboard.settings.Work Day To')}}</label>
                                        <div class="col-md-10">
                                            <select class="custom-select select-user" name="settings[work_day_to]">
                                                @if(isset($settings['work_day_to']))
                                                    {!! getDaysOfWeek($settings['work_day_to']) !!}
                                                @else
                                                    {!! getDaysOfWeek() !!}
                                                @endif
                                                @include('dashboard.partials._errors', ['input' => "work_day_to"])
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        {{trans('dashboard.settings.Update Settings')}}
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
    <script src="{{ asset('assets/dashboard/assets/js/image-preview-2.js') }}"></script>
    <script>
        $(document).ready(function () {
            var getBase64 = function (file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadstart = function () {
                    $('.img-uploaded-2').remove();
                };
                reader.onload = function () {
                    $('.multi-img-result-2').append(
                        '<div class="img-uploaded-2 uploaded-image-2"><img src="' +
                        URL.createObjectURL(file) +
                        '" alt=""><input type="hidden" value="' + reader.result + '" name="images[]"></div>'
                    );
                };
                reader.onerror = function (error) {
                    console.log('Error: ', error);
                };
            }
            $(document).on('change', '#image2', function (event) {
                for (var i = 0; i < event.target.files.length; i++) {
                    getBase64(event.target.files[i]);
                }
            });
        });

    </script>
@endsection
