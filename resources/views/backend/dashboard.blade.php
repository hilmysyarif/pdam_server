@extends('layouts.backend')

@section('title', __('Dashboard'))

@section('content')
<div class="my-url">

  @role('admin')
    <div class="row right_now">
      <div class="col-md-12 col-xl text-center">
        <div class="card border-left">
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <div class="right_now-text--primary">
                <span id="pelanggan-terdaftar">{{ $totalPelanggan }}</span>
              </div>
              <div class="right_now-label">@lang('Pelanggan terdaftar')</div>
            </div>
            <div class="col-4">
              <div class="right_now-text--secondary">
              <span id="pelanggan-aktif">{{ $totalPelangganAktif }}</span>
              </div>
              <div class="right_now-label">@lang('Pelanggan aktif')</div>
            </div>
            <div class="col-4">
              <div class="right_now-text--tertiary">
              <span id="pelanggan-tidak-aktif">{{ $totalPelangganTdkAktif }}</span>
              </div>
              <div class="right_now-label">@lang('Pelanggan tidak aktif')</div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  @endrole

  <div class="row">
    <div class="col-md-12">
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
                            <td><a data-toggle="modal" data-target="#update-modal-{{ $berita->id }}" class="btn btn-outline-success updateData" data-id="'+index+'">Lihat</a>\
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
                      @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
  </div>
</div>


@endsection
