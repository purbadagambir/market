const App = {
  data() {
    return {
      loading : false,
      show: false,
      submit : true,
      items : [],
      entriesOption : [{'value' : 10},{'value' : 25},{'value' : 50}, {'value' : 100}],
      table : {
        column : 'title',
        keyword : '',
        perPage : 10,
        pageSelect : 1,
        name : 'Purchase',
        id : null,
        store_id : null
      },
      meta : [],
      buttonPage : [],
      form:{
        id : null,
        title : null,
        code : null,
        symbol_left : '-',
        symbol_right : '-',
        decimal_place : null,
        status : null,
        short_order : null
      },
      hasError : {
        title : false,
        code : false,
        decimal_place : false,
        status : false
      },
      error: {
        title : false,
        code : false,
        decimal_place : false,
        status : false
      },
    }
  },
  methods:{
    //TABLE FUNCTION
    pageButton: function(data){
      const page = {}
      if(data > 5 && (data - 5) >  1){
        if(this.table.pageSelect > 5 && this.table.pageSelect > 5 && this.table.pageSelect < (data - 3)){
          page[0] = {'page' : 1}
          page[1] = {'page' : '...'}
          page[2] = {'page' : this.table.pageSelect}
          page[3] = {'page' : '...'}
          page[4] = {'page' : data}

          return page;
        }else if(this.table.pageSelect == data){
          page[0] = {'page' : 1}
          page[1] = {'page' : '...'}
          for (let i = 2; i < 6; i++) {
            page[i]= {'page' : i+(data - 5)};
          }
          return page;
        }else if(this.table.pageSelect >= (data - 3) && this.table.pageSelect < data){
          page[0] = {'page' : 1}
          page[1] = {'page' : '...'}
          for (let i = 2; i < 6; i++) {
            page[i]= {'page' : i+(data - 5)};
          }
          return page;
        }else{
          for (let i = 0; i < 5; i++) {
            page[i]= {'page' : i+1};
          }
          page[5] = {'page' : '...'}
          page[6] = {'page' : data}
          return page;
        }
      }else{
        for (let i = 0; i < this.meta.last_page; i++) {
          page[i]= {'page' : i+1};
        }
        return page;
      }
    },

    entries: function(){
      this.table.pageSelect = 1
      const store_id = document.getElementById("store_id").value
      const data = {'table' : this.table, 'store_id' : store_id}
      this.getData(data)
    },

    search: function(column){
      this.table.pageSelect = null
      this.table.column = column
      var value = document.getElementById(column).value
      this.table.keyword = value

      this.getData(this.table)
    },

    page: function(data){
      this.table.pageSelect = data
      this.getData(this.table)
    },
    
    nextPage: function(){
      if(this.table.pageSelect < this.meta.last_page)
      {
        this.table.pageSelect++
        this.getData(this.table)
      }
    },

    backPage: function(){
      if(this.table.pageSelect > 1)
      {
        this.table.pageSelect--
        this.getData(this.table)
      }
    },
    //TABLE FUNCTION END

    //FORM FUNCTION
    resetForm: function () { 
      this.form.title = null,
      this.form.code = null,
      this.form.symbol_left = null,
      this.form.symbol_right = null,
      this.form.decimal_place = null,
      this.form.status = null,
      this.form.short_order = null
    },

    cancelForm: function(){
      this.show = false
      this.submit = true
      this.resetForm()
    },
    
    openForm: function(){
      this.show = true
    },

    closeForm: function(){
      this.show = false
    },
    //END FORM FUNCTION

    //CRUD FUNCTION
    getData: function(data){
      axios.post('api/get-supplier-list', data)
         .then(response => {
            if(response.status == 200){
              this.items = response.data.data
              this.meta = response.data.meta
              this.buttonPage = this.pageButton(this.meta.last_page)
            }else{
              this.items = ''
            }
         })
         .catch(error => {
            notifError('Error')
         })
    },
    //END CRUD FUNCTION
  },

  mounted() {
    const store_id = document.getElementById("store_id").value
    this.table.store_id = store_id
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");