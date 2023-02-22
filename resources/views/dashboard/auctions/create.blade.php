<x-dashboard-layout>
    <x-slot name="title">
        Add Auction
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Auctions</li>

    </x-slot>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <div class="container">
        <form action="/dashboard/auctions" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <div class="mt-2">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description:</label>
                <div class="mt-2">
                    <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="price">Starting Price:</label>
                <div class="mt-2">
                    <input type="text" name="price" value="{{ old('price') }}" class="form-control">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="step">Bid Step:</label>
                <div class="mt-2">
                    <input type="text" name="step" value="{{ old('step') }}" class="form-control">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="category">Category:</label><br>
                <select id="category" name="category_id" value="{{ old('category_id') }}">
                    <option value="">Select...</option>
                    @foreach ($categories as $category)
                        <option {{ old('category_id') == $category ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="lot-date">Auction end date:</label><br>
                <input class="form__input-date" id="lot-date" type="datetime-local" name="dt_end"
                    value="{{ old('dt_end') }}">
            </div>
            <div
                class="form__item form__item--file @error('img') form__item--invalid @enderror {{ old('img') ? 'form__item--uploaded' : '' }}">
                <label>Image:</label>
                <input type="file" name="img" value="{{ old('img') }}"
                    class="form-control form-control-solid" placeholder="Enter image" />
            </div><br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
