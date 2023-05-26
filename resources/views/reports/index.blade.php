@extends('layout.app')

@section('title', 'Laporan Pesanan')

@section('content')

    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">
                Laporan Pesanan
            </h4>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <form>
                            <div class="form-group">
                                <label for="">dari</label>
                                <input type="date" name="dari" id="dari" class="form-control"
                                    value="{{ request()->input('dari') }}">
                            </div>
                            <div class="form-group">
                                <label for="">sampai</label>
                                <input type="date" name="sampai" id="sampai" class="form-control"
                                    value="{{ request()->input('sampai') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (request()->input('dari'))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Jumlah Dibeli</th>
                                    <th>Total</th>
                                    <th>Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    @endsection

    @push('js')
        <script>
            $(function() {

                const from = "{{ request()->input('dari') }}"
                const until = "{{ request()->input('sampai') }}"
                const tokens = getCookie('token');


                function rupiah(angka) {
                    const format = angka.toString().split('').reverse().join('');
                    const convert = format.match(/\d{1,3}/g);
                    return 'Rp ' + convert.join('.').split('').reverse().join('')
                }

                $.ajax({
                    url: `api/reports?dari=${from}&sampai=${from}`,
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
                                <td>${val.tgl}</td>
                                <td>${val.nama_barang}</td>
                                <td>${rupiah(val.harga)}</td>
                                <td>${val.jumlah_dibeli}</td>
                                <td>${val.total_q}</td>
                                <td>${rupiah(val.pendapatan)}</td>
                            </tr>
                            `
                        })

                        $('tbody').append(row);
                    }
                });

            })
        </script>
    @endpush
