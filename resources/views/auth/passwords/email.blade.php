@extends('layouts.app')

@section('content')
    <form id="login-form" method="POST" action="{{ route('get_code') }}">
        @csrf
        <div class="login-page">
            <div class="card-panel login-panel">
                <div class="logo">
                    <img src="{{ asset('assets/web/images/logo.svg') }}" alt="" />
                </div>

                <div class="form-group">
                    <label>{{ __('site.User.Email') }} || {{  __('site.User.phone') }} </label>

                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           autofocus required/>
                    @error('email')
                    <label class="error" role="alert">
                        {{ $message }}
                    </label>
                    @enderror
                </div>

                <button type="submit" class="btn-login">{{ __('site.Confirm') }}</button>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script>
        $("#login-form").validate();
    </script>
@endsection
