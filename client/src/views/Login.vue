<template>
  <div>
    <!-- -->
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      isLoading: false,
      forms: {
        signIn: {
          errors: {},
          data: {
            email: '',
            password: ''
          }
        },
        signUp: {
          errors: {},
          data: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
          }
        }
      }
    }
  },

  methods: {
    /**
     * Submits the sign in form.
     */
    submitSignInForm () {
      this.forms.signIn.errors = {}
      this.isLoading = true

      this.$store.dispatch('login', this.forms.signIn.data)
        .finally(() => {
          this.isLoading = false
        })
        .then(() => {
          this.$router.push({
            name: 'Home'
          })
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.forms.signIn.errors = error.response.data.errors
          }
        })
    },

    /**
     * Submits the sign up form.
     */
    submitSignUpForm () {
      this.forms.signUp.errors = {}
      this.isLoading = true

      axios.post('/users/register', this.forms.signUp.data)
        .finally(() => {
          this.isLoading = false
        })
        .then(() => {
          //
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.forms.signUp.errors = error.response.data.errors
          }
        })
    }
  }
}
</script>

<style
  lang="scss"
  scoped
>
@import "../assets/sass/pages/login/login-4.scss";
</style>
