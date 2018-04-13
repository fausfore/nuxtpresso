<template>
  <div class="modal">
    <div class="modal-background" @click="closeModal()"/>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">{{ formType === "login" ? "Connection" : "Créer votre compte" }}</p>
        <button class="delete" aria-label="close" @click="closeModal()"/>
      </header>
      <section class="modal-card-body">
        <Connect v-if="formType === 'login'"/>
        <Subscribe v-if="formType === 'create'"/>
      </section>
      <footer class="modal-card-foot">
        <button class="button" @click="toggleFormType()">{{ formType === "login" ? 'Pas de compte ?' : 'Se connecter' }}</button>
      </footer>
    </div>
  </div>
</template>

<script>
import axios from "axios"
import Connect from "./connect"
import Subscribe from "./subscribe"

export default {
  components: {
    Connect,
    Subscribe
  },
  data: () => ({
    formType: "login"
  }),
  methods: {
    closeModal() {
      this.$emit("closeMePlease")
    },
    toggleFormType() {
      console.log("toggleFormType")
      this.formType = this.formType === "login" ? "create" : "login"
    }
  }
}
</script>

<style lang="scss" scoped>
.modal {
  display: block;
  .modal-card {
    position: absolute;
    top: 35%;
    right: 50%;
    transform: translateY(-50%) translateX(50%);
  }
  .modal-background {
    background-color: rgba(10, 10, 10, 0.6);
  }
}
</style>
