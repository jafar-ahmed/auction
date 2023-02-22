@extends('layout.app')

@section('content')
<form class="form container {{ count($errors) ? 'form--invalid' : ''}}" action="{{ route('login') }}" method="post">
  @csrf
  <h2>{{ __('Login') }}</h2>
  <div class="form__item @error('email') form__item--invalid @enderror">
      <label for="email">{{ __('E-Mail address') }}:</label>
      <input id="email" type="text" name="email" placeholder="Enter E-mail" value="{{ old('email') }}" required>
      @error('email')
        <span class="form__error">{{ $message }}</span>
      @enderror
  </div>

  <div class="form__item @error('email') form__item--invalid @enderror">
      <label for="password">{{ __('Password') }}:</label>
      <input id="password" type="password" name="password" placeholder="Enter Password" required>
      @error('password')
        <span class="form__error">{{ $message }}</span>
      @enderror  
  </div>

  <div class="form__item--last" >
    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <label class="form-check-label" for="remember">
        {{ __('Remember Me') }}
    </label>
  </div>
 
     <button type="submit" class="button">{{ __('Login') }}</button>
   {{-- @if (Route::has('password.request'))
  <a class="btn btn-link" href="{{ route('password.request') }}">
      {{ __('Forgot Your Password?') }}
  </a> 
@endif --}}

  <label for="">You don't have an account yet?</label>
  <a class="text-link" href="/register">*Register*</a>
</form>
@endsection