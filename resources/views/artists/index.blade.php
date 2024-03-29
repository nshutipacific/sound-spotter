@extends('layouts.app')

@section('title', 'Dashboard')

@if (Auth::check())

@section('content')
    <artists/>
@endsection
@else
<script>
    window.location.href = '/';
</script>
@endif