const App = {
  data() {
    return {
      loading : false,
      items : [],
      carts : [],
      list_member : [],
      search_member : 'Non-Member',
      customer_mobile: '00000000000',
      customer_name: 'Non-Member',
      carts_footer : {
        sum_qty_carts : 0,
        sum_discont_carts : 0,
        sum_total_carts : 0,
        sum_subtotal_carts : 0,
        sum_total_amount_carts : 0,
        tax_amount : 0,
        shipping_charger : 0,
        orders_charger : 0,
      },
      payment : {
        p_method_name : 'cod',
        paid_amount : 0,
        due_amount : 0,
        bal_credit : 0,
        balance : 0,
        pos_balance : 0,
        p_method : 1,
        noted : null,
        trxid : '',
        mobile : ''
      },
      keyword : '',
      form_cart : {
        p_code : null,
        qty : 1,
        unit_id : null,
        unit_name : null,
        vol_unit : null,
        unit_small : null,
        unit_small_id : null,
        unit_medium : null,
        unit_medium_id : null,
        unit_large : null,
        unit_large_id : null,
        sell_price_small : null,
        sell_price_medium : null,
        sell_price_large : null,
        vol_unit_small : null,
        vol_unit_medium : null,
        vol_unit_large : null,
        price : null,
      }
    }
  },
  methods:{

    getData: function(data){
      axios.post('api/get-product-list', data)
         .then(response => {
            if(response.status == 200){
              this.items = response.data.data
            }else{
              notifError('Data Product Error')
            }
         })
         .catch(error => {
            notifError('Error')
         })
    },

    beep: function(){
      var audio = new Audio('assets/sound/beep.mp3');
      audio.play();
    },

    stop: function(){
      var audio = new Audio('assets/sound/stop.mp3');
      audio.play();
    },

    minus: function(){
      if(this.form_cart.qty > 1)
      {
        this.form_cart.qty--
      }
    },

    plus: function(){
      this.form_cart.qty++
    },

    getProductCode: function(data){
      axios.post('api/get-product-code', data)
      .then(response => {
          this.beep()
          if(response.status == 200 & response.data.length > 0){
            newCart = {
                          'qty'             : this.form_cart.qty, 
                          'unit'            : this.form_cart.unit_name, 
                          'p_id'            : response.data[0].p_id,
                          'p_name'          : response.data[0].p_name,
                          'unit_id'         : this.form_cart.unit_id,
                          'vol_unit'        : this.form_cart.vol_unit,
                          'p_name'          : response.data[0].p_name,
                          'category_id'     : response.data[0].category_id,
                          'sup_id'          : response.data[0].sup_id,
                          'brand_id'        : response.data[0].brand_id,
                          'price'           : parseInt(this.form_cart.price),
                          'purchase_price'  : parseInt(response.data[0].purchase_price),
                          'taxrate_id'      : response.data[0].taxrate_id,
                          'tax_method'      : response.data[0].tax_method,
                          'discont'         : response.data[0].sell_discount,
                          'discont_price'   : this.form_cart.qty * (this.form_cart.price * response.data[0].sell_discount/100),
                          'subtotal'        : this.form_cart.qty * this.form_cart.price,
                          'total'           : this.form_cart.qty * (this.form_cart.price - (this.form_cart.price * 0/100))
                      };

            this.carts.push(newCart)
            this.resetFormCart()
            this.calculte()

          }
          else{
            notifError('Product not found')
            this.stop()
          }
      })
      .catch(error => {
          this.stop()
          notifError('Error')
      })
    },

    getProductInfo: function(data){
      axios.post('api/get-product-info', data)
      .then(response => {
          if(response.status == 200){
            if(response.data.searchby == 'code'){
              this.form_cart.unit_small = response.data.data[0].unit_small_name
              this.form_cart.unit_small_id = response.data.data[0].unit_small_id
              this.form_cart.unit_medium = response.data.data[0].unit_medium_name
              this.form_cart.unit_medium_id = response.data.data[0].unit_medium_id
              this.form_cart.unit_large = response.data.data[0].unit_large_name
              this.form_cart.unit_large_id = response.data.data[0].unit_large_id
              this.form_cart.p_code = response.data.data[0].p_code
              this.form_cart.sell_price_small = response.data.data[0].sell_price_small
              this.form_cart.sell_price_medium = response.data.data[0].sell_price_medium
              this.form_cart.sell_price_large = response.data.data[0].sell_price_large
              this.form_cart.vol_unit_small = response.data.data[0].vol_unit_small
              this.form_cart.vol_unit_medium = response.data.data[0].vol_unit_medium
              this.form_cart.vol_unit_large = response.data.data[0].vol_unit_large

              //auto select
              this.form_cart.unit_id = response.data.data[0].unit_small_id
              this.form_cart.unit_name = response.data.data[0].unit_small_name
              this.form_cart.price = response.data.data[0].sell_price_small
              this.form_cart.vol_unit = response.data.data[0].vol_unit_small
              this.showModal()
            }else{
              this.items = response.data.data
            }
          }
          else{
            notifError('Product not found')
            this.stop()
          }
      })
      .catch(error => {
          this.stop()
          notifError('Error')
      })
    },

    getProductClik: function(code){
      const store_id = document.getElementById("store_id").value;
      const data = {'code' : code, 'store_id' : store_id};
      this.getProductInfo(data)
    },

    getProductSearch: function(){
      const store_id = document.getElementById("store_id").value;
      const data = {'code' : this.keyword, 'store_id' : store_id};
      this.getProductInfo(data)
    },

    setCustomer: function(mobile, name){
      this.list_member = []
      this.search_member = name
      this.customer_name = name
      this.customer_mobile = mobile
    },

    showModalPayment: function(){
      if(this.carts.length == 0)
      {
        notifError('Please, select at least one product item')
        this.stop()
      }
      else{
        $('#modal-payment').modal('show')
      }
    },

    showModal: function(){
      $('#modal-default').modal('show')
    },

    hideModalPayment: function(){
      $('#modal-payment').modal('hide')
    },

    hideModal: function(){
      $('#modal-default').modal('hide')
    },

    addCartItem: function(code, unit, price, unit_id, vol_unit){
      
      this.form_cart.unit_id = unit_id
      this.form_cart.unit_name = unit
      this.form_cart.price = price
      this.form_cart.vol_unit = vol_unit

      const store_id = document.getElementById("store_id").value;
      const data = {'code' : code, 'store_id' : store_id};
      this.getProductCode(data)
      this.hideModal()
    },

    
    unitCart: function(unit, price)
    {
      this.form_cart.unit_name = unit
      this.form_cart.price = price
    },

    calculte: function(){
      var sum = 0;
      var discont = 0;
      var total = 0;
      var subtotal = 0;
      var total_amount = 0;
      for (let i = 0; i < this.carts.length; i++) {
          sum += this.carts[i].qty;
          discont += this.carts[i].discont_price;
          total += this.carts[i].price;
          subtotal += this.carts[i].subtotal;
          total_amount += this.carts[i].total;
      }
      this.carts_footer.sum_qty_carts = sum
      this.carts_footer.sum_discont_carts = discont
      this.carts_footer.sum_total_carts = total
      this.carts_footer.sum_subtotal_carts = subtotal
      this.carts_footer.sum_total_amount_carts = total_amount - discont
    },

    resetFormCart: function(){
      this.form_cart.qty                = 1
      this.form_cart.unit_id            = null
      this.form_cart.unit_small         = null
      this.form_cart.unit_small_id      = null
      this.form_cart.unit_medium        = null
      this.form_cart.unit_medium_id     = null
      this.form_cart.unit_large         = null
      this.form_cart.unit_large_id      = null
      this.form_cart.p_code             = null
      this.form_cart.sell_price_small   = null
      this.form_cart.sell_price_medium  = null
      this.form_cart.sell_price_large   = null
      this.form_cart.price              = null
      this.form_cart.vol_unit           = null
      this.form_cart.vol_unit_small     = null
      this.form_cart.vol_unit_medium    = null
      this.form_cart.vol_unit_large     = null
    },

    deleteCartItem: function(index) {
      this.carts.splice(index, 1)
      this.calculte()
    },

    paymentClass: function(id) {
      var element = document.getElementById("pmethod"+id);
      element.classList.add("active");
    },

    setPayment: function(id, code_name) {
      console.log(code_name);
      var element = document.getElementById("pmethod"+this.payment.p_method);
      element.classList.remove("active");
      this.payment.p_method_name = code_name
      this.payment.p_method = id
      this.paymentClass(id)
    },

    addOrder: function(data){
      axios.post('api/add-orders', data)
      .then(response => {
          if(response.status == 200){
            var invoice_number = response.data.data
            this.hideModal()
            this.resetFormCart()
            window.open("invoice?number="+invoice_number);
            window.location.href = "pos"
          }
          else{
            notifError('Product not found')
            this.stop()
          }
      })
      .catch(error => {
          this.stop()
          notifError('Error')
      })

    },

    fullPayent: function(){
      this.payment.p_method = 1
      this.payment.paid_amount = this.carts_footer.sum_total_amount_carts
      this.payment.due_amount = 0
      const user_id = document.getElementById("user_id").value
      const store_id = document.getElementById("store_id").value
      const data = {orders : this.carts, 
                    payments : this.payment, 
                    customer_mobile : this.customer_mobile,
                    total_orders : this.carts_footer,
                    user_id : user_id,
                    store_id : store_id,
                  }
      this.addOrder(data)
    },

    checkOut: function(){
      if(this.payment.pos_balance < 0){
        notifError('Error Balance To Credit Amount Greater Than Due')
        this.stop()
      }else{

        const user_id = document.getElementById("user_id").value
        const store_id = document.getElementById("store_id").value
        const data = {orders : this.carts, 
                      payments : this.payment, 
                      customer_mobile : this.customer_mobile,
                      total_orders : this.carts_footer,
                      user_id : user_id,
                      store_id : store_id,
                    }
        this.addOrder(data)
      }
    },

    pay_amount: function(){
      if(this.payment.paid_amount > this.carts_footer.sum_total_amount_carts){
        this.payment.due_amount = this.carts_footer.sum_total_amount_carts
        this.payment.balance = this.payment.paid_amount - this.carts_footer.sum_total_amount_carts
        this.payment.pos_balance = this.payment.balance - this.payment.bal_credit
      }
      else if(this.payment.paid_amount < this.carts_footer.sum_total_amount_carts){
        this.payment.due_amount = this.carts_footer.sum_total_amount_carts - this.payment.paid_amount
        this.payment.pos_balance = 0
      }
      else{
        this.payment.due_amount = 0
      }
    },

    pay_credit: function(){
        this.payment.pos_balance = this.payment.balance - this.payment.bal_credit
    },

    searchMember: function(){
      const data = {keyword : this.search_member}
      axios.post('api/search-member', data)
      .then(response => {
          if(response.status == 200){
            this.list_member = response.data
          }
          else{
            notifError('Member not found')
            this.stop()
          }
      })
      .catch(error => {
          this.stop()
          notifError('Error')
      })

    },

  },

  mounted() {
    const store_id = document.getElementById("store_id").value;
    this.getData({store_id : store_id})
    this.paymentClass(this.payment.p_method)
  }
};
Vue.createApp(App).mount("#app");