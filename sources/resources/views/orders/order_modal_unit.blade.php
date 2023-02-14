<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">WAJIB DI ISI!!!</h4>
        </div>
        <div class="modal-body">
            <div class="input-group">
            <span class="input-group-addon bg-danger" @click="minus">-</span>
            <input type="text" class="form-control" v-model="form_cart.qty" disabled>
            <span class="input-group-addon bg-success" @click="plus">+</span>
            </div>
            <div class="button-unit" style="margin-top:10px; text-align:center">
            <button class="btn btn-info" @click="addCartItem(form_cart.p_code, form_cart.unit_small, form_cart.sell_price_small, form_cart.unit_small_id)">@{{form_cart.unit_small}}</button>
            <button class="btn btn-info" style="margin-left:10px; margin-right:10px" @click="addCartItem(form_cart.p_code, form_cart.unit_medium, form_cart.sell_price_medium, form_cart.unit_medium_id)">@{{form_cart.unit_medium}}</button>
            <button class="btn btn-info" @click="addCartItem(form_cart.p_code, form_cart.unit_large, form_cart.sell_price_large, form_cart.unit_large_id)">@{{form_cart.unit_large}}</button>
            </div>
            <!-- <select class="form-control" style="margin-top:10px" v-model="form_cart.unit_id">
            <option selected :value="form_cart.unit_small_id" @click="unitCart(form_cart.unit_small, form_cart.sell_price_small)">@{{form_cart.unit_small}}</option>
            <option :value="form_cart.unit_medium_id" @click="unitCart(form_cart.unit_medium, form_cart.sell_price_medium)">@{{form_cart.unit_medium}}</option>
            <option :value="form_cart.unit_large_id" @click="unitCart(form_cart.unit_large, form_cart.sell_price_large)">@{{form_cart.unit_large}}</option>
            </select> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <!-- <button type="button" class="btn btn-primary" @click="addCartItem(form_cart.p_code)"> <i class="fa fa-cart-plus"></i> Add to Chart</button> -->
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>