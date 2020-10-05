@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('user.delete') }}">
        @csrf
        <input type="submit" value="Delete Your Account">
    </form>
</div>
@endsection
