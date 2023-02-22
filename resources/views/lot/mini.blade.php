
<li class="lots__item lot {{ !$lot->isActive() ? 'rates__item--end' : '' }}">
    <div class="lot__image">
        <img src="{{ asset('/storage/' . $lot->img) }}" width="350" height="260" alt="{{ $lot->name }}">
    </div>
    <div class="lot__info">
        <span class="">Category: {{ $lot->category->name }}</span>
        <h2 class="lot__title"><a class="text-link"
                href="/{{ $lot->slug }} {{ !$lot->isActive() ? 'disabled' : '' }}">{{ $lot->name }}</a></h2>
              {{-- @if (Auth::user())
                    <p>Name: <a href="#">{{ $lot->user->name }}</a> </p>
              @endif   --}}
      
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">starting price</span>
                <span class="lot__cost">{{ $lot->price }}<b class=""> $</b></span>
            </div>
            <div class="lot__timer timer">
                {{ $lot->getTimeRemaing() ?: 'Action end' }}
            </div>
        </div>
    </div>
</li>
