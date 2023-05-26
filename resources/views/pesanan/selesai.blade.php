@extends('layout.app')

@section('title', 'Data Pesanan Selesai')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Data Pesanan Selesai
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
                    url: "/api/pesanan/selesai",
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
                            </tr>
                            `
                        })

                        $('tbody').append(row);
                    }
                });
            })
        </script>
    @endpush
