const App = {
  data() {
    return {
      loading : false,
      show: false,
      submit : true,
      items : [],
      entriesOption : [{'value' : 10},{'value' : 25},{'value' : 50}, {'value' : 100}],
      table : {
        keyword : '',
        perPage : 10,
        pageSelect : 1,
        id : null
      },
      meta : [],
      buttonPage : [],
      modalEdit : {
        invoice_number : ''
      },
      modalReturn : {
        invoice_number : ''
      }
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
      this.getData(this.table)
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

    //MODAL FUNCTION

    showModalEdit: function(invoice){
      this.modalEdit.invoice_number = invoice
      $('#modal-edit-sell').modal('show')

      const data = {'invoice_number' : invoice}

      axios.post('api/get-sell-info', data)
        .then(response => {
          this.modalEdit = response.data.data
        })

    },

    hideModalReturn: function(){
      $('#modal-return-sell').modal('hide')
    },

    showModalReturn: function(){
      console.log('invoice')

    },

    hideModalReturn: function(){
      $('#modal-return-sell').modal('hide')
    },

    updateSell: function(){
      axios.post('api/update-sell-info', this.modalEdit)
        .then(response => {
          if(response.status == 200){
            const store_id = document.getElementById("store_id").value
            const data = {'table' : this.table, 'store_id' : store_id}
            this.getData(data)
            notifSuccess('Data berhasil diupdate')
            this.hideModalEdit()
          }else{
            notifError('Error')
          }
        })
    },

    //

    //CRUD FUNCTION
    getData: function(data){
      axios.post('api/get-sell-list', data)
         .then(response => {
              this.items = response.data.data
              this.meta = response.data.meta
              this.buttonPage = this.pageButton(this.meta.last_page)
         })
    },

    
    //END CRUD FUNCTION
  },

  mounted() {
    const store_id = document.getElementById("store_id").value
    const data = {'table' : this.table, 'store_id' : store_id}
    this.getData(data)
  }
};
Vue.createApp(App).mount("#app");