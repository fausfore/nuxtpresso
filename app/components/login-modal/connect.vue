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
          Se connecter
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
    password: ""
  }),
  methods: {
    validateFrom() {
      console.log("validateFrom", this.errors.has("username"))
      this.$validator
        .validateAll()
        .then(valid => {
          if (valid) {
            this.connect({
              username: this.username,
              password: this.password
            })
          }
        })
        .catch(e => {
          console.log(e)
        })
    },
    connect({ form_username, form_password }) {
      return axios
        .post("http://localhost:8000/wp-json/jwt-auth/v1/token", {
          username: form_username,
          password: form_password
        })
        .then(response => {
          console.log("SUCCESS", response)
          this.$toast.s("Bienvenue !", {
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
