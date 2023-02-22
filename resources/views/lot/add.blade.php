@extends('layout.app')

@section('content')
    {{-- validation --}}
    {{-- @if ($errors->any())
<div class="w-4/8 m-auto text-center">
    @foreach ($errors->all() as $error)
        <li class="text-red-500 list-none">
            {{ $error }}
        </li>
    @endforeach
</div>
@endif --}}

    <form class="form form--add-lot container {{ count($errors) ? 'form--invalid' : '' }}" action="/add-lot" method="post"
        enctype="multipart/form-data">
        @csrf
        <h2>{{ __('*Add an Auction*') }}</h2>
        <div class="form__container-two">
            <div class="form__item @error('name') form__item--invalid @enderror">
                <label for="lot-name">Name:</label>
                <input id="lot-name" type="text" name="name" placeholder="Enter auction name"
                    value="{{ old('name') }}">
                <span class="form__error">Please enter the name...</span>
            </div>
            <div class="form__item @error('category_id') form__item--invalid @enderror">
                <label for="category">Category:</label>
                <select id="category" name="category_id" value="{{ old('category_id') }}">
                    <option value="">Select...</option>
                    @foreach ($categories as $category)
                        <option {{ old('category_id') == $category ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name }} </option>
                    @endforeach
                </select>
                <span class="form__error">Please select category...</span>
            </div>
        </div>
        <div class="form__item form__item--wide @error('description') form__item--invalid @enderror">
            <label for="message">Description:</label>
            <textarea id="message" name="description" placeholder="Enter a description of the product">{{ old('description') }}</textarea>
            <span class="form__error">Please enter a description (more than 10 Letters)...</span>
        </div>
        <div
            class="form__item form__item--file @error('img') form__item--invalid @enderror {{ old('img') ? 'form__item--uploaded' : '' }}">
            <label>Image:</label>
            <input type="file" name="img" value="{{ old('img') }}" class="form-control form-control-solid"
                placeholder="Enter image" />
            <span class="form__error">Please enter photo...</span>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small @error('price') form__item--invalid @enderror">
                <label for="lot-rate">Starting price:</label>
                <input id="lot-rate" type="number" name="price" placeholder="0" value="{{ old('price') }}">
                <span class="form__error">Please enter starting price (10-5000)...</span>
            </div>
            <div class="form__item form__item--small @error('step') form__item--invalid @enderror">
                <label for="lot-step">Bid Step:</label>
                <input id="lot-step" type="number" name="step" placeholder="0" value="{{ old('step') }}">
                <span class="form__error">Please enter bid step (10-300)</span>
            </div>
            <div class="form__item @error('dt_end') form__item--invalid @enderror">
                <label for="lot-date">Auction end date:</label>
                <input class="form__input-date" id="lot-date" type="datetime-local" name="dt_end"
                    value="{{ old('dt_end') }}">
                <span class="form__error">Please enter the end-date of the auction...</span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Please correct the errors in the form...</span>
        <button type="submit" class="button">Add auction</button>
    </form>
@endsection
