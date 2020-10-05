@extends('layouts.app')

@section('content')
<div class="container">
    <div class="message" role="alert">
        @if ($message)
            {{ $message }}
        @endif
    </div>
    <a href="/">Go to Homepage</a>
</div>
@endsection