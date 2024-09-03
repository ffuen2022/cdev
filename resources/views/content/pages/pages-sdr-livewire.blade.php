@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'SDR')

@section('content')
<livewire:styles />

@livewire('sdrdaos')

<livewire:scripts />
@endsection
