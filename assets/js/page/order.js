const App = {
  data() {
    return {
      loading : false,
      items : [],
      carts : [],
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
      keyword : '',
      form_cart : {
        p_code : null,
        qty : 1,
        unit_id : null,
        unit_name : null,
        unit_small : null,
        unit_small_id : null,
        unit_medium : null,
        unit_medium_id : null,
        unit_large : null,
        unit_large_id : null,
        sell_price_small : null,
        sell_price_medium : null,
        sell_price_large : null,
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
          
          console.log(this.form_cart.price)
          this.beep()
          if(response.status == 200 & response.data.length > 0){
            newCart = {
                            'qty'           : this.form_cart.qty, 
                            'unit'          : this.form_cart.unit_name, 
                            'p_name'        : response.data[0].p_name,
                            'price'         : parseInt(this.form_cart.price),
                            'discont'       : response.data[0].sell_discount,
                            'discont_price' : this.form_cart.qty * (this.form_cart.price * response.data[0].sell_discount/100),
                            'subtotal'      : this.form_cart.qty * this.form_cart.price,
                            'total'         : this.form_cart.qty * (this.form_cart.price - (this.form_cart.price * 0/100))
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
            this.form_cart.unit_small = response.data[0].unit_small_name
            this.form_cart.unit_small_id = response.data[0].unit_small_id
            this.form_cart.unit_medium = response.data[0].unit_medium_name
            this.form_cart.unit_medium_id = response.data[0].unit_medium_id
            this.form_cart.unit_large = response.data[0].unit_large_name
            this.form_cart.unit_large_id = response.data[0].unit_large_id
            this.form_cart.p_code = response.data[0].p_code
            this.form_cart.sell_price_small = response.data[0].sell_price_small
            this.form_cart.sell_price_medium = response.data[0].sell_price_medium
            this.form_cart.sell_price_large = response.data[0].sell_price_large

            //auto select
            this.form_cart.unit_id = response.data[0].unit_small_id
            this.form_cart.unit_name = response.data[0].unit_small_name
            this.form_cart.price = response.data[0].sell_price_small
            console.log(this.form_cart.price)
            this.showModal()
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
      const data = {'code' : code};
      this.getProductInfo(data)
    },

    getProductSearch: function(){
      
      const data = {'code' : this.keyword};
      this.getProductInfo(data)
      
    },

    setCustomer: function(mobile, name){
        this.customer_name = name
        this.customer_mobile = mobile

        console.log(name)
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

    addCartItem: function(code, unit, price, unit_id){
      console.log(unit)
      this.form_cart.unit_id = unit_id
      this.form_cart.unit_name = unit
      this.form_cart.price = price
      const data = {'code' : code};
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
      this.form_cart.qty = 1
      this.form_cart.unit_id = null,
      this.form_cart.unit_small = null
      this.form_cart.unit_small_id = null
      this.form_cart.unit_medium = null
      this.form_cart.unit_medium_id = null
      this.form_cart.unit_large = null
      this.form_cart.unit_large_id = null
      this.form_cart.p_code = null
      this.form_cart.sell_price_small = null
      this.form_cart.sell_price_medium = null
      this.form_cart.sell_price_large = null
      this.form_cart.price = null
    },

    deleteCartItem: function(index) {
      this.carts.splice(index, 1)
      this.calculte()
    },

  },

  mounted() {
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");