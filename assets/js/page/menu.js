const App = {
  data() {
    return {
      show: false,
      submit : true,
      items : [],
      entriesOption : [{'value' : 10},{'value' : 25},{'value' : 50}, {'value' : 100}],
      table : {
        column : 'label',
        keyword : '',
        perPage : 10,
        pageSelect : 1,
        name : 'Menu',
        id : null
      },
      meta : [],
      buttonPage : [],
      form:{
        id : null,
        type : null,
        parent_id : 0,
        label : '',
        link : null,
        icon : null,
        short_order : null,
        status: null,
      },
      hasError : {
        label : false,
        link : false,
        status: false,
        type: false,
      },
      error: {
        type : null,
        parent_id : null,
        label : '',
        link : null,
        icon : null,
        short_order : null,
        status: null,
      },
    }
  },
  methods:{
    getData: function(data){
      axios.post('api/get-menu', data)
         .then(response => {
            if(response.status == 200){
              this.items = response.data.data
              this.meta = response.data.meta
              let page = {};
              for (let i = 0; i < this.meta.last_page; i++) {
                page[i]= {'page' : i+1};
              }
              this.buttonPage = page
            }else{
              notifError('Error')
            }
         })
         .catch(error => {
            notifError('Error')
         })
    },

    resetForm: function () { 
      this.form.type = null,
      this.form.label = null,
      this.form.link = null,
      this.form.icon = null,
      this.form.status = null,
      this.form.short_order = null
    },

    createData:function(e) {
      this.error = [];
      this.hasError = [];
      e.preventDefault();
      if(!this.form.type) {
        this.error.type = "type is required";
        this.hasError.type = true;
        
      }
      else if(!this.form.label) {
        this.error.label = "Label is required";
        this.hasError.label = true;
      }
      else if(!this.form.link) {
        this.error.link= "Link is required";
        this.hasError.link = true;
      }
      else if(!this.form.status) {
        this.error.status= "Status is required";
        this.hasError.status = true;
      } else {
        axios
        .post('api/create-menu', this.form)
        .then(response => {
          if(response.status == 200){
            this.items = response.data.data
            this.meta = response.data.meta
            let page = {};
            for (let i = 0; i < this.meta.last_page; i++) {
              page[i]= {'page' : i+1};
            }
            this.buttonPage = page
            this.resetForm()
            notifSuccess('Data berhasil disimpan')
          }else{
            notifError('Error')
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
      axios.post('api/show-menu', this.table).then(response => {
        if(response.status == 200){
          
          this.form.id = response.data.id
          this.form.type = response.data.type
          this.form.parent_id = response.data.parent_id
          this.form.label = response.data.label
          this.form.link = response.data.route
          this.form.icon = response.data.icon
          this.form.short_order = response.data.short_order
          this.form.status = response.data.status

        }else{
          notifError('Data gagal dihapus')
        }
      })
      .catch(error => {
          notifError('Somethink else')
      })
    },

    updateData: function(data){
      axios.post('api/update-menu', this.form).then(response => {
        if(response.status == 200){
          this.items = response.data.data
          this.meta = response.data.meta
          let page = {};
          for (let i = 0; i < this.meta.last_page; i++) {
            page[i]= {'page' : i+1};
          }
          this.buttonPage = page
          this.resetForm()
          this.show = false
          notifSuccess('Data berhasil diupdate')
        }else{
          notifError('Data gagal dihapus')
        }
      })
      .catch(error => {
          notifError('Somethink else')
      })
    },

    entries: function(){
      this.table.pageSelect = 1
      this.getData(this.table)
    },

    search: function(column){
      this.table.pageSelect = null
      this.table.column = column
      
      const value = document.getElementById(column).value
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

    deleteData: function(data){
      this.table.id = data
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
          axios.post('api/delete-menu', this.table).then(response => {
              if(response.status == 200){
                this.items = response.data.data
                let page = {};
                for (let i = 0; i < this.meta.last_page; i++) {
                  page[i]= {'page' : i+1};
                }
                this.buttonPage = page
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

    openForm: function(){
      this.show = true
    },
    closeForm: function(){
      this.show = false
    }
  },

  mounted() {
    this.getData(this.table)
  }
};
Vue.createApp(App).mount("#app");