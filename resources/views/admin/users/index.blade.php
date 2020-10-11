@extends('layouts.app')

@section('content')
<div class="container">
    <grid-template csrf="{{ csrf_token() }}" model="{{ $model }}"></grid-template>
</div>
@endsection
