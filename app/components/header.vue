<script>
import axios from "axios"
import LoginModal from "./login-modal"
import VueLogo from "./vue-logo"
import config from "../core/env.dev"

export default {
  components: {
    LoginModal,
    VueLogo
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
        `${config.apiUrl}/wp-json/menus/v1/menus/top`
      )
      data.items.forEach(element => {
        element.slug = element.url.split("/")[3]
        console.log(element.slug)
      })
      this.staticUrlList = data.items
    }
  }
}
</script>


<template>
  <div class="app">
    <nav class="navbar" role="navigation" aria-label="dropdown navigation">
      <a class="navbar-item">
        <VueLogo/>
      </a>
      <div class="navbar-item has-dropdown is-active">
        <a class="navbar-link" @click="toggleMenu()">
          Pages
        </a>
        <div v-if="isMenuOpen" class="navbar-dropdown">
          <nuxt-link to="/" class="navbar-item">Posts</nuxt-link>
          <hr class="navbar-divider">
          <a v-for="item of staticUrlList" :key="item.id" :href="item.url" class="navbar-item">{{ item.title }}</a>
          <!--
          <nuxt-link v-for="item of staticUrlList" :key="item.id" :to="item.url" class="navbar-item">{{ item.title }}</nuxt-link>
          <nuxt-link v-for="nav of staticUrlList" :key="nav.id" :to="`/page/${nav.slug}`" class="navbar-item">{{ nav.title.rendered }}</nuxt-link>
          -->
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
