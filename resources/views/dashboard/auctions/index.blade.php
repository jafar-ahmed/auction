<x-dashboard-layout>
    <x-slot name="title">
        Auctions
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Auctions</li>
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
                    <th>Price</th>
                    <th>Step</th>
                    <th>Active</th>
                    <th>Open Date</th>
                    <th>Close Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auctions as $auction)
                    <tr>
                        <td>{{ $auction->id }}</td>
                        <td>{{ $auction->name }}</td>
                        <td>{{ $auction->price }}</td>
                        <td>{{ $auction->step }}</td>
                        <td>{{ $auction->active  == 1? 'Open'  : 'Close'  }}</td>
                        <td>{{ $auction->created_at }}</td>
                        <td>{{ $auction->dt_end }}</td>
                        <td> 
                            <form action="/dashboard/auctions/{{ $auction->id }}" method="post">
                                 <a href="/dashboard/auctions/{{ $auction->id }}/edit" class="btn btn-primary"><i
                                    class="fa fa-edit"></i> </a>
                            </a>
                                @csrf
                                @method('delete')
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
