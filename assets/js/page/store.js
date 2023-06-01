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
        name : 'Toko',
        id : null
      },
      meta : [],
      buttonPage : [],
      form:{
        id : null,
        name : null,
        code_name : null,
        store_type : null,
        mobile : null,
        email : null,
        zip_code : null,
        address : null,
        koordinat : null,
        cashier : null
      },
      hasError : {
        name : false,
        code_name : false,
        store_type : false,
        mobile : false,
        email : false,
        zip_code : false,
        cashier : false,
      },
      error: {
        name : false,
        code_name : false,
        store_type : false,
        mobile : false,
        email : false,
        zip_code : false,
        cashier : false,
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
        this.form.name = null,
        this.form.name.code_name = null,
        this.form.name.store_type = null,
        this.form.name.mobile = null,
        this.form.name.email = null,
        this.form.name.zip_code = null,
        this.form.name.address = null,
        this.form.name.koordinat = null,
        this.form.name.cashier = null
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
      axios.post('api/get-store', data)
         .then(response => {
            if(response.status == 200){
              this.items = response.data.data
              this.meta = response.data.meta
              this.buttonPage = this.pageButton(this.meta.last_page)
            }else{
              notifError('Error')
            }
         })
         .catch(error => {
            notifError('Error')
         })
    },

    createData:function(e) {
      this.error = [];
      this.hasError = [];
      e.preventDefault();
      if(!this.form.name) {
        this.error.name = "Name is required";
        this.hasError.name = true;
        
      }
      else if(!this.form.code_name) {
        this.error.code_name = "Code name is required";
        this.hasError.code_name = true;
      }
      else if(!this.form.store_type) {
        this.error.store_type= "Store type is required";
        this.hasError.store_type = true;
      }
      else if(!this.form.mobile) {
        this.error.mobile= "Mobile is required";
        this.hasError.mobile = true;
      } 
      else if(!this.form.email) {
        this.error.email= "Email is required";
        this.hasError.email = true;
      }
      else if(!this.form.zip_code) {
        this.error.zip_code= "Zip code is required";
        this.hasError.zip_code = true;
      }
      else if(!this.form.cashier) {
        this.error.cashier= "Cashier is required";
        this.hasError.cashier = true;
      }else {
        axios
        .post('api/create-store', this.form)
        .then(response => {
          if(response.status == 200){
            this.items = response.data.data
            this.meta = response.data.meta
            this.buttonPage = this.pageButton(this.meta.last_page)
            this.resetForm()
            notifSuccess('Data berhasil disimpan')
          }else{
            notifError('Data not found')
          }
        })
        .catch(error => {
          console.log(error)
          this.errored = true
          notifError('Somethingelse')
        })
      }
    },

    editData: function(data){
      this.show = true
      this.table.id = data
      this.submit = false
      axios.post('api/show-store', this.table).then(response => {
        if(response.status == 200){
          
          this.form.id              = response.data.store_id,
          this.form.name            = response.data.name,
          this.form.code_name  = response.data.code_name,
          this.form.store_type = response.data.store_type,
          this.form.mobile     = response.data.mobile,
          this.form.email      = response.data.email,
          this.form.zip_code   = response.data.zip_code,
          this.form.address    = response.data.address,
          this.form.koordinat  = response.data.map_koordinat,
          this.form.cashier    = response.data.cashier_id

        }else{
          notifError('Data not found')
        }
      })
      .catch(error => {
          notifError('Somethink else')
      })
    },

    updateData: function(data){
      axios.post('api/update-store', this.form).then(response => {
        console.log(response.status)
        if(response.status == 200){
          this.items = response.data.data
          this.meta = response.data.meta
          this.buttonPage = this.pageButton(this.meta.last_page)
          this.resetForm()
          this.show = false
          notifSuccess('Data berhasil diupdate')
        }else{
          notifError('Data gagal diupdate')
        }
      })
    },
    
    deleteData: function(data){
      Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data ini akan di hapus dan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          
          this.table.id = data
          axios.post('api/delete-store', this.table).then(response => {
              if(response.status == 200){
                this.items = response.data.data
                this.buttonPage = this.pageButton(this.meta.last_page)
                this.resetForm()
                this.show = false
                notifSuccess('Data berhasil dihapus')
              }else{
                notifError('Data gagal dihapus')
              }
          })
          .catch(error => {
              notifError('Somethink else')
          })
        }
      })
    },
    //END CRUD FUNCTION
  },

  mounted() {
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");