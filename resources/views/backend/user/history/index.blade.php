@extends('layouts.backend')

@section('title', __('Pemakaian Saya'))

@section('content')
<div class="all-url">
  <div class="card">
    <div class="card-body">
      <div class="row mb-3">
      <div class="col-sm-6">
        <h4 class="card-title mb-0">
          @lang('Pemakaian saya')
        </h4>
      </div><!--col-->
      <div class="col-sm-6">
      </div><!--col-->
      </div><!--row-->

      @include('messages')

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Perhatian !</strong> Sebelum anda menambahkan history, pastikan anda telah mengisi identitas di menu Pengguna -> Profilku.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="row">
        <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <strong>Tambah Pemakaian</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="addBerita" class="" method="POST" action="{{ route('user.history.store') }}"  enctype="multipart/form-data">

                            <input id="id_pelanggan" type="hidden" class="form-control" name="id_pelanggan" value="{{ auth()->user()->id_pelanggan }}" required autofocus>
                            <div class="form-group">
                                <label for="bulan" class="col-md-12 col-form-label">Bulan</label>

                                <div class="col-md-12">
                                    <input id="bulan" type="text" class="form-control" name="bulan" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tahun" class="col-md-12 col-form-label">Tahun</label>

                                <div class="col-md-12">
                                    <input id="tahun" type="text" class="form-control" name="tahun" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_pemakaian" class="col-md-12 col-form-label">Meteran Saat ini</label>

                                <div class="col-md-12">
                                  <input id="jumlah_pemakaian" type="text" class="form-control" name="jumlah_pemakaian" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto_meteran" class="col-md-12 col-form-label">Foto meteran</label>

                                <div class="col-md-12">
                                  <input id="foto_meteran" type="file" class="form-control" name="foto_meteran" value="" required autofocus accept="image/*">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-3">
                                    <button type="button" class="btn btn-primary btn-block desabled" id="submitBerita">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <strong>@lang('List History Pemakaian')</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <input type="hidden" id="id_pelanggan" value="{{auth()->user()->id_pelanggan}}" />
                        <table id="dt-berita" class="table table-responsive-sm table-striped">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Bulan')</th>
                                <th scope="col">@lang('Tahun')</th>
                                <th scope="col">@lang('ID Pelanggan')</th>
                                <th scope="col">@lang('Jumlah Pemakaian')</th>
                                <th scope="col">@lang('Foto Meteran')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                              @php $id = 1; @endphp
                              @foreach($histories as $history)
                                @if(isset($history['bulan']))
                                  @php $id += 1; @endphp

                                  <tr>
                                      <td>{{ $history['bulan'] }}</td>
                                      <td>{{ $history['tahun'] }}</td>
                                      <td>{!! $history['id_pelanggan'] !!}</td>
                                      <td>{{ $history['jumlah_meteran'] }}</td>
                                      <td>@if($history['foto_meteran']) <img src="{{ $history['foto_meteran']}}" width="200" height="200" /> @else <img src="https://placehold.it/200" /> @endif </td>
                                      <td><a data-toggle="modal" data-target="#update-modal-{{ $id }}" class="btn btn-outline-success updateData" data-id="'+index+'">Lihat</a>
                                  </tr>

                                  <div id="update-modal-{{ $id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                      <div class="modal-dialog" style="width:100%;">
                                          <div class="modal-content" style="overflow: hidden;">
                                              <div class="modal-header">
                                                  <h4 class="modal-title" id="custom-width-modalLabel">Lihat History</h4>
                                                  <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                                              </div>
                                              <div class="modal-body" id="updateBody">
                                                <div class="form-group">
                                                        <label for="Judul" class="col-md-12 col-form-label">Tahun</label>
                                                        <div class="col-md-12">
                                                            <input id="judul" type="text" class="form-control" name="judul" value="{{ $history['tahun'] }}" disabled required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category" class="col-md-12 col-form-label">Bulan</label>
                                                        <div class="col-md-12">
                                                            <input id="category" type="text" class="form-control" name="category" value="{{ $history['bulan'] }}" disabled required autofocus>
                                                        </div>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="Content" class="col-md-12 col-form-label">Jumlah Pemakaian</label>
                                                        <div class="col-md-12">
                                                            <input id="category" type="text" class="form-control" name="category" value="{{ $history['jumlah_meteran'] }}" disabled required autofocus>
                                                        </div>
                                                        </div>
                                                    <div class="form-group">
                                                        <label for="Content" class="col-md-12 col-form-label">Foto Meteran</label>
                                                        <div class="col-md-12">
                                                          @if($history['foto_meteran'])
                                                            <img src="{{ $history['foto_meteran']}}" width="200" height="200" />
                                                          @else
                                                            <img src="https://placehold.it/200" width="200" height="200" />
                                                          @endif
                                                        </div>
                                                      </div>

                                                        <div class="form-group">
                                                            <label for="Content" class="col-md-12 col-form-label">Jumlah Bayar</label>
                                                            <div class="col-md-12">
                                                                @if(isset($history['total_bayar']))<input id="jumlah_bayar" type="text" class="form-control" name="category" value="Rp. {{ $history['total_bayar'] }}" disabled required autofocus>@endif
                                                            </div>
                                                            </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                @endif
                              @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>
  </div>
</div>

@endsection

@section('js')
<script>

// Add Data
$('#submitBerita').on('click', function(e){
  e.preventDefault();
  e.stopPropagation();
  var thisBtn = $(this);
  var thisForm = thisBtn.closest("form");
  var formData = new FormData(thisForm[0]);
	var values = $("#addBerita").serializeArray();
	var bulan = values[0].value;
  var tahun = values[1].value;
	var jumlah_pemakaian = values[2].value;

  // Fire off the request to /form.php
  request = $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('user.history.store' )}}",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,

  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR){
      // Log a message to the console
      window.location.reload();
  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown){
      // Log the error to the console
      console.error(
          "The following error occurred: "+
          textStatus, errorThrown
      );
  });

  $("#addBerita input").val("");
  $("#addBerita textarea").val("");
});
</script>
@endsection
