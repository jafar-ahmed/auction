@extends('layout.app')

@section('content')


    <section class="rates container">
        <h2>My Bids</h2>
        <table class="rates__list">
            @foreach ($bids as $item)
                @if ($winner = $item->lot->getWinner())
                    <tr class="rates__item rates__item--win">
                        <td class="rates__info">
                            <div class="rates__img">
                                <img src="{{ asset('/storage/' . $item->lot->img) }}" width="54" height="40"
                                    alt="error">
                            </div>
                            <div>
                                <h3 class="rates__title"><a href="/{{ $item->lot->slug }}">{{ $item->lot->name }}</a>
                                </h3>
                                <p>Seller contacts: {{ $item->lot->user->contacts }}</p>
                            </div>
                        </td>
                        <td>
                            <div style="color: brown; font-size:25px; " class="timer timer--win">{{ $winner->name }} is
                                Winner</div>
                        </td>
                    </tr>
                @elseif ($item->lot->isActive())
                    <tr class="rates__item">
                        <td class="rates__info">
                            <div class="rates__img">
                                <img src="{{ asset('/storage/' . $item->lot->img) }}" width="54" height="40"
                                    alt="{{ $item->lot->name }}">
                            </div>
                            <h3 class="rates__title"><a href="/{{ $item->lot->slug }}">{{ $item->lot->name }}</a></h3>
                        </td>
                        <td class="rates__price">
                            Category: {{ $item->lot->category->name }}
                        </td>
                        <td class="rates__timer">
                            <div class="timer">{{ $item->lot->getTimeRemaing() }}</div>
                        </td>
                        <td class="rates__price">

                            {{ $item->price }} $
                        </td>
                        <td class="rates__time">
                            {{ $item->getBiddedTime() }}
                        </td>
                    </tr>
                @else
                    <tr class="rates__item rates__item--end">
                        <td class="rates__info">
                            <div class="rates__img">
                                <img src="{{ asset('/storage/' . $item->lot->img) }}" width="54" height="40"
                                    alt="{{ $item->lot->name }}">
                            </div>
                            <h3 class="rates__title"><a href="/{{ $item->lot->slug }}">{{ $item->lot->name }}</a></h3>
                        </td>
                        <td class="rates__price">
                            Category: {{ $item->lot->category->name }}
                        </td>
                        <td class="rates__timer">
                            <div class="timer timer--end">Auction End</div>
                        </td>
                        <td class="rates__price">
                            {{ $item->price }} $
                        </td>
                        <td class="rates__time">
                            {{ $item->getBiddedTime() }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </section>

@endsection
