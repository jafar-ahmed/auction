@extends('layout.app')

@section('content')
    <div class="container">
        @Auth
            <section class="lots">
                <h2>*Auctions Available*</span></h2>
                <ul class="lots__list">
                    @foreach ($lots as $lot)
                        @include('lot.mini')
                    @endforeach
                </ul>
            </section>
        @endauth
        {{ $lots->links() }}

    </div>
@endsection
