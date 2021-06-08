@extends('layouts.app')

@section('content')
    <form id="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="login-page">
            <div class="card-panel login-panel">
                <div class="logo">
                    <img src="{{ asset('assets/web/images/logo.svg') }}" alt=""/>
                </div>

                <div class="form-group">
                    <label>{{ __('site.User.Name') }}</label>

                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           required maxlength="255"/>
                    @error('name')
                    <label class="error" role="alert">
                        {{ $message }}
                    </label>
                    @enderror
                </div>

                <div class="form-group">
                    <label> {{ __('site.User.Email') }}</label>

                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           required maxlength="255"/>
                    @error('email')
                    <label class="error" role="alert">
                        {{ $message }}
                    </label>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('site.User.phone') }}</label>

                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone') }}"
                           required/>
                    @error('phone')
                    <label class="error" role="alert">
                        {{ $message }}
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
                    @error('password')
                    <label class="error" role="alert">
                        {{ $message }}
                    </label>
                    @enderror
                </div>

                <div class="text-center">
                    <a class="forgot-pass" href="">{{ __('site.User.Forget Password') }}</a>
                </div>

                <button type="submit" class="btn-login">{{ __('site.Register') }}</button>
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

