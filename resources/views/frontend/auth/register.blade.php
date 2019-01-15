@extends('layouts.auth')

@section('title', __('Register'))

@section('css_class', 'auth')

@section('content')
<div class="container">
<div class="row justify-content-center align-items-center" style="min-height: 100vh;">

<div class="col-md-6">
<div class="card mx-4">
  <div class="card-body p-4">
    <form method="post" action="{{ route('register') }}" aria-label="@lang('Register')" id="register-form">
    @csrf
      <h1>@lang('Pendaftaran')</h1>
      <p class="text-muted">@lang('Buat akun anda sekarang!')</p>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
        <input id="id_pelanggan" type="text" class="form-control{{ $errors->has('id_pelanggan') ? ' is-invalid' : '' }}" name="id_pelanggan" value="{{ old('id_pelanggan') }}" placeholder="@lang('ID Pelanggan')" required autofocus>

        @if ($errors->has('id_pelanggan'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('id_pelanggan') }}</strong>
        </span>
        @endif
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" placeholder="@lang('Nama Depan')" required autofocus>

        @if ($errors->has('first_name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('first_name') }}</strong>
        </span>
        @endif
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="@lang('Nama Belakang')" required autofocus>

        @if ($errors->has('last_name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('last_name') }}</strong>
        </span>
        @endif
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="@lang('Username')" required autofocus>

        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-at"></i></span></div>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="@lang('Email')" required>

        @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="@lang('Password')" required>

        @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
      <div class="input-group mb-4">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="@lang('Repeat password')" required>
      </div>

      <button id="register" class="btn btn-block btn-success" type="submit">@lang('Create Account')</button>
    </form>
  </div>
</div>
</div>

</div>
</div>
@endsection
