@extends('layout.app')

@section('title', 'Data Pesanan Dikirim')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Pesanan Dikirim
            </h4>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pesanan</th>
                                <th>Invoice</th>
                                <th>Member</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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

                const tokens = getCookie('token')

                $.ajax({
                    url: "/api/pesanan/dikirim",
                    headers: {
                        Authorization: 'Bearer ' + tokens
                    },
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
                                <td>${val.invoice}</td>
                                <td>${val.member.nama_member}</td>
                                <td>${rupiah(val.grand_total)}</td>
                                <td>
                                    <a href="#" data-id="${val.id}" class='btn btn-success btn-sm btn-konfirmasi'>Terima</a>
                                </td>
                            </tr>
                            `
                        })

                        $('tbody').append(row);
                    }
                });

                $(document).on('click', '.btn-konfirmasi', function(e) {
                    e.preventDefault();

                    const tokens = getCookie('token');
                    const id = $(this).data('id');
                    const confirmData = confirm('Apakah anda yakin?')

                    if (confirmData) {
                        $.ajax({
                            type: "POST",
                            url: "/api/pesanan/ubah_status/" + id,
                            data: {
                                status: "Diterima"
                            },
                            headers: {
                                Authorization: 'Bearer ' + tokens
                            },
                            success: function(data) {
                                if (data.success) {
                                    window.location.reload()
                                }
                            }
                        });
                    }



                });
            })
        </script>
    @endpush
