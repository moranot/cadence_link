@extends('layouts.app')

@section('content')
<div class="container">
    <div class="message">
        @if ($notif)
            {{ $notif }}
        @endif
    </div>
</div>
@endsection