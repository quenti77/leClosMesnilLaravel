@extends('layouts.app')
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/fullCalendar.js') }}" defer></script>
@endsection
@section('content')
    <div id='calendar'></div>
@endsection
