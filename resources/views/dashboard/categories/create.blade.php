<x-dashboard-layout>
    <x-slot name="title">
        Add Category
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
        {{-- <h2 style="margin-top:50px ;" class="mb-4">Create New Category</h2> --}}

        <form action="/dashboard/categories" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <div class="mt-2">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
</x-dashboard-layout>
