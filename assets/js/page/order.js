const App = {
  data() {
    return {
      loading : false,
      items : [],
      carts : [],
      keyword : '',
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

    getProductCode: function(data){
      axios.post('api/get-product-code', data)
      .then(response => {
          if(response.status == 200 & response.data.length > 0){
            this.beep()
            
            newCart = {
                            'qty'           : 1, 
                            'unit'          : 'Pcs', 
                            'p_name'        : response.data[0].p_name,
                            'price'         : parseInt(response.data[0].sell_price),
                            'discon'        : 0,
                            'discon_price'  : response.data[0].sell_price * 0/100,
                            'subtotal'      : 1 * (response.data[0].sell_price - (response.data[0].sell_price * 0/100))
                        };

            this.carts.push(newCart)
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

    addCart: function(code){
      const data = {'code' : code};
      this.getProductCode(data)
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