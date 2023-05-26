@extends('layout.app')

@section('title', 'Data Pembayaran')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Pembayaran
            </h4>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pesanan</th>
                                <th>Jumlah</th>
                                <th>No Rekening</th>
                                <th>Atas Nama</th>
                                <th>Status</th>
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
                        <h5 class="modal-title text-dark font-weight-bold">Data pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-pembayaran">
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Tanggal</label>
                                        <input type="text" class="form-control" name="tanggal"
                                            placeholder="Tanggal" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Pesanan</label>
                                        <input type="text" class="form-control" name="pesanan"
                                            placeholder="Pesanan" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Jumlah</label>
                                        <input type="text" class="form-control" name="jumlah"
                                            placeholder="Jumlah" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">No Rekening</label>
                                        <input type="text" class="form-control" name="no_rekening"
                                            placeholder="No Rekening" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Atas Nama</label>
                                        <input type="text" class="form-control" name="atas_nama"
                                            placeholder="Atas Nama" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark font-weight-bold">Status</label>
                                        <p>
                                            <select name="status" id="status">
                                                <option value="MENUNGGU">MENUNGGU</option>
                                                <option value="DITERIMA">DITERIMA</option>
                                                <option value="DITOLAK">DITOLAK</option>
                                            </select>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
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
        </div>
    @endsection

    @push('js')
        <script>
            $(function() {

                function rupiah(angka) {
                    const format = angka.toString().split('').reverse().join('');
                    const convert = format.match(/\d{1,3}/g);
                    return 'Rp ' + convert.join('.').split('').reverse().join('')
                }

                function date(tanggal) {
                    var myDate = new Date(tanggal);
                    return (myDate.getMonth() + 1) + '/' + myDate.getDate() + '/' + myDate.getFullYear();
                }

                $.ajax({
                    url: "api/payments",
                    success: function({
                        data
                    }) {

                        let row;

                        data.map(function(val, index) {
                            console.log(val)
                            row += `
                            <tr>
                                <td>${index+1}</td>
                                <td>${date(val.created_at)}</td>
                                <td>${val.id_order}</td>
                                <td>${rupiah(val.jumlah)}</td>
                                <td>${val.no_rekening}</td>
                                <td>${val.atas_nama}</td>
                                <td>${val.status}</td>
                                <td>
                                    <a data-toogle="modal" href="#modal-form" data-id="${val.id}" class="btn btn-warning btn-sm btn-edit">Edit</a>
                                </td>
                            </tr>
                            `
                        })

                        $('tbody').append(row);
                    }
                });

                $(document).on('click', '.btn-edit', function() {
                    $('#modal-form').modal('show')
                    const id = $(this).data('id')

                    $.get("/api/payments/" + id,
                        function({
                            data
                        }) {
                            $("input[name='tanggal']").val(date(data.created_at));
                            $("input[name='pesanan']").val(data.id_order);
                            $("input[name='jumlah']").val(rupiah(data.jumlah));
                            $("input[name='no_rekening']").val(data.no_rekening);
                            $("input[name='atas_nama']").val(data.atas_nama);
                            $("select[name='status']").val(data.status);
                        },
                    );
                    $('.form-pembayaran').submit(function(e) {
                        e.preventDefault();

                        const fData = new FormData(this)
                        const tokens = getCookie('token')

                        $.ajax({

                            type: "POST",
                            url: `api/payments/${id}?_method=PUT`,
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
