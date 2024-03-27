@extends('layouts.app')

@section('title', 'Dashboard')

@if (Auth::check())

    @section('content')
        <Dashboard :user="{{ Auth::user() }}"/>
    @endsection
@else
    <script>
        window.location.href = '/';
    </script>
@endif