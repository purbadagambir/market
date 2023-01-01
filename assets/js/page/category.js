const App = {
    data() {
      return {
        loading : false,
        show: false,
        submit : true,
        items : [],
        entriesOption : [{'value' : 10},{'value' : 25},{'value' : 50}, {'value' : 100}],
        table : {
          column : 'category_name',
          keyword : '',
          perPage : 10,
          pageSelect : 1,
          name : 'Category',
          id : null
        },
        meta : [],
        buttonPage : [],
        form:{
          id : null,
          category_name : null,
          category_slug : null,
          category_details : null,
          parent : null,
          status : null,
          short_order : null
        },
        hasError : {
          category_name : false,
          category_slug : false,
          category_details : false,
          parent : false,
          status : false,
          short_order : false
        },
        error: {
          category_name : false,
          category_slug : false,
          category_details : false,
          parent : false,
          status : false,
          short_order : false
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
        this.form.category_name = null,
        this.form.category_slug = null,
        this.form.category_details = null,
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
        axios.post('api/get-category', data)
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
        if(!this.form.category_name) {
          this.error.category_name = "type is required";
          this.hasError.category_name = true;
          
        }
        else if(!this.form.category_slug) {
          this.error.category_slug = "Label is required";
          this.hasError.category_slug = true;
        }
        else if(!this.form.short_order) {
          this.error.short_order= "Link is required";
          this.hasError.short_order = true;
        }
        else if(!this.form.status) {
          this.error.status= "Status is required";
          this.hasError.status = true;
        } else {
          axios
          .post('api/create-category', this.form)
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
        axios.post('api/show-category', this.table).then(response => {
          if(response.status == 200){
            
            this.form.id = response.data.category_id
            this.form.category_name = response.data.category_name
            this.form.category_slug = response.data.category_slug
            this.form.category_details = response.data.category_details
            this.form.short_order = response.data.short_order
            this.form.status = response.data.status
  
          }else{
            notifError('Data not found')
          }
        })
        .catch(error => {
            notifError('Somethink else')
        })
      },
  
      updateData: function(data){
        axios.post('api/update-category', this.form).then(response => {
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
            axios.post('api/delete-category', this.table).then(response => {
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