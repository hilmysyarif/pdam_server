@extends('layouts.backend')

@section('title', title_case(Auth::user()->name) .' ‹ '. __('Edit Profile'))

@section('content')

@include('messages')

<div class="row">
  <div class="col-xl-6">
    <form method="post" action="{{route('user.update', $user->getRouteKey())}}">
    @csrf
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-0">
            @lang('Profile')
            <small class="text-muted">@lang('Edit')</small>
          </h4>

          <hr />

          <div class="row mt-4 mb-4">
          <div class="col">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} row">
              <label for="name" class="col-sm-3 col-form-label">@lang('Username')</label>

              <div class="col">
                <input value="{{$user->name}}" id="name" type="text" class="form-control" name="name" disabled>
                <small class="text-muted"><i>@lang('Usernames cannot be changed.')</i></small>
              </div>
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} row">
              <label for="first_name" class="col-sm-3 col-form-label">@lang('Nama Depan')</label>

              <div class="col">
                <input value="{{$user->first_name}}" id="first_name" type="text" class="form-control" name="first_name">

                @if ($errors->has('first_name'))
                <span class="help-block text-danger">
                  {{ $errors->first('first_name') }}
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} row">
              <label for="last_name" class="col-sm-3 col-form-label">@lang('Nama Belakang')</label>

              <div class="col">
                <input value="{{$user->last_name}}" id="last_name" type="text" class="form-control" name="last_name">

                @if ($errors->has('last_name'))
                <span class="help-block text-danger">
                  {{ $errors->first('last_name') }}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
              <label for="email" class="col-sm-3 col-form-label">@lang('E-mail Address')</label>

              <div class="col">
                <input value="{{$user->email}}" id="email" type="email" class="form-control" name="email">

                @if ($errors->has('email'))
                <span class="help-block text-danger">
                  {{ $errors->first('email') }}
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('id_pelanggan') ? ' has-error' : '' }} row">
              <label for="id_pelanggan" class="col-sm-3 col-form-label">@lang('ID Pelanggan')</label>

              <div class="col">
                <input value="{{$user->id_pelanggan}}" id="id_pelanggan" type="text" class="form-control" name="id_pelanggan">

                @if ($errors->has('id_pelanggan'))
                <span class="help-block text-danger">
                  {{ $errors->first('id_pelanggan') }}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }} row">
              <label for="alamat" class="col-sm-3 col-form-label">@lang('Alamat')</label>

              <div class="col">
                <textarea value="{{$user->alamat}}" id="alamat" type="text" class="form-control" name="alamat">{{$user->alamat}}</textarea>

                @if ($errors->has('alamat'))
                <span class="help-block text-danger">
                  {{ $errors->first('alamat') }}
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }} row">
              <label for="no_hp" class="col-sm-3 col-form-label">@lang('No HP')</label>

              <div class="col">
                <input value="{{$user->no_hp}}" id="no_hp" type="text" class="form-control" name="no_hp">

                @if ($errors->has('no_hp'))
                <span class="help-block text-danger">
                  {{ $errors->first('no_hp') }}
                </span>
                @endif
              </div>
            </div>

            <div class="row">
              <div class="col text-right">
                <button type="submit" class="btn btn-primary">
                  @lang('Save')
                </button>
              </div>
            </div>
          </div><!--col-->
          </div><!--row-->
        </div><!--card-body-->
      </div><!--card-->
    </form>
  </div>

  <div class="col-xl-6">
    <div class="card">
      <div id="qr-code" class="card-body">
        <img src="data:{{$qrCodeData}};base64,{{$qrCodeBase64}}" alt="QR Code">
        <input type="button" value="Print"  onclick="printImg()" />
        <br />
        <small>Silahkan download dan print QR Code ini untuk login melalui aplikasi</small>
      </div>
    </div>
  </div>

</div>
@endsection

@section('js')
<script>
function printImg() {
    window.open("", "Image");
    window.document.write("<img src='"+document.getElementById("qr-code").children[0].src+"''>");
    window.print();
}
</script>
@endsection
