const SignInApp = Vue.createApp({
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
          title: "Sign In"
        }
      },
      form: {
        name: "signin",
        method: "",
        enctype: "",
        submitURL: "http://127.0.0.1:8000/api",
        dataForm: {},
        fields: [
          {
            name: "username",
            type: "text",
            placheholder: "digite seu username",
            pattern: "",
            maxlength: "15",
            required: true
          },
          {
            name: "password",
            type: "password",
            placheholder: "digite sua senha",
            pattern: "",
            maxlength: "",
            required: true
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
          window.location.href = "./src/pages/Home/index.html";
        })
        .catch(reject => {
          window.location.href = "./src/pages/Home/index.html";
        })
        .finally(() => {
          console.log("")
        })
    },
    setData() {
      // Node List
      const allInputs = document.querySelectorAll(`form[name='${this.form.name}'] input`);

      const newAllInput = {}
      Array.from(allInputs).forEach(input => {
        newAllInput[input.name] = input.type === "checkbox" ? input.checked : input.value
      })

      this.dataForm = JSON.stringify(newAllInput)
    }
  }
})