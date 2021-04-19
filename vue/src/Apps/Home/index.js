const HomeApp = Vue.createApp({
  components: {
    'list-components': ListComponent
  },
  data() {
    return {
      request: {
        axios: axios.create({
          headers: {
            'Content-type': "application/json",
            'Accept': 'application/json'
          }
        })
      },
      page: {
        header: {
          title: "Home",
        },
        menu: [
          {
            name: "Create drivers",
            iconImage: `<img src='#'/>`,
            subMenu: [
              {
                name: "Create",
                iconImage: "",
                method: "createDriver"
              },
              {
                name: "Read",
                iconImage: "",
                method: "readDriver"
              },
              {
                name: "Read All",
                iconImage: "",
                method: "readAllDriver"
              }, {
                name: "Update",
                iconImage: "",
                method: "updateDriver"
              },
              {
                name: "Delete",
                iconImage: "",
                method: "deleteDriver"
              },
            ]
          }
        ]
      },
      form: {
        name: "home",
        method: "",
        enctype: "",
        submitURL: "http://127.0.0.1:8000/api",
        dataForm: {},
        fields: [
          {
            name: "",
            type: "",
            placheholder: "",
            pattern: "",
            maxlength: "",
            required: false
          }
        ]
      }
    }
  },
  methods: {
    async getMoreData(event) {
      event.preventDefault()
      this.setData();
      this.request.axios.get(`${this.form.submitURL}/user/show/${this.dataForm.id}`)
        .then(resolver => {
          //window.location.href = "./src/pages/Home/index.html";
        })
        .catch(reject => {
          //window.location.href = "./src/pages/Home/index.html";
        })
        .finally(() => {
          //console.log("")
        })
    },
    setData() {
      const userData = sessionStorage.getItem("userData");

      this.dataForm = JSON.stringify(userData)
    }
  }
})