@extends('layouts.app')

@section('content')
<div class="container">
    <user-grid-template csrf="{{ csrf_token() }}"></user-grid-template>
</div>
@endsection
