<x-dashboard-layout>
    <x-slot name="title">
        Edit Category
        {{-- <a href="/dashboard/categories/create" style="margin-bottom:20px; " class="btn btn-primary"> <i class="fa fa-floppy-o"></i> Add Category</a> --}}
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Categories</li>

    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

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
    <div class="container">


        <form action="/dashboard/categories/{{ $category->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <div class="mt-2">
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
</x-dashboard-layout>
