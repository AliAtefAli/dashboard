@extends('layouts.app')

@section('content')
    <form id="login-form" method="POST" action="{{ route('user.verify') }}">
        @csrf
        <div class="login-page">
            <div class="card-panel login-panel">
                <div class="logo">
                    <img src="{{ asset('assets/web/images/logo.svg') }}" alt="" />
                </div>

                <div class="form-group">
                    <label>{{ __('site.Code') }} </label>

                    <input name="code" type="text" class="form-control @if( session()->has('code')) is-invalid @endif @error('code') is-invalid @enderror "
                           value="{{ old('code') }}"
                           autofocus required/>
                    @if( session()->has('code') )
                        <label class="error" role="alert">
                            {{ session()->get('code') }}
                        </label>
                    @enderror
                    @error('code')
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
