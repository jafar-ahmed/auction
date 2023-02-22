@extends('layout.app')
@section('content')
<div>
</div>
<div class="container">
  <section class="lots">
      <h2>All auctions available<span>«{{ $category->name }}»</span></h2>
      <ul class="lots__list">
          @foreach ($lots as $lot)
            @include('lot.mini')
          @endforeach
      </ul>
  </section>
  
  {{ $lots->links() }}
  
</div>

@endsection