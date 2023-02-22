<x-dashboard-layout>
    <x-slot name="title">
        Edit Admin
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Admins</li>

    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <div class="container">

        @if ($errors->any())
            <div class="w-4/8 m-auto text-center">
                @foreach ($errors->all() as $error)
                    <li style="color: red;" class="text-red-500 list-none">
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif
        <form action="/dashboard/admins/{{ $user->id }}" method="POST">
            @csrf
            <!-- post to put -->
            @method('put')
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <div class="mt-2">
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" >
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="name">Email:</label>
                <div class="mt-2">
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control" >
                </div>
            </div>


            <div class="form-group mb-3">
                <label for="name">Password:</label>
                <div class="mt-2">
                    <input type="text" name="password" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>


    </div>
</x-dashboard-layout>
