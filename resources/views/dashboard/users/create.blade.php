<x-dashboard-layout>
    <x-slot name="title">
        Add User
        {{-- <a href="/dashboard/users/create" style="margin-bottom:20px; " class="btn btn-primary"> <i class="fa fa-floppy-o"></i> Add User</a> --}}
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Users</li>

    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <div class="container">
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

        <form action="/dashboard/users" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <div class="mt-2">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" >
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="name">Email:</label>
                <div class="mt-2">
                    <input type="text" name="email" value="{{ old('name') }}" class="form-control" >
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="name">Password:</label>
                <div class="mt-2">
                    <input type="password" name="password" value="{{ old('name') }}" class="form-control" >
                </div>
            </div>

            {{-- <div class="form-group mb-3">
                <label for="name">Confirm Password:</label>
                <div class="mt-2">
                    <input type="password" name="confirmpassword" class="form-control" >
                </div>
            </div> --}}

            <div class="form-group mb-3">
                <label for="name">Contact Info:</label>
                <div class="mt-2">
                    <input type="text" name="contacts" value="{{ old('name') }}" class="form-control" >
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="name">Personal Photo:</label>
                <div class="mt-2">
                    <input type="file" name="photo" value="{{ old('name') }}" class="form-control" >
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>


    </div>
</x-dashboard-layout>
