const App = {
  data() {
    return {
      loading : false,
      items : [],
      carts : [],
      carts_footer : {
        sum_qty_carts : 0,
        sum_discont_carts : 0,
        sum_total_carts : 0,
        sum_subtotal_carts : 0,
        sum_total_amount_carts : 0
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
      }
    }
  },
  methods:{

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

    unitCart: function(unit, price)
    {
      this.form_cart.unit_name = unit
    },

    getProductCode: function(data){
      console.log(data)
      axios.post('api/get-product-code', data)
      .then(response => {
          if(response.status == 200 & response.data.length > 0){
            console.log(response.data[0].sell_discount)
            newCart = {
                            'qty'           : this.form_cart.qty, 
                            'unit'          : this.form_cart.unit_name, 
                            'p_name'        : response.data[0].p_name,
                            'price'         : parseInt(response.data[0].sell_price),
                            'discont'       : response.data[0].sell_discount,
                            'discont_price' : response.data[0].sell_price * response.data[0].sell_discount/100,
                            'subtotal'      : this.form_cart.qty * response.data[0].sell_price,
                            'total'         : this.form_cart.qty * (response.data[0].sell_price - (response.data[0].sell_price * 0/100))
                        };

            this.carts.push(newCart)
            console.log(this.carts)
            this.form_cart.qty = 1
            this.form_cart.unit_id = null,
            this.form_cart.unit_small = null
            this.form_cart.unit_small_id = null
            this.form_cart.unit_medium = null
            this.form_cart.unit_medium_id = null
            this.form_cart.unit_large = null
            this.form_cart.unit_large_id = null
            this.form_cart.p_code = null

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

    getProductInfo: function(data){
      axios.post('api/get-product-info', data)
      .then(response => {
          if(response.status == 200){
            this.form_cart.unit_small = response.data.data[0].unit_small
            this.form_cart.unit_medium = response.data.data[0].unit_medium
            this.form_cart.unit_large = response.data.data[0].unit_large
            this.form_cart.p_code = response.data.data[0].product_code
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

    getProduct: function(){
      if(isNaN(parseInt(this.keyword)))
      {
        console.log('string')
      }
      else
      {
        const data = {'code' : this.keyword};
        this.getProductCode(data)
      }
    },

    showModal: function(p_id, p_code, unit_small, unit_small_id, unit_medium, unit_medium_id, unit_large, unit_large_id){
      console.log(unit_small)
      this.form_cart.unit_small = unit_small
      this.form_cart.unit_small_id = unit_small_id
      this.form_cart.unit_medium = unit_medium
      this.form_cart.unit_medium_id = unit_medium_id
      this.form_cart.unit_large = unit_large
      this.form_cart.unit_large_id = unit_large_id
      this.form_cart.p_code = p_code
      
    },

    addCartItem: function(code){
      const data = {'code' : code};
      this.getProductCode(data)
    },

    deleteCartItem: function(index) {
      this.carts.splice(index, 1)
      this.calculte()
    },

    //CRUD FUNCTION
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
  },

  mounted() {
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");