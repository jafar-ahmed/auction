<x-dashboard-layout>
    <x-slot name="title">
        Users
        {{-- <a href="/dashboard/users/create" style="margin-bottom:20px; " class="btn btn-primary"> <i class="fa fa-floppy-o"></i> Add User</a> --}}
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Users</li>

    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contract</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                   
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->contacts }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                {{-- <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> </a>
                            </a> --}}
                                <form action="/dashboard/users/{{ $user->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    {{-- onclick="return confirm('Are you sure?')" --}}
                                    <button class="btn btn-danger deletePage" data-slug="terms-and-conditions" onclick="return confirm('Are you sure to delete!!! ')"
                                        type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                 
                @endforeach

            </tbody>
        </table>

        <script>
            setTimeout(function() {
                document.querySelector('.alert').style.display = "none"
            }, 3000)
        </script>
    </div>


</x-dashboard-layout>
