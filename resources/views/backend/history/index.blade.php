@extends('layouts.backend')

@section('title', __('History pemakaian'))

@section('content')
<div class="all-url">
  <div class="card">
    <div class="card-body">
      <div class="row mb-3">
      <div class="col-sm-6">
        <h4 class="card-title mb-0">
          @lang('History pemakaian')
        </h4>
      </div><!--col-->
      <div class="col-sm-6">
      </div><!--col-->
      </div><!--row-->

      @include('messages')

        <div class="row">

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <strong>@lang('List History Pemakaian')</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <input type="hidden" id="id_pelanggan" value="{{ auth()->user()->id_pelanggan }}" />
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
                              @foreach($histories as $history)
                                <tr>
                                    <td>{{ $history->bulan }}</td>
                                    <td>{{ $history->tahun }}</td>
                                    <td>{!! $history->user->id_pelanggan !!}</td>
                                    <td>{{ $history->jumlah_pemakaian }}</td>
                                    <td>@if($history->foto_meteran) <img src="/uploads/meteran/{{ $history->foto_meteran}}" width="200" height="200" /> @else <img src="https://placehold.it/200" /> @endif </td>
                                    <td><a data-toggle="modal" data-target="#update-modal-{{ $history->id }}" class="btn btn-outline-success updateData" data-id="'+index+'">Lihat</a>
                                </tr>

                                <div id="update-modal-{{ $history->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
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
                                                          <input id="judul" type="text" class="form-control" name="judul" value="{{ $history->tahun }}" disabled required autofocus>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="category" class="col-md-12 col-form-label">Bulan</label>
                                                      <div class="col-md-12">
                                                          <input id="category" type="text" class="form-control" name="category" value="{{ $history->bulan }}" disabled required autofocus>
                                                      </div>
                                                    </div>
                                                  <div class="form-group">
                                                      <label for="Content" class="col-md-12 col-form-label">Jumlah Pemakaian</label>
                                                      <div class="col-md-12">
                                                          <input id="category" type="text" class="form-control" name="category" value="{{ $history->jumlah_pemakaian }}" disabled required autofocus>
                                                      </div>
                                                      </div>
                                                  <div class="form-group">
                                                      <label for="Content" class="col-md-12 col-form-label">Foto Meteran</label>
                                                      <div class="col-md-12">
                                                        @if($history->foto_meteran)
                                                          <img src="/uploads/meteran/{{ $history->foto_meteran}}" width="200" height="200" />
                                                        @else
                                                          <img src="https://placehold.it/200" width="200" height="200" />
                                                        @endif
                                                      </div>
                                                      </div>

                                                      <div class="form-group">
                                                          <label for="Content" class="col-md-12 col-form-label">Jumlah Bayar</label>
                                                          <div class="col-md-12">
                                                              <input id="jumlah_bayar" type="text" class="form-control" name="category" value="Rp. {{ $history->total_bayar }}" disabled required autofocus>
                                                          </div>
                                                          </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Hapus History Pemakaian</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>Kamu yakin akan menghapus history ini?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteMatchRecord">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">History Pemakaian</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')
<script>
var Index = 0;
// Get User Data
$id_pelanggan = $('#id_pelanggan').val();
var ref = firebase.database().ref("history/meteran");
ref.orderByChild("id_pelanggan").equalTo($id_pelanggan).on("value", function(snapshot) {
    var dip = ref.child(snapshot.key);

    if(snapshot.exists()){
            var htmls = [];
            $.each(snapshot.val(), function(index, value){
                if(value) {
                    console.log(value);
                    htmls.push('<tr>\
                        <td>'+ value.bulan +'</td>\
                        <td>'+ value.tahun +'</td>\
                        <td>'+ value.id_pelanggan +'</td>\
                        <td>'+ value.jumlah_meteran +'<input type="hidden" id="meteran-lalu-' + index + '" value="' + value.jumlah_meteran + '" /></td>\
                        <td><a href="' + value.foto_meteran + '" target="_blank"><img src="'+ value.foto_meteran +'" width="100" height="100" class="img-responsive" /></a></td>\
                        <td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+index+'">Lihat</a></td>\
                    </tr>');
                }
                lastIndex = index;
            });
        $('#tbody').html(htmls);
    }
});


var lastIndex = 0;

// Get Data
$id_pelanggan = $('#id_pelanggan').val();
var ref = firebase.database().ref("history/meteran");
ref.orderByChild("id_pelanggan").equalTo($id_pelanggan).on("value", function(snapshot) {
    var dip = ref.child(snapshot.key);

    if(snapshot.exists()){
            var htmls = [];
            $.each(snapshot.val(), function(index, value){
                if(value) {
                    htmls.push('<tr>\
                        <td>'+ value.bulan +'</td>\
                        <td>'+ value.tahun +'</td>\
                        <td>'+ value.id_pelanggan +'</td>\
                        <td>'+ value.jumlah_meteran +'<input type="hidden" id="meteran-lalu-' + index + '" value="' + value.jumlah_meteran + '" /></td>\
                        <td><a href="' + value.foto_meteran + '" target="_blank"><img src="'+ value.foto_meteran +'" width="100" height="100" class="img-responsive" /></a></td>\
                        <td><a data-toggle="modal" data-target="#update-modal" class="btn btn-outline-success updateData" data-id="'+index+'">Lihat</a></td>\
                    </tr>');
                }
                lastIndex = index;
            });
        $('#tbody').html(htmls);
    }
});

// View Data
var updateID = 0;
var jumlah_bayar = 0;
$('body').on('click', '.updateData', function() {
	updateID = $(this).attr('data-id');

	firebase.database().ref('history/meteran/' + updateID).on('value', function(snapshot) {
		var values = snapshot.val();
        if(values.jumlah_meteran > 10){
            jumlah_bayar = values.jumlah_meteran * 11000;
        }else{
            jumlah_bayar = values.jumlah_meteran * 6000;
        }

		var updateData = '<div class="form-group">\
		        <label for="bulan" class="col-md-12 col-form-label">Bulan</label>\
		        <div class="col-md-12">\
		            <input id="bulan" type="text" class="form-control" name="bulan" value="'+values.bulan+'" disabled required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="tahun" class="col-md-12 col-form-label">Tahun</label>\
		        <div class="col-md-12">\
		            <input id="tahun" type="text" class="form-control" name="tahun" value="'+values.tahun+'" disabled required autofocus>\
		        </div>\
            </div>\
		    <div class="form-group">\
		        <label for="jumlah_meteran" class="col-md-12 col-form-label">Jumlah Pemakaian</label>\
		        <div class="col-md-12">\
		            <input id="jumlah_meteran" type="text" class="form-control" name="jumlah_meteran" value="'+values.jumlah_meteran+'" disabled required autofocus>\
		        </div>\
            </div>\
		    <div class="form-group">\
		        <label for="foto_meteran" class="col-md-12 col-form-label">Foto Meteran</label>\
		        <div class="col-md-12">\
                    <a href="' + values.foto_meteran + '" target="_blank"><img src="'+ values.foto_meteran + '" width="300" height="300" class="img-responsive" /></a>\
		        </div>\
            </div>\
		    <div class="form-group">\
		        <label for="total_pembayaran" class="col-md-12 col-form-label">Total yang harus dibayar</label>\
		        <div class="col-md-12">\
                    <input id="total_pembayaran" type="text" class="form-control" name="total_pembayaran" value="Rp. '+jumlah_bayar+'" disabled required autofocus>\
		        </div>\
            </div>';

		    $('#updateBody').html(updateData);
	});
});

// Add Data
$('#submitBerita').on('click', function(){
	var values = $("#addBerita").serializeArray();
	var bulan = values[1].value;
    var tahun = values[2].value;
    var id_pelanggan = $('#id_pelanggan').val();
    var jumlah_meteran = values[3].value;
	var userID = lastIndex+1;
    const ref = firebase.storage().ref();

    var timestamp = Number(new Date());
    var storageRef = firebase.storage().ref(timestamp.toString());
    var file = $('#foto_meteran').prop('files')[0];
    var task = storageRef.put(file);
    task.then(function(snapshot) {
        snapshot.ref.getDownloadURL().then(function(downloadURL) {
            firebase.database().ref('history/meteran/' + userID).set({
                bulan: bulan,
                tahun: tahun,
                id_pelanggan: id_pelanggan,
                jumlah_meteran: jumlah_meteran,
                foto_meteran: downloadURL,
            });
        });
    });

    // Reassign lastID value
    lastIndex = userID;
    $("#addBerita input").val("");
    $("#addBerita textarea").val("");
});
</script>
@endsection
