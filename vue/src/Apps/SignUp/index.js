const SignUpApp = Vue.createApp({
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
          title: "Sign Up"
        }
      },
      form: {
        name: "signup",
        method: "",
        enctype: "",
        submitURL: "http://127.0.0.1:8000/api",
        dataForm: {},
        fields: [
          {
            name: "name",
            type: "text",
            placheholder: "",
            pattern: "",
            maxlength: "",
            required: "true"
          },
          {
            name: "email",
            type: "email",
            placheholder: "",
            pattern: "",
            maxlength: "",
            required: "true"
          },
          {
            name: "password",
            type: "password",
            placheholder: "",
            pattern: "",
            maxlength: "",
            required: "true"
          },
          {
            name: "admin",
            type: "checkbox",
            placheholder: "",
            pattern: "",
            maxlength: "",
            required: "true"
          },
          {
            name: "owner",
            type: "checkbox",
            placheholder: "",
            pattern: "",
            maxlength: "",
            required: "true"
          },
          {
            name: "level_admin",
            type: "number",
            placheholder: "",
            pattern: "",
            maxlength: "10",
            required: "true"
          }
        ]
      }
    }
  },
  methods: {
    async submitForm(event) {
      event.preventDefault()
      this.setData();
      this.request.axios.post(`${this.form.submitURL}/user/create`,
        this.dataForm
      )
        .then(resolver => {
          window.location.href = "../../pages/Home/index.html";
        })
        .catch(reject => {
          window.location.href = "../../pages/Home/index.html";
        })
        .finally(() => {
          console.log("")
        })
    },
    setData() {
      const allInputs = document.querySelectorAll("form[name='signup'] input");
      const newAllInput = {}
      Array.from(allInputs).forEach(input => {
        newAllInput[input.name] = input.type === "checkbox" ? input.checked : input.value
      })

      this.dataForm = JSON.stringify(newAllInput)
    }
  }
})