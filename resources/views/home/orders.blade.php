@extends('layout.home')

@section('title', 'Checkout')

@section('content')
    <!-- Checkout -->
    <section class="section-wrap checkout pb-70">
        <div class="container relative">
            <div class="row">

                <div class="ecommerce col-xs-12">
                    <h2>My Payments</h2>
                    <table class="table table-ordered table-hover table-striped border-tab">
                        <thead>
                            <th class="tb-pay">No</th>
                            <th class="tb-pay">Tanggal</th>
                            <th class="tb-pay">Nominal Transfer</th>
                            <th class="tb-pay">Status</th>
                        </thead>
                        @foreach ($payments as $index => $payment)
                            <tbody>
                                <td class="tb-pay">{{ $index + 1 }}</td>
                                <td class="tb-pay">{{ $payment->created_at }}</td>
                                <td class="tb-pay">Rp.{{ number_format($payment->jumlah) }}</td>
                                <td class="tb-pay">{{ $payment->status }}</td>
                            </tbody>
                        @endforeach
                    </table>

                    <h2>My Orders</h2>
                    <table class="table table-ordered table-hover table-striped border-tab">
                        <thead>
                            <th class="tb-pay">No</th>
                            <th class="tb-pay">Tanggal</th>
                            <th class="tb-pay">Total</th>
                            <th class="tb-pay">Status</th>
                            <th class="tb-pay">Aksi</th>
                        </thead>
                        @foreach ($orders as $index => $order)
                            <tbody>
                                <td class="tb-pay">{{ $index + 1 }}</td>
                                <td class="tb-pay">{{ $order->created_at }}</td>
                                <td class="tb-pay">Rp.{{ number_format($order->grand_total) }}</td>
                                <td class="tb-pay">{{ $order->status }}</td>
                                <td class="tb-pay">
                                    <form action="/pesanan_selesai/{{$order->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-color">
                                            <span>SELESAI</span>
                                        </button>
                                    </form>
                                </td>
                            </tbody>
                        @endforeach
                    </table>

                </div> <!-- end ecommerce -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section> <!-- end checkout -->
@endsection
