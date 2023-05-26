@extends('layout.app')

@section('title', 'Data Barang')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Barang
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
                                <th>Kategori</th>
                                <th>Subkategori</th>
                                <th>Nama barang</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Bahan</th>
                                <th>Tags</th>
                                <th>Sku</th>
                                <th>Ukuran</th>
                                <th>Warna</th>
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
                        <h5 class="modal-title text-dark font-weight-bold">Data barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-barang">
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Kategori</label>
                                        <select class="form-control" name="id_kategori" id="id_kategori">
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Subkategori</label>
                                        <select class="form-control" name="id_subkategori" id="id_subkategori">
                                            @foreach ($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}">{{$subcategory->nama_subkategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Nama barang</label>
                                        <input required type="text" class="form-control" name="nama_barang"
                                            placeholder="Nama barang">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Deskripsi</label>
                                        <textarea required type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" cols="30"
                                            rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Gambar</label>
                                        <input  required type="file" class="form-control" name='gambar'
                                            placeholder="Gambar">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Harga</label>
                                        <input required  type="text" class="form-control" name='harga'
                                            placeholder="Harga">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Diskon</label>
                                        <input required  type="text" class="form-control" name='diskon'
                                            placeholder="Diskon">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Bahan</label>
                                        <input required  type="text" class="form-control" name='bahan'
                                            placeholder="Bahan">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Tags</label>
                                        <input required  type="text" class="form-control" name='tags'
                                            placeholder="Tags">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Sku</label>
                                        <input required  type="text" class="form-control" name='sku'
                                            placeholder="Sku">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Ukuran</label>
                                        <input required  type="text" class="form-control" name='ukuran'
                                            placeholder="Ukuran">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Warna</label>
                                        <input required  type="text" class="form-control" name='warna'
                                            placeholder="Warna">
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
                    url: "api/produk",
                    success: function({
                        data
                    }) {

                        let row;

                        data.map(function(val, index) {
                            console.log(val)
                            row += `
                            <tr>
                                <td>${index+1}</td>
                                <td>${val.category.nama_kategori}</td>
                                <td>${val.subcategory.nama_subkategori}</td>
                                <td>${val.nama_barang}</td>
                                <td>${val.deskripsi}</td>
                                <td><img src=/uploads/${val.gambar} witdh="50" height="50"></td>
                                <td>Rp.${val.harga}</td>
                                <td>${val.diskon}</td>
                                <td>${val.bahan}</td>
                                <td>${val.tags}</td>
                                <td>${val.sku}</td>
                                <td>${val.ukuran}</td>
                                <td>${val.warna}</td>
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
                            url: "api/produk/" + id,
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
                    $("input[name='nama_barang']").val("");
                    $("textarea[name='deskripsi']").val("");
                    $("input[name='harga']").val("");
                    $("input[name='diskon']").val("");
                    $("input[name='bahan']").val("");
                    $("input[name='tags']").val("");
                    $("input[name='sku']").val("");
                    $("input[name='ukuran']").val("");
                    $("input[name='warna']").val("");                   

                    $('.form-barang').submit(function(e) {
                        e.preventDefault();

                        const fData = new FormData(this)
                        const tokens = getCookie('token')

                        $.ajax({

                            type: "POST",
                            url: "api/produk",
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

                    $.get("/api/produk/" + id,
                        function({
                            data
                        }) {
                            $("input[name='nama_barang']").val(data.nama_barang);
                            $("textarea[name='deskripsi']").val(data.deskripsi);
                            $("input[name='harga']").val(data.harga);
                            $("input[name='diskon']").val(data.diskon);
                            $("input[name='bahan']").val(data.bahan);
                            $("input[name='tags']").val(data.tags);
                            $("input[name='sku']").val(data.sku);
                            $("input[name='ukuran']").val(data.ukuran);
                            $("input[name='warna']").val(data.warna);                        
                        },
                    );
                    $('.form-barang').submit(function(e) {
                        e.preventDefault();

                        const fData = new FormData(this)
                        const tokens = getCookie('token')

                        $.ajax({

                            type: "POST",
                            url: `api/produk/${id}?_method=PUT`,
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
