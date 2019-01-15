@extends('layouts.frontend')

@section('css_class', 'frontend home')

@section('content')
<div class="container home pt-5">
  <div class="row justify-content-md-center">
    <h6 class="col-lg-12 text-center">PDAM Kertawinangun dibangun untuk memudahkan pelanggan untuk melihat pemakaian air.</h6>
  </div>

  <div class="row mt-5 justify-content-md-center">
    <div class="col-lg-7">
    <h5>Berita terakhir</h5>
    <div id="accordion">
    </div>

      <!-- <form method="post" action="{{route('createshortlink')}}" class="mt-5 mb-3" id="formUrl">
      @csrf
        <div class="input-group input-group-lg original-url">
          <input name="long_url" placeholder="@lang('Paste a link to be shortened')" class="form-control" id="inputSourceLink" type="text" value="{{ old('long_url') }}">
          <div class="input-group-append">
            <button class="btn" type="submit" id="actProcess">@lang('Shorten')</button>
          </div>
        </div>

        <br>
        <div class="custom-url">
          <div class="custom-url--title">@lang('Custom URL (optional)')</div>
          <span class="custom-url--description text-muted d-block">@lang('Replace clunky URLs with meaningful short links that get more clicks.')</span>
          <div class="site-url">{{$_SERVER['SERVER_NAME']}}/</div>
          <input class="form-control form-control-sm url-field" id="custom_url_key" name="custom_url_key">
          <small class="ml-3" id="link-availability-status"></small>
        </div>
      </form> -->

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
            htmls.push('<div class="card">\
                <div class="card-header">\
                  <a class="card-link" data-toggle="collapse" href="#collapseOne">\
                    '+ value.judul + '\
                  </a>\
                </div>\
                <div id="collapseOne" class="collapse show" data-parent="#accordion">\
                  <div class="card-body">\
                    ' + value.content + '\
                  </div>\
                </div>\
              </div>\
            ');
    	}    	
    	lastIndex = index;
    });
    $('#accordion').html(htmls);

});
</script>
@endsection
