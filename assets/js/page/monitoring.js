const App = {
  data() {
    return {
      loading : false,
      items : [],
      periode : {
        start : null,
        end : null
      }
    }
  },
  methods:{
    getData: function(data){
      axios.post('api/get-monitoring', data)
         .then(response => {
            this.items = response.data.data
         })
         .catch(error => {
            notifError('Error')
         })
    },

    searchByPeriode: function(){
      if(this.periode.start == null || this.periode.end == null)
      {
        notifError('Periode harus di isi lengkap')
      }

      const data = {'start' : this.periode.start, 'end' : this.periode.end}

      this.getData(data)

    }
  },

  mounted() {
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");