@extends('layout.app')

@section('content')
    <form class="form form--add-lot container {{ count($errors) ? 'form--invalid' : '' }}" action="/add-lot" method="post"
        enctype="multipart/form-data">
        @csrf
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item @error('name') form__item--invalid @enderror">
                <label for="lot-name">Наименование</label>
                <input id="lot-name" type="text" name="name" placeholder="Введите наименование лота"
                    value="{{ old('name') }}">
                <span class="form__error">Введите наименование лота</span>
            </div>
            <div class="form__item @error('category_id') form__item--invalid @enderror">
                <label for="category">Категория</label>
                <select id="category" name="category_id">
                    <option value="">Выберите категорию</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="form__error">Выберите категорию</span>
            </div>
        </div>
        <div class="form__item form__item--wide @error('description') form__item--invalid @enderror">
            <label for="message">Описание</label>
            <textarea id="message" name="description" placeholder="Напишите описание лота">{{ old('description') }}</textarea>
            <span class="form__error">Напишите описание лота</span>
        </div>
        <div
            class="form__item form__item--file @error('img') form__item--invalid @enderror {{ old('img') ? 'form__item--uploaded' : '' }}">
            <label>Изображение</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="/uploads/lots/{{ old('img') }}" width="113" height="113" alt="Изображение лота">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" name="img" type="file" id="photo2" value="">
                <label for="photo2">
                    <span>+ Add</span>
                </label>
            </div>
            <span class="form__error">Загрузите правильное Изображение</span>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small @error('price') form__item--invalid @enderror">
                <label for="lot-rate">Начальная цена</label>
                <input id="lot-rate" type="number" name="price" placeholder="0" value="{{ old('price') }}">
                <span class="form__error">Введите начальную цену</span>
            </div>
            <div class="form__item form__item--small @error('step') form__item--invalid @enderror">
                <label for="lot-step">Шаг ставки</label>
                <input id="lot-step" type="number" name="step" placeholder="0" value="{{ old('step') }}">
                <span class="form__error">Введите шаг ставки</span>
            </div>
            <div class="form__item @error('dt_end') form__item--invalid @enderror">
                <label for="lot-date">Дата окончания торгов</label>
                <input class="form__input-date" id="lot-date" type="date" name="dt_end" value="{{ old('dt_end') }}">
                <span class="form__error">Введите дату завершения торгов</span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
@endsection
