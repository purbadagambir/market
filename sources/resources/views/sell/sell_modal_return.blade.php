<div class="modal fade" id="modal-return-sell">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Return > @{{modalReturn.invoice_number}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 text-center">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="bg-gray">Invoice ID</td>
                                    <td>@{{modalReturn.invoice_number}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4>Order Summary</h4>
                        <table class="table table-bordered return-item-table">
                            <tbody>
                                <tr v-for="(item, index) in modalReturn.item">
                                    <td class="tb-number">@{{index + 1}}</td>
                                    <td class="tb-right">@{{item.item_name}} (x @{{item.item_quantity}} @{{item.unit_name}})</td>
                                    <td class="tb-left">@{{item.item_price}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Subtotal</td>
                                    <td class="tb-left">@{{modalReturn.price.subtotal}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Discount</td>
                                    <td class="tb-left">@{{modalReturn.price.discount_amount}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Order Tax</td>
                                    <td class="tb-left">@{{modalReturn.price.order_tax}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Shipping Charge</td>
                                    <td class="tb-left">@{{modalReturn.price.shipping_amount}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Others Charge</td>
                                    <td class="tb-left">@{{modalReturn.price.other_charge}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Interest Amount</td>
                                    <td class="tb-left">@{{modalReturn.price.interest_amount}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Previous Due</td>
                                    <td class="tb-left">@{{modalReturn.price.previous_due}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Payable Amount (@{{modalReturn.price.total_items}} items)</td>
                                    <td class="tb-left">@{{modalReturn.price.payable_amount}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Previous Due Paid</td>
                                    <td class="tb-left">@{{modalReturn.price.previous_due_paid}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Paid by @{{modalReturn.price.p_name}} on @{{modalReturn.price.created_at}} by @{{modalReturn.price.username}}</td>
                                    <td class="tb-left">@{{modalReturn.price.amount}}</td>
                                </tr>
                                <tr>
                                    <td class="tb-right" colspan="2">Due</td>
                                    <td class="tb-left">@{{modalReturn.price.due}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5 col-sm-12 text-center">
                        <span class="return-list-header" style="font-size:30px;">Return Item</span>
                        <table class="table table-bordered return-item-table">
                            <tbody>
                                <tr v-for="(item, index) in modalReturn.item">
                                    <td class="tb-number bg-gray">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="item_id" :value="item.id">
                                            </label>
                                        </div>
                                    </td>
                                    <td class="tb-left">@{{item.item_name}} (x @{{item.item_quantity}})</td>
                                    <td class="tb-center"><input type="number" class="form-control" :id="'item_qty_' + item.id" :value="item.item_quantity" :max="item.item_quantity" min="1"></td>
                                </tr>
                            </tbody>
                        </table>
                        <textarea class="form-control" name="" id="" cols="70" rows="2" placeholder="Any Message Here"></textarea>
                        <input type="hidden" id="store_id" value="{{session('store')->store_id}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Cancel</button>
                    <button type="button" class="btn btn-success" @click="returnNow"> <i class="fa fa-save"></i> Return Now <i class="fa fa-arrow-right"></i> </button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>








