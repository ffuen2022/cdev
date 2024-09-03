@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', '2 Factor Challenge')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover vh-100 d-flex justify-content-center align-items-center"">
  <div class="authentication-inner row m-0 w-100">
    <!-- Two Steps Verification -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4 mx-auto">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand justify-content-center mb-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2 mb-2">
            <span class="app-brand-logo demo">@include('_partials.macros')</span>
            <span class="app-brand-text demo h3 mb-0 fw-bold">Direccion Aseo y Ornato</span>
          </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-3">Verificacion de 2 Pasos 💬</h4>
        <div x-data="{ recovery: false }">
          <div class="mb-3" x-show="! recovery">
            Porfavor verifique el codigo de verificacion en su aplicacion de 2 pasos
          </div>

          <div class="mb-3" x-show="recovery">
            Ingrese el codigo que proporciona su web
          </div>

          <x-jet-validation-errors class="mb-1" />

          <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="mb-3" x-show="! recovery">
              <x-jet-label class="form-label" value="{{ __('Code') }}" />
              <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
              <x-jet-input-error for="code"></x-jet-input-error>
            </div>

            <div class="mb-3" x-show="recovery">
              <x-jet-label class="form-label" value="{{ __('Recovery Code') }}" />
              <x-jet-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
              <x-jet-input-error for="recovery_code"></x-jet-input-error>
            </div>

            <div class="d-flex justify-content-end mt-2">
              <button type="button" class="btn btn-outline-secondary me-1" x-show="! recovery" x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus()})">recovery code
              </button>

              <button type="button" class="btn btn-outline-secondary me-1" x-show="recovery" x-on:click=" recovery = false; $nextTick(() => { $refs.code.focus() })">
                Codigo de Autentificacion
              </button>

              <x-jet-button>
                Log in
              </x-jet-button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- / Two Steps Verification -->
  </div>
</div>
@endsection