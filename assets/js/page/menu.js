const App = {
  components: {
    EasyDataTable: window["vue3-easy-data-table"]
  },
  data() {
    return {
      headers: [
        { text: "ID", value: "id", sortable: true },
        { text: "Parent", value: "parent_id", sortable: true},
        { text: "Label", value: "label", sortable: true},
        { text: "Type", value: "type", sortable: true},
        { text: "Route", value: "route", sortable: true},
        { text: "Icon", value: "icon", sortable: true},
        { text: "status", value: "status", sortable: true},
        { text: "Action", value: "operation"},
      ],
      items: [],
      searchValue : [],
      form:{
            type : null,
            parent_id : null,
            label : '',
            link : null,
            icon : null,
            short_order : null,
            status: null,
          },
          disabled : false,
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
          }
    };
  },
  methods:{
    checkForm:function(e) {
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
          if(response.data.status_code == 200)
          {
            notifSuccess(response.data.message),
            this.items = response.data.data ,
            this.resetForm()
          }
          else
          {
            notifError(response.data.message)
          }
        })
        .catch(error => {
          console.log(error)
          this.errored = true
        })
      }
    },

    resetForm: function () { 
          this.form.type = null,
          this.form.label = null,
          this.form.link = null,
          this.form.icon = null,
          this.form.status = null,
          this.form.short_order = null
    },

  },

  mounted() {
      axios.post('api/get-menu').then((response) => {
          this.items = response.data.data
      })
  }
  
};
Vue.createApp(App).mount("#app");