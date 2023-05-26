@extends('layout.app')

@section('title')
    Tentang
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Tentang
            </h4>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-tentang" method="POST" enctype="multipart/form-data" action="/tentang/{{$about->id}}">
                            @csrf
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Judul Website</label>
                                <input class="form-control" name="judul_website"
                                    placeholder="Judul Website" required value="{{$about->judul_website}}">
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Logo</label>
                                <div>
                                    <img src="uploads/{{$about->logo}}" alt="" width="200">
                                </div><br>
                                <input type="file" class="form-control" name='logo' placeholder="Logo">
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" cols="30"
                                    rows="10" required >{{$about->deskripsi}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Alamat" cols="30"
                                    rows="10" required >{{$about->alamat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Email</label>
                                <input class="form-control" name="email"
                                    placeholder="Email" required value="{{$about->email}}">
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Telepon</label>
                                <input class="form-control" name="telepon"
                                    placeholder="Telepon" required value="{{$about->telepon}}">
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Atas Nama</label>
                                <input class="form-control" name="atas_nama" placeholder="Atas Nama" required
                                    value="{{ $about->atas_nama}}">
                            </div>
                            <div class="form-group">
                                <label class="text-dark font-weight-bold">Nomor Rekening</label>
                                <input class="form-control" name="no_rekening" placeholder="No Rekening" required
                                    value="{{ $about->no_rekening}}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script>
        $('.form-tentang').submit(function(e) {
                    e.preventDefault();

                    const fData = new FormData(this)
                    const tokens = getCookie('token')

                    $.ajax({

                        type: "POST",
                        url: `api/categories/${id}?_method=PUT`,
                        data: fData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            Authorization: 'Bearer ' + tokens
                        },
                        success: function(data) {

                            if (data.success) {
                                alert('Data Dirubah')
                                window.location.reload();
                            }
                        }
                    });

                });
    </script>
@endpush --}}
