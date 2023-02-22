@extends('layout.app')

@section('content')

    <section class="rates container">
        <h2>My Auction</h2>
        <table class="rates__list">

            @foreach ($lots as $item)
                <tr class="rates__item  {{ !$item->isActive() ? 'rates__item--end' : '' }}">
                    <td class="">
                        <div class="rates__img">
                            <img src="{{ asset('/storage/' . $item->img) }}" width="54" height="40" alt="error">
                        </div>

                    </td>
                    <td class="rates__category">
                        <h3 class="rates__title"><a href="/{{ $item->slug }}">{{ $item->name }}</a></h3>
                    </td>
                    {{-- <td class="rates__category">
                        Description: {{ $item->description }}
                    </td> --}}
                    <td class="rates__category">
                        Category: {{ $item->category->name }}
                    </td>
                    @if (!$item->isActive())
                        <td class="rates__timer">
                            <div class="timer timer--finishing">{{ $item->getTimeRemaing() ?: 'Auction end' }}</div>
                        </td>
                    @else
                        <td class="rates__timer">
                            <div class="timer ">{{ $item->getTimeRemaing() ?: 'Auction end' }}</div>
                        </td>
                    @endif
                    <td class="rates__price">
                        Start Price: {{ $item->price }} $
                    </td>

                    <td class="rates__time">
                        Time back
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
