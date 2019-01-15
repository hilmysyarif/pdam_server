@extends('layouts.frontend')

@section('css_class', 'frontend home')

@section('content')
<div class="container home pt-5">
  <div class="row justify-content-md-center">
    <h6 class="col-lg-12 text-center">BUMDES Kertawinangun dibangun untuk memudahkan pelanggan untuk melihat pemakaian air.</h6>
  </div>

  <div class="row mt-5 justify-content-md-center">
    <div class="col-lg-7">
    <h5>Berita terakhir</h5>
    <div id="accordion">
      @foreach($beritas as $berita)
      <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">
              {{$berita->judul}}
            </a>
          </div>
          <div id="collapseOne" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              {!! $berita->content !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>

      @include('messages')

    </div>
  </div>
</div>
@endsection

@section('js')
<script>
var lastIndex = 0;

// Get Data
firebase.database().ref('news/posts/').on('value', function(snapshot) {
    var value = snapshot.val();
    var htmls = [];
    $.each(value, function(index, value){
    	if(value) {
            htmls.push('
            ');
    	}
    	lastIndex = index;
    });
    $('#accordion').html(htmls);

});
</script>
@endsection
