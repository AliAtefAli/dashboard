@extends('layouts.app')

@section('content')
    <form id="register-form" method="POST" action="{{ route('set_confirm') }}">
        @csrf
        <div class="login-page">
            <div class="card-panel login-panel">
                <div class="logo">
                    <img src="{{ asset('assets/web/images/logo.svg') }}" alt=""/>
                </div>

                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="form-group">
                    <label>{{ __('site.Code') }}</label>

                    <input name="code" type="text" class="form-control @error('code') is-invalid @enderror @if(session()->has('code-wrong')) is-invalid @endif" required/>
                    @error('code')
                    <label class="error" role="alert">
                        {{ $message }}
                    </label>
                    @enderror
                    @if(session()->has('code-wrong'))
                        <label class="error" role="alert">
                            {{ session()->get('code-wrong') }}
                        </label>
                        @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('site.User.Password') }}</label>

                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required/>
                    @error('password')
                    <label class="error" role="alert">
                        {{ $message }}
                    </label>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('site.User.Confirm Password') }}</label>

                    <input name="password_confirmation" type="password" class="form-control @error('name') is-invalid @enderror"/>
                </div>

                <button type="submit" class="btn-login">{{ __('site.Change Password') }}</button>
                {{--                <a href="home.html" class="btn-login">تسجيل دخول</a>--}}
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script>
        $("#register-form").validate();
    </script>
@endsection

