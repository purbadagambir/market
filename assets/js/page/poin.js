const App = {
  data() {
    return {
      loading : false,
      show: false,
      submit : true,
      items : [],
      entriesOption : [{'value' : 15},{'value' : 25},{'value' : 50}, {'value' : 100}],
      table : {
        keyword : '',
        perPage : 15,
        pageSelect : 1,
        name : 'Poin',
        id : null
      },
      meta : [],
      buttonPage : [],
      form:{
        id : null,
        level : null,
        percentase : null,
        active : null,
      },
      hasError : {
        level : false,
        percentase : false,
        active : false
      },
      error: {
        level : false,
        percentase : false,
        active : false
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
      this.form.level = null,
      this.form.percentase = null,
      this.form.active = null
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
      axios.post('api/get-poin', data)
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
      if(!this.form.level) {
        this.error.level = "type is required";
        this.hasError.level = true;
        
      }
      else if(!this.form.percentase) {
        this.error.percentase = "Label is required";
        this.hasError.percentase = true;
      }
      else if(!this.form.active) {
        this.error.active= "active is required";
        this.hasError.active = true;
      } else {
        axios
        .post('api/create-poin', this.form)
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
      axios.post('api/show-poin', this.table).then(response => {
        if(response.status == 200){
          
          this.form.id = response.data.id
          this.form.level = response.data.level_no
          this.form.percentase = response.data.percentase
          this.form.active = response.data.active

        }else{
          notifError('Data not found')
        }
      })
      .catch(error => {
          notifError('Somethink else')
      })
    },

    updateData: function(data){
      axios.post('api/update-poin', this.form).then(response => {
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
      .catch(error => {
          notifError('Somethink else')
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
          axios.post('api/delete-poin', this.table).then(response => {
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