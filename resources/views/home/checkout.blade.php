@extends('layout.home')

@section('title', 'Checkout')

@section('content')
    <!-- Checkout -->
    <section class="section-wrap checkout pb-70">
        <div class="container relative">
            <div class="row">

                <div class="ecommerce col-xs-12">


                    <form name="checkout" class="checkout ecommerce-checkout row" method="POST" action="/payments">
                      @csrf
                      <input type="hidden" name="id_order" value="{{$orders->id}}">
                        <div class="col-md-8" id="customer_details">
                            <div>
                                <h2 class="heading uppercase bottom-line full-grey mb-30">billing address</h2>

                                <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                    id="billing_first_name_field">
                                    <label for="billing_first_name">Provinsi
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <select required name="provinsi" id="provinsi" class="country_to_state provinsi"
                                        rel="calc_shipping_state">
                                        @foreach ($provinsi->rajaongkir->results as $provinsi)
                                            <option value="{{ $provinsi->province_id }}">{{ $provinsi->province }}</option>
                                        @endforeach
                                    </select>
                                </p>

                                <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                    id="billing_first_name_field">
                                    <label for="billing_first_name">Kota
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <select required name="kota" id="kota" class="country_to_state kota" rel="calc_shipping_state">

                                    </select>
                                </p>

                                <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                    id="billing_first_name_field">
                                    <label for="billing_first_name">Detail Alamat
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <input required type="text" class="input-text" placeholder value name="alamat"
                                        id="billing_first_name">
                                </p>

                                <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                    id="billing_first_name_field">
                                    <label for="billing_first_name">Atas Nama
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <input required type="text" class="input-text" placeholder value name="atas_nama"
                                        id="billing_first_name">
                                </p>

                                <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                    id="billing_first_name_field">
                                    <label for="billing_first_name">No Rekening
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <input required type="text" class="input-text" placeholder value name="no_rekening"
                                        id="billing_first_name">
                                </p>

                                <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                    id="billing_first_name_field">
                                    <label for="billing_first_name">Nominal Transfer
                                        <abbr class="required" title="required">*</abbr>
                                    </label>
                                    <input required type="number" class="input-text" placeholder value name="jumlah"
                                        id="billing_first_name" step="1" pattern="\d+" title="please input number">
                                </p>

                                <div class="clear"></div>

                            </div>


                            <div class="clear"></div>


                            <div class="clear"></div>

                        </div> <!-- end col -->

                        <!-- Your Order -->
                        <div class="col-md-4">
                            <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
                                <h2 class="heading uppercase bottom-line full-grey">Your Order</h2>
                                <table class="table shop_table ecommerce-checkout-review-order-table">
                                    <tbody>
                                        <tr class="order-total">
                                            <th><strong class="total-all">Order Total</strong></th>
                                            <td>
                                                <strong><span
                                                        class="amount total-all">Rp.{{ number_format($orders->grand_total) }}</span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div id="payment" class="ecommerce-checkout-payment">
                                    <h2 class="heading uppercase bottom-line full-grey">Payment Method</h2>
                                    <ul class="payment_methods methods">

                                        <li class="payment_method_bacs">
                                            <input id="payment_method_bacs" type="radio" class="input-radio"
                                                name="payment_method" value="bacs" checked="checked">
                                            <label for="payment_method_bacs">Direct Bank Transfer</label>
                                            <div class="payment_box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment reference. Your order wont be shipped until the funds
                                                    have cleared in our account.</p>
                                                <p>Atas nama : {{ $about->atas_nama }}</p>
                                                <p>Nomor Rekening : {{ $about->no_rekening }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="form-row place-order">
                                        <input type="submit" name="ecommerce_checkout_place_order"
                                            class="btn btn-lg btn-dark" id="place_order" value="Place order">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end order review -->
                    </form>

                </div> <!-- end ecommerce -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </section> <!-- end checkout -->
@endsection

@push('js')
    <script>
        $(function() {
            $('.provinsi').change(function() {

                $.ajax({
                    url: "/get_city/" + $(this).val(),
                    success: function(response) {
                        data = JSON.parse(response)
                        option = ""
                        data.rajaongkir.results.map((kota) => {
                            option +=
                                `<option required value=${kota.city_id}>${kota.city_name}</option>`
                        })
                        $('.kota').html(option);
                    }
                });

            });
        })
    </script>
@endpush
