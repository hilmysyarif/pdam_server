@extends('layouts.backend')

@section('title', __('Berita'))

@section('content')
<div class="all-url">
  <div class="card">
    <div class="card-body">
      <div class="row mb-3">
      <div class="col-sm-6">
        <h4 class="card-title mb-0">
          @lang('Berita')
        </h4>
      </div><!--col-->
      <div class="col-sm-6">
      </div><!--col-->
      </div><!--row-->

      @include('messages')

        <div class="row">
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <strong>Tambah Berita</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="addBerita" class="" method="POST" action="{{ route('admin.berita.store')}}">
                            <div class="form-group">
                                <label for="judul" class="col-md-12 col-form-label">Judul</label>

                                <div class="col-md-12">
                                    <input id="judul" type="text" class="form-control" name="judul" value="" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-md-12 col-form-label">Category</label>

                                <div class="col-md-12">
                                    <input id="category" type="text" class="form-control" name="category" value="" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-12 col-form-label">Content</label>

                                <div class="col-md-12">
                                    <textarea id="content" type="text" class="form-control" name="content" value="" required autofocus></textarea>
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
                                <strong>@lang('List Berita')</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="dt-berita" class="table table-responsive-sm table-striped">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Judul')</th>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Content')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                              @foreach($beritas as $berita)
                                <tr>
                                    <td>{{ $berita->judul }}</td>
                                    <td>{{ $berita->category->name }}</td>
                                    <td>{!! $berita->content !!}</td>
                                    <td><a data-toggle="modal" data-target="#update-modal-{{ $berita->id }}" class="btn btn-outline-success updateData" data-id="'+index+'">Lihat</a>
                                      <a data-toggle="modal" data-target="#remove-modal-{{ $berita->id }}" class="btn btn-outline-danger removeData" data-id="{{ $berita->id }}">Hapus</a></td>
                                </tr>

                                <div id="update-modal-{{ $berita->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="width:100%;">
                                        <div class="modal-content" style="overflow: hidden;">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="custom-width-modalLabel">Lihat Berita</h4>
                                                <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body" id="updateBody">
                                              <div class="form-group">
                                                      <label for="Judul" class="col-md-12 col-form-label">Judul</label>
                                                      <div class="col-md-12">
                                                          <input id="judul" type="text" class="form-control" name="judul" value="{{ $berita->judul }}" disabled required autofocus>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="category" class="col-md-12 col-form-label">Category</label>
                                                      <div class="col-md-12">
                                                          <input id="category" type="text" class="form-control" name="category" value="{{ $berita->category->name }}" disabled required autofocus>
                                                      </div>
                                                    </div>
                                                  <div class="form-group">
                                                      <label for="Content" class="col-md-12 col-form-label">Konten</label>
                                                      <div class="col-md-12">
                                                          <textarea id="konten" type="text" class="form-control" name="konten" disabled required autofocus>{{ $berita->content}}</textarea>
                                                      </div>
                                                      </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('admin.berita.destroy')}}" method="DELETE" class="users-remove-record-model">
                                    <div id="remove-modal-{{ $berita->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog" style="width:55%;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="custom-width-modalLabel">Hapus Berita</h4>
                                                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Kamu yakin akan menghapus berita ini?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light deleteMatchRecord">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
var lastIndex = 0;
// Add Data
$('#submitBerita').on('click', function(){
	var values = $("#addBerita").serializeArray();
	var judul = values[0].value;
  var category = values[1].value;
	var content = values[2].value;

  // Fire off the request to /form.php
  request = $.ajax({
      url: "/admin/berita",
      type: "post",
      data: values
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

// Remove Data
$("body").on('click', '.removeData', function() {
	var id = $(this).attr('data-id');
	$('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
});

$('.deleteMatchRecord').on('click', function(){
	var values = $(".users-remove-record-model").serializeArray();
	var id = values[0].value;

  // Fire off the request to /form.php
  request = $.ajax({
      url: "/admin/berita",
      type: "delete",
      data: {id: id}
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
	$("#remove-modal").modal('hide');
});
$('.remove-data-from-delete-form').click(function() {
    $('body').find('.users-remove-record-model').find( "input" ).remove();
	$('body').find('.users-remove-record-model').find( "textarea" ).remove();
});

</script>
@endsection
