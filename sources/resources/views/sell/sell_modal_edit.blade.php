<div class="modal fade" id="modal-edit-sell">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header modal-info">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Invoice >>> @{{modalEdit.invoice_number}}</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td class="tb-right bg-gray">Customer</td>
                        <td class="tb-left">@{{modalEdit.customer_name}}</td>
                    </tr>
                    <tr>
                        <td class="tb-right bg-gray">Subtotal</td>
                        <td class="tb-left">@{{modalEdit.subtotal}}</td>
                    </tr>
                    <tr>
                        <td class="tb-right bg-gray">Discount</td>
                        <td class="tb-left">@{{modalEdit.discount_amount}}</td>
                    </tr>
                    <tr>
                        <td class="tb-right bg-gray">Invoice Amount</td>
                        <td class="tb-left">@{{modalEdit.payable_amount}}</td>
                    </tr>
                    <tr>
                        <td class="tb-right bg-gray">Paid Amount</td>
                        <td class="tb-left">@{{modalEdit.paid_amount}}</td>
                    </tr>
                    <tr>
                        <td class="tb-right bg-gray">Due</td>
                        <td class="tb-left">@{{modalEdit.due}}</td>
                    </tr>
                </tbody>
            </table>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="customer_mobile" class="col-sm-2 control-label">Customer Mobile</label>
                    <div class="col-sm-7">
                    <input type="number" class="form-control" id="customer_mobile" v-model='modalEdit.customer_mobile'>
                    </div>
                </div>
                <div class="form-group">
                    <label for="invoice_note" class="col-sm-2 control-label">Invoice Note</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="" id="" cols="7" rows="2" v-model='modalEdit.invoice_note'></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-7">
                    <select class="form-control" v-model='modalEdit.status'>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a class="btn btn-info" @click='updateSell'> <i class="fa fa-fw fa-pencil"></i> Update </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>