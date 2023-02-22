@extends('layout.app') 

@section('content')
<br>
<br>
<br>
{{-- validation --}}
@if ($errors->any())
<div class="w-4/8 m-auto text-center">
    @foreach ($errors->all() as $error)
        <li style="color: red;" class="text-red-500 list-none">
            {{ $error }}
        </li>
    @endforeach
</div>
@endif
<form class="form container {{ count($errors) ? 'form--invalid' : ''}}" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
    @csrf
    <h2>{{ __('Register') }}</h2>
    <div class="form__item ">
        <label for="name">{{ __('Name') }}:</label>
        <input id="name" type="text" name="name" placeholder="Enter name" value="{{ old('name') }}" >
        <span class="form__error">Please Enter Name...</span>
        @error('name')
            <span class="form__error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form__item ">
        <label for="email">E-mail:</label>
        <input id="email" type="text" name="email" placeholder="Enter E-mail" value="{{ old('email') }}" >
        <span class="form__error">Please Enter e-mail...</span>
        @error('email')
            <span class="form__error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form__item ">
        <label for="password">{{ __('Password') }}:</label>
        <input id="password" type="password" name="password" placeholder="Enter Password" value="{{ old('password') }}" >
        
        <label for="password">{{ __('Confirm Password') }}:</label>
        <input id="password" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" >
        @error('password')
            <span class="form__error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form__item ">
        <label for="contacts">Contact Info:</label>
        <input id="contacts" name="contacts" placeholder="Enter Contact details" value="{{ old('contacts') }}" >
        <span class="form__error">Please Enter Contact details...</span>
        @error('message')
            <span class="form__error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form__item form__item--file form__item--last {{ old('avatar') ? 'form__item--uploaded' : ''}}">
        <label>Personal Photo:</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="/storage/avatar/{{ old('avatar') }}" width="113" height="113" alt="error">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" name="avatar" type="file" id="photo2" value="{{ old('avatar') }}">
            <label for="photo2">
                <span>+ Add</span>
            </label>
        </div>
    </div>
    <button type="submit" class="button">Register</button>
    <label for="">You already have an account!</label>
    <a class="text-link" href="/login">*Login*</a>
</form>
@endsection