@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Confirm Password') }}</h2>
    <h3>{{ __('Please confirm your password before continuing.') }}</h3>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="@error('password')@enderror" name="password" required autocomplete="current-password">
        @error('password')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <button type="submit">
            {{ __('Confirm Password') }}
        </button>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>
</div>
@endsection
