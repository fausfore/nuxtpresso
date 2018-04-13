<template>
  <form id="connect" novalidate @submit.prevent="validateFrom()">
    <div class="field">
      <label class="label" for="username">Username</label>
      <p class="control has-icons-left has-icons-right">
        <input
          v-validate:username="'required'"
          v-model="username"
          :class="{'input': true, 'is-danger': errors.has('username') }"
          name="username"
          type="text"
          placeholder="Username">
        <span class="icon is-small is-left has-text-info">
          <i class="fas fa-user"/>
        </span>
        <span v-show="errors.has('username')" class="icon has-text-warning is-small is-right">
          <i class="is-warning fas fa-exclamation"/>
        </span>
      </p>
    </div>

    <div class="field">
      <label class="label" for="email">Email</label>
      <p class="control has-icons-left has-icons-right">
        <input
          v-validate:email="'required|email'"
          v-model="email"
          :class="{'input': true, 'is-danger': errors.has('email') }"
          name="email"
          type="text"
          placeholder="Email">
        <span class="icon is-small is-left has-text-info">
          <i class="fas fa-user"/>
        </span>
        <span v-show="errors.has('email')" class="icon has-text-warning is-small is-right">
          <i class="is-warning fas fa-exclamation"/>
        </span>
      </p>
    </div>

    <div class="field">
      <label class="label" for="password">Password</label>
      <p class="control has-icons-left has-icons-right">
        <input
          v-validate:password="'required'"
          v-model="password"
          :class="{'input': true, 'is-danger': errors.has('password') }"
          name="password"
          type="password"
          placeholder="Password">
        <span class="icon is-small is-left has-text-info">
          <i class="fas fa-lock"/>
        </span>
        <span v-show="errors.has('password')" class="icon has-text-warning is-small is-right">
          <i class="is-warning fas fa-exclamation"/>
        </span>
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button
          class="button is-success"
          type="submit">
          Créer un compte
        </button>
      </p>
    </div>
  </form>
</template>

<script>
import axios from "axios"

export default {
  data: () => ({
    username: "",
    password: "",
    email: ""
  }),
  methods: {
    validateFrom() {
      console.log("validateFrom", this.errors.has("username"))
      this.$validator
        .validateAll()
        .then(valid => {
          if (valid) {
            this.create(this.username, this.password, this.email)
          }
        })
        .catch(e => {
          console.log(e)
        })
    },
    create(form_username, form_password, form_email) {
      console.log(form_username, form_password, form_email)
      return axios
        .post("http://localhost:8000/wp-json/wp/v2/users", {
          username: form_username,
          password: form_password,
          email: form_email
        })
        .then(response => {
          console.log("SUCCESS", response)
          this.$toast.s("Votre profil à été créer !", {
            icon: "fa-check"
          })
        })
        .catch(err => {
          this.$toast.error("Connection refusé", {
            icon: "fa-exclamation-circle"
          })
        })
    }
  }
}
</script>
