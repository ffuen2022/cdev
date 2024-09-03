@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Consolidado')

@section('content')
<livewire:styles />

@livewire('consolidados')

<livewire:scripts />
@endsection
