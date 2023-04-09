const App = {
  data() {
    return {
      loading : true,
      items : [],
      periode : {
        start : null,
        end : null
      }
    }
  },
  methods:{
    getData: function(data){
      axios.post('api/get-data-member', data)
         .then(response => {
            this.items = response.data.data
            this.loading = false
         })
         .catch(error => {
            notifError('Error')
         })
    },

    searchByPeriode: function(){
      this.loading = true
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