@extends('layout.app')

@section('title', 'Data Testimoni')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Testimoni
            </h4>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-4">
                    <a href="#modal-form" class="btn btn-primary btn-tambah">Tambah Data</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Testimoni</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Data Testimoni</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-testimoni">
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Nama Testimoni</label>
                                        <input required type="text" class="form-control" name="nama_testimoni"
                                            placeholder="Nama testimoni">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Deskripsi</label>
                                        <textarea required type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" cols="30"
                                            rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Gambar</label>
                                        <input  type="file" class="form-control" name='gambar'
                                            placeholder="Gambar">
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
        </div>
    @endsection

    @push('js')
        <script>
            $(function() {

                $.ajax({
                    url: "api/testimoni",
                    success: function({
                        data
                    }) {

                        let row;

                        data.map(function(val, index) {
                            console.log(val)
                            row += `
                            <tr>
                                <td>${index+1}</td>
                                <td>${val.nama_testimoni}</td>
                                <td>${val.deskripsi}</td>
                                <td><img src=/uploads/${val.gambar} witdh="50" height="50"></td>
                                <td>
                                    <a data-toogle="modal" href="#modal-form" data-id="${val.id}" class="btn btn-warning btn-sm btn-edit">Edit</a>
                                    <a href="#" data-id="${val.id}" class='btn btn-danger btn-sm btn-hapus'>Hapus</a>
                                </td>
                            </tr>
                            `
                        })

                        $('tbody').append(row);
                    }
                });


                $(document).on('click', '.btn-hapus', function() {
                    const id = $(this).data('id')
                    const tokens = getCookie('token')

                    const confirmDelete = confirm('Apakah anda yakin?')



                    if (confirmDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: "api/testimoni/" + id,
                            headers: {
                                Authorization: 'Bearer ' + tokens
                            },
                            success: function(data) {
                                if (data.success) {
                                    alert('Data Terhapus!')
                                    window.location.reload();

                                }
                            }
                        });
                    }
                });


                $('.btn-tambah').click(function() {
                    $('#modal-form').modal('show')
                    $("input[name='nama_testimoni']").val("");
                    $("textarea[name='deskripsi']").val("");

                    $('.form-testimoni').submit(function(e) {
                        e.preventDefault();

                        const fData = new FormData(this)
                        const tokens = getCookie('token')

                        $.ajax({

                            type: "POST",
                            url: "api/testimoni",
                            data: fData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            headers: {
                                Authorization: 'Bearer ' + tokens
                            },
                            success: function(data) {

                                if (data.success) {
                                    alert('Data Ditambah')
                                    window.location.reload();
                                }
                            }
                        });

                    });


                });

                $(document).on('click', '.btn-edit', function() {
                    $('#modal-form').modal('show')
                    const id = $(this).data('id')

                    $.get("/api/testimoni/" + id,
                        function({
                            data
                        }) {
                            $("input[name='nama_testimoni']").val(data.nama_testimoni);
                            $("textarea[name='deskripsi']").val(data.deskripsi);
                        },
                    );
                    $('.form-testimoni').submit(function(e) {
                        e.preventDefault();

                        const fData = new FormData(this)
                        const tokens = getCookie('token')

                        $.ajax({

                            type: "POST",
                            url: `api/testimoni/${id}?_method=PUT`,
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
                });

            })
        </script>
    @endpush
