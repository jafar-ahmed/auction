{{-- <meta http-equiv="refresh" content="5; URL=http://localhost:8000/jafar"> --}}

@extends('layout.app')

@section('content')
    <section class="lot-item container">
        <h2>{{ $lot->name }}</h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="">
                    <img src="{{ asset('/storage/' . $lot->img) }}" width="680" height="500" alt="{{ $lot->name }}">
                </div>
                <br>
                {{-- <p>Name: <a href="#">{{ $lot->user->name }}</a> </p> --}}
                <p class="">Category: <span><a
                            href="/categories/{{ $lot->category->slug }}">{{ $lot->category->name }}</a></span></p>
                <p class="lot-item__description">
                    Description:<br> <br>{{ $lot->description }}
                </p>

            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        {{ $lot->getTimeRemaing() ?: 'Bidding ended' }}
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Current Price</span><br><br>
                            <span class="lot-item__cost">{{ $lot->getCurrentPrice() }}<b class="">$</b></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Default Bid value<br><br>
                            <span>{{ $lot->getBidPrice() }}<b class="">$</b></span>
                        </div>
                    </div>
                    <form class="lot-item__form" action="/{{ $lot->slug }}/bids" method="post">
                        @csrf
                        <p class="lot-item__form-item">
                            <label for="cost">Your Bid</label>
                            <input id="cost" type="number" name="price" value="{{ $lot->getBidPrice() }}"
                                min="{{ $lot->getBidPrice() }}">
                        </p>
                        {{-- @if (!$lot->isActive())
                            {{-- "disabled"
                        @endif --}}
                        <button type="submit" class="button" {{ !$lot->isActive() ? 'disabled' : '' }}>Add Bid</button>


                    </form>
                    {{-- validation --}}
                    @if ($errors->any())
                        <div class="w-4/8 m-auto text-center">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 list-none">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="history">
                    <h3>Bid history (<span>{{ $bids->count() }}</span>)</h3>
                    <table class="history__list">
                        <tr class="history__item">
                            <th class="history__name">Name</th>
                            <th class="history__price">Bid value</th>
                            <th class="history__time">date&time</th>
                        </tr>
                        @foreach ($bids as $bid)
                            <tr class="history__item {{ $bid->lot->getWinner() ? 'rates__item--win' : '' }}">
                                <td class="history__name"><a href="/my-bids">{{ $bid->user->name }}</a></td>
                                <td class="history__price">{{ $bid->price }}<b class=""> $</b></td>
                                <td class="">{{ $bid->getBiddedTime() }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        setTimeout(function() {
            window.location.reload(1);
        }, 6000);
    </script>
@endsection
