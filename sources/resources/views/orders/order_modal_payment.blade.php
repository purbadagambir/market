<div class="modal fade" id="modal-payment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Payment <i class="fa fa-arrow-right"></i> @{{customer_mobile}} (@{{customer_name}})</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="list-group">
                @foreach($data['pmethod'] as $pmethod)
                <button class="list-group-item payment" id="pmethod{{$pmethod->pmethod_id}}" @click="setPayment({{$pmethod->pmethod_id}}, '{{$pmethod->code_name}}')">{{$pmethod->name}}</button>
                @endforeach
                </div>
            </div>
            <div class="col-md-5 col-sm-12 text-center">
                <h5>Pmethod : @{{payment.p_method_name}}</h5>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <button class="btn btn-block btn-success" @click="fullPayent()"><i class="fa fa-money"></i> Full Payment</button>
                    </div>
                </div>
                <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" id="store_id" value="{{session('store')->store_id}}">
                <div class="input-group">
                    <span class="input-group-addon">Nilai Bayar</span>
                    <input type="number" class="form-control" placeholder="Input An Amount" v-model="payment.paid_amount" @keyup="pay_amount">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">Balance To Credit</span>
                    <input type="number" class="form-control" placeholder="Input An Balance To Credit" v-model="payment.bal_credit" @keyup="pay_credit">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"> <i class="fa fa-pencil"></i> </span>
                    <input type="text" class="form-control"  v-model="payment.noted" placeholder="Note here">
                </div>
                <div class="bcash" id="bcash" v-if="payment.p_method == 2">
                    <div class="input-group">
                        <span class="input-group-addon"> Trx ID </span>
                        <input type="text" class="form-control"  v-model="payment.trxid" placeholder="Note here">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"> Mobile Number </span>
                        <input type="text" class="form-control"  v-model="payment.mobile" placeholder="Note here">
                    </div>
                </div>
                <div class="bcash" id="gcard" v-if="payment.p_method == 3">
                    <div class="input-group">
                        <span class="input-group-addon"> Trx ID </span>
                        <input type="text" class="form-control"  v-model="payment.noted" placeholder="Note here">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"> Mobile Number </span>
                        <input type="text" class="form-control"  v-model="payment.noted" placeholder="Note here">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 text-center">
                <h5>Order Detail</h5>
                <table style="width:100%" class="table table-bordered table-striped table-condensed">
                    <tr v-for="(cart, index) in carts">
                        <td >@{{index + 1}}</td>
                        <td style="text-align:left">@{{cart.p_name}} @{{cart.qty}} (@{{cart.unit}})</td>
                        <td style="text-align:right">@{{cart.price}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Subtotal</td>
                        <td style="text-align:right">@{{carts_footer.sum_subtotal_carts}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Discount</td>
                        <td style="text-align:right">@{{carts_footer.sum_discont_carts}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Tax</td>
                        <td style="text-align:right">@{{carts_footer.tax_amount}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Shipper Charger</td>
                        <td style="text-align:right">@{{carts_footer.shipping_charger}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Orther Charger</td>
                        <td style="text-align:right">@{{carts_footer.orders_charger}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">% Nilai</td>
                        <td style="text-align:right">@{{carts_footer.orders_charger}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Previous Due</td>
                        <td style="text-align:right">@{{carts_footer.orders_charger}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Nilai Tagihan (@{{carts_footer.sum_qty_carts}} items)</td>
                        <td style="text-align:right">@{{carts_footer.sum_total_amount_carts}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Nilai Bayar</td>
                        <td style="text-align:right">@{{payment.paid_amount}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Nilai Tagihan</td>
                        <td style="text-align:right">@{{payment.due_amount}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Balance</td>
                        <td style="text-align:right">@{{payment.balance}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Balance To Credit</td>
                        <td style="text-align:right">@{{payment.bal_credit}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">Balance To Cash</td>
                        <td style="text-align:right">@{{payment.pos_balance}}</td>
                    </tr>
                </table>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Cancel</button>
            <button type="button" class="btn btn-success" @click="checkOut"> <i class="fa fa-money"></i> Checkout <i class="fa fa-arrow-right"></i> </button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>