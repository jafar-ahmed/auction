@extends('layout.app')
@section('content')

    <section class="promo">
        <h2 class="promo__title">{{ __('AuctionNow') }}<br></h2>
        <p class="promo__text">
            <br>{{ __('Online Auction Management System') }}<br><br>{{ __('Which will provide a platform for sellers to meet                                                                                                               and interact with') }}
            <br> {{ __('buyers and sell items to interested bidders') }}
        </p>
        <img class="promo__img" src="/img/main-photo.png" alt="Error" style="width:70%">
    </section>
    @if (!Auth::user())
        <section class="lots">
            <h2>-Auctions-</h2>
           <table class="table" style="background-color: white;">
                <thead>
                    <tr>
                        <th>Auction</th>
                        <th>Category</th>
                       
                        <th>Remaining Time</th>
                        <th>Open Date</th>
                        <th>Close Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lots as $item)
                        <tr>
                            <td>
                                <h3 class="rates__title"><a href="/{{ $item->slug }}">{{ $item->name }}</a></h3>
                                <div class="rates__img">                                    
                                    <img src="{{ asset('/storage/' . $item->img) }}" width="54" height="40"
                                        alt="error">
                                </div>
                            </td>
                            <td>
                                <a href="/categories/{{ $item->category->slug }}">{{ $item->category->name }}</a>
                            </td>
                            
                            <td class="rates__timer">
                                <div class="timer ">{{ $item->getTimeRemaing() ?: 'Auction end' }}</div>
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->dt_end }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
          {{-- <ul class="lots__list">
            @foreach ($lots as $lot)
            @include('lot.mini')
        @endforeach
        </ul> --}}
        </section>
    @endif
@endsection
