<script>
import axios from "axios"
import LoginModal from "./login-modal"

export default {
  components: {
    LoginModal
  },
  data() {
    return {
      isMenuOpen: false,
      isModalLoginOpen: false,
      staticUrlList: []
    }
  },
  created() {
    this.fetchStaticPage()
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen
    },
    toggleLoginModal() {
      this.isModalLoginOpen = !this.isModalLoginOpen
    },
    async fetchStaticPage() {
      const { data } = await axios.get(
        "http://localhost:8000/wp-json/wp/v2/pages"
      )
      this.staticUrlList = data
    }
  }
}
</script>


<template>
  <div class="app">
    <nav class="navbar" role="navigation" aria-label="dropdown navigation">
      <a class="navbar-item">
        <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
      </a>
      <div class="navbar-item has-dropdown is-active">
        <a class="navbar-link" @click="toggleMenu()">
          Pages
        </a>
        <div v-if="isMenuOpen" class="navbar-dropdown">
          <nuxt-link to="/" class="navbar-item">Posts</nuxt-link>
          <hr class="navbar-divider">
          <nuxt-link v-for="nav of staticUrlList" :key="nav.id" :to="`/page/${nav.slug}`" class="navbar-item">{{ nav.title.rendered }}</nuxt-link>
        </div>
      </div>
      <div class="navbar-end">
        <!-- navbar items -->
        <a class="navbar-item" @click="toggleLoginModal()">Connexion</a>
      </div>
    </nav>
    <LoginModal v-if="isModalLoginOpen" @closeMePlease="toggleLoginModal()"/>
  </div>
</template>

<style>
</style>
